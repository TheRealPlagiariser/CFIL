
<?php
  include '../db_connect.php';
  error_reporting(E_ERROR | E_PARSE);

  $set= " SET GROUP_CONCAT_max_len = 18446744073709547520;";
  $set=$conn->query($set);
  $select="SELECT imp_rec.recId recId,
              		project.projectName project,
               		activity.activity,
                  GROUP_CONCAT(imp_rec_description.rec_descriptionId SEPARATOR '|') rec_descriptionId,
                  GROUP_CONCAT(imp_rec_description.loggedBy SEPARATOR '|') loggedBy,
                  GROUP_CONCAT(description SEPARATOR '|') description,
                  GROUP_CONCAT(manDays SEPARATOR '|') manDays,
                  GROUP_CONCAT(startDate SEPARATOR '|') startDate,
                  GROUP_CONCAT(endDate SEPARATOR '|') endDate,
                  -- IFNULL(GROUP_CONCAT(imp_rec_description.deleted SEPARATOR '|'), 0) deletedDescription,
                  -- GROUP_CONCAT(imp_rec_description.deleted SEPARATOR '|'),
   					      SUM(mandays) total,
                  imp_rec.actionItem,
                  DATE_FORMAT(imp_rec.dateCreated, '%d %M %Y') dateCreated,
  	              NULL as commentId,NULL as commentText,NULL as commentCreatedBy,NULL as commentDateCreated,NULL as deletedComment


          FROM customerfeedback.project JOIN imp_rec USING(projectId) join activity USING(activityId) join imp_rec_description using(recId)
          WHERE imp_rec.deleted =0
          AND imp_rec_description.deleted=0
          GROUP BY imp_rec_description.recId

          UNION ALL

          SELECT imp_rec.recId, NULL	as project,NULL as activity,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,
                (GROUP_CONCAT(imp_rec_comment.commentId  SEPARATOR '|')),
                GROUP_CONCAT(imp_rec_comment.comment  SEPARATOR '|') ,
                GROUP_CONCAT(imp_rec_comment.createdBy  SEPARATOR '|'),
                GROUP_CONCAT(DATE_FORMAT(imp_rec_comment.dateCreated, '%d %M %Y')  SEPARATOR '|'),
                GROUP_CONCAT(imp_rec_comment.deleted  SEPARATOR '|')

          FROM imp_rec JOIN imp_rec_comment USING(recId)
          WHERE imp_rec.deleted=0
          AND imp_rec_comment.deleted=0
          GROUP BY imp_rec_comment.recId
          ORDER BY dateCreated DESC
";

  $select=$conn->query($select);

  $select=$select->fetchALL(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
  header('Content-type: Application/JSON');

  $arrTo=array();
  $arrToReturn=array();

  foreach ($select as $key1 => $value1) {
      $arrToReturn['recId']=$key1;
      $arrToReturn['project']=array_filter(array_column($value1,"project"));
      $arrToReturn['activity']=array_filter(array_column($value1,"activity"));

      $arrToReturn['rec_descriptionId']=array_filter(array_column($value1,'rec_descriptionId'));
      $arrToReturn['loggedBy']=array_filter(array_column($value1,'loggedBy'));
      $arrToReturn['description']=array_filter(array_column($value1,'description'));
      $arrToReturn['manDays']=array_filter(array_column($value1,'manDays'));
      $arrToReturn['startDate']=array_filter(array_column($value1,'startDate'));
      $arrToReturn['endDate']=array_filter(array_column($value1,'endDate'));
      $arrToReturn['total']=array_filter(array_column($value1,'total'));
      $arrToReturn['actionItem']=array_filter(array_column($value1,'actionItem'));
      $arrToReturn['dateCreated']=array_filter(array_column($value1,'dateCreated'));
      $arrToReturn['deletedDescription']=array_filter(array_column($value1,'deletedDescription'));


      $arrToReturn['rec_descriptionId']=explode("|",$arrToReturn['rec_descriptionId'][0]);
      $arrToReturn['loggedBy']=explode("|",$arrToReturn['loggedBy'][0]);
      $arrToReturn['description']=explode("|",$arrToReturn['description'][0]);
      $arrToReturn['manDays']=explode("|",$arrToReturn['manDays'][0]);
      $arrToReturn['startDate']=explode("|",$arrToReturn['startDate'][0]);
      $arrToReturn['endDate']=explode("|",$arrToReturn['endDate'][0]);
      $arrToReturn['deletedDescription']=explode("|",$arrToReturn['deletedDescription'][0]);


      $arrToReturn['commentId']=array_filter(array_column($value1,"commentId"));
      $arrToReturn['commentText']=array_filter(array_column($value1,"commentText"));
      $arrToReturn['commentCreatedBy']=array_filter(array_column($value1,"commentCreatedBy"));
      $arrToReturn['commentDateCreated']=array_filter(array_column($value1,"commentDateCreated"));
      $arrToReturn['deletedComment']=array_filter(array_column($value1,"deletedComment"));


      if(!empty($arrToReturn['commentId']))
      {

        $arrToReturn['commentId']=explode("|",$arrToReturn['commentId'][1]);
        $arrToReturn['commentText']=explode("|",$arrToReturn['commentText'][1]);
        $arrToReturn['commentCreatedBy']=explode("|",$arrToReturn['commentCreatedBy'][1]);
        $arrToReturn['commentDateCreated']=explode("|",$arrToReturn['commentDateCreated'][1]);
        $arrToReturn['deletedComment']=explode("|",$arrToReturn['deletedComment'][1]);
      }

    $arrTo[]=$arrToReturn;
    // code...
  }

  // $select=$select->fetchALL(PDO::FETCH_ASSOC );
  // array_walk($arrTo,function(&$key){
  //   $key['rec_descriptionId']=explode("|",$key['rec_descriptionId']);
  //   $key['loggedBy']=explode("|",$key['loggedBy']);
  //   $key['description']=explode("|",$key['description']);
  //   $key['manDays']=explode("|",$key['manDays']);
  //   $key['startDate']=explode("|",$key['startDate']);
  //   $key['endDate']=explode("|",$key['endDate']);
  //   if(!empty($arrTo['commentId']))
  //   {
  //     $arrTo['commentId']=explode(",",$arrTo['commentId'][1]);
  //     $arrTo['commentText']=explode(",",$arrTo['commentText'][1]);
  //     $arrTo['commentCreatedBy']=explode(",",$arrTo['commentCreatedBy'][1]);
  //     $arrTo['commentDateCreated']=explode(",",$arrTo['commentDateCreated'][1]);
  //   }
  // });
  header('Content-type: Application/JSON');
  echo json_encode($arrTo,JSON_PRETTY_PRINT);

?>
