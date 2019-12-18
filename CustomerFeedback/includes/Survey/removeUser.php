<?php
  // echo "<pre>" ; print_r($_POST) ;echo "</pre>";
if ($_POST) {
      include '../db_connect.php';
      $_POST['username'] = "'" . implode ( "', '", $_POST['username'] ) . "'";
      $del="DELETE FROM survey_user
            WHERE surveyId=".$conn->quote($_POST['surveyId'])."
            AND username IN (".$_POST['username'].")";
echo $del;
  if($conn->exec($del))
  {
    echo "Success";
  }
  else{
    echo "erro occured";
  }
}





 ?>
