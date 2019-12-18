<?php
// echo "<pre>" ; print_r($_POST) ;echo "</pre>";
include '../db_connect.php';

$id1=md5($_POST['surveyId']);
$selectBaseUrl="SELECT dns
                FROM config";

                // echo $selectBaseUrl;
$selectBaseUrl=$conn->query($selectBaseUrl);
$selectBaseUrl=$selectBaseUrl->fetch(PDO::FETCH_ASSOC);
$insertUser="INSERT INTO survey_user(surveyId,username,fullName,email,surveyUrl,hashSurveyId,hashUsername)
               VALUES ";
 foreach ($_POST['txtUsername'] as $key => $value)
 {
   $hashUsername=md5($value);

   $url="https://".$selectBaseUrl['dns']."/TestingServices/CustomerFeedBack/User/respondSurvey.php";


   $surveyURL=$url."?surveyId=".$id1."&username=".$hashUsername;
   // $surveyURL=$selectBaseUrl['surveyURLBase']."?surveyId=".$id1."&username=".$hashUsername;
     $insertUser.=" ("
                    .$conn->quote($_POST['surveyId'])
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
    $result['surveyId']="successful";

 }
 else {
     $result['success']=false;

 }

echo json_encode($result)



 ?>
