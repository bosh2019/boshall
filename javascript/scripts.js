var baseurl="http://www.boshall.com";
//var baseurl="http://s1.dkddev.com/boshall";

/*
$(function() {
	alert();
 $.session.set("myVar", "Hello World!");
 alert($.session.get("myVar"));

});*/
function isNumberKey(evt)
     {
var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
        
{ 
  return false;}
else{
        
return true;

}}
(this.value)

 function success () { 
        notie.alert({ type: 1, text: 'Added to wishlist !', time: 2 })
      }
	   function cartclearmsg () {
        notie.alert({ type: 1, text: 'Cart cleared !', time: 2 })
		
		setTimeout(function(){ window.location.href='cart.php'; }, 1000);
		
      }
	    function addtocartmsg () {
        notie.alert({ type: 1, text: 'Added to cart!', time: 2 })
      }

      function warning () {
        notie.alert({ type: 2, text: 'Warning<br><b>with</b><br><i>HTML</i><br><u>included.</u>', time: 2 })
      }

      function error () {
        notie.alert({ type: 3, text: 'Removed from wishlist !', time: 2 })
      }

      function info () {
        notie.alert({ type: 4, text: 'Information.', time: 2 })
      }

      function force () {
        notie.force({
          type: 3,
          text: 'You cannot do that, sending you back.',
          buttonText: 'OK',
          callback: function () {
            notie.alert({ type: 3, text: 'Maybe when you\'re older...' })
          }
        })
      }

      function confirms () {
        notie.confirm({
          text: 'Are you sure you want to do that?<br><b>That\'s a bold move...</b>',
          cancelCallback: function () {
            notie.alert({ type: 3, text: 'Aw, why not? :(', time: 2 })
          },
          submitCallback: function () {
            notie.alert({ type: 1, text: 'Good choice! :D', time: 2 })
          }
        })
      }




function getdivforsearch(val)
{ 
 
    
 

    
	var xmlHttpReq = false;

    if (window.XMLHttpRequest)

 

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

			response=xmlHttpReq.responseText;
			
				document.getElementById('divforsechnew').innerHTML=response;

				 

			}else{

			 //document.getElementById('subcategory').length=2


		   }

		}
	xmlHttpReq.open('GET', baseurl + '/otherpages/divforsearch.php?propertyfor=' + escape(val), true);
	    xmlHttpReq.send(null);
    
   

}

