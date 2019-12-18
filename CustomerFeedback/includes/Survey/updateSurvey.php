<?php

  //
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";

  if($_POST)
  {
    foreach ($_POST as $key => $value) {
      if(empty($_POST[$key]))
      {
        $error[$key]="This field cannot be left blank";
      }
      else{
        // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
        if(!is_array($_POST[$key]))
        {
          $_POST[$key]=strip_tags($_POST[$key]);
          $_POST[$key] =trim($_POST[$key]);
          $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
          $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }

      }
    }
    include '../db_connect.php';
    $set="";
    if(isset($_POST['txtSurveyName']))
    {
      $set.= " surveyName=".$conn->quote($_POST['txtSurveyName'])." , ";
    }
    if(isset($_POST['drpProject']))
    {
      $set.= " projectId=".$conn->quote($_POST['drpProject'])." , ";
    }
    if(isset($_POST['drpTemplate']))
    {
      $set.= " templateId=".$conn->quote($_POST['drpTemplate'])." , ";
    }

    $set=rtrim($set," , ");
    $update=" UPDATE survey
              SET  ".$set
              ." WHERE surveyId=".$conn->quote($_POST['surveyId']);

    $success=array();
    if($conn->exec($update))
    {
      $success['success']=true;
      $success['result']="Successfully Updated";
    }
    else{
      $success['success']=false;
      $success['result']="An error occured. Please, try again later.";
    }
    echo json_encode($success,JSON_PRETTY_PRINT);


  }


?>
