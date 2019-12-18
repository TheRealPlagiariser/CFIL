<?php

  // echo "<pre>";
  print_r($_POST);
  // echo "</pre>";
  include "../db_connect.php";
  // $date= date("Y-m-d");
  $error=array();
  // $_POST['painPoint']="yash";
  // $_POST['recId']=5;
  if($_POST)
  {
    $conn->beginTransaction();
                        // SELECT project.projectName
                        // FROM imp_rec JOIN project USING(projectId)
                        // WHERE project.projectName='New Project'
                        // AND actionItem LIKE '%|Toyota|%'
    $painPointPosted=$_POST['painPoint'];
    $select ="SELECT actionItem, project.projectName
              FROM imp_rec JOIN customerfeedback.project USING(projectId)
              WHERE recId=".$_POST['recId'];
    $select=$conn->query($select);
    $row=$select->fetchAll(PDO::FETCH_ASSOC);
    print_r($row);

    $projectName=$row[0]['projectName'];

    $rowCount=" SELECT project.projectName
                FROM imp_rec JOIN customerfeedback.project USING(projectId)
                WHERE project.projectName='".addslashes($projectName)."'
                AND actionItem LIKE '%|".addslashes($painPointPosted)."|%'";
    $rowCount=$conn->query($rowCount);
    $rowCount=$rowCount->rowCount();

    $selectPrjFrmAction=" SELECT project
                          FROM actionitem
                          WHERE painPoint=".$conn->quote($_POST['painPoint']);
                          // echo $selectPrjFrmAction;
    $selectPrjFrmAction=$conn->query($selectPrjFrmAction);
    $selectPrjFrmAction=$selectPrjFrmAction->fetch();
    // print_r($selectPrjFrmAction);
    // $projectName=$selectPrjFrmAction['project'];
    $painPoints = explode("|",$row[0]['actionItem']);
    $painPointsToInsert=array_diff($painPoints, array($painPointPosted));
    $painPointsToInsert= implode ( "|", $painPointsToInsert );
    if($painPointsToInsert == "|"){ //pna painpoint pou insert
      $painPointsToInsert="";
    }
    $update = " UPDATE imp_rec
                SET actionItem=".$conn->quote($painPointsToInsert)
                ." WHERE recId = ".$conn->quote($_POST['recId']);
                // echo $update;
    $update = $conn->exec($update);

    if($rowCount>1)
    {
      if($update !==FALSE){
        $error['success']=true;
        $error['result']='Successfully Inserted';
        $conn->commit();
      }else{
        $error['success']=false;
        $error['result']='No value changed';
        echo json_encode($error,JSON_PRETTY_PRINT);
        $conn->rollBack();
        exit();
      }
    }
    else
    {
      $projects = explode("|",$selectPrjFrmAction['project']);
      print_r ($projects);
      $projectsToInsert=array_diff($projects, array($projectName));
      $projectsToInsert= implode ( "|", $projectsToInsert );
      if($projectsToInsert == "|"){ //pna painpoint pou insert
        $projectsToInsert="";
      }
      $updateProject = "  UPDATE actionitem
                          SET project=".$conn->quote($projectsToInsert)
                          ." WHERE painPoint=".$conn->quote($painPointPosted);
                  echo $updateProject;
      $updateProject = $conn->exec($updateProject);

      if($update !==FALSE && $updateProject !==FALSE ){
        $error['success']=true;
        $error['result']='Successfully Inserted';
        $conn->commit();

      }else{

          $error['success']=false;
          $error['result']='No value changed';
          echo json_encode($error,JSON_PRETTY_PRINT);
          $conn->rollBack();
          exit();
      }
    }




  }
  else //$_POST
  {
    $error['success']=false;
    $error['result']='Nothing posted';
  }

  echo json_encode($error,JSON_PRETTY_PRINT);

 ?>
