


$.fnCheckList=function(username){
  var found = false;
  // console.log("param "+ username);
  for(var i = 0; i<arrSelectedUser.length; i++){
    if (arrSelectedUser[i]== username.toLowerCase().replace(/\s+/g, " ").trim()){
      // console.log("user" + i+ " " +arrSelectedUser[i]);
      found = true;
      break;
    }
  }
  return found;
}

$.fnRemove=function(username){
  for(var i = 0; i<arrSelectedUser.length; i++){
    if (arrSelectedUser[i]== username){
      // console.log("userdelete" + i+ " " +arrSelectedUser[i]);
      arrSelectedUser.splice(i, 1);
      break;
    }
  }
}

$.fnSearchUser=function(searchUser) {

    $.ajax({
            type: "POST",
            url: "includes/ActiveDirectory/getUser.php",
            data: {searchUser : searchUser},
            dataType: "json",
            cache: false,
            error: function(xhr){
              // alert("An error occured: " + xhr.status + " " + xhr.statusText);
              $("#txtSearchUser")[0].setCustomValidity("An error occured. Please Try again later");
              $("#txtSearchUser")[0].reportValidity();
            },
            beforeSend: function(){

                 $('#loading-image').show();
             },
             complete: function(){
                 $('#loading-image').hide();
             },
    }).done(function(data, status){
            if (status== "success")
            {
              if (data.success)
              {
                if (data.result.count >0)
                {
                  // <li id="header" style="display:none;"><span>Username</span><span style="margin-left:5px">Full Name</span></li>
                  $("ul#searchResults").empty();
                  $("ul#searchResults").append('<li id="header"  style="display:none;"><div class="row"><span class="col-xs-3">&nbspUsername</span><span class="col-xs-3" >Full Name</span></div></li>');
                  for(var i=0; i<data.result.count; i++){
                    var username = data.result[i].samaccountname[0];
                    if($.fnCheckList(username)){
                      continue;
                    }
                    var fullName = data.result[i].cn[0];
                    var email= "";
                    if(data.result[i].count ==3){
                        email = data.result[i].mail[0];
                    }else{
                        continue;
                    }

                    // '<li id="'+username+'"><span id="'+email+'">'+username+'</span><span style="margin-left:20px">'+fullName+'</span></li>'
                    $("ul#searchResults").append('<li id="'+username+'">\
                                                    <div class="row">\
                                                    <span class="col-xs-3" id="'+email+'">&nbsp'+username+'</span>\
                                                    <span class="col-xs-5">'+fullName+'</span>\
                                                    </div>\
                                                    <input type="hidden" value="'+fullName+'" >\
                                                  </li>');


                  } //endfor
                  $("ul#searchResults li#header").css("display", "block");
                }else{ // if count<0
                  $("ul#searchResults").append('<li id="header">No users found</li>');

                }
              }//end of data.success

            }else{
              $("ul#searchResults li#header").css("display", "none");
                $("ul#searchResults").empty();
            }
    });
};

$(".data").on("click", "li", function(){
  if($(this).attr("id") == "header"){
    return false;
  }else {


    var username = $(this).attr("id");
    var email = $(this).find("span").attr("id");
    var fullName = $(this).find("input").attr("value");
    $("ul#searchResults").empty();

    // if(!$.fnCheckList(username)){
      arrSelectedUser.push(username.toLowerCase().replace(/\s+/g, " ").trim());
      var inputs = '<input type="hidden" name="txtUsername[]" value="'+username+'"><input type="hidden" name="txtFullName[]" value="'+fullName+'"><input type="hidden" name="txtEmail[]" value="'+email+'">';
      var selectedUser='<div class="selected-user row"><span  class="col-xs-3">'+username+'</span><span class="col-xs-5" >'+fullName+'</span><span><i id="'+username+'" style="color:#A70027" class="fa fa-times btnRemove" title="Remove User"></i></span>'+inputs+'</div>';
      $(".selected-users-list").append(selectedUser);
      $("#txtSearchUser").val("");
    // }else{
    //   alert("User already selected");
    // }

  }

});
$("#txtSearchUser").on("keyup keypress", function(event){
   // console.log(e.which);
   $("#txtSearchUser")[0].setCustomValidity("");
   var keycode = (event.keyCode ? event.keyCode : event.which);
   if (keycode == 13){

      event.preventDefault();
     $( "#searchIcon" ).trigger( "click" );
     return false;
   }
});

$(".selected-users-list").on("click", ".btnRemove", function(){
  $(this).closest("div").remove();
  var username = $(this).attr("id");
  // console.log(username);
  $.fnRemove(username);
});
$("#searchIcon").on("click", function(){
  // alert("Enter");

  var searchUser = $("#txtSearchUser").val().toLowerCase().replace(/\s+/g, " ").trim();
  $("ul#searchResults").empty();

  if ($("ul#searchResults li#header").css("display") == "block") {
      // $("ul#searchResults").empty();
      if(!$.fnCheckList(searchUser))
      {
       $.fnSearchUser(searchUser);
      }
      else{
          $("#txtSearchUser")[0].setCustomValidity("User already selected");
          $("#txtSearchUser")[0].reportValidity();
      }

  }
  else{
    // $("ul#searchResults").empty();
    var searchUser = $("#txtSearchUser").val();
    if(!$.fnCheckList(searchUser))
    {
     $.fnSearchUser(searchUser);
    }
    else{
      $("#txtSearchUser")[0].setCustomValidity("User already selected");
      $("#txtSearchUser")[0].reportValidity();
    }
  }




});
