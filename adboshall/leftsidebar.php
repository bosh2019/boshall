<?php
$adminid=$_SESSION['id'];
  $adKey=getAdminKey($conn,$adminid);
if($adKey=='1'){

		$excMenuQry=mysqli_query($conn,"select * from `menucategory` where `status` ='1' order by `position` Asc ");
			 $ttt="0";
	
		$qryText=" 1";
	}else{
		
		 $ttt="1";
		$adminRole=getAdminRoleById($conn,$adminid); 
		$roleBasedRights=getRoleBasedRights($conn,$adminRole); 
		
		$impRights=implode(",",$roleBasedRights); 
		$mainMenus=getMainMenusByRights($conn,$roleBasedRights);
		$unqMainMenus=implode(",",array_unique($mainMenus));
		$qryText=" `id` IN ($impRights)";
		
		
		$excMenuQry=mysqli_query($conn,"select * from `menucategory` where `id` in(".$unqMainMenus.") order by `position` Asc ");
	}
		$numMenuRows=mysqli_num_rows($excMenuQry);
?>

<div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="javascript:void(0)" class="left-sidebar-toggle">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">Menu</li>
                  <li class="active"><a href="home.php"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                  </li>
                  <?php 
                    if($numMenuRows>0){
				while($fetchMenu=mysqli_fetch_array($excMenuQry)){
				 $menuId=$fetchMenu['id'];
				 $category=$fetchMenu['category'];
				 $icon=$fetchMenu['icon'];
				 $menuClass=$fetchMenu['class'];
				  $listexist=$fetchMenu['li'];
				 
				 
				 ?>
                <?php   if($listexist==0){?>

                  <li class="parent"><a href="javascript:void(0);"><i class="<?php echo $icon?>"></i><span><?php echo $category;?></span></a>
                   <?php 				if($adminRole==0)

				 {?>
                    <ul class="sub-menu">
                    <?php
							$excSubMenuQry=mysqli_query($conn,"select * from `menusubcategory` where `c_id`='$menuId' and `status` ='1' ");
								//$excSubMenuQry=mysql_query("select * from `menu` where `cat_id`='$menuId' and `role_id` ='$adminRole' ");
								$numSubMenuRows=mysqli_num_rows($excSubMenuQry);
								$mid=0;
								if($numSubMenuRows>0){
								while($fetchSubMenu=mysqli_fetch_array($excSubMenuQry)){
								$subcategory=$fetchSubMenu['subcategory'];
							//	$subcategory_id=$fetchSubMenu['sub_id'];
					//$details=getmenuidfromsubid($subcategory_id);
					//$link=$details[3];
								$link=$fetchSubMenu['link'];
								?>
                      <li><a href="<?php echo $link;?>"><?php echo $subcategory;?></a>
                      </li>
                      <?php }} else{?>
                      <li><a href="ui-buttons.html">No Menu Yet</a>
                      </li>
                      <?php }?>
                      
                    </ul>
                      <?php }?>
                      
                  </li>
                  <?php }else{?>
                  <li><a href="<?php echo $fetchMenu['link']?>"><i class="<?php echo $icon?>"></i><span><?php echo $category;?></span></a>
                  <?php }?>
                    <?php }}?>
                    
              <!--  <li class="divider">Extra</li>
                  <li ><a href="about.php"><i class="icon mdi mdi-format-quote"></i><span>About Us</span></a></li>
                     <li ><a href="settings.php"><i class="icon mdi mdi-settings"></i><span>Settings</span></a></li>-->
                    <!--<ul class="sub-menu">
                      <li><a href="email-inbox.html">About us</a>
                      </li>
                      <li><a href="email-read.html">Email Detail</a>
                      </li>
                      <li><a href="email-compose.html">Email Compose</a>
                      </li>
                    </ul>-->
           
                 <!-- <li class="parent"><a href="#"><i class="icon mdi mdi-view-web"></i><span>Layouts</span></a>
                    <ul class="sub-menu">
                      <li><a href="layouts-primary-header.html">Primary Header</a>
                      </li>
                      <li><a href="layouts-success-header.html">Success Header</a>
                      </li>
                      <li><a href="layouts-warning-header.html">Warning Header</a>
                      </li>
                      <li><a href="layouts-danger-header.html">Danger Header</a>
                      </li>
                      <li><a href="layouts-nosidebar-left.html">Without Left Sidebar</a>
                      </li>
                      <li><a href="layouts-nosidebar-right.html">Without Right Sidebar</a>
                      </li>
                      <li><a href="layouts-nosidebars.html">Without Both Sidebars</a>
                      </li>
                      <li><a href="layouts-fixed-sidebar.html">Fixed Left Sidebar</a>
                      </li>
                      <li><a href="pages-blank-aside.html">Page Aside</a>
                      </li>
                    </ul>
                  </li>
                  <li class="parent"><a href="#"><i class="icon mdi mdi-pin"></i><span>Maps</span></a>
                    <ul class="sub-menu">
                      <li><a href="maps-google.html">Google Maps</a>
                      </li>
                      <li><a href="maps-vector.html">Vector Maps</a>
                      </li>
                    </ul>
                  </li>-->
                </ul>
              </div>
            </div>
          </div>
          
        </div>
      </div>