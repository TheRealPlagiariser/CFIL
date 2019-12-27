
<?php
  session_start();
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
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <?php
    $title="Create Record";
    include 'includes/head.php';
  ?>
  <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
  <!-- <link rel="stylesheet" href="css/datapicker/datepicker3.css"> -->
  <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
  <link rel="stylesheet" href="css\touchspin/jquery.bootstrap-touchspin.min.css" type="text/css"/>
  <link href="css/date-time-picker/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <style>
        .custom-datatable-overright table tbody tr td.datatable-ct{
              color: red;
        }

        textarea[disabled]{
          background-color: #FFFFFF !important;
          cursor: text !important;
        }

  </style>
  <style media="screen">
    #drpActionItem{
      display: none;
    }

      .form-control.select2-hidden-accessible {
          top: 30px;
          left : 25%;
      }

      i:hover{
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
            <?php
            $active="improvementrecord";
              include 'includes/menu.php';
            ?>
            <div class="breadcome-area mg-b-30 ">
              <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                  <div class="row">
                          <div class="">
                            <ul class="breadcome-menu pull-left">
                                <li><a href="record.php">Record</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Create New Record</span>
                                </li>
                            </ul>
                          </div>
                  </div>
              </div>
            </div>
            <div class="admin-dashone-data-table-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2">

                        </div>
                        <div class="col-lg-8">
                            <div class="sparkline8-list shadow-reset">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Create New Record</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph" style="text-align:left;">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                      <div class="">
                                        <form id="frmCreateItem" class="form-horizontal" action="includes/Item/addItem.php" method="post">
                                          <!-- Project/CR/Task -->
                                          <div class="form-group">
                                            <label for="drpProject" class="col-sm-2 control-label">Project/CR/Task Name*</label>
                                            <div class="col-sm-10">
                                              <select id="drpProject"  title="Enter/Choose A Project/CR/Task (Mandatory)" class="form-control" name="drpProject"  required>
                                                <option value="" ></option>

                                                <?php
                                                   $SelectProject="   SELECT *
                                                                      FROM project
                                                                      WHERE deleted=0
                                                                      ORDER BY projectId DESC";
                                                   $SelectProject=$conn2->query($SelectProject);

                                                    while($row=$SelectProject->fetch(PDO::FETCH_ASSOC)){
                                                      echo ' <option value="'.$row["projectId"].'"> '.$row["projectName"].'</option>';
                                                    }
                                                 ?>
                                              </select>
                                            </div>
                                          </div>

                                          <!-- Project Code -->
                                          <div hidden="true" class="form-group classProjectCode">
                                            <label for="txtProjectCode" class="col-sm-2 control-label">Project/CR/Task Code*</label>
                                            <div class="col-sm-10">
                                              <input class="form-control" id="txtProjectCode" name="txtProjectCode" required >
                                            </div>
                                          </div>

                                          <!-- Activity -->
                                          <div class="form-group">
                                            <label for="drpActivity" class="col-sm-2 control-label">Activity*</label>
                                            <div class="col-sm-10">
                                              <select class="form-control" id="drpActivity"  name="drpActivity" required>
                                                <option value="" ></option>
                                                <?php
                                                   $SelectActivity="   SELECT *
                                                                      FROM activity
                                                                      WHERE deleted=0
                                                                      ORDER BY activityId DESC";
                                                   $SelectActivity=$conn->query($SelectActivity);

                                                    while($row=$SelectActivity->fetch(PDO::FETCH_ASSOC)){
                                                      echo ' <option value="'.$row["activityId"].'"> '.$row["activity"].'</option>';
                                                    }
                                                 ?>
                                              </select>
                                            </div>
                                          </div>

                                          <!-- Activity Description -->
                                          <div class="form-group">
                                            <label for="txaActivityDescription" class="col-sm-2 control-label">Activity Description*</label>
                                            <div class="col-sm-10">
                                              <textarea class="form-control" id="txaActivityDescription" required name="txaActivityDescription" rows="3"></textarea>
                                            </div>
                                          </div>

                                          <!-- Mandays Lost -->
                                          <div class="form-group">
                                            <label for="txtManDays" class="col-sm-2 control-label">Mandays Lost*</label>
                                            <div class="col-sm-10">
                                              <!-- <input type="number" step="0.01" class="form-control" required name="txtManDays" id="txtManDays" placeholder="(In Decimal)"> -->
                                              <input type="text"  class="form-control" required name="txtManDays" id="txtManDays" placeholder="(In Decimal)">

                                            </div>
                                          </div>

                                          <!-- Issue Start Date -->
                                          <div class="form-group">
                                            <label for="dteStartTaskDate" class="col-sm-2 control-label">Issue Start Date*</label>
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
                                            <label for="dteEndTaskDateCreate" class="col-sm-2 control-label">Tentative End Date</label>
                                            <div class="col-sm-10 ">
                                              <!-- <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" id="dteEndTaskDate" required name="dteEndTaskDate" placeholder="YYYY-MM-DD">
                                              </div> -->
                                              <div class='input-group date' id='datetimepickerEndCreate'>
                                                <input style="background-color:white;" type="text" readonly="readonly" class="form-control" id="dteEndTaskDateCreate" name="dteEndTaskDate" placeholder="">

                                                  <span class="input-group-addon">
                                                      <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                                              </div>
                                            </div>
                                          </div>

                                          <!-- Action Item -->
                                          <div class="form-group">
                                            <label for="drpActionItem" class="col-sm-2 control-label">Action Item</label>
                                            <div class="col-sm-10 container">
                                              <div class="input-group select2-bootstrap-append">
                                                <div class="input-group-btn">
                                                  <select class="form-control select2" id="drpActionItem"  name="drpActionItem" data-width="95.5%">
                                                    <option value="" ></option>
                                                  </select>
                                                  <span data-toggle="modal" title="Create New Action" data-target="#mdlAddActionItem" class="btn btn-default"><i  class="fas fa-plus"></i></span>
                                                </div>
                                              </div>
                                            </div>

                                          </div>



                                          <!-- <div class="form-group">
                                            <label for="txtAssign" class="col-sm-2 control-label">Assign To</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="txtAssign"  required name="txtAssign" placeholder="">
                                            </div>
                                          </div> -->

                                          <!-- Assign To -->
                                          <!-- <div class="form-group">
                                              <label for="txtAssign" class="col-sm-2  control-label">Assign To</label>
                                              <div class="col-sm-10 col-lg-10">
                                                <div class="login-input-area" style="margin-right:0;">
                                                  <input type="text" id="txtSearchUser" value="" placeholder="Search By Username Or Surname" style="margin:0;">
                                                  <span>
                                                    <i id="searchIcon" class="fa fa-search login-user" aria-hidden="true" style="top: 0px;" title="Search User"></i>
                                                  </span>
                                                  <div class="data">
                                                    <ul id="searchResults">
                                                    </ul>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="col-sm-2">   </div>
                                            <div class="col-sm-10 " style="">
                                              <h3>Project/CR/Task Assigned to these users...</h3>
                                              <div class="container-fluid selected-users-list">
                                              </div>
                                            </div>
                                          </div> -->

                                          <!-- Comment -->
                                          <div class="form-group-inner divComment">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label for="txaComment" class="login2">Comment</label>
                                                </div>
                                                <div class="col-sm-10" id="divComment">
                                                  <textarea class="form-control" id="txaComment" name="txaComment" rows="3" disabled></textarea>
                                                </div>
                                            </div>
                                          </div>

                                          <!-- Logged By -->
                                          <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label for="" class="login2">Logged By</label>
                                                </div>
                                                <div class="col-sm-10">
                                                  <label title="This record will be logged by <?php echo $_SESSION['Username']; ?>" class="login2" style="color:#c1c1c1;"><?php echo $_SESSION['Username']; ?></label>
                                                </div>
                                            </div>
                                          </div>

                                          <!-- Buttons -->
                                          <div class="form-group">
                                            <div class="row">
                                              <div class="col-sm-9">

                                              </div>
                                              <div class="col-sm-3">
                                                <div class="pull-right container-fluid" >
                                                  <input id="btnSubmit" style=" background-color:#A70027;color:white" type="submit" value="Save" class="btn btn-default">
                                                  <span style="margin-right:20%"><a href="record.php"><input style="background-color:#A70027;color:white"  type="button" value="cancel" class="btn btn-default" > </a></span>
                                                </div>

                                              </div>

                                            </div>
                                          </div>

                                        </form>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Data table area End-->
            <!-- Modal Add Action Item -->
            <div id="mdlAddActionItem" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="btnDismissModal" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Action Item</h4>
                  </div>
                  <div class="modal-body">
                      <?php $where="createactionitem"; include "includes/frmCreateActionItem.php" ?>
                  </div> <!--modal body-->
                  <div class="modal-footer">

                    <input id="btnSubmitActionItem" type="submit" value="Save" form="frmCreateActionItem" class="btn btn-default">
                    <input id="btnCancel" data-dismiss="modal" type="button" value="Cancel" form="frmCreateActionItem" class="btn btn-default">
                  </div>
                </div>

              </div>
            </div>
            <!-- End modal -->

        </div>
    </div>
    <!-- Footer Start-->
    <?php include "includes/footer.php";
    ?>

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

    <!-- Date-Time-Picker
    ============================================ -->
    <script src="js/date-time-picker/moment-with-locales.js"></script>
    <script src="js/date-time-picker/bootstrap-datetimepicker.min.js"></script>
    <!-- main JS
		============================================ -->
    <!-- <script src="js/main.js"></script> -->
    <!-- TouchSpin
    ============================================ -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/touchspin/touchspin-active.js"></script>

    <script src="js\bootbox.all.min.js"></script>
    <script src="js/datapicker/bootstrap-datepicker.js"></script>

    <script src="js\select2\select2.full.min.js"></script>


    <script src="js/action-item/action-item.js"></script>

    <!-- Initialise scripts -->
    <script type="text/javascript">
      $(function () {
          $('#datetimepickerStart').datetimepicker({
            maxDate: $.now(),
            ignoreReadonly: true,
            allowInputToggle: true,
            showTodayButton: true,
            format: 'ddd, D MMM YYYY hh:mm A',
            keyBinds: {
                        't': null, //we need 't' for dates such as Oct, disable the 't' = today's date feature
                        left: function (widget) {
                              if (!widget) {
                                  this.show();
                                  return;
                              }
                              var d = this.date() || this.getMoment();
                              if (widget.find('.datepicker').is(':visible')) {
                                  this.date(d.clone().subtract(1, 'd'));
                              }
                            },
                        right: function (widget) {
                            if (!widget) {
                                this.show();
                                return;
                            }
                            var d = this.date() || this.getMoment();
                            if (widget.find('.datepicker').is(':visible')) {
                                this.date(d.clone().add(1, 'd'));
                            }
                        }
                      }
          });
          $('#datetimepickerEndCreate').datetimepicker({
            defaultDate : false,
            useCurrent: false, //Important! See issue #1075
            showClear:true,
            ignoreReadonly: true,
            allowInputToggle: true,
            showTodayButton: true,
            format: 'ddd, D MMM YYYY hh:mm A'

          });
          $("#datetimepickerStart").on("dp.change", function (e) {
              $('#datetimepickerEndCreate').data("DateTimePicker").minDate(e.date);
          });
          $("#datetimepickerEndCreate").on("dp.change", function (e) {
              $('#datetimepickerStart').data("DateTimePicker").maxDate(e.date);
          });
      });
      $("input[name='txtManDays']").TouchSpin({
        verticalbuttons: true,
        min: 0.25,
        max: 500,
        step: 0.25,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
      });

      var services_raw=[];
      var arrActionItem=[];

      function  getActionItem()
      {
        var jqxhr = $.ajax(
            {
                dataType:'json',
                type: 'POST',
                url: "includes/ActionItem/getPainPoints.php",
                success: function(data, textStatus, jqXHR) {
                  // // console.log("data", data);
                    services_raw = data;
                    $.each(data,function(index,value){
                       arrActionItem[index]=data[index].id;
                    });

                   $("#drpActionItem").select2({
                     data : data
                   });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            }
        )
            .done(function () {
            })
            .fail(function () {
            })
            .always(function () {
            });

        jqxhr.always(function () {
        });
      }

      $(document).ready(function () {
        getActionItem();
      });

      $("#drpActionItem").select2({
         tags: false,
         width:"100%",
         searchInputPlaceholder: 'Search',
         placeholder : "Choose An Action Item",
       });
      $(".itemSearch").select2({
        tags: true,
        multiple: true,
        tokenSeparators: [',', ' '],
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        ajax: {
            url: "includes/ActionItem/getPainPoints.php",
            dataType: "json",
            type: "GET",
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: data.painPoint,
                            id: data.painPoint
                        }
                    })
                };
            }
        }
      });
      $("#drpActivity").select2({
        tags: true,
        width:"100%",
        placeholder : "Enter/Choose an Activity (Mandatory)"
      });
      $("#drpProject").select2({
        tags: true,
        width:"100%",
        placeholder : "Enter/Choose a Project/CR/Task (Mandatory)"
      });

    </script>

    <!-- General Scripts -->

    <script type="text/javascript">

      $('#mdlAddActionItem').on('hide.bs.modal ', function(event) {
        $("#frmCreateActionItem")[0].reset();
        $("#txtPainPoint").css("color", "black");
        $("#btnValidateUser").html('<i title="Check Username" class="fas fa-user-plus"></i>');
        $("#frmCreateActionItem").find("input[type='hidden']").remove();
      });
      var bool = false;

      $("#frmCreateActionItem").on("submit", function(e){
        e.preventDefault();
        e.stopPropagation();
        if(!bool){
          $("#txtOwner")[0].setCustomValidity("Invalid User");
          $("#txtOwner")[0].reportValidity();
          return false;
        }
        var url="includes/ActionItem/addActionItem.php";
        var choice = $("#btnSubmitActionItem").val();
        if($("#txtTentativeCompletionDate").val()!=""){
          // // // console.log("boo");
          $("#txtTentativeCompletionDate").val($("#datetimepickerEnd").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));
        }
        var postman = $("#frmCreateActionItem").serialize();
        var painPoint=$("#txtPainPoint").val();
        // // // // console.log(choice);
        // // // // console.log(postman);

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
            services_raw.push({
                 id: painPoint,
                 text: painPoint
             });

             // $("#drpActionItem").select2("destroy");
             $("#drpActionItem").select2({
              data:services_raw
              // initSelection:function(element,callback){
              //   // alert("boo");
              //   // callback( {id: 'Pilot follow-up', text: 'Pilot follow-up'});
              // }
            });
                       $("#drpActionItem").select2("val", painPoint);
            // $("#drpActionItem > option:nth-child("+services_raw.length+")").trigger("click");
              // $("#drpActionItem").val('Pilot follow-up');
              // $("#drpActionItem").trigger('change.select2');
              // var newOption = new Option(painPoint,painPoint, true, true);
              // $('#mySelect2').append(newOption).trigger('change');
            // // // // console.log("boo");
            // // // // console.log(painPoint);
            // yash.val(painPoint).trigger('change');
            // $("#drpActionItem").select2({val:painPoint});
              // // // // console.log("boo");


              // $("#drpActionItem").select2('data', { id:"Boo", text: "Hello!"});

          }else{
            //code to err msg
          }

          $("#tblLog").bootstrapTable('refresh');
          $("#mdlAddActionItem").modal("hide");
          $("#frmCreateActionItem")[0].reset();
          // $("#drpActionItem").select2("val", "");
          // $(".addNew").css("display", "none");
          // $(".addNew").find("input").attr("disabled", "disabled");
          // $(".addNew").find("select").attr("disabled", "disabled");
          // $(".addNew").find("textarea").attr("disabled", "disabled");
          // $("#btnSubmitActionItem").val("Done");
          // $("#btnCancel").val("Cancel");

          // $("#frmCreateActionItem").find("input[type='hidden']").remove();


          // $(".chooseExisting").css("display", "block");
          // $("#mdlAddActionItem .modal-title").text("Add Action Item");
          // $("#btnCancel").attr("data-dismiss","modal");

        });

        $('#drpActionItem').on('select2:select', function (e) {
            var data = e.params.data;
            // // // console.log(data);
            alert(data);
        });

      });

      $("#divComment").on("click", function(){
        $("#frmCreateItem #txaComment").removeAttr("disabled");
        $("#frmCreateItem #txaComment").trigger("focus");
        // $("#frmCreateItem #txaComment").trigger("dblclick");

        // alert("boo");
      });

      $("#frmCreateItem").on("submit", function(e){
        // e.preventDefault();
        // e.stopPropagation();
        var comment=$("#frmCreateItem #txaComment").val().replace(/\s+/g, " ").trim();
        if(comment ==""){
          // alert("boo");
          $("#frmCreateItem #txaComment").attr("disabled", "disabled");
        }
        if($("#dteEndTaskDateCreate").val()!=""){

          $("#dteEndTaskDateCreate").val($("#datetimepickerEndCreate").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));
        }

        if($("#dteStartTaskDate").val()!=""){

          $("#dteStartTaskDate").val($("#datetimepickerStart").datetimepicker("viewDate").format("YYYY-MM-DD HH:mm:ss"));

        }
        // // // console.log($("#frmCreateItem").serializeArray());
        // return false;

      });

    </script>

<script type="text/javascript">



  $("#drpProject").on("select2:select",function(){
    var strUser =$(this).val();
    if(!$.isNumeric(strUser)){
      $(".classProjectCode").removeAttr("hidden");
      $("#txtProjectCode").attr("required", true);
    }
    else{
      $(".classProjectCode").attr("hidden", true);
      $("#txtProjectCode").removeAttr("required");
    }



  });

</script>



</body>
</html>
