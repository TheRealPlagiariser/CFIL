<?php
//delete call from question.php (AJAX)
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE template JOIN question_template USING(templateId)
            SET template.deleted =1,question_template.deleted=1
            WHERE templateId=".$_POST['templateId'];

  $result=$conn->exec($update);


  $arrSuccess=array();
  if($result !== FALSE)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="Template deleted Successful";
  }
  else
  {
    $arrSuccess['success']=false;
    $arrSuccess['result']="An error occured. Try again later.";
  }
  echo json_encode($arrSuccess);

}
?>
