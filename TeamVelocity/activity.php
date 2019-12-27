
<?php

session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: ../index.php");
}


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Activity";
      include 'includes/head.php';
      include 'includes/db_connect.php';
      $selectConfig= "SELECT * FROM config";
      $selectConfig=$conn->query($selectConfig);
      $selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);
      $superusers = explode("|", $selectConfig[0]["superusers"]);
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
            $active="activity";
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
                                        <h1>Activities</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                      <!-- Add Buttton -->
                                      <div class="text-left">
                                          <button id="btnAddActivity"  data-toggle="modal" data-target="#mdlAddActivity" class="btn btn-success btn-sm" >Add New Activity</button>
                                      </div>
                                      <!--End Add Buttton -->
                                      <table id= "tblActivity">
                                      </table>
                                      <!-- <table
                                        data-toggle="table"
                                        data-search="true"
                                        data-show-columns="true">
                                        <thead>
                                          <tr>
                                            <th>Activity</th>
                                            <th>Activity Name</th>

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

            <!-- Modal Add Activity -->
            <div id="mdlAddActivity" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="btnDismissModal" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Activity</h4>
                  </div>
                  <!-- Modal Body  -->
                  <div class="modal-body">
                    <form id="frmModalForm">
                      <div class="container-fluid">

                        <div class="form-group">
                          <label id="lblActivity" for="txtActivity" class="col-sm-3 control-label" style="margin-top: 6px;">Enter Activity:</label>
                          <div class="col-sm-9">
                            <input id="txtActivity" name="txtActivity" required type="text" class="form-control" placeholder="">
                          </div>
                        </div>

                      </div>



                    </form>
                  </div> <!--modal body-->
                  <div class="modal-footer">
                    <input id="btnSubmitActivity" type="submit" value="Done" form="frmModalForm" class="btn btn-default" >
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
        var table=$('#tblActivity');
        var activity=[];
        // // console.log("hello");

        table.bootstrapTable(
          {

            url           : 'includes/Activity/getActivity.php',
            method        : "post",
            onLoadSuccess:  function (result) {
                              activity=result.map(x=>x.activity);
                            },

            pagination    : true,
            search        : true,
            showRefresh   : true,
            striped       : true,
            columns       : [{
                                field: 'activity',
                                title: 'Activity',
                                sortable: true,
                                formatter : function(value, row, index) {
                                         return '<input type="hidden"  id="chkActivityId'+row.activityId+'" name="chkActivityId'+row.activityId+'" value="'+row.activityId+'">' + value;
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
                                  if(row.count==row.sum)
                                  {
                                    return '<i data-toggle="tooltip" data-placement="bottom" title="Edit"  id="btnEdit'+index+'" class=" far fa-edit"></i>'+'<i data-toggle="tooltip" data-placement="bottom" title="Delete this record"  id="btnRemove'+index+'" style="margin-left:6%;color:red" class=" fa fa-trash"></i>' ;
                                  }else{
                                    return "In Use";
                                  }
                                }

                            }]

        });


        //update value
        $("#tblActivity").on('click','i[id^="btnEdit"]',function(){

          activityId=$(this).closest('tr').find('td input[type="hidden"]').val();
          // alert(activityId);
          $.ajax({
            url : "includes/Activity/getActivity.php",
            type : "post",
            data : {activityId : activityId},
            dataType : "json"
          }).done(function(data){
              // console.log("boo" +data);

            $("#txtActivity").val(data[0].activity);
            $("#frmModalForm").append("<input name='activityId' type='hidden' value='"+data[0].activityId+"'>");
            $("#btnSubmitActivity").val("Update");
            $("#btnSubmitActivity").attr("disabled", true);
            $("#mdlAddActivity div.modal-header h4.modal-title").text("Update Activity");
            $("#mdlAddActivity").modal("show");

          }).fail(function(e){
            // console.log("boo err " +e);
          });


        });

        $("#frmModalForm :input").keyup(function () {
                $(this).addClass('changed');
                if($("#btnSubmitActivity").val()=="Update"){
                  $("#btnSubmitActivity").attr("disabled", false);
                }
        });
        //submit a new activity
        $('#frmModalForm').submit(function(e){
          e.preventDefault();

          $("#frmModalForm :input").not(".changed").not("[type='hidden']").attr("disabled",true);
          formdata=$('#frmModalForm').serialize();
          $("#frmModalForm :input").not(".changed").attr("disabled",false);
          $("#frmModalForm ").find("input[type='hidden']").remove();
          action=$("#btnSubmitActivity").val();
          url="includes/Activity/addActivity.php";

          if(action=="Update")
          {
            url="includes/Activity/updateActivity.php";
          }

          // console.log("frmdata "+formdata);

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
              $("#tblActivity").bootstrapTable('refresh');
              $("#frmModalForm")[0].reset();
              $("#btnSubmitActivity").val("Done");
              $("#mdlAddActivity div.modal-header h4.modal-title").text("Add New Activity");
              $('#mdlAddActivity').modal('hide');
            }else{
              // console.log("boo");
            }
          });

        });
        $("#tblActivity").on('click','i[id^="btnRemove"]',function(){
          // console.log(this.closest('tr'));
          activityId=$(this).closest('tr').find('td input[type="hidden"]').val();
          // alert(activityId);
          bootbox.confirm({
            title : "Delete Activity",
            message : "Are you sure you want to delete this activity?",
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
                    url: "includes/Activity/deleteActivity.php",
                    data: {activityId:activityId},
                    cache: false,
                    error: function(xhr){
                      alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                  }).done(function(result, status){
                    if (status== "success"){
                      $("#tblActivity").bootstrapTable('refresh');
                    }
                  });
                }
              }
          })
        });

        //check if activity name is unique
        disable=false;
        $('#txtActivity').keyup(function(){
          $('#txtActivity').closest("div").find('span').remove();
            disable=false;
          $.each(activity,function (index,value) {

            if(value.toLowerCase()==$('#txtActivity').val().toLowerCase().replace(/\s+/g, " ").trim())
            {
                //$('#txtActivity').after("<span  style='color:red'>This Activity Already Exists</span>");
                  disable=true;
                  return false;
            }
          });
          if(disable)
          {
            $("#txtActivity")[0].setCustomValidity('This Activity Already Exists');
            $("#txtActivity")[0].reportValidity();
            //$("#btnSubmitActivity").attr("disabled",true);
          }
          else{
             $("#txtActivity")[0].setCustomValidity("");
            //$("#btnSubmitActivity").attr("disabled",false);
          }
        });


        $('#mdlAddActivity').on('hide.bs.modal ', function(event) {
          var $activeElement = $(document.activeElement);
          $("#frmModalForm")[0].reset();
          if ($activeElement.is('[data-toggle], [data-dismiss]')) {
            if (event.type === 'hide') {
              if($("#btnSubmitActivity").val()=="Update"){
                // // console.log('The button that closed the modal is: ', $activeElement);
                $("#mdlAddActivity div.modal-header h4.modal-title").text("Add New Activity");
                $("#btnSubmitActivity").val("Done");
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

        $('#mdlAddActivity').on('shown.bs.modal ', function(event) {
          // if($("#btnSubmitActivity").val()=="Update"){
            $('#txtActivity').closest("div").find('span').remove();
            // $("")
          if($("#btnSubmitActivity").val()=="Done"){
                $("#btnSubmitActivity").attr("disabled",false);
          }


        });

    });//end of   $(document).ready()>

    </script>

</body>
</html>
