<!doctype html>
<?php session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: ../index.php");
  }
  include 'includes/db_connect.php';
  $selectConfig= "SELECT * FROM config";
  $selectConfig=$conn->query($selectConfig);
  $selectConfig=$selectConfig->fetchALL(PDO::FETCH_ASSOC);

$superusers = explode("|", $selectConfig[0]["superusers"]);
if(!in_array( $_SESSION['Username'] , $superusers ))
{
  header("Location: ../index.php");
}
 ?>
<html class="no-js" lang="en">

<head>
    <?php
      $title="Config";
      include 'includes/head.php';
    ?>
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <link rel="stylesheet" href="css\select2\select2.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/charts.css">
    <link rel="stylesheet" href="css\data-table\bootstrap-table.css">
    <!-- <link rel="stylesheet" href="css\Toggle\bootstrap-toggle.min.css"> -->
    <link rel="stylesheet" href="css\touchspin/jquery.bootstrap-touchspin.min.css" type="text/css"/>
    <style>
      .custom-datatable-overright table tbody tr td.datatable-ct{
            color: red;
      }
      /* .bootstrap-table .table thead > tr > td {
          padding: 0;
          margin: 0;
      } */
      .fa.fa-times:hover{
        cursor:default;
      }

      #searchIcon:hover{cursor: pointer; background-color: #A70027;}
      #searchIcon:active{background-color: black;}

      ul#searchResults{background-color:#ebebeb;}
      ul#searchResults li:hover {cursor: pointer; background-color: #A70027;}
      ul#searchResults li#header:hover {cursor: default;  background-color: #ebebeb;}
      ul#searchResults li{}
        .form-control.select2-hidden-accessible {
            top: 30px;
            left : 25%;
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
        .comment {
          font-style: italic;
          color:#a0a09d;
        }
    </style>
</head>


<body class="materialdesign">
        <div class="wrapper-pro">
          <?php $activeApp="il" ?>
          <?php include "../includes/sidebar.php"; ?>
            <div class="content-inner-all">


                <?php
                $active='';
                    include 'includes/menu.php';
                 ?>


                 <div class="container-fluid mg-b-40" >
                     <div class="row mg-b-10">
                         <div class="col-lg-12">
                             <div class="sparkline8-list shadow-reset">
                                 <div class="sparkline8-hd">
                                     <div class="main-sparkline8-hd">
                                         <!-- <h1>Survey Description <a  style="float:right"type="button" class="btn btn-default" href='' id="btnDownload"><i class='fa fa-download'></i> Download</a> </h1> -->
                                         <h1>
                                           General Configuration
                                         </h1>


                                     </div>
                                 </div>

                                 <div  class="sparkline8-graph" style="text-align:left;">
                                     <div  id="divSurveyDetails"  class="datatable-dashv1-list custom-datatable-overright">
                                       <div class="container-fluid">
                                         <?php $status = explode("|", $selectConfig[0]["actionItemStatus"]); ?>

                                         <div class="row">
                                           <label class="col-md-2 ">Status</label>
                                           <span  class="col-md-8 "  id="spanSurveyName" title=""><?php echo $status[0]?></span>
                                         </div>

                                         <?php for($i=1; $i<sizeof($status);$i++){
                                           echo ' <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <span  class="col-md-8 "  id="" title=""> '.$status[$i].'</span>
                                                   </div>';
                                         } ?>

                                         <div class="row" style="margin-top:1%">
                                           <label class="col-md-2 ">Super User</label>
                                           <span  class="col-md-8 "  id="spanSurveyName" title=""><?php echo $superusers[0]?></span>
                                         </div>

                                         <?php for($i=1; $i<sizeof($superusers);$i++){
                                           echo ' <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <span  class="col-md-8 "  id="" title=""> '.$superusers[$i].'</span>
                                                   </div>';
                                         } ?>

                                         <div class="text-right ">
                                            <button id="btnEditStatus" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditStatus">Edit General Configuration</button>
                                         </div>
                                       </div>


                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>

                 </div>

                 <!--Modal General  Configuration -->
                 <div id="mdlEditStatus" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                   <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Edit General Configuration</h4>
                       </div>
                       <div class="modal-body">
                         <form id="frmEditStatus" action="includes/Config/updateStatus.php" method="post" class="form-horizontal">

                           <div class="form-group-inner">
                             <div class="row">
                               <label for="txtStatus" class="col-sm-2 control-label">Status Field</label>
                               <div class="col-sm-9">
                                 <input type="text" required id="txtStatus" class="form-control" name="txtStatus" value="<?php echo  $selectConfig[0]["actionItemStatus"]; ?>">
                               </div>
                             </div>


                           </div>

                           <div class="form-group-inner">
                             <div class="row">
                               <label for="txtStatus" class="col-sm-2 control-label">SuperUsers</label>
                               <div class="col-sm-9">
                                 <input type="text" required id="txtSuperUsers" class="form-control" name="txtSuperUsers" value="<?php echo  $selectConfig[0]["superusers"]; ?>">
                               </div>
                             </div>
                             <div class="row">
                               <label for="" class="col-sm-12 control-label"><strong>IMPORTANT NOTE</strong>: All fields are seperated by pipe. Make changes only if you really know what you are doing.  </label>
                             </div>

                           </div>

                        </form>
                       </div>

                       <div class="modal-footer">
                         <input form="frmEditStatus" id="btnfrmEditStatus" type="submit" value="Save Changes"  class="btn btn-default" >
                         <input type="button" value="Cancel" class="btn btn-default " data-dismiss="modal">
                       </div>

                     </div>
                   </div>
                 </div>
                 <!--End of Edit -->

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

    <script src="js\bootbox.all.min.js"></script>

    <script src="js\select2\select2.full.min.js"></script>
    <!-- <script src="js\toggle\bootstrap-toggle.min.js"></script> -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- main JS
		============================================ -->

    <script type="text/javascript">
      // $(document).ready(function(){
      //   $("#frmEditStatus").on("submit", function(e){
      //     e.preventDefault();
      //     e.stopPropagation();
      //     var url= "includes/Config/updateStatus.php"
      //     var postman= $("#frmEditStatus").serialize();
      //     // console.log(postman);
      //     $.ajax({
      //       type: "POST",
      //       url: url,
      //       data: postman,
      //       datatype: "json",
      //       cache: false,
      //       error: function(xhr){
      //         alert("An error occured: " + xhr.status + " " + xhr.statusText);
      //       }
      //     }).done(function(result, status){
      //       if(status == "success"){
      //
      //       }
      //     });
      //   })
      // });

    </script>


</body>

</html>
