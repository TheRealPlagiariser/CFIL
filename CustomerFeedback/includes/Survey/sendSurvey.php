<?php


  if ($_POST) {
    $error=array();
    $success=array();

    $now=array();
    $schedule=array();
    $username=array();

    include '../db_connect.php';


    if(isset($_POST['scheduleAll']) && $_POST['scheduleAll']=="viewSurvey")
    {
      //schedule or send ALL from viewSurveyDetails.php
      foreach ($_POST as $key => $value)
      {
        if(empty($_POST[$key]))
        {
          $error[$key]="This field cannot be left blank";
        }else{

          if(is_array($_POST[$key]))
          {
              if($_POST[$key]['type']=='now')
              {
                foreach ($_POST[$key]['username'] as $key => $value)
                {
                    $now[]=$value;
                }
              }else
              {
                $_POST['scheduleAll']=$_POST[$key]['date'];
                foreach ($_POST[$key]['username'] as $key => $value)
                {
                    $username[]=$value;
                }



              }

            } // else if is_array
          }

        }


    }
    else
    {
      foreach ($_POST as $key => $value)
      {
        if(empty($_POST[$key]))
        {
          $error[$key]=$key."This field cannot be left blank";
        }else{

          if(is_array($_POST[$key]))
          {
            if($_POST[$key]['type']=="now")
            {
              $now[]=$_POST[$key]['username'];
            }else{
              $username[]=$_POST[$key]['username'];
              if(isset($_POST['scheduleAll']))
              {
                continue;
              }


              $schedule[]=$_POST[$key]['date'];
            }
          }

        }
      }
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($schedule);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($username);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($schedule);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($now);
    // echo "</pre>";
    // exit();

    if(empty($error))
    {
      $selectNumExpiryDate="SELECT surveyExpiresIn,timeOfExpiry FROM config";
      $selectNumExpiryDate=$conn->query($selectNumExpiryDate);
      $selectNumExpiryDate=$selectNumExpiryDate->fetchALL(PDO::FETCH_ASSOC);

      $data=array();

      if(!empty($now))
      {
        $User="";

          $now= "'" . implode ( "', '", $now ) . "'";
          $User=" AND username IN (". $now .") ";

        $selectUSers="SELECT  survey_user.username,
                              survey_user.fullName,
                              survey_user.email,
                              cycle.cycleName,
                              survey_user.surveyUrl,
                              CONCAT(project.projectCode,' - ',project.projectName)as projectName,
                              DATE_FORMAT(DATE_ADD(CURDATE(),INTERVAL ".$selectNumExpiryDate[0]['surveyExpiresIn']." DAY), '%a, %D %M %Y') as dateExpired
                      FROM survey_user
                      JOIN survey USING(surveyId)
                      JOIN template USING(templateId)
                      JOIN cycle USING(cycleId)
                      JOIN project USING(projectId)
                      WHERE survey_user.sent=0 AND surveyId=".$conn->quote($_POST['surveyId']).$User;


        $selectUSers=$conn->query($selectUSers);
        while($row=$selectUSers->fetch())
        {

          $to = $row['email'];
          $subject = "Customer Feedback for - ".$row["projectName"] ;

         $body="Dear ".$row['fullName'].",\n \nTo improve quality of our service, we are conducting our among our customer feedback survey to assess the level of satisfaction.\n \nIn this respect, we would appreciate if you can share your feedback with us by clicking on the following web link to fill out a short online questionnaire.Kindly use google chrome browser to access the url \n".$row['surveyUrl']."\n \nPlease note that the survey will be open until ".$row['dateExpired']." at ". $selectNumExpiryDate[0]['timeOfExpiry'].".\n \nThank you in advance for your time and participation.\n \nKind Regards,\nIT Testing Services";
          $headers = "From: IT Testing Services;";
          $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $mail= mail($to,$subject,$body,$headers);
          if(!$mail)
          {
            $error[]="An error occured while sending mail to ".$row['fullName'].". Please, try again later";
          }
          else{
            // echo $row['email'];
            $success[]=$row['email'];

          }
        } //end of while

        if(!empty($success))
        {
          $success = "'" . implode ( "', '", $success ) . "'";

          $update=" UPDATE survey_user
                    SET sent=1, dateSent=CURDATE(),lastModified=NOW(),dateExpired=DATE_ADD(CURDATE(),INTERVAL ".$selectNumExpiryDate[0]['surveyExpiresIn']." DAY)
                    WHERE surveyId=".$conn->quote($_POST['surveyId'])." AND email IN ($success)";
            // echo $update;
          $update=$conn->exec($update);
          if($update !== FALSE)
          {
            $data['success']=true;
            $data['result']= "Successful send/schedule survey";


          }
          else
          {
            $data['success']=false;
            $data['result']= " Not successful";

          }
        }
        else{
          $data['success']=false;
          $data['result']= $error;
        }
      } // end of$_POST==now


      if(!empty($username))
      {
        if(isset($_POST['scheduleAll']))
        {
          $username= "'" . implode ( "', '", $username ) . "'";
          $User=" AND username IN (". $username .") ";
          $update=" UPDATE survey_user
                    SET  lastModified=NOW(),dateSent=".$conn->quote($_POST['scheduleAll']).",dateExpired=DATE_ADD(".$conn->quote($_POST['scheduleAll']).",INTERVAL ".$selectNumExpiryDate[0]['surveyExpiresIn']." DAY)
                    WHERE surveyId=".$conn->quote($_POST['surveyId']).$User;
                    // echo $update;
          $update=$conn->exec($update);
          if($update !==FALSE)
          {
            $data['success']=true;
            $data['result']= "Successful send/schedule survey";

          }
          else{
            $data['success']=false;
            $data['result']= "An error occured. Please, try again later.";
          }
        }
        else{
          $erro="An error occured.Could not schedule for ";
          $err=false;
          foreach ($username as $key => $value) {
            $update=" UPDATE survey_user
                      SET  lastModified=NOW(),dateSent=".$conn->quote($schedule[$key]).",dateExpired=DATE_ADD(".$conn->quote($schedule[$key]).",INTERVAL ".$selectNumExpiryDate[0]['surveyExpiresIn']." DAY)"
                      ." WHERE surveyId=".$conn->quote($_POST['surveyId'])
                      ." AND username=".$conn->quote($value);

                      // echo $update;
                      // echo $value;
            $update=$conn->exec($update);
            if($update === FALSE)
            {
              // echo $value;
              $err=true;
              $erro.=$value." ,  ";
            }

          }
          if(!$err )
          {
            if( empty($error))
            {
              $data['success']=true;
              $data['result']= "Successful send/schedule survey";

            }
            else{
              $data['success']=false;
              $data['result']= $error;
            }

          }else{

            $data['success']=false;
            $data['result']= $error;
          }

        }


      }
      echo json_encode($data);

    }
  }




 ?>
