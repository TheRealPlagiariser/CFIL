<?php
  session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
  include 'includes/db_connect.php';


  $painPointRecieved="";
  $superusers=array();
  if(isset($_GET['painPoint'])){
    $painPointRecieved = $_GET['painPoint'];
  }

  $selectConfig= "SELECT * FROM config";
  $selectConfig=$conn->query($selectConfig);
  $selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);
  // print_r($selectConfig);
  $superusers = explode("|", $selectConfig[0]["superusers"]);
  $statuses= explode("|", $selectConfig[0]["actionItemStatus"]);
  // print_r($superusers);
  // echo in_array( $_SESSION['Username'] , $superusers );
?>
<!doctype html>
<!-- jquery
  ============================================ -->
<script src="js/vendor/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
  var isSuperUser= false;

</script>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Action";
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
      <?php $activeApp="il"; ?>
        <?php include "../includes/sidebar.php"; ?>
        <div class="content-inner-all">
          <!-- Header top area start-->

          <?php
          $active="actionitem";
            include 'includes/menu.php';
          ?>

          <!-- Data table area Start-->

          <div class="admin-dashone-data-table-area">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="sparkline13-list shadow-reset">
                              <div class="sparkline13-hd">
                                  <div class="main-sparkline13-hd">
                                      <h1>Actions</h1>
                                  </div>
                              </div>
                              <div class="sparkline13-graph">
                                  <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div class="text-left">
                                        <!-- <a id="btnCreateActionItem" href="createActionItem.php" class="btn btn-success btn-sm" >Add New Action Item</a> -->
                                      <button id="btnCreateActionItem"  class="btn btn-success btn-sm" type="button"  data-toggle="modal" data-target="#mdlAddActionItem">Add New Action</button>
                                      <?php

                                        foreach ($statuses as $key => $value) {
                                          echo '<button style="margin-right:0.5%" id="btn'.$value.'" class="btn btn-secondary filterButton" value="'.$value.'">'.$value.'</button>';
                                        }
                                       ?>

                                      <button id="clear" class="btn btn-secondary">Reset</button>

                                    </div>
                                    <table
                                      id="tblActionItem"
                                      data-toggle="table"
                                      data-pagination="true"
                                      data-search="true"
                                      data-show-columns="true"
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
                                      data-search-text='<?php echo $painPointRecieved; ?>'
                                      >

                                      <thead>
                                          <th data-sortable="true" data-filter-control="input" data-field="painPoint" data-formatter="formatPainPoint" data-tableexport-value="Yash" >Pain Points</th>
                                          <th data-sortable="true" class="limitsize"  data-field="estimatedMandDays">Estimated Man Days</th>
                                          <th data-sortable="true" class="limitsizeAction"  data-field="solution">Action</th>
                                          <th data-sortable="true" data-formatter="formatResp" data-field="resp">Responsible Team</th>
                                          <th data-sortable="true" data-field="owner">Owner</th>
                                          <th data-sortable="true" data-formatter="formatAlternate" data-field="backup">Alternate</th>
                                          <th data-formatter="formatTentativeCompletionDate" class="limitsizeDate" data-field="tentativeCompletionDate">Tentative Completion Date</th>
                                          <th data-sortable="true" class="limitsizeStatus" data-filter-control="select" data-field="status">Status</th>
                                          <th data-sortable="true" data-formatter="formatProject" data-field="project">Project/CR/Task</th>
                                          <th data-formatter="formatComment" class="commentField">Comments</th>
                                          <th data-tableexport-display="none" data-align="center" data-formatter="formatAction" class="editDelete" >Edit/Delete</th>
                                      </thead>
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
                        <label id="lblQuestion" for="txaQuestion" class="form-control-label">Enter Comment below:</label>
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
                  <h4 class="modal-title">Create New Action Item</h4>
                </div>
                <div class="modal-body">
                  <?php $where="actionitem"; include "includes/frmCreateActionItem.php" ?>
                </div> <!--modal body-->
                <div class="modal-footer">
                  <input id="btnSubmitActionItem" type="submit" value="Save" form="frmCreateActionItem" class="btn btn-default">
                  <input id="btnCancel" data-dismiss="modal" type="button" value="Cancel" form="frmCreateActionItem" class="btn btn-default">
                </div>
              </div>

            </div>
          </div>
          <!-- End modal -->

          <!-- Modal Add Project -->
          <div id="mdlAddProject" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button id="" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Project/CR/Task</h4>
                </div>
                <div class="modal-body">
                  <form id="frmAddProject">
                    <div class="form-group">
                      <label for="drpProject" class="col-sm-3 control-label">Choose Project/CR/Task</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="drpProject"  name="drpProject" required>
                          <option value="" ></option>
                        </select>
                      </div>
                    </div>
                      <br/><br/>
                  </form>

                </div> <!--modal body-->
                <div class="modal-footer">

                  <input id="btnSubmitProject" type="submit" value="Done" form="frmAddProject" class="btn btn-default">
                  <input id="btnCancel" data-dismiss="modal" type="button" value="Cancel" form="frmAddProject" class="btn btn-default">
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

    <!-- bootstrap JS
		============================================ -->
  <script src="js/bootstrap.min.js"></script>
    <!-- data table JS
		============================================ -->

    <!-- <script src="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.js"></script> -->
    <script src="js/data-table/bootstrap-table.js"></script>

    <script src="js/data-table/tableExportNew.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!-- <script src="https://unpkg.com/bootstrap-table@1.15.3/dist/extensions/filter-control/bootstrap-table-filter-control.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-table-filter-control.css"> -->
    <!-- <script src="https://github.com/wenzhixin/bootstrap-table/tree/master/src/extensions/filter-control"></script> -->
    <!-- main JS
		============================================ -->
    <!-- <script src="js/main.js"></script> -->
    <script src="js\bootbox.all.min.js"></script>

    <!-- Select2
		============================================ -->
    <script src="js\select2\select2.full.min.js"></script>

    <!-- Date-Time-Picker
    ============================================ -->
    <script src="js/date-time-picker/moment-with-locales.js"></script>
    <script src="js/date-time-picker/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap-Filter-Control
    ============================================ -->
    <script src="js/data-table/bootstrap-table-filter-control.js"></script>
    <!-- <link href="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.css" rel="stylesheet"> -->

    <!-- <script src="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.js"></script> -->
    <!-- <script src="js/data-table/filter1.js"></script> -->
    <!-- <script src="js/data-table/filter.js"></script> -->


    <!-- TouchSpin
    ============================================ -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/touchspin/touchspin-active.js"></script>
  <script src="js/action-item/action-item.js"></script>


  <!-- Project Management
  ============================================  -->
    <script type="text/javascript">
      var arrProjectPerAction =[]; // Array that holds all projects per action eg: arrProjectPerAction[1]="|boo|boo1|boo2|"

      // Format project cell in bootstrap table
      function formatProject(value,row,index,field) {
        if(row.project == "" || row.project == null){
          arrProjectPerAction[row.actionItemId]="";
          return '<br/><br><i data-toggle="modal" data-target="#mdlAddProject" data-placement="bottom" title="Add Action Item" value="'+row.actionItemId+'" id="icoAddProject'+row.actionItemId+'" class="fas fa-plus-circle icoAddProject pull-right"></i>';
          // return "-";
        }else{
          // // // console.log(row.project);
            var project = row.project.split('|');
            project=project.slice(1,-1);
            arrProjectPerAction[row.actionItemId]=row.project;
            var data="";
            if(project.length ==1){
              val=value.split('|');
              data+="<a class='projects' href='record.php?project="+encodeURIComponent(val[1])+"'>"+val[1]+"</a>\
                      <i value='"+encodeURIComponent(escape(val[1]))+"' class='icoRemoveProject fas fa-minus-circle' title='Remove Project'></i>\
                      <br/>";
            }else{
              $.each(project, function(key, value){
                  data+=" <a class='projects' href='record.php?project="+encodeURIComponent(value)+"'>"+value+"</a>\
                          <i value='"+encodeURIComponent(escape(value))+"' class='icoRemoveProject fas fa-minus-circle' title='Remove Project'></i>\
                                  <hr class='hrProject'/>\
                                  ";
              });
            }

            // return data;
            return data+='<br><i data-toggle="modal" data-target="#mdlAddProject" data-placement="bottom" title="Add Action Item" value="'+row.actionItemId+'" id="icoAddProject'+row.actionItemId+'" class="fas fa-plus-circle icoAddProject pull-right"></i>';
        }

      }
      // Initialising select for Project
      $("#drpProject").select2({
       tags: false,
       width:"100%",
       searchInputPlaceholder: 'Search',
       placeholder : "Choose A Project"
      });

      // Retrieving projects to put in select
      $("#mdlAddProject").on("show.bs.modal", function() {
         $.ajax({
           type: "POST",
           url: "includes/Item/getItem.php",
           dataType : "json",
           cache: false,
           error: function(xhr){
             alert("An error occured: " + xhr.status + " " + xhr.statusText);
           }
         })
         .done(function(result, status){
           if (status== "success"){
             // // // console.log(result);
            $("#drpProject").empty();
            $("#drpProject").append('<option value=""></option>');
             $.each(result,function(i,v){
                // // // // console.log(result[i].project[0]);
                   $("#drpProject").append('<option value="'+encodeURIComponent(result[i].project[0])+'">'+result[i].project[0]+'</option>');
                   arrActionItem[i]=v.project[0];
                   // // // // console.log(v.project[0]);
             });
               $("#drpProject").select2('destroy');
             $("#drpProject").select2({
                tags: false,
                width:"100%",
                searchInputPlaceholder: 'Search',
                placeholder : "Choose A Project/CR/Task"
              });
           }
         });

      });

      // Resetting form when modal is closed
      $("#mdlAddProject").on("hidden.bs.modal", function() {
         $("#frmAddProject")[0].reset();
         $("#frmAddProject").find("input[type='hidden']").remove();
      });

      // Submitting Form for Adding Project
      $("#frmAddProject").on("submit", function(e){
         e.preventDefault();
         e.stopPropagation();
         var url="includes/ActionItem/addProject.php";
         var postman =  decodeURIComponent($("#frmAddProject").serialize());
         // // // console.log(postman);
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
           if(result.success){
             $("#tblActionItem").bootstrapTable('refresh');
             $("form#frmAddProject")[0].reset();
             // $("form#frmAddComment #txaComment").text("");
             $('#mdlAddProject').modal('hide');
           }else{
             alert("An error occured");
           }
         });
      })

      // Check if Project already exists in the list
      $("#btnSubmitProject").click(function(){
         actionItemId = $("#frmAddProject").find("input[name='actionItemId']").val();
         // // console.log("btnSubmitProject ",arrProjectPerAction[actionItemId]);
         if(arrProjectPerAction[actionItemId]!=""){
           arr=arrProjectPerAction[actionItemId].split('|');
           selected=$("#drpProject").val();
           $.each(arr, function(index, value){
             if(encodeURIComponent(arr[index]) == selected){
               // // console.log("arr[index] ",encodeURIComponent(arr[index]));
               $("#drpProject")[0].setCustomValidity("This Action Item Already Exists For This Record");
               return false;
             }else{
               $("#drpProject")[0].setCustomValidity("");
             }
           });
         }
      });

      // Add Project Icon Function
      $(".wrapper-pro").on("click", ".icoAddProject", function(){
         var aid= $(this).attr("value");
         // // console.log(arrProjectPerAction);

         $("#frmAddProject").append('<input type="hidden" name="actionItemId" value="'+aid+'" />');
      })

      // Delete Project
      $(".wrapper-pro").on("click", ".icoRemoveProject", function(){
        var actionItemId = $(this).closest("tr").find("input[type='hidden']").val();
        var projectName = decodeURIComponent(unescape($(this).attr("value")));
        bootbox.confirm({
          title : "Remove Project",
          message : "Are you sure you want to remove this project?",
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
                  url: "includes/ActionItem/removeProject.php",
                  data: {actionItemId:actionItemId, projectName:projectName},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){
                    $("#tblActionItem").bootstrapTable('refresh');
                    // $.callAjaxTxtQuestion();
                  }
                });
              }
            }

        });
      });
    </script>
    <!-- Filter Option
    ============================================  -->
    <script type="text/javascript">


      var $table = $('#tblActionItem')
      // var $button = $('#button')

      $(".filterButton").on("click",function (e) {
        val=$(this).attr('value');
        // console.log(val);
        $table.bootstrapTable('filterBy', {
          status: val
        })
      })
      // $('#btnCPL').click(function () {
        //   $table.bootstrapTable('filterBy', {
        //     status: 'CPL'
        //   })
        // });
        // $('#btnNYS').click(function () {
        //   $table.bootstrapTable('filterBy', {
        //     status: 'NYS'
        //   })
        // });
        // $('#btnWIP').click(function () {
        //   $table.bootstrapTable('filterBy', {
        //     status: 'WIP'
        //   })
        // });
        // $('#btnOGFU').click(function () {
        //   $table.bootstrapTable('filterBy', {
        //     status: 'On Going Follow Up'
        //   })
        // });
      $('#clear').click(function() {
        $table.bootstrapTable('filterBy', {});
      });
    </script>
    <!-- Formatters
    ============================================  -->
    <script type="text/javascript">
      var arrActionItem=[]; // Array containing pain points
      function ajaxRequest(params){
        $.ajax({
             method: "POST",
             url: "includes/ActionItem/getActionItem.php",
             dataType: "json"
         }).done(function (data) {
             params.success(data);
             arrActionItem=[];
             $.each(data,function(index,value){
                arrActionItem[index]=value.painPoint;
             });
         }).fail(function (er) {
            params.error(er);
         });
      }
      function formatAction(value,row,index,field) {
        // // console.log(row.acreatedBy);
        var data="-";
        if(row.acreatedBy=="<?php echo $_SESSION['Username']; ?>" || <?php  if(in_array( $_SESSION['Username'] , $superusers )){echo "true";}else{echo "false";} ?>){
          data= '<div class="center">\
                <i data-toggle="modal" data-target="#mdlAddActionItem" data-placement="bottom" title="Edit" id="'+row.recId+'" class="icoEditActionItem far fa-edit"></i>\
                <i data-toggle="tooltip" data-placement="bottom" title="Delete"  id="btnRemove'+index+'" style="color:red;margin-left:10%" class=" fa fa-trash"></i>\
                </div>';

        }else{
          data="<div class='center'>-</div>";
        }
        return '<input type="hidden"  id="chkActionItemId'+row.actionItemId+'" name="chkActiontId'+row.actionItemId+'" value="'+row.actionItemId+'">' +data;
      }
      function formatPainPoint(value,row,index,field) {
        return  value;
      }
      function formatComment(value,row,index,field) {

        data="";

        if(row.commentId =="empty"){
          data+='<br/><br/><i data-toggle="modal" data-target="#mdlAddComment" data-placement="bottom" title="Add Comment" value="'+row.actionItemId+'" class="pull-right fas fa-plus-circle icoAddComment"></i>';
          return data;
        }else{
          if(row.commentId.length >=1)
          {

            $.each(row.commentId,function (index,value) {
              if(row.createdBy[index]=="<?php echo $_SESSION['Username']; ?>" ||<?php  if(in_array( $_SESSION['Username'] , $superusers )){echo "true";}else{echo "false";} ?>){
                edit="<i data-toggle='modal' value='"+row.commentId[index]+"' data-target='#mdlAddComment' class='icoEditComment fas fa-pencil-alt' title='Edit Comment'></i>\
                <i value='"+row.commentId[index]+"' class='icoDeleteComment fas fa-minus-circle' title='Delete Comment'></i>";
              }else{
                edit="";
              }
              if(row.deletedComment[index] == "0"){
                data+= "<div class='commentClass'><strong>" + row.createdBy[index] + "</strong> [" + row.dateCreated[index] + "]: \
                          "+edit+"\
                         <br/>" + row.commentText[index] + "<br/><br/></div>";
              }else{
                return; //continue
              }
            });
          }
          data+='<i data-toggle="modal" data-target="#mdlAddComment" data-placement="bottom" title="Add Comment" value="'+row.actionItemId+'" class="pull-right fas fa-plus-circle icoAddComment"></i>';
          return data;
        }

      }
      function formatTentativeCompletionDate(value,row,index,field){
        var data="";
        if (row.tentativeCompletionDate == "0000-00-00 00:00:00"){
          data="<div style='color:#ccc;'>Not Specified</div>";
        }else{
          data=formatDate(row.tentativeCompletionDate);
          // // // // console.log(data);
        }
        return data
      }
      function formatDate(date){
        if (date == "0000-00-00 00:00:00" || date == null){
          return "<div style='color:#ccc;'>Not Specified</div>";
        }else{
          return moment(date, "YYYY-MM-DD hh:mm:ss").format("ddd, D MMM YYYY hh:mm A");
        }
      }
      function formatAlternate(value,row,index,field){
        if (row.backup == "" || row.backup == null){
          return "<div style='color:#ccc;'>Not Specified</div>";
        }else{
          return value;
        }
      }
      function formatResp(value, row, index, field){
        if (row.resp == "" || row.resp == null){
          return "<div style='color:#ccc;'>Not Specified</div>";
        }else{
          return value;
        }
      }
    </script>

    <!-- Action Item Management
    ============================================  -->
    <script type="text/javascript">
      // Retrieving relevant details about action item
      $(".wrapper-pro").on('click', '.icoEditActionItem', function(){
          actionItemId=$(this).closest('tr').find('td input[type="hidden"]').val();
          $("#mdlAddActionItem .modal-title").text("Edit Action Item");
          $("#btnSubmitActionItem").val("Save Changes");
          $.ajax({
            type: "POST",
            url: "includes/ActionItem/getActionItem.php",
            data: {actionItemId:actionItemId},
            cache: false,
            dataType:"json",
            error: function(xhr){
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
          }).done(function(result, status){
            if (status== "success")
            {
              $("#txtPainPoint").val(result.painPoint);
              $("#txtEstimatedManDays").val(result.estimatedMandDays);
              $("#txaAction").text(result.solution);
              $("#txtResp").val(result.resp);
              $("#txtOwner").val(result.owner);
              // // console.log(result.backup);
              $("#txtBackup").val(result.backup);
              if(result.tentativeCompletionDate=="0000-00-00 00:00:00" || result.tentativeCompletionDate==null){
                $("#datetimepickerEnd").data("DateTimePicker").defaultDate();
              }else{
                $("#datetimepickerEnd").data("DateTimePicker").defaultDate(moment(result.tentativeCompletionDate,"YYYY-MM-DD hh:mm:ss"));
              }
              $("#drpStatus").val(result.status);
              $(".divComment").css("display", "none");
              $("#frmCreateActionItem #txaComment").attr("disabled","disabled");
              $("#frmCreateActionItem").append('<input type="hidden" name="actionItemId" value="'+actionItemId+'" />');
              $("#frmCreateActionItem").append('<input type="hidden" name="email" value="'+result.email+'" />');
            }
          });
      });
      // Delete Action Item
      $("#tblActionItem").on('click','i[id^="btnRemove"]',function(){
        actionItemId=$(this).closest('tr').find('td input[type="hidden"]').val();
        bootbox.confirm({
          title : "Delete Action",
          message : "Are you sure you want to delete this action?",
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
                  url: "includes/ActionItem/deleteActionItem.php",
                  data: {actionItemId:actionItemId},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){
                    $("#tblActionItem").bootstrapTable('refresh');
                  }
                });
              }
            }
        })
      });
      // submit action item
      var bool = false;
      var checkFirst=false;
      $("#frmCreateActionItem").on("submit", function(e){
        e.preventDefault();
        e.stopPropagation();
        if(!bool && checkFirst){
          $("#txtOwner")[0].setCustomValidity("Invalid User");
          $("#txtOwner")[0].reportValidity();
          return false;
        }
        $("#txtTentativeCompletionDate")[0].setCustomValidity("");
        if($("#txtTentativeCompletionDate").val()!=""){
          $("#txtTentativeCompletionDate").val($("#datetimepickerEnd").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));
        }
        var url="";
        if($("#btnSubmitActionItem").val() == "Save Changes"){
          url="includes/ActionItem/updateActionItem.php";
        }else{

          url="includes/ActionItem/addActionItem.php";
        }
        var postman = $("#frmCreateActionItem").serialize();
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
            $("#tblActionItem").bootstrapTable('refresh');
            $("#mdlAddActionItem").modal("hide");
            $("#frmCreateActionItem")[0].reset();
            $(".divComment").css("display", "block");
            $("#frmCreateActionItem #txaComment").removeAttr("disabled");
            $("#frmCreateActionItem").find("input[type='hidden']").remove();

          }else{
            alert(result.result);
          }
        });
      });
      // Resseting action item form and modal when closing modal
      $('#mdlAddActionItem').on('hide.bs.modal ', function(event) {
        $("#frmCreateActionItem")[0].reset();
        $("#txaAction").text("");
        $(".divComment").css("display", "block");
        $("#frmCreateActionItem #txaComment").removeAttr("disabled");
        $("#frmCreateActionItem").find("input[type='hidden']").remove();
        $("#txtPainPoint").css("color", "black");
        $("#btnValidateUser").html('<i title="Check Username" class="fas fa-user-plus"><div id="loading-image" style="display: none;" class="loader"><img src="images/ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div></i>');
        $("#mdlAddActionItem .modal-title").text("Create New Action Item");
        $("#btnSubmitActionItem").val("Save");
        bool=true;
        $("#txtOwner")[0].setCustomValidity("");
      });

    </script>

    <!-- Comment Management
    ============================================  -->
    <script type="text/javascript">
      // Add Comment
      $(".wrapper-pro").on('click', '.icoAddComment', function(){
        id=$(this).attr("value");
        $("#frmAddComment").append('<input type="hidden" name="id" value="'+id+'" />');
        $("#btnSubmitComment").val("Done");
      });
      // Edit Comment
      $("#tblActionItem").on("click", "i.icoEditComment", function(){
        var commentId=$(this).attr("value");
        var recId=$(this).closest("tr").find("input[type='hidden']").val();
        $("#frmAddComment").append('<input type="hidden" name="commentId" value="'+commentId+'" />');

        $("#mdlAddComment .modal-title").text("Edit Comment");
        $("#btnSubmitComment").val("Save Changes");

        $.ajax({
          type: "POST",
          url: "includes/ActionItemComment/getComment.php",
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
          }else{
            alert(result.result);
          }
        });
      });
      // Delete Comment
      $("#tblActionItem").on("click","i.icoDeleteComment", function(){
        var commentId=$(this).attr("value");
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
                  url: "includes/ActionItemComment/deleteComment.php",
                  data: {commentId:commentId},
                  cache: false,
                  error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
                }).done(function(result, status){
                  if (status== "success"){
                    $("#tblActionItem").bootstrapTable('refresh');
                  }
                });
              }
            }
        })
      });
      //submit the comment form
      $("div.modal-body").on('submit','form#frmAddComment',function(e){
        e.preventDefault();
        postman=  $('#frmAddComment').serialize();
        url="includes/ActionItemComment/addComment.php";
        var action=$("#btnSubmitComment").val();
        if(action=="Save Changes")
        {
          url="includes/ActionItemComment/updateComment.php";
        }
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
            $("#tblActionItem").bootstrapTable('refresh');
            $("form#frmAddComment")[0].reset();
            $("form#frmAddComment #txaComment").text("");
            $('#mdlAddComment').modal('hide');
          }else{
            $("form#frmAddComment")[0].reset();
            $("form#frmAddComment #txaComment").text("");
          }
        });
      });
      // Resetting form and modal
      $('#mdlAddComment').on('hidden.bs.modal', function(event) {
        $("#frmAddComment")[0].reset();
        $("#frmAddComment #txaComment").text("");
        $("#frmAddComment").find("input[type='hidden']").remove();
        $("#mdlAddComment .modal-title").text("Add New Comment");
      });
    </script>

    <script type="text/javascript">

      $("#tblActionItem").on("post-body.bs.table", function(){
        // alert("Hello Yash");
        $(this).find("td[class='editDelete']").attr("data-tableexport-display","none");
      })
    </script>
</body>
</html>
