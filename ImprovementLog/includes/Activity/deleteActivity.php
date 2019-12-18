<?php
//called from activity.php (AJAX)
  if($_POST)
  {
    $error=array();
    include '../db_connect.php';
    $update=" UPDATE activity
              SET deleted=1
              WHERE activityId=".$_POST['activityId'];

    $result=$conn->exec($update);

    if($result !==FALSE)
    {
      $error['success']=true;
      $error['result']='Delete Success.';
      echo json_encode($error,JSON_PRETTY_PRINT);
    }
    else
    {
      $error['success']=false;
      $error['result']='An error ocured. Please try again later.';
      echo json_encode($error,JSON_PRETTY_PRINT);
    }
  }
 ?>
