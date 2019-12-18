<?php

  session_start();

  if(!isset($_SESSION['Username']))
  {
    header("Location: index.php");
  }
  else
  {
    $user=$_SESSION['Username'];
  }


  include '../db_connect.php';
  // print_r($conn);
  // echo $conn;

  if($_POST)
  {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";


    $error=array();
    $endDate="";

    foreach ($_POST as $key => $value) {
      $_POST[$key]=str_replace('|'," ",$_POST[$key]);

      if($key == "drpActionItem" || $key == "txaComment" || $key == "dteEndTaskDate" || $key== "txtProjectCode"){
        $_POST[$key]=strip_tags($_POST[$key]);
            $_POST[$key] =trim($_POST[$key]);
            $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
            $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
            $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        if($_POST["dteEndTaskDate"]==""){
          $endDate="NULL";

        }else{

          $endDate=$conn->quote($_POST['dteEndTaskDate']);

        }

        if($_POST["drpActionItem"]==""){
          $drpActionItem="''";

        }else{

          $drpActionItem="CONCAT('|',".$conn->quote($_POST['drpActionItem']).",'|')";

        }
        continue;
      }

      if(empty($_POST[$key]))
      {
        $error[$key]= $key  ." This field cannot be left blank ";
      }else{
          if($key == "txtAction" || $key == "txaActivityDescription" ){
            continue;
          }else{
            // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
            $_POST[$key]=strip_tags($_POST[$key]);
            $_POST[$key] =trim($_POST[$key]);
            $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
            $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
            $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
          }
      }
    }


    if(empty($error))
    {
      // echo "imhere";
      if(is_numeric($_POST['drpProject']) && is_numeric($_POST['drpActivity']))
      { //Normal Insert
        $selectIsue = " SELECT recId, actionItem, deleted
                        FROM imp_rec
                        WHERE projectId =".$_POST['drpProject']."
                        AND activityId =".$_POST['drpActivity'];
        $selectIsue = $conn->query($selectIsue);
        $rowCount = $selectIsue->rowCount();
        $selectProject = "SELECT projectName
                          FROM customerfeedback.project
                          WHERE projectId=".$conn->quote($_POST['drpProject']);
        $selectProject=$conn->query($selectProject);
        $selectProject = $selectProject->fetch();
        $projectName = $selectProject['projectName'];
        echo "im here";
        if($rowCount == 0)
        { // b rec la pas exister, bizin insert rec, nouvo. voila.
          // echo "yash here";
          $insertIssue = "    INSERT INTO imp_rec(projectId, activityId, actionItem, createdBy)
                              VALUES ("
                              .$conn->quote($_POST['drpProject'])
                              .","
                              .$conn->quote($_POST['drpActivity'])
                              .",
                              ".$drpActionItem."
                              ,"
                              .$conn->quote($_SESSION['Username'])
                              .");";
                              echo $insertIssue;
          $updateActionItem = " UPDATE
                                    actionitem
                                SET
                                    project =(
                                        IF(
                                            (project = '' OR project IS NULL),
                                            CONCAT('|', ".$conn->quote($projectName).", '|'),
                                            CONCAT(project, ".$conn->quote($projectName).", '|')
                                        )
                                    )
                                WHERE
                                    (
                                        actionitem.project NOT LIKE '%|".addslashes($projectName)."|%' OR actionitem.project IS NULL
                                    ) AND actionitem.painPoint =".$conn->quote($_POST['drpActionItem']);

          $updateActionItem=$conn->exec($updateActionItem);
          $conn->beginTransaction();
          $resultIssue = $conn ->exec($insertIssue);

          if($resultIssue && ($updateActionItem !== FALSE))
          {
            $id=$conn->lastInsertId();
            $insertIssueDescription = "   INSERT INTO imp_rec_description(recId, description, manDays, loggedBy, email, startDate, endDate)
                                          VALUES ("
                                           .$conn->quote($id)
                                           .","
                                           .$conn->quote($_POST['txaActivityDescription'])
                                           .","
                                           .$conn->quote($_POST['txtManDays'])
                                           .","
                                           .$conn->quote($_SESSION['Username'])
                                           .","
                                           .$conn->quote($_SESSION['Email'])
                                           .","
                                           .$conn->quote($_POST['dteStartTaskDate'])
                                           .","
                                           .$endDate
                                        .")";
            $resultIssueDescription = $conn ->exec($insertIssueDescription);
            if($resultIssueDescription)
            {

              if(isset($_POST['txaComment']) && $_POST['txaComment']!="")
              { // b ton met comment
                echo "boo";
                $insert=" INSERT INTO imp_rec_comment(comment,createdBy, recId)
                          VALUES("
                                  .$conn->quote($_POST['txaComment']).
                                  ","
                                  .$conn->quote($_SESSION['Username']).
                                  ","
                                  .$conn->quote($id).
                                ")";

                $result=$conn->exec($insert);
                if($result)
                {
                  //check if drpActionItem is not empty !=""
                  //insert projectname into table actionitem
                  $conn->commit();

                }
                else
                {
                  echo "An Error Occured";
                  $conn->rollBack();
                  exit();
                }
              }
              else
              {
                echo " else boo";
                $conn->commit();
              }

            }
            else
            {
              $conn->rollBack();
              exit();
            }
          }
          else
          {
            echo "wardah here";
            $conn->rollBack();
            exit();
          }
        }
        else
        { //rowCount not equal to zero li exister, pas bzn insert, mais bizin cecker si lin met action item
          echo "im here";
          $issueRow = $selectIsue->fetch();
          $id = $issueRow['recId'];
          if(!empty($_POST['drpActionItem']))
          {
            $painPointPosted=$_POST['drpActionItem'];

            if($issueRow['actionItem'] !="") // this if statement is being used for the situation where there are paintpoints in the existing record
            { // enaa painpoint dans db imp_rec
              $painPoints = explode("|",$issueRow['actionItem']);
              $bool=in_array($painPointPosted, $painPoints);
              if(!$bool)
              { //dans ban painpoint la, li pas present
                // $painPointsToInsert= implode ( "|", $painPoints );
                $update=" UPDATE imp_rec
                          SET actionItem=(
                                CONCAT(actionItem, ".$conn->quote($_POST['drpActionItem']).", '|')
                              )
                          WHERE recId=".$id;
                          // echo $update;
                // $updateActionItem = " UPDATE actionitem
                //                       SET project=
                //                           (
                //                             IF(project='' OR project LIKE '%%',
                //                                 CONCAT('|',SELECT projectName FROM project where projectId =".$conn->quote($_POST['drpProject']).",'|'),
                //                                 CONCAT(project, SELECT projectName FROM project where projectId =".$conn->quote($_POST['drpProject']).",'|'))
                //                           )
                //                       WHERE painPoint=".$conn->quote($_POST['drpActionItem'])."";

                $updateActionItem= " UPDATE
                                          actionitem
                                      SET
                                          project =(
                                              IF(
                                                  (project = '' OR project IS NULL),
                                                  CONCAT('|', ".$conn->quote($projectName).", '|'),
                                                  CONCAT(project, ".$conn->quote($projectName).", '|')
                                              )
                                          )
                                      WHERE
                                          (
                                              actionitem.project NOT LIKE '%|".addslashes($projectName)."|%' OR actionitem.project IS NULL
                                          ) AND actionitem.painPoint =".$conn->quote($_POST['drpActionItem']);
                echo $updateActionItem;
                $updateActionItem=$conn->exec($updateActionItem);
                $update=$conn->exec($update);

                if(!$update || !($updateActionItem !== FALSE))
                {
                    $error['success']=false;
                    $error['result']='No value changed';
                    echo json_encode($error,JSON_PRETTY_PRINT);
                    echo "something";
                    // echo "unsuccessfull !$ update || !$ updateActionItem";

                    exit();
                }
                else
                {

                    $error['success']=true;
                    $error['result']='Successfully Inserted';
                    echo "success";
                    // exit();
                }
              }
            }
            else // pna painpooint dans db imp_rec
            {
              $update="UPDATE imp_rec
                        SET actionItem=(
                            CONCAT('|',".$conn->quote($_POST['drpActionItem']).",'|')
                            )
                        WHERE recId=".$id;
              echo $update;
              $updateActionItem = " UPDATE
                                        actionitem
                                    SET
                                        project =(
                                            IF(
                                                (project = '' OR project IS NULL),
                                                CONCAT('|', ".$conn->quote($projectName).", '|'),
                                                CONCAT(project, ".$conn->quote($projectName).", '|')
                                            )
                                        )
                                    WHERE
                                        (
                                            actionitem.project NOT LIKE '%|".addslashes($projectName)."|%' OR actionitem.project IS NULL
                                        ) AND actionitem.painPoint =".$conn->quote($_POST['drpActionItem']);
              echo $updateActionItem;
              $updateActionItem=$conn->exec($updateActionItem);

              $update=$conn->exec($update);
              if(!$update || !($updateActionItem !== FALSE)){
                  $error['success']=false;
                  $error['result']='No value changed';
                  echo json_encode($error,JSON_PRETTY_PRINT);
                  // echo "unsuccessfull !$ update || !$ updateActionItem";
                  exit();
              }
              else
              {
                  $error['success']=true;
                  $error['result']='Successfully Inserted';
              }
            }
          } // if drpAcionItem is not empty


          // echo $id;


          $conn->beginTransaction();
          $insertIssueDescription = "  INSERT INTO imp_rec_description(recId, description, manDays, loggedBy, email, startDate, endDate)
                                      VALUES ("
                                         .$conn->quote($id)
                                         .","
                                         .$conn->quote($_POST['txaActivityDescription'])
                                         .","
                                         .$conn->quote($_POST['txtManDays'])
                                         .","
                                         .$conn->quote($_SESSION['Username'])
                                         .","
                                         .$conn->quote($_SESSION['Email'])
                                         .","
                                         .$conn->quote($_POST['dteStartTaskDate'])
                                         .","
                                         .$endDate
                                      .")";
                                      echo "dgyqwudi". $insertIssueDescription;

            $resultIssueDescription = $conn ->exec($insertIssueDescription);

            if($resultIssueDescription)
            {
              echo isset($_POST['txaComment']) && $_POST['txaComment']!="";
              if(isset($_POST['txaComment']) && $_POST['txaComment']!="")
              {
                $insert=" INSERT INTO imp_rec_comment(comment,createdBy, recId)
                          VALUES("
                                  .$conn->quote($_POST['txaComment']).
                                  ","
                                  .$conn->quote($_SESSION['Username']).
                                  ","
                                  .$conn->quote($id).
                                ")";
                                // echo
                                // $insert;
                $result=$conn->exec($insert);
                if(!$result)
                {
                  echo "An Error Occured";
                  $conn->rollBack();
                  exit();
                }
              }


              if($issueRow['deleted']==1)
              {
                $update=" UPDATE imp_rec
                          SET   imp_rec.deleted = 0
                          WHERE recId =".$conn->quote($id);
                          // echo $update;
                $result=$conn->exec($update);
                echo $result;
              }
              $conn->commit();
            }
            else
            {
              echo "kitsoz";
              $conn->rollBack();
              exit();
            }
        }

      } // end normal Insert
      else
      { //Abnormal Insert

        $conn->beginTransaction();
        if( is_numeric($_POST['drpProject']) && !(is_numeric($_POST['drpActivity']))) // Insert Activity
        {
            $updateActionItem=TRUE;
            $insertActivity ="INSERT INTO activity(activity, createdBy)
                                  VALUES ("
                                  .$conn->quote($_POST['drpActivity'])
                                  .","
                                  .$conn->quote($_SESSION['Username'])
                                .");";
            $resultActivity = $conn ->exec($insertActivity);
            if($resultActivity){
              $id=$conn->lastInsertId();
              $code="CONCAT('|',".$conn->quote($_POST['drpActionItem']).",'|')";
              if($_POST['drpActionItem']==""){
                $code="''";
              }
              $insertIssue = "   INSERT INTO imp_rec(projectId, activityId, actionItem, createdBy)
                                    VALUES ("
                                    .$conn->quote($_POST['drpProject'])
                                    .","
                                    .$conn->quote($id)
                                    .",
                                      ".$code."
                                    ,"
                                    .$conn->quote($_SESSION['Username'])
                                    .");";
              echo "Boo yaaa";
              if ($code !="''"){
                $selectProject = "SELECT projectName
                                  FROM customerfeedback.project
                                  WHERE projectId=".$conn->quote($_POST['drpProject']);
                $selectProject=$conn->query($selectProject);
                $selectProject = $selectProject->fetch();
                $projectName = $selectProject['projectName'];

                $updateActionItem= " UPDATE
                                          actionitem
                                      SET
                                          project =(
                                              IF(
                                                  (project = '' OR project IS NULL),
                                                  CONCAT('|', ".$conn->quote($projectName).", '|'),
                                                  CONCAT(project, ".$conn->quote($projectName).", '|')
                                              )
                                          )
                                      WHERE
                                          (
                                              actionitem.project NOT LIKE '%|".addslashes($projectName)."|%' OR actionitem.project IS NULL
                                          ) AND actionitem.painPoint =".$conn->quote($_POST['drpActionItem']);
                echo $updateActionItem;
                $updateActionItem=$conn->exec($updateActionItem);
              }

              $resultIssue = $conn ->exec($insertIssue);

              if($resultIssue && $updateActionItem !==FALSE){
                $id=$conn->lastInsertId();
                $insertIssueDescription = "  INSERT INTO imp_rec_description(recId, description, manDays, loggedBy, email, startDate, endDate)
                                            VALUES ("
                                               .$conn->quote($id)
                                               .","
                                               .$conn->quote($_POST['txaActivityDescription'])
                                               .","
                                               .$conn->quote($_POST['txtManDays'])
                                               .","
                                               .$conn->quote($_SESSION['Username'])
                                               .","
                                               .$conn->quote($_SESSION['Email'])
                                               .","
                                               .$conn->quote($_POST['dteStartTaskDate'])
                                               .","
                                               .$endDate
                                            .")";
                  $resultIssueDescription = $conn ->exec($insertIssueDescription);
                if($resultIssueDescription)
                {
                  if(isset($_POST['txaComment']) && $_POST['txaComment']!="")
                  {
                    $insert=" INSERT INTO imp_rec_comment(comment,createdBy, recId)
                              VALUES("
                                      .$conn->quote($_POST['txaComment']).
                                      ","
                                      .$conn->quote($_SESSION['Username']).
                                      ","
                                      .$conn->quote($id).
                                    ")";

                    $result=$conn->exec($insert);
                    if($result)
                    {
                      $conn->commit();

                    }else{
                      echo "An Error Occured";
                      $conn->rollBack();
                      exit();
                    }
                  }
                  else
                  {
                    $conn->commit();
                  }

                }
                else
                {
                  $conn->rollBack();
                  exit();
                }
              }
              else
              {
                $conn->rollBack();
                exit();
              }

            }
            else
            {
              echo "error inserting project nsert Actiivty followed by Project then Normal Insert activity 1";
              $conn->rollBack();
              exit();
            }

        } //end if insert activity

        if((is_numeric($_POST['drpActivity'])) && !(is_numeric($_POST['drpProject']))) //Insert Project
        {
          $updateActionItem=TRUE;

          $insertProject ="INSERT INTO project(projectCode,projectName, createdBy)
                                VALUES ("
                                .$conn->quote($_POST['txtProjectCode'])
                                .","
                                .$conn->quote($_POST['drpProject'])
                                .","
                                .$conn->quote($_SESSION['Username'])
                              .");";
          $resultProject = $conn2 ->exec($insertProject);
          $projectName= $_POST['drpProject'];
          if($resultProject){

            $id=$conn2->lastInsertId();
            $code="CONCAT('|',".$conn->quote($_POST['drpActionItem']).",'|')";
            if($_POST['drpActionItem']==""){
              $code="''";
            }
              // echo"echo";
            $insertIssue = "   INSERT INTO imp_rec(projectId, activityId, actionItem, createdBy)
                                  VALUES ("
                                  .$conn->quote($id)
                                  .","
                                  .$conn->quote($_POST['drpActivity'])
                                  .",
                                  ".$code."
                                  ,"
                                  .$conn->quote($_SESSION['Username'])
                                  .");";
            echo $insertIssue;
            if($code != ""){
              $updateActionItem= " UPDATE
                                        actionitem
                                    SET
                                        project =(
                                            IF(
                                                (project = '' OR project IS NULL),
                                                CONCAT('|', ".$conn->quote($projectName).", '|'),
                                                CONCAT(project, ".$conn->quote($projectName).", '|')
                                            )
                                        )
                                    WHERE
                                        (
                                            actionitem.project NOT LIKE '%|".addslashes($projectName)."|%' OR actionitem.project IS NULL
                                        ) AND actionitem.painPoint =".$conn->quote($_POST['drpActionItem']);
              echo $updateActionItem;
              $updateActionItem=$conn->exec($updateActionItem);
            }

            $resultIssue = $conn ->exec($insertIssue);

            if($resultIssue && $updateActionItem !== FALSE){
              echo "boo4";

              $id=$conn->lastInsertId();
              $insertIssueDescription = "  INSERT INTO imp_rec_description(recId, description, manDays, loggedBy, email, startDate, endDate)
                                          VALUES ("
                                             .$conn->quote($id)
                                             .","
                                             .$conn->quote($_POST['txaActivityDescription'])
                                             .","
                                             .$conn->quote($_POST['txtManDays'])
                                             .","
                                             .$conn->quote($_SESSION['Username'])
                                             .","
                                             .$conn->quote($_SESSION['Email'])
                                             .","
                                             .$conn->quote($_POST['dteStartTaskDate'])
                                             .","
                                             .$endDate
                                          .")";
                $resultIssueDescription = $conn ->exec($insertIssueDescription);
                if($resultIssueDescription){
                  if(isset($_POST['txaComment']) && $_POST['txaComment']!=""){
                    $insert=" INSERT INTO imp_rec_comment(comment,createdBy, recId)
                              VALUES("
                                      .$conn->quote($_POST['txaComment']).
                                      ","
                                      .$conn->quote($_SESSION['Username']).
                                      ","
                                      .$conn->quote($id).
                                    ")";

                    $result=$conn->exec($insert);
                    if($result)
                    {
                      $conn->commit();

                    }else{
                      echo "An Error Occured";
                      $conn->rollBack();
                      exit();
                    }
                  }
                  else
                  {
                    $conn->commit();
                  }
                }else{
                  $conn->rollBack();
                  exit();
                }
            }
            else
            {
              $conn->rollBack();
              exit();
            }

          }
          else
          {
            echo "error inserting project nsert Actiivty followed by Project then Normal Insert project 1";

            $conn->rollBack();
            exit();
          }
        } //end if insert project


        if(!(is_numeric($_POST['drpActivity'])) && !(is_numeric($_POST['drpProject']))) //Insert Project followed by Activity then Normal Insert
        {
          // echo "he here";
          $updateActionItem=TRUE;

          $insertProject ="INSERT INTO customerfeedback.project(projectCode,projectName, createdBy)
                                VALUES ("
                                .$conn->quote($_POST['txtProjectCode'])
                                .","
                                .$conn->quote($_POST['drpProject'])
                                .","
                                .$conn->quote($_SESSION['Username'])
                                .");";
          $resultProject = $conn2 ->exec($insertProject);
          $projectName= $_POST['drpProject'];
          echo $projectName;
          if($resultProject)
          {
            $pid=$conn2->lastInsertId();
            echo "\n".$pid."\n";
            $insertActivity ="INSERT INTO activity(activity, createdBy)
                                  VALUES ("
                                  .$conn->quote($_POST['drpActivity'])
                                  .","
                                  .$conn->quote($_SESSION['Username'])
                                .");";
            $resultActivity = $conn ->exec($insertActivity);
            if($resultActivity){
                $aid=$conn->lastInsertId();

                $code="CONCAT('|',".$conn->quote($_POST['drpActionItem']).",'|')";
                if($_POST['drpActionItem']==""){
                  $code="''";
                  echo"echo";
                }
                $insertIssue = "   INSERT INTO imp_rec(projectId, activityId, actionItem, createdBy)
                                      VALUES ("
                                      .$pid
                                      .","
                                      .$aid
                                      .",
                                      ".$code."
                                      ,"
                                      .$conn->quote($_SESSION['Username'])
                                      .");";
                // echo $insertIssue;
                echo "imo";
                if($code !="''"){
                  echo "here";
                  $updateActionItem= " UPDATE
                                            actionitem
                                        SET
                                            project =(
                                                IF(
                                                    (project = '' OR project IS NULL),
                                                    CONCAT('|', ".$conn->quote($projectName).", '|'),
                                                    CONCAT(project, ".$conn->quote($projectName).", '|')
                                                )
                                            )
                                        WHERE
                                            (
                                                actionitem.project NOT LIKE '%|".addslashes($projectName)."|%' OR actionitem.project IS NULL
                                            ) AND actionitem.painPoint =".$conn->quote($_POST['drpActionItem']);
                  echo $updateActionItem;
                  echo "imhere";
                  $updateActionItem=$conn->exec($updateActionItem);
                }
                $resultIssue = $conn ->exec($insertIssue);

                if($resultIssue && $updateActionItem !== FALSE){
                  echo "no problem";
                  $rid=$conn->lastInsertId();
                  $insertIssueDescription = "  INSERT INTO imp_rec_description(recId, description, manDays, loggedBy, email, startDate, endDate)
                                              VALUES ("
                                                 .$rid
                                                 .","
                                                 .$conn->quote($_POST['txaActivityDescription'])
                                                 .","
                                                 .$conn->quote($_POST['txtManDays'])
                                                 .","
                                                 .$conn->quote($_SESSION['Username'])
                                                 .","
                                                 .$conn->quote($_SESSION['Email'])
                                                 .","
                                                 .$conn->quote($_POST['dteStartTaskDate'])
                                                 .","
                                                 .$endDate
                                              .")";
                    $resultIssueDescription = $conn ->exec($insertIssueDescription);
                    if($resultIssueDescription){
                      if(isset($_POST['txaComment']) && $_POST['txaComment']!=""){
                        $insert=" INSERT INTO imp_rec_comment(comment,createdBy, recId)
                                  VALUES("
                                          .$conn->quote($_POST['txaComment']).
                                          ","
                                          .$conn->quote($_SESSION['Username']).
                                          ","
                                          .$conn->quote($rid).
                                        ")";

                        $result=$conn->exec($insert);
                        if($result)
                        {
                          $conn->commit();

                        }else{
                          echo "An Error Occured";
                          $conn->rollBack();
                          exit();
                        }
                      }
                      else
                      {
                        $conn->commit();
                      }
                    }
                    else
                    {
                      $conn->rollBack();
                      exit();
                    }
                }
                else
                {
                  $conn->rollBack();
                  exit();
                }

            }
            else
            {
              echo "error inserting activity nsert Project followed by Activity then Normal Insert";
              $conn ->rollBack();
              exit();
            }
          }
          else
          {
            echo "error inserting project nsert Project followed by Activity then Normal Insert";

            $conn ->rollBack();
            exit();
          }

        } //end Insert Project followed by Activity then Normal Insert
        else{
          echo "boo insert both";
        }
      } //end Abnormal insert

    } //$empty error
    else
    {
      echo "Error empty error";
    }
  }//$_POST

  header("location:../../record.php");

?>
