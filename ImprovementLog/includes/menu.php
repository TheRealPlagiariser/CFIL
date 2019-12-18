
<div class="header-top-area mg-b-40">
  <div class="fixed-header-top">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-7 col-md-5 col-sm-7 col-xs-10">
                  <div class="header-top-menu tabl-d-n">
                      <ul class="nav navbar-nav mai-top-nav">
                          <li class="nav-item <?php if($active=='actionitem'){ echo 'active'; } ?>"><a href="actionitem.php" class="nav-link">Action </a>
                          </li>
                          <li class="nav-item <?php if($active=='improvementrecord'){ echo 'active'; } ?>"><a href="record.php" class="nav-link">Record</a>
                          </li>
                          <li class="nav-item <?php if($active=='activity'){ echo 'active'; } ?>"><a href="activity.php" class="nav-link">Activity</a>
                          </li>
                          <li class="nav-item <?php if($active=='project'){ echo 'active'; } ?>"><a href="project.php" class="nav-link">Project/CR/Task</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-5">
                  <div class="header-right-info">
                      <ul class="nav navbar-nav mai-top-nav header-right-menu">
                            <li ><a style="font-size:16px" href="analytics.php">Analytics</a></li>
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
                                  <?php if(in_array( $_SESSION['Username'] , $superusers )){
                                    echo'<li><a href="config.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Config</a>
                                    </li>';
                                  } ?>

                                    <li><a href="../logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
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
