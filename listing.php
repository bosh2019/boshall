<?php
ob_start();
session_start();
error_reporting(1);
include_once("configuration/connect.php");
include_once("configuration/functions.php");
$limit=12;
$redirection_val='';
$actual_urlforlogin=$domain.$_SERVER['REQUEST_URI'];
if(isset($_GET['page']) && $_GET['page'] != "")
{
    $page = $_GET['page'];
    $offset = $limit * ($page-1);
} 
else 
{
    $page = 1;
    $offset = 0;
}
if(isset($_GET['type']))
{  
	
	 $type=$_GET['type'];//1- city,2-zip,3-street address
	
	 $ptype=$_GET['ptype'];//rent or buy
	 $searchterms=$_GET['searchtype'];
	$searchterm=trim(backstrreplace($conn,$searchterms));
	 	 //$searchterm=trim($searchterms);

	if($ptype=="rent")
	{
		$showproptype = "House For Rent";
		$whereclause="WHERE `PropertyType`='Rental'";
	}
	else
	{
		$showproptype = "House For Sale";
		$whereclause = "WHERE `PropertyType`!='Rental'";
	}

	switch($type)
	{
		case '1':
		   $whereclause .=" AND `City` LIKE '%$searchterm%'";
       $name= $searchterm;
		break;

		case '2':
		   $whereclause .= " AND `PostalCode` LIKE '%$searchterm%'";
       $name= $searchterm;
		break;

		case '3':
		
		  $whereclause .= " AND `Address` like '%$searchterm%'";
      $name= $searchterm;
		break;

		default:
		  $whereclause .=" AND 1"; 
		break;
	}
/*get city name*/

$city_name=getCityNameByNamePincodeStreetname($conn,$name,$ptype);

/*get city name*/

if(isset($_POST['min_price']))
{

	$minprice = $_POST['min_price'];
	$maxprice=$_POST['max_price'];
	$beds=$_POST['beds'];
	$baths=$_POST['baths'];
	$other = $_POST['other'];
	 $ur_l1="$baseurl/property/$ptype/$searchterms/$type/$minprice/$maxprice/$beds/$baths/$other";
	
	  if($maxprice != 0):
	      $whereclause .= " AND `ListPrice` BETWEEN $minprice AND $maxprice";
	  endif;
	  if($beds!= 0):
	  	  $whereclause .= " AND CAST(`BedroomsTotal` AS UNSIGNED) ='$beds'";
	  endif;
	  if($baths!= 0):
	  	 $whereclause .= " AND CAST(`BathroomsFull` AS UNSIGNED) ='$baths'";
	  endif;
           $other_filter = explode("_",$other);
            switch($other_filter[1])
           	{
                 case 'desc':
                     $order_by = "ORDER BY `ListPrice` DESC";
                 break;

                 case 'asc':
                    $order_by = "ORDER BY `ListPrice` ASC";
                 break;

                 case 'hometype':
                   $order_by = "ORDER BY `hometype` DESC";
                 break;

                 case 'BedroomsTotal':
                    $order_by = "ORDER BY CAST(`BedroomsTotal` AS UNSIGNED) ASC";
                 break;

                 case 'BathroomsFull':
                    $order_by = "ORDER BY CAST(`BathroomsFull` AS UNSIGNED) ASC";
                 break;

                 case 'LotSizeSquareFeet':
                    $order_by = "ORDER BY CAST(`LotSizeSquareFeet` AS UNSIGNED)  ASC";
                 break;

                 default:
                    $order_by = "ORDER BY `ListPrice` ASC";
                 break;
                 
           	}
	   /*get latlon data*/
        $sql_latlon="SELECT `ListingId` FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC";
        $resultlatlon=$conn->query($sql_latlon);
        if($resultlatlon->num_rows>0)
        {
          while ($rowlatlon=$resultlatlon->fetch_assoc()) {
            $latlng[] = $rowlatlon;
          }

        }
     /*end latlon data*/
    $sql_count = "SELECT COUNT(*) as `total_rows` FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC";
    $res = mysqli_fetch_object(mysqli_query($conn, $sql_count));
    $total_rows = $res->total_rows;

	$sql = "SELECT * FROM `mlspindata_master` $whereclause $order_by LIMIT $offset, $limit";
}

elseif(isset($_GET['min_price']))
{
    $minprice = $_GET['min_price'];
	$maxprice=$_GET['max_price'];
	$beds=$_GET['beds'];
	$baths=$_GET['baths'];
	$other = $_GET['other'];
    $ur_l1="$baseurl/property/$ptype/$searchterms/$type/$minprice/$maxprice/$beds/$baths/$other";
   
   if($maxprice != 0):
          $whereclause .= " AND `ListPrice` BETWEEN $minprice AND $maxprice";
      endif;
      if($beds!= 0):
          $whereclause .= " AND CAST(`BedroomsTotal` AS UNSIGNED) ='$beds'";
      endif;
      if($baths!= 0):
         $whereclause .= " AND CAST(`BathroomsFull` AS UNSIGNED) ='$baths'";
      endif;
	 
           $other_filter = explode("_",$other);
           switch($other_filter[1])
           	{
                 case 'desc':
                     $order_by = "ORDER BY `ListPrice` DESC";
                 break;

                 case 'asc':
                    $order_by = "ORDER BY `ListPrice` ASC";
                 break;

                 case 'hometype':
                   $order_by = "ORDER BY `hometype` DESC";
                 break;

                 case 'BedroomsTotal':
                    $order_by = "ORDER BY CAST(`BedroomsTotal` AS UNSIGNED) ASC";
                 break;

                 case 'BathroomsFull':
                    $order_by = "ORDER BY CAST(`BathroomsFull` AS UNSIGNED) ASC";
                 break;

                 case 'LotSizeSquareFeet':
                    $order_by = "ORDER BY CAST(`LotSizeSquareFeet` AS UNSIGNED)  ASC";
                 break;

                 default:
                    $order_by = "ORDER BY `ListPrice` ASC";
                 break;
                 
           	}
  /*get latlon data*/
        $sql_latlon="SELECT `ListingId` FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC";
        $resultlatlon=$conn->query($sql_latlon);
        if($resultlatlon->num_rows>0)
        {
          while ($rowlatlon=$resultlatlon->fetch_assoc()) {
            $latlng[] = $rowlatlon;
          }
          
        }
     /*end latlon data*/
	$sql_count = "SELECT COUNT(*) as `total_rows` FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC";
    $res = mysqli_fetch_object(mysqli_query($conn, $sql_count));
    $total_rows = $res->total_rows;

	$sql = "SELECT * FROM `mlspindata_master` $whereclause $order_by LIMIT $offset, $limit";
}
else
{
	$ur_l1="$baseurl/property/$ptype/$searchterms/$type";
	/*get latlon data*/
        $sql_latlon="SELECT `ListingId` FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC";
        $resultlatlon=$conn->query($sql_latlon);
        if($resultlatlon->num_rows>0)
        {
          while ($rowlatlon=$resultlatlon->fetch_assoc()) {
            $latlng[] = $rowlatlon;
          }
          
        }
     /*end latlon data*/
	$sql_count = "SELECT COUNT(*) as `total_rows` FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC";
    $res = mysqli_fetch_object(mysqli_query($conn, $sql_count));
    $total_rows = $res->total_rows;

	$sql = "SELECT * FROM `mlspindata_master` $whereclause ORDER BY `ListPrice` ASC LIMIT $offset, $limit"; 
}
    

}
	

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
        <base href="http://s1.dkddev.com/boshall/" />
        <script>
	       window.history.replaceState(null, null, "<?= $ur_l1;?>");
         </script>
        <style>
