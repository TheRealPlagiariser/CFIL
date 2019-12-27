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

if(isset($_POST['txtTeamName']))
{
  $code=" teamName=".$conn->quote($_POST['txtTeamName']);
}


$update="UPDATE team
         SET ".$code .
         "WHERE teamId=".$_POST['teamId'];


// echo $update;
$update=$conn->exec($update);
if($update !== FALSE)
{
  $arrSuccess['success']=true;
  $arrSuccess['result']="Team updated Successfully";

  //  header("location:../../project.php");
}
else{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";

}

  echo json_encode($arrSuccess);



 ?>
