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


 ?>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Config";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/charts.css">
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">

    <link rel="stylesheet" href="css\touchspin/jquery.bootstrap-touchspin.min.css" type="text/css"/>
    <link href="css/date-time-picker/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
        .comment {
          font-style: italic;
          color:#a0a09d;
        }
    </style>
</head>


<body class="materialdesign">
        <div class="wrapper-pro">
          <?php $activeApp="cf" ?>
          <?php include "../includes/sidebar.php"; ?>
            <div class="content-inner-all">


                <?php
                $active='';
                    include 'includes/menu.php';
                 ?>


                 <div class="container-fluid mg-b-40" >
                     <div class="row mg-b-10">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <!-- <h1>Survey Description <a  style="float:right"type="button" class="btn btn-default" href='' id="btnDownload"><i class='fa fa-download'></i> Download</a> </h1> -->
                                         <h1>
                                           General Configuration
                                         </h1>


                                     </div>
                                 </div>

                                 <div  class="sparkline8-graph" style="text-align:left;">
                                     <div  id="divSurveyDetails"  class="datatable-dashv1-list custom-datatable-overright">
                                       <div class="row">
                                         <label class="col-md-2 ">DNS</label>
                                         <span  class="col-md-8 "  id="spanDNS" title=""><?php echo $selectConfig[0]["dns"] ?></span>
                                       </div>
                                       <div class="text-right ">
                                          <button id="btnEditGeneralConfiguration" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditGeneralConfiguration"> Edit General Configuration</button>
                                       </div>

                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>

                     <div class="row row mg-b-10"  >
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1> Question Configuration</h1>
                                     </div>
                                 </div>
                                 <div class="sparkline8-graph" style="text-align:left;">
                                   <div  id="divSurveyDetails"  class="datatable-dashv1-list custom-datatable-overright">
                                     <div class="row mg-b-10">
                                       <label class="col-md-2 ">Scale Lower Bound</label>
                                       <?php
                                        $lowerBound=explode(",",$selectConfig[0]['question_type_lowerBound']);
                                        sort($lowerBound);
                                        $lowerBound=implode(",",$lowerBound);
                                        ?>
                                        <span id="spanLowerBound" class="col-md-8 " title=""><?php echo $lowerBound?></span>
                                     </div>
                                     <div class="row mg-b-10">
                                       <label class="col-md-2 ">Scale Upper Bound </label>
                                       <?php
                                        $upperBound=explode(",",$selectConfig[0]['question_type_upperBound']);
                                        sort($upperBound);
                                        $upperBound=implode(",",$upperBound);
                                        ?>
                                       <span class="col-md-8 "  id="spanUpperBound" title=""><?php echo $upperBound ?></span>
                                     </div>

                                     <div class="row mg-b-10">
                                       <label class="col-md-2">Scale Left Label</label>
                                       <span class="col-md-8 " id="spanLeftLabel" class=""><?php echo $selectConfig[0]['defaultLeftLabel'] ?></span>
                                     </div>
                                     <div class="row mg-b-10">
                                       <label class="col-md-2">Scale Right Label</label>
                                       <span class="col-md-8 " id="spanRightLabel" class=""><?php echo $selectConfig[0]['defaultRightLabel']?></span>
                                     </div>
                                   </div>
                                   <div class="text-right ">
                                      <button id="btnEditQuestionConfiguration" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditQuestionConfiguration"> Edit Question Configuration</button>
                                   </div>
                                 </div>

                             </div>
                         </div>
                     </div>

                     <div class="row row mg-b-10">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1> Template Configuration</h1>
                                     </div>
                                 </div>
                                 <div class="sparkline8-graph" style="text-align:left;">
                                   <div  class="datatable-dashv1-list custom-datatable-overright">
                                     <div class="row mg-b-10">
                                       <label class="col-md-2 ">Number of pages allowed</label>

                                        <span class="col-md-8 " id="spanNumPage" title=""><?php echo  $selectConfig[0]['numPageAllowed']?></span>
                                     </div>
                                     <div class="row mg-b-10">
                                       <label class="col-md-2 "> Default Cycle  </label>

                                        <div class="col-md-8 "  id="divCycle">



                                       <?php
                                         $selectCycle="SELECT * FROM cycle";
                                         $selectCycle=$conn->query($selectCycle);
                                         $selectCycle=$selectCycle->fetchALL(PDO::FETCH_ASSOC);
                                         foreach ($selectCycle as $key => $value) {

                                           if($value['display'])
                                            {

                                           ?>
                                           <span class="row" title=""><?php echo  $value['cycleName']?></span>

                                           <?php
                                            }

                                         }
                                        ?>
                                      </div>

                                     </div>

                                     <div class="text-right ">
                                        <button id="btnEditTemplateConfiguration" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditTemplateConfiguration"> Edit Template Configuration</button>
                                     </div>
                                   </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="row row mg-b-10">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1> Survey Configuration</h1>
                                     </div>
                                 </div>
                                 <div class="sparkline8-graph" style="text-align:left;">
                                   <div  id="divSurveyDetails"  class="datatable-dashv1-list custom-datatable-overright">
                                     <div class="row mg-b-10">
                                       <label class="col-md-3 ">Survey Expires at<br/>  <span class="comment">Notice : Please make sure that this time matches the time the survey will be sent</span></label>

                                        <span class="" title="" id="spanExpireTime"><?php echo  $selectConfig[0]['timeOfExpiry']?></span><br>

                                     </div>
                                     <div class="row mg-b-10">
                                       <label class="col-md-3 ">Number of days after which survey expires </label>

                                        <span class=" " title="" id="spanExpireIn"><?php echo  $selectConfig[0]['surveyExpiresIn']?></span>
                                     </div>
                                     <div class="row mg-b-10">
                                       <label class="col-md-3 ">Number of days when to send reminder mail </label>

                                        <span class="" title="" id="spanReminderDays"><?php echo  $selectConfig[0]['numDaysForReminderMail']?></span>
                                     </div>
                                   </div>
                                   <div class="text-right ">
                                      <button id="btnEditSurveyConfiguration" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditSurveyConfiguration"> Edit Survey Configuration</button>
                                   </div>
                                 </div>

                             </div>
                         </div>
                     </div>

                 </div>

                 <!--Modal General  Configuration -->
                 <div id="mdlEditGeneralConfiguration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                   <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Edit General Configuration</h4>
                       </div>
                       <div class="modal-body">
                         <form id="frmEditGeneralConfiguration" class="" action="" method="post" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-12 ">
                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">DNS</label>
                                         <div class="col-sm-8">
                                           <input type="text" class="form-control" value='' name='txtDns' id="txtDns" required>
                                         </div>
                                     </div>
                                </div>
                            </div>
                        </form>
                       </div>

                       <div class="modal-footer">
                         <input  form="frmEditGeneralConfiguration" id="btnfrmEditGeneralConfiguration" type="submit" value="Save Changes"  class="btn btn-default" >
                         <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">
                       </div>

                     </div>
                   </div>
                 </div>
                 <!--End of Edit -->

                 <!--Modal Question  Configuration -->
                 <div id="mdlEditQuestionConfiguration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                   <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Edit Question Configuration</h4>
                       </div>
                       <div class="modal-body">
                         <form id="frmEditQuestionConfiguration" class="" action="" method="post" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-12 ">
                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">Scale Lower Bound</label>
                                         <div class="col-sm-8">
                                           <input type="text" class="form-control" value='' name='txtLowerBound' id="txtLowerBound" required>
                                           <span class="comment">seperate your values using commas(',')</span>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">Scale Upper Bound</label>
                                         <div class="col-sm-8">
                                           <input type="text" class="form-control"  name='txtUpperBound' id="txtUpperBound" required>
                                           <span class="comment">seperate your values using commas(',')</span>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">Scale Left Label</label>
                                         <div class="col-sm-8">
                                           <input type="text" class="form-control"  name='txtLeftlabel' id="txtLeftLabel" required>
                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">Scale Right Label</label>
                                         <div class="col-sm-8">
                                           <input type="text" class="form-control" name='txtRightLabel' id="txtRightLabel" required>
                                         </div>
                                     </div>
                                </div>
                            </div>
                        </form>
                       </div>

                       <div class="modal-footer">
                         <input  form="frmEditQuestionConfiguration" id="btnfrmEditQuestionConfiguration" type="submit" value="Save Changes"  class="btn btn-default" >
                         <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">
                       </div>

                     </div>
                   </div>
                 </div>
                 <!--End of Edit -->

                 <!--Modal Template  Configuration -->
                 <div id="mdlEditTemplateConfiguration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                   <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Edit Template Configuration</h4>
                       </div>
                       <div class="modal-body">
                         <form id="frmEditTemplateConfiguration" class="" action="" method="post" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-12 ">
                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">Number of pages allowed</label>
                                         <div class="col-sm-8">
                                           <input type="text" class="form-control" value='<?php echo  $selectConfig[0]['numPageAllowed']?>' name='txtNumPage' id="txtNumPage" required>

                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="" class="col-sm-4 control-label">Cycle Available</label>
                                         <div class="col-sm-8" >

                                           <div class="row">
                                             <div class="col-sm-6">

                                             </div>
                                             <div class="col-sm-6">
                                               <label for="" class=" control-label">Default</label>

                                             </div>
                                           </div>
                                           <div class="row" id="cycleAvailable">

                                           </div>



                                         </div>
                                     </div>


                                </div>
                            </div>
                        </form>
                       </div>

                       <div class="modal-footer">
                         <input  form="frmEditTemplateConfiguration" id="btnfrmEditTemplateConfiguration" type="submit" value="Save Changes"  class="btn btn-default" >
                         <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">
                       </div>

                     </div>
                   </div>
                 </div>
                 <!--End of Edit -->

                 <!--Modal Template  Configuration -->
                 <div id="mdlEditSurveyConfiguration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                   <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Edit Survey Configuration</h4>
                       </div>
                       <div class="modal-body">
                         <form id="frmEditSurveyConfiguration" class="" action="" method="post" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-12 ">
                                  <div class="form-group row">
                                      <label for="" class="col-sm-6 control-label">Survey Expires at</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control timepicker" name='txtExpireTime' id="txtExpireTime" readonly required style="    background-color: white;">
                                        <span class="comment">Notice : Please make sure that this time matches the time the survey will be sent</span>

                                      </div>
                                  </div>
                                     <div class="form-group row">
                                         <label for="" class="col-sm-6 control-label">Number of days after which survey expires</label>
                                         <div class="col-sm-6">
                                           <input type="text" class="form-control" name='txtNumExpireDay' id="txtNumExpireDay" required>

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label for="" class="col-sm-6 control-label">Number of days when to send reminder mail</label>
                                         <div class="col-sm-6">
                                           <input type="text" class="form-control"  name='txtNumReminderDays' id="txtNumReminderDays" required>

                                         </div>
                                     </div>

                                </div>
                            </div>
                        </form>
                       </div>

                       <div class="modal-footer">
                         <input  form="frmEditSurveyConfiguration" id="btnfrmEditSurveyConfiguration" type="submit" value="Save Changes"  class="btn btn-default" >
                         <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">
                       </div>

                     </div>
                   </div>
                 </div>
                 <!--End of Edit -->

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

    <script src="js\bootbox.all.min.js"></script>

    <script src="js\select2\select2.full.min.js"></script>

    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- main JS
		============================================ -->