/*
	.highlight{
	border: 2px solid #54bbfe;
    padding: 10px;
    display: inline-block;
    width: 100%;
    border-radius: 7px;
	}
*/
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
}
.geodir-category-listing.fl-wrap.highlight-fade.highlight {
    opacity: 1;
    box-shadow: 0 0 7px 2px rgba(0,0,0,0.2);
}
.geodir-category-listing.fl-wrap.highlight-fade {
    opacity: 0.4;
}
.card-listing .geodir-category-listing {
    transition: all 1s ease;
}           
 #map {
       /* height: 500px; */ /* The height is 400 pixels */
        width:100%;
        position: fixed !important;
     height: 100%;
       }
.listing-wraper{    
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    flex-wrap: wrap;} 
.listing-item {
    float: none;
    width: 50%;
    padding: 0 8px;
    margin-bottom: 12px;
    max-width: 50%;
}            
			#goto_2:hover img
			{
				
			}
.listing-map
{
	width:200px!important;
}
.listing-map img {
    width: 100%;
    height: 150px;
}
.listing-map .listing-item {
    width: 100%!important;
    display: contents;
}
.listing-map h3 {
    font-size: 17px;
    margin: 8px 0;
}

.listing-map h3 .geodir-category-content .listInline {
    padding-left: 0;
}

