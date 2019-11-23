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
    width: 72px !important;
    /* display: block; */
    line-height: 69px;
    /* max-width: 50px !important; */
    border-radius: 50%;
    font-size: 25px;
    margin-left: -37px;
    background: #fff;
    margin-right: 10px;
    float: left;
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
 .own-wrapper{
 margin: 0 auto}
 .default-blue{background: #54bbfe !important; border-color:#54bbfe !important }   
.sec2 {
    display: flex;
    align-items: center;
}    
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
             <h1>Find Homes First, Tour Homes Fast</h1>
             <p>With a Boshall Agent, you can stay ahead
                of other buyers to get the right home.</p>
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
                    <h2>Find homes first</h2>
                    <p>We send you new home updates <a href="#">3 hours before other sites.*</a></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="top-info">
                    <h2>Tour faster</h2>
                    <p>We send you new home updates <a href="#">3 hours before other sites.*</a></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="top-info">
                    <h2>Win the home</h2>
                    <p>We send you new home updates <a href="#">3 hours before other sites.*</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
   
<div class="gray-bg">
    <div class="connect-to-agent">
        <div class="ctatitle">
            <h2>Connect with a Boshall Agent</h2>
            <p>We’ll set you up with a local Boshall Agent to start your search.</p>
        </div>
        
        <form method="post" id="buy_form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group search">
                        <label>Where are you searching for homes? </label>
                        <div class="search-input">
                            <input type="text" class="form-control" name="places">
                            <!--<button type="submit" class="default-blue"><i class="fa fa-search"></i></button>-->
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Email </label>
                        <div class="search-input">
                            <input type="text" class="form-control" name="buyemail">
                        </div>
                    </div>
                    
                      <div class="form-group">
                        <label>Phone </label>
                        <div class="search-input">
                            <input type="text" class="form-control" name="buymobile">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div class="message-box">
                          <div class="form-group">
                        <label>What can we help you with?</label>
                        
                              <textarea type="text" class="form-control" style="height:100px" placeholder="I'm interested in buying, selling or a free consult with a Boshall Agent." name="buycontent" id="buycontent"></textarea>
                              
                              <button type="submit" class="btn btn-danger btn-block default-blue">Send</button>
                              <p><small>You are creating a Boshall account and agree to our  <a class="clickable">Terms of Use</a> and <a class="clickable">Privacy Policy</a>.</small></p>
                        
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        </form>
    </div>
    
    <div class="steps-wrapper">
        <h2>How it works</h2>
        <p>Boshall helps you win at every step of the home buying process.</p>
    
    <div class="step">
        <div class="sec1">
            <div class="number">1</div>
        </div>
        <div class="sec2">
            <div class="step-text">
                <div class="step-title">Get a head start on new listings</div>
                <p>We update listings every 5 minutes** on Boshall site and app so you can see them first.</p>
            </div>
            <div class="step-image">
                <img src="https://ssl.cdn-redfin.com/v275.1.1/images/why-redfin/buywithredfin/whybuy-step1.jpg" alt="">
            </div>
        </div>
    </div>
    
     <div class="step">
        <div class="sec1">
            <div class="number">2</div>
        </div>
       <div class="sec2">
             <div class="step-text">
                <div class="step-title">Meet with your Boshall Agent</div>
                <p>Your Boshall Agent will learn your needs to find you the right home and help you get loan pre-approval.</p>
            </div>
            <div class="step-image">
                <img src="https://ssl.cdn-redfin.com/v275.1.1/images/why-redfin/buywithredfin/whybuy-step2.jpg" alt="">
            </div>
        </div>
    </div>
    
     <div class="step">
        <div class="sec1">
            <div class="number">3</div>
        </div>
        <div class="sec2">
            <div class="step-text">
                <div class="step-title">Tour homes ASAP, even same day</div>
                <p>Book online and get in right away with your agent or a team member to stay ahead of other buyers.</p>
            </div>
            <div class="step-image">
                <img src="https://ssl.cdn-redfin.com/v275.1.1/images/why-redfin/buywithredfin/whybuy-step3.jpg" alt="">
            </div>
        </div>
    </div>
    
     <div class="step">
        <div class="sec1">
            <div class="number">4</div>
        </div>
        <div class="sec2">
            <div class="step-text">
                <div class="step-title">Make an offer that’s right for you</div>
                <p>Our agents are paid based on your satisfaction, so they’ll tell you when to walk away. Our focus is getting you the right home.</p>
            </div>
            <div class="step-image">
                <img src="https://ssl.cdn-redfin.com/v275.1.1/images/why-redfin/buywithredfin/whybuy-step4.jpg" alt="">
            </div>
        </div>
    </div>
    
     <div class="step">
        <div class="sec1">
            <div class="number">5</div>
        </div>
        <div class="sec2">
            <div class="step-text">
                <div class="step-title">Close smoothly and save thousands</div>
                <p>Your agent will guide you through the closing process. And Boshall pays $1,700 USD on average toward your closing costs.</p>
            </div>
            <div class="step-image">
                <img src="https://ssl.cdn-redfin.com/v275.1.1/images/why-redfin/buywithredfin/whybuy-step5.jpg" alt="">
            </div>
        </div>
    </div>
    
   <div class="own-wrapper">
         <div class="text-center">
            <p><small>† Minimum commissions apply. Buyer's agent commission not included. Find out more 1% listing fee not available in all markets. Find out more, including which listing fee applies in your market. $2,800 is an average of the differences between the sale and list prices of Boshall listings versus those of comparable listings by other brokerages, based on a 2019 study.</small></p>
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