function getpropertyfordic(id){

 var xmlHttpReq = false;
    if (window.XMLHttpRequest)

	 {
        xmlHttpReq = new XMLHttpRequest();

    }
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
			response=xmlHttpReq.responseText;
			//alert(response)
			
				document.getElementById('pptydiv').innerHTML=response;
				 
				 
			}else{
			 document.getElementById('city').length=2
			 document.getElementById('city').options[0].text="Loading..."
		   }
		}
	 xmlHttpReq.open('GET',baseurl+'/ajaxCallToPhp/getpptyformid.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}


function sortingcity(id){
 document.getElementById('sortid').value=id;
 var links=document.getElementById('actuallink').value;
 
 if(id==1){
	 var sorting='relevance';
	 }
	 
 else if(id==2){
	 var sorting='price-high-to-low';
	 }
	 
 else if(id==3){
	 var sorting='price-low-to-high';
	 }
	  else if(id==4){
	 var sorting='name';
	 }
	  else if(id==5){
	 var sorting='listing-id';
	 }
	 else
	 {
		 var sorting='relevance';
	 }
	 
 var newurl=links+'/sort/'+sorting;
 
  window.location.href=newurl;
	}


function getcitylistforptoperty(id){
	//alert("eqeqeq")
if(id==0){
	alert("Please select county");
return false
}

//alert(div.value)
 var xmlHttpReq = false;
    if (window.XMLHttpRequest)

	 {
        xmlHttpReq = new XMLHttpRequest();

    }
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
			response=xmlHttpReq.responseText;
			//alert(response)
			
				document.getElementById('citydiv').innerHTML=response;
				 
				 
			}else{
			 document.getElementById('city').length=2
			 document.getElementById('city').options[0].text="Loading..."
		   }
		}
	 xmlHttpReq.open('GET',baseurl+'/ajaxCallToPhp/getcitylistfromcount.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

function setcityvalue(val)
{
	document.getElementById('cityhid').value=val;
	}
	
		
	$(function(){
		
		
		jQuery.validator.addMethod("aboutpat", function(value, element)
{
return this.optional(element) || /^[-a-zA-Z-0-9()<\/>%_@.#&+,-v'":;]+(\s+[-a-zA-Z-0-9:;%'"<\/>_@.#&+,-v]+)*$/i.test(value);
}, "Accepts letters,digits and special characters only");

		jQuery.validator.addMethod("addresspat", function(value, element)
{
return this.optional(element) || /^[-a-zA-Z-0-9()_@.#&+,-v]+(\s+[-a-zA-Z-0-9()_@.#&+,-v]+)*$/i.test(value);
}, "Accepts letters,digits and special characters only");

     jQuery.validator.addMethod("websitepat", function(value, element)
{
return this.optional(element) || /^(https?\:\/\/)?((www\.)?youtube\.com|youtu\.?be)\/.+$/i.test(value);
}, "Enter correct youtube link");
 jQuery.validator.addMethod("lettersonlynew", function(value, element) 
{
return this.optional(element) || /^[a-zA-Z-v]+(\s+[a-zA-v]+)*$/i.test(value);
}, "Accepts letters only");

jQuery.validator.addMethod("mobilenumber", function(value, element) 
{
return this.optional(element) || /^[6789]\d{9}$/i.test(value);
}, "Please enter correct mobile number");
jQuery.validator.addMethod("emailcode", function(value, element) 
{
return this.optional(element) || /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/i.test(value);
}, "Enter valid email address");

 jQuery.validator.addMethod("lettersonly", function(value, element) 
{
return this.optional(element) || /^[-a-zA-Z-v]+(\s+[-a-zA-v]+)*$/i.test(value);
}, "Accepts letters only");
	
	
jQuery.validator.addMethod("filepat", function(value, element) 
{
return this.optional(element) || /^([a-zA-Z0-9\s_\\.\-:])+(.pdf)$/i.test(value);
}, "Only pdf format");

jQuery.validator.addMethod("imagepatt", function(value, element) 
{
return this.optional(element) || /^([a-zA-Z0-9\s_\\.\-:])+(.png|.jpeg|.jpg)$/i.test(value);
}, "Supports jpeg,jpg,png");
	jQuery.validator.addMethod("passport", function(value, element) 
{
return this.optional(element) || /^[A-PR-WY][1-9]\d\s?\d{4}[1-9]$/i.test(value);
}, "Enter valid passport number");
		
	jQuery.validator.addMethod("alls", function(value, element)
{
return this.optional(element) ||  /.*[^ ].*$/i.test(value);
}, "Invalid characters ");	


 $(document).on('click','.show_more',function(){
		var ID = $('#newshowid').val();
	//	alert(ID)
		var total = parseInt($('#newtotalcount').val());
		var hidsearchtype = $('#hidsearchtype').val();
		newVal=parseInt(ID)+4
		$('#newshowid').val(newVal);
		fptype=$('#fptype').val();
		min_price=$('#min_price').val();
		fsearchtype=$('#fsearchtype').val();
		max_price=$('#max_price').val();
		beds=$('#beds').val();
		baths=$('#baths').val();

		//$('.show_more').hide();
		//$('.loding').show();
		//left=total-(parseInt(ID)+6);
		//	alert('dd')
        $.ajax({

            type:'POST',

            url:baseurl+'/getmoreproperties.php',

            data:'id='+ID+'&newVal='+newVal+'&type='+hidsearchtype+'&ptype='+fptype+'&minprice='+min_price+'&maxprice='+max_price+'&searchtype='+fsearchtype+'&beds='+beds+'&baths='+baths, 

            success:function(html){
//alert("adada")



			  var sptRes=html.split("##");
var htmlresult=sptRes[0];
var numrows=parseInt(sptRes[1]);
				 // $('.loding').hide();

				if(total<=numrows){
				  $('.show_more').hide();
				  
				// document.getElementById('morenum').innerHTML=left

				}else{
					 $('.show_more').show();
				}
//alert(html)
				$('#otherloadmore').append(htmlresult);    

            }

        }); 

    });


	
	$("#mainsearch_forms").validate({
               ignore: ".ignore", 

                rules: {
				prop_types:{
				required: true,
				addresspat:true,      
                },
				hidsearchtype:{
				required: true,      
                },
				      },
			messages: {
				hidsearchtype: {
					
				required:"Select city/address/zip",
				}
				
				
			},
			
	})
	
	
	//index enquiry form validation
	
	$("#enquiryform").validate({
                 rules: {
				enquiryemail:{
				required: true,
				emailcode:true,      
                },
				
				      },
			messages: {
				enquiryemail: {
					
				required:"Required",
				}
				
				
			},
			
			submitHandler: enquiryformsubmit
			
	})
	
		$("#buy_form").validate({
                 rules: {
				buyemail:{
				required: true,
				emailcode:true,      
                },
				places:{
				required: true,
				addresspat:true,      
          },
		  buymobile:{
				required: true,
				number: true

          },
		  buycontent:{
				required: true,
          },
				      },
			messages: {
				enquiryemail: {
					
				required:"Required",
				}
				
				
			},
			
			submitHandler: buyformsubmit
			
	})
	
	

	$("#bookingform").validate({
             

                rules: {
				bookname:{
				required: true,
				addresspat:true,      
                },
					booklname:{
				required: true,
				addresspat:true,      
                },
				bookemail:{
				required: true,
				emailcode:true,      
                },
				
				bookphone:{
				required: true,
				number: true
                }
				      },
			    submitHandler: bookingform

			
	})
	
	
	
	$("#sellingform").validate({
             

                rules: {
				sell_name:{
				required: true,
				addresspat:true,      
                },
					sell_lname:{
				required: true,
				addresspat:true,      
                },
				sell_email:{
				required: true,
				emailcode:true,      
                },
				
				sell_phone:{
				required: true,
				number: true
                }
				      },
			    submitHandler: sellingform

			
	})
	
$("#inner_search").validate({

                rules: {
                
				prop_types:{
				required: true,      
                },
				hidsearchtype:{
				required: true,      
                },
				searchtype:{
				required: true,      
                },
				
				
				      },
			messages: {
				hidsearchtype: {
					
				required:"Select city/address/zip",
				}
				
				
			},
			
	})


		$("#propertyform").validate({

                rules: {
                
				propname:{
				required: true,      
				lettersonly: true
                },
					propemail:{
				required: true,      
				emailcode: true
                },
				
				propphone:{
				required: true,      
				number: true
				},
				propmsg:{
				required: true,      
				addresspat: true
				}
				
				},
			messages: {
				propname: {
				required:"Can't left blank",
				},
				propemail: {
				required:"Can't left blank",
				},
				
				propphone: {
				required:"Can't left blank",
				},
				propmsg: {
				required:"Can't left blank",
				}
				
				
				
			},
    submitHandler: submitpropertyform
			
	})
		
		$("#agentform").validate({

                rules: {
                
				agentname:{
				required: true,      
				lettersonly: true
                },
					agentemail:{
				required: true,      
				emailcode: true
                },
				
				agentphone:{
				required: true,      
				number: true
				},
				agentmsg:{
				required: true,      
				addresspat: true
				}
				
				},
			messages: {
				agentname: {
				required:"Can't left blank",
				},
				agentemail: {
				required:"Can't left blank",
				},
				
				agentphone: {
				required:"Can't left blank",
				},
				agentmsg: {
				required:"Can't left blank",
				}
				
				
				
			},
    submitHandler: submitagentform
			
	})
		 

$("#contactformmain").validate({

                rules: {
                
				fullname:{
				required: true,      
				lettersonly: true
                },
					contcatemail:{
				required: true,      
				emailcode: true
                },
				subject:{
				required: true,      
				addresspat: true
                },
				phone:{
				required: true,      
				number: true
				},
				message:{
				required: true,      
				addresspat: true
				}
				
				},
			messages: {
				fullname: {
				required:"Can't left blank",
				},
				email: {
				required:"Can't left blank",
				},
				subject: {
				required:"Can't left blank",
				},
				phone: {
				required:"Can't left blank",
				},
				message: {
				required:"Can't left blank",
				}
				
				
				
			},
    submitHandler: submitcontactform
			
	})
	
	
	$("#subscribeform").validate({

                rules: {
                
				subemail:{
				required: true,      
				emailcode: true
                }
				
				      },
			messages: {
				subemail: {
					
				required:"Can't left blank",
				}
				
				
			},
    submitHandler: submitsubscribeForm
			
	})
	
	
	
$("#adminlogin").validate({
	//alert(cal);
                rules: {
                
				username:{
				required: true,      
				emailcode: true,
                },
				password:
				{
				required: true,
				minlength:6,      
				addresspat: true,
                },
				
					        },
			
    submitHandler: submitadminForm
			
	})
	
		$("#forgetform_").validate({
		
                rules: {
                
				feemail:{
				required: true,      
				emailcode: true,
                },
				
				
					        },
			
			    submitHandler: forget_form

			
	});
	$("#loginform_").validate({
		
                rules: {
                
				email:{
				required: true,      
				emailcode: true,
                },
				password:
				{
				required: true,
				minlength:6,      
				addresspat: true,
                },
				
					        },
			
    submitHandler: submituserForm
			
			
	})
	
	
	
	$("#registerform").validate({
                rules: {
						fname:{
						  required: true,      
						  alls: true,
		                },
						lname:{
						  required: true,      
						  alls: true,
		                },
						uemail:{
						  required: true,      
						  email: true,
		                },
						upassword:
						{
						required: true,
						minlength:6,      
						addresspat: true,
		                }
				
		        },
		        messages:{
		          fname:{
						required: "Firstname is required"
		          },
				  lname:{
						required: "Lastname is required"
		          },
		          uemail:{
		          	required:"Email is required",
		          	email:"Enter valid email address"
		          },
		          upassword:{
						required: "Password is required",
						minlength:"Password must be 6 chars long",      
						addresspat: true,
		           }	
		        },		
                submitHandler:function(form){
                	 var buttons1 = document.getElementById("registration_btn");
                     buttons1.innerHTML ='<img src="'+baseurl+'/images/803.gif" style=width:70%>';
                	 var redurl=document.getElementById('actual_urlforlogin').value;
					 redirection_val=$("#redirection_val").val();
						 if(redirection_val==1) 
						 {	 
						    var singleprop_id=$("#singleprop_id").val();	 
							 
						 }
						$.ajax({
					        type: "POST",
					        url: baseurl+"/otherpages/register.php",
					        data:$("#registerform").serialize(),
					        success: function(result) {
						         if(result.status)
								 {  
								 	  $("#error_msg").html('<h4 class="text-center text-success">'+result.success+'</h4>');
									  $("#reg").modal('hide'); 
						              addtowishlist(singleprop_id);
								      window.location.href=redurl;
							     }
								 else
								 {
								 	$("#error_msg").html('<h4 class="text-center text-danger">'+result.error+'</h4>');
									//$('#contactfailed').modal('show');
							        //$("#reg").modal('hide'); 
						            //$("#messagepopup").modal('show');	
								 }
							 
					        }
					    });
                }
					
	});
	
	
	
	
		$("#change_password").validate({
		
                rules: {
                
					c_password:
				{
				required: true,
				minlength:6,      
				addresspat: true,
                },
				cc_password:{
				required: true,      
					equalTo: "#c_password"
                },
			
				
					        }, 
			
    submitHandler: setUserPassword
			
			
	})
	
	
	
	
	$("#bannerform").validate({
	//alert(cal);
                rules: {
                
				image:
				{
				required: true,
				imagepatt: true,
                },
				image1:
				{
				
				imagepatt: true,
                }
				     },
	
	})
	
	$("#amenties").validate({
	//alert(cal);
                rules: {
                
				firstline:{
				required: true,      
				addresspat: true,
                },
				
				
				
					        },
	
			
	})
	$("#countyform").validate({
	//alert(cal);
                rules: {
                
				firstline:{
				required: true,      
				addresspat: true,
                },
				editor1:
				{
                         required: function(textarea) 
                        {  CKEDITOR.instances.editor1.updateElement(); // update textarea
          var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
		  
          return editorcontent.length == 0;},

                  alls:true       
                    },
				
				
			        },
							
	})
	
	$("#contactform").validate({
	//alert(cal);
                rules: {
                
				name:{
				required: true,      
				addresspat: true,
                },
				email:
				{
					required: true,
				emailcode: true,
                },
				mobile:
				{
				required: true,      
				addresspat: true,
                },
				skype:
				{
				required: true,      
				addresspat: true,
                },
				
				office:
				{
				required: true,      
				addresspat: true,
                },
				address:
				{
				required: true,      
				addresspat: true,
                }
					        },
										
	})
	$("#socialform").validate({
	//alert(cal);
                rules: {
                
				name:{
				required: true,      
				addresspat: true,
                },
				email:
				{
					required: true,
				addresspat: true,
                },
				mobile:
				{
				required: true,      
				addresspat: true,
                },
				skype:
				{
				required: true,      
				addresspat: true,
                },
				
				office:
				{
				required: true,      
				addresspat: true,
                }
				
				
					        },
})
$("#budgetform").validate({
	//alert(cal);
                rules: {
                
				name:{
				required: true,      
				addresspat: true,
                }
				
				
					        },
})
	
	
	$("#passform").validate({
	//alert(cal);
                rules: {
                
				name: {
					required: true,
					minlength: 6
				},
				email: {
					required: true,
					minlength: 6,
					equalTo: "#name"
				}
				
				
					        },
							
	
	})
	
	$("#cityform").validate({
	//alert(cal);
                rules: {
                
				firstline:{
				required: true,      
				addresspat: true,
                },
				slug:
				{
					required: true,
				lettersonly: true,
                },
				image:
				{
				required: true,
				imagepatt: true,
                },
				image1:
				{
				
				imagepatt: true,
                }
				
				
				
					        },
			
	})
	$("#pimagesform").validate({
	//alert(cal);
                rules: {
                
				
				image:
				{
				required: true,
				imagepatt: true,
                },
				image1:
				{
				
				imagepatt: true,
                }
				
				
				
					        },
			
	})
	
	
	
	
	
	});
	
	function buyformsubmit()
	{
	
		$('#enquiryemail').prop('readonly', true);

		 var buttons = document.getElementById("buycontent");
    buttons.innerHTML ='<img src="'+baseurl+'/images/803.gif" style=width:70%>';
		   var data = $("#buy_form").serialize();
		   
		   $.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/ajaxCallToPhp/buyform.php",
        data: data,
        success: function(result) {
				

        	//alert(result.status);	

				//document.getElementById('filer-loader').style.display='none';

			
        if(result.status==1)
		 {
			
			//$('#enquirypopup').modal('show');
			
			window.location.href=baseurl+'/thankyou.php';
			

		  }
		 
		 
        },
        error: function(result) {
            
        }
    });
		   
		
			
		
	}
	function enquiryformsubmit()
	{
		$('#enquiryemail').prop('readonly', true);

		 var buttons = document.getElementById("subscribe-button");
    buttons.innerHTML ='<img src="'+baseurl+'/images/803.gif" style=width:70%>';

		   var data = $("#enquiryform").serialize();
		   
		   $.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/ajaxCallToPhp/enquiryform.php",
        data: data,
        success: function(result) {
				

        	//alert(result.status);	

				//document.getElementById('filer-loader').style.display='none';

			
        if(result.status==1)
		 {
			
			$('#enquirypopup').modal('show');
			
			
			

		  }
		 
		 
        },
        error: function(result) {
            
        }
    });
		   
		
		}
	
	
