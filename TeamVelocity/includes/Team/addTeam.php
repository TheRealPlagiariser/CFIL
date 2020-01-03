<?php

session_start();

if($_POST)
{


    include '../db_connect.php';
    $error=array();
    foreach ($_POST as $key => $value) {
      if(empty($_POST[$key]))
      {

        $error[$key]="This field cannot be empty";
      }else{
        // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
        if(!is_array($_POST[$key]))
        {
            // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
            $_POST[$key]=strip_tags($_POST[$key]);
            $_POST[$key] =trim($_POST[$key]);
            $_POST[$key]=str_replace('|'," ",$_POST[$key]);
            $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
            $_POST[$key] = preg_replace('/\n/', "<br>", $_POST[$key]);
            $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        }

      }
    }
    $arrSuccess=array();
    if(empty($error))
    {
      $insert=" INSERT INTO team(teamName)
                VALUES("
                  .$conn->quote($_POST['txtTeamName'])
                  .")";

      $result=$conn->exec($insert);
      //$teamId = $conn->lastInsertId();

// if QA value inserted into field
    if(isset($_POST['txtQa']) )
    {
      $findInsertedTeam = "SELECT teamId FROM team WHERE deleted=0 AND teamName=".$conn->quote($_POST['txtTeamName'])." ORDER BY teamId DESC";
      $resultTeamId=$conn->query($findInsertedTeam);
      $resultTeamId= $resultTeamId->fetchALL(PDO::FETCH_ASSOC);
      $resultTeamId=$resultTeamId[0]['teamId'];

      $arrSuccess['teamIdResults'] = $resultTeamId;


      //$arrSuccess['qaposting']= "yes qa has been posted";

      //check if exists
      $search =" SELECT *
                FROM qualityassurance
                WHERE deleted=0 AND qaUsername =".$conn->quote($_POST['txtQa']);

      $resultSearch=$conn->query($search);
      if($resultSearch->rowCount() == 0){
        // add new QA
        $addQa = " INSERT INTO qualityassurance (qaUsername)
                  VALUES("
                    .$conn->quote($_POST['txtQa'])
                    .")";

        $resultAddQa= $conn->exec($addQa);



      }

      $findInsertedQa = "SELECT qualityAssuranceId FROM qualityassurance WHERE deleted=0 AND qaUsername=".$conn->quote($_POST['txtQa'])." ORDER BY qualityAssuranceId DESC";
      $resultQaId=$conn->query($findInsertedQa);
      $resultQaId= $resultQaId->fetchALL(PDO::FETCH_ASSOC);
      $resultQaId=$resultQaId[0]['qualityAssuranceId'];

      $arrSuccess['qaIdResults'] = $resultQaId;

      //link QA to team
      $addTeamQa = " INSERT INTO teamqualityassurance (teamId, QualityAssuranceId)
                VALUES("
                  .$conn->quote($resultTeamId)
                  .","
                  .$conn->quote($resultQaId)
                  .")";
      $resultTeamQa = $conn->exec($addTeamQa);
      $arrSuccess['resultTeamQa'] = $resultTeamQa;


    }
    // if QA value inserted into field END

      if($result !== FALSE)
      {
        $arrSuccess['success']=true;
        $arrSuccess['result']="Team added Successful";


        //  header("location:../../project.php");
      }
      else{
        $arrSuccess['success']=false;
        $arrSuccess['result']="An error occured. Try again later";

      }

    }
    else{
      $arrSuccess['success']=false;
      $arrSuccess['result']=$error;
    }
    echo json_encode($arrSuccess);
}






 ?>
