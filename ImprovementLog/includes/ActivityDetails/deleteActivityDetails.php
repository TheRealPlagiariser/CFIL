
<?php
if($_POST)
{
  $error=array();

  include '../db_connect.php';
  $recId= $_POST['recId'];
  $select="   SELECT recId
              FROM imp_rec join imp_rec_description USING (recId)
              WHERE imp_rec.recId=$recId
              AND imp_rec_description.deleted=0";
  $select=$conn->query($select);
  $rowCount = $select->rowCount();
  if($rowCount>1)
  { // Reord contains more than one description
    $update=" UPDATE imp_rec_description
              SET   imp_rec_description.deleted = 1
              WHERE rec_descriptionId =".$_POST['recDescId'];
    $result=$conn->exec($update);
    if($result !== FALSE){
      $error['success']=true;
      $error['result']='Delete Success.';
      echo json_encode($error,JSON_PRETTY_PRINT);
    }else{
      $error['success']=false;
      $error['result']='An error ocured. Please try again later.';
      echo json_encode($error,JSON_PRETTY_PRINT);
      exit();
    }

  }
  else // Record contain only one description, so, delete entire record!!
  {
    $select = " SELECT
                    project.projectName,
                    imp_rec.actionItem,
                    COUNT(imp_rec_comment.comment) as numComment
                FROM
                    imp_rec
                LEFT JOIN imp_rec_comment USING(recId)
                JOIN project USING(projectId)
                WHERE
                    imp_rec.recId = ".$_POST['recId'];
    $select=$conn->query($select);
    $select=$select->fetch();
    $rowCount = $select['numComment']; // $rowCount is the number of comments per record
    $projectName=addslashes($select['projectName']);
    $painPoints=$select['actionItem'];
    $conn->beginTransaction();
    if(!empty($painPoints)) //Record has paintpoints
    {
      $cascadeSuccess=array();
      $countProject=array();
      $painPoints = explode("|",$painPoints);
      $painPoints=array_filter($painPoints);

      foreach($painPoints as $key => $value)
      {
        $painPoint=$value;
        $countProject[$key]="  SELECT project.projectName
                            FROM imp_rec JOIN project USING(projectId)
                            WHERE project.projectName='".$projectName."'
                            AND actionItem LIKE '%|".$value."|%'";
        $countProject[$key]=$conn->query($countProject[$key]);
        $countProject[$key]=$countProject[$key]->rowCount();
        if($countProject[$key]>1)
        { // Pas Cascade
          continue;
        }
        else
        { //Cascade
          $updateActionItem = " UPDATE actionitem
                                SET project=
                                          IF(
                                              LENGTH(project) = LENGTH('|".$projectName."|'),
                                          REPLACE
                                              (project, '|".$projectName."|', ''),
                                          REPLACE
                                              (project, '".$projectName."|', '')
                                          )
                                WHERE project LIKE '%|".$projectName."|%'
                                AND painPoint=".$conn->quote($painPoint);
          $cascadeSuccess[$key]= $conn->exec($updateActionItem);
          if($conn->exec($updateActionItem) === FALSE)
          {
            $conn->rollback();
            $error['success']=false;
            $error['result']='An error ocured. Please try again later.';
            echo json_encode($error,JSON_PRETTY_PRINT);
            exit();
          }
        }
      } // End For

      if($rowCount !=0) // Rec has comments
      {
        $update=" UPDATE imp_rec
                  INNER JOIN imp_rec_comment using (recId)
                  INNER JOIN imp_rec_description using (recId)
                  SET imp_rec.deleted = 1,
                      imp_rec.actionItem='',
                      imp_rec_comment.deleted = 1,
                      imp_rec_description.deleted = 1
                  WHERE imp_rec.recId =".$_POST['recId'];
        $result=$conn->exec($update);
        if($result !== FALSE){
          $conn->commit();
          $error['success']=true;
          $error['result']='Delete Success.';
          echo json_encode($error,JSON_PRETTY_PRINT);
        }else{
          $conn->rollback();
          $error['success']=false;
          $error['result']='An error ocured. Please try again later.';
          echo json_encode($error,JSON_PRETTY_PRINT);
          exit();
        }
      }
      else // Rec does not have comment
      {
        $update=" UPDATE imp_rec
                  INNER JOIN imp_rec_description using (recId)
                  SET imp_rec.deleted = 1,
                      imp_rec.actionItem='',
                      imp_rec_description.deleted = 1
                  WHERE imp_rec.recId =".$_POST['recId'];
        $result=$conn->exec($update);
        if($result !== FALSE){
          $conn->commit();
          $error['success']=true;
          $error['result']='Delete Success.';
          echo json_encode($error,JSON_PRETTY_PRINT);
        }else{
          $conn->rollback();
          $error['success']=false;
          $error['result']='An error ocured. Please try again later.';
          echo json_encode($error,JSON_PRETTY_PRINT);
          exit();
        }
      }
    }
    else //Rec contains no painpoint
    {
      if($rowCount !=0) // the record has comments
      {
        $update=" UPDATE imp_rec
                  INNER JOIN imp_rec_comment using (recId)
                  INNER JOIN imp_rec_description using (recId)
                  SET imp_rec.deleted = 1,
                      imp_rec.actionItem='',
                      imp_rec_comment.deleted = 1,
                      imp_rec_description.deleted = 1
                  WHERE imp_rec.recId =".$_POST['recId'];
        $result=$conn->exec($update);

      }
      else
      {
        $update=" UPDATE imp_rec
                  INNER JOIN imp_rec_description using (recId)
                  SET imp_rec.deleted = 1,
                      imp_rec.actionItem='',
                      imp_rec_description.deleted = 1
                  WHERE imp_rec.recId =".$_POST['recId'];
        $result=$conn->exec($update);
      }
      if($result !== FALSE){
        $conn->commit();
        $error['success']=true;
        $error['result']='Delete Success.';
        echo json_encode($error,JSON_PRETTY_PRINT);
      }else{
        $conn->rollback();
        $error['success']=false;
        $error['result']='An error ocured. Please try again later.';
        echo json_encode($error,JSON_PRETTY_PRINT);
        exit();
      }
    }

  }
}
?>
