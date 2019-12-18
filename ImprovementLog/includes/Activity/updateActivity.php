<?php
  include "../db_connect.php";
  foreach ($_POST as $key => $value) {
    if(empty($_POST[$key]))
    {
      $error[$key]="This field cannot be empty";
    }else{
      if(!is_array($_POST[$key]))
      {
        $_POST[$key]=str_replace('|'," ",$_POST[$key]);
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
        $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
      }
    }
  }
  $code="";
  if(isset($_POST['txtActivity']))
  {
    $code=" activity=".$conn->quote($_POST['txtActivity']);
  }

  $update="UPDATE activity
           SET ".$code .
           "WHERE activityId=".$_POST['activityId'];
  $update=$conn->exec($update);
  if($update !== FALSE)
  {
    $error['success']=true;
    $error['result']='Activity successfully updated.';
    echo json_encode($error,JSON_PRETTY_PRINT);
  }
  else{
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
    echo json_encode($error,JSON_PRETTY_PRINT);
  }




 ?>
