<?php
$server_name = "localhost";
$user_name = "cf_admin";
$password = "cf_passwd";
$db_name = "customerfeedback";
//$conn = mysqli_connect($server_name ,$user_name,$password , $db_name);
try
{
 $conn = new PDO("mysql:host=$server_name;dbname=$db_name;port=3307", $user_name, $password);
}
catch(PDOException $e)
 {

    echo  "<br>" . $e->getMessage();
    die();
 }

 $findDns = "SELECT dns FROM config";

 $queryDns = $conn->query($findDns);
 while($row4 = $queryDns->fetch())
 {
   $dns = $row4['dns'];
 }

$selectUSers="SELECT  survey_user.username,
                      survey_user.fullName,
                      survey_user.email,
                      cycle.cycleName,
                      survey_user.surveyId,
                      survey_user.surveyUrl,
                      survey_user.dateExpired,
                      CONCAT(project.projectCode,' - ',project.projectName)as projectName
              FROM survey_user
              JOIN survey USING(surveyId)
              JOIN template USING(templateId)
              JOIN cycle USING(cycleId)
              JOIN project USING(projectId)
              WHERE survey_user.sent=0
              AND survey.deleted=0
              AND survey_user.dateSent<=CURDATE()
              ";
$time="SELECT timeOfExpiry FROM config";
$time=$conn->query($time);
$time=$time->fetch(PDO::FETCH_ASSOC);
$time=$time['timeOfExpiry'];

$success=array();
$selectUSers=$conn->query($selectUSers);
while($row=$selectUSers->fetch())
{

  $to = $row['email'];
  $subject = "Customer Feedback for  - ".$row["projectName"];
  $body="Dear ".$row['fullName'].",\n\nTo improve quality of our service, we are conducting our among our customer feedback survey to assess the level of satisfaction.\n\n In this respect, we would appreciate if you can share your feedback with us by clicking on the following web link to fill out a short online questionnaire.\n\n".$row['surveyUrl']."\n\nPlease note that the survey will be open until ".$row['dateExpired']." at ".$time.".\n\nThank you in advance for your time and participation.\n\nKindly use google chrome browser to access the Customer Feedback url http://".$dns."/TestingServices/CustomerFeedback/\n\nKind Regards,\nIT Testing Services";
   $headers = "From: IT Testing Services;";
   $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $mail= mail($to,$subject,$body,$headers);

  if(!$mail)
  {
    $error[]="An error occured while sending mail to ".$row['fullName'].". Please, try again later";
  }
  else{
    $temp["surveyId"]=$row['surveyId'];

    $temp["email"]=$row['email'];
      $success[]=$temp;


  }

}


if(empty($error) && !empty($success))
{
  $update=" UPDATE survey_user
            SET sent=1,lastModified=NOW()
            WHERE";
            $where="";
  foreach ($success as $key => $value) {

      $where.=" (surveyId=".$conn->quote($value['surveyId'])." AND email = ".$conn->quote($value['email']).") OR ";
  }

  $where=rtrim($where," OR ");
$update.=$where;
// echo $update;
  $update=$conn->exec($update);
  if($update)
  {
    echo "successful";
  }
  else{
    echo "not Succeessful";
  }

}




?>
