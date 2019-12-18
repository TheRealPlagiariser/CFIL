<!doctype html>
<?php session_start();
  if(!isset($_SESSION['Username']))
  {
    header("Location: index.php");
  }


      $configContent=file_get_contents('config.json');
      $configContent=json_decode($configContent,true);


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
      textarea { resize:vertical; min-height: 100px;}
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

            <div class="left-sidebar-pro">
                <nav id="sidebar" style="min-width: 65px;">
                    <div id="activeApp" class="sidebar-header" style="background:#ebebeb;">
                      <a class="" href="chooseapp.php"><img src="images/mcblogo.png" alt=""></a>
                        <!-- <a href="../chooseapp.php"><img src="img/mcblogo.png" alt="" />
                        </a> -->
                        <strong>
                          <a href="chooseapp.php" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <i style="color: black;" class="fas big-icon fa-home"></i>
                            <span class="mini-dn"></span>
                          </a>
                        </strong>
                    </div>

                </nav>
            </div>
            <div class="content-inner-all">


              <div class="header-top-area mg-b-40" style="margin-bottom:5%">
                <div class="fixed-header-top">
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-8  col-md-8 col-sm-7 col-xs-10">
                            <div class="title" style="margin-left:50%;">
                                <!-- <span style="color:white;margin: 0 auto; text-align:center;">Welcome to Ultimate SharePoint</span> -->
                                <h1 style="margin: 15px auto; text-align:center;">Welcome to IT Testing Services Config </h1>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4">
                                <div class="header-right-info">
                                  <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                    <li class="nav-item">
                                              <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                  <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                  <span class="admin-name">
                                                    <?php
                                                          if(isset($_SESSION['FullName']))
                                                            {
                                                                echo $_SESSION['FullName'];
                                                            }
                                                            else
                                                            {
                                                                echo "Username";
                                                            }
                                                    ?>
                                                  </span>
                                                  <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                              </a>
                                              <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                                  <li><a href="chooseapp.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Choose App</a>
                                                  </li>
                                                  <li><a href="logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                                  </li>
                                              </ul>
                                    </li>
                                  </ul>
                                </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>



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
                                     <div  id=""  class="datatable-dashv1-list custom-datatable-overright">
                                       <div class="container-fluid">
                                         <div class="row">
                                           <label class="col-md-2 ">Authorised User</label>
                                           <div class="col-md-8" id="spanAuthorisedUser">

                                           </div>


                                         </div>

                                         <div class="text-right ">
                                            <button id="btnEditGeneralConfiguration" type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#mdlEditGeneralConfiguration">Edit General Configuration</button>
                                         </div>
                                       </div>


                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>

                 </div>

                 <!--Modal General  Configuration -->
                 <div id="mdlEditGeneralConfiguration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                   <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Edit General Configuration</h4>
                       </div>
                       <div class="modal-body">
                         <form id="frmEditGeneralConfiguration" action="includes/Config/updateStatus.php" method="post" class="form-horizontal">

                           <div class="form-group-inner">
                             <div class="row">
                               <label for="txtAuthorisedUser" class="col-sm-2 control-label">Authorised User</label>
                               <div class="col-sm-9">
                                 <textarea  id="txtAuthorisedUser" class="form-control" name="txtAuthorisedUser" style></textarea>
                               </div>
                             </div>
                             <div class="row">
                               <label for="" class="col-sm-12 control-label"><strong>IMPORTANT NOTE</strong>: All fields are seperated by pipe. Make changes only if you really know what you are doing.  </label>

                             </div>


                           </div>



                        </form>
                       </div>

                       <div class="modal-footer">
                         <input form="frmEditGeneralConfiguration" id="btnfrmEditGeneralConfiguration" type="submit" value="Save Changes"  class="btn btn-default" >
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



    <script src="js\select2\select2.full.min.js"></script>
    <!-- <script src="js\toggle\bootstrap-toggle.min.js"></script> -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- main JS
		============================================ -->

    <script type="text/javascript">
      $(document).ready(function(){
        var jsonContent;
        $.getJsonFile=function () {
          $.getJSON("config.json",function (data) {
                        jsonContent=data;

            $("#spanAuthorisedUser").empty();
            $.each(jsonContent.authorised_user,function (index,value) {
              div='<div class="row">\
                 <span  class=" "   title="">'+value+'</span>\
              </div>';
              $("#spanAuthorisedUser").append(div);
            });
            user=jsonContent.authorised_user;
            console.log(user);
            $("#txtAuthorisedUser").val(Object.values(user).join('|'));

          })
        }

        $(function () {
          $.getJsonFile();
        });

        $("#frmEditGeneralConfiguration").submit(function (e) {
          e.preventDefault();
          value=$("#txtAuthorisedUser").val();
          value=value.split('|');
          jsonContent.authorised_user=[];
          $.each(value,function (index,value) {
            if(value!='')
            {
                jsonContent.authorised_user.push(value);
            }

          });
          console.log(jsonContent);
          $.post("includes/config/ammendConfig.php",{data : JSON.stringify(jsonContent)},function () {

              $("#mdlEditGeneralConfiguration").modal('hide');
                $.getJsonFile();
          })

        })
      });
    </script>

</body>

</html>
