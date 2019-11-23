<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>IPE University | Admissions Open 2020</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="custom.css">
</head>
<body>
  <!-- =========[Navbar]============ -->
  <div class="full-section">
  <div class="container nopadding">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#"><img src="images/ipe-logo.png" class="logosz" ><span class="pl">Institute of Public Enterprise</span></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li><a href="#">Home</a></li>
               <li><a href="#">Courses</a></li>
               <li><a href="#">About Course</a></li>
               <li><a href="#">Accreditations</a></li>
            </ul>
           
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>
  <!-- ============================= -->
<div class="container">

  <div class="row">
  <div class="mainpadding">
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
                <div class="tpadding">
                    <h2 class="headline">Start Your Leadership Career<br>Right Here. Right Now!</h2>
                    <p class="ptext">An IPE Education will enable you go beyond your intellectual realm. As you will find yourself surrounded by a world of ideas, you will gradually learn what inspires you and uplifts you.<br><b>Admissions Open for Executive PGDM Programs 2019-21</b></p>
                </div>
            
                
    </div>
    <!-- =====[form]====== -->
    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
      <div class="formbox">
        <div class="tp">
           <h3>Admisisons Open <br>For IPE 2020</h3>
        </div>
        <div class="frm-padd">
          <form action="submitform.php" method="post" name="brochureForm" id="brochureForm" onSubmit="return validate()">
              <div class="form-group">
                  <input type="hidden" name="source" id="source" value="<?php if(isset( $_GET['source'])){echo $source = $_GET['source'];}?>" />
                 <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                 
                  <input type="hidden" name="transaction_id" id="transaction_id" value="<?php if(isset( $_GET['transaction_id'])){echo $transaction_id = $_GET['transaction_id'];}?>" />
                   <input type="hidden" id="college_id" value="18057">
                   <input type="hidden" id="from_source" value="3">
              </div>
            
               <div class="form-group">
                <input type="text" name="email" class="form-control" id="emailAddr" placeholder="E-mail">
              </div>
                <div class="form-group">
                <input type="text" name="phone" class="form-control" id="mobile" placeholder="Mobile"  maxlength="10" onKeyPress="return isNumber(event)">
              </div>
               <div class="form-group">
                <select name="city" id="city" class="form-control" >
                
                <optgroup label="Major Cities">
                   <option value="New Delhi" data-id="125" selected>New Delhi</option>
                   <option value="Ahmedabad" data-id="129">Ahmedabad</option>
                   <option value="Bangalore" data-id="227">Bangalore</option>
                   <option value="Mumbai" data-id="336">Mumbai</option>
                   <option value="Chennai" data-id="471">Chennai</option>
                   <option value="Hyderabad" data-id="8">Hyderabad</option>
                   <option value="Kolkata" data-id="608">Kolkata</option>
                </optgroup>
                <optgroup label="Andaman and Nicobar Islands">
                   <option value="Port Blair" data-id="2">Port Blair</option>
                <optgroup label="Andhra Pradesh">
                   <option value="Visakhapatnam" data-id="9142">Visakhapatnam</option>
                   <option value="Guntur" data-id="7">Guntur</option>
                   <option value="Prakasam" data-id="9165">Prakasam</option>
                   <option value="East Godavari" data-id="9145">East Godavari</option>
                   <option value="Nellore" data-id="17">Nellore</option>
                   <option value="Krishna" data-id="9143">Krishna</option>
                   <option value="Vizianagaram" data-id="28">Vizianagaram</option>
                   <option value="Chittoor" data-id="5">Chittoor</option>
                   <option value="Kadapa" data-id="9">Kadapa</option>
                   <option value="Srikakulam" data-id="24">Srikakulam</option>
                   <option value="Kurnool" data-id="13">Kurnool</option>
                   <option value="Ananthapur" data-id="4">Ananthapur</option>
                   <option value="Vijayawada" data-id="26">Vijayawada</option>
                   <option value="Tirupati" data-id="25">Tirupati</option>
                   <option value="Kakinada" data-id="10">Kakinada</option>
                   <option value="Rajahmundhry" data-id="9153">Rajahmundhry</option>
                <optgroup label="Arunachal Pradesh">
                   <option value="Itanagar" data-id="35">Itanagar</option>
                <optgroup label="Assam">
                   <option value="Guwahati" data-id="54">Guwahati</option>
                <optgroup label="Bihar">
                   <option value="Patna" data-id="95">Patna</option>
                <optgroup label="Chandigarh">
                   <option value="Chandigarh" data-id="105">Chandigarh</option>
                <optgroup label="Chhattisgarh">
                   <option value="Raipur" data-id="120">Raipur</option>
                   <option value="Durg" data-id="110">Durg</option>
                   <option value="Bilaspur" data-id="107">Bilaspur</option>
                   <option value="Bhilai" data-id="9232">Bhilai</option>
                <optgroup label="Dadra and nagar Haveli">
                   <option value="Nagar Haveli" data-id="9329">Nagar Haveli</option>
                <optgroup label="Daman and Diu">
                   <option value="Daman" data-id="123">Daman</option>
                <optgroup label="Goa">
                   <option value="North Goa" data-id="9244">North Goa</option>
                <optgroup label="Gujarat">
                   <option value="Surat" data-id="152">Surat</option>
                   <option value="Rajkot" data-id="150">Rajkot</option>
                   <option value="Gandhi Nagar" data-id="138">Gandhi Nagar</option>
                   <option value="Mehsana" data-id="145">Mehsana</option>
                   <option value="Vadodara" data-id="154">Vadodara</option>
                   <option value="Anand" data-id="132">Anand</option>
                   <option value="Bhavnagar" data-id="134">Bhavnagar</option>
                   <option value="Kachchh" data-id="9255">Kachchh</option>
                   <option value="Sabarkantha" data-id="9155">Sabarkantha</option>
                   <option value="Junagadh" data-id="142">Junagadh</option>
                   <option value="Jamnagar" data-id="141">Jamnagar</option>
                <optgroup label="Haryana">
                   <option value="Gurgaon" data-id="162">Gurgaon</option>
                   <option value="Rohtak" data-id="173">Rohtak</option>
                   <option value="Faridabad" data-id="160">Faridabad</option>
                   <option value="Sonepat" data-id="175">Sonepat</option>
                   <option value="Hisar" data-id="9157">Hisar</option>
                   <option value="Ambala" data-id="157">Ambala</option>
                   <option value="Yamuna Nagar" data-id="9276">Yamuna Nagar</option>
                   <option value="Bhiwani" data-id="158">Bhiwani</option>
                   <option value="Karnal" data-id="167">Karnal</option>
                   <option value="Kurukshetra" data-id="168">Kurukshetra</option>
                   <option value="Mahendragarh" data-id="9227">Mahendragarh</option>
                   <option value="Sirsa" data-id="174">Sirsa</option>
                   <option value="Panipat" data-id="171">Panipat</option>
                   <option value="Jind" data-id="165">Jind</option>
                   <option value="Jhajjar" data-id="164">Jhajjar</option>
                   <option value="Rewari" data-id="172">Rewari</option>
                <optgroup label="Himachal Pradesh">
                   <option value="Solan" data-id="188">Solan</option>
                   <option value="Shimla" data-id="187">Shimla</option>
                   <option value="Kangra" data-id="9179">Kangra</option>
                   <option value="Hamirpur" data-id="180">Hamirpur</option>
                   <option value="Mandi" data-id="183">Mandi</option>
                <optgroup label="Jammu and Kashmir">
                   <option value="Jammu" data-id="194">Jammu</option>
                   <option value="Srinagar" data-id="202">Srinagar</option>
                <optgroup label="Jharkhand">
                   <option value="Ranchi" data-id="222">Ranchi</option>
                   <option value="Jamshedpur" data-id="216">Jamshedpur</option>
                <optgroup label="Karnataka">
                   <option value="Mangalore" data-id="246">Mangalore</option>
                   <option value="Mysore" data-id="247">Mysore</option>
                   <option value="Belgaum" data-id="228">Belgaum</option>
                   <option value="Gulbarga" data-id="237">Gulbarga</option>
                   <option value="Tumkur" data-id="250">Tumkur</option>
                   <option value="Bijapur" data-id="231">Bijapur</option>
                   <option value="Davanagere" data-id="235">Davanagere</option>
                   <option value="Dharwad" data-id="9171">Dharwad</option>
                   <option value="Shimoga" data-id="249">Shimoga</option>
                   <option value="Udupi" data-id="251">Udupi</option>
                   <option value="Hassan" data-id="238">Hassan</option>
                   <option value="Bidar" data-id="230">Bidar</option>
                   <option value="Hubli" data-id="9174">Hubli</option>
                   <option value="Kolar" data-id="242">Kolar</option>
                   <option value="Bagalkot" data-id="226">Bagalkot</option>
                   <option value="Kannada" data-id="9203">Kannada</option>
                   <option value="Chitradurga" data-id="234">Chitradurga</option>
                   <option value="Mandya" data-id="245">Mandya</option>
                   <option value="Gadag" data-id="236">Gadag</option>
                   <option value="Bellary" data-id="229">Bellary</option>
                   <option value="Raichur" data-id="248">Raichur</option>
                <optgroup label="Kerala">
                   <option value="Thiruvananthapuram" data-id="267">Thiruvananthapuram</option>
                   <option value="Thrissur" data-id="9222">Thrissur</option>
                   <option value="Ernakulam" data-id="253">Ernakulam</option>
                   <option value="Malappuram" data-id="261">Malappuram</option>
                   <option value="Kochi" data-id="257">Kochi</option>
                   <option value="Kottayam" data-id="259">Kottayam</option>
                   <option value="Kannur" data-id="255">Kannur</option>
                   <option value="Kozhikode" data-id="260">Kozhikode</option>
                   <option value="Kollam" data-id="258">Kollam</option>
                   <option value="Palakkad" data-id="263">Palakkad</option>
                   <option value="Pathanamthitta" data-id="264">Pathanamthitta</option>
                   <option value="Calicut" data-id="9291">Calicut</option>
                   <option value="Trivandrum" data-id="9305">Trivandrum</option>
                   <option value="Alappuzha" data-id="252">Alappuzha</option>
                   <option value="Kasaragod" data-id="9228">Kasaragod</option>
                <optgroup label="Madhya Pradesh">
                   <option value="Bhopal" data-id="277">Bhopal</option>
                   <option value="Indore" data-id="290">Indore</option>
                   <option value="Gwalior" data-id="287">Gwalior</option>
                   <option value="Jabalpur" data-id="291">Jabalpur</option>
                   <option value="Ujjain" data-id="316">Ujjain</option>
                   <option value="Sagar" data-id="306">Sagar</option>
                   <option value="Chhatarpur" data-id="279">Chhatarpur</option>
                <optgroup label="Maharashtra">
                   <option value="Pune" data-id="344">Pune</option>
                   <option value="Nagpur" data-id="337">Nagpur</option>
                   <option value="Aurangabad" data-id="70">Aurangabad</option>
                   <option value="Nashik" data-id="9181">Nashik</option>
                   <option value="Kolhapur" data-id="333">Kolhapur</option>
                   <option value="Ahmed Nagar" data-id="319">Ahmed Nagar</option>
                   <option value="Thane" data-id="9136">Thane</option>
                   <option value="Jalgaon" data-id="331">Jalgaon</option>
                   <option value="Solapur" data-id="350">Solapur</option>
                   <option value="Sangli" data-id="347">Sangli</option>
                   <option value="Amravati" data-id="321">Amravati</option>
                   <option value="Satara" data-id="348">Satara</option>
                   <option value="Navi Mumbai" data-id="16337">Navi Mumbai</option>
                   <option value="Beed" data-id="323">Beed</option>
                   <option value="Dhule" data-id="327">Dhule</option>
                   <option value="Wardha" data-id="351">Wardha</option>
                   <option value="Raigarh" data-id="345">Raigarh</option>
                   <option value="Ratnagiri" data-id="346">Ratnagiri</option>
                   <option value="Latur" data-id="334">Latur</option>
                   <option value="Yavatmal" data-id="353">Yavatmal</option>
                   <option value="Chandrapur" data-id="326">Chandrapur</option>
                   <option value="Nanded" data-id="338">Nanded</option>
                   <option value="Akola" data-id="320">Akola</option>
                <optgroup label="Manipur">
                   <option value="Imphal" data-id="357">Imphal</option>
                <optgroup label="Meghalaya">
                   <option value="Shillong" data-id="9219">Shillong</option>
                <optgroup label="Mizoram">
                   <option value="Aizawl" data-id="363">Aizawl</option>
                <optgroup label="Nagaland">
                   <option value="Dimapur" data-id="371">Dimapur</option>
                <optgroup label="Orissa">
                   <option value="Bhubaneswar" data-id="387">Bhubaneswar</option>
                   <option value="Cuttack" data-id="390">Cuttack</option>
                <optgroup label="Puducherry">
                   <option value="Pondicherry" data-id="9147">Pondicherry</option>
                <optgroup label="Punjab">
                   <option value="Patiala" data-id="431">Patiala</option>
                   <option value="Mohali" data-id="9223">Mohali</option>
                   <option value="Ludhiana" data-id="425">Ludhiana</option>
                   <option value="Amritsar" data-id="415">Amritsar</option>
                   <option value="Jalandhar" data-id="423">Jalandhar</option>
                   <option value="Bathinda" data-id="416">Bathinda</option>
                   <option value="Hoshiarpur" data-id="422">Hoshiarpur</option>
                   <option value="Sangrur" data-id="433">Sangrur</option>
                   <option value="Gurdaspur" data-id="421">Gurdaspur</option>
                   <option value="Moga" data-id="427">Moga</option>
                   <option value="Firozpur" data-id="9236">Firozpur</option>
                   <option value="Fatehgarh Sahib" data-id="419">Fatehgarh Sahib</option>
                   <option value="Kapurthala" data-id="424">Kapurthala</option>
                <optgroup label="Rajasthan">
                   <option value="Jaipur" data-id="450">Jaipur</option>
                   <option value="Udaipur" data-id="465">Udaipur</option>
                   <option value="Alwar" data-id="435">Alwar</option>
                   <option value="Jodhpur" data-id="455">Jodhpur</option>
                   <option value="Ajmer" data-id="434">Ajmer</option>
                   <option value="Sikar" data-id="462">Sikar</option>
                   <option value="Kota" data-id="457">Kota</option>
                   <option value="Ganganagar" data-id="448">Ganganagar</option>
                   <option value="Bikaner" data-id="441">Bikaner</option>
                   <option value="Jhunjhunu" data-id="9196">Jhunjhunu</option>
                   <option value="Hanumangarh" data-id="449">Hanumangarh</option>
                <optgroup label="Sikkim">
                   <option value="Gangtok" data-id="466">Gangtok</option>
                <optgroup label="Tamil Nadu">
                   <option value="Coimbatore" data-id="472">Coimbatore</option>
                   <option value="Namakkal" data-id="483">Namakkal</option>
                   <option value="Kanyakumari" data-id="478">Kanyakumari</option>
                   <option value="Salem" data-id="487">Salem</option>
                   <option value="Madurai" data-id="481">Madurai</option>
                   <option value="Vellore" data-id="501">Vellore</option>
                   <option value="Kanchipuram" data-id="477">Kanchipuram</option>
                   <option value="Erode" data-id="476">Erode</option>
                   <option value="Tirunelveli" data-id="495">Tirunelveli</option>
                   <option value="Thanjavur" data-id="490">Thanjavur</option>
                   <option value="Villupuram" data-id="9177">Villupuram</option>
                   <option value="Dindigul" data-id="475">Dindigul</option>
                   <option value="Trichy" data-id="9163">Trichy</option>
                   <option value="Tiruvannamalai" data-id="497">Tiruvannamalai</option>
                   <option value="Cuddalore" data-id="473">Cuddalore</option>
                   <option value="Thiruchirapalli" data-id="9141">Thiruchirapalli</option>
                   <option value="Thiruvallur" data-id="492">Thiruvallur</option>
                   <option value="Pudukkottai" data-id="485">Pudukkottai</option>
                   <option value="Dharmapuri" data-id="474">Dharmapuri</option>
                   <option value="Thiruchirapalli" data-id="9176">Thiruchirapalli</option>
                   <option value="Thoothukudi" data-id="493">Thoothukudi</option>
                   <option value="Sivaganga" data-id="488">Sivaganga</option>
                   <option value="Perambalur" data-id="484">Perambalur</option>
                   <option value="Virudhunagar" data-id="503">Virudhunagar</option>
                   <option value="Tiruppur" data-id="496">Tiruppur</option>
                   <option value="Nagapattinam" data-id="482">Nagapattinam</option>
                   <option value="Karur" data-id="479">Karur</option>
                <optgroup label="Telangana">
                   <option value="Rangareddi" data-id="22">Rangareddi</option>
                   <option value="Warangal" data-id="29">Warangal</option>
                   <option value="Nalgonda" data-id="16">Nalgonda</option>
                   <option value="Karim Nagar" data-id="11">Karim Nagar</option>
                   <option value="Khammam" data-id="12">Khammam</option>
                   <option value="Secunderabad" data-id="9296">Secunderabad</option>
                   <option value="Mahabub Nagar" data-id="15">Mahabub Nagar</option>
                   <option value="Nizamabad" data-id="18">Nizamabad</option>
                   <option value="Medak" data-id="9310">Medak</option>
                <optgroup label="Tripura">
                   <option value="Agartala" data-id="504">Agartala</option>
                <optgroup label="Uttar Pradesh">
                   <option value="Lucknow" data-id="551">Lucknow</option>
                   <option value="Meerut" data-id="557">Meerut</option>
                   <option value="Ghaziabad" data-id="535">Ghaziabad</option>
                   <option value="Noida" data-id="562">Noida</option>
                   <option value="Kanpur" data-id="546">Kanpur</option>
                   <option value="Allahabad" data-id="511">Allahabad</option>
                   <option value="Agra" data-id="508">Agra</option>
                   <option value="Greater Noida" data-id="9424">Greater Noida</option>
                   <option value="Varanasi" data-id="576">Varanasi</option>
                   <option value="Bareilly" data-id="521">Bareilly</option>
                   <option value="Mathura" data-id="555">Mathura</option>
                   <option value="Aligarh" data-id="510">Aligarh</option>
                   <option value="Moradabad" data-id="559">Moradabad</option>
                   <option value="Saharanpur" data-id="570">Saharanpur</option>
                   <option value="Bijnor" data-id="523">Bijnor</option>
                   <option value="Jaunpur" data-id="543">Jaunpur</option>
                   <option value="Gorakhpur" data-id="538">Gorakhpur</option>
                   <option value="Muzaffarnagar" data-id="560">Muzaffarnagar</option>
                   <option value="Sultanpur" data-id="574">Sultanpur</option>
                <optgroup label="Uttarakhand">
                   <option value="Dehradun" data-id="580">Dehradun</option>
                   <option value="Haridwar" data-id="583">Haridwar</option>
                   <option value="Nainital" data-id="584">Nainital</option>
                   <option value="Roorkee" data-id="588">Roorkee</option>
                   <option value="Garhwal" data-id="9250">Garhwal</option>
                <optgroup label="West Bengal">
                   <option value="Bardhaman" data-id="598">Bardhaman</option>
                   <option value="Murshidabad" data-id="9208">Murshidabad</option>
                   <option value="Hooghly" data-id="9158">Hooghly</option>
                   <option value="Medinipur" data-id="9230">Medinipur</option>
                   <option value="North 24 Parganas" data-id="9204">North 24 Parganas</option>
                   <option value="Nadia" data-id="9183">Nadia</option>
                   <option value="Midnapore" data-id="611">Midnapore</option>
                   <option value="Durgapur" data-id="604">Durgapur</option>
                   <option value="Howrah" data-id="9189">Howrah</option>
                </optgroup>
              </select>
                </div>
              <div class="form-group">
              <select name="program" id="program" class="form-control" >
                    
                                   <option value="MBA/PGDM" data-id="120" selected>MBA/PGDM</option>
                        </select>
              </div>
              <div class="form-group">
                <input type="submit" id="formsubmit" name="submit" class="btn btn-primary" value="APPLY NOW">

              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
    <!-- =========== -->
  </div>
