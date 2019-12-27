<!doctype html>
<?php session_start(); ?>
<html class="no-js" lang="en">

<head>
    <?php
        $title="IT Testing Services- Template";
        include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css/modals.css">
    <link rel="stylesheet" href="css/duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="css/steps/normalize.css">
    <link rel="stylesheet" href="css/steps/main.css">
    <link rel="stylesheet" href="css/steps/jquery.steps.css">



</head>


<body class="materialdesign">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


    <div class="wrapper-pro">
        <div class="content-inner-all">
            <!-- Header top area start-->

            <?php
                $active='template';
                include 'includes/menu.php';
             ?>
             <div class="breadcome-area mg-b-30 ">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                                 <div class="row">
                                         <div class="">
                                           <ul class="breadcome-menu pull-left">
                                               <li><a href="template.php">Template</a> <span class="bread-slash">/</span>
                                               </li>
                                               <li><span class="bread-blod">Create Template</span>
                                               </li>
                                           </ul>
                                         </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>




          <div class="container-fluid ">
            <div class="row">
              <div class="col-sm-2"></div>
              <div class=' col-sm-9 col-md-8 col-lg-9 text-right' style=" margin-bottom: 1% ">
                   <button  id='btnPreview'  data-toggle="modal" data-target="#modalPreview"
                                              style="padding: 10px 20px;
                                                     border: none;
                                                     background: #A70027;
                                                     width:25%;
                                                     color: #fff;
                                                     font-weight: 14px;
                                                     transition: all .4s ease 0s;">
                                                     Preview
                    </button>
                 </div>

            </div>
            <div class="row" style="">
              <div class="col-sm-2 " style="padding-right:0%">
                <ul class="nav nav-tabs nav-stacked" style="    margin-top: 0%;">
                  <li class="nav-item active">
                    <a class="nav-link active" style="    margin-right: -2%;" data-toggle="tab" href="#divTemplateDetails" >Template Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" style="margin-right: -2%;" id="" data-toggle="tab" href="#divTemplateQuestion">Question Details</a>
                  </li>
               </ul>
              </div>
                <div class="col-sm-9 col-md-8 col-lg-9" style="padding-left:0%">
                  <div class="tab-content" id="myTabContent" >
                     <div class="tab-pane fade-in   active" id="divTemplateDetails"  >
                       <div class="mg-b-40">
                           <div class="container-fluid">
                               <div class="row">
                                   <!-- <div class=""> -->
                                       <!-- <div class=""> -->
                                           <div class="sparkline10-hd">
                                               <div class="main-sparkline10-hd">
                                                   <h1>Template details</h1>
                                               </div>
                                           </div>
                                           <div class="sparkline10-graph">
                                               <div class="basic-login-form-ad">
                                                   <div class="row">
                                                       <div class="col-lg-12">
                                                           <div class="dual-list-box-inner">
                                                               <form id="frmCreateTemplate" action="#" class="form-horizontal">
                                                                 <div class="form-group">
                                                                    <label for="txtTemplateName" class="col-sm-2 control-label">Template Name</label>
                                                                    <div class="col-sm-10">
                                                                      <input type="text" class="form-control" name='txtTemplateName' id="txtTemplateName" placeholder="">
                                                                    </div>
                                                                  </div>

                                                                 <div class="form-group">
                                                                   <label for="radCycle" class="col-sm-2 control-label">Template Cycle</label>
                                                                   <div class="radio" id="radCycle">
                                                                      <label>
                                                                        <input type="radio" name="radCycle" id="radCycleSIT" value="SIT" >
                                                                           SIT-System Integration Testing
                                                                           <br/>
                                                                         <input type="radio" name="radCycle" id="radCycleUAT" value="UAT">
                                                                            UAT-User Acceptance Testing
                                                                          <br/>
                                                                          <input type="radio" name="radCycle" id="radCycleOther" value="Other">
                                                                               Other
                                                                      </label>
                                                                    </div>

                                                                  </div>

                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       <!-- </div> -->
                                   <!-- </div> -->
                               </div>
                           </div>
                       </div>
                     </div>
                     <div class="tab-pane  fade" id="divTemplateQuestion"  >
                         <div class="dual-list-box-area mg-b-40">
                             <div class="container-fluid">
                                 <div class="row">
                                     <!-- <div class="">
                                         <div class=" "> -->
                                             <div class="sparkline10-hd">
                                                 <div class="main-sparkline10-hd">
                                                     <h1>Choose Questions</h1>
                                                 </div>
                                             </div>
                                             <div class="sparkline10-graph">
                                                 <div class="basic-login-form-ad">
                                                     <div class="row">
                                                         <div class="col-lg-12">
                                                             <div class="dual-list-box-inner">
                                                                 <form id="form" action="#" class="wizard-big">
                                                                     <select form="frmCreateTemplate" class="form-control dual_select" name="dualQuestion[]" id="dualQuestion" multiple>
                                                                         <option value="United States">United States</option>
                                                                         <option value="United Kingdom">United Kingdom</option>
                                                                         <option value="Australia">Australia</option>
                                                                         <option selected value="Austria">Austria</option>
                                                                         <option selected value="Bahamas">Bahamas</option>
                                                                         <option value="Barbados">Barbados</option>
                                                                         <option value="Belgium">Belgium</option>
                                                                         <option value="Bermuda">Bermuda</option>
                                                                         <option value="Brazil">Brazil</option>
                                                                         <option value="Bulgaria">Bulgaria</option>
                                                                         <option value="Cameroon">Cameroon</option>
                                                                         <option value="Canada">Canada</option>
                                                                     </select>
                                                                     <br/>
                                                                     <div class="row">
                                                                        <div class='col-lg-12 text-center'>
                                                                          <input type="submit" form="frmCreateTemplate" id='btnCreateTemplateDetails' value='CREATE'  style="padding: 10px 20px;
                                                                          border: none;
                                                                          background: #A70027;
                                                                          width:25%;
                                                                          color: #fff;
                                                                          font-weight: 14px;
                                                                          transition: all .4s ease 0s;">
                                                                        </div>
                                                                      </div>
                                                                 </form>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         <!-- </div>
                                     </div> -->
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

    <!-- Footer Start-->
    <?php include "includes/footer.php"?>
    <!-- Footer End-->
    <!-- jquery
		============================================ -->
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
    <script src="js\steps\jquery.steps.min.js"></script>



        <div id="modalPreview" class="modal modal-adminpro-general FullColor-popup-DangerModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-4">
                        <h4 class="modal-title">Preview</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <?php include 'stepper.php'?>
                    </div>

                </div>
            </div>
        </div>
    <script type="text/javascript">
      // $("#btnCreateTemplateDetails").click(function(e){
      //   e.preventDefault();
      //
      //   $('a[href="#divTemplateQuestion"]').tab('show');
      //
      //   $("#btnCreateTemplateDetails").remove();
      // });


    </script>
</body>

</html>
