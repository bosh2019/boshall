<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");

$limit=4; 

$redirection_val='';
$pageval=1;

if(isset($_GET['page']))
{
	$pageval=$_GET['page'];
}
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

$page=1;
if($pricetype!="")
{
	$stat1="/".$pricetype;
	
}

if($maxprice!="")
{
	$stat2="/".$maxprice;
	
}

if($beds!="")
{
	$stat3="/".$beds;
	
}
if($baths!="")
{
	$stat4="/".$baths;
	
}
 

 $ur_l1="$baseurl/property/$page/$ptype/$searchterms/$type$stat1$stat2$stat3$stat4";


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



 $urlfor_filter="$baseurl/property/1/$ptype/$searchterms/$type/";
$urlreset_filter="$baseurl/property/1/$ptype/$searchterms/$type";

$actual_url="$baseurl/property/$pageval";

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
        <base href="http://s1.dkddev.com/boshall/" />
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
        height: 500px;  /* The height is 400 pixels */
        width: 95%;
        position: fixed !important;
     height: 92%;
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
</style>

        <!--=============== css  ===============-->
      <?php include_once("headernew.php");?>
      
       <input type="hidden" id="actual_url" name="actual_url" value="<?php echo $actual_url;?>">
       
       <input type="hidden" id="urlfor_filter" name="urlfor_filter" value="<?php echo $urlfor_filter;?>">
  


