<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
$home_image=gethomebannerSingleImage($conn);




if(isset($_POST['property_search']))
{
	
extract($_POST);

 $prop_type=strtolower($prop_type);

$searchtype=strtolower(strreplace($conn,$searchtype));



$urls="property/$prop_type/$searchtype/$hidsearchtype/1";

header("location:$urls");
	
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
<!--=============== css  ===============-->

<style>
#loader {
	position: absolute;
	top: 30%;
	right: 16px;
}

.banner-inner {
    background: #fff;
    padding: 60px 130px;
    width: 700px;
    margin: 0 auto;
    border: 1px solid #ccc;
    box-shadow: 0 0 0px 8px #fff;
    text-align: center;
}
.banner-inner h1 {
    font-size: 27px;
    font-weight: 100;
    margin-bottom: 20px;
}    
.banner-inner p {
    font-size: 20px;
    font-weight: 100;
    line-height: 30px;
    color: #222;
}    
.gray-bg {
    background: #f9f9f9;
    clear: both;
}
.connect-to-agent {  
    background: #fff;
    width: 700px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 20px 20px;
    position: relative;
    top: -40px;
    z-index: 9;
}
.search-input  .form-control {
    display: block;
    width: 100%;
    height: 40px;
}
.search-input button {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 45px;
    background: #337ab7;
    color: #fff;
    border: none;
}
.search-input {
    position: relative;
}
.connect-to-agent .form-group {
    text-align: left;
}    
.message-box textarea {
    margin-bottom: 15px;
}
.message-box .btn {
    padding: 6px 0;
    font-size: 19px;
    border-radius: 3px;
}    
.step {
    width: 700px;
    margin: 0 auto 50px;
    background: #fff;
    border: 1px solid #ccc;
    display: flex;
    align-items: center;
}
.step .number {
    box-shadow: 0 0 5px rgba(0,0,0,0.3);
    height: 70px !important;
    width: 113px !important;
    /* display: block; */
    line-height: 69px;
    /* max-width: 50px !important; */
    border-radius: 50%;
    font-size: 25px;
    margin-left: -37px;
    background: #fff;
    margin-right: 10px;
}
.step-image {
    max-width: 450px;
}
.step-image img{
    width: 100%
}    
.step-text {
    text-align: left;
    margin-left: 20px;
    font-size: 19px;
    margin-right: 20px;
}   
.top-info h2 {
    font-size: 1.8rem;
}     
.own-wrapper p {
    margin-bottom: 0;
}
.top-info {
    padding: 0 30px;
}    
    .own-wrapper{width: 700px;
    margin: 0 auto}
    
    .default-blue{background: #54bbfe !important; border-color:#54bbfe !important }    
.classic-banner {
    min-height: 500px;
    align-items: center;
    display: flex;
}
.our {
/*    width: 350px;*/
    text-align: left;
}   
    .classic-banner {
        min-height: 500px;
    align-items: center;
    display: flex;
    justify-content: space-between;
}
 .classic-banner .name{
    align-self: flex-end;
    margin-bottom: 40px;
    text-align: left;
    font-weight: 600;
 }    
.our-experties {
    min-height: 500px;
    display: flex;
}    
.image-area {
    max-width: 50%;
    width: 50%;
    background-size: cover !important;
    background-position: center center !important;
}
.oes {
    text-align: left;
    padding: 50px 70px;
    width: 50%;
}
.oes li {
    margin-bottom: 20px;
    list-style: disc;
    margin-left: 19px;
}
.oes.debut    {align-self: center}
</style>
<!--  header end -->

<?php include_once("header.php");?>
<!--  wrapper  -->
<div id="wrapper"> 
  <!-- Content-->
  <div class="content"> 
    <!--section -->
    <section class="scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1"> 
      <!-- <div class="bg" data-bg="<?php echo $baseurl;?>/photos/<?php echo $home_image;?>" data-scrollax="properties: { translateY: '200px' }"></div>-->
      <div class="bg" data-bg="images/banner-boshall.jpg" data-scrollax="properties: { translateY: '200px' }"></div>
      <div class="overlay"></div>
      <div class="hero-section-wrap fl-wrap">
        <div class="container">
         <div class="banner-inner">
             <h1>Sell for a Listing Fee As Low As 1%</h1>
             <p>Pay only 1% in select markets when you sell your
                home with a full-service Boshall Agent.*</p>
         </div>
        </div>
      </div>
    </section>
    <!-- section end -->
    
    
  
<section class="whte-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="top-info">
                    <h2>Sell for $2,800 more on average</h2>
                    <p>Boshall clients sold for more money on average, compared to other brokerages.*</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="top-info">
                    <h2>Pay Less in Fees</h2>
                    <p>Boshall Agents deliver full service for only a 1% or 1.5% listing fee.*</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="top-info">
                    <h2>Close at a Higher Rate</h2>
                    <p>82.8% of homes listed with Boshall sell within 90 days versus the industry average of 79.8%.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <small>*Minimum commissions apply. Buyer's agent commission not included. 1% listing fee not available in all markets. Find out more, including which listing fee applies in your market.$2,800 is an average of the differences between the sale and list prices of Boshall listings versus those of comparable listings by other brokerages, based on a 2019 study.</small>
            </div>
        </div>
    </div>
</section>
   
<div class="gray-bg sell-banner-style" style="background: url('images/boshall-banner.png');background-size: cover;background-position: center center;">
    
    
    <div class="container">
        <div class="classic-banner">
            <div class="our col-md-6">
                
<h2>Our results</h2>
<P>Boshall Agents are local market experts and skilled negotiators. We're accountable to deliver a result you're happy with and will never pressure you to make an easy sale.</P>
            </div>
            
            <div class="name">
                Olivia  <br>
                Boshall Agent
            </div>
        </div>
    </div>
    
</div>  
   
    
<div class="white-bg">
    
    
    <div class="container">
     <div class="our-experties">
         <div class="image-area" style="background:url('images/boshall-side.png')"></div>
         <div class="oes">
            <h4>Our expertise</h4>
<p>Your Boshall Agent will provide listing recommendations based on your needs and the local market. We’ll never pressure you one way or another.
    </p>
<h4>Your Boshall Agent will:</h4>
<ul>
    <li>Prepare a comparative market analysis (CMA) showing recent comparable home sales and demand in your neighborhood so you have expert pricing guidance</li>
    <li>Meet with you to understand your selling motivations and timeline</li>
    <li>Walk through your home, taking note of its best features and improvements that could maximize its value</li>
    <li>Recommend a listing service based on your needs, a target list price, and a marketing plan</li>
</ul>
         </div>
         
     </div>
    </div>
    
</div> 
   
<div class="gray-bg perfect-d" style="background:url('images/laptop.png');background-position: 300px bottom !important;background-size: cover !important;background-repeat: no-repeat;padding: 40px 0;background-size: 90% !important;">
    
    
    <div class="container">
     <div class="our-experties" style="min-height:640px">
         
         <div class="oes debut ">
            
<h2>The perfect debut</h2>
<p>We'll recommend trusted local professionals to get your home landscaped, cleaned, painted, and primped to perfection. We pay for professional photos and a jaw-dropping 3D scan for buyers to see into every corner, whether they’re across town or on a different continent.</p>
         </div>
         
        
         
     </div>
    </div>
    
</div>                  
    
 
    
    
    
    
    
    
    
    
    
    
  </div>
  <!-- Content end --> 
</div>
<!-- wrapper end --> 
<!--footer -->



<?php include_once("footer.php");?>
<script>
 $('#mainsearchbar').keyup(function(e){
	 
	 
	 
	 if((e.keyCode == 8) || (e.keyCode ==32))
	 {

document.getElementById('hidsearchtype').value='';     


	 }
	 
	 }) 
function delete_val()
{
	alert("in");
//$('#hidsearchtype').val();     

//document.getElementById('hidsearchtype').value='';
	
}
$( "#mainsearchbar" ).autocomplete({
	
   source: function (request, response) {
    $.ajax({
		
    url: "mainsearch.php",
      type: "GET",
      data: request,
        dataType: 'json',
		  beforeSend: function(){
		$("#loader").css("display", "block");
	 
     //$("#loader").show();

   },
  /* search: function (e, u) { alert();
                    $(this).addClass('loader');
                },*/
              
       success: function (data) {
$("#loader").hide();	 
  //   $("#mainsearchbar").val('');

       response($.map(data, function (el) {
		                  //     $(this).removeClass('loader');

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


 
  $("#owl-example").owlCarousel();
 

</script>

<div class="modal" tabindex="-1" role="dialog" id="enquirypopup" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p><img src="<?php echo $baseurl?>/images/tickk.gif" style="width:40%"></p>
      <p>Thankyou
        <br/>Request has been submitted. Our team wil contact you soon.</p>
      </div>
      
    </div>
  </div>
</div>