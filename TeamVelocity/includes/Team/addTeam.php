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
