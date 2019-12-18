<?php
  session_start();

  if(!isset($_SESSION['Username']))
  {
    header("Location: index.php");
  }else{
    $user=$_SESSION['Username'];
  }
  //echo $user;
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";


    if($_POST){
      include '../db_connect.php';
      $error=array();

      foreach ($_POST as $key => $value) {


        if(empty($_POST[$key]))
        {
          if($_POST[$key]==0)
          {
            $_POST[$key]=strip_tags($_POST[$key]);
            $_POST[$key] =trim($_POST[$key]);
            $_POST[$key]=str_replace('|'," ",$_POST[$key]);
            $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
            $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
            $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
            continue;
          }
          $error[$key]= $key  ." This field cannot be left blank 1";
        }else{
          // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
          if(!is_array($_POST[$key]))
          {
            $_POST[$key]=strip_tags($_POST[$key]);
            $_POST[$key] =trim($_POST[$key]);
            $_POST[$key]=str_replace('|'," ",$_POST[$key]);
            $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
            $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
            $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
          }

        }
      }


      //check if choices are not empty
      if(isset($_POST['possibleAnswer']))
      {
        foreach ($_POST['possibleAnswer'] as $key => $value) {

          if(empty($_POST['possibleAnswer'][$key]) )
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

        //check if choices is uniques
        if(count($_POST['possibleAnswer'] ) != count(array_unique($_POST['possibleAnswer'] ))){
          $error["possibleAnswer"]= " No duplicate value for choice";
        }
      }


      $arrSuccess=array();

      if(empty($error))
      {

        $insertQuestion="INSERT INTO question(question,questionTypeId, createdBy)
                 VALUES("
                   .$conn->quote($_POST['txaQuestion'])
                   .","
                   .$_POST['drpAnswerType']
                   .","
                   .$conn->quote($user)
                   .")";
        // echo $insertQuestion."\t";
        $conn->beginTransaction();
        $resultQuestion=$conn->exec($insertQuestion);

        if($resultQuestion !== FALSE)
        {
          if (isset($_POST['possibleAnswer'])){
            $id=$conn->lastInsertId();
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
                                              .$id
                                              .","
                                              .$conn->quote($value)
                                              ."),";
            }
            $insertQuestionPossibleAnswer=rtrim($insertQuestionPossibleAnswer,',');
             // echo $insertQuestionPossibleAnswer;
            $insertQuestionPossibleAnswer=$conn->exec($insertQuestionPossibleAnswer);
            if($insertQuestionPossibleAnswer !== FALSE)
            {
              if((isset($_POST["txtLeftLabel"]) && isset($_POST["txtRightLabel"])) &&
                    (($_POST["txtLeftLabel"] !="") && ($_POST["txtRightLabel"] !="")))
              {
                $insertScaleLabel="INSERT INTO scale_label(questionId,leftLabel, rightLabel)
                         VALUES("
                           .$id
                           .","
                           .$conn->quote($_POST['txtLeftLabel'])
                           .","
                           .$conn->quote($_POST['txtRightLabel'])
                           .")";
                // echo $insertQuestion;

                $resultScaleLabel=$conn->exec($insertScaleLabel);

                if($resultScaleLabel !== FALSE)
                {
                  $arrSuccess['success']=true;
                  $arrSuccess['result']="Question added Successful";
                  $conn->commit();

                }
                else
                {
                  $arrSuccess['success']=false;
                  $arrSuccess['result']="An error occured. Try again later.";

                  $conn->rollBack();
                  echo json_encode($arrSuccess);
                  exit();
                }
              }
              else
              {
                $arrSuccess['success']=true;
                $arrSuccess['result']="Question added Successful";
                $conn->commit();
              }

            }
            else {
              $arrSuccess['success']=false;
              $arrSuccess['result']="An error occured. Try again later.";
              $conn->rollBack();
              echo json_encode($arrSuccess);
              exit();
            }
          }
          else{
            $arrSuccess['success']=true;
            $arrSuccess['result']="Question added Successful";
            $conn->commit();
          }

        }
        else
        {
          $arrSuccess['success']=false;
          $arrSuccess['result']="An error occured. Try again later.";
          $conn->rollBack();
          echo json_encode($arrSuccess);
          exit();
        }

      }
      else{
        $arrSuccess['success']=false;
        $arrSuccess['result']=$error;
      }
      echo json_encode($arrSuccess);
    }


?>
