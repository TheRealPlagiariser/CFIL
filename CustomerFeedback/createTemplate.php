<!doctype html>
<?php
  session_start();
  if(!isset($_SESSION['Username']))
  {
    header('Location:../index.php');
  }
  include 'includes/db_connect.php';

  if(isset($_GET['templateId']))
  {
     include 'includes/displayUserSurvey.php';
  }
  $selectNupage="SELECT numPageAllowed FROM config";
  $selectNupage=$conn->query($selectNupage);
  $selectNupage=$selectNupage->fetch();

$cycleValues=array();
?>
<script type="text/javascript">
  var numPageAllowed=<?php echo $selectNupage['numPageAllowed']; ?>;
</script>
<html class="no-js" lang="en">

<head>
    <?php
        $title="Template";
        include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css/modals.css">

    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>

    <link rel="stylesheet" href="css/steps/jquery.steps.css">
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <link rel="stylesheet" href="css/jquery.dropdown.css">
    <style type="text/css">
    span.multiselect {
        padding: 2px 6px;
        font-weight: bold;
        cursor: pointer;
    }
    ul.multiselect-container.dropdown-menu{
      position: relative;
      top :0%;
      z-index :0;
      box-shadow: none !important;
      height:250px;
      overflow-y:scroll;


    }
    .btn.btn-link{
      color:#000000;
      font-size:15px;
      text-decoration:none;
      cursor : default;
    }
    hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #ccc;
        margin: 1em 0;
        padding: 0;
    }
    #divPoolQuestion > span > div > ul > li.disabled.not-allowed > a > label{
      cursor: not-allowed ;
    }
    .wizard > .steps li a:before {
          content: "";
          width: 85px;
          height: 2px;
          background: #e9e0cf;
          position: absolute;
          right: 100%;
      }
    .wizard > .steps li a {
        display: inline-block;
        width: inherit;
        height: 12px;
        border-radius: 5%;
        background: #A70027;
        /* margin-right: 78px; */
        position: relative;
      }
      .steps {
        pointer-events: none;
      }

      .select2-hidden-accessible {
          top: 30px;
          left : 25%;
      }

      i:hover{
        cursor: pointer;
      }

      button[disabled], html input[disabled] {
          cursor: not-allowed;
          box-shadow: none;
          opacity: .65;
      }


</style>

</head>


