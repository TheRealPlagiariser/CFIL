<?php

if(isset($_POST)){


  include '../db_connect.php';
  $surveyId="";
  if(isset($_POST['surveyId']))
  {
    $surveyId.=" AND surveyId=".$conn->quote($_POST['surveyId']);
  }
  $select=" SELECT survey.*,
                   templateName,
                   CONCAT(project.projectCode,' - ',project.projectName)as projectName,
                   COUNT(survey_user.sent) as count,
                   SUM(IFNULL(survey_user.sent,0)) as sum,
                   survey.expired,
                   cycleName
            FROM survey JOIN template USING(templateId)
            JOIN project USING(projectId)
            JOIN cycle USING(cycleId)
            LEFT JOIN survey_user USING(surveyId)
            WHERE survey.deleted =0
            ".$surveyId."
            GROUP BY survey.surveyId
            ORDER BY dateCreated DESC

            ";

  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);

  // $selectNumReplies=" SELECT surveyId, COUNT(DISTINCT Username) as numReplies
  //                     FROM survey_user LEFT JOIN survey_answer USING (surveyId)
  //                     WHERE dateCompleted IS NOT NULL";
  //
  // $selectNumReplies=$conn->query($selectNumReplies);
  //
  // $selectNumReplies=$selectNumReplies->fetch(PDO::FETCH_ASSOC);


  echo json_encode($select,JSON_PRETTY_PRINT);





}

 ?>
