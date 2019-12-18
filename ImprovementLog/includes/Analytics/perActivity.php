<?php


    include '../db_connect.php';

    $select="SELECT
                activity.activity,
                SUM(imp_rec_description.manDays) as manDaysLost
              FROM
                (
                  activity
                  LEFT JOIN imp_rec USING(activityId)
                )
              JOIN imp_rec_description USING(recId)
              WHERE imp_rec_description.deleted=0
              GROUP BY imp_rec.activityId";



    $select=$conn->query($select);

    $select=$select->fetchALL(PDO::FETCH_ASSOC);


    header('Content-Type: application/json');
    echo json_encode($select,JSON_PRETTY_PRINT);


?>
