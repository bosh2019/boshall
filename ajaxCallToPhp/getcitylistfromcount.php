<?php
 ob_start();
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
  $id=$_GET['id'];
 $selQry=mysqli_query($conn,"select * from `city` where `cid`='$id'  and `status` = '1'");
 $numRows=mysqli_num_rows($selQry);?>
 	<select name="city" id="city" class="form-control "  onchange="setcityvalue
    (this.value)">

 <?php if($numRows>0){?>
		<option value="">City</option>
		<?php
        while($fetch=mysqli_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['id']; ?>"><?php echo ucfirst(strtolower($fetch['name'])); ?></option> 
		<?php }	}else{?>
 		<option value="0">No City</option> 
		 <?php }?>
	</select>