
<?php
    session_start();
      // print_r($_SESSION);
    if(isset($_SESSION['Username']))
    {
      header("location: ".$_SESSION['url']);
    }
    // echo $_SESSION['url'];
    $errorMessage="";
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
      // echo "HELO";

      if(!empty($_POST['searchUser']))
      {
        // echo $_POST['searchUser'];
        $_POST['echoJson']=false;
        $fromRespondUser="respondSurvey";
        include '..\includes\ActiveDirectory\getUser.php';
        // echo "<pre>";
        // print_r($Result);
        // echo "</pre>";
        if($Result['result']['count']>0)
        {
          $_SESSION['Username']=$Result['result'][0]['samaccountname'][0];
          // print_r( $_SESSION);
           header("location: ".$_SESSION['url']);
        }else{
          $errorMessage="Incorrect Username";
        }

            // print_r($_SESSION);

      }
    }
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
                <div class="tab-pane fade in active" id='divUsername' role="tabpanel" aria-labelledby="aUsername">
                  <div class="container-fluid ">
                    <div class="row ">
                      <div class="sparkline16-hd" style="text-align:center">
                          <div class="main-sparkline16-hd">
                            <h1>  Welcome to MCB IT Testing Services Survey </h1>
                          </div>
                      </div>
                      <div class="sparkline10-graph">
                        <form id="frmSubmitUsername" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
                          <div class="form-group" style="margin-left:0" >
                            <h4 class="form-label">To begin the survey, please enter your username</h4>
                            <div class="col-sm-8  mg-b-10">
                              <input type="text" class="form-control" placeholder="Type your Username" required  id="" name='searchUser' >
                              <span style="color:red"><?php echo $errorMessage; ?></span>
                            </div>

                          </div>
                          <div class="form-group" style="margin-left:0" >
                            <button id="btnSubmitUserName" style="background-color:#A70027; border-color:#A70027;margin-right: 25%;"  type="submit" class="btn btn-primary pull-right" name="go" value="">GO<i style="margin-left:10%"class="fas fa-arrow-right"></i></button>
                          </div>
                        </form>
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
      <div class="footer-copyright-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="footer-copy-right">
                <p>Copyright &#169; <?php echo date("Y"); ?> Testing Services All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer End-->
    </div>
  </body>

  <script src="../js/vendor/jquery-1.11.3.min.js"></script>
  <!-- bootstrap JS
  ============================================ -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- meanmenu JS
  ============================================ -->


</html>