function	sellingform()
{
	
	
	 var data = $("#sellingform").serialize();
	 $("#formnextbtn").prop('value', 'Processing'); //versions newer than 1.6
	          $("#formnextbtn").prop('type', 'button'); 
	fname=$("#sellname").val();
		lname=$("#sell_lname").val();

		email=$("#sell_email").val();
			phone=$("#sell_phone").val();
         //versions newer than 1.6

usernotes=$("#usernotes").val();
	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/sellform.php",
        data: { 
            fname: fname, 
        	lname:lname,
		usernotes:usernotes, 
			phone:phone,
		email:email,
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			 
			window.location.href=baseurl+"/thank-you";
			 
			 
			 }
		 else
		 {
						alert("Some problem has occurred.Please try again later!!");

	
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
		
	
		
		
	
	
	
	
}
	function bookingform()
	{
		
		
		
	
	
	 var data = $("#bookingform").serialize();
	 $("#formnextbtn").prop('value', 'Processing'); //versions newer than 1.6
	          $("#formnextbtn").prop('type', 'button'); 
	fname=$("#bookname").val();
		lname=$("#booklname").val();

		email=$("#bookemail").val();
		usernotes=$("#usernotes").val();
			hiddendate=$("#hiddendate").val();
			phone=$("#bookphone").val();
			listid=$("#P_listid").val();
	  var radioValue = $("input[name='realstate']:checked").val();
         //versions newer than 1.6

	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/bookform.php",
        data: { 
            fname: fname, 
        	lname:lname,
		usernotes:usernotes,
			phone:phone,
		email:email,
		realstate:radioValue,
		listid:listid,
		hiddendate:hiddendate
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			 
			window.location.href=baseurl+"/thank-you";
			 
			 
			 }
		 else
		 {
						alert("Some problem has occurred.Please try again later!!");

	
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
		
	
		
		
	}
	
	function registration_form()
	{
		
	
	
	 var data = $("#registerform").serialize();
	
	fname=$("#fname").val();
		lname=$("#lname").val();

		email=$("#uemail").val();
			
			upassword=$("#upassword").val();
			var url=document.getElementById('actual_urlforlogin').value;
redirection_val=$("#redirection_val").val();
 if(redirection_val==1) 
 {
	 
singleprop_id=$("#singleprop_id").val();	 
	 
 }

	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/register.php",
        data: { 
            fname: fname, 
        	lname:lname,
		
			upassword:upassword,
		email:email
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {  
			  $("#reg").modal('hide'); 
//$("#messagepopup").modal('show');	

addtowishlist(singleprop_id);
		window.location.href=url;

	  }
		 else
		 {
			//$('#contactfailed').modal('show');
	 $("#reg").modal('hide'); 
$("#messagepopup").modal('show');	
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
		
	}
	function submitagentform()
	{
	
	
	 var data = $("#agentform").serialize();
	
	fullname=$("#agentname").val();
		email=$("#agentemail").val();
			
			phone=$("#agentphone").val();
		message=$("#agentmsg").val();
	
	
	
	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/submitagentcontact.php",
        data: { 
            fullname: fullname, 
        	email:email,
		
			phone:phone,
		message:message
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			$('#contactsuccess').modal('show');

		  }
		 else
		 {
			$('#contactfailed').modal('show');
	
		 }
		 
        },
        error: function(result) {
            
        }
    });
}
	function submitadminForm()
	
	{
		
		
    var data = $("#adminlogin").serialize();
	
	username=$("#username").val();
	
	password=$("#password").val();
	
	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/checkadmincredentials.php",
        data: { 
            username: username, 
            password: password
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			 url=baseurl+"/adboshall/home.php";
			 //alert(url);
		window.location.href=url;

		  }
		 else
		 {
			  alert("Wrong credentials");
	
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
		}

function forget_form()
{

	

		
		
    var data = $("#forgetform_").serialize();
	
	username=$("#feemail").val();


	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/sendforgetemail.php",
        data: { 
            username: username, 
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			 
			  $("#fmsg").css("color", "green");
	$("#fmsg").html('Password Link has been successfully sent on your registered email!!');
			 
			 
			 }
		 else if(result.status==2)
		 {
			   $("#fmsg").css("color", "red");
	$("#fmsg").html('Email id doesnot exist!!');
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
			
	
	
	
}



function setUserPassword()
{

	

		
		
    var data = $("#change_password").serialize();
	
	password=$("#c_password").val();
	uid=$("#hiddenUserid").val(); 


	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/changepassword.php",
        data: { 
            password: password, 
			 uid: uid, 

        },
        success: function(result) {
			
        if(result.status==1)
		 {
				$("#c_password").val('');
	$("#cc_password").val('');
 
			  $("#fmsg").css("color", "green");
	$("#fmsg").html('Your password has been changed successfully !!');
			 
			 
			 }
		 else if(result.status==2)
		 {	$("#c_password").val('');
	$("#cc_password").val('');
			   $("#fmsg").css("color", "red");
	$("#fmsg").html('Your password couldnot be changed successfully');
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
			
	
	
	
}



function submituserForm()
{
	

		
		
    var data = $("#loginform_").serialize();
	
	username=$("#email").val();
	
	password=$("#password").val();
		var url=document.getElementById('actual_urlforlogin').value;
redirection_val=$("#redirection_val").val();
 if(redirection_val==1) 
 {
	 
singleprop_id=$("#singleprop_id").val();	 
	 
 }

	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/checkusercredentials.php",
        data: { 
            username: username, 
            password: password
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			 
			 if(redirection_val==1)
			 {
			addtowishlist(singleprop_id);
		window.location.href=url;

			 }
			 
			 else
			 {
						window.location.href=url;
 
				 
			 }
		  }
		 else
		 {
			  alert("Wrong credentials");
	
		 }
		 
        },
        error: function(result) {
            
        }
    });

		
		
			
	
}
function submitcontactform()

{
	
	
	 var data = $("#contactformmain").serialize();
	
	fullname=$("#fullname").val();
		email=$("#contcatemail").val();
			subject=$("#subject").val();	
			phone=$("#phone").val();
		message=$("#message").val();
	
	
	
	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/submitcontact.php",
        data: { 
            fullname: fullname, 
        	email:email,
			subject:subject,	
			phone:phone,
		message:message
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			$('#contactsuccess').modal('show');

		  }
		 else
		 {
			$('#contactfailed').modal('show');
	
		 }
		 
        },
        error: function(result) {
            
        }
    });
}

