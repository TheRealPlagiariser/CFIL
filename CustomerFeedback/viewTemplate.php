<!doctype html>
<?php

session_start();
if(!isset($_SESSION['Username']))
{
  header("location: ../index.php");
}

include 'includes/displayUserSurvey.php';


?>

<html class="no-js" lang="en">
  <head>
    <?php
      $title='Survey';
      include 'includes/head.php';
    ?>
    <!-- <link rel="stylesheet" href="css/steps/normalize.css"> -->
    <!-- <link rel="stylesheet" href="css/steps/main.css"> -->
    <link rel="stylesheet" href="css/steps/jquery.steps.css">

    <style media="screen">
      .error{
        color:red;
      }
      .footer-copyright-area{
        position: absolute; /* forces the footer to stay at bottom*/
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
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="wrapper-pro">
        <?php $activeApp="cf" ?>
      <?php include "../includes/sidebar.php"; ?>
      <div class="content-inner-all">

        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" style="margin-top:-12px" href="#"><img style="height:40px;"src="images/mcblogo.png" alt="" /></a>
            </div>
          </div><!-- /.container-fluid -->
        </nav>

      <div class="container mg-b-40" >
        <div class="login-form-area">
          <div class="container">
            <div class="row" style="margin-bottom:4%">
              <div class="col-md-1">

              </div>
              <div class="col-md-10">
                  <a href="<?php echo $_GET['from']; ?>" class="btn btn-default">Back </a>
              </div>
              <div class="col-md-1">

              </div>

            </div>
            <div class="clearfix">

            </div>
            <div class="row">
              <div class="col-md-1">

              </div>
              <div class="col-md-10">
                <div id='divTemplateDetails'>
                  <div class="container-fluid ">
                    <div class="row ">
                      <div class="sparkline10-hd">
                          <div class="main-sparkline10-hd">
                              <div class="row">
                                <div class="col-md-6">
                                    <h1>Template Name : <?php echo current($SelectTemplate)[0]['templateName']?> </h1>
                                </div>
                                <div class="col-md-6">
                                        <h1 class="text-right">  Cycle : <?php echo current($SelectTemplate)[0]['cycleName']?></h1>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="sparkline10-graph">
                          <div class="basic-login-form-ad ">
                              <div class="row">
                                  <div class="col-lg-12 ">
                                      <div class="dual-list-box-inner">
                                            <div class="" id="wizard">
                                                  <?php


                                                    foreach ($SelectTemplate as $key => $value)
                                                    {
                                                        echo "<h3></h3><section>";
                                                        foreach ($SelectTemplate[$key] as $key1 => $value1)
                                                        {

                                                            $label="";
                                                            $value1['question']=  str_replace("<br>", "<br>", $value1['question']);
                                                            $value1['question']=  str_replace("<br/>", "<br>", $value1['question']);
                                                            $input="</div><div>";
                                                            $input1="<div>".$value1['questionNo'].".    ".$value1['question'];
                                                              if($value1["possibleAnswer"]==null)
                                                              {
                                                                 $input.="<textarea rows='4' cols='85%'></textarea>";
                                                              }else{
                                                                $poss=explode("|",$value1["possibleAnswer"]);
                                                                if($value1['questionTypeId']=="2")
                                                                {
                                                                  sort($poss);
                                                                  if($value1["leftLabel"]!=null && $value1["rightLabel"]!=null)
                                                                  {
                                                                      $label.="( ". $poss[0]." - ".$value1["leftLabel"]." , ".$poss[COUNT($poss)-1]." - ".$value1["rightLabel"]." )";
                                                                  }
                                                                  // echo $label;
                                                                  foreach ($poss as $key => $i) {


                                                                    $input.='<div class="radio-inline">'.
                                                                        '<input class="form-check-input" type="'.$value1['inputName'].'" name="rb'.$value1["questionId"].'" >'.
                                                                        '<label class="form-check-label" for="inlineRadio1">'.$i.'</label>'.
                                                                      '</div>';
                                                                    }
                                                                }
                                                                else{
                                                                  foreach ($poss as $key => $value) {
                                                                    $input.='<div class="radio">'.
                                                                          '<div class="radio-inline"><label style="font-weight: 700;">
                                                                              <input type="'.$value1['inputName'].'"  name="rb'.$value1["questionId"].'"  value="'.$value1["questionId"].'">
                                                                              '.$value.'
                                                                          </label></div>'.
                                                                        // '<input class="form-check-input" type="'.$value1['inputName'].'" name="rb'.$value1["questionId"].'" >'.
                                                                        // '<label class="form-check-label" for="inlineRadio1">'.$value.'</label>'.
                                                                      '</div>';

                                                                  }

                                                                }


                                                              }
                                                            $input.="<hr></div>";
                                                            echo "<div>".$input1." ".$label.$input."</div>";
                                                        }
                                                        echo "</section><br/>";
                                                    }



                                                   ?>
                                            </div>

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
      <?php include "includes/footer.php" ?>
      <!-- Footer End-->
    </div>
  </body>

  <script src="js/vendor/jquery-1.11.3.min.js"></script>
  <!-- bootstrap JS
  ============================================ -->
  <script src="js/bootstrap.min.js"></script>
  <!-- meanmenu JS
  ============================================ -->
  <script src="js/jquery.meanmenu.js"></script>
  <!-- mCustomScrollbar JS
  ============================================ -->
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- sticky JS
  ============================================ -->
  <script src="js/jquery.sticky.js"></script>
  <!-- scrollUp JS
  ============================================ -->
  <script src="js/jquery.scrollUp.min.js"></script>


  <script src="js\steps\jquery.steps.js"></script>

  <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>


  <script src="js/jquery.dropdown.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#wizard").steps({
        headerTag : "h3",
        bodyTag : "section",
        transitionEffect: "slideLeft",
        enableFinishButton:false,
        onInit : function(){
          $("#wizard").find(".content").find('section').next('br').remove();
        }
      });



    });

  </script>
</html>
