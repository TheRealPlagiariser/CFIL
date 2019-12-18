<?php

  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  include "../db_connect.php";
  // $date= date("Y-m-d");
  $error=array();
  $endDate="";
  if($_POST)
  {
    foreach ($_POST as $key => $value) {
      if($_POST["dteEndTaskDate"]==""){
        // echo "boooo";
        $endDate="endDate=NULL";
        continue;
      }else{
        // echo "boo";
        $_POST[$key]=str_replace('|'," ",$_POST[$key]);
        
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
        $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        $endDate="endDate=".$conn->quote($_POST['dteEndTaskDate']);
        continue;

      }
      if(empty($_POST[$key]))
      {
        $error[$key]= $key  ." This field cannot be left blank.";
      }else{
        if($key == "txaActivityDescription"){
          continue;
        }else{
          $_POST[$key]=strip_tags($_POST[$key]);
          $_POST[$key] =trim($_POST[$key]);
          $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
          $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }
      }

    }

    if(empty($error))
    {
      $update = " UPDATE imp_rec_description
                  SET description=".$conn->quote($_POST['txaActivityDescription'])
                  .","
                  ." manDays=".$conn->quote($_POST['txtManDays'])
                  .","
                  ." startDate=".$conn->quote($_POST['dteStartTaskDate'])
                  .",
                  ".$endDate
                  .",
                   dateModified=NOW()"
                  ." WHERE rec_descriptionId = ".$conn->quote($_POST['id']);
                  // echo $update;
      $update = $conn->exec($update);
      if(!$update){
          $error['success']=false;
          $error['result']='An error occured';
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
      $error['result']='NOT Successfully Inserted';
    }
    }



  echo json_encode($error,JSON_PRETTY_PRINT);

 ?>
