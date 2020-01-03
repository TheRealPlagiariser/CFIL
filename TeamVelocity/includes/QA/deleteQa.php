<?php
//called from project.php (AJAX)
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE qualityassurance
            SET deleted=1
            WHERE qualityAssuranceId=".$_POST['qualityAssuranceId'];

  $result=$conn->exec($update);

  $arrSuccess=array();
  if($result !== FALSE)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="QA deleted Successful";
  }
  else
  {
    $arrSuccess['success']=false;
    $arrSuccess['result']="An error occured. Try again later.";
  }
  echo json_encode($arrSuccess);


}




 ?>
