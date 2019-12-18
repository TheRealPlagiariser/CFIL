<!doctype html>
<?php
  session_start();
  if(isset($_SESSION['Username']))
  {
    header("Location: chooseapp.php");
  }

  $txtUsername=$txtPassword="";
  $txtUsernameErr=$txtPasswordErr=$errorMsg="";
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
    include "includes/ActiveDirectory/checkLogin.php";
    if(!empty($_POST['txtUsername']))
    {
      $txtUsername=trim( preg_replace('/[\s]+/', ' ', $_POST['txtUsername']));
    }
    else
    {
      $txtUsernameErr="Username cannot be left blank";
    }

    if(!empty($_POST['txtPassword']))
    {
      $txtPassword=$_POST['txtPassword'];
    }
    else
    {
      $txtPasswordErr="Password cannot be left blank";
    }

    $configContent=file_get_contents('config.json');
    $configContent=json_decode($configContent,true);
    $index="authorised_user";

    $authorised_user=$configContent[$index];
    // $authorised_user="IT - Testing Services Group";

    if($txtPasswordErr=="" && $txtUsernameErr=="")
    {
      $entries=authenticate($txtPassword,$txtUsername);
      // echo "<pre>" ; print_r($entries) ;echo "</pre>";
      if($entries['success'])
      {

        foreach ($entries['result'][0]['memberof'] as $key => $value) {
          $groups=explode(',',$value);
          foreach ($authorised_user as $key1 => $authorised) {
            $groups[0]=strtolower(trim(preg_replace('/\s+/', ' ',   $groups[0])));
            $authorised=strtolower(trim(preg_replace('/\s+/', ' ',   $authorised)));
            if(strpos($groups[0],$authorised)!==FALSE )
            {
              $_SESSION['Username']=strtolower($txtUsername);
              $_SESSION['FullName']=$entries['result'][0]['cn'][0];
              $_SESSION['Email']=$entries['result'][0]['mail'][0];
              header('location:chooseapp.php');
            }
          }




        }
        $errorMsg= "You do not have access. Contact Admin";

      }
      else{
        $errorMsg=$entries['result'];
      }

    }


  }
?>
<html class="no-js" lang="en">
  <head>
    <?php
      $title='IT Testing Services-Login';
      include 'includes/head.php';
    ?>
    <style media="screen">
      .error{
        color:red;
      }
      .footer-copyright-area{
        /* position: absolute; /* forces the footer to stay at bottom*/
      }
      .materialdesign .footer-copyright-area {

          position: relative;
        }

    </style>
  </head>

  <body class="materialdesign">
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="wrapper-pro">
      <!-- Header top area start-->
      <!-- https://www.bootply.com/120951 -->
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand"  style="margin-top:-12px"  href="#"><img style="height:40px;" src="images/mcblogo0.png" alt="" /></a>
          </div>
        </div><!-- /.container-fluid -->
      </nav>



      <!-- <div class="row container" style="float:none; margin:0 auto;"> -->


        <div style=" margin-bottom:80px;" class="login-form-area" >
          <div class="container-fluid mg-b-80">
            <div class="row mg-b-40">
              <div class="col-lg-3">  </div>
              <div class="col-lg-6 "  >

                <div class=" text-center <?php if($errorMsg!=''){echo 'alert alert-danger';} ?>" role="alert" style="padding:20px;">
                  <?php echo $errorMsg ?>
                </div>


                  <!-- <div style="width:inherit; margin-bottom:5%" class='text-center <?php //if($errorMsg!=""){echo "alert alert-danger";} ?>' role="alert"><?php echo $errorMsg ?></div> -->
              </div>
              <div class="col-lg-3"></div>
            </div>
            <div class="row">
              <form id="adminpro-form" class="adminpro-form" method="POST" action='<?php echo $_SERVER["PHP_SELF"];?>'>
                <div class="col-lg-3">

                </div>
                <div class="col-lg-6" style="">
                  <div class="login-bg">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center page-header">
                          <h1> IT Testing Services - Login </h1>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="login-input-head">
                          <p>Username<span class='error'>*</span></p>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="login-input-area">
                          <input type="text"  id="txtUsername" name="txtUsername" value='<?php echo $txtUsername ?>' required />
                          <span class='error'><?php echo $txtUsernameErr ?><span>
                            <i class="fa fa-user login-user" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="login-input-head">
                            <p>Password<span class='error'>*</span></p>
                          </div>
                        </div>
                        <div class="col-lg-8">
                          <div class="login-input-area">
                            <input type="password" id="txtPassword" name="txtPassword" required />
                            <span class='error'><?php echo $txtPasswordErr ?><span>
                              <i class="fa fa-lock login-user"></i>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                          </div>
                          <div class="col-lg-8">
                            <div class="login-button-pro">
                            <input type="submit" value="Login" style="background-color:#A70027" class="login-button login-button-lg">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div> <!--row-->
            <div class="row mg-tb-100">
            </div>
          </div>
        </div>
      <!-- </div> -->

      <!-- login Start-->

      <!-- login End-->

      <!-- Footer Start-->
      <?php include "includes/footer.php" ?>
      <!-- Footer End-->
    </div>
  </body>
  <?php //include 'includes/scripts.php'?>
</html>
