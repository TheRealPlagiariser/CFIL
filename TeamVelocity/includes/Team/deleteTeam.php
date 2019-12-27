<?php
//called from project.php (AJAX)
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE team
            SET deleted=1
            WHERE teamId=".$_POST['projectId'];

  $result=$conn->exec($update);

  $arrSuccess=array();
  if($result !== FALSE)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="Team deleted Successful";
  }
  else
  {
    $arrSuccess['success']=false;
    $arrSuccess['result']="An error occured. Try again later.";
  }
  echo json_encode($arrSuccess);


}




 ?>
