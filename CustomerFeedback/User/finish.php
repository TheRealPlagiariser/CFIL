
<?php

    session_start();



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
                <div class="row ">
                  <div class="sparkline10-graph">
                    <div class="jumbotron text-xs-center" style="text-align:center">
                      <h1 class="display-3" ><i style="color:green"class="fas fa-check-circle"></i>Thank You for completing this survey</h1>
                      <p class="lead">Your answers have been successfully saved </p>
                      <hr>
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
  <!-- counterup JS
  ============================================ -->
  <script src="js/counterup/jquery.counterup.min.js"></script>
  <script src="js/counterup/waypoints.min.js"></script>
  <script src="js/counterup/counterup-active.js"></script>
  <!-- duallistbox JS
  ============================================ -->
  <script src="js/duallistbox/jquery.bootstrap-duallistbox.js"></script>
  <script src="js/duallistbox/duallistbox.active.js"></script>
  <!-- modal JS
  ============================================ -->
  <script src="js/modal-active.js"></script>
  <script src="js/main.js"></script>
  <script src="js\steps\jquery.steps.js"></script>

  <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>

  <script src="js/jquery.dropdown.js"></script>

</html>
