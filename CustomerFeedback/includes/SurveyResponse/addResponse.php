<?php
session_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

  include '../db_connect.php';
    $questionId=array();
  $question=array();
  $answer=array();
  $success=array();
  $_POST['surveyId']=$_SESSION['surveyId'];
  foreach ($_POST as $key => $value) {
      if(is_array($_POST[$key]))
      {
        $questionId[]=$_POST[$key]['questionId'];
        $question[]=$_POST[$key]['question'];
        $answer[]=$_POST[$key]['answer'];
      }
  }
  if($_POST['action']=="insert")
  {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $insert="INSERT INTO survey_answer(username,surveyId,questionId,pageNo,question,answer) VALUES ";
    foreach ($question as $key => $value) {
      $insert.="("
                   .$conn->quote($_SESSION['Username'])
                   .","
                   .$conn->quote($_POST['surveyId'])
                   .","
                   
                   .$conn->quote($questionId[$key])
                   .","
                   .$conn->quote($_POST['pageNo'])
                   .","
                   .$conn->quote($question[$key])
                   .","
                   .$conn->quote($answer[$key])
                  ."),";
    }
    // echo $insert;

    $insert=rtrim($insert,',');
    // echo $insert;
    $conn->beginTransaction();
    $insert=$conn->exec($insert);
    if($insert)
    {
      if(isset($_POST['finished']))
      {
        $update="UPDATE survey_answer
                SET dateCompleted=NOW()
                WHERE surveyId=".$conn->quote($_POST['surveyId'])
                . "AND username=".$conn->quote($_SESSION['Username']);
        $update=$conn->exec($update);
        if($update)
        {
          $conn->commit();
          $success['success']=true;
          // $success['surveyAnswerId']=$conn->lastInsertId();

        }else{
          $conn->rollback();
          $success['success']=false;
          // $success['surveyAnswerId']=$conn->lastInsertId();
        }
      }else{
        $conn->commit();
        $success['success']=true;
        $success['surveyAnswerId']=$conn->lastInsertId();
      }


    }else{
      $conn->rollback();
      $success['success']=false;
      $success['error']="An error occured. Please, try again later";
    }
    echo json_encode($success);
  }else{
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";



    foreach ($answer as $key => $value) {
      $update=" UPDATE  survey_answer
                SET answer=  ".$conn->quote($answer[$key])
                ."WHERE question=".$conn->quote($question[$key])
                ." AND surveyId=".$conn->quote($_POST['surveyId'])
                ." AND username=".$conn->quote($_SESSION['Username'])
                ." AND pageNo=".$conn->quote($_POST['pageNo']);
                // ." AND  surveyAnswerId=".$conn->quote($_POST["surveyAnswerId"]);

      $update=$conn->exec($update);
      if($update)
      {
        $success['success']=true;
        // $success['surveyAnswerId']=$conn->lastInsertId();

      }else{
        $success['success']=false;
        // $success['surveyAnswerId']=$conn->lastInsertId();
      }
    }

    echo json_encode($success);

  }




 ?>
