
<div class="header-top-area mg-b-20">
  <div class="fixed-header-top">
      <div class="container-fluid">
          <div class="row">
              <!-- <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <div class="header-top-menu tabl-d-n">
                    <ul class="nav navbar-nav mai-top-nav">
                        <li class="nav-item">
                          <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                              <i class="fa fa-bars"></i>
                          </button>
                        </li>

                    </ul>
                </div>
              </div> -->
              <div class="col-lg-7 col-md-9 col-sm-9 col-xs-7">
                  <div class="header-top-menu tabl-d-n">
                      <ul class="nav navbar-nav mai-top-nav">
                          <li class="nav-item <?php if($active=='home'){ echo 'active'; } ?>"><a href="home.php" class="nav-link">Home</a>
                          </li>
                          <li class="nav-item <?php if($active=='question'){ echo 'active'; } ?>"><a href="question.php" class="nav-link">Questions</a>
                          </li>
                          <li class="nav-item <?php if($active=='template'){ echo 'active'; } ?>"><a href="template.php" class="nav-link">Templates</a>
                          </li>
                          <li class="nav-item <?php if($active=='project'){ echo 'active'; } ?>"><a href="project.php" class="nav-link">Project/CR/Task</a>
                          </li>
                          <li class="nav-item <?php if($active=='survey'){ echo 'active'; } ?>"><a href="survey.php" class="nav-link">Survey</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-5 col-md-3 col-sm-3 col-xs-5">
                  <div class="header-right-info">
                      <ul class="nav navbar-nav mai-top-nav header-right-menu">
                            <li><a style="font-size:16px" href="analytics.php">Analytics</a></li>
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
