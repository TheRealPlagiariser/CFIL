<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: index.php");
}
  include '../db_connect.php';
  $err=array();

  $set= " SET GROUP_CONCAT_max_len = 18446744073709547520;";
  $set=$conn->query($set);

  if(isset($_POST['actionItemId'])){
    $id=$_POST['actionItemId'];
    $select=" SELECT *
              FROM actionitem
              WHERE actionItemId=$id
              AND deleted=0";
    $select=$conn->query($select);
    $select=$select->fetch(PDO::FETCH_ASSOC);
    $select['painPoint']=html_entity_decode($select['painPoint']);
  }
  else
  {
    $select ="SELECT 	actionitem.*,
                        IFNULL(GROUP_CONCAT(actioncomments.commentId  SEPARATOR '|'), 'empty') commentId,
                        GROUP_CONCAT(actioncomments.comment SEPARATOR '|') commentText,
                        GROUP_CONCAT(actioncomments.createdBy SEPARATOR '|') createdBy,
                        GROUP_CONCAT(DATE_FORMAT(actioncomments.dateCreated, '%d %M %Y') SEPARATOR '|') dateCreated,
                        GROUP_CONCAT(actioncomments.deleted SEPARATOR '|') deletedComment
                FROM actionitem LEFT JOIN  actioncomments using (actionItemId)
                WHERE actionitem.deleted = 0
                GROUP BY actionitem.actionItemId
                ORDER BY actionitem.actionItemId DESC";

    $select=$conn->query($select);

    $select=$select->fetchALL(PDO::FETCH_ASSOC );
    array_walk($select,function(&$key){
      $key['commentId']=explode("|",$key['commentId']);
      $key['commentText']=explode("|",$key['commentText']);
      $key['createdBy']=explode("|",$key['createdBy']);
      $key['dateCreated']=explode("|",$key['dateCreated']);
      $key['deletedComment']=explode("|",$key['deletedComment']);

    });
  }
  echo json_encode($select,JSON_PRETTY_PRINT);
?>
