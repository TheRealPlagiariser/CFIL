<!doctype html>
<?php session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
  include 'includes/db_connect.php';



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
    .fa.fa-times:hover{
      cursor:default;
    }

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
          <?php $activeApp="cf" ?>
        <?php include "../includes/sidebar.php"; ?>
            <div class="content-inner-all">


                <?php
                    $active='survey';
                    include 'includes/menu.php';
                 ?>
                 <div class="container-fluid">
                   <div class="breadcome-area mg-b-30 ">
                     <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top:0px">
                         <div class="row ">
                          <div style="padding-left:10px">
                             <ul class="breadcome-menu pull-left">
                                 <li><a href="survey.php">Survey</a> <span class="bread-slash">/</span>
                                 </li>
                                 <li><span class="bread-blod">Analytics</span>
                                 </li>
                             </ul>
                           </div>
                           <div class="pull-right col-sm-4">
                             <form class="form-horizontal" action="index.html" method="post" id='frmSelectSurvey'>
                                <div class="form-group" >
                                  <label for="cmbProject" style="text-align:right;"  class="col-sm-4 control-label ">Select Survey</label>
                                 <div class="col-sm-5" style="padding-right:0">

                                   <select id="drpSurvey"  title="project name project code" placeholder = "Choose a project" class="form-control" name="drpSurvey"  required>


                                     <?php



                                           $SelectProject="  SELECT
                                                                surveyId,
                                                                surveyName
                                                            FROM
                                                                survey
                                                            JOIN survey_answer USING(surveyId)
                                                            WHERE
                                                                deleted = 0 AND dateCompleted IS NOT NULL
                                                            GROUP BY
                                                                survey.surveyId
                                                            HAVING
                                                                COUNT(DISTINCT username) > 0
                                                            ORDER BY
                                                                dateCreated
                                                            DESC";
                                           $SelectProject=$conn->query($SelectProject);
                                            while($row=$SelectProject->fetch(PDO::FETCH_ASSOC)){
                                              if(isset($_GET['surveyId']) && $_GET['surveyId']==$row['surveyId'] )
                                              {
                                                  echo ' <option selected value="'.$row["surveyId"].'"> '.$row["surveyName"].'</option>';
                                              }
                                              else{
                                                  echo ' <option value="'.$row["surveyId"].'"> '.$row["surveyName"].'</option>';
                                              }

                                            }


                                      ?>
                                      </optgroup>
                                   </select>
                                 </div>
                                 <div >
                                    <i id="btnSearch" class="fa fa-search btn btn-default" aria-hidden="true" style="    height: 33px;"></i>
                                 </div>
                                </div>

                             </form>
                           </div>
                         </div>
                     </div>
                   </div>
                 </div>

                 <div class="container-fluid mg-b-40" >
                     <div class="row mg-b-10">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <!-- <h1>Survey Description <a  style="float:right"type="button" class="btn btn-default" href='' id="btnDownload"><i class='fa fa-download'></i> Download</a> </h1> -->
                                         <h1>
                                           Survey Description
                                           <!-- <a  style="float:right"type="button" class="btn btn-default" id="btnDownloadpdf" href='downloadpdf.php' >
                                             <i class='fa fa-download'></i> PDF
                                           </a> -->
                                           <a  style="float:right"type="button" class="btn btn-default" id="btnDownload" href='download.php' >
                                             <i class='fa fa-download'></i> Excel
                                           </a>
                                         </h1>


                                     </div>
                                 </div>

                                 <div  class="sparkline8-graph" style="text-align:left;">
                                     <div  id="divSurveyDetails"  class="datatable-dashv1-list custom-datatable-overright">
                                       <div class="row">
                                         <label class="col-md-2 ">Survey</label>
                                         <span id="spanSurveyName" title=""><?php //echo $select[0]["surveyName"] ?></span>
                                       </div>
                                       <div class="row">
                                         <label class="col-md-2 ">Project  </label>
                                         <span id="spanProjectName" title=""><?php //echo $select[0]["projectName"] ?></span>
                                       </div>

                                       <div class="row">
                                         <label class="col-md-2">Cycle</label>
                                         <span id="spanCycleName" class=""><?php //echo $select[0]["cycleName"] ?></span>
                                       </div>
                                       <div class="row">
                                         <label class="col-md-2">Number of reponse</label>
                                         <span id="spanNumResponse" class=""><?php //echo $select[0]["templateName"] ?></span>

                                       </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="row" id="divInner" style="backgroud-color:white">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1> Question </h1>
                                     </div>
                                 </div>
                                 <div class="sparkline8-graph" style="text-align:left;">
                                     <div class="datatable-dashv1-list custom-datatable-overright">
                                       <div id="divAnalytics" class="row">

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
    <!-- <script src="js/main.js"></script> -->
    <script src="js\bootbox.all.min.js"></script>
    <script src="js/charts/Chart.js"></script>
    <!-- <script src="js\charts\chartjs-plugin-labels.min.js"></script> -->
    <script src="js\charts\chartjs-plugin-colorschemes.js"></script>
    <script src="js\SearchUser\search.js"></script>
    <script type="text/javascript" src="js/export/jspdf.debug.js"></script>
    <script src='js/export/html2pdf.js'></script>
    <script type="text/javascript" src="js/export/html2canvas.js"></script>

      <script type="text/javascript" src="js/export/from_html.js"></script>
        <script type="text/javascript" src="js/export/split_text_to_size.js"></script>
          <script type="text/javascript" src="js/export/standard_fonts_metrics.js"></script>
    <?php //include "sendSurvey.php"; ?>
    <script type="text/javascript">

      $(document).ready(function(){

          $("#drpSurvey").select2({
            placeholder : "Choose A Project",
            width:"100%"
          });

          $.getSurveyDetails=function (data) {
            if(data=='')
            {

            }
            else{
              jQuery.ajax({
                url : "includes/Analytics/getSurveyDetails.php",
                type : "post",
                dataType : "json",
                encode : true,
                cache : false,
                data :data
              }).done(function (data)
              {
                  console.log(data)
                  $("#spanSurveyName").text(data['surveyDetails'][0].surveyName);
                  $("#spanProjectName").text(data['surveyDetails'][0].projectName);
                  $("#spanCycleName").text(data['surveyDetails'][0].cycleName);
                  $("#spanNumResponse").text(data['surveyDetails'][0].numResponse);



                  $("#divAnalytics").empty();
                  count=0;
                  //create the containers where the question will be found
                  $.each(data['surveyQuestions'],function (questionId,value) {

                    count++;
                    if(value[0].questionType!='FreeText')
                    {
                      canvas='<div class="charts-single-pro shadow-reset nt-mg-b-30">\
                          <div class="alert-title">\
                              <h2>'+count+'. '+value[0].question+'</h2>\
                          </div>\
                          <div style="height:400px;width:500px" id="chart'+questionId+'">\
                              <input type="hidden" name="index" value="'+questionId+'">\
                              <canvas style="width:600px;height:400px"  ></canvas>\
                          </div>\
                      </div>';
                    }else{
                      canvas='<div class="charts-single-pro shadow-reset nt-mg-b-30">\
                          <div class="alert-title">\
                              <h2>'+count+'. '+value[0].question+'</h2>\
                          </div>\
                          <div style="" id="chart'+questionId+'">\
                              <input type="hidden" name="index" value="'+questionId+'">\
                              <table id="tblFreetext'+questionId+'" >\
                              </table>\
                          </div>\
                      </div>';
                    }
                    $("#divAnalytics").append(canvas);

                  });

                  //loop through the containers and add the the charts
                  $("div[id^='chart']").each(function () {

                    var index=$(this).find("input[type='hidden'][name='index']").val();
                    answer=[];
                    labels=data['surveyQuestions'][index].map(x=>x.possibleAnswer);

                    draw=false;
                    var type="";
                    var noData=false;
                    $.each(data['surveyQuestions'][index],function (answerId,value) {
                      type=value['questionType'];

                      if(type=='FreeText')
                      {
                        if(value['username']!=""){
                          numUser=value['username'].split(",");
                          answer=value['answers'].split("|");
                        }
                        else{
                          noData=true;
                        }

                      }
                      else if(type=='Choice')
                      {
                        draw=true;
                        chartType='bar';
                        if(value['username']!=""){
                          numUser=value['username'].split(",");
                          answer[value['possibleAnswer']]=numUser.length;
                        }else{
                          answer[value['possibleAnswer']]=0;
                        }
                      }
                      else if(type=='Scale')
                      {
                        if(value['username']!=""){
                          numUser=value['username'].split(",");
                          answer[value['possibleAnswer']-1]=numUser.length;

                        }else{
                          answer[value['possibleAnswer']-1]=0;
                        }

                        // labels=$(this).find("input[type='hidden'][name='questionType']").val().split(',');
                        // answer=data['surveyQuestions'][3].map(x=>x.answer);
                      }

                    });


                    if(type=="Choice")
                    {
                        var ctx=$(this).find("canvas");
                        ctx.height = 500;
                        ctx.width = 500;
                        var myChart = new Chart(ctx, {
                          type: 'pie',
                          data: {
                            labels: labels,
                            datasets: [{
                              label: 'pie charts',
                              // backgroundColor: [
                              //   'rgb(255, 99, 132)',
                              //   'rgb(255, 159, 64)',
                              //   'rgb(255, 205, 86)',
                              //   '#03a9f4',
                              //   '#303030',
                              //   '#A70027'
                              // ],
                              data: Object.values(answer)
                                  }]
                          },
                          options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins : {
                              labels: [

                                {
                                  render: 'percentage',
                                  fontColor: '#000',
                                    precision: 2
                                }
                              ],
                              colorschemes: {
                                    scheme: 'brewer.Paired12'
                                }
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                      var allData = data.datasets[tooltipItem.datasetIndex].data;
                                      var tooltipLabel = data.labels[tooltipItem.index];
                                      var tooltipData = allData[tooltipItem.index];
                                      var total = 0;
                                      for (var i in allData) {
                                        total += allData[i];
                                      }
                                      var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                      return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                                    }
                                  }
                            }

                          }
                        });
                    }
                    else if(type=="Scale")
                    {
                      // console.log(labels);
                      labels.sort(function(a, b) {
                          return a - b;
                      });

                      // console.log(labels);
                      var ctx=$(this).find("canvas");
                      ctx.height = '500px';
                        ctx.width = '500px';
                      var barchart2 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                          labels: labels,
                          datasets: [{
                            // label: 'Dataset 1',
                            data: answer
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
                                 labelString: 'Scale'
                               }
                            }],
                            yAxes: [{
                              scaleLabel: {
                                 display: true,
                                 labelString: 'Number of user'
                               },
                               ticks : {
                                 min :0,
                                 stepSize :1
                               }
                            }]
                          }
                        }
                      });

                    }
                    else{
                      if(!noData)
                      {
                        Userdata=[];
                        $.each(numUser,function(userIndex,value){
                          Userdata.push({"Username" : value,"Answer" : answer[userIndex]})
                        });
                        var table=$(this).find("table");
                        // console.log(table);
                        // table.bootstrapTable({
                        //   data : Userdata,
                        //   onPostBody : function(data)
                        //   {
                        //     alert("success");
                        //   }
                        // });
                        table.bootstrapTable({
                          data :Userdata,
                          columns : [
                                      {
                                        field: 'Username',
                                        title: 'Username',
                                        sortable: true,
                                      },{
                                        field: 'Answer',
                                        title: 'Answer',
                                        sortable: true,
                                      }
                                    ]
                        });
                      }
                    }
                  });


              }).fail(function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
              });
            }


          };//end of function

          $("#btnSearch").click(function (e) {
            var val=$("#frmSelectSurvey").serialize();

            $.getSurveyDetails(val);
          })
          $("#drpSurvey").change(function(e){
            var val=$("#frmSelectSurvey").serialize();

            $.getSurveyDetails(val);
          })

          $(function (e) {
            $("#btnSearch").trigger('click');

          });

          $("#btnDownload").click(function(e){
            var val=$("#drpSurvey").val();
            // alert("val"+val);
            $(this).attr('href',"download.php?surveyId="+val);
            //remove jsPDF on 25/07/2019


          });
          $("#btnDownloadpdf").click(function(e){
            var val=$("#drpSurvey").val();

            $(this).attr('href',$(this).attr("href")+"?surveyId="+val);
            //remove jsPDF on 25/07/2019


          });



      });

  </script>

</body>

</html>