<div class="filter-section">
 <div class="container-fluid">
 	<div class="row">
    	<div class="col-sm-12">
        <div class="listsearch-input-wrap fl-wrap">
                                
                                   <div class="listsearch-input-item">

                                   <select  class="form-control" data-placeholder="Price" name="min_price" id="min_price" onchange="setminprice(this.value,'1')">
                                            <option selected="" value="min">No min price</option>
                                                                                    <option value="$25K">$25K</option>       
                                    
                                                                        <option value="$50k">$50k</option>       
                                    
                                                                        <option value="$75k">$75k</option>       
                                    
                                                                        <option value="$100k">$100k</option>       
                                    
                                                                        <option value="$125k">$125k</option>       
                                    
                                                                        <option value="$150k">$150k</option>       
                                    
                                                                        <option value="$175k">$175k</option>       
                                    
                                                                        <option value="$200k">$200k</option>       
                                    
                                                                        <option value="$225k">$225k</option>       
                                    
                                                                        <option value="$250k">$250k</option>       
                                    
                                                                        <option value="$275k">$275k</option>       
                                    
                                                                        <option value="$300k">$300k</option>       
                                    
                                                                        <option value="$325k">$325k</option>       
                                    
                                                                        <option value="$350k">$350k</option>       
                                    
                                                                        <option value="$375k">$375k</option>       
                                    
                                                                        <option value="$400k">$400k</option>       
                                    
                                                                        <option value="$425k">$425k</option>       
                                    
                                                                        <option value="$450k">$450k</option>       
                                    
                                                                        <option value="$475k">$475k</option>       
                                    
                                                                        <option value="$500k">$500k</option>       
                                    
                                                                        <option value="$550k">$550k</option>       
                                    
                                                                        <option value="$600k">$600k</option>       
                                    
                                                                        <option value="$650k">$650k</option>       
                                    
                                                                        <option value="$700k">$700k</option>       
                                    
                                                                        <option value="$750k">$750k</option>       
                                    
                                                                        <option value="$800k">$800k</option>       
                                    
                                                                        <option value="$850k">$850k</option>       
                                    
                                                                        <option value="$900k">$900k</option>       
                                    
                                                                        <option value="$950k">$950k</option>       
                                    
                                                                        <option value="$1M">$1M</option>       
                                    
                                                                        <option value="$1.25M">$1.25M</option>       
                                    
                                                                        <option value="$1.5M">$1.5M</option>       
                                    
                                                                        <option value="$1.75M">$1.75M</option>       
                                    
                                                                        <option value="$2M">$2M</option>       
                                    
                                                                        <option value="$2.25M">$2.25M</option>       
                                    
                                                                        <option value="$2.5M">$2.5M</option>       
                                    
                                                                        <option value="$2.75M">$2.75M</option>       
                                    
                                                                        <option value="$3M">$3M</option>       
                                    
                                                                        <option value="$3.25M">$3.25M</option>       
                                    
                                                                        <option value="$3.5M">$3.5M</option>       
                                    
                                                                        <option value="$3.75M">$3.75M</option>       
                                    
                                                                        <option value="$4M">$4M</option>       
                                    
                                                                        <option value="$4.25M">$4.25M</option>       
                                    
                                                                        <option value="$4.5M">$4.5M</option>       
                                    
                                                                        <option value="$4.75M">$4.75M</option>       
                                    
                                                                        <option value="$5M">$5M</option>       
                                    
                                                                        <option value="$6M">$6M</option>       
                                    
                                                                        <option value="$7M">$7M</option>       
                                    
                                                                        <option value="$8M">$8M</option>       
                                    
                                                                        <option value="$9M">$9M</option>       
                                    
                                                                        <option value="$10M">$10M</option>       
                                    
                                                                            </select>
                                      
                                        
                                    </div>
                                    
                                    <div class="listsearch-input-item">
                                    <select class="form-control"  data-placeholder="Price" onchange="setminprice(this.value,'2')" id="max_price">
                                                        <option value="max">No max price</option>
                                                                                                <option value="$25K">$25K</option>       
                                                
                                                                                    <option value="$50k">$50k</option>       
                                                
                                                                                    <option value="$75k">$75k</option>       
                                                
                                                                                    <option value="$100k">$100k</option>       
                                                
                                                                                    <option value="$125k">$125k</option>       
                                                
                                                                                    <option value="$150k">$150k</option>       
                                                
                                                                                    <option value="$175k">$175k</option>       
                                                
                                                                                    <option value="$200k">$200k</option>       
                                                
                                                                                    <option value="$225k">$225k</option>       
                                                
                                                                                    <option value="$250k">$250k</option>       
                                                
                                                                                    <option value="$275k">$275k</option>       
                                                
                                                                                    <option value="$300k">$300k</option>       
                                                
                                                                                    <option value="$325k">$325k</option>       
                                                
                                                                                    <option value="$350k">$350k</option>       
                                                
                                                                                    <option value="$375k">$375k</option>       
                                                
                                                                                    <option value="$400k">$400k</option>       
                                                
                                                                                    <option value="$425k">$425k</option>       
                                                
                                                                                    <option value="$450k">$450k</option>       
                                                
                                                                                    <option value="$475k">$475k</option>       
                                                
                                                                                    <option value="$500k">$500k</option>       
                                                
                                                                                    <option value="$550k">$550k</option>       
                                                
                                                                                    <option value="$600k">$600k</option>       
                                                
                                                                                    <option value="$650k">$650k</option>       
                                                
                                                                                    <option value="$700k">$700k</option>       
                                                
                                                                                    <option value="$750k">$750k</option>       
                                                
                                                                                    <option value="$800k">$800k</option>       
                                                
                                                                                    <option value="$850k">$850k</option>       
                                                
                                                                                    <option value="$900k">$900k</option>       
                                                
                                                                                    <option value="$950k">$950k</option>       
                                                
                                                                                    <option value="$1M">$1M</option>       
                                                
                                                                                    <option value="$1.25M">$1.25M</option>       
                                                
                                                                                    <option value="$1.5M">$1.5M</option>       
                                                
                                                                                    <option value="$1.75M">$1.75M</option>       
                                                
                                                                                    <option value="$2M">$2M</option>       
                                                
                                                                                    <option value="$2.25M">$2.25M</option>       
                                                
                                                                                    <option value="$2.5M">$2.5M</option>       
                                                
                                                                                    <option value="$2.75M">$2.75M</option>       
                                                
                                                                                    <option value="$3M">$3M</option>       
                                                
                                                                                    <option value="$3.25M">$3.25M</option>       
                                                
                                                                                    <option value="$3.5M">$3.5M</option>       
                                                
                                                                                    <option value="$3.75M">$3.75M</option>       
                                                
                                                                                    <option value="$4M">$4M</option>       
                                                
                                                                                    <option value="$4.25M">$4.25M</option>       
                                                
                                                                                    <option value="$4.5M">$4.5M</option>       
                                                
                                                                                    <option value="$4.75M">$4.75M</option>       
                                                
                                                                                    <option value="$5M">$5M</option>       
                                                
                                                                                    <option value="$6M">$6M</option>       
                                                
                                                                                    <option value="$7M">$7M</option>       
                                                
                                                                                    <option value="$8M">$8M</option>       
                                                
                                                                                    <option value="$9M">$9M</option>       
                                                
                                                                                    <option value="$10M">$10M</option>       
                                                
                                                                                        </select>
                                                    
                                    </div>

                                         <div class="listsearch-input-item">
                                            <select class="form-control"  name="country" onchange="setminprice(this.value,'3')" id="beds">
                <option value="beds">Beds</option>
                                <option value="1">1</option>
                
                                <option value="2">2</option>
                
                                <option value="3">3</option>
                
                                <option value="4">4</option>
                
                                <option value="5">5</option>
                
                                <option value="6">6</option>
                
                                <option value="7">7</option>
                
                                <option value="8">8</option>
                
                                <option value="9">9</option>
                
                                <option value="10">10</option>
                
                               </select>
											</div>
									<div class="listsearch-input-item">
                                            <select class="form-control" name="country" id="baths" onchange="setminprice(this.value,'4')">
                <option value="baths">Baths</option>
                                <option value="1">1</option>
                
                                <option value="2">2</option>
                
                                <option value="3">3</option>
                
                                <option value="4">4</option>
                
                                <option value="5">5</option>
                
                                <option value="6">6</option>
                
                                <option value="7">7</option>
                
                                <option value="8">8</option>
                
                                <option value="9">9</option>
                
                                <option value="10">10</option>
                
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
                             <div class="col-sm-12"><h3>New York Mills NY Real Estate & Homes For Sale</h3></div>
                             <div class="col-sm-6"><p>261 results</p></div>
                             <div class="col-sm-6 text-right"><div class="col-sm-4"><strong class="short">Sort by:</strong></div> <div class="col-sm-8"> <select class="form-control" id="exampleFormControlSelect1">
      <option>Home for you</option>
      <option>Price (High to Low)</option>
      <option>Price (Low to High)</option>
      <option>Newest</option>
      <option>Bedrooms</option>
      <option>Bathrooms</option>
      <option>SquarFeet</option>
    </select></div> </div>
                                <!-- listsearch-input-wrap  -->
                                <div class="listsearch-input-wrap fl-wrap" style="display:none">
                                
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
                            
                            <div class="listing-wraper">
                            
                            <?php
							
							
		//	echo "select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery";				 
