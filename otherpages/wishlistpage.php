<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$userid=$_SESSION['id'];

 echo $property_id=$_GET['property_id'];
 exit;
$pdate=date("Y-m-d");


$sel=mysqli_query($conn,"select * from `property_wishlist` where `userid`='$userid' and `property_id`='$property_id'");

$numrows=mysqli_num_rows($sel);
if($numrows==0)
{
 $selQry=mysqli_query($conn,"INSERT INTO `property_wishlist`(`id`, `userid`, `property_id`, `pdate`) VALUES (NULL,'$userid','$property_id','$pdate')");
 
 	$num='1';

}

else
{
	$resultset=mysqli_fetch_row($sel);
	$id=$resultset[0];
 $selQry=mysqli_query($conn,"delete from `property_wishlist` where `id`='$id'");
	
	$num='0';
	
}

if($selQry)
{
	
	echo $num;
	
	
}
  
  else
  {
	  $num=2;
	echo $num;  
	  
	  
	  
  }
  
  
  

?>##<div class="list-main-wrap fl-wrap card-listing">
                            
                            <div class="">
                            
                            <?php
							
							$searchquery=mysqli_query($conn,"select * from `property_wishlist` inner join `mlspindata_master` on property_wishlist.property_id =mlspindata_master.id where `userid`='$userid'");
							$numrows=mysqli_num_rows($searchquery);
							$prop_num=0;
							if($numrows>0)
							{
							while($resultset=mysqli_fetch_array($searchquery))
							{   
							$prop_id=$resultset['id'];
							$listid=$resultset['ListingId'];
							 $city=$resultset['city'];
							 
							 $prop_num++;
							if($city!='') 
							{
								
							$city=",".$resultset['city'];	
							}
							$address=$resultset['StreetName']." ".$city.$resultset['CountyOrParish'];
							
							$wishlist_val=getpropertwishlistvalue($conn,$userid,$prop_id);
							if($wishlist_val>0)
							{
								
							$fa_class="fa fa-heart";	
								
							}
							else
							{
								
														$fa_class="fa fa-heart-o";	
	
								
							}
							
							
							?>
                         


                                <!-- listing-item -->
                               
                                <div class="listing-item">
                                
                                       <article class="geodir-category-listing fl-wrap">
                                      <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">    <div class="geodir-category-img">
                                               <img src="<?php echo $baseurl;?>/images/all/item_3.jpg" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div></a>
                                            <div class="list-post-counter" onClick="addtowishlistpage('<?php echo $prop_id;?>')"><span id="propertymark<?php echo $prop_id;?>"><i class="<?php echo $fa_class;?>"></i></span></div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$<?php echo $resultset['ListPrice'];?></h3>
                                                <p><?php echo limitContent($conn,$resultset['PublicRemarks'],50);?></p>
                                                <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address;?></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    
                                     <?php } } else {?>
                                    
                                    <div class="listing-item">
                                
                                       <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                               <img src="<?php echo $baseurl;?>/images/no-image.jpg" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <p>Your wishlist is empty!!!</p>
                                                
                                            </div>
                                        </article>
                                    </div>
                                    
                                    <?php }?>
                                    
                                     <input type="hidden" id="newtotalcount" value="<?php echo $numrows;?>">
                                    <input type="hidden" id="newshowid" value="4">

   <input type="hidden" id="fptype" value="<?php echo $ptype;?>">
      
   <input type="hidden" id="fsearchtype" value="<?php echo $searchterm;?>">
   <input type="hidden" id="fmax_price" value="<?php echo $maxprice;?>">
   <input type="hidden" id="fbeds" value="<?php echo $beds;?>">
           <input type="hidden" id="fbaths" value="<?php echo $baths;?>"> 
                                <!-- listing-item end-->
                                
                                <!-- listing-item -->
                                
                                <!-- listing-item end-->
                              
                                
                                  <!-- listing-item -->
                                
                                     
                                <!-- listing-item end-->
                                
                               
                           
                            </div>
                            
                            
                        </div>