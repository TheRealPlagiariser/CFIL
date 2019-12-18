<?php
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE imp_rec_comment
            SET deleted=1
            WHERE commentId=".$_POST['commentId'];

  $result=$conn->exec($update);

  if($result)
  {
    echo "Successful";
  }
  else
  {
    echo "Unsuccessful";
  }


}




 ?>
