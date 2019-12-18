<?php

  include "../db_connect.php";
  $error=array();
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
  if($_POST)
  {
    $update = " UPDATE actioncomments
                SET comment=".$conn->quote($_POST['txaComment'])
                ." WHERE commentId = ".$conn->quote($_POST['commentId']);
    $update = $conn->exec($update);
    if($update === FALSE){
        $error['success']=false;
        $error['result']='An error occured. Please try again later.';
        echo json_encode($error,JSON_PRETTY_PRINT);
        exit();
    }else{
        $error['success']=true;
        $error['result']='Comment succesfully updated.';
    }

  }
  else
  {
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
  }

  echo json_encode($error,JSON_PRETTY_PRINT);

 ?>
