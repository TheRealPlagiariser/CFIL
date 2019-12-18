<!doctype html>
<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: ../index.php");
}

 include 'includes/db_connect.php';




?>
<html class="no-js" lang="en">

<head>
    <?php
        $title="Survey";
        include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css/modals.css">


    <link rel="stylesheet" href="css\selectList\selectlist.css" type="text/css"/>
    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
    <style media="screen">
      #searchIcon:hover{cursor: pointer; background-color: #A70027;}
      #searchIcon:active{background-color: black;}

      ul#searchResults{background-color:#ebebeb;}
      ul#searchResults li:hover {cursor: pointer; background-color: #A70027;}
      ul#searchResults li#header:hover {cursor: default;  background-color: #ebebeb;}
      ul#searchResults li{}
        .form-control.select2-hidden-accessible {
            top: 30px;
            left : 25%;
        }

    </style>

</head>


<body class="materialdesign">
    <div class="wrapper-pro">
      <?php $activeApp="cf" ?>
      <?php include "../includes/sidebar.php"; ?>
      <div class="content-inner-all">
          <!-- Header top area start-->

          <?php
              $active='survey';
              include 'includes/menu.php';
           ?>
             <div class="container-fluid">
           <div class="breadcome-area mg-b-30 ">
             <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                 <div class="row">
                         <div class="">
                           <ul class="breadcome-menu pull-left">
                               <li><a href="survey.php">Survey</a> <span class="bread-slash">/</span>
                               </li>
                               <li><span class="bread-blod">Create Survey</span>
                               </li>
                           </ul>
                         </div>
                 </div>
             </div>
           </div>
           </div>
          <div class="container ">
              <div class="col-sm-9 col-md-8 col-lg-9" style="padding-left:0%; float:none; margin:0 auto;">

               <div class="mg-b-40">
                   <div class="container-fluid ">
                       <div class="row ">
                         <div class="sparkline10-hd">
                             <div class="main-sparkline10-hd">
                                 <h1>Survey Details</h1>
                             </div>
                         </div>
                         <div class="sparkline10-graph">
                             <div class="basic-login-form-ad ">
                                 <div class="row">
                                     <div class="col-lg-12 ">
                                         <form id="frmCreateSurvey" method="POST" action="includes\Survey\addSurvey.php" class="form-horizontal">
                                          <div class="form-group">
                                              <label for="txtSurveyName" class="col-sm-2 control-label">Survey Name</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Type a survey name"name='txtSurveyName' id="txtSurveyName" placeholder="" required>
                                              </div>
                                            </div>


                                          <div class="form-group">
                                             <label for="cmbProject" class="col-sm-2 control-label">Select Project</label>
                                            <div class="col-sm-10">

                                              <select id="drpProject"  title="project name project code" placeholder = "Choose a project" class="form-control" name="drpProject"  required>
                                                <option title = "" value="" ></option>

                                                <optgroup  label="Project Code - Project Name">

                                                <?php


                                                      $SelectProject=" SELECT *
                                                                FROM project
                                                                WHERE deleted=0
                                                                ORDER BY projectId DESC";
                                                      $SelectProject=$conn->query($SelectProject);

                                                       while($row=$SelectProject->fetch(PDO::FETCH_ASSOC)){
                                                         echo ' <option value="'.$row["projectId"].'"> '.$row["projectCode"].' - '.$row["projectName"].'</option>';
                                                       }


                                                 ?>
                                                 </optgroup>
                                              </select>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label for="cmbProject" style="padding-right:0%;"class="col-sm-2 control-label">Choose Template</label>
                                            <div class="col-sm-10">
                                             <select id="drpTemplate" class="form-control" name="drpTemplate" form="frmCreateSurvey"  data-live-search="true" required>
                                               <option value=""></option>
                                               <?php


                                                      $SelectTemplate="SELECT * FROM template WHERE deleted=0";
                                                      $SelectTemplate=$conn->query($SelectTemplate);
                                                      while($row=$SelectTemplate->fetch(PDO::FETCH_ASSOC)){
                                                        echo '<option value="'.$row["templateId"].'">'.$row["templateName"].'</option>';
                                                      }


                                                ?>
                                             </select>
                                           </div>
                                          </div>
                                          <hr/>


                                          <div class="form-group">
                                              <label for="txtSearchUser" class="col-sm-2  control-label">Send To</label>
                                              <div class="col-sm-10 col-lg-10">
                                                <div class="login-input-area" style="margin-right:0;">
                                                  <input type="text" id="txtSearchUser" value="" placeholder="Search by Username, Surname" style="margin:0;">
                                                  <span>
                                                    <i id="searchIcon" class="fa fa-search login-user" aria-hidden="true" style="top: 0px;" title="Search User"></i>
                                                  </span>
                                                  <div class="data">
                                                    <div id="loading-image" style="display: none;" class="loader"><img src="images\ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div>

                                                    <ul id="searchResults">

                                                    </ul>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>

                                          <div class="form-group">
                                            <div class="col-sm-2">   </div>
                                            <div class="col-sm-10 " style="">
                                              <h3>Send to these users...</h3>
                                              <div class="container-fluid selected-users-list">
                                              </div>
                                            </div>
                                          </div>



                                         </form>
                                         <div class="text-right">
                                           <input id="btnSave" class="btn btn-success btn-sm" form="frmCreateSurvey" value="Save Survey" type="submit" >
                                            <!-- <button id="btnSave" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdlSaveSurvey">Save Survey</button> -->
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

    <script src="js\select2\select2.full.min.js"></script>

    <script type="text/javascript" src="js\selectList\jquery.selectlist.min.js"></script>
    <script src="js\SearchUser\search.js"></script>
    <?php //include "sendSurvey.php"; ?>
