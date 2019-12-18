<?php
  session_start();
  if($_POST){

    include '../db_connect.php';
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $error=array();
    if(empty($_POST['date']))
    {
      $_POST['date']=date("Y-m-d");
    }
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
          $_POST[$key]=str_replace('|'," ",$_POST[$key]);
          $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
          $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }

      }
    }
    // echo "<pre>";
    // print_r($error);
    // echo "</pre>";
    if(empty($error))
    {


        $insertSurvey="INSERT INTO survey(projectId,templateId,surveyName,createdBy,email)
                       VALUES(".
                          $conn->quote($_POST['drpProject'])
                          .","
                          .$conn->quote($_POST['drpTemplate'])
                          .","
                          .$conn->quote($_POST['txtSurveyName'])
                          .","
                          .$conn->quote($_SESSION['Username'])
                          .","
                          .$conn->quote($_SESSION['Email'])
                          .")";

        $conn->beginTransaction();
        $insertSurvey=$conn->exec($insertSurvey);
        if($insertSurvey)
        {
          $id=$conn->lastInsertId();
          $selectBaseUrl="SELECT dns
                          FROM config";

                          // echo $selectBaseUrl;
          $selectBaseUrl=$conn->query($selectBaseUrl);
          $selectBaseUrl=$selectBaseUrl->fetch(PDO::FETCH_ASSOC);

          $id1=md5($id);






          $insertUser="INSERT INTO survey_user(surveyId,username,fullName,email,surveyUrl,hashSurveyId,hashUsername)
                         VALUES ";
           foreach ($_POST['txtUsername'] as $key => $value)
           {
              $hashUsername=md5($value);
              $url="https://".$selectBaseUrl['dns']."/TestingServices/CustomerFeedBack/User/respondSurvey.php";


              $surveyURL=$url."?surveyId=".$id1."&username=".$hashUsername;
              // $surveyURL=$selectBaseUrl['surveyURLBase']."?surveyId=".$id1."&username=".$hashUsername;
               $insertUser.=" ("
                              .$id
                              .","
                              .$conn->quote($value)
                              .","
                              .$conn->quote($_POST['txtFullName'][$key])
                              .","
                              .$conn->quote($_POST['txtEmail'][$key])
                              .","
                              .$conn->quote($surveyURL)
                              .","
                              .$conn->quote($id1)
                              .","
                              .$conn->quote($hashUsername)

                              ."),";
           }
           $insertUser=rtrim($insertUser,',');
           // echo $insertUser;

           $insertUser=$conn->exec($insertUser);
           if($insertUser)
           {
              $result['success']=true;
              $result['surveyId']=$id;
             $conn->commit();
           }
           else {
               $result['success']=false;
               $conn->rollback();
           }

        }
        else{
              $result['success']=false;
          $conn->rollback();
        }
        echo json_encode($result);
    }

  }

?>
