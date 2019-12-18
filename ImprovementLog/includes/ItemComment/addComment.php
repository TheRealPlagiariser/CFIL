<?php

  session_start();
  if($_POST)
  {
      include '../db_connect.php';
      $error=array();
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
      if(empty($error))
      {
        $insert=" INSERT INTO imp_rec_comment(comment,createdBy, recId)
                  VALUES("
                          .$conn->quote($_POST['txaComment']).
                          ","
                          .$conn->quote($_SESSION['Username']).
                          ","
                          .$conn->quote($_POST['recId']).
                        ")";

        $result=$conn->exec($insert);
        if($result)
        {
          //  header("location:../../project.php");
        }else{
          echo "An Error Occured";
        }
      }
  }else{
    echo "Data not sent";
  }

?>
