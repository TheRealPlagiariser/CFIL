<!doctype html>
<?php session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: ../index.php");
}

if(!isset($_GET['surveyId']))
{
  header("Location: survey.php");
}
    include 'includes/db_connect.php';


 ?>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Survey";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>

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
                                       <li><span class="bread-blod">View Survey</span>
                                       </li>
                                   </ul>
                                 </div>
                         </div>
                     </div>
                   </div>
                 </div>

                 <div class="container-fluid mg-b-40">
                     <div class="row mg-b-10">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1>Survey Description</h1>

                                     </div>
                                 </div>
                                 <div class="sparkline8-graph" style="text-align:left;">
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
                                         <label class="col-md-2">Template Name</label>
                                         <a href=""><span id="spanTemplateName" class=""><?php //echo $select[0]["templateName"] ?></span></a>

                                       </div>
                                       <div class="row">
                                         <label class="col-md-2">Cycle</label>
                                         <span id="spanCycleName" class=""><?php //echo $select[0]["cycleName"] ?></span>

                                       </div>
                                       <div class="text-right ">
                                          <button id="btnEditSurveyDetails" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditSurveyDetails"> Edit Survey Details</button>
                                       </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1> List of Users</h1>

                                     </div>
                                 </div>
                                 <div class="sparkline8-graph" style="text-align:left;">
                                     <div class="datatable-dashv1-list custom-datatable-overright">

                                       <div class="row">
                                         <div class="table-responsive">
                                           <table id="tblUser">

                                          </table>

                                          </div>
                                       </div>
                                       <div class="row">
                                         <div class="text-right mg-t-10">
                                           <div class="btn-group">
                                              <button id="btnWithChecked" disabled type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                With Selected User... <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu">
                                                <li id="btnWithCheckedRemove" data-value="Remove"><a href="#">Remove</a></li>
                                                <li id="btnWithCheckedSend" data-value="send"><a href="#">Send</a></li>

                                              </ul>
                                            </div>


                                           	<button id="btnAddMoreUser" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdlAddMoreUser"> Add More Users...</button>
                                         </div>
                                       </div>

                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Add User -->
                     <div id="mdlAddMoreUser" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
                       <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">Add More Users</h4>
                           </div>
                           <div class="modal-body">
                              <form id="frmAddUsers" class="form-horizontal" action="" method="post">
                                <div class="form-group">
                                    <label for="txtSearchUser" class="col-sm-2  control-label">Search User</label>
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
                                    <h3>Adding  these users...</h3>
                                    <div id="selectedUsers" class="container-fluid selected-users-list">
                                    </div>
                                  </div>
                                </div>


                              </form>
                           </div>
                           <div class="modal-footer">
                             <!-- <button type="button" class="btn btn-default close" data-dismiss="modal">Cancel</button> -->
                             <input form="frmAddUsers" type="submit" value="Done" class="btn btn-default" >
                           </div>
                         </div>
                       </div>
                     </div>
                     <!-- End Modal-->

                     <!--Modal Send Survey-->
                     <div id="mdlSendSurvey" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                       <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">How do you wish to proceed?</h4>
                           </div>



                           <div class="modal-body">
                             <form id="frmSendSurvey"class="" action="includes\Survey\sendSurvey.php" method="post">
                             <div class="radio">
                               <label><input id="radSendNow" type="radio" name="radSend[type]" value="now" checked>Send Now</label>
                             </div>
                             <div class="radio">
                               <label><input id="radSchedule" type="radio" value="schedule" name="radSend[type]">Schedule...</label>
                             </div>

                             <div id="divSchedule" class="schedule" style ="display:none;">
                               <label for="date" class=" form-control-label">Choose date</label>
                               <input id="date" disabled required type="date" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')); ?>" class="form-control" name="radSend[date]">
                             </div>
                               </form>
                           </div>
                           <div class="modal-footer">

                             <input form="frmSendSurvey" type="submit" value="Done" class="btn btn-default" >
                             <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">

                           </div>

                         </div>
                       </div>
                     </div>
                     <!--End of send survey-->

                     <!--Modal Edit Survey-->
                     <div id="mdlEditSurveyDetails" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                       <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">Edit Survey Details</h4>
                           </div>
                           <div class="modal-body">
                             <form id="frmEditSurvey" class="" action="includes\Survey\sendSurvey.php" method="post" class="form-horizontal">
                               <div class="row">
                                   <div class="col-sm-12 ">

                                        <div class="form-group row">
                                            <label for="txtSurveyName" class="col-sm-4 control-label">Survey Name</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" value='<?php //echo $select[0]["surveyName"] ?>' placeholder="Type a survey name"name='txtSurveyName' id="txtSurveyName" placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                           <label for="cmbProject" class="col-sm-4 control-label">Select Project</label>
                                          <div class="col-sm-8">

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

                                                       echo ' <option  value="'.$row["projectId"].'"> '.$row["projectCode"].' - '.$row["projectName"].'</option>';
                                                     }


                                               ?>
                                               </optgroup>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="cmbProject" style="padding-right:0%;"class="col-sm-4 control-label">Choose Template</label>
                                          <div class="col-sm-8">
                                           <select id="drpTemplate" class="form-control" name="drpTemplate" form="frmCreateSurvey"  data-live-search="true" required>
                                             <option value=""></option>
                                             <?php


                                                    $SelectTemplate="SELECT * FROM template WHERE deleted=0";
                                                    $SelectTemplate=$conn->query($SelectTemplate);

                                                    while($row=$SelectTemplate->fetch(PDO::FETCH_ASSOC)){

                                                      echo '<option  value="'.$row["templateId"].'">'.$row["templateName"].'</option>';
                                                    }


                                              ?>
                                           </select>
                                         </div>
                                        </div>

                                   </div>
                               </div>
                               <input type="hidden" name="surveyId" class="changed" value="<?php echo $_GET['surveyId']; ?>">
                            </form>
                           </div>

                           <div class="modal-footer">
                             <input disabled form="frmEditSurvey" id="btnSubmitEditSurvey" type="submit" value="Done"  class="btn btn-default" >
                             <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">
                           </div>

                         </div>
                       </div>
                     </div>
                     <!--End of Edit survey-->



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

    <script src="js\SearchUser\search.js"></script>
    <?php //include "sendSurvey.php"; ?>
    <script type="text/javascript">

    $(document).ready(function(){
        //create the datatable
        var oldProjectId="";
        var oldTemplateId="";
        var oldSurveyName="";
        $("#drpProject").select2({
          placeholder : "Choose A Project",
          width:"100%"

        });

        $("#drpTemplate").select2({
            placeholder : "Choose A Template",
            width:"100%"

          });

        var table=$('#tblUser');
        var usernameFromDataBase=[];
        arrSelectedUser=[];

        table.bootstrapTable(
          {
            url : 'includes/Survey/getUsers.php',
            method :"post",
            contentType : 	"application/x-www-form-urlencoded",
            queryParams : function (p) {
              survey=location.search.split("=")[1];
              return {surveyId :survey};
            },

            onLoadSuccess: function (result) {

              $("#btnWithChecked").attr("disabled",true);

              surveyNameEdited=result[0].surveyName;
              $("#spanSurveyName").text(result[0].surveyName);
              $("#spanProjectName").text(result[0].projectName);
              $("#spanCycleName").text(result[0].cycleName);
              $("#spanTemplateName").text(result[0].templateName);
              // alert(location.href);
              $("#spanTemplateName").closest("a").attr("href","viewTemplate.php?from="+location.href+"&templateId="+result[0].templateId);

              $("#txtSurveyName").val(result[0].surveyName);
              $("#drpProject").select2("val",result[0].projectId);
              $("#drpTemplate").select2("val",result[0].templateId);

              oldSurveyName=result[0].surveyName;
              oldProjectId=result[0].projectId;
              oldTemplateId=result[0].templateId;

              usernameFromDataBase=result.map(x=>x.username);
              arrSelectedUser=result.map(x=>x.username);

              expired=result[0].expired;
              if(expired==1){
                $("#btnEditSurveyDetails").attr("disabled",true);
                $("#btnAddMoreUser").attr("disabled",true);
                $("tr i[data-toggle='tooltip']").css("pointer-events","none").closest("td").css("cursor","not-allowed");
              }

              sent=result.map(x=>x.sent);
              $.each(sent,function(index,value){
                if(value==1)
                {
                  $("#btnEditSurveyDetails").attr("disabled",true);
                  return false;
                }
              });

              if(result[0].username==null)
              {
                table.bootstrapTable('removeAll');
              }



          },
            pagination    : true,
            search        : false,
            showRefresh   : false,
            striped       : true,
            columns       : [{

                                checkbox: true,

                                // checkboxEnabled :false
                              },{
                                field: 'username',
                                title: 'Username',
                                sortable: true,
                                // formatter :function(value,row,index){
                                //
                                //   return value+'<input type="hidden" name="usern" value="'+value+'">';
                                //
                                // }
                              },{
                                field: 'fullName',
                                title: 'Full Name',
                                sortable: true,

                              }
                              ,{
                                field: 'email',
                                title: 'Email',
                                sortable: true,
                              },
                              // {
                              //   field: 'surveyUrl',
                              //   title: 'Survey Url',
                              //   class : "name",
                              //   sortable: true,
                              //   formatter : function(value, row, index)
                              //   {
                              //     return "<a style='color:#337ab7' href='"+row.surveyUrl+"'>"+value+"</a>"
                              //   }
                              // },

                              {
                                  field: 'dateSent',
                                  title: 'Date Sent',
                                  sortable: true,
                                  formatter: function(value, row, index){
                                    info[row.username]=value;
                                    return value;

                                  }
                              },
                              {
                                field: 'dateExpired',
                                title: 'Date Expired',
                                sortable: true,

                              },{
                                  field: 'sent',
                                  title: 'Sent',
                                  align : "center",
                                  halign : "left",
                                  formatter : function(value, row, index) {
                                    if(value==1)
                                    {
                                      return '<i style="color:green" class="fa fa-check" aria-hidden="true"></i>'
                                    }
                                    else if(value==0){
                                      return '<i  class="fa fa-times" aria-hidden="true"></i>'
                                    }
                                    return value;
                                  }
                                },{
                                  field: '',
                                  title: 'Action',
                                  sortable: false,
                                  // align : "center",
                                  // halign : "left",
                                  formatter : function(value, row, index) {
                                    if(row.sent==0)
                                    {
                                      display='<i data-toggle="tooltip" data-placement="bottom" title="Send Survey"  id="btnSend'+index+'" style="margin-left:10%;" class="fa fa-paper-plane"></i>';
                                      return display+'<i data-toggle="tooltip" data-placement="bottom" title="Remove this record"  id="btnRemoveUser'+index+'" style="margin-left:10%;color:red" class=" fa fa-trash"></i>' ;
                                    }else if(row.sent==1){
                                      return "Already Sent";
                                    }
                                    return value;
                                  }

                            }],
            onCheck	: function (row, $element) {

              $("#btnWithChecked").attr("disabled",false);

            },
            onCheckAll : function(row,$element){
                $("#btnWithChecked").attr("disabled",false);
            },
            onCheckSome : function(row,$element){
                $("#btnWithChecked").attr("disabled",false);
            },

            onUncheckAll : function (row, $element) {

              $("#btnWithChecked").attr("disabled",true);

            },
            onUncheck : function (row, $element) {
              //disable check button if all unselected
              if($("#tblUser").bootstrapTable("getSelections")==0)
              {
                $("#btnWithChecked").attr("disabled",true);
              }
            },
            onPostBody :function (data) {

              if(data.length>0 )
              {
                if(data[0].expired==0)
                {
                  sent=0;
                  $.each(data,function (index,value) {
                    if(value.sent==1)
                    {
                      sent++;

                      $("#tblUser").find("input[data-index='"+index+"']").attr("disabled","disabled");
                    }
                    $("#tblUser").find("input[data-index='"+index+"']").attr("name","username[]").attr("value",value.username);
                  });

                  if(sent==data.length)
                  {
                    $("#tblUser").find("input[name='btSelectAll']").attr("disabled","disabled");
                  }

                }
                else{

                  $.each(data,function (index,value) {

                      $("#tblUser").find("input[data-index='"+index+"']").attr("disabled",true);


                  });
                    $("#tblUser").find("input[name='btSelectAll']").attr("disabled",true);
                }

              }

              $("#tblUser").find("input[type='checkbox']").attr("checked",false);

            }// end of function onPostBody


        });

        $("#mdlAddMoreUser").on("hide.bs.modal ",function(e){
          $("#txtSearchUser").val("");

          arrSelectedUser=[];
          $.each(usernameFromDataBase,function (index,value) {
              arrSelectedUser.push(value);
          })

          $("ul#searchResults li#header").css("display","none");
          $("ul#searchResults").empty();
          $("#selectedUsers").empty();
        });

        //add more users
        $("#frmAddUsers").submit(function (e) {
          e.preventDefault();

          surveyId=location.search.split("=")[1];
          data=$("#frmAddUsers").not("#txtSearchUser").serialize();
          // alert(data);
          if(data=="")
          {
            $("#mdlAddMoreUser").modal("hide");
            return false;
          }
          data+="&surveyId="+surveyId;
          // return false;
          jQuery.ajax({
            url : "includes/Survey/addUser.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data :data

          }).done(function (data)
          {

            if(data.success)
            {
              $("#tblUser").bootstrapTable('refresh');
              $("#mdlAddMoreUser").modal("hide");
              $("#frmAddUsers").find("input[type='hidden']").remove();
              $("#txtSearchUser").val("");
              $("ul#searchResults li#header").css("display","none");
              $("ul#searchResults").empty();
              $("#selectedUsers").empty();

            }

          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });

        })
        surveyNameEdited="";
        //remove one user
        $("#tblUser").on("click","i[id^='btnRemoveUser']",function (e) {
          index=$(this).closest('tr').attr("data-index");
          $("#tblUser").bootstrapTable("check",index);
          data=$("#tblUser").find('input[type="checkbox"]:checked').serialize();
          split=location.search.split("=");
          data+="&surveyId="+split[1];
          bootbox.confirm({
            title : "Remove  User",
            message : "Are you sure you want to remove this user?",
            buttons : {
              confirm : {
                  label : "<i class='fa fa-check'></i> Yes"
                },
              cancel : {
                    label : "<i class='fa fa-times'></i> No"

              }

              },
              callback: function(result){
                if(result){
                  $.ajax({
                    type: "POST",
                    url: "includes/Survey/removeUser.php",
                    data: data,
                    cache: false,
                    error: function(xhr){
                      alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                  }).done(function(result, status){
                    if (status== "success"){
                      //alert("Question successly added");
                        $("#tblUser").bootstrapTable('refresh');

                      //alert(result);
                    }
                  });
                }
                else{
                  $("#tblUser").bootstrapTable("uncheck",index);
                }
              }

          });


        });

        //remove multiple user
        $("#btnWithCheckedRemove").click(function (e) {
          data=$("#tblUser").find("input[type='checkbox']:checked").serialize();
          split=location.search.split("=");
          data+="&surveyId="+split[1];
          // alert(data);
          bootbox.confirm({
            title : "Bulk Remove  User",
            message : "Are you sure you want to remove these users?",
            buttons : {
              confirm : {
                  label : "<i class='fa fa-check'></i> Yes"
                },
              cancel : {
                    label : "<i class='fa fa-times'></i> No"

              }

              },
              callback: function(result){
                if(result){
                  $.ajax({
                    type: "POST",
                    url: "includes/Survey/removeUser.php",
                    data: data,
                    cache: false,
                    error: function(xhr){
                      alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                  }).done(function(result, status){
                    if (status== "success"){
                      //alert("Question successly added");
                        $("#tblUser").bootstrapTable('refresh');

                      //alert(result);
                    }
                  });
                }
              }

          })
          // alert("Remove");
        });
        var info=[];
        //before sending/scheduling for one user
        $("#tblUser").on("click","i[id^='btnSend']",function(){
          username=$(this).closest("tr").find("input[type='checkbox']").attr("value");
          surveyId=location.search.split("=")[1];
          $("#frmSendSurvey").find("input[id='date']").val(info[username]);
          $("<input>").attr("type","hidden").attr("name","radSend[username]").val(username).appendTo("#frmSendSurvey");
          $("<input>").attr("type","hidden").attr("name","surveyId").val(surveyId).appendTo("#frmSendSurvey");
          $("#mdlSendSurvey").modal("show");
        });

        //send/schedule for one user
        $("#frmSendSurvey").submit(function (e) {
          e.preventDefault();
          data =$(this).serialize();

          jQuery.ajax({
            url : "includes/Survey/sendSurvey.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data :data
          }).done(function (data)
          {
              $("#tblUser").bootstrapTable('refresh');
              $("#mdlSendSurvey").modal("hide");
              $("#frmSendSurvey").find("input[type='hidden']").remove();

          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });

        //brfore send/schedule for multiple user
        $("#btnWithCheckedSend").click(function (e) {
          $("#tblUser").find("input[type='checkbox']:checked").each(function () {
            if($(this).val()=="on")
            {
              return true;
            }
            $("<input>").attr("type","hidden").attr("name","radSend[username][]").val($(this).val()).appendTo("#frmSendSurvey");

          });
          $("<input>").attr("type","hidden").attr("name","scheduleAll").val("viewSurvey").appendTo("#frmSendSurvey");
          surveyId=location.search.split("=");
          $("<input>").attr("type","hidden").attr("name","surveyId").val(surveyId[1]).appendTo("#frmSendSurvey");
          $("#mdlSendSurvey").modal("show");

          // alert(data);

          // alert("Remove");
        });

        $("[name^='radSend']").change(function (e) {
          // loc=window.location.href;
          // alert(loc);
          if($(this).attr('name').indexOf("type")>0)
          {
            $("#divSchedule").fadeToggle(0);
            disabled= $('#divSchedule').find('input').prop("disabled");
            $('#divSchedule').find('input').attr("disabled",!disabled);
          }
        });

        $("#mdlSendSurvey").on("hide.bs.modal",function (e) {

            $("#frmSendSurvey").find("input[type='hidden']").remove();
            $("#frmSendSurvey")[0].reset();
            $("#divSchedule").css("display","none");
            $('#divSchedule').find('input').attr("disabled",true);
        })

        $("#mdlEditSurveyDetails").on("show.bs.modal",function(){
          // surveyId=location.search.split("=")[1];
          // $("<input>").attr("type","hidden").attr("name","surveyId").addClass('changed').val(surveyId).appendTo("#frmEditSurvey");
          $("#frmEditSurvey :input").not("input[type='hidden']").removeClass("changed");
          $("#btnSubmitEditSurvey").attr("disabled",true);
        });

        $("#mdlEditSurveyDetails").on("hidden.bs.modal",function(){

          $("#txtSurveyName").val(oldSurveyName);
          $("#drpProject").select2("val",oldProjectId);
          $("#drpTemplate").select2("val",oldTemplateId);
        });

        $("#frmEditSurvey :input").not("input[type='submit']").on("change input",function(e){
          $(this).addClass("changed");
          $("#btnSubmitEditSurvey").attr("disabled",false);
        });


          //edit survey details
        $("#frmEditSurvey").submit(function (e) {
          e.preventDefault();

          data =$(this).find(".changed").serialize();

          jQuery.ajax({
            url : "includes/Survey/updateSurvey.php",
            type : "post",
            dataType : "json",
            encode : true,
            cache : false,
            data : data
          })
          .done(function (data)
          {
              $("#frmEditSurvey :input").not("input[type='hidden']").removeClass("changed");
              $("#tblUser").bootstrapTable('refresh');
              $("#mdlEditSurveyDetails").modal("hide");


          }).fail(function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          });
        });


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
            if (status== "success"){



            }
          });
        });

        var txtSurveyName=[];
        $('#txtSurveyName').keyup(function(){
           $('#txtSurveyName').closest('div').find('span').remove();

           if($('#txtSurveyName').val().replace(/\s+/g, " ").trim()==surveyNameEdited.replace(/\s+/g, " ").trim())
           {
              $("#txtSurveyName")[0].setCustomValidity("");
              $("#txtSurveyName").removeClass("changed");
              $("#btnSubmitEditSurvey").attr("disabled",true);
              return false;
           }

           disable=false;
           $.each(txtSurveyName,function (index,value) {
             if(value.toLowerCase()==$('#txtSurveyName').val().toLowerCase().replace(/\s+/g, " ").trim() && surveyNameEdited.toLowerCase().replace(/\s+/g, " ").trim()!=value.toLowerCase().replace(/\s+/g, " ").trim())
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
             // $("#btnSubmitEditSurvey").attr("disabled",true);
           }
           else{
               $("#txtSurveyName")[0].setCustomValidity("");
             // $("#btnSubmitEditSurvey").attr("disabled",false);
           }



         });

    });

    </script>

</body>

</html>
