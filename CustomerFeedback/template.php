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
      $title="Template";
      include 'includes/head.php';
    ?>
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
          $active="template";
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
                                      <h1>Templates Available</h1>

                                  </div>
                              </div>
                              <div class="sparkline8-graph">
                                  <div class="datatable-dashv1-list custom-datatable-overright">

                                      <table  id="tblTemplate"></table>

                                      <!-- Add Buttton -->
                                      <div class="text-right">
                                          <a href="createTemplate.php" id="btnAddTemplate"  class="btn btn-success btn-sm" >Create New Template</a>
                                      </div>

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
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!-- main JS
		============================================ -->
    <!-- <script src="js/main.js"></script> -->
      <script src="js\bootbox.all.min.js"></script>
      <script src="..\js\bootstrap-notify.js"></script>
      <script>

            $(document).ready(function(){

              var table=$('#tblTemplate');

              table.bootstrapTable(
                {

                  url           : 'includes/Template/getTemplate.php',
                  pagination    : true,
                  search        : true,
                  showRefresh   : true,
                  showtoggle    : true,
                  striped       : true,
                  columns       : [
                                    {
                                      field: 'templateName',
                                      title: 'Template Name',
                                      sortable: true,
                                      formatter : function(value, row, index) {
                                               return '<input type="hidden"  id="chkProjectId'+row.templateId+'" name="chkProjectId'+row.templateId+'" value="'+row.templateId+'">' + value;
                                            }
                                    },
                                    {
                                      field: 'cycleName',
                                      title: 'Cycle',
                                      sortable: false,
                                    },
                                    {
                                      field: 'createdBy',
                                      title: 'Created By',
                                      sortable: true,
                                    },

                                    {
                                      field: 'dateCreated',
                                      title: 'Date Created',
                                      sortable: true,
                                    },
                                    {
                                      field: '',
                                      title: 'Action',
                                      sortable: false,
                                      align : "center",
                                      halign : "left",
                                      formatter : function(value, row, index) {
                                            display='';
                                              if(row.count==row.sum)
                                              {
                                                display='<i style="margin-left:10%;" data-toggle="tooltip" data-placement="bottom" title="Edit" id="btnEdit'+index+'"  class="far fa-edit"></i>'
                                                +'<i style="margin-left:10%;color:red;" data-toggle="tooltip" data-placement="bottom" title="Delete" id="btnRemove'+index+'"  class="fa fa-trash"></i>';
                                              }
                                               return '<i data-toggle="tooltip" data-placement="bottom" title="View" id="btnView'+index+'"  class="fa fa-eye"></i>'+display ;
                                      }
                                  }]
              });



              $("#tblTemplate").on("click","i[id^='btnView']",function (e) {
                  templateId=$(this).closest("tr").find('input[type="hidden"]').val();

                  window.location="viewTemplate.php?from=template.php&templateId="+templateId;
              });



              $("#tblTemplate").on('click','i[id^="btnRemove"]',function(){
                // console.log(this.closest('tr'));
                templateId=$(this).closest('tr').find('td input[type="hidden"]').val();

                bootbox.confirm({
                  title : "Delete template",
                  message : "Are you sure you want to delete this template?",
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
                          url: "includes/Template/deleteTemplate.php",
                          data: {templateId:templateId},
                          cache: false,
                          dataType : "json",
                          error: function(xhr){
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                          }
                        }).done(function(data, status){
                          if (status== "success"){
                            //alert("Question successly added");


                            if(data.success)
                            {
                                  $("#tblTemplate").bootstrapTable('refresh');

                                $.NotifyFunc ('success','Success',data.result);

                            }else{
                              $.NotifyFunc ('danger','Error',data.result);
                            }
                          }
                        });
                      }
                    }

                })
              });





              $("#tblTemplate").on('click','i[id^="btnEdit"]',function(){
                // console.log(this.closest('tr'));
                templateId=$(this).closest('tr').find('td input[type="hidden"]').val();

                window.location="createTemplate.php?templateId="+templateId;

              });
          });

        </script>
</body>
</html>
