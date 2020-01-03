<?php
  session_start();

    //$_SESSION['Username']="faraju";
    if(!isset($_SESSION['Username']))
    {
      header("Location: ../index.php");
    }
    include 'includes/db_connect.php';

?>
<!doctype html>
<!-- jquery
  ============================================ -->
<script src="js/vendor/jquery-1.11.3.min.js"></script>
<script type="text/javascript"></script>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Team";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
    <link rel="stylesheet" href="css\touchspin/jquery.bootstrap-touchspin.min.css" type="text/css"/>
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="fontawesome.min.css"> -->
    <link href="css/date-time-picker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="css/bootstrap-table-filter-control.css" rel="stylesheet">
    <!-- <link href="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.css" rel="stylesheet"> -->
    <!-- <link href="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.css" rel="stylesheet"> -->



    <style>

      .grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /*grid with 4 columns .. edit the number to change grid columns*/
        justify-items: center;
        align-items: center;
        grid-gap: 15px;
       }

      .flip-card {
        background-color: transparent;
        width: 100%;
        margin: 0 auto;
        max-width: 500px;
        height: 300px;
        perspective: 1000px;
      }

      .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      }

      .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
      }

      .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
      }

      .flip-card-front {
        background-color: #3556;
        color: black;
      }

      .flip-card-back {
        background-color: #2980b9;
        color: white;
        transform: rotateY(180deg);
      }
      td{
        position:relative;
      }
      .center{
        min-width: 70px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
      }
      .icoAddProject {
        position: absolute;
        bottom:6px;
        right: 6px;
        /* z-index: 10; */
        text-align:right;
        vertical-align:bottom;
      }
      .icoAddComment {
        position: absolute;
        bottom:6px;
        right: 6px;
        /* z-index: 10; */
        text-align:right;
        vertical-align:bottom;
      }
      .no-filter-control {
        height: 34px;
      }

      .filter-control {
        margin: 0 2px 2px 2px;
      }
      .projects:hover{
        color:#03a9f0;
      }
      .hrProject{
        margin:2px 0 5px 0;
      }
      .icoRemoveProject{
        color: #ccc;
      }
      .icoRemoveProject:hover{
        color: red;
      }
      .custom-datatable-overright table tbody tr td.datatable-ct{
            color: red;
      }

      input[disabled]{
        background-color: #FFFFFF !important;
        cursor: default !important;
      }
      i:hover{
        cursor: pointer;
      }
      .limitsize{
        /* overflow: hidden; */
        /* text-overflow: ellipsis; */
        /* max-width: 70px; */
      }
      .limitsizeStatus{
        /* overflow: hidden; */
        /* text-overflow: ellipsis; */
        /* max-width: 66px; */
      }
      .limitsizeAction{
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .limitsizeAction:hover{
        overflow: visible;
        white-space: normal;
        height:auto;  /* just added this line */
        }
      .limitsizeDate{
        /* overflow: hidden; */
        /* text-overflow: ellipsis; */
        /* max-width: 100px; */
      }
      .icoEditComment{
        color: #ccc;
      }
      .icoEditComment:hover{
        color:black;
      }
      .icoDeleteComment{
        margin-left: 3px;
        color: #ccc;
      }
      .icoDeleteComment:hover{
        color:red;
      }

      .commentField {

      overflow: hidden;
      text-overflow: ellipsis;
      }

      /* .commentField:hover{
       overflow: visible;
       word-break: break-word;
      } */

      .table-hover>tbody>tr:hover {
        background-color: #ffffff; /* Assuming you want the hover color to be white */
      }

    </style>
</head>


<body class="materialdesign">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


    <div class="wrapper-pro">
      <?php $activeApp="tv"; ?>
        <?php include "../includes/sidebar.php"; ?>
        <div class="content-inner-all">
          <!-- Header top area start-->

          <?php
          $active="team";
            include 'includes/menu.php';
          ?>


          <!--__________________________________________________________________________________________________________________________________________-->
          <div class="admin-dashone-data-table-area">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="sparkline13-list shadow-reset">
                              <div class="sparkline13-hd">
                                  <div class="main-sparkline13-hd">
                                      <h1>Teams</h1>
                                  </div>
                              </div>
                              <div class="sparkline13-graph">
                                  <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div class="text-left mg-b-40">
                                        <!-- <a id="btnCreateActionItem" href="createActionItem.php" class="btn btn-success btn-sm" >Add New Action Item</a> -->
                                      <button id=""  class="btn btn-success btn-sm" type="button"  data-toggle="modal" data-target="#mdlAddTeam">Add Team</button>

                                    </div>
                                    <?php
                                      $from ="team.php";
                                      include "includes/Team/getTeam.php";

                                    ?>
                                    <div class ="container-fluid">
                                      <div class="row">
                                        <?php foreach($select as $key=>$value)
                                          {
                                        ?>
                                        <div   class="col-lg-3 mg-b-40">
                                          <div class="flip-card " >
                                            <div class="flip-card-inner">
                                              <div class="flip-card-front">
                                                <h1><?php echo $value['teamName']; ?></h1>

                                              </div>
                                              <div class="flip-card-back">
                                                <h1><?php echo $value['teamName'] ?></h1>
                                                <p><a class="btn btn-danger" style="color:yellow" href="qa.php">QAs</a></p>
                                                <p><form id="<?php echo $value['teamId']; ?>" method="post" action="cycle.php">
                                                  <input type="hidden" name="teamId" value="<?php echo $value['teamId']; ?>" />
                                                    <a style="color:yellow" class="btn btn-info" onclick="document.getElementById('<?php echo $value['teamId']; ?>').submit();">Cycles</a>
                                                </form></p>
                                                <p><a class="btn btn-danger" style="color:yellow" href="defect.php">Defects</a></p>
                                                <p><a class="btn btn-warning" style="color:yellow" href="task.php">Tasks</a></p>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <?php
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
            <!--__________________________________________________________________________________________________________________________________________-->
          <!-- stat of content -->

          <!-- <div class="text-center">
              <button style="padding: 15px 32px ;font-size: 16px;"  type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdlAddTeam">Add Team</button>
          </div> -->
          <!-- Modal -->
          <div id="mdlAddTeam" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button id="btnCloseModal" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Team</h4>
                </div>
                <div class="modal-body">
                  <!-- class=" ui-front" -->
                  <form id="frmmodalForm" method="POST"  class=" ui-front" action="includes\Team\addTeam.php">

                      <div class="form-group-inner">
                          <div class="row">
                              <div class="col-sm-3">
                                  <label for="txtPainPoint" class="login2" >Enter Team Name*</label>
                              </div>
                              <div class="col-sm-9">
                                <input id="txtTeamName" name="txtTeamName" type="text" class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <!-- QA START -->
                      <div class="form-group-inner">
                        <div class="row">
                          <div class="col-md-3 col-sm-3 col-xs-3">
                            <label for="txtOwner" class="login2">Add QA</label>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="input-group custom-go-button">
                              <input id="txtQa" name="txtQa" type="text" class="form-control" placeholder="Enter Username ONLY" required>
                              <span class="input-group-btn">
                                <button type="button" id="btnValidateUser" class="btn ">
                                  <i class="fas fa-user-plus" title="Check Username">
                                    <div id="loading-image" style="display: none;" class="loader"><img src="images\ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div>
                                  </i>
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- QA END  !-->
                    </div>
                    <div class="modal-footer">
                      <input id="btnDone" form="frmmodalForm" value="Done" type="submit" class="btn btn-default" >
                    </div>
                  </form>
                </div>

              </div>

            </div>
          </div>
          <br><br>
          <!-- End modal -->

          <!-- end of content -->
        </div>
    </div>
    <!-- Footer Start-->
    <?php include "includes/footer.php";?>
    <!-- Footer End-->







    <script src="js/bootstrap.min.js"></script>
    <script src="js/data-table/bootstrap-table.js"></script>

    <script src="js/data-table/tableExportNew.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <script src="js\bootbox.all.min.js"></script>
    <script src="js\select2\select2.full.min.js"></script>
    <script src="js/date-time-picker/moment-with-locales.js"></script>
    <script src="js/date-time-picker/bootstrap-datetimepicker.min.js"></script>
    <script src="js/data-table/bootstrap-table-filter-control.js"></script>
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/touchspin/touchspin-active.js"></script>
    <script src="js/action-item/action-item.js"></script>
    <script src="js\select2\select2.full.min.js"></script>
    <script type="text/javascript" src="js\selectList\jquery.selectlist.min.js"></script>
    <!-- <script src="js\SearchUser\search.js"></script> -->

    <script>
      var teamNameResults=[];
      var qaUsernameResults=[];
      $(document).ready(function(){
        $("#frmmodalForm :input").on("change keyup",function () {
                $(this).addClass('changed');
                if($("#btnDone").val()=="Update"){
                  $("#btnDone").attr("disabled", false);
                }
        });

        $.ajax({
          url : "includes/Team/getTeam.php",
          type : "GET",
          dataType : "json",
          success: function(data)
          {
            for(i=0; i < data.length ; i++){
              teamNameResults[i]=  data[i].teamName;
            }
            //alert(teamNameResults);

          }
        });

        $.ajax({
          url : "includes/QA/getQa.php",
          type : "GET",
          dataType : "json",
          success: function(data)
          {
            for(i=0; i < data.length ; i++){
              qaUsernameResults[i]=  data[i].qaUsername;
            }
            //alert(teamNameResults);

          }
        });

        disablePN=false;
        disablePC=false;
        $('#txtTeamName').keyup(function(){

          // $('#txtTeamName').closest("div").find('span').remove();
          if(location.search.length>0)
          {
            if($('#txtTeamName').val().replace(/\s+/g, " ").trim()==txtTeamName.replace(/\s+/g, " ").trim())
            {
              $("#txtTeamName")[0].setCustomValidity('');
               $("#txtTeamName").removeClass("changed");
               $("#btnDone").attr("disabled",true);

               return false;
            }
          }

            disablePN=false;
          $.each(teamNameResults,function (index,value) {
            //alert(teamNameResults);
            //alert("value is " + value);
            if(value.toLowerCase()==$('#txtTeamName').val().toLowerCase().replace(/\s+/g, " ").trim())
            {
                  disablePN=true;
                  return false;
            }
          });

          if(disablePN )
          {
            $("#txtTeamName")[0].setCustomValidity("This Team Name already exists");
            $("#txtTeamName")[0].reportValidity();
            return false;
          }
          else{
             $("#txtTeamName")[0].setCustomValidity("");

          }
        });

        //submit a new team
        $('#frmmodalForm').submit(function(e){
          e.preventDefault();

          $("#frmmodalForm :input").not(".changed").not("[type='hidden']").attr("disabled",true);
          formdata=$('#frmmodalForm').serialize();

          $("#frmmodalForm :input").not(".changed").attr("disabled",false);
          $("#frmmodalForm ").find("input[type='hidden']").remove();
          action=$("#btnDone").val();
          url="includes/Team/addTeam.php";

          if(action=="Update")
          {
            url="includes/Team/updateTeam.php";
          }


          $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            dataType : 'json',
            error: function(xhr){
              alert(formdata);
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
          }).done(function(data, status){

            if (status== "success"){

              if(data.success)
              {

                  $("#frmmodalForm")[0].reset();
                  $("#btnDone").val("Done");
                  $("#mdlAddTeam div.modal-header h4.modal-title").text("Add New Team");
                  $('#mdlAddTeam').modal('hide');
                  location.reload();


              }
            }
          });

        });

        $('#mdlAddTeam').on('hide.bs.modal ', function(event) {
          var $activeElement = $(document.activeElement);
          $("#frmmodalForm")[0].reset();

        });




      });
    </script>

</body>
</html>
