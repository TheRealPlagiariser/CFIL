<?php
$server_name = "localhost";
$user_name = "il_admin";
$password = "il_passwd";
$db_name = "improvementlog";
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

  $selectUSers="SELECT
                    i.rec_descriptionId id,
                    project.projectName,
                    i.loggedBy,
                    i.email,
                    DATE_FORMAT(i.dateModified, '%a, %D %M %Y') dateMode,
                    DATE_FORMAT(i.endDate, '%a, %D %M %Y') dateSpecified,
                    DATE_FORMAT(i.endDate, '%H:%i %p') timeSpecified
                FROM
                    imp_rec_description i
                JOIN imp_rec USING(recid)
                JOIN customerfeedback.project USING(projectId)
                JOIN activity USING(activityId)
                WHERE
                    i.deleted = 0 AND i.endDate IS NOT NULL
                AND
                    DATE(startDate+ INTERVAL (DATEDIFF(endDate ,startDate)/2) DAY) = CURDATE()";


$success=array();
$selectUSers=$conn->query($selectUSers);
while($row=$selectUSers->fetch())
{

  $to = $row['email'];
  $subject = "Reminder For Improvement Log record ".$row["projectName"] ;
  $body = "Dear ".$row['loggedBy'].",
            \nIf you have not already acted upon the improvement record you logged on ".$row['dateMode'].", please take the necessary actions.\nAlso, note that the issue end date is: ".$row['dateSpecified']." at ".$row['timeSpecified'].".\n\nKindly use google chrome browser to access the Improvement Log url https://".$dns."/TestingServices/ImprovementLog/  .
            \nKind Regards, \nIT Testing Services"
            ;

  $headers = "From: IT Testing Services";
  $mail= mail($to,$subject,$body,$headers);

  if(!$mail)
  {
    $error[]="An error occured while sending mail to ".$row['loggedBy'].". Please, try again later";
  }
  else{
      $success[]=$row['id'];
  }

}


if(empty($error) && !empty($success))
{
  $id="'".implode("','",$success)."'";
  $update=" UPDATE actionitem
            SET reminderMail=1,dateModified=NOW()
            WHERE actionitemId IN (".$id.")";

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