function submitsubscribeForm()

{

 var data = $("#subscribeform").serialize();
	
	username=$("#subemail").val();
	
	
	
	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/newsletter.php",
        data: { 
            username: username, 
            
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			$('#success').modal('show');

		  }
		 else
		 {
			$('#failed').modal('show');
	
		 }
		 
        },
        error: function(result) {
            
        }
    });
	}


function submitpropertyform()
{

 var data = $("#propertyform").serialize();
	
	propname=$("#propname").val();
	propid=$("#propid").val();
	propphone=$("#propphone").val();
	propemail=$("#propemail").val();
	propmsg=$("#propmsg").val();
	
	
	$.ajax({
        type: "POST",
		dataType:'json',
        url: baseurl+"/otherpages/propertylist.php",
        data: { 
            propname: propname, 
			propid: propid, 
			propphone: propphone, 
			propemail: propemail,
			propmsg:propmsg 
			
            
			
        },
        success: function(result) {
			
        if(result.status==1)
		 {
			$('#contactsuccess').modal('show');

		  }
		 else
		 {
			$('#contactfailed').modal('show');
	
		 }
		 
        },
        error: function(result) {
            
        }
    });
		

}
function updateStatus(id,table,status){


 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			 var splitText=response.split("###");

			 var result=splitText[0];

			 var msg=splitText[1];

			 if(result=='1'){

			 document.getElementById('check'+id).checked= true;	 

			 }

			 document.getElementById('status'+id).innerHTML= msg;

			}else{

			 document.getElementById('status'+id).innerHTML='<img src="'+baseurl+'/images/loading.gif">'  

		   }

			}

	 xmlHttpReq.open('GET',baseurl+'/ajaxCallToPhp/updatestatus.php?id='+id+'&table='+table+'&status='+status, true);

	 xmlHttpReq.send(null); 	

}

