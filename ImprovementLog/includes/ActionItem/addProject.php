<?php

session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: index.php");
}


if($_POST){
  $error=array();
  foreach ($_POST as $key => $value) {
    if(empty($_POST[$key]))
    {
      $error[$key]="This field cannot be empty";
    }else{
      if(!is_array($_POST[$key]))
      {
        $_POST[$key]=str_replace('|'," ",$_POST[$key]);
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
        $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
      }
    }
  }
  include "../db_connect.php";
  $projectName=$_POST['drpProject'];
  $update=" UPDATE actionitem
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
                ) AND actionitem.actionItemId =".$conn->quote($_POST['actionItemId']);
  $update=$conn->exec($update);

  $select=" SELECT painPoint
            FROM actionitem
            WHERE actionItemId=".$_POST['actionItemId'];
  $select=$conn->query($select);
  $select=$select->fetch();
  $painPoint=$select['painPoint'];

  $selectProject="SELECT project.projectId
                  FROM customerfeedback.project
                  WHERE projectName=".$conn->quote($_POST['drpProject']);
  $selectProject=$conn->query($selectProject);
  $selectProject=$selectProject->fetch();
  $projectId=$selectProject['projectId'];

  $updateActionItem= " UPDATE
                            imp_rec
                        SET
                            actionItem =(
                                IF(
                                    (actionItem = '' OR actionItem IS NULL),
                                    CONCAT('|', ".$conn->quote($painPoint).", '|'),
                                    CONCAT(actionItem, ".$conn->quote($painPoint).", '|')
                                )
                            )
                        WHERE
                            (
                              imp_rec.actionItem NOT LIKE '%|".addslashes($painPoint)."|%' OR imp_rec.actionItem IS NULL
                            ) AND imp_rec.projectId =".$conn->quote($projectId);
  // echo $updateActionItem;
  $updateActionItem=$conn->exec($updateActionItem);


  if($update !==FALSE && $updateActionItem !==FALSE){
    // echo "success";
    $error['success']=true;
    $error['result']='Project successfully added';
  }else {
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
  }
  header('Content-type: Application/JSON');
   echo json_encode($error,JSON_PRETTY_PRINT);
}
 ?>
