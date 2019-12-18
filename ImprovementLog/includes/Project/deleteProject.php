<?php
//called from project.php (AJAX)
if($_POST)
{
  include '../db_connect.php';
  $update=" UPDATE project
            SET deleted=1
            WHERE projectId=".$_POST['projectId'];

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
