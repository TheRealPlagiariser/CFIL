<?php
  if(!isset($where)){
    include "../db_connect.php";
  }
  $error=array();
  if($_POST)
  {
    $conn->beginTransaction();

    $projectPosted=$_POST['projectName'];
    $actionItemIdPosted=$_POST['actionItemId'];

    $select ="SELECT project, painPoint
              FROM actionitem
              WHERE actionItemId=".$_POST['actionItemId'];

    $select=$conn->query($select);
    $row=$select->fetchAll(PDO::FETCH_ASSOC);
    $projects=$row[0]['project'];
    $painPoint=$row[0]['painPoint'];

    $select ="SELECT project.projectId,imp_rec.actionItem,imp_rec.recId
              FROM customerfeedback.project JOIN imp_rec USING(projectId)
              WHERE project.projectName=".$conn->quote($_POST['projectName']);

    $select=$conn->query($select);
    $row=$select->fetchAll(PDO::FETCH_ASSOC);
    $projectId=$row[0]['projectId'];
    $painPoints=$row[0]['actionItem'];

    $projects = explode("|",$projects);
    $projectsToInsert=array_diff($projects, array($projectPosted));
    $projectsToInsert= implode ( "|", $projectsToInsert );
    if($projectsToInsert == "|"){ //pna painpoint pou insert
      $projectsToInsert="";
    }

    $updateProject = "  UPDATE actionitem
                        SET project=".$conn->quote($projectsToInsert)
                        ." WHERE actionItemId=".$conn->quote($actionItemIdPosted);
    $updateProject = $conn->exec($updateProject);

    $painPoints = explode("|",$painPoints);
    $painPointsToInsert=array_diff($painPoints, array($painPoint));
    $painPointsToInsert= implode ( "|", $painPointsToInsert );
    if($painPointsToInsert == "|"){ //pna painpoint pou insert
      $painPointsToInsert="";
    }
    $update = " UPDATE imp_rec
                SET actionItem=".$conn->quote($painPointsToInsert)
                ." WHERE projectId = ".$conn->quote($projectId);
    $update = $conn->exec($update);

    if($update !==FALSE && $updateProject !==FALSE ){
      $error['success']=true;
      $error['result']='Successfully delete.';
      $conn->commit();
    }else{
      $error['success']=false;
      $error['result']='An error occured. Please try again.';
      echo json_encode($error,JSON_PRETTY_PRINT);
      $conn->rollBack();
      exit();
    }
  }
  else //$_POST
  {
    $error['success']=false;
    $error['result']='An error occured. Please try again.';
  }

  echo json_encode($error,JSON_PRETTY_PRINT);

 ?>
