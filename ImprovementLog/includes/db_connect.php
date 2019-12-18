<?php

$server_name = "localhost";
$user_name = "il_admin";
$password = "il_passwd";
$db_name = "improvementlog";
//$conn = mysqli_connect($server_name ,$user_name,$password , $db_name);
try
{
 $conn = new PDO("mysql:host=$server_name;dbname=$db_name;port=3307;", $user_name, $password);
}
catch(PDOException $e)
 {

    echo  "<br>" . $e->getMessage();
    die();
 }


 $server_name2 = "localhost";
 $user_name2 = "cf_admin";
 $password2 = "cf_passwd";
 $db_name2 = "customerfeedback";
 //$conn = mysqli_connect($server_name ,$user_name,$password , $db_name);
 try
 {
  $conn2 = new PDO("mysql:host=$server_name2;dbname=$db_name2;port=3307", $user_name2, $password2);
  // $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user_name, $password);

 }
 catch(PDOException $e)
  {

     echo  "<br>" . $e->getMessage();
     die();
  }


?>
