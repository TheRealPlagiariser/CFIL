<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
include "../db_connect.php";

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
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key]=str_replace('|'," ",$_POST[$key]);
        $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
        $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
    }

  }
}
$arrSuccess=array();
if(!empty($error))
{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";
  echo json_encode($arrSuccess);
  exit();
}

$code="";

$update="UPDATE config
         SET dns=".$conn->quote($_POST['txtDns']);


// echo $update;
$update=$conn->exec($update);
if($update !== FALSE)
{
  $arrSuccess['success']=true;
  $arrSuccess['result']=" Update Successful";

  $selectConfig= "SELECT dns FROM config";
  $selectConfig=$conn->query($selectConfig);
  $selectConfig=$selectConfig->fetch(PDO::FETCH_ASSOC);
  
  $arrSuccess['value']=$selectConfig['dns'];

  //  header("location:../../project.php");
}
else{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";

}

  echo json_encode($arrSuccess);



 ?>
