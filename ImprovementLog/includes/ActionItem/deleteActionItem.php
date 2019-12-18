<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: index.php");
}
$error=array();

if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE actionitem
            SET deleted=1
            WHERE actionItemId=".$_POST['actionItemId'];
  $conn->beginTransaction();
  $result=$conn->exec($update);

  if($result !== FALSE)
  {// if update was Successful
    $select = " SELECT painPoint
                FROM actionitem
                WHERE actionItemId =".$_POST['actionItemId'];
    $select = $conn->query($select);
    $select=$select->fetch(PDO::FETCH_ASSOC);

    if($select){
      $painPointToRemove=addslashes($select['painPoint']);
      echo $painPointToRemove;
      $update="UPDATE imp_rec
                SET
                    actionItem=
                    IF(
                        LENGTH(actionItem) = LENGTH('|".$painPointToRemove."|'),
                    REPLACE
                        (actionItem, '|".$painPointToRemove."|', ''),
                    REPLACE
                        (actionItem, '".$painPointToRemove."|', '')
                    )
                WHERE
                    actionItem LIKE '%|".$painPointToRemove."|%'
                ";
      echo $update;
      $update=$conn->exec($update);

      if($update !== FALSE){
        $conn->commit();
        $error['success']=true;
        $error['result']='Delete Success';
        echo json_encode($error,JSON_PRETTY_PRINT);
      }
      else{
        $conn->rollBack();
        $error['success']=false;
        $error['result']='An error occured. Please try again later.';
        echo json_encode($error,JSON_PRETTY_PRINT);
        exit();
      }
    }
    else
    {
      $conn->rollBack();
      $error['success']=false;
      $error['result']='An error occured. Please try again later.';
      echo json_encode($error,JSON_PRETTY_PRINT);
      exit();
    }
  }
  else
  {
    $conn->rollBack();
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
    echo json_encode($error,JSON_PRETTY_PRINT);
    exit();
  }


}

 ?>
