<?php

  session_start();
  $_SESSION['Username']="faraju";
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
    include 'includes/db_connect.php';

  if(!isset($_POST['teamId'])){
    header("Location: team.php");




  }

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Cycle";
      include 'includes/head.php';
    ?>
  <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
  <link rel="stylesheet" href="css\data-table\bootstrap-table-group-by.css">
  <link rel="stylesheet" href="css/datapicker/datepicker3.css">
  <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
  <link rel="stylesheet" href="css\touchspin/jquery.bootstrap-touchspin.min.css" type="text/css"/>
  <link href="css/date-time-picker/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <style>
  /* #drpActionItem{
    display: none;
  } */
  .form-control.select2-hidden-accessible {
      top: 30px;
      left : 25%;
      margin-left: -74px;
  }
    td{
      position:relative;
    }
    .center{
      min-width: 70px;
      position: absolute;
      left: 46%;
      top: 50%;
      transform: translate(-50%, -50%);
    }
    .icoAddActionItem {
        position: absolute;
        bottom:6px;
        right: 6px;
        /* z-index: 10; */
        text-align:right;
        vertical-align:bottom;
      }
      .icoAddComment {
          position: absolute;
          bottom: 6px;
          right: 6px;
           z-index: 10;
          text-align:right;
          vertical-align:bottom;
        }


    i.icoEditComment{
      color: #ccc;
    }
    i.icoEditComment:hover{
      color:black;
      /* fill: red; */
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
    body > div.wrapper-pro > div.content-inner-all > div.admin-dashone-data-table-area > div > div > div > div > div.sparkline8-graph > div > div.bootstrap-table > div.fixed-table-container > div.fixed-table-body > table > thead > tr:nth-child(1) > th:nth-child(3) > div.th-inner {
      text-align: center;
    }
    i.icoAdd {
      margin: 0 10px 5px 0;
    }

    .icoDeleteComment{
      margin-left: 3px;
      color: #ccc;
    }
    .icoDeleteComment:hover{
      color:red;
    }
    .hrActionItem{
      margin:2px 0 5px 0;
    }
    .actionitems:hover{
      color:#03a9f0;
    }
    .icoRemovePainPoint{
      color: #ccc;
    }
    .icoRemovePainPoint:hover{
      color: red;
    }
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
          $active="cycle";
            include 'includes/menu.php';
            //var_dump($_POST);
          ?>

          <!-- begin -->

          <div class="text-center">
              <button style="padding: 15px 32px ;font-size: 16px;"  type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdlAddCycle">Add New Cycle</button>
          </div>
          <!-- Modal -->
          <div id="mdlAddCycle" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog ">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header ">
                  <button id="btnCloseModal" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Cycle</h4>
                </div>
                <div class="modal-body">
                  <!-- class=" ui-front" -->
                  <form id="frmmodalForm" method="POST"  class=" ui-front " action="includes\Cycle\addCycle.php">
                    <div class="form-group text-left text-center">
                      <label  for="txtDevStartVelocity" class="form-control-label">Dev Start Velocity</label>
                      <input id="txtDevStartVelocity" required type="number" class="form-control" name="txtDevStartVelocity" style="width: 100px; margin: 0 auto;">
                    </div>
                    <div class="form-group text-left text-center">
                      <label  for="txtDevEndVelocity" class="form-control-label">QA Start Velocity</label>
                      <input id="txtDevEndVelocity" required type="number" class="form-control" name="txtDevEndVelocity" style="width: 100px; margin: 0 auto;">
                    </div>
                    <!-- <div class="form-group text-left text-center">
                      <label  for="txtQaStartVelocity" class="form-control-label">Dev End Velocity</label>
                      <input id="txtQaStartVelocity" required type="number" class="form-control" name="txtQaStartVelocity" style="width: 100px; margin: 0 auto;">
                    </div>
                    <div class="form-group text-left text-center">
                      <label  for="txtQaEndtVelocity" class="form-control-label">QA End Velocity</label>
                      <input id="txtQaEndtVelocity" required type="number" class="form-control" name="txtQaEndVelocity" style="width: 100px; margin: 0 auto;">
                    </div> -->
                  </form>
                </div>
                <div class="modal-footer">
                  <input id="btnDone" form="frmmodalForm" value="Done" type="submit" class="btn btn-default" >
                </div>
              </div>

            </div>
          </div><br><br>


          <!-- end -->
        </div>
    </div>
    <!-- Footer Start-->
    <?php include "includes/footer.php";?>
    <!-- Footer End-->
    <!-- jquery
		============================================ -->
  <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExportNew.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <script src="js/data-table/bootstrap-table-group-by.js"></script>
    <!-- Select2
		============================================ -->
    <script src="js\select2\select2.full.min.js"></script>
    <!-- DatePicker
		============================================ -->


    <!-- TouchSpin
    ============================================ -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/touchspin/touchspin-active.js"></script>

    <!-- Date-Time-Picker
    ============================================ -->
    <script src="js/date-time-picker/moment-with-locales.js"></script>
    <script src="js/date-time-picker/bootstrap-datetimepicker.min.js"></script>

    <!-- <script src="js/main.js"></script> -->

    <!-- <script src="js/main.js"></script> -->
    <!-- Action Item form etc..
    ============================================  -->
    <script src="js/action-item/action-item.js"></script>


    <script src="js\bootbox.all.min.js"></script>
  <script src="js/datapicker/bootstrap-datepicker.js"></script>


    <!-- Scripts for formatting and comment management -->
    <script>


    </script>
</body>
</html>
