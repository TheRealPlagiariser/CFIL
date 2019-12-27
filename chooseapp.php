<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: index.php");
}

?>
<!doctype html>

<html class="no-js" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
  <link rel="shortcut icon" type="image/x-icon" href="images/mcbgroup.jpeg">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome Menu</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome
		============================================ -->
    <link rel="stylesheet" href="css/fontawesome/css/all.css">
    <!-- adminpro icon CSS
    ============================================ -->
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <!-- normalize CSS
    ============================================ -->


    <link rel="stylesheet" href="css/normalize.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="css/style.css">
    <!-- modernizr JS

		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <style media="screen">
      .transition-world-list .author-permissio-wrap{
        border:1px solid black;
      }
    </style>
</head>

<body class="materialdesign">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="wrapper-pro">
      <div class="left-sidebar-pro">
          <nav id="sidebar" style="min-width: 65px;">
              <div id="activeApp" class="sidebar-header" style="background:#ebebeb;">
                <a class="" href="#"><img src="images/mcblogo.png" alt=""></a>
                  <!-- <a href="../chooseapp.php"><img src="img/mcblogo.png" alt="" />
                  </a> -->
                  <strong>
                    <a href="#" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                      <i style="color: black;" class="fas big-icon fa-home"></i>
                      <span class="mini-dn"></span>
                    </a>
                  </strong>
              </div>

          </nav>
      </div>
        <!-- Header top area start-->
        <div class="content-inner-all">
            <div class="header-top-area mg-b-40">
              <div class="fixed-header-top">
                  <div class="container-fluid">
                      <div class="row">
                        <div class="col-lg-8  col-md-8 col-sm-7 col-xs-10">
                          <div class="title" style="margin-left:50%;">
                              <!-- <span style="color:white;margin: 0 auto; text-align:center;">Welcome to Ultimate SharePoint</span> -->
                              <h1 style="margin: 15px auto; text-align:center;">Welcome to IT Testing Services Portal </h1>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4">
                              <div class="header-right-info">
                                <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                  <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name">
                                                  <?php
                                                        if(isset($_SESSION['FullName']))
                                                          {
                                                              echo $_SESSION['FullName'];
                                                          }
                                                          else
                                                          {
                                                              echo "Username";
                                                          }
                                                  ?>
                                                </span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                                <li><a href="config.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Config</a>
                                                </li>
                                                <li><a href="logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                                </li>
                                            </ul>
                                  </li>
                                </ul>
                              </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        <!-- </div> -->
            <!-- Header top area end-->

            <!-- income order visit user Start -->
            <div  class="income-order-visit-user-area">
                <div class="container-fluid">
                    <div class="row mg-tb-100">

                    </div>
                    <div class="row user">

                    </div>
                    <div class="row mg-b-40" >
                      <div class="col-lg-12">
                        <h2 class="text-center">Select an Application</h2>
                      </div>

                    </div>
                    <div class="row">
                      <a href="CustomerFeedback/home.php">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-skill shadow-reset app">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-circular text-center mg-t-10">
                                            <i style="color: #23c6c8;" class="fas fa-poll-h fa-5x"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="progress-circular1">
                                            <h2>Customer Feedback</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </a>
                      <a href="ImprovementLog/actionitem.php">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-skill widget-ov-mg-t-30 shadow-reset app">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-circular  text-center mg-t-10">
                                              <i style="color: #039cfd;" class="fas fa-tasks fa-5x"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="progress-circular2">
                                            <h2>Improvement Log</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </a>
                      <a href="TeamVelocity/team.php">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-skill widget-ov-mg-t-30 shadow-reset app">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-circular  text-center mg-t-10">
                                              <i style="color: #039cfd;" class="fab fa-accessible-icon fa-5x"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="progress-circular2">
                                            <h2>Team Velocity</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </a>

                        <!-- <a href="#">
                          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <div class="single-skill widget-ov-mg-t-30 widget-ov-mg-t-n-30 shadow-reset app">
                                  <div class="row">
                                      <div class="col-lg-4">
                                          <div class="progress-circular text-center mg-t-10">
                                            <i style="color: #23c6c8;" class="fas fa-file-alt fa-5x"></i>
                                          </div>
                                      </div>
                                      <div class="col-lg-8">
                                          <div class="progress-circular3">
                                              <h2>New Application</h2>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </a> -->
                    </div>
                    <div class="row mg-tb-100">

                    </div>
              </div>
            </div>
        </div>
    </div>
    <!-- Footer Start-->
    <?php include "includes/footer.php" ?>
    <!-- Footer End-->
    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
