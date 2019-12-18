<?php
session_start();


if($_POST){
  include '../db_connect.php';

  $error=array();
  $arrSuccess=array();
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later.";
  foreach ($_POST as $key => $value) {
    if(empty($_POST[$key]))
    {
      $error[$key]= $key  ." This field cannot be left blank 1";
    }else{
      // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
      if(!is_array($_POST[$key]))
      {
          $_POST[$key]=strip_tags($_POST[$key]);
          $_POST[$key] =trim($_POST[$key]);
          $_POST[$key]=str_replace('|'," ",$_POST[$key]);
          $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
          $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));

      }

    }
  } //endfor
// print_r($_POST);
  if(isset($_POST['possibleAnswer']))
  {
    foreach ($_POST['possibleAnswer'] as $key => $value) {

      if(empty($_POST['possibleAnswer'][$key]))
      {
        if($_POST['possibleAnswer'][$key]==0)
        {
          $_POST['possibleAnswer'][$key]=strip_tags($_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key] =trim($_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key]=str_replace('|'," ",$_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key]=preg_replace('/[\n\r]+/',"\n",$_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key] = preg_replace('/\n/', "<br/>", $_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key] =trim( preg_replace('/[\s]+/', ' ', $_POST['possibleAnswer'][$key]));
          continue;
        }
        $error["possibleAnswer"]= $key . " This field cannot be left blank 2";
      }else{
        //$_POST['possibleAnswer'][$key]=preg_replace('/\s+/', ' ',   $_POST['possibleAnswer'][$key]);
          // $_POST['possibleAnswer'][$key] =trim( preg_replace('/[\s]+/', ' ', $_POST['possibleAnswer'][$key]));
          $_POST['possibleAnswer'][$key]=strip_tags($_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key] =trim($_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key]=str_replace('|'," ",$_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key]=preg_replace('/[\n\r]+/',"\n",$_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key] = preg_replace('/\n/', "<br/>", $_POST['possibleAnswer'][$key]);
          $_POST['possibleAnswer'][$key] =trim( preg_replace('/[\s]+/', ' ', $_POST['possibleAnswer'][$key]));
      }
    }
  }


  $conn->beginTransaction();
  $success=false;
  if(isset($_POST['txaQuestion'])){
    $updateQuestion=" UPDATE question
                      SET question=".$conn->quote($_POST['txaQuestion'])."
                      WHERE questionId=".$conn->quote($_POST['questionId']);
                      // echo $updateQuestion;
    $updateQuestion =$conn->exec($updateQuestion);
    if($updateQuestion === FALSE){
        $conn->rollBack();
        echo json_encode($arrSuccess);
        exit();
    }else{
      $success=true;
    }
  }

  //error during editing of question


  if(isset($_POST['possibleAnswer'])){
    $more=true;
    $del="DELETE FROM question_possible_answer
          WHERE  questionId=".$conn->quote($_POST['questionId']);
          // echo $del;
    $del =$conn->exec($del);
    if($del !== FALSE)
    {
      if($_POST['drpAnswerType']=='2')
      {
        sort($_POST['possibleAnswer']);
        $lowerbound=$_POST['possibleAnswer'][0];
        $upperBound=$_POST['possibleAnswer'][1];
        unset($_POST['possibleAnswer']);
        for ($i=$lowerbound; $i<=$upperBound  ; $i++) {
          $_POST['possibleAnswer'][]=$i;
        }
      }

      $insertQuestionPossibleAnswer="INSERT INTO question_possible_answer(questionId,possibleAnswer) VALUES";
      foreach ($_POST['possibleAnswer'] as $key => $value)
       {
         $insertQuestionPossibleAnswer.= " ("
                                        .$conn->quote($_POST['questionId'])
                                        .","
                                        .$conn->quote($value)
                                        ."),";
      }
      $insertQuestionPossibleAnswer=rtrim($insertQuestionPossibleAnswer,',');
      // echo $insertQuestionPossibleAnswer;
      $insertQuestionPossibleAnswer=$conn->exec($insertQuestionPossibleAnswer);
      if($insertQuestionPossibleAnswer === FALSE)
      {
        $conn->rollBack();
        echo json_encode($arrSuccess);
        exit();
      }else{
          $success=true;

      }
    }else{
      //problem with deleting
      $conn->rollBack();
        echo json_encode($arrSuccess);
      exit();
    }
  }


  if((isset($_POST["txtLeftLabel"]) || isset($_POST["txtRightLabel"])))
  {
    $label="";
    if(isset($_POST["txtLeftLabel"]) )
    {
      $label.=" leftLabel = ".$conn->quote($_POST["txtLeftLabel"])." , ";
    }

    if(isset($_POST["txtRightLabel"]))
    {
      $label.=" rightLabel = ".$conn->quote($_POST["txtRightLabel"])." , ";
    }
    $label=rtrim($label," , ");
    $more=true;
    $updateLabel="UPDATE scale_label
                      SET ".$label
                      ." WHERE questionId=".$conn->quote($_POST['questionId']);



                      // echo $updateLabel;
    $updateLabel =$conn->exec($updateLabel);
    if($updateLabel === FALSE)
    {
      $conn->rollBack();
      echo json_encode($arrSuccess);
      exit();
    }else{
        $success=true;

    }

  }

  if($success==true)
  {
    $arrSuccess['success']=true;
    $arrSuccess['result']="Update was successful";
    $conn->commit();
    echo json_encode($arrSuccess);
  }








}

 ?>
