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

if(isset($_POST['txtProjectName']))
{
  $code=" projectName=".$conn->quote($_POST['txtProjectName']);
}

if(isset($_POST['txtProjectCode']))
{
  $code=" projectCode=".$conn->quote($_POST['txtProjectCode']);
}

if(isset($_POST['txtProjectName']) && isset($_POST['txtProjectCode']))
{
  $code.=" , projectName=".$conn->quote($_POST['txtProjectName']);
}
$update="UPDATE project
         SET ".$code .
         "WHERE projectId=".$_POST['projectId'];


// echo $update;
$update=$conn->exec($update);
if($update !== FALSE)
{
  $arrSuccess['success']=true;
  $arrSuccess['result']="Project updated Successfully";

  //  header("location:../../project.php");
}
else{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";

}

  echo json_encode($arrSuccess);



 ?>
