<?php

  include "../db_connect.php";
  session_start();
  $code="";
  $error=array();
  $endDate="";

  $findDns = "SELECT dns FROM config";

  $queryDns = $conn->query($findDns);
  while($row4 = $queryDns->fetch())
  {
    $dns = $row4['dns'];
  }
  if($_POST)
  {
    foreach ($_POST as $key => $value) {
      $_POST[$key]=str_replace('|'," ",$_POST[$key]);
      $_POST[$key]=strip_tags($_POST[$key]);
      $_POST[$key] =trim($_POST[$key]);
      $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
      $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
      $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
      if($key == "txtResp" || $key =="txtBackup" || $key =="txtTentativeCompletionDate" ){
          if($_POST["txtTentativeCompletionDate"]==""){
            $endDate="tentativeCompletionDate=NULL";
          }else{
            $endDate="tentativeCompletionDate=".$conn->quote($_POST['txtTentativeCompletionDate']);
          }
          continue;
      }else{
        if(empty($_POST[$key]))
        {
          $error[$key]= $key  ." This field cannot be left blank.";
        }else{
          if($key == "txaAction" || $key == "txaActivityDescription"){
            continue;
          }
        }
      }
    }
    if(empty($error))
    {
      $conn->beginTransaction();

      $select = " SELECT painPoint
                  FROM actionitem
                  WHERE actionItemId =".$_POST['actionItemId'];
      $select = $conn->query($select);
      $select=$select->fetch(PDO::FETCH_ASSOC);
      if($select)
      {
        $painPointToRemove=addslashes($select['painPoint']);
        $update = " UPDATE actionitem
                    SET painPoint=".$conn->quote($_POST['txtPainPoint'])
                    .","
                    ." estimatedMandDays=".$conn->quote($_POST['txtEstimatedManDays'])
                    .","
                    ." solution=".$conn->quote($_POST['txaAction'])
                    .","
                    ." resp=".$conn->quote($_POST['txtResp'])
                    .","
                    ." owner=".$conn->quote($_POST['txtOwner'])
                    .","
                    ." email=".$conn->quote($_POST['email'])
                    .","
                    ." backup=".$conn->quote($_POST['txtBackup'])
                    .","
                    .$endDate
                    .","
                    ." status=".$conn->quote($_POST['drpStatus'])
                    .","
                    ." dateModified=NOW()
                    WHERE actionItemId = ".$conn->quote($_POST['actionItemId']);
        $update = $conn->exec($update);
        if(!$update){
            $conn->rollBack();
            $error['success']=false;
            $error['result']='An error occured. Please try again later.';
            echo json_encode($error,JSON_PRETTY_PRINT);
            exit();
        }
        else
        {
          $select = " SELECT recId
                      FROM imp_rec
                      WHERE actionItem LIKE '%|".$painPointToRemove."|%'";
          $select = $conn->query($select);
          $rowCount=$select->rowCount();

          if($rowCount >0){
            $newPainPoint=$_POST['txtPainPoint'];

            $update="UPDATE imp_rec
                      SET
                          actionItem=
                          IF(
                              LENGTH(actionItem) = LENGTH('|".$painPointToRemove."|'),
                          REPLACE
                              (actionItem, '|".$painPointToRemove."|', CONCAT('|',".$conn->quote($_POST['txtPainPoint']).",'|')),
                          REPLACE
                              (actionItem, '".$painPointToRemove."|', CONCAT(".$conn->quote($_POST['txtPainPoint']).",'|'))
                          ), dateModified=NOW()

                      WHERE
                          actionItem LIKE '%|".$painPointToRemove."|%'
                      ";
            $update=$conn->exec($update);
            if($update !==FALSE){
              $conn->commit();
              $error['success']=true;
              $error['result']="Success";
            }
            else{
              $conn->rollBack();
              $error['success']=false;
              $error['result']='An error occured. Please try again later.';
              echo json_encode($error,JSON_PRETTY_PRINT);
              exit();
            }
          }
          else
          {


            $to = $_POST['email'];
            $subject = "Notice: Improvement Log";

            $body="Dear ".$_POST['txtOwner'].",\n \nPlease take note that you have been identified as the owner of the pain point \"".$_POST['txtPainPoint']."\" by the user ".$_SESSION['FullName'].".\n \nIn case you judge this to be an error, please find contact detail of the user below: \n".$_SESSION['Email']."\n\nKindly use google chrome browser to access the Improvement Log url https://".$dns."/TestingServices/ImprovementLog/ \n \nKind Regards,\nIT Testing Services";
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
            else
            {
              $conn->commit();
              $error['success']=true;
              $error['result']="Update successfull";
            }

          }
        }
      }
      else
      {
        $conn->rollBack();
        $error['success']=false;
        $error['result']='An error occured. Please try again later.';
        echo json_encode($error,JSON_PRETTY_PRINT);
        exit();
      }
    }else{
      $error['success']=false;
      $error['result']='An error occured. Please try again later.';
      echo json_encode($error,JSON_PRETTY_PRINT);
      exit();
    }
  }
  else {
    $error['success']=false;
    $error['result']='An error occured. Please try again later.';
    echo json_encode($error,JSON_PRETTY_PRINT);
    exit();
  }
  echo json_encode($error,JSON_PRETTY_PRINT);

 ?>
