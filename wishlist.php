<?php
ob_start();
session_start();
/*print_r($_SESSION["id"]);*/
include_once("configuration/connect.php");
include_once("configuration/functions.php");

if(!isset($_SESSION["id"]) && empty($_SESSION["id"]))
{
  header('Location: http://www.boshall.com');
  exit;
}



  $actual_urlforlogin=$domain.$_SERVER['REQUEST_URI'];


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
        
        <style>.nopad {
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
      <?php include_once("header-all-pages.php");?>
      
    


            <!--  header end -->
            <!-- wrapper --> 
            <div id="wish-page">
                <div class="content">
                    <!-- Map -->
                    
                    <!-- Map end -->
                    <!--col-list-wrap -->
                    <div class="wishlist-list">
                        <div class="listsearch-options fl-wrap" id="lisfw" >
                            
                        </div>
                        <!-- list-main-wrap-->
                        <div id="wishlist_list">
                        <div class="list-main-wrap fl-wrap card-listing">
                            
                            <div class="">
                            
                            <?php
						//echo "select * from `property_wishlist` inner join `mlspindata_master` on property_wishlist.property_id =mlspindata_master.id where `userid`='$userid'";	
							$searchquery=mysqli_query($conn,"SELECT * FROM `property_wishlist` a JOIN `mlspindata_master` b ON a.`property_id`=b.`ListingId` WHERE a.`userid`='$userid'");
							$numrows=mysqli_num_rows($searchquery);
							$prop_num=0;
							if($numrows>0)
							{
							while($resultset=mysqli_fetch_array($searchquery))
							{  
							$prop_id=$resultset['id'];
							$listid=$resultset['ListingId'];
							$city=$resultset['City'];
							$mainprop_id=$resultset['property_id'];

							 $prop_num++;
							if($city!='')
							{
								
							$city=$resultset['City'];	
							}
							$address=$city.", ".$resultset['StateOrProvince']." ".$resultset['PostalCode'];
							$sqrt1=intval($resultset['LivingArea']);
							$wishlist_val=getpropertwishlistvalue($conn,$userid,$listid);
							if($wishlist_val>0)
							{
								
							$fa_class="fa fa-heart";	
								
							}
							else
							{
								
														$fa_class="fa fa-heart-o";	
	
								
							}
							
												$imageurl=getlocationwiseImage($conn,$listid); 

							?>
                         


                                <!-- listing-item -->
                               
                                <div class="listing-item">
                                
                                       <article class="geodir-category-listing fl-wrap">
                                      <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">
                                          <div class="geodir-category-img">
                                               <img src="<?php echo $imageurl;?>" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div></a>
                                            <div class="list-post-counter" onClick="wishlist('<?php echo $listid;?>')"><span id="propertymark<?php echo $listid;?>"><i class="fa fa-close"></i></span></div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$<?php echo $resultset['ListPrice'];?></h3> 
                                                <ul class="listInline" style="min-height: 22px;">
                                                  <li><i class="fa fa-bed"></i> <?php echo ($resultset['BedroomsTotal']!="" && $resultset['BedroomsTotal']!="0") ? $resultset['BedroomsTotal'].' bd' : ' — bd'?></li>
                                                  <li><i class="fa fa-bath"></i> <?php echo ($resultset['BathroomsFull']!="" && $resultset['BathroomsFull']!="0") ? $resultset['BathroomsFull'].' ba' : ' — ba'?></li>
                                                  <li><?php echo ($sqrt1!="") ? number_format($sqrt1).' sqft'  : ' — sqft' ?></li>
                                                </ul>
                                                <div class="typeLowlight"><?php echo $resultset['StreetNumber'];?> <?php echo $resultset['StreetName'];?> <?php echo ($resultset["UnitNumber"]!="" && $resultset['UnitNumber']!='0') ? ' # '.$resultset['UnitNumber'] : ''  ?></div>
                                                <div class="typeLowlight"> <?php echo $address;?></div>
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


$( "#mainsearchbar" ).autocomplete({
   source: function (request, response) {
    $.ajax({
    url: baseurl+"/mainsearch.php",
      type: "GET",
      data: request,
        dataType: 'json',
       success: function (data) {
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