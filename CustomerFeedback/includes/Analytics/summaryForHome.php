<?php

        include '../db_connect.php';
          $conn->query("SET GROUP_CONCAT_MAX_LEN=18446744073709547520");
        $selectSurvey=" SELECT surveyId,surveyName,COUNT( DISTINCT username) as numResponse
                  FROM survey LEFT JOIN survey_answer USING (surveyId)
                  WHERE survey_answer.dateCompleted IS NOT NULL
                  GROUP BY survey.surveyId
                  ORDER BY dateCreated DESC
                  LIMIT 10";


        $selectProject="SELECT
                            project.projectId,
                            cycleName,
                            surveyId,
                            surveyName,
                            CONCAT(project.projectCode,' - ',project.projectName) as projectName,
                            COUNT(DISTINCT username) as numResponse
                        FROM
                            survey
                        LEFT JOIN survey_answer USING(surveyId)
                        JOIN template USING (templateId)
                        JOIN cycle USING(cycleId)
                        JOIN project USING(projectId)
                        WHERE survey_answer.dateCompleted Is NOT NULL
                        GROUP BY survey.surveyId
                        ORDER BY survey.dateCreated DESC
                        LIMIT 10";

          $selectSurvey=$conn->query($selectSurvey);
          $selectSurvey=$selectSurvey->fetchALL(PDO::FETCH_ASSOC);

          $selectProject=$conn->query($selectProject);
          $selectProject=$selectProject->fetchALL(PDO::FETCH_ASSOC | PDO :: FETCH_GROUP);




          $select['survey']=$selectSurvey;
          $select['project']=$selectProject;

          header('Content-Type: application/json');
          echo json_encode($select,JSON_PRETTY_PRINT);

 ?>