<script src="..\js\bootstrap-notify.js"></script>
<script src="js/date-time-picker/moment-with-locales.js"></script>
<script src="js/date-time-picker/bootstrap-datetimepicker.min.js"></script>


    <script type="text/javascript">


      $(document).ready(function(){
        $("#txtNumPage").TouchSpin({
          verticalbuttons: true,
          min: 1,
          max : 5,
          step: 1,
        });



        $("#txtNumReminderDays").TouchSpin({
          verticalbuttons: true,
          min: 1,
          step: 1,
        });

        $("#txtNumExpireDay").TouchSpin({
          verticalbuttons: true,
          min: 1,
          step: 1,
        });

        $('#txtExpireTime').datetimepicker({
          keyBinds: true,
          ignoreReadonly: true,
          allowInputToggle: true,
          format: 'hh:mm A',
        });

//click on button to edit
        //General configuration
        $("#btnEditGeneralConfiguration").click(function () {
          jQuery.ajax({
            url : "includes/Config/getConfig.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,

          }).done(function (data)
          {

            $("#txtDns").val(data.config[0].dns);

          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //Question Configuration
        $("#btnEditQuestionConfiguration").click(function () {
          jQuery.ajax({
            url : "includes/Config/getConfig.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,

          }).done(function (data)
          {
            bounds=data.config[0].question_type_lowerBound.split(',');
            bounds.sort(function(a, b) {
                return a - b;
              });
            bounds.join(',');
            $("#txtLowerBound").val(bounds);

            bounds=data.config[0].question_type_upperBound.split(',');
            bounds.sort(function(a, b) {
                return a - b;
              });

            bounds.join(',');
            $("#txtUpperBound").val(bounds);
            $("#txtLeftLabel").val(data.config[0].defaultLeftLabel);
            $("#txtRightLabel ").val(data.config[0].defaultRightLabel);


          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //Template Configuration
        $("#btnEditTemplateConfiguration").click(function () {
          jQuery.ajax({
            url : "includes/Config/getConfig.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,

          }).done(function (data)
          {
              $("#txtNumPage").val(data.config[0].numPageAllowed);

                $("#cycleAvailable").empty();
                input="";
                $.each(data.cycle,function (index,value) {

                    if(value.display==1)
                    {
                      input+='<div class="row">\
                        <div class="col-sm-6">\
                          <span class=""  title="">'+ value.cycleName+'</span>\
                        </div>\
                        <div class="col-sm-6" >\
                          <input name="cycleAvailable[]"  value="'+value.cycleId+'" checked type="checkbox" >\
                        </div>\
                      </div>'
                    }else{
                      input+='<div class="row">\
                        <div class="col-sm-6">\
                          <span class=""  title="">'+ value.cycleName+'</span>\
                        </div>\
                        <div class="col-sm-6" >\
                          <input name="cycleAvailable[]" value="'+value.cycleId+'"  type="checkbox"  >\
                        </div>\
                      </div>'
                    }


                });


                $("#cycleAvailable").append(input);




          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //Survey Configuration
        $("#btnEditSurveyConfiguration").click(function () {
          jQuery.ajax({
            url : "includes/Config/getConfig.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,

          }).done(function (data)
          {

              $("#txtExpireTime").val(data.config[0].timeOfExpiry);
              $("#txtNumExpireDay").val(data.config[0].surveyExpiresIn);
              $("#txtNumReminderDays").val(data.config[0].numDaysForReminderMail);

          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

//submit form
        //General configuration
        $("#frmEditGeneralConfiguration").submit(function (e) {
          e.preventDefault();
          data =$(this).serialize();
          jQuery.ajax({
            url : "includes/Config/updateGeneralConfiguration.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data :data
          }).done(function (data)
          {

            if(data.success)
            {
                $("#mdlEditGeneralConfiguration").modal('hide');
                $("#spanDNS").text(data.value);

                //$.NotifyFunc ('success','Success',data.result);
            }
            else{
                $("#mdlEditGeneralConfiguration").modal('hide');
                //$.NotifyFunc ('danger','Error',data.result);
            }


          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //remove error message on key up
        $("#frmEditQuestionConfiguration :input").on("change keyup",function () {

          $(this)[0].setCustomValidity("");
        })

        //Question Configuration
        $("#frmEditQuestionConfiguration").submit(function (e) {

          e.preventDefault();
          var patt = new RegExp("^[ ]*[0-9]+[ ]*([ ]*,[ ]*[0-9]+[ ]*)*$");
          // alert(patt.test($("#txtLowerBound").val()) +"\t\t"+patt.test($("#txtUpperBound").val()))
          if(!patt.test($("#txtLowerBound").val())){
            $("#txtLowerBound")[0].setCustomValidity("Values should be seperated by ',' and should only be numeric");
            $("#txtLowerBound")[0].reportValidity();
              return false;
          }
          else
          {
            lowerBound=$("#txtLowerBound").val().split(",");
            unique=new Set(lowerBound);
            if(lowerBound.length == unique.size)
            {
              $("#txtLowerBound")[0].setCustomValidity("");
            }
            else{
              $("#txtLowerBound")[0].setCustomValidity("Lower bound cannot contain duplicate value");
              $("#txtLowerBound")[0].reportValidity();
                return false;

            }

          }

          if(!patt.test($("#txtUpperBound").val())){
            $("#txtUpperBound")[0].setCustomValidity("Values should be seperated by ',' and should only be numeric");
            $("#txtUpperBound")[0].reportValidity();
              return false;
          }
          else
          {
            upperBound=$("#txtUpperBound").val().split(",");
            unique=new Set(upperBound);
            if(upperBound.length == unique.size)
            {
              $("#txtUpperBound")[0].setCustomValidity("");
            }
            else{
              $("#txtUpperBound")[0].setCustomValidity("Upper bound cannot contain duplicate value");
              $("#txtUpperBound")[0].reportValidity();
                return false;
            }

          }




          var leftLabel=$("#txtLeftLabel").val().toLowerCase().replace(/\s+/g, " ").trim();
          var rightLabel=$("#txtRightLabel").val().toLowerCase().replace(/\s+/g, " ").trim();

          if(leftLabel!="" && rightLabel!="")
          {

            // console.log(leftLabel==rightLabel);
            if(leftLabel===rightLabel)
            {
              // console.log(leftLabel===rightLabel);
              $("#txtRightLabel")[0].setCustomValidity("Left and Right label cannot be same");
              $("#txtRightLabel")[0].reportValidity();
              return false;
            }
            else
            {
              $("#txtRightLabel")[0].setCustomValidity("");
            }
          }
          data =$(this).serialize();
          jQuery.ajax({
            url : "includes/Config/updateQuestionConfiguration.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data :data
          }).done(function (data)
          {

            if(data.success)
            {
                $("#mdlEditQuestionConfiguration").modal('hide');
                bounds=data.value[0].question_type_lowerBound.split(',');
                bounds.sort(function(a, b) {
                    return a - b;
                  });
                bounds.join(',');

                $("#spanLowerBound").text(bounds);

                bounds=data.value[0].question_type_upperBound.split(',');
                bounds.sort(function(a, b) {
                    return a - b;
                  });

                bounds.join(',');
                $("#spanUpperBound").text(bounds);



                $("#spanLeftLabel").text(data.value[0].defaultLeftLabel);
                $("#spanRightLabel").text(data.value[0].defaultRightLabel);




                //$.NotifyFunc ('success','Success',data.result);
            }
            else{
                $("#mdlEditQuestionConfiguration").modal('hide');
                //$.NotifyFunc ('danger','Error',data.result);
            }


          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //Template Configuration
        $("#frmEditTemplateConfiguration").submit(function (e) {
          e.preventDefault();
          data =$(this).serialize();
          jQuery.ajax({
            url : "includes/Config/updateTemplateConfiguration.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data :data
          }).done(function (data)
          {

            if(data.success)
            {
                $("#mdlEditTemplateConfiguration").modal('hide');

                $("#spanNumPage").text(data.config[0].numPageAllowed);
                $("#divCycle").empty();
                $.each(data.cycle,function(index,value){
                  if(value.display==1)
                  {
                    $("#divCycle").append(' <span class="row " title="">'+value.cycleName+'</span>');
                  }

                });




                //$.NotifyFunc ('success','Success',data.result);
            }
            else{
                $("#mdlEditTemplateConfiguration").modal('hide');
                //$.NotifyFunc ('danger','Error',data.result);
            }


          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //Survey Configuration
        $("#frmEditSurveyConfiguration").submit(function (e) {
          e.preventDefault();
          data =$(this).serialize();
          jQuery.ajax({
            url : "includes/Config/updateSurveyConfiguration.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data :data
          }).done(function (data)
          {

            if(data.success)
            {
                $("#mdlEditSurveyConfiguration").modal('hide');
                $("#spanExpireTime").text(data.config[0].timeOfExpiry);
                $("#spanExpireIn").text(data.config[0].surveyExpiresIn);
                $("#spanReminderDays").text(data.config[0].numDaysForReminderMail);





                //$.NotifyFunc ('success','Success',data.result);
            }
            else{
                $("#mdlEditSurveyConfiguration").modal('hide');
                //$.NotifyFunc ('danger','Error',data.result);
            }


          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

      });

    </script>


</body>

</html>
