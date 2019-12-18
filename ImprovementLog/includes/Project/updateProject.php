<?php

  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  include "../db_connect.php";
  $code="";
  foreach ($_POST as $key => $value) {
    if(empty($_POST[$key]))
    {
      $error[$key]="This field cannot be empty";
    }else{
      // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
      if(!is_array($_POST[$key]))
      {
          // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
          $_POST[$key]=str_replace('|'," ",$_POST[$key]);
          
          $_POST[$key]=strip_tags($_POST[$key]);
          $_POST[$key] =trim($_POST[$key]);
          $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
          $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
      }

    }
  }
  if(isset($_POST['txtProject']))
  {
    $code=" projectName=".$conn->quote($_POST['txtProject']);
  }else{
    echo "No data sent";
  }

  $update="UPDATE project
           SET ".$code .
           "WHERE projectId=".$_POST['projectId'];


  echo $update;
  $update=$conn->exec($update);
  if($update)
  {
    echo "success";
  }
  else{
    echo "an error occured";
  }




 ?>