</div>

</body>
<script type = "text/javascript">
 
      // Form validation code will come here.
      function validate() {
      
	
	    var phoneno = /^\d{10}$/;
		        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				var namept=/^[a-zA-Z-v]+(\s+[a-zA-v]+)*$/;



         if( document.brochureForm.name.value == "" ) {
            alert( "Please provide your name!" );
            document.brochureForm.name.focus() ;
            return false;
         }
		 if(!document.brochureForm.name.value.match(namept)) {
            alert( "Accepts only alphabets!" );
            document.brochureForm.name.focus() ;
            return false;
         }
		 
         if( document.brochureForm.email.value == "" ) {
            alert( "Please provide your Email!" );
            document.brochureForm.email.focus() ;
            return false;
         }
		 if(!document.brochureForm.email.value.match(reg)) {
            alert( "Please provide correct email address!" );
            document.brochureForm.email.focus() ;
            return false;
         }
		 if( document.brochureForm.phone.value == "" ) {
            alert( "Please provide your mobile no!" );
            document.brochureForm.phone.focus() ;
            return false;
         }
		 
		  if(!document.brochureForm.phone.value.match(phoneno)) {
            alert( "Please provide your mobile no!" );
            document.brochureForm.phone.focus() ;
            return false;
         }
		 
		  var city = document.getElementById("city");
        if (ddlFruits.value == "") {
            //If the "Please Select" option is selected display error.
            alert("Please select an option!");
			            document.brochureForm.city.focus() ;

            return false;
        }

		 
         return( true );
      }

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
   //-->
</script>
</html>