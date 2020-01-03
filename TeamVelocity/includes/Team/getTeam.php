<?php

if(isset($_POST)){

  if (isset($from) && $from="team.php")
  {
    include 'includes/db_connect.php';
  }else{
    include '../db_connect.php';
  }


  $teamId="";
  if(isset($_POST['teamId']))
  {
    $teamId="AND teamId=".$_POST['teamId'];
  }
  $select=" SELECT team.*
            FROM team
            WHERE team.deleted=0
            ".$teamId
            ." GROUP BY team.teamId
              ORDER BY teamId DESC";

  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);

  if (!(isset($from) && $from="team.php")){
    echo json_encode($select,JSON_PRETTY_PRINT);
  }

}

 ?>
