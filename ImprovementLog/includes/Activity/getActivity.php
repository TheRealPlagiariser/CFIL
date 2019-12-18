<?php

if(isset($_POST)){


  include '../db_connect.php';
  $activityId="";
  if(isset($_POST['activityId']))
  {
    $activityId="AND activityId=".$_POST['activityId'];
  }

  $select ="SELECT
                  activity.activityId,
                  activity.activity,
                  activity.createdBy,
                  activity.dateCreated,
                  COUNT(imp_rec.activityId) as count,
                  SUM(IFNULL(imp_rec.deleted,0)) as sum
            FROM  (activity LEFT JOIN imp_rec USING(activityId))
            WHERE activity.deleted=0
            ".$activityId."
            GROUP BY activity.activityId
            ORDER BY activityId DESC";


  $select=$conn->query($select);

  if($select !== FALSE){
    $select=$select->fetchALL(PDO::FETCH_ASSOC);
  }else{
    echo "select failed";
  }


  echo json_encode($select,JSON_PRETTY_PRINT);
}






 ?>
