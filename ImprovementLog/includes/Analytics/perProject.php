<?php


    include '../db_connect.php';

    $select="SELECT
                project.projectName,
                SUM(imp_rec_description.manDays) as manDaysLost
              FROM
                (
                  customerfeedback.project
                  LEFT JOIN imp_rec USING(projectId)
                )
              JOIN imp_rec_description USING(recId)
              WHERE imp_rec_description.deleted=0
              GROUP BY
                imp_rec.projectId";



    $select=$conn->query($select);

    $select=$select->fetchALL(PDO::FETCH_ASSOC);


    header('Content-Type: application/json');
    echo json_encode($select,JSON_PRETTY_PRINT);


?>
