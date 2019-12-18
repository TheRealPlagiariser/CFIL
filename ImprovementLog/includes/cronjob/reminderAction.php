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


$selectUSers="SELECT  actionitem.*
              FROM actionitem
              WHERE reminderMail=0
              AND deleted=0
              AND status!='CPL'
              AND DATEDIFF(tentativeCompletionDate , CURDATE())<=5";

$success=array();
$selectUSers=$conn->query($selectUSers);
while($row=$selectUSers->fetch())
{

  $to = $row['email'];
  $subject = "Reminder ".$row["painPoint"] ;
  $body = "Dear ".$row['owner'].",\n\nTake note that the following action item,' ".$row['painPoint']."', exists in the system under your name and is supposed to be acted upon within 5 days as from today.
            \nPlease do the needful.\n\nKindly use google chrome web browser to access Improvement Log url https://".$dns."/TestingServices/ImprovementLog/  .
            \nKind Regards,\nIT Testing Services";

  $headers = "From: IT Testing Services";
  $mail= mail($to,$subject,$body,$headers);

  if(!$mail)
  {
    $error[]="An error occured while sending mail to ".$row['fullName'].". Please, try again later";
  }
  else{
      $success[]=$row['actionItemId'];


  }

}


if(empty($error) && !empty($success))
{
  $id="'".implode("','",$success)."'";
  $update=" UPDATE actionitem
            SET reminderMail=1,dateModified=NOW()
            WHERE actionitemId IN (".$id .")";

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