function featureproperty(id,table,status){


 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			 var splitText=response.split("###");

			 var result=splitText[0];

			 var msg=splitText[1];

			 if(result=='1'){

			 document.getElementById('check'+id).checked= true;	 

			 }

			 document.getElementById('feature'+id).innerHTML= msg;

			}else{

			 document.getElementById('feature'+id).innerHTML='<img src="'+baseurl+'/images/loading.gif">'  

		   }

			}

	 xmlHttpReq.open('GET',baseurl+'/ajaxCallToPhp/feature.php?id='+id+'&table='+table+'&status='+status, true);

	 xmlHttpReq.send(null); 	

}

function featurepropertysec1(id,table,status){


 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			 var splitText=response.split("###");

			 var result=splitText[0];

			 var msg=splitText[1];

			 if(result=='1'){

			 document.getElementById('check'+id).checked= true;	 

			 }

			 document.getElementById('featuresec1'+id).innerHTML= msg;

			}else{

			 document.getElementById('featuresec1'+id).innerHTML='<img src="'+baseurl+'/images/loading.gif">'  

		   }

			}

	 xmlHttpReq.open('GET',baseurl+'/ajaxCallToPhp/featuresec1.php?id='+id+'&table='+table+'&status='+status, true);

	 xmlHttpReq.send(null); 	

}

