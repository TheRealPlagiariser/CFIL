<?php

if(isset($_POST)){


  include '../db_connect.php';
  $projectId="";
  if(isset($_POST['projectId']))
  {
    $projectId="AND projectId=".$_POST['projectId'];
  }
  $select=" SELECT project.projectId,
                   project.projectCode,
                   project.projectName,
                   project.dateCreated,
                   project.createdBy,
                   COUNT(survey.projectId) as count,
                   SUM(IFNULL(survey.deleted,0)) as sum,
                   COUNT(imp_rec.projectId) as count2,
                   SUM(IFNULL(imp_rec.deleted,0)) as sum2
            FROM project LEFT JOIN survey USING(projectId)
            LEFT JOIN improvementlog.imp_rec USING(projectId)
            WHERE project.deleted=0
            ".$projectId
            ." GROUP BY project.projectId
              ORDER BY projectId DESC";



  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);
  echo json_encode($select,JSON_PRETTY_PRINT);
}






 ?>
