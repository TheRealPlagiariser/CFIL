<?php
//called from project.php (AJAX)
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE project
            SET deleted=1
            WHERE projectId=".$_POST['projectId'];

  $result=$conn->exec($update);

  $arrSuccess=array();
  if($result !== FALSE)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="Project/CR/Task deleted Successful";
  }
  else
  {
    $arrSuccess['success']=false;
    $arrSuccess['result']="An error occured. Try again later.";
  }
  echo json_encode($arrSuccess);


}




 ?>