.listing-map .geodir-category-content p {
    margin: 0;
    padding-bottom: 0;
    font-size: 12px!important;
    font-weight: 400;
    line-height: 17px;
}
.listing-map .list-post-counter {
    display: none;
}
</style>

        <!--=============== css  ===============-->
      <?php include_once("headernew.php");?>
      
       
  


<div class="filter-section">
 <div class="container-fluid">
 	<div class="row">
    	<div class="col-sm-12">
        <div class="listsearch-input-wrap fl-wrap">
          <form name="search_form" id="search_form" method="post">                      
           <div class="listsearch-input-item">
          
            <select  class="form-control" data-placeholder="Price" name="min_price" id="min_price" onchange="this.form.submit();">
                     
               <option <?php if($pricetype==""){?> selected<?php }?> value="0">No min price</option>
               <?php 
				  $selquery=mysqli_query($conn,"SELECT * FROM `pricerange` ORDER BY `value` ASC");
				  while($results=mysqli_fetch_array($selquery))
				  {

					
					$amt=$results['value'];    
			    ?>
                   <option value="<?php echo $results['value'];?>" <?php if($minprice==$amt){?>selected<?php }?>><?php echo trim($results['amount']);?></option>    
                <?php }?>
               
           </select>
                                      
                                        
          </div>
                                    
		    <div class="listsearch-input-item">
		        <select class="form-control"  data-placeholder="Price" name="max_price" id="max_price" onchange="this.form.submit();">
		        	<?php
                        if($ptype=="rent")
                        {
                            $maxwhereclause="WHERE `PropertyType`='Rental'";
                        }
                        else
                        {
                            $maxwhereclause = "WHERE `PropertyType`!='Rental'";
                        }
		        	  $max_price = "SELECT MAX(`ListPrice`) AS MAXAMOUNT FROM `mlspindata_master` $maxwhereclause";
		        	  $run = $conn->query($max_price);
                      $maxamount = $run->fetch_assoc()
		        	?>
		                <option value="<?= $maxamount['MAXAMOUNT'];?>">No max price</option>
		                <?php 
                           if($minprice != 0):
                              $selquery=mysqli_query($conn,"SELECT * FROM `pricerange` WHERE `value` > '$minprice' ORDER BY `value` ASC");
                           else:
							$selquery=mysqli_query($conn,"SELECT * FROM `pricerange` WHERE `value` > '25000' ORDER BY `value` ASC");
                           endif;
							while($results=mysqli_fetch_array($selquery))
							{
								
								$amt=$results['value'];    

					    ?>
			                 <option value="<?php echo $results['value'];?>" <?php if($maxprice==$amt){?>selected<?php }?>><?php echo trim($results['amount']);?></option>       
			                        
			           <?php }?>                    

		                                                
		         </select>
		                                                    
		    </div>

		    <div class="listsearch-input-item">
		        <select class="form-control"  name="beds" id="beds" onchange="this.form.submit();">
		                <option value="0">Beds</option>
		                <?php 
						
						for($bed=1;$bed<=10;$bed++)   
						{
						
						?>
		                <option value="<?php echo $bed;?>" <?php if($bed==$beds){?>selected<?php }?>><?php echo $bed;?></option>
		                
		                <?php }?>               
		                
		        </select>
			</div>
			<div class="listsearch-input-item">
		        <select class="form-control" name="baths" id="baths"  onchange="this.form.submit();">
		                <option value="0">Baths</option>
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
    </div>
 </div> 