function featurepropertysec2(id,table,status){


 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			 var splitText=response.split("###");

			 var result=splitText[0];

			 var msg=splitText[1];

			 if(result=='1'){

			 document.getElementById('checksec'+id).checked= true;	 

			 }

			 document.getElementById('featuresec2'+id).innerHTML= msg;

			}else{

			 document.getElementById('featuresec2'+id).innerHTML='<img src="'+baseurl+'/images/loading.gif">'  

		   }

			}

	 xmlHttpReq.open('GET',baseurl+'/ajaxCallToPhp/featuresec2.php?id='+id+'&table='+table+'&status='+status, true);

	 xmlHttpReq.send(null); 	

}

function redirect_to()
{
	var actual_urlforlogin=document.getElementById('actual_urlforlogin').value;

	window.location.href=actual_urlforlogin;
	
}

function price_filter(vals,url)
{ type=1;
	var category=document.getElementById('category').value;
	
		var location=document.getElementById('location').value;

		var priceval=document.getElementById('priceval').value;
		
	var urls=url+"/"+category+"/"+location+"/"+type+"/"+priceval;
	window.location.href=urls;
	
	
	
}






function addtowishlist(property_id)
{
	
	
	
var xmlHttpReq = false;

    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();

    }
	else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	xmlHttpReq.onreadystatechange = function()

      {
	if (xmlHttpReq.readyState == 4)

	   {       
	response=xmlHttpReq.responseText;


		 if(response==1){
$('#propertymark'+property_id).find('.fa').removeClass("fa-heart-o");$('#propertymark'+property_id).find('.fa').addClass("fa-heart");	 
			 
		success();	 
			 }
			 
			  if(response==0){
$('#propertymark'+property_id).find('.fa').removeClass("fa-heart");$('#propertymark'+property_id).find('.fa').addClass("fa-heart-o");	 
			 
			error(); 
			 }
	
	else
	{
        
    if(response==2){

      
    }
		
	}


	
	
	}else{
   
	// document.getElementById('aloginproceed').value='Verifying..'  

		}} 

