<?php
  session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
  include 'includes/db_connect.php';

  $selectQuestionType= "SELECT * FROM question_type";
  $selectQuestionType= $conn->query($selectQuestionType);
  $selectBound= "SELECT  question_type_lowerBound,question_type_upperBound,defaultLeftLabel,defaultRightLabel FROM config";
  $selectBound= $conn->query($selectBound);
  $selectBound=$selectBound->fetchAll(PDO::FETCH_ASSOC);
  // echo "<pre>";
  // print_r($selectBound);
  // echo "</pre>";
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Question";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <style>
    .custom-datatable-overright table tbody tr td.datatable-ct{
          color: red;
    }

    input[disabled]{
      background-color: #FFFFFF !important;
      cursor: not-allowed !important;
    }
    textarea { resize:vertical; min-height: 100px;}
    .removeChoice:hover,.addChoice:hover{
        cursor: pointer !important;
    }
    .name {
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 250px;
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
            $active="question";
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
                                        <h1>Questions Available</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">

                                        <table  id="tblQuestion">

                                        </table>

                                        <!-- Add Buttton -->
                                        <div class="text-right mg-t-10">
                                          	<button id="btnAddQuestion" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdlAddQuestion">Add New Question</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Data table area End-->

            <!-- Modal Add Question -->
            <div id="mdlAddQuestion" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="btnDismissModal" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Question</h4>
                  </div>
                  <div class="modal-body">
                    <form id="frmAddQuestion">
                      <div class="container-fluid">
                        <div class="form-group text-left col-xs-8" style="padding-left:0;">
                          <label id="lblQuestion" for="txaQuestion" class="form-control-label">Enter Question below:</label>
                          <textarea id="txaQuestion" rows='3' class="form-control" name="txaQuestion" required ></textarea>
                        </div>

                        <div class="form-group text-left col-xs-4" style="padding-right:0;">
                          <label for="drpAnswerType">Answer Type</label>
                          <select id="drpAnswerType" class="form-control " name="drpAnswerType">
                            <?php
                              while($row=$selectQuestionType->fetch())
                              {
                                  echo'<option value='.$row["questionTypeId"].'>'.$row["questionType"].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <hr class="preview" style="display:none;"/>
                      <div id="previewScale" class="form-group previewScale container-fluid" style="display:none;">

                          <div class="form-group form-select-list col-xs-6 mg-b-20"  style="padding-left:0;">
                            <!-- dropdown for lower bound  -->
                              <label id="lblLowerBound" for="drpScaleLowerBound" class="form-control-label">Lower Bound:</label>
                              <select id="drpScaleLowerBound" class="form-control custom-select-value " name="possibleAnswer[]" style="width:100px;" disabled>

                                <?php
                                    $lower=explode(",",$selectBound[0]['question_type_lowerBound']);
                                    sort($lower);
                                    foreach ($lower as $key => $value) {
                                      if($value == 1){
                                        echo "<option value='". $value."' selected>".$value."</option>";
                                      }else{
                                        echo "<option value='". $value."'>".$value."</option>";
                                      }

                                    }



                                 ?>
                              </select>

                          </div>
                          <div class="form-group form-select-list col-xs-6 mg-b-20" style="padding-left:0;">
                                <!-- dropdown for upper bound  -->
                              <label id="lblUpperBound" for="drpScaleUpperBound" class="form-control-label">Upper Bound:</label>
                              <select id="drpScaleUpperBound" class="form-control custom-select-value "  name="possibleAnswer[]" style="width:100px;" disabled>
                                <?php
                                    $upper=explode(",",$selectBound[0]['question_type_upperBound']);
                                    sort($upper);
                                    foreach ($upper as $key => $value) {
                                      echo "<option value='". $value."'>".$value."</option>";
                                    }
                                 ?>
                              </select>
                          </div>
                          <div class="form-group form-inline">
                            <div class="col-xs-4 grpLabel" style="padding-left:0;">
                                  <!-- input for left  label  -->
                              <div id="grplabel1" class="">
                                <label id="lblLeftLabel" for="" class="form-control-label">Left Label:</label>
                                <input id="txtLeftLabel" type="text" name="txtLeftLabel" class="form-control" required placeholder="Left Label" value="<?php echo $selectBound[0]['defaultLeftLabel']?>"style="width:100%;" disabled>

                              </div>

                              <div id="grplabel2"  class="">
                                      <!-- input for right  label  -->
                                  <label id="lblRightLabel" for="" class="form-control-label">Right Label:</label>
                                  <input id="txtRightLabel" type="text" name="txtRightLabel" class="form-control"required placeholder="Right Label "  value="<?php echo $selectBound[0]['defaultRightLabel']?>"style="width:100%;" disabled>

                              </div>

                            </div>

                          </div>

                        </div>
                      <div id="previewChoice" class="previewChoice container-fluid" style="display:none;">
                        <div class="text-left">
                          <label class="form-control-label">Enter Choices</label>
                        </div>
                        <div id="grpChoice" class="choiceGroup">
                          <div >
                            <span id="btnRemoveChoice1" type="button" class="glyphicon glyphicon-minus-sign removeChoice" aria-hidden="true" aria-label="Left Align">

                            </span>
                            <label><input id="txtChoice1" type="text" name="possibleAnswer[]" disabled ></label>
                          </div>
                          <div >
                            <span id="btnRemoveChoice2" type="button" class="glyphicon glyphicon-minus-sign removeChoice" aria-hidden="true"  aria-label="Left Align">

                            </span>
                            <label><input id="txtChoice2" type="text" name="possibleAnswer[]" disabled > </label>
                          </div>
                        </div>
                        <span id="btnAddNewChoice" type="button" class="glyphicon glyphicon-plus-sign addChoice" aria-hidden="true"  aria-label="Left Align">

                        </span>
                      </div>

                    </form>
                  </div> <!--modal body-->
                  <div class="modal-footer">
                    <input id="btnSubmitQuestion" type="submit" value="Done" form="frmAddQuestion" class="btn btn-default" >
                  </div>
                </div>

              </div>
            </div>
            <!-- End modal -->

            <!-- Modal View Question -->
            <div id="viewDetailsOfQuestion" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View Question Details</h4>
                  </div>
                  <div class="modal-body">

                  </div>
                </div>
              </div>
            </div>
            <!-- End Modal-->
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
    <!-- main JS
		============================================ -->
    <!-- <script src="js/main.js"></script> -->

    <script src="js\bootbox.all.min.js"></script>

    <script src="..\js\bootstrap-notify.js"></script>
    <script>
        $(document).ready(function(){
            var questionEdited="";
            var question=[];

            var table=$('#tblQuestion');
            //load the table
            table.bootstrapTable(
              {

                url           : 'includes/Question/getQuestion.php',
                method        : "post",
                pagination    : true,
                search        : true,
                showRefresh   : true,
                showColumns   : false,
                striped       : true,
                resizable : true,
                onLoadSuccess: function (result) {
                  question= result.map(x=>x.question);
                },
                columns       : [

                                  {
                                    field: 'question',
                                    title: 'Question',
                                    class : "name",

                                    sortable: true,
                                    formatter : function(value, row,  index) {
                                             return '<input type="hidden"  id="chkQuestionId'+row.questionId+'" name="chkQuestiontId'+row.questionId+'" value="'+row.questionId+'">' + value;
                                          }
                                  },
                                  {
                                    field: 'questionType',
                                    title: 'Type',
                                    sortable: true,
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
                                    searchable: false,
                                    align : "center",
                                    halign : "left",
                                    formatter : function(value, row, index) {

                                      display="";
                                      // if question not in use
                                      if(row.count==row.sum)
                                      {
                                        display+='<i  id="btnEdit'+index+'" data-toggle="tooltip" data-placement="bottom" title="Edit this question" class="far fa-edit" aria-hidden="true" style="margin-left:10%"></i>'
                                        display+='<i data-toggle="tooltip" data-placement="bottom" title="Delete this question"  id="btnRemove'+index+'" style="color:red;margin-left:10%" class=" fa fa-trash"></i>';
                                      }
                                              return '<i id="btnView'+index+'" data-toggle="tooltip" data-placement="bottom" title="View more detail about this question" class="fa fa-eye"></i>'+display   ;
                                          }

                                }]

            });

            //refresh the form
            $.refreshModalAddQuestion = function(){

              $("form#frmAddQuestion")[0].reset();

              $('.preview').css('display','none');

              $('#previewChoice').css('display','none');
              $('#previewScale').css('display','none');

              $('#previewChoice #grpChoice').find("input[type='text']").attr("disabled", "disabled");

              $('#previewScale .col-xs-4').find("input[type='text']").attr("disabled", "disabled");
              $('#previewScale .col-xs-6').find("select").attr("disabled", "disabled");

              $("#mdlAddQuestion div.modal-header h4.modal-title").text("Add New Question");
              $("#btnSubmitQuestion").val("Done").attr("disabled",false);

              $("#frmAddQuestion .changed").attr("disabled",false);
              $("#frmAddQuestion :input").removeClass("changed");


              $('#grpChoice').find("input[type='text']").attr("value", "");
              //remove extra choices
              if($('#grpChoice').children().length!=2){
                while($('#grpChoice').children().length>2){
                  $('#grpChoice').find('div')[0].remove();
                }
              }

              //remove error message
              $('#txaQuestion').closest('div').find('span').remove();
            }

            // when editing the question to set the answer
            $.fnSetAnswers = function(answerTypeId, possibleAnswer, leftLabel, rightLabel){
              if(answerTypeId==2){
                bounds= possibleAnswer.split('|');

                bounds.sort(function(a, b) {
                    return a - b;
                  });
                $("#drpScaleLowerBound").val(bounds[0]);
                $("#drpScaleUpperBound").val(bounds[bounds.length-1]);
                $("#txtLeftLabel").val(leftLabel);
                $("#txtRightLabel").val(rightLabel);
              }
              if(answerTypeId==3){
                $('#grpChoice').children().remove();
                choices= possibleAnswer.split('|');
                var i;

                for(i=0; i<choices.length; i++){
                  var radioBtn = $('<div >\
                                    <span class="glyphicon glyphicon-minus-sign removeChoice" aria-hidden="true"   type="button" aria-label="Left Align">\
                                    </span>\
                                    <label>\
                                      <input id="txtChoice'+i+'" type="text" value="'+choices[i]+'" name="possibleAnswer[]">\
                                    </label></div>');
                  radioBtn.appendTo('#grpChoice');
                }
                choiceCount=i;
              }
            }

            $.fnCheckAnswerType = function(answerTypeId){
              if (answerTypeId != 1){//not freetext
                $('.preview').css('display','block');
                if(answerTypeId==2){ //scale
                  $('#previewScale').css('display','block');
                  $('#previewChoice').css('display','none');
                  $('#previewChoice #grpChoice').find("input[type='text']").attr("disabled", "disabled");
                  $('#previewScale .grpLabel').find("input[type='text']").removeAttr("disabled");
                  $('#previewScale .col-xs-6').find("select").removeAttr("disabled");
                }
                else if(answerTypeId==3){//choice
                  $('#previewChoice').css('display','block');
                  $('#grpChoice').find("input[type='text']").removeAttr("disabled");
                  $('#previewScale').css('display','none');
                  $("#previewScale :input").attr("disabled", true);
                }

              }
              else
              {
                $('.preview').css('display','none');
                $('#previewChoice').css('display','none');
                $('#previewScale').css('display','none');
                $('#previewChoice #grpChoice').find("input[type='text']").attr("disabled", "disabled");
                $('#previewScale .col-xs-4').find("input[type='text']").attr("disabled", "disabled");
                $('#previewScale .col-xs-6').find("select").attr("disabled", "disabled");
                $("#drpAnswerType").val(1);
              }

            }

            // Script to keep track which question type is selected
            $('#drpAnswerType').on('change',function(){
                var answerTypeId = $(this).val();
                // // console.log(answerTypeId);
                $.fnCheckAnswerType(answerTypeId);
            });

            var $count = $('.counter'); //counting the nuber of answers of a MCQ question
            var choiceCount=3; //choiceCount variable is there just to ensure each input has a different id.

            // Script to add new choice
            $('#mdlAddQuestion #previewChoice').on('click','span#btnAddNewChoice', function() {
              // // // console.log(choiceCount);
              $count.val( parseInt($count.val()) + 1 );
              var radioBtn = $('<div >\
                                  <span class="glyphicon glyphicon-minus-sign removeChoice" aria-hidden="true" style="margin-right:0.8%"  id="" type="button" aria-label="Left Align">\
                                  </span><label><input id="txtChoice'+choiceCount+'" type="text" name="possibleAnswer[]"></label>\
                                </div>');
              radioBtn.appendTo('#grpChoice');
              choiceCount++;
            });

            // Script to disable choice group radio button
            $('#previewChoice').on("click", ".disabled", function(event) {
                event.preventDefault();
                return false;
            });

            // Script to remove choice
            $("#previewChoice").on('click','.removeChoice',function(e){
              e.preventDefault();
              e.stopPropagation();
              // // // console.log(($('#preview').children().length));
              if($('#grpChoice').children().length!=2)
              {

                val=$(this).closest("div").find("input").val();
                $(this).closest('div').remove();
                $count.val( parseInt($count.val()) - 1 );
                if($("#btnSubmitQuestion").val()=="Update")
                {
                  //trigger change event on removing a choice
                  $("#frmAddQuestion").find("[name='possibleAnswer[]']").trigger("change");
                }
              }
              else
              {
                // $("input[id^='txtChoice']").last()[0].setCustomValidity('A minimum of 2 option is needed');
                // $("input[id^='txtChoice']").last()[0].reportValidity();
                $(this).closest("div").find('input')[0].setCustomValidity('A minimum of 2 option is needed');
                $(this).closest("div").find('input')[0].reportValidity();
                // alert("A question of type \"Choice\" must have minimum 2 options.");
              }
            });

            //submit the form
            $("div.modal-body").on('submit','form#frmAddQuestion',function(e){
              e.preventDefault();

              var empty = true;
              if ($("#previewChoice").css("display") !="none"){
                var choiceId="";
                  $('#previewChoice input[type="text"]').each(function(){
                     if($(this).val()==""){
                        choiceId=$(this).attr('id');
                        empty =false;
                        return false;
                      }
                   });


                 if (empty == false){
                   if($("#grpChoice").children().length==2)
                   {
                     $("#"+choiceId)[0].setCustomValidity('Please fill out this field.\nA minimum of 2 option is needed');
                     $("#"+choiceId)[0].reportValidity();
                          // alert("A question of type \"Choice\" must have minimum 2 options.");
                   }
                   else{
                        // alert("Please, remove blank text box(es).");
                        $("#"+choiceId)[0].setCustomValidity('Please, remove blank text box(es).');
                        $("#"+choiceId)[0].reportValidity();
                   }

                   return false;
                 } // check for blank text boxes
                 else{
                   // Validate choices -> choices must be uniques
                    const $input = $('#previewChoice input[type="text"]');
                    const uniques = new Set($input.map((i, el) => el.value.toLowerCase().replace(/\s+/g, " ").trim()).get());

                    var arr=$input.map((i, el) => el.value.toLowerCase().replace(/\s+/g, " ").trim()).get();
                    var diff =  arr.filter(function(itm, i){
                                  return arr.lastIndexOf(itm)== i && arr.indexOf(itm)!= i;
                              });
                    //
                    // console.log(arr);
                    // // console.log(values);
                    // console.log(diff);
                    if (uniques.size < $input.length) {
                      id='';
                      $("input[id^='txtChoice']").each(function(){
                        // console.log("boo");
                        // console.log($(this).attr("id"));
                        // console.log($(this).val());
                        if($(this).val().toLowerCase().replace(/\s+/g, " ")==diff[0])
                        {
                          id=$(this).attr("id");
                          // console.log(id);
                        }
                      });
                      $("#"+id)[0].setCustomValidity("Choices must be unique.This choice has already been added");
                      $("#"+id)[0].reportValidity();
                          return false;
                    }

                }  // verifies if choice are unique
              }// check if choice has been selected

              //validation for scale
              if ($("#previewScale").css("display") !="none"){
                var leftLabel=$("#txtLeftLabel").val().toLowerCase().replace(/\s+/g, " ").trim();
                var rightLabel=$("#txtRightLabel").val().toLowerCase().replace(/\s+/g, " ").trim();

                if(leftLabel!="" && rightLabel!="")
                {
                  // // console.log(leftLabel +" 0" + rightLabel);
                  // // console.log(leftLabel==rightLabel);
                  if(leftLabel===rightLabel)
                  {
                    // // console.log(leftLabel===rightLabel);
                    $("#txtRightLabel")[0].setCustomValidity("Left and Right label cannot be same");
                    $("#txtRightLabel")[0].reportValidity();
                    return false;
                  }
                  else
                  {
                    $("#txtRightLabel")[0].setCustomValidity("");
                  }
                }

              }// check if scale has been selected


              postman=   $('#frmAddQuestion').serialize();
              url="includes/Question/addQuestion.php";
              var action=$("#btnSubmitQuestion").val();
              if(action=="Update")
              {
                postman =$('#frmAddQuestion').find(".changed").serialize()+"&drpAnswerType="+$("#drpAnswerType").val();
                url="includes/Question/updateQuestion.php";
              }

              // // console.log(postman);
              $.ajax({
                type: "POST",
                url: url,
                data: postman,
                dataType :'json',
                cache: false,
                error: function(xhr){
                  alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
              }).done(function(data, status){
                if (status== "success"){
                  if(data.success)
                  {
                    $("#tblQuestion").bootstrapTable('refresh');
                    $('#mdlAddQuestion').modal('hide');
                    $.refreshModalAddQuestion();
                    $.NotifyFunc ('success','Success',data.result);
                  }
                  else{
                    $.NotifyFunc ('danger','Error',data.result);

                  }


                }
              });


            });

            // Script to delete a question
            $("#tblQuestion").on('click','i[id^="btnRemove"]',function(){
                // // console.log(this.closest('tr'));
                questionId=$(this).closest('tr').find('td input[type="hidden"]').val();
                // // console.log(questionId);
                bootbox.confirm({
                  title : "Delete question",
                  message : "Are you sure you want to delete this question?",
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
                          url: "includes/Question/deleteQuestion.php",
                          data: {questionId:questionId},
                          dataType : "json",
                          cache: false,
                          error: function(xhr){
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                          }
                        }).done(function(data, status){
                          if (status== "success"){

                            if(data.success)
                            {
                                $("#tblQuestion").bootstrapTable('refresh');
                              $.NotifyFunc ('success','Success',data.result);

                            }
                            else{
                              $.NotifyFunc ('danger','Error',data.result);
                            }


                          }
                        });
                      }
                    }

                })

              });

            //check if question already exist in database
            $('#txaQuestion').keyup(function(){
               $('#txaQuestion').closest('div').find('span').remove();
               if(location.search.length>0)
               {
                 if($('#txaQuestion').val().replace(/\s+/g, " ").trim()==questionEdited.replace(/\s+/g, " ").trim())
                 {
                   $("#txaQuestion")[0].setCustomValidity('');
                    $("#txaQuestion").removeClass("changed");
                    $("#btnSubmitQuestion").attr("disabled",true);
                    return false;
                 }
               }

               disable=false;
               $.each(question,function (index,value) {
                 if(value.toLowerCase()==$('#txaQuestion').val().toLowerCase().replace(/\s+/g, " ").trim() && value.toLowerCase()!=questionEdited.toLowerCase().replace(/\s+/g, " ").trim())
                 {

                     disable=true;
                     // $('#txaQuestion').after("<span  style='color:red'>This question already exists</span>");
                     return false;
                 }
               });
               if(disable)
               {
                  $("#txaQuestion")[0].setCustomValidity("This question already exists");
                  $("#txaQuestion")[0].reportValidity();

                 // $("#btnSubmitQuestion").attr("disabled",true);
                 return false;
               }
               else{
                 $("#txaQuestion")[0].setCustomValidity("");
                 // $("#btnSubmitQuestion").attr("disabled",false);
               }



             });

             //view question script

             //view question
            $("#tblQuestion").on('click','i[id^="btnView"]',function(){
               questionId=$(this).closest('tr').find('td input[type="hidden"]').val();

               $.ajax({
                 url : "includes/Question/displayQuestion.php",
                 data : {echo : true,questionId:questionId},
                 type : "post"
               }).done(function (result) {
                 $("#viewDetailsOfQuestion").find('.modal-body').html(result);
                    $("#viewDetailsOfQuestion").modal('show');
               });

             });

            //edit a Question
            $("#tblQuestion").on('click','i[id^="btnEdit"]',function(){
             questionId=$(this).closest('tr').find('td input[type="hidden"]').val();
             $('#txaQuestion').closest('div').find('span').remove();
             choiceCount=0;
             $("#drpAnswerType").attr("disabled", true);
             $.ajax({
               type: "POST",
               url: "includes/Question/getQuestion.php",
               dataType : "json",
               data : {echo : true,questionId:questionId,show:"edit"},
               cache: false,
               error: function(xhr){
                 alert("An error occured: " + xhr.status + " " + xhr.statusText);
               }
             })
             .done(function(result, status){
               if (status== "success"){
                 $("#mdlAddQuestion div.modal-header h4.modal-title").text("Update Question");
                 $("#btnSubmitQuestion").attr("disabled", true);
                 $("#frmAddQuestion").append("<input name='questionId' class='changed' type='hidden' value='"+result[0].questionId+"'>");
                 $("form#frmAddQuestion")[0].reset();
                 questionEdited=result[0].question;
                 //add the question
                 $("#txaQuestion").val(result[0].question.replace(/<br ?\/?>/g, "\n"));
                 //add the type
                 $('#drpAnswerType').val(result[0].questionTypeId);

                 $.fnCheckAnswerType(result[0].questionTypeId);

                 if(result[0].questionTypeId != 1){
                   $.fnSetAnswers(result[0].questionTypeId, result[0].possibleAnswer,result[0].leftLabel,result[0].rightLabel);
                 }

                 $("#btnSubmitQuestion").val("Update");
                 $("#mdlAddQuestion").modal("show");

                 $("#drpAnswerType").addClass("changed").attr("disabled", true);

               }
             });

            });

            //when the modal hides
            $('#mdlAddQuestion').on('hidden.bs.modal ', function(event) {
              questionEdited='';
              $.refreshModalAddQuestion();
              if($("#btnSubmitQuestion").val()=="Update"){
                $.fnCheckAnswerType(1);
                $("#frmAddQuestion #drpAnswerType").attr("disabled",false);
                $("#frmAddQuestion ").find("input[type='hidden']").remove();
              }
             });


            $("#frmAddQuestion ").on("keyup change ", ":input", function () {
                 $(this).addClass('changed');
                 if($(this).attr('id')!="txaQuestion")
                 {
                   // // console.log($(this).attr('id'));
                   if($(this).attr('id')=='txtLeftLabel')
                   {
                     $("#txtRightLabel")[0].setCustomValidity('');
                   }
                   $(this)[0].setCustomValidity('');
                 }

                 if($(this).attr("name")==='possibleAnswer[]'){
                   $("[name='possibleAnswer[]']").each(function(){
                      $(this)[0].setCustomValidity('');
                   });
                   $("#frmAddQuestion").find("[name='possibleAnswer[]']").addClass("changed");
                 }

                 if($("#btnSubmitQuestion").val()=="Update" ){
                      $("#btnSubmitQuestion").attr("disabled", false);
                 }
            });




          });
    </script>
</body>
</html>
