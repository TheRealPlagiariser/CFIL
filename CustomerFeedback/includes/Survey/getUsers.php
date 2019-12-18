<?php



include '../db_connect.php';
$sent="";
if(isset($_POST['sent']))
{
  $sent.=" AND sent=0";
}
$select="SELECT   survey_user.username,
                  survey_user.fullName,
                  survey_user.email,
                  cycle.cycleName,
                  survey.surveyName,
                  survey_user.dateSent,
                  survey_user.dateExpired,
                  CURDATE() as today,
                  survey_user.sent,
                  CONCAT(project.projectCode,' - ',project.projectName)as projectName,
                  project.projectId,
                  survey.templateId,
                  template.templateName,
                  project.projectId,
                  survey.expired,
                  survey_user.surveyUrl
          FROM survey_user
          RIGHT JOIN survey USING(surveyId)
          JOIN template USING(templateId)
          JOIN cycle USING(cycleId)
          JOIN project USING(projectId)
          WHERE  surveyId=".$conn->quote($_POST['surveyId']).$sent;




$select=$conn->query($select);
$select=$select->fetchALL(PDO::FETCH_ASSOC);


echo json_encode($select,JSON_PRETTY_PRINT);

 ?>
