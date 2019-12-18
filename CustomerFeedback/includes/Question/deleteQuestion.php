<?php
//delete call from question.php (AJAX)
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE question
            SET question.deleted =1
            WHERE questionId=".$_POST['questionId'];

  $result=$conn->exec($update);
  $arrSuccess=array();
  if($result !==FALSE)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="Question deleted Successful";
  }
  else
  {
    $arrSuccess['success']=false;
    $arrSuccess['result']="An error occured. Try again later.";
  }
  echo json_encode($arrSuccess);

}
?>
