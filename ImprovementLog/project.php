
<?php

session_start();
// $_SESSION['Username']="faraju";
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
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Project";
      include 'includes/head.php';
    ?>
<link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <style>
    .custom-datatable-overright table tbody tr td.datatable-ct{
          color: red;
    }

    input[disabled]{
      background-color: #FFFFFF !important;
      cursor: default !important;
    }
    i.fa,.far:hover{
      cursor: pointer;
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
                                      <!-- Add Buttton -->
                                      <div class="text-left">
                                          <button id="btnAddProject"  data-toggle="modal" data-target="#mdlAddProject" class="btn btn-success btn-sm" >Add New Project/CR/Task</button>
                                      </div>
                                      <!--End Add Buttton -->
                                      <table id= "tblProject">
                                      </table>
                                      <!-- <table
                                        data-toggle="table"
                                        data-search="true"
                                        data-show-columns="true">
                                        <thead>
                                          <tr>
                                            <th>Project</th>
                                            <th>Project Name</th>

                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table" data-object='{"key": "value"}'>

                                            <td data-text="122">1</td>
                                            <td data-text="122">Environment</td>
                                            <td data-text="122"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><i style="margin-left:6%;color:red"class="fa fa-trash" aria-hidden="true"></i></td>


                                          </tr>

                                        </tbody>
                                      </table> -->


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Data table area End-->

            <!-- Modal Add Project -->
            <div id="mdlAddProject" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="btnDismissModal" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Project/CR/Task</h4>
                  </div>
                  <!-- Modal Body  -->
                  <div class="modal-body">
                    <form id="frmModalForm">
                      <div class="container-fluid">

                        <div class="form-group">
                          <div class="form-group text-left">
                            <label for="txtProjectCode" class="form-control-label">Enter Project/CR/Task Code:</label>
                            <input id="txtProjectCode" required type="text" class="form-control" name="txtProjectCode">
                          </div>
                          <div class="form-group text-left">
                            <label for="txtProjectName" class="form-control-label">Enter Project/CR/Task Name:</label>
                            <input id="txtProjectName" required type="text" class="form-control" name="txtProjectName">
                          </div>
                        </div>

                      </div>



                    </form>
                  </div> <!--modal body-->
                  <div class="modal-footer">
                    <input id="btnSubmitProject" type="submit" value="Done" form="frmModalForm" class="btn btn-default" >
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
    <script src="../js/vendor/jquery-1.11.3.min.js"></script>
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
    <!-- main JS
		============================================ -->
    <!-- <script src="js/main.js"></script> -->

    <script src="js\bootbox.all.min.js"></script>
    <!-- custom JS
		============================================ -->
    <script>
    $(document).ready(function(){
        //create the datatable
        var table=$('#tblProject');
        var project=[];
        // // console.log("hello");

        table.bootstrapTable(
          {

            url           : 'includes/Project/getProject.php',
            method        : "post",
            onLoadSuccess:  function (result) {
                              projectName=result.map(x=>x.projectName);
                              projectCode=result.map(y=>y.projectCode);
                            },

            pagination    : true,
            search        : true,
            showRefresh   : true,
            striped       : true,
            columns       : [
                              {
                                field: 'projectCode',
                                title: 'Project/CR/Task Code',
                                sortable: true,
                                formatter : function(value, row, index) {
                                         return '<input type="hidden"  id="chkProjectId'+row.projectId+'" name="chkProjectId'+row.projectId+'" value="'+row.projectId+'">' + value;
                                      }
                              },
                              {
                                field: 'projectName',
                                title: 'Project/CR/Task Name',
                                sortable: true,
                                formatter : function(value, row, index) {
                                         return '<input type="hidden"  id="chkProjectId'+row.projectId+'" name="chkProjectId'+row.projectId+'" value="'+row.projectId+'">' + value;
                                      }

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
                                searchable: false,
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


        //update value
        var txtProjectName="";
        var txtProjectCode="";
        $("#tblProject").on('click','i[id^="btnEdit"]',function(){

          projectId=$(this).closest('tr').find('td input[type="hidden"]').val();
          // alert(projectId);
          $.ajax({
            url : "includes/Project/getProject.php",
            type : "post",
            data : {projectId : projectId},
            dataType : "json"
          }).done(function(data){
              // console.log("boo" +data);
              txtProjectName=data[0].projectName;
              txtProjectCode=data[0].projectCode;
            $("#txtProjectName").val(data[0].projectName);
            $("#txtProjectCode").val(data[0].projectCode);
            $("#frmModalForm").append("<input name='projectId' type='hidden' value='"+data[0].projectId+"'>");
            $("#btnSubmitProject").val("Update");
            $("#btnSubmitProject").attr("disabled", true);
            $("#mdlAddProject div.modal-header h4.modal-title").text("Update Project");
            $("#mdlAddProject").modal("show");

          }).fail(function(e){
            // console.log("boo err " +e);
          });


        });

        $("#frmModalForm :input").keyup(function () {
                $(this).addClass('changed');
                if($("#btnSubmitProject").val()=="Update"){
                  $("#btnSubmitProject").attr("disabled", false);
                }
        });
        //submit a new project
        $('#frmModalForm').submit(function(e){
          e.preventDefault();

          $("#frmModalForm :input").not(".changed").not("[type='hidden']").attr("disabled",true);
          formdata=$('#frmModalForm').serialize();
          $("#frmModalForm :input").not(".changed").attr("disabled",false);
          $("#frmModalForm ").find("input[type='hidden']").remove();
          action=$("#btnSubmitProject").val();
          url="../CustomerFeedback/includes/Project/addProject.php";

          if(action=="Update")
          {
            console.log("update");
            url="../CustomerFeedback/includes/Project/updateProject.php";
          }


          $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            error: function(xhr){
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
          }).done(function(result, status){
            if (status== "success"){
              $("#tblProject").bootstrapTable('refresh');
              $("#frmModalForm")[0].reset();
              // $('#frmModalForm').load(location.href+" #frmModalForm", function() {
              //         $(this).children('#frmModalForm').unwrap();
              //   });
                $("#btnSubmitProject").val("Done");
                  $("#mdlAddProject div.modal-header h4.modal-title").text("Add New Project");
              // $("#frmModalForm").reload("#frmModalForm");
              $('#mdlAddProject').modal('hide');
                // $.callAjaxProject();

            }else{
              // console.log("boo");
            }
          });

        });

        //delete an project(flag)
        $("#tblProject").on('click','i[id^="btnRemove"]',function(){
          // console.log(this.closest('tr'));
          projectId=$(this).closest('tr').find('td input[type="hidden"]').val();
          // alert(projectId);
          bootbox.confirm({
            title : "Delete Project",
            message : "Are you sure you want to delete this project?",
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
                    url: "../CustomerFeedback/includes/Project/deleteProject.php",
                    data: {projectId:projectId},
                    cache: false,
                    error: function(xhr){
                      alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                  }).done(function(result, status){
                    if (status== "success"){
                      //alert("Question successly added");
                      $("#tblProject").bootstrapTable('refresh');
                        // $.callAjaxProject();

                      //alert(result);
                    }
                  });
                }
              }

          })
        });

        //check if project name is unique
        // disable=false;
        // $('#txtProjectName').keyup(function(){
        //   $('#txtProjectName').closest("div").find('span').remove();
        //     disable=false;
        //     // console.log(project);
        //   $.each(projectName,function (index,value) {
        //
        //     if(value.toLowerCase()==$('#txtProjectName').val().toLowerCase().replace(/\s+/g, " ").trim())
        //     {
        //         $('#txtProjectName').after("<span  style='color:red'>This Project Name Already Exists</span>");
        //           disable=true;
        //           return false;
        //     }
        //
        //
        //   });
        //
        //
        //   if(disable)
        //   {
        //     $("#btnSubmitProject").attr("disabled",true);
        //
        //
        //   }
        //   else{
        //     $("#btnSubmitProject").attr("disabled",false);
        //   }
        // });
        //
        // $('#txtProjectCode').keyup(function(){
        //   $('#txtProjectCode').closest("div").find('span').remove();
        //     disable=false;
        //     // console.log(project);
        //   $.each(projectCode,function (index,value) {
        //
        //     if(value.toLowerCase()==$('#txtProjectCode').val().toLowerCase().replace(/\s+/g, " ").trim())
        //     {
        //         $('#txtProjectCode').after("<span  style='color:red'>This Project Code Already Exists</span>");
        //           disable=true;
        //           return false;
        //     }
        //
        //
        //   });
        //
        //
        //   if(disable)
        //   {
        //     $("#btnSubmitProject").attr("disabled",true);
        //
        //
        //   }
        //   else{
        //     $("#btnSubmitProject").attr("disabled",false);
        //   }
        // });

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


        $('#mdlAddProject').on('hide.bs.modal ', function(event) {
          var $activeElement = $(document.activeElement);
          $("#frmModalForm")[0].reset();
          if ($activeElement.is('[data-toggle], [data-dismiss]')) {
            if (event.type === 'hide') {
              if($("#btnSubmitProject").val()=="Update"){
                // // console.log('The button that closed the modal is: ', $activeElement);
                $("#mdlAddProject div.modal-header h4.modal-title").text("Add New Project");
                $("#btnSubmitProject").val("Done");
                $("#frmModalForm")[0].reset();
                 // // console.log(   JSON.stringify($("#frmModalForm")));
                 // // console.log( "boooo "+JSON.stringify( $("#frmModalForm")));
                $("#frmModalForm :input").not(".changed").not("[type='hidden']").attr("disabled",true);

                $("#frmModalForm :input").not(".changed").attr("disabled",false);
                $("#frmModalForm ").find("input[type='hidden']").remove();
              }
              // Do something with the button that closed the modal

            }


          }
        });

        $('#mdlAddProject').on('shown.bs.modal ', function(event) {
          // if($("#btnSubmitProject").val()=="Update"){
            $('#txtProject').closest("div").find('span').remove();
            // $("")
          if($("#btnSubmitProject").val()=="Done"){
                $("#btnSubmitProject").attr("disabled",false);
          }


        });

    });//end of   $(document).ready()>

    </script>

</body>
</html>
