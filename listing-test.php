<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
 

$redirection_val='';
if(isset($_GET['type']))
{
	
	$type=$_GET['type'];//1- city,2-zip,3-street address
	
		 $ptype=$_GET['ptype'];//rent or buy
	 $searchterms=$_GET['searchtype'];
	 $searchterm=backstrreplace($conn,$searchterms);
if($ptype=="rent")
{
	
	
	$whereclause="PropertyType='Rental'";
	
}
else
{
	
	$whereclause="PropertyType!='Rental'";
	
}
	$pricetype=$_GET['minprice']; 
$minprice=$_GET['minprice'];
$maxprice=$_GET['maxprice'];
$beds=$_GET['beds'];
$baths=$_GET['baths'];

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
	
}



$urlfor_filter="$baseurl/property/$ptype/$searchterms/$type/";
$urlreset_filter="$baseurl/property/$ptype/$searchterms/$type";

$actual_url="$baseurl/property";

  $actual_urlforlogin=$domain.$_SERVER['REQUEST_URI'];
 $sele_query="select distinct `ListPrice` from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery";
   $sel_string=getPricerangewithquery($conn,$sele_query); 
  
  $exploded_price=explode("##",$sel_string);
  
   $min_amt=$exploded_price[0];
      $max_amt=$exploded_price[1]; 

?>  

 

<!DOCTYPE HTML>
<html lang="en">
<head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title><?php echo $pagename;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        
        <style>
		
  #loader {
    position: absolute;
    top: 30%;
    right: 16px;
}

.loadder-ser
{
	position: absolute;
    top: 22%;
    right: 20%!important;
}
		
		.nopad {
	padding-left: 0 !important;
	padding-right: 0 !important;
}
			label.image-checkbox img {
    width: 33px;
    text-align: center;
				margin: auto;
				margin-top: 12px;
}
			.custom-select {
    background-color: #4db7fe;
    padding: 8px 24px;
    border-radius: 3px;
    color: #fff;
    border: 0px solid #4db7fe;
    text-align: left;
}
			.custom-select option, option {
    background: #fff;
    color: #000;
    border-bottom: 1px solid #4db7fe;
}
/*image gallery*/
.image-checkbox {
	cursor: pointer;
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	border: 4px solid transparent;
	margin-bottom: 0;
	outline: 0;
}
.image-checkbox input[type="checkbox"] {
	display: none;
}

.image-checkbox-checked {
	border: 2px solid #c6c6c6;
	
}
.image-checkbox .fa {
  position: absolute;
  color: #4A79A3;
  background-color: #fff;
  padding: 10px;
  top: 0;
  right: 0;
  opacity:0;
}
.image-checkbox-checked .fa {
  display: none !important;
}</style>

        <!--=============== css  ===============-->
      <?php include_once("headernew.php");?>
      
       <input type="hidden" id="actual_url" name="actual_url" value="<?php echo $actual_url;?>">
       
       <input type="hidden" id="urlfor_filter" name="urlfor_filter" value="<?php echo $urlfor_filter;?>">


            <!--  header end -->
            <!-- wrapper -->
            <div id="wrapper">
                <div class="content">
                    <!-- Map -->
                    <div class="map-container column-map left-pos-map">
                        <div id="map-main1">
                     <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Massachusetts&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>   
                        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d448181.163741622!2d76.81306442366602!3d28.64727993557044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x37205b715389640!2sDelhi!5e0!3m2!1sen!2sin!4v1556955088348!5m2!1sen!2sin" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>--></div>
                        
                        <div id="map" ></div>
                        <!--<ul class="mapnavigation">
                            <li><a href="#" class="prevmap-nav">Prev</a></li>
                            <li><a href="#" class="nextmap-nav">Next</a></li>
                        </ul>-->
						<div class="scrollContorl mapnavbtn" title="Enable Scrolling"><span><i class="fa fa-lock"></i></span></div>  						
                    </div>
                    <!-- Map end -->
                    <!--col-list-wrap -->
                    <div class="col-list-wrap right-list">
                        <div class="listsearch-options fl-wrap" id="lisfw" >
                            <div class="">
                                <!--<div class="listsearch-header fl-wrap">
                                    <h3>Results For : <span>Food and Drink</span></h3>
                                    <div class="listing-view-layout">
                                        <ul>
                                            <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                                            <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                                        </ul>
                                    </div>
                                </div>-->
                                <!-- listsearch-input-wrap  -->
                                <div class="listsearch-input-wrap fl-wrap">
                                
                                   <div class="listsearch-input-item">

                                   <select data-placeholder="Price" class="custom-select" name="min_price" id="min_price" onChange="setminprice(this.value,'1')">
                                            <option <?php if($pricetype==""){?> selected<?php }?> value="min">No min price</option>
                                                <?php 
							$selquery=mysqli_query($conn,"select *  from `pricerange` order by `value` asc ");
							
							while($results=mysqli_fetch_array($selquery))
							{
								$slug= $results['ListPrice']; 
								$amt=$results['amount'];    
								   ?>
                                    <option value="<?php echo $results['amount'];?>" <?php if($pricetype==$amt){?>selected<?php }?>><?php echo trim($results['amount']);?></option>       
                                    
                                    <?php }?>
                                        </select>
                                      
                                        
                                    </div>
                                   
                                    <div class="listsearch-input-item">
 <select data-placeholder="Price" class="custom-select" onChange="setminprice(this.value,'2')" id="max_price" >
                                            <option value="max">No max price</option>
                                                <?php 
							$selquery=mysqli_query($conn,"select *  from `pricerange` order by `value` asc ");
							while($results=mysqli_fetch_array($selquery))
							{
								$slug= $results['ListPrice']; 
																$amt=$results['amount'];    
    
								   ?>
                                    <option value="<?php echo $results['amount'];?>" <?php if($maxprice==$amt){?>selected<?php }?>><?php echo trim($results['amount']);?></option>       
                                    
                                    <?php }?>
                                        </select>
                                        

			
