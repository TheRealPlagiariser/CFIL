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
          <input id="date" disabled required type="date" class="form-control" name="radSend[date]">
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

<script type="text/javascript">

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





</script>