<body class="materialdesign">
    <div class="wrapper-pro">
        <?php $activeApp="cf" ?>
      <?php include "../includes/sidebar.php"; ?>

      <div class="content-inner-all">
            <?php
                $active='template';
                include 'includes/menu.php';
             ?>
             <!-- breadcome -->
        <div class="container-fluid">
          <div class="breadcome-area mg-b-30 ">
             <div class="container-fluid">
               <div class="row">

                   <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top:0px">
                     <div class="row">
                       <div style="padding-left:10px">
                           <ul class="breadcome-menu pull-left">
                             <li><a href="template.php">Template</a> <span class="bread-slash">/</span>
                             </li>
                             <li><span class="bread-blod">Create Template</span>
                             </li>
                           </ul>
                         </div>
                     </div>
                   </div>

               </div>
             </div>
          </div>
        </div>
          <div class="container ">
            <div class="row">
              <div class="row">
                <div class="col-sm-12  col-lg-12 col-xs-12" style=" float:none; margin:0 auto;">
                   <div class="mg-b-40" id='divTemplateDetails'>
                     <div class="container-fluid ">
                       <div class="row ">
                         <div class="sparkline10-hd">
                             <div class="main-sparkline10-hd">
                                 <h1>Template Details</h1>

                             </div>
                         </div>
                         <div class="sparkline10-graph">
                             <div class="basic-login-form-ad ">
                                 <div class="row">
                                     <div class="col-lg-12 ">
                                         <div class="dual-list-box-inner">
                                             <!-- <form id="frmCreateTemplate" action="<?php //echo $_SERVER['PHP_SELF'] ?>" class="form-horizontal"> -->
                                             <form id="frmCreateTemplate" method="post" action="<?php
                                                                                              if(isset($_GET['templateId']))
                                                                                              {
                                                                                                echo 'includes/Template/updateTemplate.php';
                                                                                              }
                                                                                              else {
                                                                                                echo 'includes/Template/addTemplate.php';
                                                                                              }
                                                                                              ?>" class="form-horizontal">
                                                <?php
                                                    if(isset($_GET['templateId'])){
                                                ?>
                                                  <input type="hidden" name="templateId" class="changed" value="<?php echo $_GET['templateId']  ?>">
                                                <?php
                                                      }
                                                ?>

                                               <div class="form-group">
                                                  <label for="txtTemplateName" class="col-sm-2 control-label">Template Name</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" required class="form-control" value="<?php if(isset($_GET['templateId'])){echo current($SelectTemplate)[0]['templateName'];}?>" name='txtTemplateName' id="txtTemplateName" placeholder="">
                                                  </div>
                                                </div>
                                               <div class="form-group">
                                                 <label for="radCycle" class="col-sm-2 control-label">Template Cycle</label>
                                                 <div class="col-sm-10" id="radCycle">
                                                   <?php
                                                      // echo  current($SelectTemplate)[0]['cycleId'];
                                                       $select="SELECT * FROM cycle";
                                                       $result=$conn->query($select);
                                                       while($row=$result->fetch())
                                                       {
                                                         if($row['display']==1)
                                                         {

                                                   ?>
                                                       <div class="radio">
                                                         <label>
                                                           <input type="radio" required name="radCycle" id="rad<?php echo $row['cycleName'] ?>" value="<?php echo $row['cycleId'] ?>"
                                                            <?php
                                                                if(isset($_GET['templateId'])){
                                                                  if($row['cycleId']== current($SelectTemplate)[0]['cycleId'])
                                                                  {
                                                                    echo "checked";
                                                                  }
                                                                }
                                                             ?>

                                                           ><!--End of input-->
                                                              <?php echo $row['cycleName'] ?>

                                                           </label>
                                                       </div>
                                                   <?php
                                                       }
                                                       else{
                                                         $value["cycleId"]=$row['cycleId'];
                                                         $value["cycleName"]=$row['cycleName'];
                                                         $cycleValues[]=$value ;
                                                       }
                                                    }

                                                  ?>
                                                    <div class="radio">
                                                      <label class="col-sm-1" style="margin-right:1%">
                                                        <input type="radio" disabled required  id="radOthers"  >
                                                           Others
                                                      </label>
                                                        <select class="col-sm-7" id="drpCycle"  name="drpCycle">
                                                          <option></option>
                                                          <?php
                                                            foreach ($cycleValues as $key => $value) {
                                                              $check="";
                                                              if($value['cycleId']== current($SelectTemplate)[0]['cycleId'])
                                                              {
                                                                $check= "selected";
                                                              }
                                                                echo ' <option '.$check.' value="'.$value["cycleId"].'"> '.$value["cycleName"].'</option>';
                                                            }
                                                           ?>
                                                        </select>
                                                    </div>
                                                 </div><!--End of id="radCycle "-->
                                               </div> <!--End of Form group-->
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                       </div>
                     </div>
                   </div>

                </div>
              </div>

              <div class="row">
                <div class="col-sm-8  col-lg-8 col-xs-8">
                  <div class="container-fluid"  id='divAddQuestion'>
                    <div class="row">
                      <div class="sparkline10-hd">
                        <div class="main-sparkline10-hd">
                          <h1>Build Template
                            <button id="btnRemove" style="display: none" type="button" name="button" class="btn btn-default pull-right">- Remove Page</button>
                            <!-- <button id="btnView" type="button" name="button" class="btn btn-default pull-right">View Page</button> -->

                             <button id="btnAddNewPage" type="button" name="button" class="btn btn-default pull-right">+Add New Page</button>

                           </h1>
                        </div> <!--End of div class="main-sparkline10-hd-->
                      </div>
                      <div class="sparkline10-graph">
                        <div class="basic-login-form-ad">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="dual-list-box-inner">
                                 <div id="wizard">
                                    <?php
                                    if(isset($_GET['templateId']))
                                    {
                                      foreach ($SelectTemplate as $key => $value) {
                                        echo "<h3></h3><section>";
                                        foreach ($SelectTemplate[$key] as $key1 => $value1)
                                        {

                                            $label="";

                                            $input="</div><div>";
                                            $mainDiv="<div id='content".$value1["questionId"]."'><input type='hidden' value='".$value1["questionId"]."'>";
                                            $input1="<div  >".$value1['question']. '<i id="faClose'.$value1["questionId"].'" class="fa fa-times pull-right" ></i>';
                                              if($value1["possibleAnswer"]==null)
                                              {
                                                 $input.="<textarea rows='4' cols='85%'></textarea>";
                                              }else{
                                                $poss=explode("|",$value1["possibleAnswer"]);
                                                sort($poss);
                                                if($value1['questionTypeId']=="2")
                                                {
                                                  if($value1["leftLabel"]!=null && $value1["rightLabel"]!=null)
                                                  {
                                                      $label.="<br/>( ". $poss[0]." - ".$value1["leftLabel"]." , ".$poss[COUNT($poss)-1]." - ".$value1["rightLabel"]." )";
                                                  }
                                                  // echo $label;
                                                  for ($i=$poss[0]; $i <= COUNT($poss); $i++) {

                                                    $input.='<div class="radio-inline">'.
                                                        '<input class="form-check-input" type="'.$value1['inputName'].'" name="rb'.$value1["questionId"].'" >'.
                                                        '<label class="form-check-label" for="inlineRadio1">'.$i.'</label>'.
                                                      '</div>';
                                                    }
                                                }
                                                else{
                                                  foreach ($poss as $key => $value) {
                                                    $input.='<div class="radio-inline">'.
                                                        '<input class="form-check-input" type="'.$value1['inputName'].'" name="rb'.$value1["questionId"].'" >'.
                                                        '<label class="form-check-label" for="inlineRadio1">'.$value.'</label>'.
                                                      '</div>';

                                                  }

                                                }


                                              }
                                            $input.="<hr></div>";
                                            echo $mainDiv.$input1." ".$label.$input."</div>";
                                        }
                                        echo "</section><br/>";

                                      }
                                    }

                                    ?>
                                 </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4  col-lg-4 col-xs-4">
                  <div class="sparkline10-hd">
                    <div id="divPoolQuestion" class="main-sparkline10-hd">
                      <select id="drpQuestion"  required form="frmCreateTemplate" multiple="multiple">
                      </select>
                    </div>
                  </div>
                </div>

              </div>
            </div>


            <!-- button -->
            <div class="row">
               <div class=' text-right'>
                 <input type="submit" form="frmCreateTemplate" id='btnCreateTemplateDetails'
                 value='<?php
                            if(isset($_GET['templateId']))
                              {
                                echo "UPDATE";
                              }else
                              { echo "CREATE";
                              } ?>'
                  style="padding: 10px 20px;
                     border: none;
                     background: #A70027;
                     width:25%;
                     color: #fff;
                     margin-right:15%;
                     font-weight: 14px;
                     transition: all .4s ease 0s;">
               </div>
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
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>




    <script src="js\select2\select2.full.min.js"></script>

    <script src="js\steps\jquery.steps.js"></script>
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <script src="js/jquery.dropdown.js"></script>
    <script type="text/javascript">

          var destroy=false;
          var orderCount = 0;



          // tou concernant multiselect ladan
          var selectedValues=[];
          $('#drpQuestion').multiselect({
            buttonClass: 'btn btn-link',
            maxHeight: 100,
            buttonWidth: '100%',
            buttonText: function(options, select) {
              return "Choose questions : "+ options.length + "/ "+$('#drpQuestion option').length+" selected"
            },
            onInitialized: function(select, container) {

                $('div.btn-group button b').removeClass();
                if(location.search.length>0)
                {

                  $("div[id^='content']").find("input[type='hidden']").each(function () {
                    selectedValues.push($(this).val());
                    // // // console.log("value= "+$(this).val());
                  });
                }
            },

            onChange: function(option, checked) {
                $("#drpQuestion").addClass("changed");
                  if(checked)
                  {
                        // // // console.log(option);
                      getCurrentIndex=    wizard.steps('getCurrentIndex');
                      if(wizard.steps('numberSteps')==0)
                      {
                        alert("Please, add a page first");
                        $("#drpQuestion").multiselect('deselect', option.val());

                        return;

                      }

                      //keep order in which value is selected
                      orderCount++;
                      $(option).data('order', orderCount);
                        $("#btnRemove").css("display","none");
                        //add display
                      val=option.val();
                      $("div.btn-group ul.multiselect-container.dropdown-menu li").find("input[type='checkbox'][value='"+val+"']").attr("disabled",true).closest('li').removeClass("active").addClass("disabled").addClass("not-allowed").css("cursor", "not-allowed !important");
                        label="";
                      if(inputs[option.val()].inputName=='text')
                      {

                        inp='<textarea rows="4" cols="85%"> </textarea>';
                      }
                      else
                      {
                          inp="";
                          values=inputs[option.val()].possibleAnswer.split("|");
                          // // console.log(inputs);
                          values.sort(function(a, b) {
                              return a - b;
                            });
                          if(inputs[option.val()].questionType=="Scale")
                          {
                            label+="<br/>( "+values[0]+" - "+inputs[option.val()].leftLabel+" , "+values[values.length-1]+" - "+inputs[option.val()].rightLabel+" )";
                            for (var i = values[0]; i <= values[values.length-1]; i++) {

                              inp+='<div class="radio-inline">'+

                                  '<input class="form-check-input" type="'+inputs[option.val()].inputName+'" name="inlineRadioOptions" >'+
                                  '<label class="form-check-label" for="inlineRadio1">'+i+'</label>'+
                                '</div>';

                            }

                          }
                          else{
                            $.each(values,function(i,v){
                              inp+='<div class="radio"><div class="radio-inline">'+
                                '<label class="form-check-label" for="inlineRadio1" style="font-weight:700">'+
                                  '<input class="form-check-input" type="'+inputs[option.val()].inputName+'" name="inlineRadioOptions" >'+
                                    v
                                  +'</label>'+
                                '</div></div>'
                            });
                          }

                      }
                      // console.log(inputs);
                        div='<div id="content'+option.index()+'" class="container-fluid">'
                              +'<input type="hidden" value="'+option.val()+'">'
                              +'<div class="row">'+inputs[option.val()].question+" "+label+'<i id="faClose'+option.index()+'"class="fa fa-times pull-right" ></i></div>'
                              +'<div clas="row">'+inp+'</div><hr>'
                            +'</div>';

                      $("#wizard-p-"+getCurrentIndex).append(div);



                  }
                  else
                  {
                        $(option).data('order', '');
                        // // console.log("hello");
                        // $("div.btn-group ul.multiselect-container.dropdown-menu li").find("input[type='checkbox'][value='"+value+"']").removeAttr("disabled").closest('li').removeClass("disabled");
                        //  $("#drpQuestion").multiselect('select', option.val());
                        // $("#content"+option.index()).remove()
                  }
            },
            enableFiltering: true
          });


          $("form#frmCreateTemplate :input").change(function () {
            // $("#txtTemplateName").css("color", "black");
            $(this).addClass("changed");
          })


          if(location.search.length>0)
          {
            var wizard=$("#wizard").steps({
                headerTag :"h3",
                bodyTag : "section",
                enableFinishButton: false,
                transitionEffect: "slideLeft",
                onInit : function(event, currentIndex){
                   // $('.actions > ul > li:last-child').attr('style', 'display:none');
                    $("#wizard").find(".content").find('section').next('br').remove();
                   $("[id^=wizard-t-]").each(function () {
                     id=this.id;
                     index=id.replace("wizard-t-", "");

                   // // console.log(index);
                     $("#wizard").find("#wizard-t-" + index).find(".number").text("Page " +(parseInt(index)+1));
                   });

                },
                onStepChanged : function (event, currentIndex, priorIndex) {


                      if($('#wizard-p-'+currentIndex).is(":empty"))
                      {

                        $("#btnRemove").css("display","block");
                      }else{
                        // $('#wizard-t-'+currentIndex).click();
                        $("#btnRemove").css("display","none");
                      }
                 }
            });
          }
          else
          {
            var wizard=$("#wizard").steps({

                enableFinishButton: false,
                transitionEffect: "slideLeft",
                onInit : function(event, currentIndex){
                   $('.actions > ul > li:last-child').attr('style', 'display:none');

                },
                onStepChanged : function (event, currentIndex, priorIndex) {

                      if($('#wizard-p-'+currentIndex).is(":empty"))
                      {
                        $("#btnRemove").css("display","block");
                      }else{
                        $("#btnRemove").css("display","none");
                      }
                 }
            });
          }

          var first=true;
          $('#btnRemove').on('click', function() {

                index=wizard.steps("getCurrentIndex");
                if(parseInt(index)==wizard.steps("numberSteps")-1)
                {
                  wizard.steps("previous");
                }
                else{
                  wizard.steps("next");
                }

                wizard.steps("remove",parseInt(index));
                $("#btnRemove").css("display","none");

            });

            //remove a question


          // remove questio from prevuew
          $("#wizard").on("click",'i[id^="faClose"]',function () {

              //get value of item being closed
                  value=$(this).closest("[id^='content']").find('input[type="hidden"]').val();

              //find index of closest step

                  index=$(this).closest("[id^='wizard-p-']").attr("id").replace("wizard-p-", "");
                  // // console.log(index);
              //remove from dropdown
                  $("#drpQuestion").multiselect('deselect',value);
                // $("div.btn-group ul.multiselect-container.dropdown-menu li").find("input[type='checkbox'][value='"+value+"']").trigger("click");

              //remove question the from preview
                  $(this).closest("[id^='content']").remove();
                  $("div.btn-group ul.multiselect-container.dropdown-menu li").find("input[type='checkbox'][value='"+value+"']").removeAttr("disabled").closest('li').removeClass("disabled");


              //delete page if no data

                  if(wizard.steps("numberSteps")>1)
                  {
                    if($("#wizard-p-"+index).children("[id^='content']").length==0)
                    {
                      if(parseInt(index)==wizard.steps("numberSteps")-1)
                      {

                        wizard.steps("previous");
                      }
                      else{
                        wizard.steps("next");
                        ind=wizard.steps("getCurrentIndex");
                      //  alert(wizard.steps("numberSteps"));
                        if($('#wizard-p-'+ind).is(":empty") && wizard.steps("numberSteps")!=2)
                        {
                          $("#btnRemove").css("display","block");
                        }


                      }

                      wizard.steps("remove",parseInt(index));
                      $("[id^=wizard-t-]").each(function () {
                        id=this.id;
                        index=id.replace("wizard-t-", "");

                      // // console.log(index);
                        $("#wizard").find("#wizard-t-" + index).find(".number").text("Page " +(parseInt(index)+1));
                      });
                    }

                  }

          });

          // add a new page
          $("#btnAddNewPage").click(function () {

            if($("#drpQuestion option").not(":selected").length==0)
            {
              alert("No more question available");
              return false;
            }

            empty=false;
            $("[id^=wizard-p-]").each(function () {
              id=$(this).attr('id');
              if($(this).is(":empty"))
              {
                index=id.replace("wizard-p-", "");
                $("#wizard-t-"+index).get(0).click();
                empty=true;
                return false;
              }
            });

            if(empty)
            {
              alert("No more pages can be added. Page No  "+(parseInt(index)+1)+" is blank");
              return false;
            }

            if(numPageAllowed==wizard.steps("numberSteps"))
            {
              alert("Number of pages allowed have been exceeded");
              return false;
            }
            wizard.steps("add", {
              title:"",
                content: ""
            });


            numPage=wizard.steps("numberSteps");
            numPage=parseInt(numPage)-1;
            index1=wizard.steps("getCurrentIndex");
            for (var i = (index1+1); i <= numPage; i++) {

              wizard.steps("next");

            }
            index=wizard.steps("getCurrentIndex");

            // console.log(index);
            $("#wizard").find("#wizard-t-" + index).find(".number").text("Page " +(index+1));

            // wizard.steps("add", {
            //   title:"",
            //     content: ""
            // });
            // wizard.steps("next");
            // $("#btnRemove").click();
            // $("a[href='#previous']")[0].click();
            // $("a[href='#previous']")[0].click();
            // $("a[href='#next']")[0].click();
            // index=wizard.steps("getCurrentIndex");
            // $("#wizard-t-" + index).show();
            // $('.actions > ul > li:first-child')[0].click();
            // $('.actions > ul > li:last-child')[0].click();


            if(!first)
            {
              $("#btnRemove").css("display","block");
              first=false;
            }


          });

          //submit form
          $("#frmCreateTemplate").submit(function (event) {
            event.preventDefault();
            // alert($("#drpCycle").is(":selected"));
            // if($("#drpCycle").is(":selected"))
            // {
            //     $("#radCycle").attr("required",false);
            // }

            empty=false;
            $("[id^=wizard-p-]").each(function () {
              id=$(this).attr('id');
              if($(this).is(":empty"))
              {
                index=id.replace("wizard-p-", "");
                $("#wizard-t-"+index).get(0).click();
                empty=true;
              }
            });
            if(empty)
            {
              alert("Page number "+(parseInt(index)+1)+" is blank. Please remove it or add a question");
              return false;
            }
            $("#frmCreateTemplate, [form='frmCreateTemplate'] ").find(":input").not(".changed").attr("disabled",true);

            if($('#drpQuestion').attr("disabled")==undefined)
            {

              var selected = [];
              $('#drpQuestion option:selected').each(function() {
                  selected.push([$(this).val(), $(this).data('order')]);
              });

              selected.sort(function(a, b) {
                  return a[1] - b[1];
              });

              var text = '';
              for (var i = 0; i < selected.length; i++) {
                  text += selected[i][0] + ', ';
              }
              text = text.substring(0, text.length - 2);
              selected=selected.map(x=>x[0]);
              //// console.log(selected);

              var input = $("<input>")
                     .attr("type", "hidden")
                     .attr("name", "drpQuestion").val(selected);
              $('#frmCreateTemplate').append(input);

              var pageNo=[];
              $("#wizard .content").find("[id^='wizard-p-']").each(function(){
                //// console.log($(this).children().length);
                pageNo.push($(this).children("div").length);

              });
              var input = $("<input>")
                     .attr("type", "hidden")
                     .attr("name", "pageNo").val(pageNo);
              $('#frmCreateTemplate').append(input);
            }


                  // // console.log(pageNo);
            // // console.log($("#frmCreateTemplate").serializeArray());
            url =$("#frmCreateTemplate").attr('action');
            data=$("#frmCreateTemplate").serialize();

            jQuery.ajax({
              url : url,
              type : "post",
              dataType : "json",
              encode : true,
              cache : false,
              data :data

            }).done(function (data)
            {

              if(data.success)
              {
                window.location='template.php';
              }
              else
              {
                $.each(data.result,function(index,value){
                  $("#"+index).after("<span style='color:red'>"+value+"</span>");
                });
              }


            }).fail(function(xhr){
              alert("An error occured: " + xhr.status + " " + xhr.statusText);
            });
            // return false;

          });


          $("#drpCycle").on("change",function(){
            $("#frmCreateTemplate").find("input[type='radio'][name='radCycle']").prop("checked",false).prop('required',false).removeClass('changed');
          });

          $("#frmCreateTemplate input[type='radio'][name='radCycle']").change(function(e){

              $("#drpCycle").select2('val',"");
              $("#drpCycle").removeClass('changed');

              $(this).prop("checked",true).addClass("changed");
              $("#frmCreateTemplate").find("input[type='radio'][name='radCycle']").prop('required',true)
          });


          var inputs=[];
          var template=[];
          var templateName='';
          $( function() {
              $.ajax({
                type: "POST",
                url: "includes/Question/getQuestion.php",
                data : {echo : true},
                dataType : "json",
                cache: false,
                error: function(xhr){
                  alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
              })
              .done(function(result, status){
                if (status== "success"){
                  //// console.log(result);
                  $.each(result,function(i,v){
                        $("#drpQuestion").append('<option value="'+result[i].questionId+'">'+result[i].question.replace(/<br ?\/?>/g, "\n")+'</option>');
                        inputs[result[i].questionId]=result[i];
                  });
                  $("#drpQuestion").multiselect('rebuild');
                  $('#drpQuestion').parent().find('ul').attr('style','display:block;width:inherit;min-width:0;');
                  //  $('#drpQuestion').parent().find('ul').removeClass();
                  if(location.search.length>0)
                  {
                    templateName=$("#txtTemplateName").val();
                    // // console.log("selected= " +selectedValues);
                    $("#drpQuestion").multiselect('select',selectedValues);
                    $.each(selectedValues,function (i,val) {
                      orderCount++;
                      $("#drpQuestion option[value='"+val+"']").data('order', orderCount);
                      $("div.btn-group ul.multiselect-container.dropdown-menu li").find("input[type='checkbox'][value='"+val+"']").attr("disabled",true).closest('li').removeClass("active").addClass("disabled").addClass("not-allowed").css("cursor", "not-allowed !important");

                    });
                    // // console.log("boo",$("#drpCycle option").attr('selected'),$("#drpCycle option:selected").length);
                    if($("#drpCycle option:selected").length>=1 && $("#drpCycle").val()!=0)
                    {
                      $("#frmCreateTemplate").find("input[type='radio'][name='radCycle']").prop("checked",false).prop('required',false);

                    }
                  }

                }
              });


              $("#btnView").click(function () {
                var selected = [];
                $('#drpQuestion option:selected').each(function() {

                    selected.push([$(this).val(), $(this).data('order')]);
                });

                selected.sort(function(a, b) {
                    return a[1] - b[1];
                });

                var text = '';
                for (var i = 0; i < selected.length; i++) {
                    text += selected[i][0] + ', ';
                }

                text = text.substring(0, text.length - 2);
                selected=selected.map(x=>x[0]);
                // console.log(selected);

              })


              $.ajax({
                type: "POST",
                url: "includes/Template/getTemplate.php",
                data : {echo : true},
                dataType : "json",
                cache: false,
                error: function(xhr){
                  alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
              })
              .done(function(result, status){
                if (status== "success"){

                    template=result.map(x=>x.templateName);
                    // // console.log(template);
                }
              });

            });// end of $(function())

            $("#drpCycle").select2({
               tags: true,
               width :200,
               searchInputPlaceholder: 'Search',
               placeholder : "Choose another cycle",
             });

             //check that template name already exist
             $('#txtTemplateName').keyup(function(){
               // $("#txtTemplateName").css("color", "black");
                 $('#txtTemplateName').closest("div").find('span').remove();
                 if(location.search.length>0)
                 {
                   if($('#txtTemplateName').val().replace(/\s+/g, " ").trim()==templateName.replace(/\s+/g, " ").trim())
                   {
                      $("#txtTemplateName")[0].setCustomValidity('');
                      $("#txtTemplateName").removeClass("changed");
                      $("#btnCreateTemplateDetails").attr("disabled",true);
                      return false;
                   }
                 }


                   disable=false;
                 $.each(template,function (index,value) {

                   if(value.toLowerCase()==$('#txtTemplateName').val().toLowerCase().replace(/\s+/g, " ").trim() && templateName.toLowerCase().replace(/\s+/g, " ").trim() !=$("#txtTemplateName").val().toLowerCase().replace(/\s+/g, " ").trim())
                   {
                       // $('#txtTemplateName').after("<span  style='color:red'>This Template Name already exist</span>");
                         disable=true;
                         return false;
                   }
                 });
                 if(disable)
                 {
                   // $("#txtTemplateName").css("color", "red");
                   $("#txtTemplateName")[0].setCustomValidity('This Template Name already exist');
                   $("#txtTemplateName")[0].reportValidity();
                   // $("#btnCreateTemplateDetails").attr('disabled',true);
                 }else{
                   $("#txtTemplateName")[0].setCustomValidity('');
                    // $("#btnCreateTemplateDetails").attr('disabled',false);
                 }
              });

            // Disable Enter Key, prevent form from submitting on keypress enter
            $('#frmCreateTemplate').on('keyup keypress', function(e) {
              var keyCode = e.keyCode || e.which;
              if (keyCode === 13) {
                e.preventDefault();
                e.stopPropagation();
                return false;
              }
            });


    </script>

</body>

</html>
