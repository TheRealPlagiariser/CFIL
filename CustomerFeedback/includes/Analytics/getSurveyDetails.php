<?php
  // $_POST['drpSurvey']=1;
if(isset($_POST)){


  include '../db_connect.php';
  $surveyId="";
  $conn->query("SET GROUP_CONCAT_MAX_LEN=18446744073709547520");
// $_POST['drpSurvey']=2;
  if(isset($_GET['surveyId'])){

   $_POST['drpSurvey']=$_GET['surveyId'];
  }
  if(isset($_POST['drpSurvey']) )
  {
    $surveyId.="surveyId=".$conn->quote($_POST['drpSurvey']);
  }

  $selectDetails=" SELECT  surveyId,
                           surveyName,
                           templateName,
                           CONCAT(project.projectCode,' - ',project.projectName)as projectName,
                           cycleName,
                           COUNT(DISTINCT survey_answer.username) as numResponse
                    FROM survey JOIN template USING(templateId)
                    JOIN cycle USING(cycleId)
                    JOIN project USING(projectId)
                    JOIN survey_user USING(surveyId)
                    LEFT JOIN survey_answer USING(surveyId)
                    WHERE dateCompleted IS NOT NULL AND ".$surveyId."

                    GROUP BY survey.surveyId";
// echo $selectDetails;
  $selectDetails=$conn->query($selectDetails);

  $selectDetails=$selectDetails->fetchALL(PDO::FETCH_ASSOC);

  // $selectQuestion=" SELECT
  //                       question_template.questionId,
  //                       question.question,
  //                       question_possible_answer.possibleAnswer,
  //                       question_type.questionType,
  //                       GROUP_CONCAT(username) as username,
  //                       GROUP_CONCAT(answer) as answers
  //                   FROM
  //                       survey
  //                   JOIN question_template USING(templateId)
  //                   LEFT JOIN question_possible_answer USING(questionId)
  //                   JOIN question ON(question_template.questionId=question.questionId)
  //                   JOIN question_type USING(questionTypeId)
  //                   LEFT JOIN survey_answer ON
  //                       ( 	survey_answer.surveyId=survey.surveyId AND
  //                         	question_template.questionId=survey_answer.questionId AND
  //                       	  question_possible_answer.possibleAnswer=survey_answer.answer)
  //                   WHERE
  //                       survey.surveyId = ".$conn->quote($_POST['drpSurvey'])."
  //                   GROUP BY
  //                       question_template.questionId, question_possible_answer.possibleAnswer
  //                   ORDER BY
  //                       question_template.pageNo,question_template.questionNo";


        $selectQuestion=  "SELECT
                    CONCAT(' ',question_template.questionId) questionId,
                    question.question,
                    question_possible_answer.possibleAnswer,
                    question_type.questionType,
                    GROUP_CONCAT(username) AS username,
                    GROUP_CONCAT(answer SEPARATOR '|') AS answers
                FROM
                    survey
                JOIN question_template USING(templateId)
                LEFT JOIN question_possible_answer USING(questionId)
                JOIN question ON
                    (
                        question_template.questionId = question.questionId
                    )
                JOIN question_type USING(questionTypeId)
                LEFT JOIN survey_answer ON IF(questionType!='FreeText',

                        survey_answer.surveyId = survey.surveyId AND question_template.questionId = survey_answer.questionId AND question_possible_answer.possibleAnswer = survey_answer.answer ,


                                              survey_answer.surveyId = survey.surveyId AND question_template.questionId = 		survey_answer.questionId
                    )
                WHERE

                    survey.surveyId = ".$conn->quote($_POST['drpSurvey'])."


                GROUP BY
                    question_template.questionId,
                    question_possible_answer.possibleAnswer
                ORDER BY
                    question_template.pageNo,
                    question_template.questionNo";
// echo $selectQuestion;
  $selectQuestion=$conn->query($selectQuestion);

  $selectQuestion=$selectQuestion->fetchALL(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);


  //remove user who have not completed the survey
  $selectUserNotCompleted=" SELECT DISTINCT username
                            FROM survey_answer
                            WHERE dateCompleted IS NULL
                            AND surveyId=".$conn->quote($_POST['drpSurvey']);

  $selectUserNotCompleted=$conn->query($selectUserNotCompleted);

  $selectUserNotCompleted=$selectUserNotCompleted->fetchALL(PDO::FETCH_ASSOC);


  $selectUserNotCompleted=array_column($selectUserNotCompleted,'username');


  foreach ($selectQuestion as $key => $value) {

    foreach ($value as $key1 => $val) {

      $noOfUser= explode(",",$val['username']);
      $newUsers=array_diff($noOfUser,$selectUserNotCompleted);
      $userMore=array_intersect($noOfUser,$selectUserNotCompleted);

      //remove from answer also
      if($val['questionType']=='FreeText')
      {
        //find index of its answer
        $index=array_keys($userMore);
        $ans=explode("|",$val['answers']);

        foreach ($index as $ind => $vals) {

          $ans[$ind]= "";
        }

        $selectQuestion[$key][$key1]['answers']=implode('|',array_filter($ans));

      }

        $selectQuestion[$key][$key1]['username']=implode(",",($newUsers));



    }

  }
  $select['surveyDetails']=$selectDetails;
  $select['surveyQuestions']=$selectQuestion;

  header('Content-Type: application/json');
  echo json_encode($select,JSON_PRETTY_PRINT);
// echo $select;

}

 ?>
