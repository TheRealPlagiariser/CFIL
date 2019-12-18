<?php

$server_name = "localhost";
$user_name = "cf_admin";
$password = "cf_passwd";
$db_name = "customerfeedback";
//$conn = mysqli_connect($server_name ,$user_name,$password , $db_name);
try
{
 $conn = new PDO("mysql:host=$server_name;dbname=$db_name;port=3307", $user_name, $password);
 // $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user_name, $password);

}
catch(PDOException $e)
 {

    echo  "<br>" . $e->getMessage();
    die();
 }



?>
