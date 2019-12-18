<?php
include '../db_connect.php';
$error=array();
if(isset($_POST)){

  $select ="SELECT *
            FROM imp_rec_description
            WHERE rec_descriptionId=".$_POST['id'];


  $select=$conn->query($select);
  $select=$select->fetchAll(PDO::FETCH_ASSOC);
  if($select){
    $error['success']=true;
    $error['result']=$select;
  }else{
    $error['success']=false;
    $error['result']='NOT Successfully Inserted';
  }
  echo json_encode($error,JSON_PRETTY_PRINT);
}






 ?>
