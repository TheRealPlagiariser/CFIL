<?php

if(isset($_POST)){

  if (isset($from) && $from="qa.php")
  {
    include 'includes/db_connect.php';
  }else{
    include '../db_connect.php';
  }


  $qualityAssuranceId="";
  if(isset($_POST['qualityAssuranceId']))
  {
    $qualityAssuranceId="AND qualityAssuranceId=".$_POST['qualityAssuranceId'];
  }
  $select=" SELECT qualityassurance.*
            FROM qualityassurance
            WHERE qualityAssurance.deleted=0
            ".$qualityAssuranceId
            ." GROUP BY qualityAssurance.qualityAssuranceId
              ORDER BY qualityAssuranceId DESC";

  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);

  //echo json_encode($select,JSON_PRETTY_PRINT);
}

 ?>
