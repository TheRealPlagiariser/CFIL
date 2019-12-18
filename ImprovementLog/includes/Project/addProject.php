<?php
//
// session_start();
// if($_POST)
// {
//     include '../db_connect.php';
//     $error=array();
//     foreach ($_POST as $key => $value) {
//       if(empty($_POST[$key]))
//       {
//         $error[$key]="This field cannot be empty";
//       }else{
//         // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
//         if(!is_array($_POST[$key]))
//         {
//             // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
//             $_POST[$key]=str_replace('|'," ",$_POST[$key]);
//
//             $_POST[$key]=strip_tags($_POST[$key]);
//                 $_POST[$key] =trim($_POST[$key]);
//                 $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);
//                 $_POST[$key] = preg_replace('/\n/', "<br/>", $_POST[$key]);
//                 $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
//         }
//
//       }
//     }
//     if(empty($error))
//     {
//       $insert=" INSERT INTO project(projectName,createdBy)
//                 VALUES("
//
//                   .$conn->quote($_POST['txtProject'])
//                   .","
//                   .$conn->quote($_SESSION['Username'])
//                   .")";
//
//       $result=$conn->exec($insert);
//       if($result)
//       {
//         //  header("location:../../project.php");
//       }
//     }
// }




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
      $insert=" INSERT INTO project(projectCode,projectName,createdBy)
                VALUES("
                  .$conn->quote($_POST['txtProjectCode'])
                  .","
                  .$conn->quote($_POST['txtProjectName'])
                  .","
                  .$conn->quote($_SESSION['Username'])
                  .")";

      $result=$conn2->exec($insert);
      if($result !== FALSE)
      {
        $arrSuccess['success']=true;
        $arrSuccess['result']="Project added Successful";
        //console.log("successfully added");

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
