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
              WHERE survey_user.sent=1
              AND survey.deleted=0
              AND survey_user.dateSent<=CURDATE()
			        AND DATEDIFF(dateExpired, CURDATE()) <= (SELECT numDaysForReminderMail FROM config)
              AND dateExpired IS NOT NULL
              AND reminderMail=0";
$k=$selectUSers;
$time="SELECT timeOfExpiry FROM config";
$time=$conn->query($time);
$time=$time->fetch(PDO::FETCH_ASSOC);
$time=$time["timeOfExpiry"];
$success=array();
$selectUSers=$conn->query($selectUSers);
while($row=$selectUSers->fetch())
{

  $to = $row['email'];
  $subject = "Reminder : Customer Feedback for  project - ".$row["projectName"] ;
  $body = "Please Note that this survey expires on ".$row['dateExpired']." \nPlease respond to survey below : \n ".$row['surveyUrl'] ;


  $body = "Dear ".$row['fullName'].",\n\nPlease note that the survey for project ".$row["projectName"]." expires on ".$row['dateExpired']." at ".$time.".\n\nTo participate or complete the survey, kindly use google chrome to access the following url : \n\n ".$row['surveyUrl']."\n\n Regards, \n\nIT Testing Services\n\n";


  $headers = "From: IT Testing Services";
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
$k=$conn->query($k);
$k=$k->fetchall(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($k);
echo "</pre>";

if(empty($error) && !empty($success))
{
  $update=" UPDATE survey_user
            SET reminderMail=1,lastModified=NOW()
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
