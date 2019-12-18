<?php
session_start();

  if($_POST){
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    include '../db_connect.php';
    $success=array();
    $error=array();

    foreach ($_POST as $key => $value) {
      if(empty($_POST[$key]))
      {
        $error[$key]="This field cannot be left blank";
      }
      else{
        // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
        if(!is_array($_POST[$key]))
        {
            // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
            $_POST[$key]=strip_tags($_POST[$key]);
            $_POST[$key] =trim($_POST[$key]);
            $_POST[$key]=str_replace('|'," ",$_POST[$key]);
            $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
            $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
            $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }

      }
    }

    if(empty($error))
    {
      if(isset($_POST['drpCycle']) ){
        if(!is_numeric($_POST['drpCycle'])){
          $insertRadCycle="INSERT INTO cycle (cycleName) VALUES ( ".$conn->quote($_POST['drpCycle'])." )";
          $insertRadCycle=$conn->exec($insertRadCycle);
          if($insertRadCycle !== FALSE)
          {
            $_POST['radCycle']=$conn->lastInsertId();
          }else{
            $success['success']=false;
            $success['result']="An error occured.Try again later ";
            $conn->rollBack();
            echo json_encode($success) ;
            exit();
          }
        }else{
          $_POST['radCycle']=$_POST['drpCycle'];
        }


      }
      $insertTemplate="INSERT INTO template(templateName,cycleId,createdBy)
               VALUES("
                 .$conn->quote($_POST['txtTemplateName'])
                 .","
                 .$conn->quote($_POST['radCycle'])
                 .","
                 .$conn->quote($_SESSION['Username'])
                 .")";

      $conn->beginTransaction();
      $insertTemplate=$conn->exec($insertTemplate);

      if($insertTemplate !== FALSE)
      {
        $id=$conn->lastInsertId();
        $_POST['drpQuestion'] =explode(",",$_POST['drpQuestion'] );
          $_POST['pageNo'] =explode(",",$_POST['pageNo'] );

        $insertTemplateQuestion="INSERT INTO question_template(templateId,pageNo,questionNo,questionId) VALUES";
        $pageNo=0;
        $questionNo=1;
        foreach ($_POST['pageNo'] as $keyPage => $value)
        {

          for ($i=0; $i <$value ; $i++)
          {
            $insertTemplateQuestion.= " ("
                                          .$id
                                          .","
                                          .$keyPage
                                          .","
                                          .$questionNo
                                          .","
                                          .$_POST['drpQuestion'][$pageNo]
                                          ."),";
            $pageNo++;
            $questionNo++;
          }


        }


        $insertTemplateQuestion=rtrim($insertTemplateQuestion,',');
        // echo $insertTemplateQuestion;
        $insertTemplateQuestion=$conn->exec($insertTemplateQuestion);

        if($insertTemplateQuestion !== FALSE)
        {
          // echo "Successful";


            $success['success']=true;
            $success['result']="Template added successfully ";
            $conn->commit();
            echo json_encode($success) ;

        }
        else {
          $success['success']=false;
          $success['result']="An error occured.Try again later ";

          $conn->rollBack();
          echo json_encode($success) ;
          exit();
        }

      }
      else{
        $success['success']=false;
        $success['result']="An error occured.Try again later ";
        $conn->rollBack();
        echo json_encode($success) ;
        exit();
      }

    }else{
      $success['success']=false;
      $success['result']=$error;
      echo json_encode($success) ;
    }

}// end of $_POST

?>
