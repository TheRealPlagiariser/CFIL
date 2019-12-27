<div class="left-sidebar-pro">
    <nav id="sidebar">
        <div class="sidebar-header">
          <a class="" href="../chooseapp.php"><img src="images/mcblogo.png" alt=""></a>
            <!-- <a href="../chooseapp.php"><img src="img/mcblogo.png" alt="" />
            </a> -->
            <strong>
              <a href="../chooseapp.php" role="button" aria-expanded="false" class="nav-link dropdown-toggle"  title='ITS Portal'>
                <i style="color: black;" class="fas big-icon fa-rocket"></i>
                <span class="mini-dn"></span>
              </a>
            </strong>
        </div>
        <div class="left-custom-menu-adp-wrap">
            <ul class="nav navbar-nav left-sidebar-menu-pro">
                <li class="nav-item <?php if($activeApp=='cf'){ echo 'activeApp'; } ?>">
                    <a href="../CustomerFeedback/home.php" role="button" aria-expanded="false" class="nav-link dropdown-toggle" title='Customer Feedback'>
                      <i class="fas big-icon fa-poll-h"></i>
                       <span class="mini-dn">Customer Feedback</span>
                       <span class="indicator-right-menu mini-dn">
                         <i class="fa indicator-mn fa-angle-left"></i>
                       </span>
                     </a>
                </li>
                <li class="nav-item <?php if($activeApp=='il'){ echo 'activeApp'; } ?>">
                  <a href="../ImprovementLog/actionitem.php" role="button" aria-expanded="false" class="nav-link dropdown-toggle" title='Improvement Log'>
                    <i class="fas big-icon  fa-tasks"></i>
                    <span class="mini-dn">Improvement Log</span>
                    <span class="indicator-right-menu mini-dn">
                      <i class="fa indicator-mn fa-angle-left"></i>
                    </span>
                  </a>
                </li>
                <li class="nav-item <?php if($activeApp=='tv'){ echo 'activeApp'; } ?>">
                  <a href="../TeamVelocity/team.php" role="button" aria-expanded="false" class="nav-link dropdown-toggle" title='Team Velocity'>
                    <i class=" big-icon  fab fa-accessible-icon"></i>
                    <span class="mini-dn">Team Velocity</span>
                    <span class="indicator-right-menu mini-dn">
                      <i class="fa indicator-mn fa-angle-left"></i>
                    </span>
                  </a>
                </li>

                <!-- <li class="nav-item <?php //if($activeApp=='na'){ echo 'activeApp'; } ?>">
                  <a href="#" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                    <i class="fas big-icon fa-file-alt"></i>
                    <span class="mini-dn">New Application</span>
                    <span class="indicator-right-menu mini-dn">
                      <i class="fa indicator-mn fa-angle-left"></i>
                    </span>
                  </a>
                </li> -->

            </ul>
        </div>
    </nav>
</div>
