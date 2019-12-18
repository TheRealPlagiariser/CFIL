<?php

  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  include "../db_connect.php";
  // $date= date("Y-m-d");
  $error=array();
  if($_POST)
  {
    foreach ($_POST as $key => $value) {
      if(empty($_POST[$key]))
      {
        $error[$key]="This field cannot be empty";
      }else{
        // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
        if(!is_array($_POST[$key]))
        {
          $_POST[$key]=str_replace('|'," ",$_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }

      }
    }

    if(empty($error)){
      $update = " UPDATE imp_rec_comment
                  SET comment=".$conn->quote($_POST['txaComment'])
                  ." WHERE commentId = ".$conn->quote($_POST['commentId']);
                  echo $update;
      $update = $conn->exec($update);
      if(!$update){
          $error['success']=false;
          $error['result']='No value changed';
          echo json_encode($error,JSON_PRETTY_PRINT);
          exit();
      }else{
          $error['success']=true;
          $error['result']='Successfully Inserted';
      }
    }
    else
    {
      $error['success']=false;
      $error['result']='Failed: An error occured. Try again later.';
    }
  }
  else
  {
    $error['success']=false;
    $error['result']='NOT Successfully Inserted';
  }

  echo json_encode($error,JSON_PRETTY_PRINT);

 ?>
