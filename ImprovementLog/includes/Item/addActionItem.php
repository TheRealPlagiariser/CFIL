<?php

session_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
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
      // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
      if(!is_array($_POST[$key]))
      {
          // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
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

  $update="UPDATE imp_rec
            SET actionitem=(
                  IF(actionitem='',CONCAT('|',".$conn->quote($_POST['drpActionItem']).",'|'),CONCAT(actionitem, ".$conn->quote($_POST['drpActionItem']).",'|'))
                )
            WHERE recId=".$_POST['recId'];
            // echo $update;
  $update=$conn->exec($update);

  $select="SELECT project.projectName
            FROM imp_rec JOIN customerfeedback.project USING(projectId)
            WHERE recId=".$_POST['recId'];
  $select=$conn->query($select);
  $select=$select->fetch();
  $projectName=$select['projectName'];

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
  // echo $updateActionItem;
  $updateActionItem=$conn->exec($updateActionItem);


  if($update && $updateActionItem !==FALSE){
    // echo "success";
    $error['success']=true;
    $error['result']='Successfully Updated';
  }else {
    $error['success']=false;
    $error['result']='Not Updated';
  }
  header('Content-type: Application/JSON');
   echo json_encode($error,JSON_PRETTY_PRINT);
}
 ?>
