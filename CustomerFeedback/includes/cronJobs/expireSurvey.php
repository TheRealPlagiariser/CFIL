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



$FindExpiredSurvey="UPDATE
                        survey
                    SET
                        expired = 1,lastModified=NOW()
                    WHERE
                        expired = 0 AND surveyId IN(
                        SELECT
                            survey_user.surveyId
                        FROM
                            survey_user
                        WHERE
                            survey.surveyId = survey_user.surveyId AND DATEDIFF( (SELECT MAX(dateExpired) FROM survey_user WHERE survey_user.surveyId = survey.surveyId) , CURDATE()) < 0)";



  if($conn->exec($FindExpiredSurvey))
  { /////////////////////////////// START OF SEND MAIL
    echo "successful";

    $sqlSelect = "SELECT * FROM survey WHERE expired = 1 AND lastModified = CURDATE()";



    $success = array();
    $sqlSelect = $conn->query($sqlSelect);
    while($row=$sqlSelect->fetch())
    {
      $to = $row['email'];
      echo "email is : " .$to;
      $subject = "Expiry of Survey ".$row["surveyName"];
      $body = "Dear ".$row['createdBy'].",\n\nYour created survey has expired. If you would like to get the analytics for your survey, kindly use google chrome browser to access the url https://".$dns."/TestingServices/CustomerFeedback/analytics.php and select Survey : " .$row["surveyName"].".\n\nKind Regards,\nIT Testing Services" ;

      $headers = "From: IT Testing Services";
      $mail = mail($to, $subject , $body, $headers);

      if(!$mail)
      {
        $error[]="An error occured while sending mail to ".$row['createdBy'].". Please, try again later";
      }

      else{
        $success[] = $row['surveyId'];
      }
    }


  }///////// ---------------------------------- END OF SEND MAIL
  else{
    echo "not Succeessful";
  }






?>
