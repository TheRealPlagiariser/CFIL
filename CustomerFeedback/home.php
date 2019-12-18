<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: ../index.php");
}

 include 'includes/db_connect.php';
 $selectCount="SELECT
  (SELECT COUNT(*) FROM question WHERE deleted=0) as question,
  (SELECT COUNT(*) FROM project WHERE deleted=0) as project,
  (SELECT COUNT(*) FROM template WHERE deleted=0) as template,
  (SELECT COUNT(*) FROM (SELECT  survey.surveyId as survey,count(username)FROM survey JOIN survey_answer USIng(surveyId) WHERE deleted = 0 AND dateCompleted IS NOT NULL GROUP by surveyId) surv ) as survey";
  $selectCount=$conn->query($selectCount);
  $selectCount=$selectCount->fetchALL(PDO::FETCH_ASSOC);



?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $title="Home";
        include 'includes/head.php';
     ?>
    <!-- charts CSS
    ============================================ -->
    <link rel="stylesheet" href="css/charts.css">
    <style media="screen">
      .transition-world-list .author-permissio-wrap{
        border:1px solid black;
      }
    </style>
</head>

<body class="materialdesign">

    <div class="wrapper-pro">
      <?php $activeApp="cf" ?>
      <?php include "../includes/sidebar.php"; ?>

        <div class="content-inner-all">
            <!-- Header top area start-->

            <?php $active="home"; include "includes/menu.php"; ?>
            <!-- Header top area end-->


            <div class="income-order-visit-user-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="income-dashone-total shadow-reset nt-mg-b-30">
                                <div class="income-title">
                                    <div class="main-income-head">
                                        <h2>Question</h2>
                                        <div class="main-income-phara">
                                            <a href='question.php'><p>View Details</p></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span></span><span class="counter"><?php echo $selectCount[0]['question'] ?></span></h3>
                                        </div>

                                    </div>
                                    <div class="income-range">
                                        <p>Questions Available</p>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="income-dashone-total shadow-reset nt-mg-b-30">
                                <div class="income-title">
                                    <div class="main-income-head">
                                        <h2>Project/CR/Task</h2>
                                        <div class="main-income-phara order-cl">
                                            <a href='project.php'><p>View Details</p></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $selectCount[0]['project'] ?></span></h3>
                                        </div>

                                    </div>
                                    <div class="income-range order-cl">
                                        <p>Project/CR/Task Available</p>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="income-dashone-total shadow-reset nt-mg-b-30">
                                <div class="income-title">
                                    <div class="main-income-head">
                                        <h2>Template</h2>
                                        <div class="main-income-phara visitor-cl">
                                            <a href='template.php'><p>View Details</p></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $selectCount[0]['template'] ?></span></h3>
                                        </div>

                                    </div>
                                    <div class="income-range visitor-cl">
                                        <p>Templates Available</p>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="income-dashone-total shadow-reset nt-mg-b-30">
                                <div class="income-title">
                                    <div class="main-income-head">
                                        <h2>Survey</h2>
                                        <div class="main-income-phara low-value-cl">
                                          <a href='survey.php'><p>View Details</p></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $selectCount[0]['survey'] ?></span></h3>
                                        </div>

                                    </div>
                                    <div class="income-range low-value-cl">
                                        <p>Survey Ongoing</p>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="transition-world-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="transition-world-list shadow-reset">
                                <div class="sparkline7-list">
                                    <div class="sparkline7-hd">
                                        <div class="main-spark7-hd">
                                            <h1>Latest <span class="res-ds-n">Surveys</span></h1>
                                        </div>
                                    </div>
                                    <div class="sparkline7-graph">
                                        <div class="row">
                                          <?php
                                          $selectDetails=" SELECT  surveyId,
                                                                   surveyName,
                                                                   templateName,
                                                                   CONCAT(project.projectCode,' - ',project.projectName)as projectName,
                                                                   cycleName,
                                                                   COUNT(DISTINCT survey_answer.username) as numResponse
                                                            FROM survey JOIN template USING(templateId)
                                                            JOIN cycle USING(cycleId)
                                                            JOIN project USING(projectId)
                                                            JOIN survey_user USING(surveyId)
                                                            LEFT JOIN survey_answer USING(surveyId)
                                                            WHERE dateSent IS NOT NULL
                                                            AND survey_answer.dateCompleted IS NOT NULL
                                                            GROUP BY survey.surveyId
                                                            ORDER BY survey.dateCreated DESC
                                                            LIMIT 4";

                                            $selectDetails=$conn->query($selectDetails);
                                            if($selectDetails->rowCount()==0)
                                            {
                                                echo "<span style='text-align:left' class='col-lg-12 alert alert-warning'> No survey Available </span>";
                                            }
                                            else{


                                            while($row=$selectDetails->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                              <div class="author-permissio-wrap shadow-reset">

                                                    <div  id="divSurveyDetails"  class="datatable-dashv1-list custom-datatable-overright">
                                                      <div class="row">
                                                        <label class="col-md-6 ">Survey</label>
                                                        <span id="spanSurveyName" title=""><?php echo $row["surveyName"] ?></span>
                                                          <hr/>
                                                      </div>

                                                      <div class="row">
                                                        <label class="col-md-6 ">Project Name </label>
                                                        <span id="spanProjectName" title=""><?php echo $row["projectName"] ?></span>
                                                          <hr/>
                                                      </div>

                                                      <div class="row">
                                                        <label class="col-md-6">Cycle</label>
                                                        <span class="col-md-6" id="spanCycleName" class=""><?php echo $row["cycleName"] ?></span>
                                                          <hr/>
                                                      </div>
                                                      <div class="row">
                                                        <label class="col-md-6">Number of reponse</label>
                                                        <span id="spanNumResponse" class=""><?php echo $row["numResponse"] ?></span>
                                                          <hr/>

                                                      </div>
                                                      <a href="analytics.php?surveyId=<?php echo $row['surveyId'] ?>">View More Details</a>

                                                    </div>
                                              </div>
                                            </div>
                                            <?php
                                              }
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


            <div class="charts-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-8">
                          <div class="charts-single-pro shadow-reset nt-mg-b-30">
                              <div class="alert-title">
                                  <h2>Project Overview</h2>
                              </div>
                              <div style="height:25%" id="bar1-chart2">
                                  <canvas id="barChart2"></canvas>
                              </div>
                          </div>

                        </div>
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
    <!-- meanmenu JS
		============================================ -->
    <!-- <script src="js/jquery.meanmenu.js"></script> -->
    <!-- mCustomScrollbar JS
		============================================ -->
    <!-- <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> -->
    <!-- sticky JS
		============================================ -->
    <!-- <script src="js/jquery.sticky.js"></script> -->
    <!-- scrollUp JS
		============================================ -->
    <!-- <script src="js/jquery.scrollUp.min.js"></script> -->
    <!-- scrollUp JS
		============================================ -->
    <!-- <script src="js/wow/wow.min.js"></script> -->
    <!-- scrollUp JS
		============================================ -->
    <!-- <script src="js/skycons/skycons.min.js"></script>
    <script src="js/skycons/skycons.active.js"></script> -->
    <!-- counterup JS
		============================================ -->
    <!-- <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script> -->
    <!-- peity JS
		============================================ -->
    <!-- <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script> -->
    <!-- sparkline JS
		============================================ -->
    <!-- <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script> -->
    <!-- rounded-counter JS
		============================================ -->
    <!-- <script src="js/rounded-counter/jquery.countdown.min.js"></script>
    <script src="js/rounded-counter/jquery.knob.js"></script>
    <script src="js/rounded-counter/jquery.appear.js"></script>
    <script src="js/rounded-counter/knob-active.js"></script>

    <script src="js/main.js"></script> -->
    <script src="js/charts/Chart.js"></script>
    <script src="js\charts\chartjs-plugin-colorschemes.js"></script>

    <!-- <script src="js/charts/bar-chart.js"></script> -->
    <script type="text/javascript">
      $(document).ready(function (e) {
        $(function () {
          jQuery.ajax({
            url : "includes/Analytics/summaryForHome.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false
          })
          .done(function (data)  {
            // if(data.survey.length==0)
            // {
            //     $("#bar1-chart1").empty();
            //     $("#bar1-chart1").css("height","403px");
            //       $("#bar1-chart1").append("<div class='row'><span class='col-lg-12 alert alert-warning'> No survey Available </span></div>");
            // }
            // else{
            //   labels=data.survey.map(x=>x.surveyName);
            //   values=data.survey.map(x=>x.numResponse);
            //   var ctx=$("#barchart1");
            //   ctx.height = '500px';
            //   ctx.width = '500px';
            //   var barchart1 = new Chart(ctx, {
            //     type: 'bar',
            //     data: {
            //       labels: labels,
            //       datasets: [{
            //
            //         data: values
            //      }]
            //     },
            //     options: {
            //
            //       legend: {
            //           display: false
            //       },
            //       responsive: true,
            //       scales: {
            //         xAxes: [{
            //           scaleLabel: {
            //              display: true,
            //              labelString: 'Survey Name'
            //            }
            //         }],
            //         yAxes: [{
            //           scaleLabel: {
            //              display: true,
            //              labelString: 'Number of Response'
            //            },
            //            ticks : {
            //              min :0,
            //              stepSize :1
            //            }
            //         }]
            //       }
            //     }
            //   });
            // }

            if(data.project.length==0)
            {
              $("#bar1-chart2").empty();
              $("#bar1-chart2").css("height","403px");
                $("#bar1-chart2").append("<div class='row'><span class='col-lg-12 alert alert-warning'> No data Available </span></div>");

            }
            else{
              labels=[];
              dataset=[];

                // // console.log(dataset);
              // label
              $.each(data.project,function (project,projectValue) {
                labels.push(projectValue[0].projectName); // label on x-axis

                $.each(projectValue,function(survey,surveyValue){

                  dataset[surveyValue.cycleName]=[];

                });
                // $.each(projectValue,function(survey,surveyValue){
                //   dataset[surveyValue.cycleName].push(surveyValue.numResponse);
                //
                //
                //
                // });
                // datasetLabels=Object.keys(dataset);
                // datasetValues=Object.values(dataset);
                // $.each(datasetLabels,function (index,value) {
                //   // console.log("datasetValues");
                //   // console.log(datasetLabels);
                //   // console.log(datasetValues);
                //     // console.log("datasetValues");
                //   // if(value==surveyValue.cycleName){
                //   //
                //   // }else{
                //   //     // dataset[value].push(0);
                //   // }
                //
                // })

              });

              $.each(data.project,function (project,projectValue) {
                // console.log("Project" ,project);
                cycleName=projectValue.map(x=>x.cycleName);
                numResponse=projectValue.map(x=>x.numResponse);
                // $.each(projectValue,function(survey,surveyValue){
                //   // console.log(surveyValue.surveyId);
                //   dataset[surveyValue.cycleName].push(surveyValue.numResponse);
                // });
                datasetLabels=Object.keys(dataset);
                // datasetValues=Object.values(dataset);
                $.each(datasetLabels,function(index,value){
                  indexof= cycleName.indexOf(value);
                  if(indexof!=-1)
                  {
                    dataset[value].push(numResponse[indexof]);
                  }
                  else{
                    dataset[value].push(0);
                  }
                });
                // // console.log("dataset");
                // // console.log(cycleName);
                // // console.log(numResponse);
                // // console.log("dataset");


              });


              // dataset.push({label : datasetLabel,data:datasetValues});
              // console.log("wrdah");
              // console.log(dataset);
                // console.log("wrdah");
              datasetLabels=Object.keys(dataset);
              datasetValues=Object.values(dataset);
              dataset=[];
              $.each(datasetLabels,function (index,value) {
                dataset.push({label : value, data : datasetValues[index]});
              })

                  // console.log(dataset);
                // dataset=JSON.parse(dataset);
              var ctx=$("#barChart2");

              var barchart2 = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: labels,
                  // datasets: [{
                  //         label :"SIT",
                  //         data: [2]
                  //      },
                  //      {
                  //        label :"UAT",
                  //        data: [1]
                  //     }
                  //    ]
                 datasets : dataset
                },
               // data :dataset,

                options: {
                  // legend: {
                  //     display: false
                  // },
                  responsive: true,
                  scales: {
                    xAxes: [{
                      scaleLabel: {
                         display: true,
                         labelString: 'Project '
                       }
                    }],
                    yAxes: [{
                      scaleLabel: {
                         display: true,
                         labelString: 'Number of Response'
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



          })
          .fail(function(xhr){
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });
      })
    </script>
</body>

</html>
