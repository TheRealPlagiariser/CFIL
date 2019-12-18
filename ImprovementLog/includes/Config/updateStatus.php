<?php
  include "../db_connect.php";
  $error= array( );
  foreach ($_POST as $key => $value) {
    if(empty($_POST[$key]))
    {
      $error[$key]="This field cannot be empty";
    }else{
      if(!is_array($_POST[$key]))
      {
        $_POST[$key]=str_replace('\'',"",$_POST[$key]);
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
      }
    }
  }


  if(empty($error)){
    $update="UPDATE config
             SET superusers=".$conn->quote($_POST['txtSuperUsers'])."
             ,actionItemStatus=".$conn->quote($_POST['txtStatus']);
             echo $update;
    $update=$conn->exec($update);
    if($update !==FALSE)
    {
      $error['success']=true;
      $error['result']='Status successfully amended.';
      echo json_encode($error,JSON_PRETTY_PRINT);
    }
    else{
      $error['success']=false;
      $error['result']='An error occured. Please try again later.';
      echo json_encode($error,JSON_PRETTY_PRINT);
    }
  }else{
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
    echo json_encode($error,JSON_PRETTY_PRINT);
  }

header("location: ../../config.php");



 ?>
