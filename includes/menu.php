<div class="header-top-area mg-b-40">
  <div class="fixed-header-top">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8  col-md-8 col-sm-7 col-xs-10">
              <div class="title" style="margin-left:50%;">
                  <!-- <span style="color:white;margin: 0 auto; text-align:center;">Welcome to Ultimate SharePoint</span> -->
                  <h1 style="margin: 15px auto; text-align:center;">Welcome to IT Testing Services Portal </h1>
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
                                    <li><a href="config.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Config</a>
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
