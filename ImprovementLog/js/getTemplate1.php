<?php

if(isset($_POST)){


  include '../db_connect.php';
  $select=" SELECT *
            FROM template
            
            ORDER BY templateId DESC";
  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);
  echo json_encode($select,JSON_PRETTY_PRINT);
}






 ?>
