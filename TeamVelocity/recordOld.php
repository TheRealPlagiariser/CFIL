<?php

  session_start();
  // $_SESSION['Username']="faraju";
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
    include 'includes/db_connect.php';
    $projectReceived="";
    if(isset($_GET['project'])){
      $projectReceived = $_GET['project'];
    }
    $superusers=array();
    $selectConfig= "SELECT * FROM config";
    $selectConfig=$conn->query($selectConfig);
    $selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);
    $superusers = explode("|", $selectConfig[0]["superusers"]);
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Record";
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
      <?php $activeApp="il"; ?>
        <?php include "../includes/sidebar.php"; ?>
        <div class="content-inner-all">
          <!-- Header top area start-->

          <?php
          $active="improvementrecord";
            include 'includes/menu.php';
          ?>

          <!-- Data table area Start-->
          <div class="admin-dashone-data-table-area">
              <div class="container-fluid">
                  <div class="row mg-t-30">
                      <div class="col-lg-12">
                          <div class="sparkline8-list shadow-reset">
                              <div class="sparkline8-hd">
                                  <div class="main-sparkline8-hd">
                                      <h1>Records</h1>
                                  </div>
                              </div>
                              <div class="sparkline8-graph">
                                  <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div class="text-left">
                                        <a id="btnCreateItem" href="createItem.php" class="btn btn-success btn-sm" >Add New Record</a>
                                        <!-- <button  data-toggle="modal" data-target="#mdlEditActivityDetails" id="btnOpen" href="createItem.php" class="btn btn-success btn-sm" >OpenRecord</button> -->
                                        <!-- <button  data-toggle="modal" data-target="#mdlEditActivityDetails" id="btnOpen"  class="btn btn-success btn-sm" >OpenRecord</button> -->

                                    </div>
                                    <!-- data-toggle="table"
                                    data-search="true"
                                    data-show-columns="true"
                                    data-show-export="true"
                                    data-export-types ="['csv','pdf']"
                                    data-ajax="ajaxRequest" -->
                                    <table id="tblLog"
                                             data-toggle="table"
                                             data-pagination="true"
                                             data-search="true"
                                             data-show-pagination-switch="true"
                                             data-show-refresh="true"
                                             data-key-events="true"
                                             data-resizable="true"
                                             data-cookie="true"
                                             data-cookie-id-table="saveId"
                                             data-show-export="true"
                                             data-click-to-select="true"
                                             data-toolbar="#toolbar"
                                             data-export-data-type = "all"
                                             data-export-types ="['csv']"
                                             data-ajax="ajaxRequest"
                                             data-search-text="<?php echo $projectReceived; ?>"
                                      >

                                      <thead>
                                        <tr>
                                          <th  data-sortable="true" data-field="project.0" rowspan="2" id="boo" >Project/CR/Task</th>
                                          <th data-sortable="true" data-field="activity.0" rowspan="2">Activity</th>
                                          <th data-field="activityDetails" colspan="6">Activity Details</th>
                                          <th data-formatter="formatActionItem" data-field="actionItem" rowspan="2">Action</th>
                                          <th  data-sortable="true" data-field="total.0" rowspan="2">Total Mandays Lost</th>

                                          <th data-field="dateCreated.0" rowspan="2">Created On</th>
                                          <th data-formatter="formatComment" rowspan="2">Comment</th>
                                          <th data-formatter="format" data-field="delete" data-align="center" rowspan="2" class="delete" data-tableexport-display="none" >Delete</th>
                                        </tr>
                                        <tr>
                                          <th  data-field="description.0">Activity Description</th>
                                          <th  data-field="manDays.0">Mandays Lost</th>
                                          <th  data-formatter="formatStartDate" data-field="startDate.0">Issue Start Date</th>
                                          <th  data-formatter="formatEndDate" data-field="endDate.0">Tentative End Date</th>
                                          <th  data-field="loggedBy.0">Logged By</th>
                                          <th data-align="center" data-field="editDelete" data-formatter="formatEditDeleteActDesc" class="editDelete" data-tableexport-display="none" >Edit/Delete</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>


                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>

              </div>
          </div>
          <!-- Data table area End-->
          <!-- Modal Add Comment -->
          <div id="mdlAddComment" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button id="btnDismissModal" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Comment</h4>
                </div>
                <div class="modal-body">
                  <form id="frmAddComment">
                    <div class="container-fluid">
                      <div class="form-group text-left" style="padding-left:0;">
                        <label id="lblComment" for="txaQuestion" class="form-control-label">Enter Comment below:</label>
                        <textarea id="txaComment" rows='3' class="form-control" name="txaComment" required ></textarea>
                      </div>
                    </div>
                  </form>
                </div> <!--modal body-->
                <div class="modal-footer">
                  <input id="btnSubmitComment" type="submit" value="Done" form="frmAddComment" class="btn btn-default" >
                </div>
              </div>

            </div>
          </div>
          <!-- End modal -->
          <!-- Modal Add Action Item -->
          <div id="mdlAddActionItem" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button id="" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Action Item</h4>
                </div>
                <div class="modal-body">
                  <?php $where="homewip"; include "includes/frmCreateActionItem.php" ?>
                </div> <!--modal body-->
                <div class="modal-footer">

                  <input id="btnSubmitActionItem" type="submit" value="Done" form="frmCreateActionItem" class="btn btn-default">
                  <input id="btnCancel" data-dismiss="modal" type="button" value="Cancel" form="frmCreateActionItem" class="btn btn-default">
                </div>
              </div>

            </div>
          </div>
          <!-- End modal -->

          <!-- Modal Edit Activity Details-->
          <div id="mdlEditActivityDetails" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button id="" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Activity Details</h4>
                </div>
                <div class="modal-body">
                  <form id="frmEditActivityDetails" class="form-horizontal">
                    <div class="container-fluid">
                      <!-- Activity Description -->
                      <div class="form-group">
                        <label for="txaActivityDescription" class="col-sm-2 control-label">Activity Description</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="txaActivityDescription" required name="txaActivityDescription" rows="3"></textarea>
                        </div>
                      </div>

                      <!-- Mandays Lost -->
                      <div class="form-group">
                        <label for="txtManDays" class="col-sm-2 control-label">Mandays Lost</label>
                        <div class="col-sm-10">
                          <!-- <input type="number" step="0.01" class="form-control" required name="txtManDays" id="txtManDays" placeholder="(In Decimal)"> -->
                          <input type="text"  class="form-control" required name="txtManDays" id="txtManDays" placeholder="(In Decimal)">

                        </div>
                      </div>

                      <!-- Issue Start Date -->
                      <div class="form-group">
                        <label for="dteStartTaskDate" class="col-sm-2 control-label">Issue Start Date</label>
                        <div class="col-sm-10 ">
                          <!-- <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" id="dteStartTaskDate" required name="dteStartTaskDate" placeholder="YYYY-MM-DD">
                          </div> -->
                          <div class='input-group date' id='datetimepickerStart'>
                            <input style="background-color:white;" type="text" readonly="readonly" class="form-control" id="dteStartTaskDate" required name="dteStartTaskDate" placeholder="">
                            <!-- <input type='text' class="form-control" name="boo"/> -->

                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div>

                      <!-- Issue End Date -->
                      <div class="form-group">
                        <label for="dteEndTaskDateEdit" class="col-sm-2 control-label">Tentative End Date</label>
                        <div class="col-sm-10 ">
                          <!-- <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" id="dteEndTaskDate" required name="dteEndTaskDate" placeholder="YYYY-MM-DD">
                          </div> -->
                          <div class='input-group date' id='datetimepickerEndEdit'>
                            <input style="background-color:white;" type="text" readonly="readonly" class="form-control" id="dteEndTaskDateEdit" required name="dteEndTaskDate" placeholder="">

                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="container">
                        <form class="" action="" method="post">
                          <div class='col-md-5'>
                              <div class="form-group">
                                  <div class='input-group date' id='datetimepickerStart'>
                                      <input type='text' class="form-control" name="boo"/>
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          <div class='col-md-5'>
                              <div class="form-group">
                                  <div class='input-group date' id='datetimepickerEnd'>
                                      <input type='text' class="form-control" name="b2"/>
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          <input type="submit" name="" value="">
                        </form>
                      </div> -->
                    </div>
                  </form>
                </div> <!--modal body-->
                <div class="modal-footer">
                  <input id="btnSubmitActivityDetails" type="submit" value="Done" form="frmEditActivityDetails" class="btn btn-default" >
                </div>
              </div>

            </div>
          </div>
          <!-- End modal -->

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
    <script src="js/data-table/tableExport.js"></script>
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

      $("input[name='txtEstimatedManDays']").TouchSpin({
        verticalbuttons: true,
        min: 0,
        max: 500,
        step: 0.05,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
      });
      $("#drpActionItem").select2({
         tags: false,
         width:"100%",
         searchInputPlaceholder: 'Search',
         placeholder : "Choose An Action Item "
       });
        var arrDesc=[];
        var arrActionItem=[];
      function ajaxRequest(params){

        $.ajax({
             method: "POST",
             url: "includes/Item/getItem.php",
             dataType: "json"
         }).done(function (data) {
            params.success(data);
            // alert(data);
              // rec=data.map(x=>x.recId);
              // recDescription=data.map(x=>x.rec_descriptionId);

              // // // // console.log(data);
              $.each(data,function(index,value){
                // // // // console.log(value.recId);
                 arrDesc[value.recId]=value.rec_descriptionId.length;
                 // arrActionItem[value.recId]=value.actionItem;
              });
                // // // // console.log(arrActionItem);
                // // // // console.log(recDescription);

         }).fail(function (er) {

            params.error(er);

         });

      }

      numLength=[];
      function format(value,row,index,field) {

        data="";
        numLength[index]=row.loggedBy.length;
        if(row.loggedBy.length>1)
        {

          $.each(row.loggedBy,function (index,value) {
            // if(row.deletedDescription[index]==1){
            //   return;
            // }

            if(index==0)
            {
              // data+= icoEditDelete;
              return true;

            }
            if(row.loggedBy[index]=="<?php echo $_SESSION['Username']; ?>" ||<?php  if(in_array( $_SESSION['Username'] , $superusers )){echo "true";}else{echo "false";} ?>){
              icoEditDelete = " <div class='center'>\
                                <i  data-toggle='modal' data-target='#mdlEditActivityDetails' data-placement='bottom' title='Edit' id='icoEditRecDesc"+row.rec_descriptionId[index]+"' class='icoEditRecDesc far fa-edit'></i>\
                                <i data-toggle='tooltip' data-placement='bottom' title='Delete'  id='icoDeleteRecDesc"+row.rec_descriptionId[index]+"' style='color:red;margin-left:10%' class='icoDeleteRecDesc fa fa-trash'></i>\
                                </div>";
              icoDeleteRec="<div class='center'>\
                        <i data-toggle='tooltip' data-placement='bottom' title='Delete'  id='icoDeleteRec"+row.recId+"' style='color:red;margin-left:10%' class='icoDeleteRec fa fa-trash'></i></div>";
            }else{
              icoEditDelete="<div class='center'>-</div>";
              icoDeleteRec="<div class='center'>-</div>";
            }


            data+=icoDeleteRec+" <tr>\
                      <td>"+row.description[index]+"</td>\
                      <td>"+row.manDays[index]+"</td>\
                      <td>"+formatDate(row.startDate[index])+"</td>\
                      <td>"+formatDate(row.endDate[index])+"</td>\
                      <td>"+row.loggedBy[index]+"</td>\
                      <td style='text-align:center'>"+icoEditDelete+"</td>\
                  </tr>";

          });

        }
        else
        {
          if(row.loggedBy[0]=="<?php echo $_SESSION['Username']; ?>" ||<?php  if(in_array( $_SESSION['Username'] , $superusers )){echo "true";}else{echo "false";} ?>){
            icoDeleteRec="<div class='center'>\
                      <i data-toggle='tooltip' data-placement='bottom' title='Delete'  id='icoDeleteRec"+row.recId+"' style='color:red;margin-left:10%' class='icoDeleteRec fa fa-trash'></i></div>";

          }else{
              icoDeleteRec="<div class='center'>-</div>";
          }
          return icoDeleteRec+"<input type='hidden' name='recId' value='"+row.recId+"'>";
        }

        return   "<input type='hidden' name='recId' value='"+row.recId+"'>" +data;

      }

      function formatEditDeleteActDesc(value,row,index,field) {
        if(row.loggedBy[0]=="<?php echo $_SESSION['Username']; ?>" ||<?php  if(in_array( $_SESSION['Username'] , $superusers )){echo "true";}else{echo "false";} ?>){
          return " <div class='center'>\
                  <i data-toggle='modal' data-target='#mdlEditActivityDetails'  data-placement='bottom' title='Edit' id='icoEditRecDesc"+row.rec_descriptionId[0]+"' class='icoEditRecDesc far fa-edit'></i>\
                  <i data-toggle='tooltip' data-placement='bottom' title='Delete'  id='icoDeleteRecDesc"+row.rec_descriptionId[0]+"' style='color:red;margin-left:10%' class='icoDeleteRecDesc fa fa-trash'></i>\
                  <input type='hidden' name='recId' value='"+row.recId+"'>\
                  </div>";
        }else{
          return "<div class='center'>-</div>";
        }
      }

      var arrActionItemPerRec =[];
      function formatActionItem(value,row,index,field) {
        if(row.actionItem == ""){
          arrActionItemPerRec[row.recId]=[];
          return '<br/><br><i data-toggle="modal" data-target="#mdlAddActionItem" data-placement="bottom" title="Add Action Item" id="icoAddActionItem'+row.recId+'" class="fas fa-plus-circle icoAddActionItem pull-right"></i>';
        }else{
            var actionitem = row.actionItem[0].split('|');
            actionitem=actionitem.slice(1,-1);
            // // // console.log("actionitem ",actionitem);
            arrActionItemPerRec[row.recId]=row.actionItem;
            // // // console.log("arrActionItemPerRec ",arrActionItemPerRec);

            // actionitem =ac
            // // // // console.log(actionitem);
            // actionitem = actionitem.split('|');
            var data="";
            if(actionitem.length ==1){
              // value=substr(1,value.length-1);
              // // // console.log(value);
              val=value[0].split('|');
              // // // console.log(val);
              data+="<a class='actionitems' href='actionitem.php?painPoint="+encodeURIComponent(val[1])+"'>"+val[1]+"</a>\
                      <i value='"+encodeURIComponent(escape(val[1]))+"' class='icoRemovePainPoint fas fa-minus-circle' title='Remove Pain Point'></i>\
                      <br/>";
            }else{
              $.each(actionitem, function(key, value){
                  // data+=" <a class='actionitems' href='actionitem.php?painPoint="+value+"'>"+value+"</a>\
                  //         <i value='"+value+"' class='icoDeleteComment fas fa-minus-circle' title='Delete Comment'></i>\
                  //                 <hr class='hrActionItem'/>\
                  //                 ";
                  data+=" <a class='actionitems' href='actionitem.php?painPoint="+encodeURIComponent(value)+"'>"+value+"</a>\
                          <i value='"+encodeURIComponent(escape(value))+"' class='icoRemovePainPoint fas fa-minus-circle' title='Remove Pain Point'></i>\
                                  <hr class='hrActionItem'/>\
                                  ";
              });
            }


            return data+='<br><i data-toggle="modal" data-target="#mdlAddActionItem" data-placement="bottom" title="Add Action Item" id="icoAddActionItem'+row.recId+'" class="fas fa-plus-circle icoAddActionItem pull-right"></i>';
        }

      }

      function formatComment(value,row,index,field) {

        data="";

        // numLength[index]=row.commentId.length;
        // // // // console.log($.isEmptyObject(row.commentId));
        if(row.commentId.length==0){
          data+='<br/><br/><i data-toggle="modal" data-target="#mdlAddComment" data-placement="bottom" title="Add Comment" id="icoAddComment'+row.recId+'" class="pull-right fas fa-plus-circle icoAddComment"></i>';
          return data;
        }else{
          // // // // console.log(row);
          if(row.commentCreatedBy.length >=1)
          {
            // // // // console.log(row);
            // // // // console.log(row.deletedComment);

            $.each(row.commentCreatedBy,function (index,value) {
              // // console.log(row.deletedComment[index] );
              if(row.deletedComment[index] == 1){
                return;
              }
              if(row.commentCreatedBy[index]=="<?php echo $_SESSION['Username']; ?>" ||<?php  if(in_array( $_SESSION['Username'] , $superusers )){echo "true";}else{echo "false";} ?>){
                ico = "<i data-toggle='modal' value='"+row.commentId[index]+"' data-target='#mdlAddComment' class='fas fa-pencil-alt icoEditComment' title='Edit Comment'></i>\
                <i value='"+row.commentId[index]+"' class='icoDeleteComment fas fa-minus-circle' title='Delete Comment'></i>";
              }else{
                ico="";
              }
               data+= " <strong>" + row.commentCreatedBy[index] + "</strong> [" + row.commentDateCreated[index] + "]:\
                        "+ico+"\
                        <br/>" + row.commentText[index] + "<br/><br/>";
            });


          }
          data+='<i data-toggle="modal" data-target="#mdlAddComment" data-placement="bottom" title="Add Comment" id="icoAddComment'+row.recId+'" class="pull-right fas fa-plus-circle icoAddComment"></i>';
          return data;
        }

      }

      function formatStartDate(value,row,index,field){
        return formatDate(row.startDate);
      }

      function formatEndDate(value,row,index,field){
        return formatDate(row.endDate);
      }


      function formatDate(date){
        if (date == "0000-00-00 00:00:00" || date == null || date==""){
          return "<div style='color:#ccc;'>Not Specified</div>";
        }else{
          return moment(date, "YYYY-MM-DD hh:mm:ss").format("ddd, D MMM YYYY hh:mm A");
        }
        return moment(date, "YYYY-MM-DD hh:mm:ss").format("ddd, D MMM YYYY hh:mm A");
      }
      $("#tblLog").on("click", ".icoRemovePainPoint", function(){
        var recId = $(this).closest("tr").find("input[type='hidden']").val();
        var painPoint = decodeURIComponent(unescape($(this).attr("value")));
        console.log( recId);
        // alert(painPoint);
        bootbox.confirm({
          title : "Remove Pain Point",
          message : "Are you sure you want to remove this pain point?",
          buttons : {
            cancel : {
                  label : "<i class='fa fa-times'></i> No"

            },
            confirm : {
                label : "<i class='fa fa-check'></i> Yes"
              }
            },
            callback: function(result){
              if(result){
                $.ajax({
                  type: "POST",
                  url: "includes/Item/removePainPoint.php",
                  data: {recId:recId, painPoint:painPoint},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){

                    $("#tblLog").bootstrapTable('refresh');
                    // $.callAjaxTxtQuestion();
                  }
                });
              }
            }

        });
      });

      $("#btnSubmitActionItem").click(function(){
        recId = $("#frmCreateActionItem").find("input[name='recId']").val();
        if(arrActionItemPerRec[recId].length>0){
          arr=arrActionItemPerRec[recId][0].split('|');
          selected=$("#drpActionItem").val();
          // console.log("arr ", arr);
          // console.log("selected ",selected);
          $.each(arr, function(index, value){
            // console.log(encodeURIComponent(arr[index]));
            if(encodeURIComponent(arr[index]) == selected){
              // alert("oo");
              $("#drpActionItem")[0].setCustomValidity("This Action Item Already Exists For This Record");
              return false;
            }else{
              $("#drpActionItem")[0].setCustomValidity("");
            }
          });
        }
      });

      $("#tblLog").on("all.bs.table ",function(data){
        $.each(numLength,function (ind,value) {
            col=[0,1,8,9,10,11,12,13,14];
            $.each(col,function (i,v) {
                $("#tblLog").find("tr[data-index='"+ind+"']").find("td").eq(v).attr("rowspan",value).attr("data-tableexport-rowspan","2");
            });
        });
      });

      // Edit Comment
      $("#tblLog").on("click", "i.icoEditComment", function(){
        commentId=$(this).attr("value");
        $("#frmAddComment").append('<input type="hidden" name="commentId" value="'+commentId+'" />');
        $("#mdlAddComment .modal-title").text("Edit Comment");
        $("#btnSubmitComment").val("Save Changes");
        $.ajax({
          type: "POST",
          url: "includes/ItemComment/getComment.php",
          data: {commentId:commentId},
          cache: false,
          dataType:"json",
          error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          }
        }).done(function(result, status){
          if(result.success){
            var commentText=result.result[0].comment;
            $("#frmAddComment #txaComment").text(commentText);
            // $("#frmAddComment").find("input[type='hidden']").remove();
            // $("#frmAddComment").append('<input type="hidden" name="recId" value="'+recId+'" />');
          }else{
            alert(result.result);
          }
        });
      });
      // Delete Comment
      $("#tblLog").on("click","i.icoDeleteComment", function(){
        var commentId=$(this).attr("value");
        // // // // console.log("comment id "+commentId);
        bootbox.confirm({
          title : "Delete Comment",
          message : "Are you sure you want to delete this comment?",
          buttons : {
            cancel : {
                  label : "<i class='fa fa-times'></i> No"

            },
            confirm : {
                label : "<i class='fa fa-check'></i> Yes"
              }
            },
            callback: function(result){
              if(result){
                $.ajax({
                  type: "POST",
                  url: "includes/ItemComment/deleteComment.php",
                  data: {commentId:commentId},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){

                    $("#tblLog").bootstrapTable('refresh');
                    // $.callAjaxTxtQuestion();
                  }
                });
              }
            }

        })
      });

      // AddComment
      $("#tblLog").on('click','i.icoAddComment',function(){
        var ico = $(this).attr("id");
        recId = ico.substring(13, ico.length);
        $("#mdlAddComment .modal-title").text("Add New Comment");
        $("#btnSubmitComment").val("Done");
        // // // // console.log("recId: "+recId);
        $("#frmAddComment").append('<input type="hidden" name="recId" value="'+recId+'" />');
      });
      $('#mdlAddComment').on('hide.bs.modal ', function(event) {
        $("#frmAddComment")[0].reset();
        $("#frmAddComment #txaComment").text("");
        $("#frmAddComment").find("input[type='hidden']").remove();
      });
      $("div.modal-body").on('submit','form#frmAddComment',function(e){
        e.preventDefault();

        postman=  $('#frmAddComment').serialize();
        url="includes/ItemComment/addComment.php";
        var action=$("#btnSubmitComment").val();
        if(action=="Save Changes")
        {
          // postman =$('#frmModalForm').find(".changed").serialize();
          url="includes/ItemComment/updateComment.php";
        }
        // // // // console.log(postman);


        $.ajax({
          type: "POST",
          url: url,
          data: postman,
          cache: false,
          error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          }
        }).done(function(result, status){
          if (status== "success"){
            //alert("Question successly added");
            $("#tblLog").bootstrapTable('refresh');
            $("form#frmAddComment")[0].reset();
            $("form#frmAddComment #txaComment").text("");
            $('#mdlAddComment').modal('hide');
          }else{
            $("form#frmAddComment")[0].reset();
            $("form#frmAddComment #txaComment").text("");
          }
        });


      });

      function initDateTimePicker(startDate) {
        // console.log($.now());
        $('#datetimepickerStart').datetimepicker({
          ignoreReadonly: true,
          allowInputToggle: true,
          showTodayButton: true,
          format: 'ddd, D MMM YYYY hh:mm A'
        });
        $('#datetimepickerEndEdit').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            showClear:true,
            ignoreReadonly: true,
            allowInputToggle: true,
            showTodayButton: true,
            format: 'ddd, D MMM YYYY hh:mm A'

        });
        $("#datetimepickerStart").on("dp.change", function (e) {
            $('#datetimepickerEndEdit').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepickerEndEdit").on("dp.change", function (e) {
            $('#datetimepickerStart').data("DateTimePicker").maxDate(e.date);
        });
      }

    </script>

    <!-- Scripts for action item management -->
    <script type="text/javascript">

      // Add Action Item
      $("#tblLog").on('click','i.icoAddActionItem',function(){
        var ico = $(this).attr("id");
        recId = ico.substring(16, ico.length);
      });

      $("#btnAddNew").on("click", function(){
        $(".chooseExisting").find("select").removeAttr("disabled");
        $(".addNew").css("display", "block");
        $(".chooseExisting").css("display", "none");
        $("#mdlAddActionItem .modal-title").text("Create New Action Item");
        $("#btnCancel").removeAttr("data-dismiss");
        $("#btnSubmitActionItem").val("Create And Add");
        $("#btnCancel").val("Back");


        $(".chooseExisting").find("select").attr("disabled", "disabled");
        $("#frmCreateActionItem").find("input[type='hidden']").attr("disabled", "disabled");


        $(".addNew").find("input").removeAttr("disabled");
        $(".addNew").find("select").removeAttr("disabled");
        $(".addNew").find("textarea").removeAttr("disabled");
      });

      $("#mdlAddActionItem").on("click","#btnCancel", function(e){
        e.preventDefault();
        e.stopPropagation();

        // // // // console.log("boo");
        $(".addNew").css("display", "none");
        $(".chooseExisting").css("display", "block");
        $("#mdlAddActionItem .modal-title").text("Add Action Item");
        $("#btnCancel").attr("data-dismiss","modal");
        $("#btnSubmitActionItem").val("Done");
        $("#btnCancel").val("Cancel");


        // $("#btnCancel").css("display", "none");


        $(".addNew").find("input").attr("disabled", "disabled");
        $(".addNew").find("select").attr("disabled", "disabled");
        $(".addNew").find("textarea").attr("disabled", "disabled");

        $(".chooseExisting").find("select").removeAttr("disabled");

        $("#frmCreateActionItem").find("input[type='hidden']").removeAttr("disabled");


      });

      $('#mdlAddActionItem').on('hide.bs.modal ', function(event) {
        $("#frmCreateActionItem")[0].reset();
        $(".addNew").css("display", "none");
        $(".addNew").find("input").attr("disabled", "disabled");
        $(".addNew").find("select").attr("disabled", "disabled");
        $(".addNew").find("textarea").attr("disabled", "disabled");
        $("#btnSubmitActionItem").val("Done");
        $("#btnCancel").val("Cancel");

        $("#frmCreateActionItem").find("input[type='hidden']").remove();

        $("#drpActionItem").removeAttr("disabled");
        $(".chooseExisting").css("display", "block");
        $("#mdlAddActionItem .modal-title").text("Add Action Item");
        $("#btnCancel").attr("data-dismiss","modal");
        $("#txtPainPoint").css("color", "black");
        $('#drpActionItem').val('').trigger('change');
      });


      $("#tblLog").on('click','i.icoAddActionItem',function(){
        var ico = $(this).attr("id");
        recId = ico.substring(16, ico.length);
        // // // // console.log("recId: "+recId);
        $("#frmCreateActionItem").append('<input type="hidden" name="recId" value="'+recId+'" />');
      });
      var bool=false;
      $("#frmCreateActionItem").on("submit", function(e){
        e.preventDefault();
        e.stopPropagation();
        var choice = $("#btnSubmitActionItem").val();
        if(!bool && choice== "Create And Add"){
          $("#txtOwner")[0].setCustomValidity("Invalid User");
          $("#txtOwner")[0].reportValidity();
          return false;
        }
        var url="";

        if($("#txtTentativeCompletionDate").val()!=""){
          // // console.log("boo");
          $("#txtTentativeCompletionDate").val($("#datetimepickerEnd").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));
        }

        var postman ="";
        // postman = encodeURI( $("#frmCreateActionItem").serialize());
        // // console.log( decodeURIComponent($("#frmCreateActionItem").serialize()));

        if(choice =="Done"){
          url="includes/Item/addActionItem.php";
          postman =  decodeURIComponent($("#frmCreateActionItem").serialize());

        }
        else
        {
          url="includes/ActionItem/addActionItem.php";
          postman = $("#frmCreateActionItem").serialize();

        }

        // return false;
        $.ajax({
          type: "POST",
          url: url,
          data : postman,
          cache: false,
          dataType:"json",
          error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          }
        })
        .done(function(result, status){
          if(status=="success"){
            if(result.success){
              if(choice=="Create And Add")
              {
                // console.log("\n\nCreate and add\n");
                var painpoint=$("#txtPainPoint").val();
                $.ajax({
                  type: "POST",
                  url: "includes/Item/addActionItem.php",
                  data : {recId:recId, drpActionItem:painpoint},
                  dataType :'json',
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){

                  if (status=="success"){
                    if(result.success)
                    {
                      $("#tblLog").bootstrapTable('refresh');
                      $("#mdlAddActionItem").modal("hide");
                      $("#frmCreateActionItem")[0].reset();
                      $("#drpActionItem").select2("val", "");
                      $(".addNew").css("display", "none");
                      $(".addNew").find("input").attr("disabled", "disabled");
                      $(".addNew").find("select").attr("disabled", "disabled");
                      $(".addNew").find("textarea").attr("disabled", "disabled");
                      $("#btnSubmitActionItem").val("Done");
                      $("#btnCancel").val("Cancel");

                      $("#frmCreateActionItem").find("input[type='hidden']").remove();


                      $(".chooseExisting").css("display", "block");
                      $("#mdlAddActionItem .modal-title").text("Add Action Item");
                      $("#btnCancel").attr("data-dismiss","modal");
                    }
                    else
                    {
                      // $.each(result.result,function(index,value){
                      //   $("#"+index).after("<span style='color:red'>"+value+"</span>");
                      // })
                      alert("Failed: Something went wrong... ajax 2");
                    }
                  }

                });
              }
              else
              {
                $("#tblLog").bootstrapTable('refresh');
                $("#mdlAddActionItem").modal("hide");
                $("#frmCreateActionItem")[0].reset();
                $("#drpActionItem").select2("val", "");
                $(".addNew").css("display", "none");
                $(".addNew").find("input").attr("disabled", "disabled");
                $(".addNew").find("select").attr("disabled", "disabled");
                $(".addNew").find("textarea").attr("disabled", "disabled");
                $("#btnSubmitActionItem").val("Done");
                $("#btnCancel").val("Cancel");

                $("#frmCreateActionItem").find("input[type='hidden']").remove();

                $(".chooseExisting").css("display", "block");
                $("#mdlAddActionItem .modal-title").text("Add Action Item");
                $("#btnCancel").attr("data-dismiss","modal");
              }
            }
            else
            {
              alert("Failed: Something went wrong...ajax 1");
            }
          }

        });
      });
      var arrActionItem=[];

      $("#mdlAddActionItem").on("show.bs.modal", function() {
          $.ajax({
            type: "POST",
            url: "includes/ActionItem/getActionItem.php",
            dataType : "json",
            cache: false,
            error: function(xhr){
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
          })
          .done(function(result, status){
            if (status== "success"){
              // // // // console.log(result);
              $.each(result,function(i,v){
                    $("#drpActionItem").append('<option value="'+encodeURIComponent(result[i].painPoint)+'">'+result[i].painPoint+'</option>');
                    arrActionItem[i]=v.painPoint;
              });
              $("#drpActionItem").select2('destroy');
              $("#drpActionItem").select2({
                 tags: false,
                 width:"100%",
                 searchInputPlaceholder: 'Search',
                 placeholder : "Choose An Action Item "
               });
            }
          });

      });

      // Validation (Checking if PainPoint already exists ; triggered when creating new action)
      $('#txtPainPoint').keyup(function(){
        // $('#txtProjectName').closest("div").find('span').remove();
          // disablePN=false;
          $("#txtPainPoint")[0].setCustomValidity("");
          $("#txtPainPoint").removeAttr("title");
          $("#txtPainPoint").css("color", "black");

        $.each(arrActionItem,function (index,value) {
          // // // // console.log(arrActionItem[index]);
          // el = $("#txtPainPoint").get(0);
          // // // console.log(encodeURIComponent(arrActionItem[index]));
          if(arrActionItem[index].toLowerCase()==$('#txtPainPoint').val().toLowerCase().replace(/\s+/g, " ").trim())
          {
            $("#txtPainPoint").css("color", "red");
            $("#txtPainPoint").attr("title", "PainPoint Already Exist");

            $("#txtPainPoint")[0].setCustomValidity("PainPoint Already Exist");
            $("#txtPainPoint")[0].reportValidity();
            return false;
          }else{
            // // // // console.log("no");
            // $("#txtPainPoint")[0].setCustomValidity("");
            // $("#txtPainPoint").css("color", "black");
            // $("#txtPainPoint").removeAttr("title");
          }

        });
      });
    </script>

    <!-- Scripts for rec managemnet -->
    <script type="text/javascript">
      $("input[name='txtManDays']").TouchSpin({
        verticalbuttons: true,
        min: 0.5,
        max: 500,
        step: 0.05,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
      });

      // Delete Item
      $("#tblLog").on('click','i.icoDeleteRec',function(){
        var ico = $(this).attr("id");
        recId = ico.substring(12, ico.length);
        bootbox.confirm({
          title : "Delete Item",
          message : "Are you sure you want to delete this record?",
          buttons : {
            cancel : {
                  label : "<i class='fa fa-times'></i> No"

            },
            confirm : {
                label : "<i class='fa fa-check'></i> Yes"
              }
            },
            callback: function(result){
              if(result){
                $.ajax({
                  type: "POST",
                  url: "includes/Item/deleteItem.php",
                  data: {recId:recId},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){

                    $("#tblLog").bootstrapTable('refresh');
                      arrActionItemPerRec =[];
                    // $.callAjaxTxtQuestion();
                  }
                });
              }
            }

        })

      });

      // Delete description
      $("#tblLog").on('click','i.icoDeleteRecDesc',function(){
        // alert("boo");
        var ico = $(this).attr("id");
        recDescId = ico.substring(16, ico.length);
        // // // // console.log("recDescId: "+recDescId);

        recId=$(this).closest('tr').find('td input[type="hidden"]').val();
        message="Are you sure you want to delete this description?";
        if(arrDesc[recId]==1)
        {
          message=" Are you sure you want to delete this activity detail? <br/> <strong>\
                    Notice : Note that deleting this description will delete the  whole record </strong>";
        }
        bootbox.confirm({
          title : "Delete Record",
          message : message,
          buttons : {
            cancel : {
                  label : "<i class='fa fa-times'></i> No"

            },
            confirm : {
                label : "<i class='fa fa-check'></i> Yes"
              }
            },
            callback: function(result){
              if(result){
                $.ajax({
                  type: "POST",
                  url: "includes/ActivityDetails/deleteActivityDetails.php",
                  data: { recDescId:recDescId,
                          recId:recId},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){

                    $("#tblLog").bootstrapTable('refresh');
                    // $.callAjaxTxtQuestion();
                  }
                });
              }
            }

        })
      });

      // Edit Description
      $("#tblLog").on('click','i.icoEditRecDesc',function(){
        var ico = $(this).attr("id");
        id = ico.substring(14, ico.length);
        // // // // console.log("recid- "+ id);
        $.ajax({
          type: "POST",
          url: "includes/ActivityDetails/getActivityDetails.php",
          data: {id:id},
          cache: false,
          dataType:"json",
          error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          }
        }).done(function(result, status){
          if(result.success){

            initDateTimePicker(1);

            var temp=[];
            var startDate="";
            var description=result.result[0].description;
            $("#frmEditActivityDetails #txaActivityDescription").text(description);

            $("#frmEditActivityDetails #txtManDays").val(result.result[0].manDays);

              if(result.result[0].startDate=="0000-00-00 00:00:00" || result.result[0].startDate=="" || result.result[0].startDate==null){
                $("#datetimepickerStart").data("DateTimePicker").defaultDate();
              }else{
                startDate = moment(result.result[0].startDate,"YYYY-MM-DD hh:mm:ss");

                $("#datetimepickerStart").data("DateTimePicker").defaultDate(startDate);

              }
              if(result.result[0].endDate=="0000-00-00 00:00:00" || result.result[0].endDate=="" || result.result[0].endDate==null){
                $("#datetimepickerEndEdit").data("DateTimePicker").defaultDate();

              }else{
                endDate = moment(result.result[0].endDate,"YYYY-MM-DD hh:mm:ss");
                $("#datetimepickerEndEdit").data("DateTimePicker").defaultDate(endDate);
              }
            $("#frmEditActivityDetails").append('<input type="hidden" name="id" value="'+result.result[0].rec_descriptionId+'" />');
          }else{
            alert(result.result);
          }
        });
      });
      $("#frmEditActivityDetails").on("submit", function(e){
        e.preventDefault();
        e.stopPropagation();
        var url="includes/ActivityDetails/updateActivityDetails.php";
        var choice = $("#btnSubmitActivityDetails").val();

        if($("#dteStartTaskDate").val()!=""){
          // // console.log("boo");
          $("#dteStartTaskDate").val($("#datetimepickerStart").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));
        }
        if($("#dteEndTaskDateEdit").val()!=""){
          // // console.log("boo");
          $("#dteEndTaskDateEdit").val($("#datetimepickerEndEdit").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));
        }
        // // console.log($("#frmEditActivityDetails").serializeArray());

        var postman = $("#frmEditActivityDetails").serialize();
        $.ajax({
          type: "POST",
          url: url,
          data : postman,
          cache: false,
          dataType:"json",
          error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          }
        })
        .done(function(result, status){
          // alert(result);
          if(result.success){
            $("#frmEditActivityDetails")[0].reset();
            $("#tblLog").bootstrapTable('refresh');
            $("form#frmAddComment #txaActivityDescription").text("");
            $('#mdlEditActivityDetails').modal('hide');
          }
        });
      });
      $('#mdlEditActivityDetails').on('hide.bs.modal ', function(event) {
        if(event.namespace === "bs.modal"){
          $("#frmEditActivityDetails")[0].reset();
          $("#frmEditActivityDetails").find("input[type='hidden']").remove();
        }
      });
    </script>

    <script type="text/javascript">
    // $("#tblLog").on("post-body.bs.table", function(){
    //   //alert("Hello Yash");
    //   $(this).find("td[class='editDelete']").attr("data-tableexport-display","none");
    //   $(this).find("td[id='boo']").attr("data-tableexport-rowspan","2");
    //
    //
    // });

    $(document).ready(function(){
      //alert("ready");
      var $table = $("#tblLog");
      $table.bootstrapTable('refreshOptions',
      {
        exportHiddenColumns: ["delete", "editDelete"],

      });

      $table.on("post-body.bs.table", function(){
        // alert("Hello Yash");
        $(this).find("td[class='delete']").attr("data-tableexport-display","none");
      })


    });

    </script>
</body>
</html>
