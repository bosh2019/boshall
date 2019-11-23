

 <?php
   $execQry=mysqli_query($conn,"select * from `notices`  order by `id` desc  ");
   $numRows=mysqli_num_rows($execQry);
   $notVisibleNotices=getNotVisibleNotices($conn);
	?>
<ul class="nav navbar-nav navbar-right be-icons-nav">
              
              <li class="dropdown"><a href="notice.php" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span><?php  if($notVisibleNotices>0){?><span class="indicator"><?php echo $notVisibleNotices;?></span> <?php }?></a>
                <ul class="dropdown-menu be-notifications">
                  <li> 			
                    	<?php  if($notVisibleNotices>0){?>
                    <div class="title">Notifications<span class="badge"><?php echo $notVisibleNotices ?></span></div>
                       <?php } ?>
                    <div class="list">
                      <div class="be-scroller">
                        <div class="content">
                          <ul>
     <?php 
	   
	$count=0;
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
		$count++;
	if($count<=6){
		?>                     
                            <li class="notification notification-unread"><a href="notice.php">
                                <div class="image"><img src="<?php echo $baseurl?>/images/bell.png" alt="Notifications"></div>
                                <div class="notification-info">
      <div class="text"><?php echo stripslashes($fetch['notice']) ?></div><span class="date"><?php echo stripslashes($fetch['pdate']) ?></span>
                                </div></a></li>
                       <?php }}
		
	}else{?>
                <li class="notification notification-unread"><a href="notice.php">
                                <div class="image"><img src="<?php echo $baseurl?>/images/bell.png" alt="Notifications"></div>
                                <div class="notification-info">
      <div class="text">No Notifications Yet</span>
                                </div></a></li>       
                       <?php }?>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="footer"> <a href="notice.php">View all notifications</a></div>
                  </li>
                </ul>
              </li>
              
            </ul>