<!doctype html>
<?php session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
  include 'includes/db_connect.php';
  $selectConfig= "SELECT * FROM config";
  $selectConfig=$conn->query($selectConfig);
  $selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);
  $superusers = explode("|", $selectConfig[0]["superusers"]);


 ?>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Analytics";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/charts.css">
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">

    <style>
    .custom-datatable-overright table tbody tr td.datatable-ct{
          color: red;
    }
    /* .bootstrap-table .table thead > tr > td {
        padding: 0;
        margin: 0;
    } */
    .mg-b-100{
    	margin-bottom:100px;
    }
    .fa.fa-times:hover{
      cursor:default;
    }
        .form-control.select2-hidden-accessible {
            top: 30px;
            left : 25%;
        }
        .name {

        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 250px;
        }
        .name:hover{
         overflow: visible;
         word-break: break-word;
        }
    </style>
</head>


<body class="materialdesign">
        <div class="wrapper-pro">
          <?php $activeApp="il" ?>
        <?php include "../includes/sidebar.php"; ?>
            <div class="content-inner-all">


                <?php
                    $active='';
                    include 'includes/menu.php';
                 ?>


                 <div class="container-fluid mg-b-40" >
                   <div class="transition-world-area">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-lg-12">
                                   <div class="transition-world-list shadow-reset">
                                       <div class="sparkline7-list">
                                           <div class="sparkline7-hd">
                                               <div class="main-spark7-hd">
                                                   <h1>Analytics <span class="res-ds-n"></span></h1>
                                               </div>
                                           </div>
                                           <div class="sparkline7-graph">
                                               <div class="row mg-b-100">
                                                   <div class="col-lg-12">
                                                       <div class="datatable-dashv1-list custom-datatable-overright dashtwo-project-list-data">
                                                           <div id="toolbar">
                                                               <select class="form-control" id="drpAnalysis">
                                                                   <option value="Activity">Activity</option>
                                                                   <option value="Project">Project</option>

                                                               </select>
                                                           </div>
                                                           <table id="tblAnalytics" >


                                                           </table>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="row mg-t-30">
                                                 <div class="col-lg-10">
                                                   <div class="vectorjsmarp" id="graph">
                                                      <canvas id="barChart" ></canvas>
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
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <script src="js\bootbox.all.min.js"></script>

      <script src="js\select2\select2.full.min.js"></script>
    <!-- main JS
		============================================ -->

    <script src="js\bootbox.all.min.js"></script>
    <script src="js/charts/Chart.js"></script>
    <script src="js\charts\chartjs-plugin-colorschemes.js"></script>


    <script type="text/javascript">

      $(document).ready(function(){

          $("#drpAnalysis").select2({
            placeholder : "Choose an analytics",
            width:"100%"
          });

          var table=$("#tblAnalytics");


          $("#drpAnalysis").change(function(e){
            var val=$("#drpAnalysis").val();

            table.bootstrapTable('destroy');
            if(val=="Activity")
            {

              table.bootstrapTable(
                {

                  url           : 'includes/Analytics/perActivity.php',
                  method        : "post",
                  pagination    : true,
                  search        : true,
                  showRefresh   : true,
                  striped       : true,
                  columns       : [{
                                      field: 'activity',
                                      title: 'Activity',
                                      sortable: true,

                                    },{
                                      field: 'manDaysLost',
                                      title: 'ManDays Lost',
                                      sortable: true,

                                    }],
                onLoadSuccess : function(data)
                {
                  // $("#barChart1").hide();
                  $("#graph").empty();
                  $("#graph").append('<canvas id="barChart" ></canvas>');
                  var ctx=$("#graph").find('canvas');
                  labels=data.map(x=>x.activity);
                  values=data.map(x=>x.manDaysLost);
                  var barchart2 = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                      labels: labels,
                      datasets: [{
                        // label: 'Dataset 1',
                        data: values,
                        backgroundColor: [
                             'rgba(255, 99, 132, 1)',
                             'rgba(54, 162, 235, 1)',
                             'rgba(255, 206, 86, 1)',
                             'rgba(75, 192, 192, 1)',
                             'rgba(153, 102, 255, 1)',
                             'rgba(255, 159, 64, 1)'
                         ],
                     }]
                    },
                    options: {

                      legend: {
                          display: false
                      },
                      responsive: true,
                      scales: {
                        xAxes: [{
                          scaleLabel: {
                             display: true,
                             labelString: 'Mandays Lost'
                           }
                        }],
                        yAxes: [{
                          scaleLabel: {
                             display: true,
                             labelString: 'Activity'
                           },
                           ticks : {
                             min :0,

                           }
                        }]
                      }
                    }
                  });
                }
              });
            }
            else{
              table.bootstrapTable(
                {

                  url           : 'includes/Analytics/perProject.php',
                  method        : "post",
                  pagination    : true,
                  search        : true,
                  showRefresh   : true,
                  striped       : true,
                  columns       : [{
                                      field: 'projectName',
                                      title: 'Project',
                                      sortable: true,

                                    },{
                                      field: 'manDaysLost',
                                      title: 'ManDays Lost',
                                      sortable: true,

                                    }],
                onLoadSuccess : function(data)
                {
                  $("#graph").empty();
                  $("#graph").append('<canvas id="barChart" ></canvas>');
                  var ctx=$("#graph").find('canvas');
                  labels=data.map(x=>x.projectName);
                  values=data.map(x=>x.manDaysLost);
                  var barchart2 = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                      labels: labels,
                      datasets: [{
                        // label: 'Dataset 1',
                        data: values
                     }]
                    },
                    options: {

                      legend: {
                          display: false
                      },
                      responsive: true,
                      scales: {
                        xAxes: [{
                          scaleLabel: {
                             display: true,
                             labelString: 'ManDays Lost '
                           }
                        }],
                        yAxes: [{
                          scaleLabel: {
                             display: true,
                             labelString: 'Project Name'
                           },
                           ticks : {
                             min :0,

                           }
                        }]
                      }
                    }
                  });
                }
              });
            }

          });

          $(function (e) {
            $("#drpAnalysis").trigger('change');

          });
      });

  </script>

</body>

</html>
