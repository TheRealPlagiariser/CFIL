<?php
session_start();

  if($_POST){
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
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
    if(!empty($error))
    {
      die();
    }

    include '../db_connect.php';
      $template="";
      $conn->beginTransaction();
      if(isset($_POST['drpCycle']) )
      {
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

      if(isset($_POST["txtTemplateName"]))
      {
        $template.=" templateName = ".$conn->quote($_POST["txtTemplateName"])." , ";
      }

      if(isset($_POST["radCycle"]))
      {
        $template.=" cycleId = ".$conn->quote($_POST["radCycle"])." , ";
      }



      if(isset($_POST["txtTemplateName"]) || isset($_POST["radCycle"]) )
      {
        $template=rtrim($template," , ");
        $updateTemplate=" UPDATE template
                          SET ".$template."
                           WHERE templateId =".$conn->quote($_POST["templateId"]);

        // echo $updateTemplate;


        $updateTemplate=$conn->exec($updateTemplate);
        if($updateTemplate === FALSE)
        {
          $success['success']=false;
          $success['result']="An error occured.Try again later ";
          $conn->rollBack();
          echo json_encode($success) ;
          exit();
        }
        // $updateTemplate=true;

      }

      // if updating template name or cycle is unsuccessfull, rollback here itself and stop the script


      if(isset($_POST['drpQuestion']))
      {

        $del="DELETE FROM question_template
        WHERE templateId=".$conn->quote($_POST["templateId"]);

        $_POST['drpQuestion'] =explode(",",$_POST['drpQuestion'] );
        $_POST['pageNo'] =explode(",",$_POST['pageNo'] );

        $del=$conn->exec($del);
        if($del !== FALSE)
        {
          $pageNo=0;
          $questionNo=1;
          $updateTemplateQuestion="INSERT INTO  question_template(templateId,pageNo,questionNo,questionId) VALUES";
          foreach ($_POST['pageNo'] as $keyPage => $value)
          {
            for ($i=0; $i <$value ; $i++)
            {
              $updateTemplateQuestion.= " ("
                                            .$conn->quote($_POST["templateId"])
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


          $updateTemplateQuestion=rtrim($updateTemplateQuestion,',');
          // echo $updateTemplateQuestion;
          $updateTemplateQuestion=$conn->exec($updateTemplateQuestion);

          if($updateTemplateQuestion !== FALSE)
          {
              //everything was a success
              $success['success']=true;
              $success['result']="Template upadated successfully 111";
              $conn->commit();
              echo json_encode($success) ;

          }
          else {
              //Error occured during reinserting

                $success['success']=false;
                $success['result']="An error occured.Try again later ";
                $conn->rollBack();
                echo json_encode($success) ;
                exit();

          }

        }
        else{
          //Error occured during deleting
          $success['success']=false;
          $success['result']="An error occured.Try again later ";
          $conn->rollBack();
          echo json_encode($success) ;
          exit();

        }
      }
      else {
        $success['success']=true;
        $success['result']="Template upadated successfully 112 ";
        $conn->commit();
        echo json_encode($success) ;
      }



  }

?>
