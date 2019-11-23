

<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
 
$userid=$_SESSION['id'];


if(isset($_POST['type']))
{
		$limit=$_POST['id'];//1- city,2-zip,3-street address

	$type=$_POST['type'];//1- city,2-zip,3-street address
	
	$newVal=$_POST['newVal'];
		 $ptype=$_POST['ptype'];//rent or buy
	 $searchterm=$_POST['searchtype'];
if($ptype=="rent")
{
	
	$whereclause="PropertyType='Rental'";
	
}
else
{
	
	$whereclause="PropertyType!='Rental'";
	
}
	$pricetype=$_POST['minprice']; 
$minprice=$_POST['minprice'];
$maxprice=$_POST['maxprice'];
$beds=$_POST['beds'];
$baths=$_POST['baths'];

	if($type=='1')
	{
		$table="city like '%$searchterm%'";
		
		$query_ext="$table";
		
		
		
	}
	if($type=='2')
	{
		$table="ZIP_CODE_4 like '%$searchterm%'";
		
		$query_ext="$table";
		
		
		
	}
	
	if($type=='3')
	{
		$table="StreetName like '%$searchterm%'";
		
		$query_ext="$table";
		
		
		
	}
	
/*	if($pricetype!="")
	{
		if($pricetype=="low-to-high")
		{
		$tableq="order by `ListPrice` asc";
		
		}
		else
		{
				$tableq="order by `ListPrice` desc";
	
			
		}
		
	}
	else
	{
		
	$tableq="order by `ListPrice` asc";	
		
	}*/
	
	if($minprice!='')
	{ 
		if ( preg_match("/min/",$minprice) )

{ 
$minamount='0';
				 $tableq=""; 

		}
		else
		{
						$minamount=getpriceRangeFromAmount($conn,$minprice);
				   $tableq="and ListPrice>='$minamount'"; 

		}

		
		
	}
	
	if($maxprice!='')
	{
		if (preg_match("/max/", $maxprice))
		{ $maxamount='0';
		$maxquery="";

		}
		else
		{								$maxamount=getpriceRangeFromAmount($conn,$maxprice);

				 $maxquery="and ListPrice<='$maxamount'";

		}
		

		
		
	}
	
	if($beds!='')
	{
		if($beds=='beds')
		{
			
		$bedsquery="";	
		}
		else
		{
		
				 $bedsquery="and BedroomsTotal='$beds'";

		}
		
	}
	
	
	if($baths!='')   
	{
		
		if($baths=='baths')
		{
			
		$bathsquery="";	
		}
		else
		{
				 $bathsquery="and BathroomsFull='$baths'";

		}
		
	}
	
}?>




<div class="">
                            
                            <?php
//	echo "select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery limit $limit,4 ";				 
							$searchquery=mysqli_query($conn,"select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery limit $limit,4");
							$numrows=mysqli_num_rows($searchquery);
							$prop_num=0;
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
														$imageurl=getlocationwiseImage($conn,$listid);

							if($prop_num<=4)
							{
							?>
                          <input type="hidden" id="newtotalcount" value="<?php echo $numrows;?>">
                                    <input type="hidden" id="newshowid" value="4">

                                <!-- listing-item -->
                               
                                <div class="listing-item">
                                
                                       <article class="geodir-category-listing fl-wrap">
                                      <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">    <div class="geodir-category-img">
                                               <img src="<?php echo $imageurl;?>" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div></a>
                                            <div class="list-post-counter" onClick="wishlist('<?php echo $prop_id;?>')"><span id="propertymark<?php echo $prop_id;?>"><i class="<?php echo $fa_class;?>"></i></span></div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$<?php echo $resultset['ListPrice'];?></h3>
                                                <p><?php echo limitContent($conn,$resultset['PublicRemarks'],50);?></p>
                                                <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address;?></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    
                                    <?php } }?>
                                <!-- listing-item end-->
                                
                                <!-- listing-item -->
                                
                                <!-- listing-item end-->
                              
                                
                                  <!-- listing-item -->
                                
                                     
                                <!-- listing-item end-->
                                
                               
                           
                            </div>##<?php echo $newVal;?>