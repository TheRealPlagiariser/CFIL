// Initialising mandays touchspin
$("input[name='txtEstimatedManDays']").TouchSpin({
  verticalbuttons: true,
  min: 0.25,
  max: 500,
  step: 0.25,
  decimals: 2,
  boostat: 5,
  maxboostedstep: 10,
});

// Initialising datetimepickerr
$('#datetimepickerEnd').datetimepicker({
    showClear:true,
    keyBinds: true,
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

// Validation (Checking if PainPoint already exists ; triggered when creating new action)
$('#txtPainPoint').keyup(function(){
    $("#txtPainPoint")[0].setCustomValidity("");
    $("#txtPainPoint").removeAttr("title");
    $("#txtPainPoint").css("color", "black");

  $.each(arrActionItem,function (index,value) {
    console.log(arrActionItem[index]);
    if(arrActionItem[index].toLowerCase()==$('#txtPainPoint').val().toLowerCase().replace(/\s+/g, " ").trim())
    {
      $("#txtPainPoint").css("color", "red");
      $("#txtPainPoint").attr("title", "PainPoint Already Exist");

      $("#txtPainPoint")[0].setCustomValidity("PainPoint Already Exist");
      $("#txtPainPoint")[0].reportValidity();
      return false;
    }

  });
});

// Disable Enter Key, prevent form from submitting on keypress enter
$('#frmCreateActionItem').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {

    e.preventDefault();
    e.stopPropagation();
    return false;
  }
});

// Re enable enter so drop down actually drop
$('#drpStatus').on('focus', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    $('#drpStatus').trigger("click");
  }
});

// text area manip
$('textarea').on('keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  var value= $(this).val();
  var current='';
  current= e.target.selectionStart;
  console.log("prev ",current);

  if (keyCode === 13) {
    // $(this).val($(this).val() +"\n");
    // $(this).val(e.target.selectionStart)
    $(this).val(value.substring(0, e.target.selectionStart) + "\n" + value.substring(e.target.selectionStart) );
    // setCaretPosition($(this),current);
    setCaretToPos(document.getElementById($(this)), 4);
    return false;
  }
});
function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}
function setCaretToPos (input, pos) {
  setSelectionRange(input, pos, pos);
}

$('#mdlAddActionItem').on('shown.bs.modal ', function(event) {
  $("#txtPainPoint").focus();
});
// Verify Owner


function validateUser(searchvalue){
  bool=false;
  checkFirst=true;
  $.ajax({
          type: "POST",
          url: "includes/validateUser.php",
          data: {searchUser : searchvalue},
          dataType: "json",
          cache: false,
          error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
          },
          beforeSend: function(){
               $('#loading-image').show();
           },
           complete: function(){
               $('#btnValidateUser #loading-image').hide();
           },
  }).done(function(data, status){
    if (status== "success")
    {
      if (data.success)
      {
        $("#txtOwner")[0].setCustomValidity("");
        if (data.result.count >0)
        {
          var email="";
          var username = data.result[0].samaccountname[0];
          var fullName = data.result[0].cn[0];
          if(data.result[0].count ==3){
            email = data.result[0].mail[0];
          }else{
              alert ("We could not find the email for this user! Please report this to admin.");
          }
          $("#frmCreateActionItem").find("input[name='email']").remove();
          $("#frmCreateActionItem").append('<input type="hidden" name="email" value="'+email+'" />');
          $("#txtOwner").val(fullName);
          $("#btnValidateUser").html('<i title="Authorised user" class="fas fa-user-check" style="color:green;"><div id="loading-image" style="display: none;" class="loader"><img src="images/ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div></i>');
          bool=true;
        }
        else
        {
          $("#txtOwner")[0].setCustomValidity("This user cannot be the owner of a Pain Point");
          $("#txtOwner")[0].reportValidity();
          $("#btnValidateUser").html('<i title="Unauthorised user" class="fas fa-user-times" style="color:red;"><div id="loading-image" style="display: none;" class="loader"><img src="images/ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div></i>');
        }
      }
      else
      {
        $("#txtOwner")[0].setCustomValidity("An error occured");
        $("#txtOwner")[0].reportValidity();

      }
    }
    else
    {
      alert("Ajax failed, Please report this errror to admin.");
    }
  });
}
$("#txtOwner").on("change", function(){
  $("#txtOwner")[0].setCustomValidity("");
  if($("#txtOwner").val().toLowerCase().replace(/\s+/g, " ").trim() != ""){
    var searchvalue = $("#txtOwner").val();
    // // console.log(searchvalue);
    validateUser(searchvalue);
  }

});
$("#txtOwner").on("keyup", function(e){
  $("#txtOwner")[0].setCustomValidity("");
  var keyCode = e.keyCode || e.which;
  if (keyCode === 8 || keyCode === 46) {
    $(this).val("");
    $("#btnValidateUser").html('<i title="Check Username" class="fas fa-user-plus"><div id="loading-image" style="display: none;" class="loader"><img src="images/ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div></i>');
  }
  $("#txtOwner")[0].setCustomValidity("");
});
