<?php
// testing sql queries
if(isset($_POST)){


  include 'includes/db_connect.php';


  $select=" SELECT *, CONCAT(possibleAnswer,' ')
            FROM question_possible_answer WHERE questionId= 42 ";




  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);
  echo "<pre>";
  echo json_encode($select,JSON_PRETTY_PRINT);
  echo "</pre>";
}






 ?>
