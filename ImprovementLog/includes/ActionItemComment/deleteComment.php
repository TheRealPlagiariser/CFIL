<?php
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE actioncomments
            SET deleted=1
            WHERE commentId=".$_POST['commentId'];

  $result=$conn->exec($update);

  if($result)
  {
    $error['success']=true;
    $error['result']='Delete Success.';
    echo json_encode($error,JSON_PRETTY_PRINT);
  }
  else
  {
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
    echo json_encode($error,JSON_PRETTY_PRINT);
  }


}




 ?>
