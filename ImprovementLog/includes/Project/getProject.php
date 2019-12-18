<?php

// if(isset($_POST)){
//
//
//   include '../db_connect.php';
//   $projectId="";
//   if(isset($_POST['projectId']))
//   {
//     $projectId="AND projectId=".$_POST['projectId'];
//   }
//
//   $select ="SELECT
//                   project.projectId,
//                   project.projectName,
//                   project.createdBy,
//                   project.dateCreated,
//                   COUNT(imp_rec.projectId) as count,
//                   SUM(IFNULL(imp_rec.deleted,0)) as sum
//             FROM  (project LEFT JOIN imp_rec USING(projectId))
//             WHERE project.deleted=0
//             ".$projectId."
//             GROUP BY project.projectId
//             ORDER BY projectId DESC";
//
//
//   $select=$conn->query($select);
//
//   if($select !== FALSE){
//     $select=$select->fetchALL(PDO::FETCH_ASSOC);
//   }else{
//     echo "select failed";
//   }
//
//
//   echo json_encode($select,JSON_PRETTY_PRINT);
// }

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
                   COUNT(imp_rec.projectId) as count,
                   SUM(IFNULL(imp_rec.deleted,0)) as sum,
                   COUNT(survey.projectId) as count2,
                   SUM(IFNULL(survey.deleted,0)) as sum2
            FROM project LEFT JOIN improvementlog.imp_rec USING(projectId)
            LEFT JOIN survey USING(projectId)
            WHERE project.deleted=0
            ".$projectId
            ."  GROUP BY project.projectId
                        ORDER BY projectId DESC";



  $select=$conn2->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);
  echo json_encode($select,JSON_PRETTY_PRINT);
}








 ?>
