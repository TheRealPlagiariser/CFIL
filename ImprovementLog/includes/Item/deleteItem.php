
<?php
function cascadeDelete($projectName, $painPoint, $conn){

  echo "imhere";

  // return "boo";


}
// $_POST['recId']=2;
// $_POST['painPoint']="wardah's";
if($_POST)
{
  $error=array();

  include '../db_connect.php';

  //get the list of painpoint for the record
  $select = " SELECT
                  project.projectName,
                  imp_rec.actionItem,
                  COUNT(imp_rec_comment.comment) as numComment
              FROM
                  imp_rec
              LEFT JOIN imp_rec_comment USING(recId)
              JOIN project USING(projectId)
              WHERE
                  imp_rec.recId = ".$_POST['recId'];
  echo $select;
  $where='deleteItem';
  $select=$conn->query($select);
  $select=$select->fetch();
  // print_r( $select);
  $rowCount = $select['numComment']; // $rowCount is the number of comments per record
  $projectName=addslashes($select['projectName']);
  $painPoints=$select['actionItem'];

  $conn->beginTransaction();
  if(!empty($painPoints)) //Record has paintpoints
  {
    $cascadeSuccess=array();
    $countProject=array();
    $painPoints = explode("|",$painPoints);
    $painPoints=array_filter($painPoints);

    foreach($painPoints as $key => $value)
    {
      $painPoint=$value;
      $countProject[$key]="  SELECT project.projectName
                          FROM imp_rec JOIN project USING(projectId)
                          WHERE project.projectName='".$projectName."'
                          AND actionItem LIKE '%|".addslashes($value)."|%'";
      echo "<br/>". $countProject[$key];
      $countProject[$key]=$conn->query($countProject[$key]);
      $countProject[$key]=$countProject[$key]->rowCount();
      if($countProject[$key]>1)
      { // Pas Cascade
        continue;
      }
      else
      { //Cascade
        $updateActionItem = " UPDATE actionitem
                              SET project=
                                        IF(
                                            LENGTH(project) = LENGTH('|".$projectName."|'),
                                        REPLACE
                                            (project, '|".$projectName."|', ''),
                                        REPLACE
                                            (project, '".$projectName."|', '')
                                        )
                              WHERE project LIKE '%|".$projectName."|%'
                              AND painPoint=".$conn->quote($painPoint);

        echo $updateActionItem;
        $cascadeSuccess[$key]= $conn->exec($updateActionItem);
        if($conn->exec($updateActionItem) === FALSE)
        {
          $conn->rollback();
          exit();
        }
      }
    } // End For

    if($rowCount !=0) // Rec has comments
    {
      $update=" UPDATE imp_rec
                INNER JOIN imp_rec_comment using (recId)
                INNER JOIN imp_rec_description using (recId)
                SET imp_rec.deleted = 1,
                    imp_rec.actionItem='',
                    imp_rec_comment.deleted = 1,
                    imp_rec_description.deleted = 1
                WHERE imp_rec.recId =".$_POST['recId'];
      $result=$conn->exec($update);
      $conn->commit();
    }
    else // Rec does not have comment
    {
      $update=" UPDATE imp_rec
                INNER JOIN imp_rec_description using (recId)
                SET imp_rec.deleted = 1,
                    imp_rec.actionItem='',
                    imp_rec_description.deleted = 1
                WHERE imp_rec.recId =".$_POST['recId'];
      $result=$conn->exec($update);
      $conn->commit();
      // $variable=  cascadeDelete($projectName, $conn);
    }
  }
  else //Rec contains no painpoint
  {
    if($rowCount !=0) // the record has comments
    {
      $update=" UPDATE imp_rec
                INNER JOIN imp_rec_comment using (recId)
                INNER JOIN imp_rec_description using (recId)
                SET imp_rec.deleted = 1,
                    imp_rec.actionItem='',
                    imp_rec_comment.deleted = 1,
                    imp_rec_description.deleted = 1
                WHERE imp_rec.recId =".$_POST['recId'];
      $result=$conn->exec($update);
    }
    else
    {
      $update=" UPDATE imp_rec
                INNER JOIN imp_rec_description using (recId)
                SET imp_rec.deleted = 1,
                    imp_rec.actionItem='',
                    imp_rec_description.deleted = 1
                WHERE imp_rec.recId =".$_POST['recId'];
      $result=$conn->exec($update);
    }
    $conn->commit();
  }




  }
?>
