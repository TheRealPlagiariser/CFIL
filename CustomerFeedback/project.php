<!doctype html>
<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: ../index.php");
}

?>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Project/CR/Task";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\jquery-ui.css">
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">

    <style>
    .custom-datatable-overright table tbody tr td.datatable-ct{
          color: red;
    }
    </style>
</head>


<body class="materialdesign">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


    <div class="wrapper-pro">
        <?php $activeApp="cf" ?>
      <?php include "../includes/sidebar.php"; ?>
      <div class="content-inner-all">
          <!-- Header top area start-->

          <?php
          $active="project";
            include 'includes/menu.php';
          ?>

          <!-- Data table area Start-->
          <div class="admin-dashone-data-table-area">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="sparkline8-list shadow-reset">
                              <div class="sparkline8-hd">
                                  <div class="main-sparkline8-hd">
                                      <h1>Project/CR/Task</h1>

                                  </div>
                              </div>
                              <div class="sparkline8-graph">
                                  <div class="datatable-dashv1-list custom-datatable-overright">

                                      <table id="tblProject">

                                      </table>
                                      <!-- Add Buttton -->
                                      <div class="text-right">
                                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdlProject">Add New Project/CR/Task</button>
                                      </div>
                                      <!-- Modal -->
                                      <div id="mdlProject" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button id="btnCloseModal" type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Add New Project/CR/Task</h4>
                                            </div>
                                            <div class="modal-body">
                                              <!-- class=" ui-front" -->
                                              <form id="frmmodalForm" method="POST"  class=" ui-front" action="includes\Project\addProject.php">
                                                <div class="form-group text-left">
                                                  <label for="txtProjectCode" class="form-control-label">Enter Project/CR/Task Code:</label>
                                                  <input id="txtProjectCode" required type="text" class="form-control" name="txtProjectCode">
                                                </div>
                                                <div class="form-group text-left">
                                                  <label for="txtProjectName" class="form-control-label">Enter Project/CR/Task Name:</label>
                                                  <input id="txtProjectName" required type="text" class="form-control" name="txtProjectName">
                                                </div>

                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <input id="btnDone" form="frmmodalForm" value="Done" type="submit" class="btn btn-default" >
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <!-- End modal -->
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Data table area End-->
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

    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js\jquery-ui.js"></script>
    <script src="js\bootbox.all.min.js"></script>
      <script src="..\js\bootstrap-notify.js"></script>
    <script>

        $(document).ready(function(){
            //create the datatable
            var table=$('#tblProject');
            var projectName=[];
            var projectCode=[];

            table.bootstrapTable(
              {

                url           : 'includes/Project/getProject.php',
                method        : "post",
                onLoadSuccess: function (result) {
                  projectName=result.map(x=>x.projectName);
                  projectCode=result.map(x=>x.projectCode);

                  },

                pagination    : true,
                search        : true,
                showRefresh   : true,
                striped       : true,
                columns       : [{
                                    field: 'projectCode',
                                    title: 'Project/CR/Task Code',
                                    sortable: true,
                                    formatter : function(value, row, index) {
                                             return '<input type="hidden"  id="chkProjectId'+row.projectId+'" name="chkProjectId'+row.projectId+'" value="'+row.projectId+'">' + value;
                                          }
                                  },{
                                    field: 'projectName',
                                    title: 'Project/CR/Task Name',
                                    sortable: true,

                                  }
                                  ,{
                                    field: 'createdBy',
                                    title: 'Created By',
                                    sortable: true,
                                  },{
                                      field: 'dateCreated',
                                      title: 'Date/Time Created',
                                      sortable: true,
                                    },{
                                    field: '',
                                    title: 'Action',
                                    sortable: false,
                                    align : "center",
                                    halign : "left",
                                    formatter : function(value, row, index) {
                                      if(row.count==row.sum && row.count2==row.sum2)
                                      {
                                        return '<i data-toggle="tooltip" data-placement="bottom" title="Edit"  id="btnEdit'+index+'" class=" far fa-edit"></i>'+'<i data-toggle="tooltip" data-placement="bottom" title="Delete this record"  id="btnRemove'+index+'" style="margin-left:6%;color:red" class=" fa fa-trash"></i>' ;
                                      }else{
                                        return "In Use";
                                      }
                                    }

                                }]

            });

            var txtProjectName="";
            var txtProjectCode="";
            //update value
            $("#tblProject").on('click','i[id^="btnEdit"]',function(){

              projectId=$(this).closest('tr').find('td input[type="hidden"]').val();
              //alert(projectId);
              $.ajax({
                url : "includes/Project/getProject.php",
                type : "post",
                data : {projectId : projectId},
                dataType : "json"
              }).done(function(data){
                  // // console.log("boo" +data);
                  txtProjectName=data[0].projectName;
                  txtProjectCode=data[0].projectCode;
                $("#txtProjectCode").val(data[0].projectCode);
                $("#txtProjectName").val(data[0].projectName);
                $("#frmmodalForm").append("<input name='projectId' type='hidden' value='"+data[0].projectId+"'>");
                $("#btnDone").val("Update");
                  $("#btnDone").attr("disabled", true);
                $("#mdlProject div.modal-header h4.modal-title").text("Update Project/CR/Task");
                $("#mdlProject").modal("show");

              }).fail(function(e){
                // // console.log("boo err" +e);
              });


            });

            $("#frmmodalForm :input").on("change keyup",function () {
                    $(this).addClass('changed');
                    if($("#btnDone").val()=="Update"){
                      $("#btnDone").attr("disabled", false);
                    }
            });
            //submit a new project
            $('#frmmodalForm').submit(function(e){
              e.preventDefault();

              $("#frmmodalForm :input").not(".changed").not("[type='hidden']").attr("disabled",true);
              formdata=$('#frmmodalForm').serialize();
              $("#frmmodalForm :input").not(".changed").attr("disabled",false);
              $("#frmmodalForm ").find("input[type='hidden']").remove();
              action=$("#btnDone").val();
              url="includes/Project/addProject.php";

              if(action=="Update")
              {
                url="includes/Project/updateProject.php";
              }


              $.ajax({
                type: "POST",
                url: url,
                data: formdata,
                cache: false,
                dataType : 'json',
                error: function(xhr){
                  alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
              }).done(function(data, status){
                if (status== "success"){

                  if(data.success)
                  {
                      $("#tblProject").bootstrapTable('refresh');
                      $("#frmmodalForm")[0].reset();

                      $("#btnDone").val("Done");
                      $("#mdlProject div.modal-header h4.modal-title").text("Add New Project/CR/Task");

                      $('#mdlProject').modal('hide');
                      $.NotifyFunc ('success','Success',data.result);

                  }else{
                    $.NotifyFunc ('danger','Error',data.result);
                  }

                    // $.callAjaxProject();

                }
              });

            });

            //delete a project(flag)
            $("#tblProject").on('click','i[id^="btnRemove"]',function(){
              // // console.log(this.closest('tr'));
              projectId=$(this).closest('tr').find('td input[type="hidden"]').val();

              bootbox.confirm({
                title : "Delete project/CR/Task",
                message : "Are you sure you want to delete this project/CR/Task?",
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
                        url: "includes/Project/deleteProject.php",
                        data: {projectId:projectId},
                        dataType : "json",
                        cache: false,
                        error: function(xhr){
                          alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                      }).done(function(data, status){
                        if (status== "success"){

                            if(data.success)
                            {
                                $("#tblProject").bootstrapTable('refresh');

                                $.NotifyFunc ('success','Success',data.result);

                            }else{
                              $.NotifyFunc ('danger','Error',data.result);
                            }
                          //alert(result);
                        }

                      });
                    }
                  }

              })
            });

            //check if project name and code are unique
            disablePN=false;
            disablePC=false;
            $('#txtProjectName').keyup(function(){
              $('#txtProjectName').closest("div").find('span').remove();
              if(location.search.length>0)
              {
                if($('#txtProjectName').val().replace(/\s+/g, " ").trim()==txtProjectName.replace(/\s+/g, " ").trim())
                {
                  $("#txtProjectName")[0].setCustomValidity('');
                   $("#txtProjectName").removeClass("changed");
                   $("#btnDone").attr("disabled",true);

                   return false;
                }
              }

                disablePN=false;
              $.each(projectName,function (index,value) {

                if(value.toLowerCase()==$('#txtProjectName').val().toLowerCase().replace(/\s+/g, " ").trim() && txtProjectName.toLowerCase().replace(/\s+/g, " ").trim()!=value.toLowerCase().replace(/\s+/g, " ").trim())
                {
                    // $('#txtProjectName').after("<span  style='color:red'>This Project Name already exist</span>");
                      disablePN=true;
                      return false;
                }


              });
              // if(disable)
              // {
              //
              //
              //   // $("#btnSubmitQuestion").attr("disabled",true);
              //   return false;
              // }
              // else{
              //   $("#txaQuestion")[0].setCustomValidity("");
              //   // $("#btnSubmitQuestion").attr("disabled",false);
              // }
              if(disablePN )
              {
                $("#txtProjectName")[0].setCustomValidity("This project Name already exists");
                $("#txtProjectName")[0].reportValidity();
                return false;
                // $("#btnDone").attr("disabled",true);


              }
              else{
                // if(!disablePC){
                //   $("#txtProjectName")[0].setCustomValidity("");
                //   $("#btnDone").attr("disabled",false);
                // }
                // else{
                //   $("#txtProjectCode")[0].setCustomValidity("This project Code already exists");
                //   $("#txtProjectCode")[0].reportValidity();
                // }
                 $("#txtProjectName")[0].setCustomValidity("");

              }
            });

            $('#txtProjectCode').keyup(function(){
              $('#txtProjectCode').closest("div").find('span').remove();
              if(location.search.length>0)
              {
                if($('#txtProjectCode').val().replace(/\s+/g, " ").trim()==txtProjectCode.replace(/\s+/g, " ").trim())
                {
                  $("#txtProjectCode")[0].setCustomValidity('');
                   $("#txtProjectCode").removeClass("changed");
                   // $("#btnSubmitQuestion").attr("disabled",true);
                   $("#btnDone").attr("disabled",true);
                   return false;
                }
              }

              disablePC=false;
              $.each(projectCode,function (index,value) {

                if(value.toLowerCase()==$('#txtProjectCode').val().toLowerCase().replace(/\s+/g, " ").trim() && txtProjectCode.toLowerCase().replace(/\s+/g, " ").trim()!=value.toLowerCase().replace(/\s+/g, " ").trim())
                {

                    // $('#txtProjectCode').after("<span  style='color:red'>This Project code already exist</span>");
                      disablePC=true;
                      return false;
                }

              });
              if(disablePC)
              {
                $("#txtProjectCode")[0].setCustomValidity("This project code already exists");
                $("#txtProjectCode")[0].reportValidity();
                return false;
                // $("#btnDone").attr("disabled",true);

              }
              else{
                // if(!disablePN){
                //   $("#txtProjectCode")[0].setCustomValidity("");
                //   $("#btnDone").attr("disabled",false);
                // }
                // else{
                //
                //     $("#txtProjectName")[0].setCustomValidity("This project name already exists");
                //     $("#txtProjectName")[0].reportValidity();
                // }
                $("#txtProjectCode")[0].setCustomValidity("");
              }

            });



            $('#mdlProject').on('hide.bs.modal ', function(event) {

              $("#frmmodalForm")[0].reset();

                  if($("#btnDone").val()=="Update"){
                    // // // console.log('The button that closed the modal is: ', $activeElement);
                    $("#mdlProject div.modal-header h4.modal-title").text("Add New Project/CR/Task");
                    $("#btnDone").val("Done");
                     $("#frmmodalForm")[0].reset();
                     // // // console.log(   JSON.stringify($("#frmmodalForm")));
                     // // // console.log( "boooo "+JSON.stringify( $("#frmmodalForm")));
                      $("#frmmodalForm :input").not(".changed").not("[type='hidden']").attr("disabled",true);

                      $("#frmmodalForm :input").not(".changed").attr("disabled",false);
                      $("#frmmodalForm ").find("input[type='hidden']").remove();
                  }
                  // Do something with the button that closed the modal


            });

            $('#mdlProject').on('shown.bs.modal ', function(event) {
              // if($("#btnDone").val()=="Update"){
                $('#txtProjectCode').closest("div").find('span').remove();
                $('#txtProjectName').closest("div").find('span').remove();
                // $("")
                if($("#btnDone").val()=="Done"){
                      $("#btnDone").attr("disabled",false);
                }


            });

        });//end of   $(document).ready()

      </script>

</body>

</html>
