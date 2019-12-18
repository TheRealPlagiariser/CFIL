<?php

  include '../db_connect.php';

$selectConfig= "SELECT * FROM config";
$selectConfig=$conn->query($selectConfig);
$selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);

$selectCycle="SELECT * FROM cycle";
$selectCycle=$conn->query($selectCycle);
$selectCycle=$selectCycle->fetchALL(PDO::FETCH_ASSOC);

$select['config']=$selectConfig;
$select['cycle']=$selectCycle;

echo json_encode($select,JSON_PRETTY_PRINT);



 ?>
