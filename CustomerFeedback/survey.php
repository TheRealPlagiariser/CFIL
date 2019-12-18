<!doctype html>
<?php session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: ../index.php");
}
?>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Survey";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">

    <style>
    .custom-datatable-overright table tbody tr td.datatable-ct{
          color: red;
    }
    .bootstrap-table .table thead > tr > td {
        padding: 0;
        margin: 0;
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
    .fa-times:hover{
      cursor: default;
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


                <?php
                    $active='survey';
                    include 'includes/menu.php';
                 ?>

                 <div class="container-fluid mg-b-40">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <h1>Survey List</h1>

                                     </div>
                                 </div>
                                 <div class="sparkline8-graph">
                                     <div class="datatable-dashv1-list custom-datatable-overright">
                                        <!-- <a href='https://localhost:8080/TestingServices/CustomerFeedBack/respondSurvey.php?surveyId=8&pCode=123456&pName=ab1'>Localhost:8080/TestingServices/CustomerFeedBack/respondSurvey.php?surveyId=8&pCode=123456&pName=ab1</a> -->
                                         <table id="tblSurvey">

                                         </table>
                                         <!-- Add Buttton -->
                                         <div class="text-right">
                                            <a href="createSurvey.php" class="btn btn-success btn-sm" role="button">Create Survey</a>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
            </div>
        </div>

        <div id="mdlSendSurvey" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">How do you wish to proceed for each user?</h4>
              </div>



              <div class="modal-body">
                <form id="frmSendSurvey"class="" action="includes\Survey\sendSurvey.php" method="post">

                  <table id="tblSendUser"></table>

                  <div class="text-right mg-t-10">
                     <button id="btnAddUser" type="button" class="btn btn-success btn-sm mg-b-10" > Add more Users...</button>
                  </div>

                  <div id="divAllSchedule"  style ="display:none;">
                    <hr/>
                    <label for="date" class=" form-control-label">Schedule for all</label>
                    <input id="date" disabled required type="date" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')); ?>"class="form-control" name="scheduleAll">
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
    <!-- main JS
		============================================ -->
    <!-- <script src="js/main.js"></script> -->

    <script src="..\js\bootstrap-notify.js"></script>
      <script  type="text/javascript">
        $(document).ready(function () {
          var table=$('#tblSurvey');

          table.bootstrapTable(
            {

              url           : 'includes/Survey/getSurvey.php',
              method        : "post",
              pagination    : true,
              search        : true,
              showRefresh   : true,
              striped       : true,
              showColumns   : false,
              columns       : [{
                                  field: 'surveyName',
                                  title: 'Survey Name',
                                  sortable : true,
                                  formatter : function(value, row, index) {
                                           return '<input type="hidden"  id="chkSurveyId'+row.surveyId+'" name="chkSurveyId'+row.surveyId+'" value="'+row.surveyId+'">' + value;
                                        }
                                },
                                {
                                  field: 'projectName',
                                  title: 'ProjectCode - ProjectName',
                                  sortable : true
                                },
                                {
                                  field: 'cycleName',
                                  title: 'Cycle Name',
                                  sortable : true
                                }

                                ,{
                                  field: 'createdBy',
                                  title: 'Created By',
                                  sortable : true
                                },
                                {
                                  field: 'dateCreated',
                                  title: 'Created On',
                                  sortable : true
                                },
                                  // {
                                  //   field:'sum',
                                  //   title:'Number of Users Sent',
                                  //   sortable : true,
                                  //   align : "center"
                                  // },
                                {
                                  field:'numReplies',
                                  title:'Number of Replies',
                                  sortable : true,
                                  align : "center"
                                },


                                {
                                  field: 'expired',
                                  title: 'Expired',
                                  sortable : true,
                                  align : "center",
                                  halign : "left",
                                  formatter :function(value,row,index){
                                    if(value>0)
                                    {
                                      return '<i style="color:green" class="fa fa-check" title="Expired" aria-hidden="true"></i>'
                                    }
                                    else{
                                      return '<i  class="fa fa-times" title="Ongoing" aria-hidden="true"></i>'
                                    }
                                    // return "<a style='color:#337ab7' href='"+row.surveyUrl+"'>"+value+"</a>";
                                  }
                                },{
                                  field: '',
                                  title: 'Action',
                                  sortable: false,
                                  searchable: false,
                                  align : "center",
                                  halign : "left",
                                  formatter : function(value, row, index) {

                                        // display="";
                                        display='<i data-toggle="tooltip" data-placement="bottom" title="View Survey"  id="btnView'+index+'" style="" class="fa fa-eye"></i>'

                                        if(row.sum<row.count && row.expired==0)
                                        {
                                          display+='<i data-toggle="tooltip" data-placement="bottom" title="Send Survey"  id="btnSend'+index+'" style="margin-left:10%;" class="fa fa-paper-plane"></i>';
                                        }
                                        if(row.sum==0)
                                        {
                                          display+='<i data-toggle="tooltip" data-placement="bottom" title="Delete" id="btnRemove'+index+'" style="margin-left:15%;color:red" class=" fa fa-trash"></i>';

                                        }

                                        if(display=="")
                                        {
                                          return "In Use";
                                        }
                                      return display;

                                  }

                              }]

          });

          // function to remove survey
          $("#tblSurvey").on("click","i[id^='btnRemove']",function(){
            surveyId=$(this).closest("tr").find("input[type='hidden']").attr("value");
            bootbox.confirm({
              title : "Delete  Survey",
              message : "Are you sure you want to delete this Survey?",
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
                      url: "includes/Survey/deleteSurvey.php",
                      data: {surveyId:surveyId},
                      cache: false,
                      dataType : "json",
                      error: function(xhr){
                        alert("An error occured: " + xhr.status + " " + xhr.statusText);
                      }
                    }).done(function(data, status){
                      if (status== "success"){
                          $("#tblSurvey").bootstrapTable('refresh');
                        if(data.success)
                        {
                            $.NotifyFunc ('success','Success',data.result);

                        }
                        else{
                          $.NotifyFunc ('danger','Error',data.result);
                        }



                        //alert(result);
                      }
                    });
                  }
                }

            })

          })

          // function to generate body of modal to send survey
          $("#tblSurvey").on("click","i[id^='btnSend']",function(){
            surveyId=$(this).closest("tr").find("input[type='hidden']").attr("value");
            $("<input>").attr("type","hidden").attr("name","surveyId").val(surveyId).appendTo("#frmSendSurvey");
            $("#mdlSendSurvey").modal("show");

            $("#tblSendUser").bootstrapTable(
              {
                url : 'includes/Survey/getUsers.php',
                method :"post",
                contentType : 	"application/x-www-form-urlencoded",
                queryParams : function (p) {
                  // survey=location.search.split("=")[1];
                  return {surveyId :surveyId,sent : true};
                },

                striped       : true,
                columns       : [{
                                    field: 'fullName',
                                    title: 'Full Name',

                                  },
                                  {
                                      field: '',
                                      title: ' <input type="radio"  checked  name="radAllSend" value="now"> Send Now',
                                      halign : "left",
                                      align : "center",
                                      formatter : function (value,row,index) {
                                        check="checked";


                                        if(row.dateSent!=null)
                                        {
                                          check="";
                                        }
                                        return '<input type="hidden"  name="radSend'+row.username+'[username]" value="'+row.username+'">\
                                                  <input '+check+' class="now" type="radio"  name="radSend'+row.username+'[type]" value="now">';

                                      }
                                  },{
                                      field: '',
                                      title: ' <input type="radio"  name="radAllSend" value="schedule"> Schedule',
                                      halign : "left",
                                      align : "center",
                                      formatter : function(value, row, index) {
                                        check="";
                                        date="";
                                        display="none";
                                        disable="disabled";
                                        if(row.dateSent!=null)
                                        {
                                          check="checked";
                                            display="block";
                                          date=row.dateSent;
                                          disable="";
                                        }
                                        var today=new Date();
                                        today.setDate(today.getDate()+1);
                                         today = today.toISOString().split('T')[0];
                                        return '<input '+check+' type="radio" class="schedule"  name="radSend'+row.username+'[type]" value="schedule">\
                                        <div id="divSchedule'+row.username+'"  style ="display:'+display+';">\
                                          <label for="date" class=" form-control-label">Choose date</label>\
                                          <input id="date" '+disable+' required type="date" min="'+today+'" value="'+date+'"class="form-control" name="radSend'+row.username+'[date]">\
                                        </div>';
                                      }
                                    }],
                    onPostBody : function (data) {
                      // // console.log(data);
                      if(data.length>0)
                      {
                          numRows=$("#tblSendUser tbody").find("tr").length;
                          // alert($("#tblSendUser input.schedule:checked").length);
                          if($("#tblSendUser input.schedule:checked").length==numRows)
                          {
                            $("#tblSendUser").find(" input[name='radAllSend'][value='schedule']").prop("checked",true);
                              arrCheck=$("div[id^='divSchedule'] input").serializeArray();
                              arrCheck=arrCheck.map(x=>x.value);
                              // console.log(arrCheck);
                                // // console.log(arrCheck.length);
                              var unique = Array.from(new Set(arrCheck))

                              // console.log(unique);
                              if(unique.length==1 && arrCheck.length>1)
                              {
                                // // console.log("indefe");
                                $("#tblSendUser").find(" input[name='radAllSend'][value='schedule']").trigger("change");
                                $("#divAllSchedule").find("input[type='date']").val(data[0].dateSent);
                              }

                             // $("#tblSendUser").find(" input[name='radAllSend'][value='schedule']").prop("checked",true).trigger("change");
                             // $("#divAllSchedule").find("input")

                          }
                          else if($("input.now:checked").length==numRows)
                          {
                             $("#tblSendUser").find(" input[name='radAllSend'][value='now']").prop("checked",true);

                          }
                        }
                    }



            });
          });

          // function to generate body of modal to send survey
          $("#tblSendUser").on("change","[name^='radSend']",function (e) {
            // alert($(this).attr("name").indexOf("date")+" "+($(this).attr("name")));

            if($(this).attr("name").indexOf("date")>0)
            {
              return false;
            }
            numRows=$("#tblSendUser tbody").find("tr").length;
            //if all schedule radio button is checked check radio button beside Schedule label
            if($("input."+$(this).val()+":checked").length==numRows  )
            {
              // if there is more than one user trigger change event
              if(numRows>1)
              {
                $("#tblSendUser").find(" input[name='radAllSend'][value='"+$(this).val()+"']").prop("checked",true).trigger("change");
                return;
              }
              else{
                $("#tblSendUser").find(" input[name='radAllSend'][value='"+$(this).val()+"']").prop("checked",true);

              }

            }
            else{
              $("#tblSendUser").find(" input[name='radAllSend']").prop("checked",false);
              $("#divAllSchedule").css("display","none");
              $("#divAllSchedule").find('input').prop("disabled",true);
            }

            if($(this).val()=="schedule")
            {
              // if schedule is checked, show schedule date div
              $(this).closest("tr").find("div[id^='divSchedule']").css("display","block");
              $(this).closest("tr").find("div[id^='divSchedule']").find('input').prop("disabled",false);
            }
            else{
              // $(this).closest("tr").find("div[id^='divSchedule']").css("display","none");
              // $(this).closest("tr").find("div[id^='divSchedule']").find('input').prop("disabled",true);

              $("input[type='radio'].schedule").each(function () {

                 if($(this).prop("checked"))
                 {
                   $(this).closest("tr").find("div[id^='divSchedule']").css("display","block");
                   $(this).closest("tr").find("div[id^='divSchedule']").find('input').prop("disabled",false);
                 }
                 else{
                   $(this).closest("tr").find("div[id^='divSchedule']").css("display","none");
                   $(this).closest("tr").find("div[id^='divSchedule']").find('input').prop("disabled",true);
                 }
              })
            }

          });

          // function to view details of survey
          $("#tblSurvey").on('click','i[id^="btnView"]',function(){
            surveyId=$(this).closest('tr').find('td input[type="hidden"]').val();

            window.location="viewSurveyDetails.php?surveyId="+surveyId;


          });

          // Send/schedule the survey
          $("#frmSendSurvey").submit(function (e) {
            e.preventDefault();
            data=$(this).serialize();
            // // console.log(data);
            // return false;
              jQuery.ajax({
                url : "includes/Survey/sendSurvey.php",
                type : "post",
                dataType : "json",
                encode : true,
                cache : false,
                data :data
              }).done(function (data)
              {
                $("#tblSendUser").bootstrapTable('destroy');
                $("#mdlSendSurvey").modal("hide");

                $("#tblSurvey").bootstrapTable('refresh');

                if(data.success)
                {
                    $.NotifyFunc ('success','Success',data.result);
                }
                else{
                  $.NotifyFunc ('danger','Error',data.result);
                }

              }).fail(function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
              });

          });

          // clear modal
          $("#mdlSendSurvey").on("hide.bs.modal",function () {
              $("#tblSendUser").bootstrapTable('destroy');
              $(this).find("input[type='hidden']").remove();
              // $("frmSendSurvey :input")[0].reset();
              $("#divAllSchedule").css("display","none").find("input").prop("disabled",true).val("");

          });

          //move to viewSurveyDetails
          $("#btnAddUser").click(function (e) {
            window.location="viewSurveyDetails.php?surveyId="+$("#frmSendSurvey").find("input[name='surveyId']").val();
          });

          //send all/ schedule all radio button is checked
          $("#tblSendUser").on("change","input[name='radAllSend']",function (e) {
            $("#tblSendUser").find(" input."+$(this).val()).prop("checked","checked");

            $("div[id^='divSchedule']").css("display","none").find('input').prop("disabled",true);

            if($(this).val()=="schedule")
            {
              $("#divAllSchedule").css("display","block");
              // disabled=$("#divAllSchedule").find('input').prop("disabled");
              $("#divAllSchedule").find('input').prop("disabled",false);
            }else{
              $("#divAllSchedule").css("display","none");
              // disabled=$("#divAllSchedule").find('input').prop("disabled");
              $("#divAllSchedule").find('input').prop("disabled",true);
            }



            // numRows=$("#tblSendUser tbody").find("tr").length;

          });
        });//end of document.ready


      </script>

</body>

</html>
