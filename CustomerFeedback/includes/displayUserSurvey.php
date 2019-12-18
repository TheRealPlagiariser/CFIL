<?php
    function group_by($key, $array) {
        $result = array();

        foreach($array as $val) {
            if(array_key_exists($key, $val)){
                $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }
        return $result;
    }

    include 'db_connect.php';
    $SelectTemplate="";
    $conn->query("SET GROUP_CONCAT_MAX_LEN=18446744073709547520");
    if (isset($_GET['templateId']))
    {
      $SelectTemplate=" SELECT  templateId,
                                templateName,
                                cycleId,
                                cycleName,
                                question,
                                questionId,
                                inputName,
                                questionType,
                                questionTypeId,
                                pageNo,
                                questionNo,
                                leftLabel,
                                rightLabel,
                                GROUP_CONCAT(possibleAnswer SEPARATOR '|') as possibleAnswer
                        FROM template  JOIN cycle USING(cycleId)
                        JOIN question_template USING(templateId)
                        JOIN question USING(questionId)
                        JOIN question_type USING(questionTypeId)
                        LEFT JOIN question_possible_answer USING(questionId)
                        LEFT JOIN scale_label USING(questionId)
                        WHERE templateId=".$conn->quote($_GET['templateId'])."
                        GROUP BY questionId
                        ORDER BY pageNo,questionNo  ";

    }
    else if(isset($_GET['surveyId'])){
      // session_start();
      $SelectTemplate=" SELECT  survey.templateId,
                                cycleName,
                                question.question,
                                question_template.questionId,
                                inputName,
                                questionType,
                                questionTypeId,
                                question_template.pageNo,
                                questionNo,
                                leftLabel,
                                rightLabel,
                                GROUP_CONCAT(possibleAnswer SEPARATOR '|') as possibleAnswer,
                                surveyName,
                                project.projectCode,
                                project.projectName
                                -- question_template.questionId
                                -- survey_answer.answer,
                                -- survey_answer.surveyAnswerId
                        FROM template
                        JOIN cycle USING(cycleId)
                        JOIN question_template USING(templateId)
                        JOIN question ON(question.questionId = question_template.questionId)
                        JOIN question_type USING(questionTypeId)
                        JOIN survey USING (templateId)
                        JOIN project USING (projectId)
                        LEFT JOIN question_possible_answer ON(question_template.questionId = question_possible_answer.questionId )
                        LEFT JOIN scale_label ON(question_template.questionId = scale_label.questionId)
                        -- LEFT JOIN survey_answer ON(survey.surveyId = survey_answer.surveyId AND question.question = survey_answer.question )
                        WHERE MD5(survey.surveyId)=".$conn->quote($_GET['surveyId'])
                        // ."OR (survey.surveyId=".$conn->quote($_GET['surveyId'])." AND  survey_answer.username=".$conn->quote($_SESSION['Username']).")
                      ."  GROUP BY question_template.questionId
                        ORDER BY question_template.pageNo,question_template.questionNo  ";

      $selectAnswer="SELECT pageNo,answer,question,questionId,surveyAnswerId
                     FROM survey_answer
                     WHERE MD5(surveyId)=".$conn->quote($_GET['surveyId'])." AND  survey_answer.username=".$conn->quote($_SESSION['Username'])
                     ."ORDER BY pageNo ";
                        // echo $SelectTemplate;

      $selectAnswer=$conn->query($selectAnswer);
      $selectAnswer=$selectAnswer->fetchAll(PDO::FETCH_ASSOC );

    }



      $SelectTemplate=$conn->query($SelectTemplate);
      $SelectTemplate=$SelectTemplate->fetchAll(PDO::FETCH_ASSOC);
      // Group data by the "city" key

      $SelectTemplate = group_by("pageNo", $SelectTemplate);
      if(isset($selectAnswer))
      {
          $selectAnswer = group_by("pageNo", $selectAnswer);
      }

      // echo "<pre>" ; print_r($selectAnswer) ;echo "</pre>";
      // echo "<pre>" ; print_r($SelectTemplate) ;echo "</pre>";
      // Dump result

      // header('Content-Type: application/json; charset=utf-8');
      // echo json_encode($SelectTemplate,JSON_PRETTY_PRINT);






 ?>
