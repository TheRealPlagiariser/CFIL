<?php
  include '../db_connect.php';
  $query='';
  $join="";
  if(isset($_POST['echo']))
  {
      $conn->query("SET GROUP_CONCAT_MAX_LEN=18446744073709547520");
      $query='';
      if(isset($_POST['questionId']))
      {
          $query=" AND questionId=".$conn->quote($_POST['questionId']);

      }
  $join=" LEFT JOIN question_possible_answer USING (questionId) LEFT JOIN scale_label USING (questionId)";

    $selectQuestion=" SELECT  question.questionId,
                              question.question,
                              question_type.questionType,
                              question_type.questionTypeId,
                              question.dateCreated,
                              question.createdBy,
                              GROUP_CONCAT(possibleAnswer SEPARATOR '|') AS `possibleAnswer`,
                              scale_label.leftLabel,
                              scale_label.rightLabel,
                              question_type.inputName
                      FROM question INNER JOIN question_type ON question_type.questionTypeId=question.questionTypeId
                      ".$join."
                       WHERE question.deleted=0

                      ".$query."
                      Group by  question.questionId
                      ORDER BY dateCreated DESC";

  }
  else{
    $selectQuestion=" SELECT question.questionId,
                             question.question,
                             question_type.questionType,
                             question.dateCreated,
                             question.createdBy,
                             COUNT(question_template.questionId) as count,
                             SUM(IFNULL(question_template.deleted, 0))  as sum
                      FROM question INNER JOIN question_type ON question_type.questionTypeId=question.questionTypeId
                      LEFT JOIN question_template USING (questionId)
                       WHERE question.deleted=0

                       GROUP BY question.questionId
                       ORDER BY dateCreated DESC ";

  }

            //
            // echo $selectQuestion;

  $selectQuestion=$conn->query($selectQuestion);
  $selectQuestion=$selectQuestion->fetchALL(PDO::FETCH_ASSOC);

  // array_walk($selectQuestion,function(&$key){
  //   foreach ($key as $keyx => $value) {
  //     $key[$keyx]=html_entity_decode($key[$keyx],ENT_QUOTES);
  //   }
  // });

  if(!isset($_POST['questionId']) )
  {
    echo json_encode($selectQuestion,JSON_PRETTY_PRINT);
  }

  if(isset($_POST['show']) && $_POST['show']=="edit")
  {
      echo json_encode($selectQuestion,JSON_PRETTY_PRINT);
  }
?>
