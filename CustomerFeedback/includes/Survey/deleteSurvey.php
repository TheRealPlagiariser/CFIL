<?php
//delete call from question.php (AJAX)
if($_POST)
{
  include '../db_connect.php';


  $update=" UPDATE survey
            SET deleted =1
            WHERE surveyId=".$_POST['surveyId'];

  $result=$conn->exec($update);

  $arrSuccess=array();
  if($result !== FALSE)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="Survey deleted Successful";
  }
  else
  {
    $arrSuccess['success']=false;
    $arrSuccess['result']="An error occured. Try again later.";
  }
  echo json_encode($arrSuccess);


}
?>