<!--
                                        <select data-placeholder="Location" class="chosen-select" id="location" onChange="price_filter(this.value,'<?php echo $actual_url;?>')" >
                                          <?php 
										  
				$cquery=mysqli_query($conn,"select distinct `city` from `mlspindata_master` where `view`='1'");						  
						$numr=mysqli_num_rows($cquery);
						while($set=mysqli_fetch_array($cquery))
						{				  
									$searchtypess=strtolower(strreplace($conn,$set['city']));
	  
										  ?>
                                        <option value="<?php echo $searchtypess;?>" <?php if($searchterm==$searchtypess){?> selected <?php }?>> <?php echo $set['city'];?></option> 
                                          <?php }?>
                                        </select>
-->
                                    </div>
<!--
                                 <div class="listsearch-input-item">
                                        <select data-placeholder="All Categories" class="chosen-select" id="category" onChange="price_filter(this.value,'<?php echo $actual_url;?>')">
                                           <?php 
												
												$query=mysqli_query($conn,"select * from `propertyfor` where `status`='1'");
												$numrowss=mysqli_num_rows($query);
												if($numrowss>0)
												{
											while($resultsets=mysqli_fetch_array($query))
											{	
											$p_slug=$resultsets['slug'];
												
												?>
                                                <option value="<?php echo $p_slug;?>" <?php if($p_slug==$ptype){?> selected<?php }?>><?php echo $resultsets['name'];?></option>
                                                <?php } }?>
                                        </select>
                                    </div>
-->
                                    
                                    <!-- hidden-listing-filter -->
                                    <div class="hidden-listing-filter fl-wrap">
                                        <!--<div class="distance-input fl-wrap">
                                            <div class="distance-title"> Radius around selected destination <span></span> km</div>
                                            <div class="distance-radius-wrap fl-wrap">
                                                <input class="distance-radius rangeslider--horizontal" type="range" min="1" max="100" step="1" value="1" data-title="Radius around selected destination">
                                            </div>
                                        </div>-->
                                        <!-- Checkboxes -->
                                        <div class=" fl-wrap filter-tags">
                                            <h4>Filter </h4>
                                    <div class="listsearch-input-item">
                                            <select name="country" class="custom-select" style="padding: 8px 50px;" onChange="setminprice(this.value,'3')" id="beds">
                <option value="beds"><span class="flag-icon flag-icon-gr"></span>Beds</option>
                <?php 
				
				for($bed=1;$bed<=10;$bed++)   
				{
				
				?>
                <option value="<?php echo $bed;?>" <?php if($bed==$beds){?>selected<?php }?>><?php echo $bed;?></option>
                
                <?php }?>
               </select>
											</div>
									<div class="listsearch-input-item">
                                            <select name="country" class="custom-select" style="padding: 8px 50px;" id="baths" onChange="setminprice(this.value,'4')">
                <option value="baths"><span class="flag-icon flag-icon-gr"></span>Baths</option>
                <?php 
				
				for($bed=1;$bed<=10;$bed++)   
				{
				
				?>
                <option value="<?php echo $bed;?>" <?php if($bed==$baths){?>selected<?php }?>><?php echo $bed;?></option>
                
                <?php }?>
               </select>
											</div>
										</div>
									  
                                   
                                    </div>
                                    
                                    <!-- hidden-listing-filter end -->
                                 <!--   <button class="button fs-map-btn" style="margin-top:5px">Apply</button>-->
                                    <div class="more-filter-option">More Filters <span></span></div>
                                </div>
                                <!-- listsearch-input-wrap end -->
                            </div>
                        </div>
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing">
                            
                            <div class="">
                            
                            <?php
			echo "select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery";				 
