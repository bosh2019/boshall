 <link rel="shortcut icon" href="assets/img/lttj.png"><div class="navbar-header"><a href="home.php" class="navbar-brand"><img src="<?php echo $baseurl;?>/images/adminlogo.png" style="padding-top: 9px;" /></a></div>
          <div class="be-right-navbar">

<ul class="nav navbar-nav navbar-right be-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="assets/img/adminn.png" alt="Avatar"><span class="user-name"><?= ucfirst(getAdminNameById($conn,$uid))?> </span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name"><?= ucfirst(getAdminNameById($conn,$uid))?> </div>
                     
                    </div>
                  </li>
                  <li><a href="settings.php"><span class="icon mdi mdi-settings"></span> Settings</a></li>
                  <li><a href="logout.php"><span class="icon mdi mdi-power"></span> Logout</a></li>
                </ul>
              </li>
            </ul>