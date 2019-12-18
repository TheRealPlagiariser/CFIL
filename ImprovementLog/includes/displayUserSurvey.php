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
$SelectTemplate=" SELECT  templateId,
                          templateName,
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
                          GROUP_CONCAT(possibleAnswer) as possibleAnswer
                  FROM template  JOIN cycle USING(cycleId)
                  JOIN question_template USING(templateId)
                  JOIN question USING(questionId)
                  JOIN question_type USING(questionTypeId)
                  LEFT JOIN question_possible_answer USING(questionId)
                  LEFT JOIN scale_label USING(questionId)
                  WHERE templateId=".$conn->quote($_GET['templateId'])."
                  GROUP BY questionId
                  ORDER BY pageNo,questionNo  ";

                  //echo $SelectTemplate;
                  $SelectTemplate=$conn->query($SelectTemplate);
                  $SelectTemplate=$SelectTemplate->fetchAll(PDO::FETCH_ASSOC);
                  // Group data by the "city" key
                          // echo "<pre>" . print_r($SelectTemplate) . "</pre>";
                  $SelectTemplate = group_by("pageNo", $SelectTemplate);

                  // Dump result

                  // header('Content-Type: application/json; charset=utf-8');
                  // echo json_encode($SelectTemplate,JSON_PRETTY_PRINT);





 ?>