$searchquerys=mysqli_query($conn,"select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery");
							 $numrows=mysqli_num_rows($searchquerys);
							$prop_num=0;
							
							$start_from = ($pageval-1) * $limit;  
//echo "select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery LIMIT $start_from, $limit";
$searchquery=mysqli_query($conn,"select * from `mlspindata_master` where $whereclause and $query_ext $tableq $maxquery $bathsquery $bedsquery limit $start_from, $limit");

							if($numrows>0)
							{
							    $i=1;
							while($resultset=mysqli_fetch_array($searchquery))
							{
							    $latlng[] = "lat:".$resultset['Latitude'].', lng:'.$resultset['Longitude'];
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
                               
                                <div class="listing-item" >
                                
                                       <article class="geodir-category-listing fl-wrap">
                                       
                                       <div class="list-card-variable-text">6 days on Boshall</div>
                                      <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">    <div class="geodir-category-img" id="goto_<?= $i;?>">
                                               <img src="<?php echo $imageurl;?>" alt=""> 
                                                <div class="overlay"></div>
                                              
                                            </div></a>
                                            <div class="list-post-counter" onClick="wishlist('<?php echo $prop_id;?>')"><span id="propertymark<?php echo $prop_id;?>"><i class="<?php echo $fa_class;?>"></i></span></div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$<?php echo $resultset['ListPrice'];?> <ul class="listInline" style="min-height: 22px;">
                    <li><i class="fa fa-bed"></i> 3bd</li>
                    <li><i class="fa fa-bath"></i>2ba</li>
                    <li>1,168sqft</li>
                  </ul></h3>
                                              <!--  <p><?php echo limitContent($conn,$resultset['PublicRemarks'],50);?></p>-->
                                              <p><?php echo $address;?></p>
                                              <p>House for Sale</p>
                                               <!-- <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><i class="fa fa-map-marker" aria-hidden="true"></i> </div>
                                                </div>-->
                                            </div>
                                        </article>
                                    </div>
                                    
                                    <?php } $i++; } } else{?>
                                    
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

                           <!-- <?php if($numrows>4)
							{?>
                            <a class="load-more-button show_more" href="javascript:void(0)">Load more <i class="fa fa-circle-o-notch"></i> </a>
                            <?php }?>-->
                        </div>
                        
                        <div class="pagination">
                        <?php 
						
						$total_pages = ceil($numrows / $limit); 

for ($i=1; $i<=$total_pages; $i++) {
	
	$page=$i;
	                         $pagelink_for="$baseurl/property/$page/$ptype/$searchterms/$type$stat1$stat2$stat3$stat4";

	
	if($i==$pageval)
	{
		$add_class="current-page";
		
	}
	else
	{
				$add_class="";

		
	}
	?>
                                            <a href="<?php echo $pagelink_for;?>" class="<?php echo $add_class;?>"><?php echo $page;?></a>
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
         <div class="listing-footer">    <?php include_once("footer.php");?> </div>
             <!--Google Maps start=====================-->
                <script src="js/modernizr.js"></script>
                <script>
                            var map,
                            desktopScreen = Modernizr.mq( "only screen and (max-width:1024px)" ),
                            zoom = desktopScreen ? 11 : 11,
                            scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
                            isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/));
                            function initMap() 
                            {
                      
               
                                        var myLatLng = {<?= $latlng[0];?>};
                                        map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: zoom,
                                            center: myLatLng,
                                            mapTypeId: google.maps.MapTypeId.TERRAIN,
                                            scrollwheel: scrollable,
                                            draggable: draggable,
                                        
                                            styles: [{"stylers": [{ "saturation": 10 }]}]
                                        });
                                        
                                        
                                        /*marker array*/
                                      var locations = [
                                                <?php
                                                $i=1;
                                                foreach($latlng as $latitudes):
                                                ?>
                                                 {
                                                    title: 'boshall<?php echo $i; ?>',
                                                    position: {<?= $latitudes;?>},
                                                    icon: {url: isIE11 ? "<?php echo $baseurl;?>/images/dot.png" : "<?php echo $baseurl;?>/images/dot.png",scaledSize: new google.maps.Size(15, 15),
                                                    
                                                    },
                                                    url:"#goto_<?=$i;?>",
                                                    contentString:'<h4 class="firstHeading">Property<?= $i; ?></h4>'
                            
                                                },
                                             <?php $i++;endforeach;?>
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
                                
                                if (screen.width > 800){
                                    $('#map').mouseout(function(){
                                        $('.geodir-category-listing').removeClass('highlight highlight-fade')
                                    });
                                    marker.addListener('mouseover', function() {
										 $('.geodir-category-listing').removeClass('highlight highlight-fade')
                                      infowindow.open(map, marker);
                                      var target = $(marker.url);
            
                                                $('html, body').stop().animate({
                                                    scrollTop: target.offset().top-80
                                                }, 1500);
												
												$('.geodir-category-listing').addClass('highlight-fade')
												$(element.url).parents('.geodir-category-listing').addClass('highlight')
												
                                    });
                                    marker.addListener('mouseout', function() {
                                      infowindow.close(map, marker);
                                    });
                                }
                                
                                if (screen.width < 800){
            
                                marker.addListener('click', function() {
                                      infowindow.open(map, marker);
                                         $('.geodir-category-img').removeClass('highlight')        
                                         var target = $(marker.url);
            
                                                $('html, body').animate({
                                                    scrollTop: target.offset().top-80
                                                }, 1500);
												$(element.url).addClass('highlight')
                                                
                                    });
                                     
                                    
                                    }
                                
                            }); 
                            }/*end initmap*/
                </script>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1V5snT00sU2-Ix88PcJosqxvkXjSTq9w&callback=initMap&libraries=places" async="" defer=""></script>
             <!--Google Maps end=======================-->
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