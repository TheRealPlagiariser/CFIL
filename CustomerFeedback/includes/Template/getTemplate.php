<?php

if(isset($_POST)){


  include '../db_connect.php';
  $select=" SELECT  template.templateId,
                    template.templateName,
                    cycle.cycleName,
                    template.createdBy,
                    template.dateCreated,

                    COUNT(survey.templateId) as count,
                    SUM(IFNULL(survey.deleted,0)) as sum
            FROM template  JOIN cycle USING (cycleId)
            LEFT JOIN survey USING(templateId)
            WHERE template.deleted=0
            GROUP BY template.templateId
            ORDER BY template.dateCreated DESC";
  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC);
  echo json_encode($select,JSON_PRETTY_PRINT);
}






 ?>
