
<?php

    session_start();
    // session_destroy();
    // header("Refresh:0");
    if(!isset($_SESSION['Username']))
    {
      $_SESSION['url']=$_SERVER["REQUEST_URI"];
      header("location: index.php");
      // exit();
    }
    include '../includes/db_connect.php';

    $checkExpired="SELECT DATEDIFF(dateExpired,CURDATE()) as expired,surveyId
                  FROM survey_user
                  WHERE hashSurveyId=".$conn->quote($_GET['surveyId'])
              . " AND hashUsername=".$conn->quote($_GET['username']);
              // echo $checkExpired;

    $checkExpired=$conn->query($checkExpired);
    $checkExpired=$checkExpired->fetch(PDO::FETCH_ASSOC);

    $_SESSION['surveyId']=$checkExpired['surveyId'];
    if(empty($checkExpired['surveyId'])){
          header("location: 404.php");
    }

    $checkAccess="SELECT DISTINCT dateCompleted
                  FROM survey_answer
                  WHERE surveyId=".$conn->quote($_SESSION['surveyId'])
              . " AND username=".$conn->quote($_SESSION['Username']);
              // echo $checkAccess;
    $checkAccess=$conn->query($checkAccess);
    $checkAccess=$checkAccess->fetch(PDO::FETCH_ASSOC);


    if($checkAccess['dateCompleted']!=NULL)
    {
      header("location: complete.php");
    }
    else if($checkExpired['expired']<0)
    {
      header("location: expired.php");
    }
    else{
      include '../includes/displayUserSurvey.php';

      // print_r( $SelectTemplate)

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Survey</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="../images/mcbgroup.jpeg">
    <!-- Google Fonts
    ============================================ -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet"> -->
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="../../css/fontawesome/css/all.css">
    <!-- adminpro icon CSS
    ============================================ -->
    <link rel="stylesheet" href="../../css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/normalize.css">
    <!-- form CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/form.css">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- modernizr JS
    ============================================ -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- <link rel="stylesheet" href="css/steps/normalize.css"> -->
    <!-- <link rel="stylesheet" href="css/steps/main.css"> -->
    <link rel="stylesheet" href="../css/steps/jquery.steps.css">


    <style media="screen">
      .error{
        color:red;
      }

      hr {
          display: block;
          height: 1px;
          border: 0;
          border-top: 1px solid #ccc;
          margin: 1em 0;
          padding: 0;
      }
      .steps {
        pointer-events: none;
      }
      .materialdesign .footer-copyright-area {
          position: relative;
        }
      .wizard > .steps li a:before {
          content: "";
          width: 85px;
          height: 2px;
          background: #e9e0cf;
          position: absolute;
          right: 28px;
      }
    </style>
  </head>


  <body class="materialdesign">
      <div class="wrapper-pro">

      <div class="content-inner-all" style="margin-left:0px">




      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" style="margin-top:-12px" href="#"><img style="height:40px;"src="../images/mcblogo.png" alt="" /></a>
          </div>
        </div><!-- /.container-fluid -->
      </nav>

      <div class="container mg-b-40" >
        <div class="login-form-area">
          <div class="container">


            <div class="row">
              <div class="col-md-1">

              </div>
              <div class="col-md-10 tab-content" id="myTabContent">

                <div id='divTemplateDetails' >
                  <div class="container-fluid ">
                    <div class="row ">
                      <div class="sparkline10-hd">
                          <div class="main-sparkline10-hd">
                            <h1>  Welcome <?php echo $_SESSION['Username']?> </h1>
                          </div>
                      </div>
                      <div class="sparkline10-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                          <!-- <div class="row">
                            <label class=" ">Please, respond to the survey below</label>

                          </div> -->
                          <!-- <hr/> -->
                          <div class="row">
                            <label class="col-md-2 ">Survey Name</label>
                            <span class=""><?php echo current($SelectTemplate)[0]["surveyName"] ?></span>
                          </div>
                          <div class="row">
                            <label class="col-md-2 ">Project  </label>
                            <span class=""><?php echo  current($SelectTemplate)[0]["projectCode"]." - ".current($SelectTemplate)[0]["projectName"] ?></span>
                          </div>
                          <div class="row">
                            <label class="col-md-2">Cycle</label>
                            <span class=""><?php echo current($SelectTemplate)[0]['cycleName'] ?></span>
                          </div>
                        </div>
                        <hr/>
                          <div class="basic-login-form-ad ">
                              <div class="row">
                                  <div class="col-lg-12 ">
                                      <div class="dual-list-box-inner">
                                        <form id="frmSurvey" class="" action="includes\SurveyResponse\addResponse.php" method="post">
                                          <input type="hidden" id="hdprojectName" name="projectName" value="<?php echo current($SelectTemplate)[0]["projectName"] ?>">
                                          <input type="hidden" id="hdprojectCode"  name="projectCode" value="<?php echo current($SelectTemplate)[0]["projectCode"] ?>">
                                            <div class="" id="wizard">
                                              <?php
                                                foreach ($SelectTemplate as $page => $elements)
                                                {
                                                    echo "<h3></h3><section>";
                                                    foreach ($SelectTemplate[$page] as $question => $questionDetails)
                                                    {

                                                        $label="";

                                                        $input="</div><div class='answer'>";
                                                        $input1="<div>".$questionDetails['questionNo'].".    ".$questionDetails['question'];
                                                          if($questionDetails["possibleAnswer"]==null)
                                                          {
                                                              $input.="<input type='hidden' name='txa".$questionDetails["questionId"]."[questionId]' value='".$questionDetails["questionId"]."'>";
                                                              $input.="<input type='hidden' name='txa".$questionDetails["questionId"]."[question]' value='".$questionDetails["question"]."'>";
                                                             $input.="<textarea rows='4' required name='txa".$questionDetails["questionId"]."[answer]' cols='85%'>";
                                                             if(!empty($selectAnswer) && isset($selectAnswer[$page][$question]))
                                                             {
                                                               $input.=$selectAnswer[$page][$question]['answer'];
                                                             }
                                                             $input.="</textarea>";
                                                          }else{
                                                            $poss=explode("|",$questionDetails["possibleAnswer"]);
                                                            if($questionDetails['questionTypeId']=="2")
                                                            {
                                                              sort($poss);
                                                              // print_r($poss);
                                                              if($questionDetails["leftLabel"]!=null && $questionDetails["rightLabel"]!=null)
                                                              {
                                                                  $label.="<br/>( ". $poss[0]." - ".$questionDetails["leftLabel"]." , ".COUNT($poss)." - ".$questionDetails["rightLabel"]." )";
                                                              }
                                                              // echo $label;


                                                              for ($i=$poss[0]; $i <= COUNT($poss); $i++) {
                                                                $selectedRadio="";
                                                                if(!empty($selectAnswer) && isset($selectAnswer[$page][$question]) && $selectAnswer[$page][$question]['answer']==$i)
                                                                {
                                                                  $selectedRadio="checked";
                                                                }

                                                                $input.='<div class="radio-inline">'.
                                                                  "<input type='hidden' name='rb".$questionDetails["questionId"]."[questionId]' value='".$questionDetails["questionId"]."'>".
                                                                    "<input type='hidden' name='rb".$questionDetails["questionId"]."[question]' value='".$questionDetails["question"]."'>".
                                                                    '<input required class="form-check-input" type="'.$questionDetails['inputName'].'" value="'.$i.'" name="rb'.$questionDetails["questionId"].'[answer]" '.$selectedRadio.'>'.
                                                                    '<label class="form-check-label" for="inlineRadio1">'.$i.'</label>'.
                                                                  '</div>';

                                                                }
                                                            }
                                                            else{

                                                              foreach ($poss as $key => $value) {
                                                                $selectedRadio="";

                                                                if(!empty($selectAnswer) && isset($selectAnswer[$page][$question]) && $selectAnswer[$page][$question]['answer']==$value)
                                                                {
                                                                  $selectedRadio="checked";
                                                                }
                                                                $input.='<div class="radio"><div class="radio-inline">'.
                                                                  "<input type='hidden' name='rb".$questionDetails["questionId"]."[questionId]' value='".$questionDetails["questionId"]."'>".
                                                                  "<input type='hidden' name='rb".$questionDetails["questionId"]."[question]' value='".$questionDetails["question"]."'>".
                                                                  '<label class="form-check-label" for="inlineRadio1" style="font-weight:700">'.
                                                                    '<input required class="form-check-input" type="'.$questionDetails['inputName'].'" value="'.$value.'" name="rb'.$questionDetails["questionId"].'[answer]"'.$selectedRadio.' >'.
                                                                    $value.'</label>'.
                                                                  '</div>';


                                                              }

                                                            }


                                                          }
                                                        $input.="<hr></div>";
                                                        echo "<div>".$input1." ".$label.$input."</div>";
                                                    }
                                                    if(!empty($selectAnswer) && isset($selectAnswer[$page][0]))
                                                    {
                                                      $hidden="<input type='hidden' name='surveyAnswerId".$page."' id='surveyAnswerId".$page."' value='".$selectAnswer[$page][0]['surveyAnswerId']."'>";
                                                      echo $hidden;
                                                    }
                                                    echo "</section><br/>";
                                                }



                                               ?>
                                            </div>


                                            </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-1">

              </div>
            </div> <!--row-->
          </div>
        </div>
      </div>
    </div>

      <!-- Footer Start-->
      <?php include "../includes/footer.php" ?>
      <!-- Footer End-->
    </div>
  </body>

  <script src="../js/vendor/jquery-1.11.3.min.js"></script>
  <!-- bootstrap JS
  ============================================ -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- meanmenu JS
  ============================================ -->
  <script src="../js/jquery.meanmenu.js"></script>
  <!-- mCustomScrollbar JS
  ============================================ -->
  <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- sticky JS
  ============================================ -->
  <script src="../js/jquery.sticky.js"></script>
  <!-- scrollUp JS
  ============================================ -->
  <script src="../js/jquery.scrollUp.min.js"></script>


  <script src="../js\steps\jquery.steps.js"></script>

  <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>

<script type="text/javascript" src="Validate\jquery.validate.js"></script>

  <script src="../js/jquery.dropdown.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#frmSurvey").validate({
          errorPlacement: function errorPlacement(error, element) { element.closest('div.answer').find("hr").before(error); }

        });
      $("#frmSurvey ").on("change",":input",function(){

        $(this).addClass("changed");
        $(this).closest(".answer").find("input[type='hidden']").addClass("changed");
      });

      $("#wizard").steps({
        headerTag : "h3",
        bodyTag : "section",
        transitionEffect: "slideLeft",
        // enableFinishButton:false,
        onInit : function(){
          $("#wizard").find(".content").find('section').next('br').remove();

          $("input[type='hidden'][id^='surveyAnswerId']").each(function () {
            $("#wizard").steps("next");
          });
        },
        onStepChanging : function(event,currentIndex,newIndex)
        {
          $("#frmSurvey").find(":input").css("color", "black");
          //previous pressed
          if(currentIndex>newIndex)
          {

            return true;
          }

          $("#frmSurvey").validate().settings.ignore = ":disabled,:hidden";
          formValid=$("#frmSurvey").valid();
          return formValid;

        },
        onStepChanged : function (event, currentIndex, priorIndex) {
          action="insert";

          send=true;
          surveyId=location.search.split("=");
          data=$("#frmSurvey").find("section[id='wizard-p-"+priorIndex+"'] :input").serialize()+"&surveyId="+surveyId[1]+"&projectName="+$("#hdprojectName").val()+"&projectCode="+$("#hdprojectCode").val()+"&action="+action  +"&pageNo="+priorIndex;;
          if(priorIndex>currentIndex)
          {
            // action="update";
            return true;
          }

          if($("#frmSurvey").find("section[id='wizard-p-"+priorIndex+"']").find("[id^='surveyAnswerId']").length)
          {
            action="update";
          }

          if(action=="update")
          {
            // data+="&index="+priorIndex;
            count=$("#frmSurvey").find("section[id='wizard-p-"+priorIndex+"'] :input.changed").length;

            if(count<=0)
            {
              send=false;
            }
            else
            {
              data=$("#frmSurvey").find("section[id='wizard-p-"+priorIndex+"'] :input.changed").serialize()
              +"&surveyId="+surveyId[1]
              +"&projectName="+$("#hdprojectName").val()
              +"&projectCode="+$("#hdprojectCode").val()
              +"&action="+action
              +"&pageNo="+priorIndex;
            }
          }
          // send=false;
          if(send)
          {
            jQuery.ajax({
              url : "../includes/SurveyResponse/addResponse.php",
              type : "post",
              dataType : "json",
              encode : true,
              cache : false,
              data : data

            })
            .done(function (data) {
              if(data.success)
              {
                if(action=="insert")
                {
                  var input = $("<input>")
                           .attr("type", "hidden")
                           .attr("id","surveyAnswerId"+priorIndex)
                           .attr("name", "surveyAnswerId"+priorIndex).val(data.surveyAnswerId);
                    $("#frmSurvey").find("section[id='wizard-p-"+priorIndex+"'] ").append(input);


                }

                $("#frmSurvey").find("section[id='wizard-p-"+priorIndex+"'] :input").removeClass("changed");
                action="insert";
              }else{
                alert(data.error);
              }

            })
            .fail(function(xhr){
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
            });
          }



        },
        onFinishing: function (event, currentIndex){
             $("#frmSurvey").validate().settings.ignore = ":disabled";
             return $("#frmSurvey").valid();
         },
        onFinished: function (event,currentIndex) {
          surveyId=location.search.split("=");
          action="insert";


          jQuery.ajax({
            url : "../includes/SurveyResponse/addResponse.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data : $("#frmSurvey").find("section[id='wizard-p-"+currentIndex+"'] :input").serialize()
                                +"&surveyId="+surveyId[1]
                                +"&projectName="+$("#hdprojectName").val()
                                +"&projectCode="+$("#hdprojectCode").val()
                                +"&action="+action
                                +"&pageNo="+currentIndex
                                +"&finished=true"

          }).done(function (data)
          {

            if(data.success)
            {
              window.location="finish.php";
            }

          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });

          // window.location="includes/SurveyResponse/addResponse.php";
        }
      });

      $("#frmSubmitUsername").submit(function(e){
        e.preventDefault();
        // $("a[href='#divTemplateDetails']").tab("show");
        // alert("hello");
        jQuery.ajax({
          data : $(this).serialize(),
          type : "post"
        }).done(function(result){
          if(result==1){
              $("a[href='#divTemplateDetails']").tab("show");
          }
        });

      });
    });

  </script>
</html>
<?php } ?>
