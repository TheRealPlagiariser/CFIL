<?php
  session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: index.php");
  }
  include "../db_connect.php";
  $select="SELECT painPoint AS id, painPoint as text
            FROM actionitem
            WHERE deleted =0
            ORDER BY actionItemId DESC";
  $select=$conn->query($select);

  $select1=$select->fetchALL(PDO::FETCH_ASSOC );
  header('Content-type: Application/JSON');
  echo json_encode($select1,JSON_PRETTY_PRINT);
?>
