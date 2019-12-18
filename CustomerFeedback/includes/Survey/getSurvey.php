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
                   cycleName,
                   COUNT(DISTINCT survey_answer.dateCompleted,survey_answer.username) as numReplies
            FROM survey JOIN template USING(templateId)
            JOIN project USING(projectId)
            JOIN cycle USING(cycleId)
            LEFT JOIN survey_user USING(surveyId)
            LEFT JOIN survey_answer USING(surveyId)
            WHERE  survey.deleted =0
            ".$surveyId."

            GROUP BY survey.surveyId
            ORDER BY dateCreated DESC

            ";

  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);

  // $selectNumReplies=" SELECT survey.surveyId, COUNT(DISTINCT Username) as numReplies
  //                     FROM survey LEFT JOIN survey_answer USING(surveyId)
  //                     GROUP BY survey.surveyId
  //                     ORDER BY dateCreated DESC ";
  //
  // $selectNumReplies=$conn->query($selectNumReplies);
  //
  // $selectNumReplies=$selectNumReplies->fetchALL(PDO::FETCH_ASSOC);

  //$unify = array_merge($select,$selectNumReplies);

  //echo json_encode($selectNumReplies,JSON_PRETTY_PRINT);

  //echo json_encode($unify,JSON_PRETTY_PRINT);

  echo json_encode($select,JSON_PRETTY_PRINT);

  //






}

 ?>