xmlHttpReq.open('GET',baseurl+'/otherpages/wishlist.php?property_id='+escape(property_id), true);

	 xmlHttpReq.send(null); 	

	
	
}
 
 function setminprice(val,type)
 {newval=val.trim();
 
 var beds=document.getElementById('beds').value;
 beds="/"+beds; 
		var baths=document.getElementById('baths').value;
		var regex = /^[a-zA-Z ]*$/;
		/*if(beds.match(regex))
		{
			beds="";
			
		}
		
		else
		{
			beds="/"+beds;
			
		}*/
		
		if(baths.match(regex))
		{
			
			baths="";
		}
		else
		{
			baths="/"+baths;
			
		}
	 if(type==1)
	 {
previous_url=document.getElementById('urlfor_filter').value;
		var max_price=document.getElementById('max_price').value;

		

	 window.location.href=previous_url+newval+"/"+max_price+beds+baths;
	 }
	 
	 else if(type==2)
	 {
		var min_price=document.getElementById('min_price').value;
previous_url=document.getElementById('urlfor_filter').value;
	 window.location.href=previous_url+min_price+"/"+newval+beds+baths; 
	 
	 }
	 
	 
	 else if(type==3)
	 {
		var min_price=document.getElementById('min_price').value;
		
		var max_price=document.getElementById('max_price').value;

		
		if(newval=="beds")
		{
			newval="";
		}
		else
		{
			
		newval="/"+newval;
		}
	
previous_url=document.getElementById('urlfor_filter').value;
	 window.location.href=previous_url+min_price+"/"+max_price+newval+baths; 
		 
	 }
	 
	 else if(type==4)
	 {    
		var min_price=document.getElementById('min_price').value;
		
		var max_price=document.getElementById('max_price').value;

		
		if(newval=="baths")
		{
			newval="";
		}
		else
		{
			
		newval="/"+newval;
		}
	
previous_url=document.getElementById('urlfor_filter').value;
	 window.location.href=previous_url+min_price+"/"+max_price+beds+newval; 
		 
	 }
 }
 
     
 
 function setmaxprice(val)
 {newval=val.trim();
	
	 
 }
 function wishlist(propid)
{
	$('#redirection_val').val(1);
	singleprop_id=$('#singleprop_id').val(propid);
	u_id=document.getElementById('u_id').value;
	if(u_id=='')
	{
		//jQuery.noConflict();
		$('#reg').modal('show');   
		
	}
	
	else
	{
	addtowishlist(propid);	
		
		
	}
	
}
 