$searchquery=mysqli_query($conn,"select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery");
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
							if($userid!="")
							{
							if($wishlist_val>0)
							{
								
							$fa_class="fa fa-heart";	
								
							}
							else
							{
								
														$fa_class="fa fa-heart-o";	
	
								
							}
							} else
							{
																					$fa_class="fa fa-heart-o";	
	
								
							}
							$imageurl=getlocationwiseImage($conn,$listid);
							if($prop_num<=4)
							{
							?>
                         


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
                                    
                                    <?php } } } else{?>
                                    
                                    <p>No result found!!!</p>
                                    <?php }?>
                                    
                                     <input type="hidden" id="newtotalcount" value="<?php echo $numrows;?>">
                                    <input type="hidden" id="newshowid" value="4">
                                     <input type="hidden" id="singleprop_id" value="">

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
                            
                            
                                           <div id="otherloadmore"> </div>

                            <?php if($numrows>4)
							{?>
                            <a class="load-more-button show_more" href="javascript:void(0)">Load more <i class="fa fa-circle-o-notch"></i> </a>
                            <?php }?>
                        </div>
                        <!-- list-main-wrap end-->
                    </div>
                    <!--col-list-wrap end -->
                    <div class="limit-box fl-wrap"></div>
                    <!--section -->
             <!--       <section class="gradient-bg">
                        <div class="cirle-bg">
                            <div class="bg" data-bg="<?php echo $baseurl;?>/images/bg/circle.png"></div>
                        </div>
                        <div class="container">
                            <div class="join-wrap fl-wrap">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>Join our online community</h3>
                                        <p>Grow your marketing and be happy with your online business</p>
                                    </div>
                                    <div class="col-md-4"><a href="#" class="join-wrap-btn modal-open">Sign Up <i class="fa fa-sign-in"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </section>-->
                    <!--section end -->
                </div>
                <!--content end -->
            </div>
            <!-- wrapper end --> 
         <!--footer -->
          <!--   <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>-->
             <?php include_once("footer.php");?> 
          <script>
			  $(".image-checkbox").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-checked');
  }
  else {
    $(this).removeClass('image-checkbox-checked');
  }
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {
  $(this).toggleClass('image-checkbox-checked');
  var $checkbox = $(this).find('input[type="checkbox"]');
  $checkbox.prop("checked",!$checkbox.prop("checked"))

  e.preventDefault();
});
	</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&amp;libraries=places&amp;callback=initAutocomplete"></script>
        <script>

$('#mainsearchbar').keyup(function(e){
	 
	 
	 
	 if((e.keyCode == 8) || (e.keyCode ==32))
	 {

document.getElementById('hidsearchtype').value='';     


	 }   
	 
	 }) 
$( "#mainsearchbar" ).autocomplete({
   source: function (request, response) {
    $.ajax({
    url: baseurl+"/mainsearch.php",
      type: "GET",
      data: request,
        dataType: 'json',
		 beforeSend: function(){
		$("#loader").css("display", "block");
	 
     //$("#loader").show();

   },
       success: function (data) {
		   
 		$("#loader").hide();

       response($.map(data, function (el) {
          return {
          label: el.label,
          value: el.value,
		  id: el.id,
		  type: el.type
            };
           }));
          }
        });
  },
select:function (e, ui) {
	$('#mainsearchbar').val(ui.item.value);


$('#hidsearchtype').val(ui.item.type);     
//eventtype_idval=document.getElementById('eventtype_id').value;

//if(eventtype_idval=='2')
//{
//}





}
});
</script>
    </body>
</html>