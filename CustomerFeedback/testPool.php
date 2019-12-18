<?php

if(isset($_POST)){


  include 'includes/db_connect.php';
  $projectId="";
  if(isset($_POST['projectId']))
  {
    $projectId="AND projectId=".$_POST['projectId'];
  }
  $select=" SELECT project.projectId,
          
                   project.projectName,
                   project.dateCreated,
                   project.createdBy,
                   COUNT(survey.projectId) as count,
                   SUM(IFNULL(survey.deleted,0)) as sum
            FROM improvementlog.project LEFT JOIN survey USING(projectId)
            WHERE project.deleted=0
            GROUP BY project.projectId
            ORDER BY projectId DESC";



  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);
  echo json_encode($select,JSON_PRETTY_PRINT);
}






 ?>