function addtowishlistpage(property_id)
{
	
	
	
var xmlHttpReq = false;

    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();

    }
	else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	xmlHttpReq.onreadystatechange = function()

      {
	if (xmlHttpReq.readyState == 4)

	   {       
	response=xmlHttpReq.responseText;

  var sptRes=response.split("##");
var htmlresult=sptRes[0];
var result=sptRes[1];


$('#wishlist_list').html(result); 
		 if(htmlresult==1){
$('#propertymark'+property_id).find('.fa').removeClass("fa-heart-o");$('#propertymark'+property_id).find('.fa').addClass("fa-heart");	 
			 
		success();	 
			 }
			 
			  if(htmlresult==0){
$('#propertymark'+property_id).find('.fa').removeClass("fa-heart");$('#propertymark'+property_id).find('.fa').addClass("fa-heart-o");	 
			 
			error(); 
			 }
			 
			
	
	else
	{
        
    if(htmlresult==2){

      
    }
		
	}


	
	
	}else{
   
	// document.getElementById('aloginproceed').value='Verifying..'  

		}} 

xmlHttpReq.open('GET',baseurl+'/otherpages/wishlistpage.php?property_id='+escape(property_id), true);

	 xmlHttpReq.send(null); 	

	
	
}

function setDates(val)
{

	$("#hiddendate").val(val);
	
}


function forgetmodal()
{
	
$("#reg").modal('hide');
		$("#forget_form").modal('show');

	
}