</div>
            <!--  header end -->
            <!-- wrapper -->
            <div id="wrapper">
                <div class="content">
                    <!-- Map -->
                    <div class="map-container column-map left-pos-map">
                        
                        <div id="map" ></div>
        
                    </div>
                    <!-- Map end -->
                    <!--col-list-wrap -->
                    <div class="col-list-wrap right-list">
                        <div class="listsearch-options fl-wrap" id="lisfw" >
                            <div class="">
                             <div class="col-sm-12"><h3 style="margin-bottom: 33px;"><span style="color:#4db7fe;"><?= $city_name["City"]; ?></span> Real Estate & <?= $showproptype;?></h3></div>
                             <div class="col-sm-6"><p ><?= $total_rows;?> results</p></div>
                             <div class="col-sm-6 text-right"><div class="col-sm-4"><strong class="short">Sort by:</strong></div> <div class="col-sm-8"> 
                             	<select class="form-control" name="other" id="other" onchange="this.form.submit();">
                                    <?php
                                       $other_filter = explode("_",$other);
                                    ?>
								      <option value="price_hfu" <?= ($other_filter[1]=="hfu") ? 'selected': '';?>>Home for you</option>
								      <option value="price_desc" <?= ($other_filter[1]=="desc") ? 'selected': '';?>>Price (High to Low)</option>
								      <option value="price_asc" <?= ($other_filter[1]=="asc") ? 'selected': '';?>>Price (Low to High)</option>
								      <option value="newest_hometype" <?= ($other_filter[1]=="hometype") ? 'selected': '';?>>Newest</option>
								      <option value="beds_BedroomsTotal" <?= ($other_filter[1]=="BedroomsTotal") ? 'selected': '';?>>Bedrooms</option>
								      <option value="bathrooms_BathroomsFull" <?= ($other_filter[1]=="BathroomsFull") ? 'selected': '';?>>Bathrooms</option>
								      <option value="squareft_LotSizeSquareFeet" <?= ($other_filter[1]=="LotSizeSquareFeet") ? 'selected': '';?>>SquarFeet</option>
								    </select>
                               </div> 
                            </div>
                            
                             </div>
                               </form>   
                        </div>
                        
                            
                           
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing pt-0">
                            
                            <div class="listing-wraper">
                        
                        <?php
						//echo $sql;
                            //All Data Start
                            $allresults = $conn->query($sql);
                            if($allresults->num_rows > 0):
                                $total_count = $allresults->num_rows;
                                $i=1;
                                while($resultset = $allresults->fetch_assoc()):
                                       /*$latlng[] = "lat:".$resultset['Latitude'].', lng:'.$resultset['Longitude'];*/
                                       $prop_id=$resultset['id'];
                                       $listid=$resultset['ListingId'];
                                       $city=$resultset['city'];
                             
                                        $prop_num++;
                                        if($city!='')
                                        {
                                          $city=",".$resultset['city'];   
                                        }

                                 $address=$resultset['StreetName']." ".$city.$resultset['CountyOrParish'];
                            
                                $wishlist_val=getpropertwishlistvalue($conn,$userid,$listid);
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
                                    } 
                                    else
                                    {
                                         $fa_class="fa fa-heart-o";  
                                    }
                                 $imageurl=getlocationwiseImage($conn,$listid);
								 
                    if($resultset['LivingArea']!="")
                    {

                      
                      $fisrt_str1=number_format(intval($resultset['LivingArea']));  

                        if($fisrt_str1==0)
                        {
                        $fisrt_str1=" —"; 


                        }
                    }
                    else
                    {
                    $fisrt_str1=" —"; 

                    }
 
   $city=$resultset['City'];
		  
		   		   $price=$resultset['ListPrice']; 
  if($resultset['PostalCode']!="")
				   {
					 $zipcode=" ".$resultset['PostalCode'];  
					   
				   }
							$address=$city.", ".$resultset['StateOrProvince'].$zipcode;	
                            ?>
                                <!-- listing-item -->
                               
                                <div class="listing-item" >
                                
                                       <article class="geodir-category-listing fl-wrap">
                                        <?php
                                           $NewDate = date('M j, Y', strtotime($resultset['list_date']));
                                            $diff = date_diff(date_create($NewDate),date_create(date("M j, Y")));
                                            
                                        ?>
                                         <div class="list-card-variable-text"><?= $diff->format('%a');?> days on Boshall</div>
	                                      <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">    
	                                      	<div class="geodir-category-img" id="goto_<?= $i;?>">
	                                               <img src="<?php echo $imageurl;?>" alt=""> 
	                                                <div class="overlay"></div>
	                                              
	                                         </div>
	                                      </a>
                                            <div class="list-post-counter" onClick="wishlist('<?php echo $listid;?>')">
                                       	      <span id="propertymark<?php echo $listid;?>"><i class="<?php echo $fa_class;?>"></i></span>
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$<?php echo number_format($resultset['ListPrice']);?></h3>
                                                	<ul class="listInline" style="min-height: 22px;">
									                    <li><i class="fa fa-bed"></i> <?= ($resultset['BedroomsTotal'] != "" && $resultset['BedroomsTotal']!=0) ? $resultset['BedroomsTotal']." bd" : ' — bd';?></li>
									                    <li><i class="fa fa-bath"></i> <?= ($resultset['BathroomsFull'] !="" && $resultset['BathroomsFull']!=0) ? $resultset['BathroomsFull']." ba" : ' — ba';?></li>
									                    <li><?= $fisrt_str1;?> sqft</li>
                                                     </ul>
                                                </h3>
                                              <p><?php echo $resultset['StreetNumber'];?> <?php echo $resultset['StreetName']?> <?php echo ($resultset["UnitNumber"]!="" && $resultset['UnitNumber']!='0') ? ' # '.$resultset['UnitNumber'] : ''  ?></p>
                                                <p><?php echo $address;?></p>
                                              <p><?= $showproptype;?></p>
                                              
                                            </div>
                                        </article>
                                </div>
                               <!-- listing-item end -->
                             <?php
                               $i++;
                               endwhile;
                               else:
                                 echo '<p>No result found!!!</p>';
                            endif;
                            ?>  
                           <input type="hidden" id="singleprop_id" value="">
                            </div>
                            
                          
                           <!-- Pagination -->
                        <?php
                               
                              $adjacents = 2;
                                   $total_pages = ceil($total_rows / $limit);
                              //Here we generates the range of the page numbers which will display.
                              if($total_pages <= (1+($adjacents * 2))) {
                                $start = 1;
                                $end   = $total_pages;
                              } else {
                                if(($page - $adjacents) > 1) { 
                                  if(($page + $adjacents) < $total_pages) { 
                                    $start = ($page - $adjacents);            
                                    $end   = ($page + $adjacents);         
                                  } else {             
                                    $start = ($total_pages - (1+($adjacents*2)));  
                                    $end   = $total_pages;               
                                  }
                                } else {               
                                  $start = 1;                                
                                  $end   = (1+($adjacents * 2));             
                                }
                              }

                                  
                        ?>
                        <?php if($total_pages > 1) { ?>
                        <div class="pagination">
                          <ul class="pagination pagination-sm justify-content-center">
                            <!-- Link of the first page -->
                            <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
                              <a class='page-link' href='<?= $ur_l1.'/1';?>'><i class="fa fa-step-backward"></i></a>
                            </li>
                            <!-- Link of the previous page -->
                            <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
                                <?php
                                  $page_prev = ($page>1 )? ($page-1) : '1';
                                ?>
                              <a class='page-link' href='<?= $ur_l1.'/'.$page_prev;?>'><i class="fa fa-angle-left"></i></a>
                            </li>
                            <!-- Links of the pages with page number -->
                            <?php for($i=$start; $i<=$end; $i++) { ?>
                            <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
                              <a class='page-link' href='<?= $ur_l1.'/'.$i;?>'><?php print $i;?></a>
                            </li>
                            <?php } ?>
                            <!-- Link of the next page -->
                            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
                                <?php
                                  $page_next = ($page < $total_pages) ? ($page+1) : $total_pages;
                                ?>
                              <a class='page-link' href='<?= $ur_l1.'/'.$page_next;?>'><i class="fa fa-angle-right"></i></a>
                            </li>
                            <!-- Link of the last page -->
                            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
                              <a class='page-link' href='<?= $ur_l1.'/'.$total_pages;?>'><i class="fa fa-step-forward"></i></a>
                            </li>
                          </ul>
                       </div>
                       <?php } ?>
                   <!-- Pagination -->
                   
                   
                        </div>
                        
                       </div> 
                  
                        <!-- list-main-wrap end-->
                        
                        
                    </div>
                    <!--col-list-wrap end -->
                    <div class="limit-box fl-wrap"></div>
                    <!--section -->
             
                </div>
                <!--content end -->
            </div>
            <!-- wrapper end --> 
         <!--footer -->
         <div class="listing-footer">    <?php include_once("footer.php");?> </div>
             <!--Google Maps start=====================-->
                <script src="js/modernizr.js"></script>
                <script>
                            var map,
                            desktopScreen = Modernizr.mq( "only screen and (max-width:1024px)" ),
                            zoom = desktopScreen ? 12 : 12,
                            scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
                            isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/));
                            function initMap() 
                            { 
                                      /* get center map*/
                                  var bounds = new google.maps.LatLngBounds();
                                  var polygonCoords=[
                                  <?php foreach ($latlng as $value): 

                                    $center_lat=getpropertDetailsFromListId2($conn,$value["ListingId"]);
                                    ?>

                                    new google.maps.LatLng(<?= $center_lat["Latitude"];?>,<?= $center_lat["Longitude"];?>),

                                      <?php endforeach ?> 
];

                                      for (i = 0; i < polygonCoords.length; i++) {
                                      bounds.extend(polygonCoords[i]);
                                      }
                                      var str=bounds.getCenter();
                                      var rrr=str.toString().replace(/[{()}]/g, '');
                                      var split_data=rrr.split(",");
                                      /*var myLatLng="lat:"+split_data[0]+",lng:"+split_data[1];*/
                                      //alert(myLatLng);
                                
                                        /*end get center map*/
                                      <?php 
                                        $current_latlng=getpropertDetailsFromListId2($conn,$latlng[0]["ListingId"]);
                                        ?>
                                        var myLatLng = {lat: +split_data[0] ,lng: +split_data[1] };
                                        map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: zoom,
                                            center: myLatLng,
                                            mapTypeId: google.maps.MapTypeId.TERRAIN,
                                            scrollwheel: scrollable,
                                            draggable: draggable,
                                            disableDefaultUI: true,
                                        
                                            styles: [{"stylers": [{ "saturation": 10 }]}]
                                        });
                                        
                                        
                                        /*marker array*/
                                      var locations = [
                                                <?php
                                                $i=1;
                                                foreach($latlng as $latitudes):
                                                  $array_latlng=getpropertDetailsFromListId2($conn,$latitudes["ListingId"]);
                                                  $NewDate = date('M j, Y', strtotime($array_latlng['list_date']));
                                                  $diff = date_diff(date_create($NewDate),date_create(date("M j, Y")));            
                                                  if($array_latlng['LivingArea']!="")
                                                  {


                                                  $fisrt_str12=number_format(intval($array_latlng['LivingArea']));  

                                                  if($fisrt_str12==0)
                                                  {
                                                  $fisrt_str12=" —"; 


                                                  }
                                                  }
                                                  else
                                                  {
                                                  $fisrt_str12=" —"; 

                                                  }                                                        
                                                ?>
                                                 {
                                                    title: '',
                                                    position: {lat:<?= $array_latlng["Latitude"];?>,lng:<?= $array_latlng["Longitude"];?>},
                                                    icon: {url: isIE11 ? "<?php echo $baseurl;?>/images/dot.png" : "<?php echo $baseurl;?>/images/dot.png",scaledSize: new google.maps.Size(15, 15),
                                                    
                                                    },
                                                    url:"#goto_<?=$i;?>",
                                                    contentString:'<div class="listing-map"><div class="listing-item"><article class="fl-wrap">                                          <div class="list-card-variable-text"><?= $diff->format('%a');?> days on Boshall</div><a href="<?php echo $baseurl;?>/property/<?php echo $array_latlng['ListingId'];?>"><div class="geodir-category-img"  id="goto_<?=$i;?>">             <img src="<?php echo getlocationwiseImage($conn,$array_latlng['ListingId']);?>" alt="">                                        <div class="overlay"></div></div>                                         </a><div class="geodir-category-content fl-wrap">                                                 <h3>$<?php echo number_format($array_latlng['ListPrice']);?>                                                  <ul class="listInline" style="min-height: 22px;">                                       <li><i class="fa fa-bed"></i> <?= ($array_latlng['BedroomsTotal'] != ""&& $array_latlng['BedroomsTotal'] !=0) ? $array_latlng['BedroomsTotal']." bd" : ' - bd';?></li>                                       <li><i class="fa fa-bath"></i> <?= ($array_latlng['BathroomsFull'] !="" && $array_latlng['BathroomsFull'] !=0) ? $array_latlng['BathroomsFull']." ba" : ' - ba';?></li>                                       <li><?= $fisrt_str12 ;?> sqft</li>                                                      </ul>                                                 </h3>                                               <p><?php echo $array_latlng['StreetNumber'];?> <?php echo preg_replace('/[^a-zA-Z0-9_  %\[\]\.\(\)%&-]/s', '', $array_latlng['StreetName']);?> <?php echo ($array_latlng["UnitNumber"]!="" && $array_latlng['UnitNumber']!='0') ? ' # '.$array_latlng['UnitNumber'] : ''  ?> </p>                                                 <p><?php echo $array_latlng['City'].", ".$array_latlng['StateOrProvince']." ".$array_latlng['PostalCode'];?></p>                                               <p><?= $showproptype;?></p>                                                                                           </div></article></div></div>'
                            
                                                },
                                             <?php $i++; endforeach;?>
                                        ];
                                        
                                        /*end marker array*/
                                        
                                        /*start loop location marker*/
                                        
                                locations.forEach( function( element, index ){  
								
                                var marker = new google.maps.Marker({
                                    position: element.position,
                                    map: map,
                                    title: element.title,
                                    icon: element.icon,
                                    url:  element.url,
                                    
                                });
								
                                var infowindow = new google.maps.InfoWindow({
                                  content: element.contentString
                                });
                                
                                if (screen.width < 800){
                                            $('#map').mouseout(function(){
                                        $('.geodir-category-listing').removeClass('highlight highlight-fade')
                                    });
                                    marker.addListener('click', function() {
                     $('.geodir-category-listing').removeClass('highlight highlight-fade')
                                      infowindow.open(map, marker);
                                      var target = $(marker.url);
            
                                                $('html, body').stop().animate({
                                                    scrollTop: target.offset().top-80
                                                }, 1500);
                        
                        $('.geodir-category-listing').addClass('highlight-fade')
                        $(element.url).parents('.geodir-category-listing').addClass('highlight')
                        
                                    });
                                }
                                
                                if (screen.width > 800){
                                    $('#map').mouseout(function(){
                                        $('.geodir-category-listing').removeClass('highlight highlight-fade')
                                    });
                                    marker.addListener('click', function() {
                     $('.geodir-category-listing').removeClass('highlight highlight-fade')
                                      infowindow.open(map, marker);
                                      var target = $(marker.url);
            
                                                $('html, body').stop().animate({
                                                    scrollTop: target.offset().top-80
                                                }, 1500);
                        
                        $('.geodir-category-listing').addClass('highlight-fade')
                        $(element.url).parents('.geodir-category-listing').addClass('highlight')
                        
                                    });
                                    
                                }
                                
                            }); 
                            }/*end initmap*/
                </script>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1V5snT00sU2-Ix88PcJosqxvkXjSTq9w&callback=initMap&libraries=places" async="" defer=""></script>
             <!--Google Maps end=======================-->
          <script>
              <?php
                if(isset($total_count)):
              ?>
                $("#total_count").text("<?= $total_count;?> results");
              <?php
                endif;?>
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
 $('#hidsearchtype_val').val(data[0].value);
        $('#hidsearchtype').val(data[0].type);
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