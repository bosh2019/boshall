<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
 $propertyfor=$_GET['propertyfor'];
 ?>
 <style>
 
select.bs-select-hidden, select.selectpicker {
    display: block!important;
    width: 100%;
}
      .no-gutters{ margin: 0}
      .no-gutters [class*=col-]{padding: 0 5px}
      .search-button{padding: 0;height: 44px;}
      .search-wrapper .fa-search{font-size: 19px;}
      .search-area {
    background: transparent;
    padding: 40px 0 10px;
    position: absolute;
    width: 100%;
    /* background: rgba(255,255,255,0.5); */
    top: 10%;
    z-index: 9;
          left: 50%
    transform: translateX(-50%);
}
 .search-contents {
    background: rgba(255,255,255,0.5);
    padding: 10px 10px;
    border-radius: 4px;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
}
      .search-area .form-group {
    margin-bottom: 0;
}
      .nav-tabs {
    border-bottom: 1px solid transparent;
    margin-bottom: 13px;
}
      .nav-tabs > li > a {
    line-height: 1.42857143;
    border: none;
    background: rgba(255,255,255,0.7);
    border-radius: 3px;
    font-size: 15px;
}
 /*     .nav-tabs li.active:after {
    content: "";
    border-top: 10px solid #fff;
    position: absolute;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    left: 50%;
    margin-left: -10px;
}*/
      .nav-tabs>li>a:hover {
    border-color: #eee #eee #ddd;
    background: rgba(255,255,255,0.8)!important;
}
    .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    background: #fff;
    color: #222;
    box-shadow: none !important;
    border: none !important;
} 







.label-name {
  line-height: 2em;
  vertical-align: center;
}

.input-wrap {
cursor: pointer;
   min-width: 225px;
    float: left;
    padding: 12px;
    padding-left: 12px;
    font-family: sans-serif;
    position: relative;
    user-select: none;
    background: white;
    margin-right: 5px;
    border-radius: 5px;
    transition: all 0.3s;
    border: none;
}
.input-wrap:hover {
  background: #fff6ba;
}
.input-wrap:active {
  background: #fff6ba;
}
.input-wrap label {
     padding-left: 0;
    color: #4c969c;
    width: 100%;
    transition: all 0.3s;
    font-size: 13px;
    margin-bottom: 0;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .125em;
    pointer-events: none;
}

.true-wrap, .false-wrap {
  box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
}

input[type=radio] {
  -webkit-appearance: none !important;
  outline: none !important;
  background: none;
  border: none;
  display: none;
}

.check {
  display: block;
  border: none !important;
  height: 25px;
  width: 25px;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}
.check svg .circle {
  stroke: grey;
  stroke-width: 40;
}
.check .inner {
  display: block;
  border-radius: 10%;
  height: 35px;
  width: 35px;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 5px;
  transform: translateY(-20%);
  transition: all 0.3s;
}

.wrap-h {
  float: left;
}

.wrap-h.right {
  float: right;
}

.wrap-h input[type=radio]:checked ~ .input-wrap .inner {
  opacity: 1;
  transform: translateY(-50%);
}

.wrap-h input[type=radio]:checked ~ .true-wrap {
    background: #4c959b;
    box-shadow: 0px 2px 10px #5c5c5c;
}
.wrap-h input[type=radio]:checked ~ .true-wrap label {
  color: #fff;
}
.wrap-h input[type=radio]:checked ~ .true-wrap .check svg .circle {
  stroke: #fff;
}
.wrap-h input[type=radio]:checked ~ .true-wrap .check .inner {
 fill: #fff;
    width: 20px;
    top: 20px;
    left: 2px;
}



 
    </style>
   
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                          
                                <select class="selectpicker search-fields" name="mainlocation" data-live-search="true" data-live-search-placeholder="Search value" id="mainlocation">
                                    <option value="">County *</option>
                                       <?php 
							
  	$sqlQry12=mysqli_query($conn,"select distinct `conty` from `property` where `status`='1' and `propertyfor`='$propertyfor' order by `id` desc ");
	$i=0;
	$numrows12=mysqli_num_rows($sqlQry12);
	if($numrows12>0){
	while($fetch12=mysqli_fetch_array($sqlQry12)){
	$i++;
		
				$imagepath12=getlatestpropertyimage($conn,$fetch12['id']);
				$pid=$fetch12['id'];
  ?> 
                                    <option value="<?php echo $fetch12['conty']?>" <?php if($location==$fetch12['conty']){?>selected <?php }?>><?php echo getcountynamebyid($conn,$fetch12['conty'])?></option>
                                    
                                    <?php }}?>
                                
                               </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="mainpropertytype" data-live-search="false" data-live-search-placeholder="Search value" id="mainpropertytype">
                                    <option value="">Property Type  *</option>
                                    <?php 
							
  	$sqlQry11=mysqli_query($conn,"select distinct `ptype` from `property` where `status`='1' and `propertyfor`='$propertyfor' order by `id` desc ");
	$i=0;
	$numrows11=mysqli_num_rows($sqlQry11);
	if($numrows11>0){
	while($fetch11=mysqli_fetch_array($sqlQry11)){
	$i++;
		
				$imagepath11=getlatestpropertyimage($conn,$fetch11['id']);
				$pid=$fetch11['id'];
  ?> 
                                    <option value="<?php echo $fetch11['ptype']?>" <?php if($proopertype==$fetch11['ptype']){?>selected <?php }?>><?php echo getpropertytypenamefromid($conn,$fetch11['ptype'])?></option>
     <?php }}?>                   
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="mainbedroom" id="mainbedroom" data-live-search="false" data-live-search-placeholder="Search value">
                                    <option value="">Bedroom  *</option>
                                     <?php 
							
  	$sqlQry13=mysqli_query($conn,"select * from `bedbath` where `status`='1'  order by `id` asc ");
	$i=0;
	$numrows13=mysqli_num_rows($sqlQry13);
	if($numrows13>0){
	while($fetch13=mysqli_fetch_array($sqlQry13)){
	$i++;
		
				
  ?>    
                                    <option value="<?php echo $fetch13['id']?>" <?php if($bedroom==$fetch13['id']){?>selected <?php }?>><?php echo $fetch13['name']?></option>
                                    <?php }}?>
        
                                </select>
                            </div>
                        </div>
                         <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="mainbathroom" id="mainbathroom" data-live-search="false" data-live-search-placeholder="Search value">
                                    <option value="">Bathroom  *</option>
                                  <?php
  	$sqlQry14=mysqli_query($conn,"select * from `bedbath` where `status`='1'  order by `id` asc ");
	$i=0;
	$numrows14=mysqli_num_rows($sqlQry14);
	if($numrows14>0){
	while($fetch14=mysqli_fetch_array($sqlQry14)){
	$i++;
		
				$imagepath14=getlatestpropertyimage($conn,$fetch14['id']);
				$pid=$fetch14['id'];
  ?>    
                                    <option value="<?php echo $fetch14['id']?>" <?php if($bathroom==$fetch14['id']){?>selected <?php }?>><?php echo $fetch14['name']?></option>
                                    <?php }}?>
                                </select>
                                   
                                </select>
                            </div>
                        </div>
                    