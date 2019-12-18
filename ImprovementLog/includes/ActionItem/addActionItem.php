<?php

session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: index.php");
}else{
  $user=$_SESSION['Username'];
}
include '../db_connect.php';
$endDate="";

$findDns = "SELECT dns FROM config";

$queryDns = $conn->query($findDns);
while($row4 = $queryDns->fetch())
{
  $dns = $row4['dns'];
}

if($_POST)
{
  $error=array();

  foreach ($_POST as $key => $value) {

    if($key == "txtResp" || $key =="txtBackup" || $key =="txaComment" || $key =="txtTentativeCompletionDate" || $key=="email"){
      if($_POST["txtTentativeCompletionDate"]==""){
        $endDate="NULL";
      }else{
        $endDate=$conn->quote($_POST['txtTentativeCompletionDate']);
      }
      $_POST[$key]=strip_tags($_POST[$key]);
      $_POST[$key] =trim($_POST[$key]);
      $_POST[$key]=str_replace('|'," ",$_POST[$key]);
      $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
      $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
      $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
      continue;
    }else{
      if(empty($_POST[$key]))
      {
        $error[$key]= $key  ." This field cannot be left blank.";
      }else{
        if($key == "txaAction" || $key == "txaActivityDescription"){
          continue;
        }else{
          $_POST[$key]=strip_tags($_POST[$key]);
          $_POST[$key] =trim($_POST[$key]);
          $_POST[$key]=str_replace('|'," ",$_POST[$key]);
          $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
          $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
          $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }
      }
    }
  }




  if(empty($error))
  {
    $date= date("Y-m-d");
    $insertActionItem = "   INSERT INTO actionitem( painPoint, estimatedMandDays, solution, resp, owner, email, backup, tentativeCompletionDate, status, acreatedBy, dateModified)
                          VALUES ("
                          .$conn->quote($_POST['txtPainPoint'])
                          .","
                          .$conn->quote($_POST['txtEstimatedManDays'])
                          .","
                          .$conn->quote($_POST['txaAction'])
                          .","
                          .$conn->quote($_POST['txtResp'])
                          .","
                          .$conn->quote($_POST['txtOwner'])
                          .","
                          .$conn->quote($_POST['email'])
                          .","
                          .$conn->quote($_POST['txtBackup'])
                          .","
                          .$endDate
                          .","
                          .$conn->quote($_POST['drpStatus'])
                          .","
                          .$conn->quote($_SESSION['Username'])
                          .",NOW());";
    $conn->beginTransaction();
    $resultActionItem = $conn->exec($insertActionItem);
    if($resultActionItem){
      $to = $_POST['email'];
      $subject = "Notice: Improvement Log";

      $body="Dear ".$_POST['txtOwner'].",\n \nPlease take note that you have been identified as the owner of the pain point \"".$_POST['txtPainPoint']."\" by the user ".$_SESSION['FullName'].".\n \nIn case you judge this to be an error, please find contact detail of the user below: \n".$_SESSION['Email']."\n\nKindly use google chrome web browser to access the Improvement Log url https://".$dns."/TestingServices/ImprovementLog/ \n \nKind Regards,\nIT Testing Services";
      $headers = "From: IT Testing Services;";
      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      $mail= mail($to,$subject,$body,$headers);

      if(!$mail)
      {
        $conn->rollBack();
        $error['success']=false;
        $error['result']='An error occured. Please try again later.';
        header('Content-type: Application/JSON');
        echo json_encode($error,JSON_PRETTY_PRINT);
        exit();

      }

      if(!empty($_POST['txaComment']) && isset($_POST['txaComment']))
      {
          $id=$conn->lastInsertId();
          $insertComment = "   INSERT INTO actioncomments( comment, createdBy, actionItemId)
                                VALUES ("
                                .$conn->quote($_POST['txaComment'])
                                .","
                                .$conn->quote($_SESSION['Username'])
                                .","
                                .$conn->quote($id)
                                .");";
          // echo $insertComment;

          $resultComment = $conn ->exec($insertComment);
          if($resultComment){
            $conn->commit();
            $error['success']=true;
            $error['result']='Successfully Inserted';
            // echo "Successful";
          }else {
            $conn->rollBack();
            $error['success']=false;
            $error['result']='An error occured. Please try again later.';
            header('Content-type: Application/JSON');
            echo json_encode($error,JSON_PRETTY_PRINT);
            exit();
          }
      }
      else
      {
        $conn->commit();
        $error['success']=true;
        $error['result']='Action successfully added.';
      }


    }else{
      $conn->rollBack();
      $error['success']=false;
      $error['result']='An error occured. Please try again later.';
      header('Content-type: Application/JSON');
      echo json_encode($error,JSON_PRETTY_PRINT);
      exit();

    }
}
else{
  $err=$error;
  $error=array();
  $error['success']=false;
  $error['result']=$err;
}
  header('Content-type: Application/JSON');
  echo json_encode($error,JSON_PRETTY_PRINT);
}

?>