</body>
<script type="text/javascript">

    var arrSelectedUser =[];
  $(document).ready(function() {


    



    $("#drpProject").select2({
      placeholder : "Choose A Project",
      // templateResult : formatState,
      // templateSelection: formatState,
      width:"100%"

    });

    $("#drpTemplate").select2({
        placeholder : "Choose A Template",
        width:"100%"

      });

    $("#frmCreateSurvey").submit(function(e){
      e.preventDefault();
      if(arrSelectedUser.length ==0){
        alert("Select at least one user");
        return false;
      }

      var data =$("#frmCreateSurvey").serialize();
      $.ajax({
        type: "POST",
        url: "includes/Survey/addSurvey.php",
        data: data,
        datatype: "json",
        cache: false,
        error: function(xhr){
          alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
      }).done(function(result, status){
        result=JSON.parse(result);
        if(status == "success"){
          if(result.success){
           window.location = "survey.php";
            // $("<input>").attr("type","hidden").attr("name","surveyId").val(result.surveyId).appendTo("#frmSendSurvey");
            // $("#btnSave").val("Update survey");
            // $('#mdlSendSurvey').modal('show');
          }
        }
      });


    });

    $('#mdlSaveSurvey').on("hide.modal.bs",function () {
      window.location="survey.php";
    })



    var surveyName=[];
    $(function(){
      $.ajax({
        type: "POST",
        url: "includes/Survey/getSurvey.php",

        dataType : "json",
        cache: false,
        error: function(xhr){
          alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
      })
      .done(function(result, status){
        txtSurveyName=result.map(x=>x.surveyName);

      });
    });

    var txtSurveyName=[];
    $('#txtSurveyName').keyup(function(){
       $('#txtSurveyName').closest('div').find('span').remove();

       disable=false;
       $.each(txtSurveyName,function (index,value) {
         if(value.toLowerCase()==$('#txtSurveyName').val().toLowerCase().replace(/\s+/g, " ").trim())
         {


             disable=true;
             // $('#txtSurveyName').after("<span  style='color:red'>This survey name already exists</span>");
             return false;
         }
       });
       if(disable)
       {
         $("#txtSurveyName")[0].setCustomValidity("This survey name already exists");
         $("#txtSurveyName")[0].reportValidity();
         return false;
         // $("#btnSave").attr("disabled",true);
       }
       else{
          $("#txtSurveyName")[0].setCustomValidity("");
         // $("#btnSave").attr("disabled",false);
       }



     });
    // });
  });//end of document.ready
</script>


</html>
