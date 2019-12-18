<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
include "../db_connect.php";

$error=array();
foreach ($_POST as $key => $value) {
  if(empty($_POST[$key]))
  {
    $error[$key]="This field cannot be empty";
  }else{
    // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
    if(!is_array($_POST[$key]))
    {
        // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key]=str_replace('|'," ",$_POST[$key]);
        $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
        $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
    }

  }
}
$arrSuccess=array();
if(!empty($error))
{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";
  echo json_encode($arrSuccess);
  exit();
}

$code="";

$update="UPDATE config
         SET numPageAllowed=".$conn->quote($_POST['txtNumPage']);

$cycleTe="'".implode("','",$_POST['cycleAvailable'])."'";
$cycle="UPDATE cycle
        SET display=0";
$conn->beginTransaction();

$cycle=$conn->exec($cycle);
if($cycle===FALSE)
{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";
  $conn->rollback();
    echo json_encode($arrSuccess);
    exit();
}
$cycle="UPDATE cycle
        SET display=1
        WHERE cycleId IN (".$cycleTe.")";


// echo $update;

$update=$conn->exec($update);
$cycle=$conn->exec($cycle);
if($update !== FALSE && $cycle !== FALSE)
{
  $arrSuccess['success']=true;
  $arrSuccess['result']=" Update Successful";

  $selectConfig= "SELECT * FROM config";
  $selectConfig=$conn->query($selectConfig);
  $selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);
  $selectcycle= "SELECT * FROM cycle";
  $selectcycle=$conn->query($selectcycle);
  $selectcycle=$selectcycle->fetchALL(PDO::FETCH_ASSOC);

  $arrSuccess['cycle']=$selectcycle;

  $arrSuccess['config']=$selectConfig;
  $conn->commit();

  //  header("location:../../project.php");
}
else{
  $arrSuccess['success']=false;
  $arrSuccess['result']="An error occured. Try again later";
  $conn->rollback();

}


  echo json_encode($arrSuccess);



 ?>
