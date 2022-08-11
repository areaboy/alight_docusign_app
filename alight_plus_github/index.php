<?php
error_reporting(0);
include('settings.php');


?>


<!DOCTYPE html>
<html lang="en">





<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="moment.js"></script>
	<script src="livestamp.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




    <title>Docusign Applications</title>

</head>

<style>

.imagelogo_li_remove {
list-style-type: none;
margin: 0;
 padding: 0;
}

.imagelogo_data{
 width:120px;
 height:80px;
}

 .bottomcorner_css{
  //position:fixed;
position:absolute;
  bottom:0;
  right:0;
  }


 .topcorner_css{
  //position:fixed;
position:absolute;
  top:10;
  right:0;
  }


</style>


<body>




    


    <div>


 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Alight Docusign</a>
    </div>
    <ul class="nav navbar-nav">
<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>

      <li><a <a style='cursor:pointer;' class="nav-link" data-toggle="modal" data-target="#myModal_about" title="About">About</a></li>
      <li><a style='cursor:pointer;' class="nav-link" data-toggle="modal" data-target="#myModal_contact" title="Contact-Us">ContactUs</a></li>
      <li><a style='cursor:pointer;' class="nav-link" data-toggle="modal" data-target="#myModal_signup" title=" Signup">Admin Signup</a></li>
<li class="nav-item">

                            <a style='cursor:pointer;' class="nav-link" data-toggle="modal" data-target="#myModal_login" title="Login">Admin Login</a>
                        </li>
    </ul>
  </div>
</nav> 














<br><br><br>






<br><br>

<h2><center>Alight Docusign :An Interactive Web Applications that Connects Ukrainians Refugees with Alight Refugees Supports Services Nonprofit Organisations. </center></h2>
<center>

<br><b style='font-size:20px;'>Powered By Docusign E-Signature API, Google Map, Google Chart Statictics, Email and Twilio SMS Messages Campaign</b><br>
</center>





<style>
    
  .needyx_css{
      background:navy;
      color:white;
      padding:20px;
      border:none;
      border-radius:20%;
      cursor:pointer;
      width:80%;
  }  
 
.needyx_css:hover{
 color: black;
 background-color: orange;
cursor:pointer;
 //width:45%;
}  

.needy_css{
      background:fuchsia;
      color:white;
      padding:20px;
      border:none;
      border-radius:20%;
      cursor:pointer;
      width:80%;
  }  
 
.needy_css:hover{
    cursor:pointer;
 color: black;
 background-color: orange;

 //width:50%;
}  
</style><br><br>
        <div class="container">
            <div class="row">


<div class="col-sm-6  well alerts alert-warning">
               
<br><br>
<h3>Alight Refugees Humanitarian NonProfit Organisation</h3><br>
 You are a Ukranian Refugees Seeking for Help. Click button below to apply for help....<br>

<button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal">Apply For Help</button>



                </div>


                <div class="col-sm-6">
               

<img class='img-thumbnail border-0' style='width:450px;height:300px; 
max-width:450px;max-height:300px;' src='base2.png' title='Image'><br><br>


                </div>



              
            </div>
        </div>




        <div class="container">
            <div class="row justify-content-center text-center border-top py-2">
                <span>&copy;2022.Alight Docusign.</span>
            </div>
        </div>
    </div>


</body>
</html>



















<script>



// signup starts

$(document).ready(function(){
$('#signup_btn').click(function () {

var username  = $('#username_s').val();
var password = $('#password_s').val();
var fullname = $('#fullname_s').val();
var phone_no = '0';
var status = 'Admin';
//alert(status);

 if(fullname==""){
alert('please Enter Fullname');
}


 else if(phone_no==""){
alert('please Enter Phone No');
}


 else if(username==""){
alert('please Enter Email');
}

else if(password==""){
alert('please Enter Password');
}

else if(status==undefined){
alert('please Pick Your Status');
}



else{


$("#loader-signup").fadeIn(400).html('<br><div style="color:white;background:#800000;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Your data is being Created...</div>');
var datasend = {username:username, password:password, fullname:fullname, phone_no:phone_no, status:status};


	
		$.ajax({
			
			type:'POST',
			url:'signup.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-signup").hide();
$("#result-signup").html(msg);
setTimeout(function(){ $("#result-signup").html(''); }, 5000);


// clear all customers Data
//$('#emailxy').val('');		
//$('#passwordxy').val('');	


	
}
			
		});
		
		}

});

});

// signup ends


//login starts

$(document).ready(function(){
$('#login_btn').click(function () {

var username  = $('#username').val();
var password = $('#password').val();





 if(username==""){
alert('please Enter Email');
}

else if(password==""){
alert('please Enter Password');
}




else{


$("#loader-login").fadeIn(400).html('<br><div style="color:white;background:#800000;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Your are being login as Admin...</div>');
var datasend = {username:username, password:password};


	
		$.ajax({
			
			type:'POST',
			url:'login.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-login").hide();
$("#result-login").html(msg);
setTimeout(function(){ $("#result-login").html(''); }, 5000);


// clear all customers Data
//$('#emailxy').val('');		
//$('#passwordxy').val('');	


	
}
			
		});
		
		}

});

});

//  login ends
</script>






 <script>

function imagePreview(e) 
{
 var readImage = new FileReader();
 readImage.onload = function()
 {
  var displayImage = document.getElementById('imageupload_preview');
  displayImage.src = readImage.result;
 }
 readImage.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#save_btn').click(function () {
                 
                   
                    var file_fname = $('#file_content').val();
                    //var country = $('#country').val();
                    var emailaddress_pot = $('#emailaddress_pot').val();
var email = $('#emailv').val();
                    //preparing Email for validations
                    var atemail = email.indexOf("@");
                    var dotemail = email.lastIndexOf(".");



var reg_no = $('#reg_no').val();
var case_no = $('#case_no').val();

var phoneno = $('#phonenov').val();
var lastname = $('#lastname').val();
var firstname = $('#firstname').val();
var  middlename= $('#middlename').val();
var gender = $('#gender').val();
var dob = $('#dob').val();
var pob = $('#pob').val();
var address = $('#address').val();
var citizenship = $('#citizenship').val();
var ethinicity = $('#ethinicity').val();
var religion = $('#religion').val();
var country = citizenship;
var language = $('#language').val();
var other_language = $('#other_language').val();
var name_doc = $('#name_doc').val();
var doc_no = $('#doc_no').val();
var doc_type = $(".doc_type:checked").val();
var place_issuance = $('#place_issuance').val();
var issuing_authority = $('#issuing_authority').val();





// start if validate
if(file_fname==""){
alert('please Select File to Upload');
}

else if(reg_no==""){
alert('please Enter Reg no');
}

else if(case_no==""){
alert('please Enter Ressettlement No.');
}


else if(email==""){
alert('please Enter Email Address');
}

else  if (atemail < 1 || ( dotemail - atemail < 2 )){
alert("Please enter valid email Address")
}

else if(phoneno==""){
alert('Please Enter Phoneno');
}


else if(lastname==""){
alert('Enter Lastname');
}

else if(firstname==""){
alert('Enter Firstname');
}

else if(middlename==""){
alert('Enter Middle Name');
}
else if(gender==""){
alert('Select Gender');
}
else if(dob==""){
alert('Select Date of Birth');
}

else if(pob==""){
alert('Enter Place of Birth');
}

else if(address==""){
alert('Enter Address');
}

else if(citizenship==""){
alert('Enter Citizenship Or Nationality');
}
else if(ethinicity==""){
alert('Enter Ethic Group Or Tribal Group');
}

else if(religion==""){
alert('Enter Religion');
}
else if(language==""){
alert('Enter Language');
}
else if(other_language==""){
alert('Enter Other Language Spoken');
}
else if(doc_type==""){
alert('Select Documents Identification Type');
}
else if(name_doc==""){
alert('Enter Name as Appeared on Documents');
}
else if(doc_no==""){
alert('Enter Documents Identification No.');
}
else if(place_issuance==""){
alert('Enter Documents Place of Issuance');
}
else if(issuing_authority==""){
alert('Enter Issuing Authority');
}

else{

var fname=  $('#file_content').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a Valid image. Only Images Files are allowed");
return false;
    }

          var form_data = new FormData();
          form_data.append('file_content', $('#file_content')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('email', email);

          form_data.append('emailaddress_pot', emailaddress_pot);
form_data.append('reg_no', reg_no );
form_data.append('case_no', case_no);
form_data.append('phoneno', phoneno);
form_data.append('lastname', lastname);
form_data.append('firstname', firstname);
form_data.append('middlename', middlename);
form_data.append('dob', dob);
form_data.append('pob', pob);
form_data.append('address', address);
form_data.append('citizenship', citizenship);
form_data.append('ethinicity', ethinicity);
form_data.append('religion', religion);
form_data.append('country', country);
form_data.append('language', language);
form_data.append('other_language', other_language);
form_data.append('name_doc', name_doc);
form_data.append('doc_no', doc_no);
form_data.append('doc_type', doc_type);
form_data.append('place_issuance', place_issuance);
form_data.append('issuing_authority', issuing_authority);
form_data.append('gender', gender);
                    $('.upload_progress').css('width', '0');
                    $('#btn').attr('disabled', 'disabled');
                    $('#loader').fadeIn(400).html('<br><span class="well" style="color:black"><img src="ajax-loader.gif">&nbsp;Please Wait, Your Data is being Submitted</span>');
                    $.ajax({
                        url: 'docusign_refugees.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress').css('width', upload_percent + '%');
                                    $('.upload_progress').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
                                $('#box').val('');
				$('#loader').hide();
				$('.result_data').fadeIn('slow').prepend(msg);
				$('#alertdata_uploadfiles').delay(5000).fadeOut('slow');
                                $('#alerts_reg').delay(5000).fadeOut('slow');
                                $('#alertdata_uploadfiles2').delay(20000).fadeOut('slow');
                                $('#save_btn').removeAttr('disabled');


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_fname').val('');
$('#email').val('');

}




                        }
                    });
} // end if validate
                });
            });




        </script>
    </head>
    <body>
<style>
.upload_progress{
padding:10px;
background:green;
color:white;
cursor:pointer;
min-width:30px;
}

#imageupload_preview
{
max-height:200px;
max-width:200px;
}
</style>
 

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Refugees Form Registrations</h4>
      </div>
      <div class="modal-body">
        <p>Request for Help</p>




<!--start form-->
<form id="" method="post">



<div class="well">
<h2>Refugee Personal Information </h2>
<div class="form-group">
<label style="">Select  Photo: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="image/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"/>
</div>




<div class="form-group">
              <label style="" for="">
 Refugee Registration Number</label>
              <input type="text" class="col-sm-12 form-control" id="reg_no" name="reg_no" value="<?php echo  $time= time(); ?>">
            </div>




<div class="form-group">
              <label style="" for="">
 Resettlement Support Center(RSC) Case No</label>
              <input type="text" class="col-sm-12 form-control" id="case_no" name="case_no" value="<?php 

$mt_id=rand(0000,9999);
 $time= time();
echo $time.$mt_id; ?>">
            </div>


<div class='row'>
<div class="form-group col-sm-4">
              <label style="" for="">
 Lastname</label>
              <input type="text" class="col-sm-12 form-control" id="lastname" name="lastname" placeholder="Enter lastname">
            </div>



<div class="form-group col-sm-4">
              <label style="" for="">
Firstname</label>
              <input type="text" class="col-sm-12 form-control" id="firstname" name="firstname" placeholder="Enter firstname ">
            </div>



<div class="form-group col-sm-4">
              <label style="" for="">
 Middlename</label>
              <input type="text" class="col-sm-12 form-control" id="middlename" name="middlename" placeholder="Enter Middlename ">
            </div>
</div>


<div class='row'>

<div class="form-group col-sm-4">
              <label style="" for="">
 Email</label>
              <input type="text" class="col-sm-12 form-control" id="emailv" name="emailv" placeholder="Enter Email">
            </div>


<div class="form-group col-sm-4">
              <label style="" for="">
 Phone No (Eg:  +2349135775247 )  Add plus sign</label>
              <input type="text" class="col-sm-12 form-control" id="phonenov" name="phonenov" placeholder="Enter Phone No.">
            </div>




<div class="form-group col-sm-4">
              <label style="" for="">
 Gender</label>
              <select class="col-sm-12 form-control" id="gender" name="gender" >
<option value="">---Select Gender---</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
            </div>



</div>


</div>






<div class=" alerts alert-info">
<h2>Refugees Places Information </h2>




<div class='row'>

<div class="form-group col-sm-6">
              <label style="" for="">
 Date Of Birth</label>
              <input type="date" class="col-sm-12 form-control" id="dob" name="dob" placeholder="Date Of Birth">
            </div>


<div class="form-group col-sm-6">
              <label style="" for="">
 Place/Country of Birth </label>
              <input type="text" class="col-sm-12 form-control" id="pob" name="pob" placeholder="Place/Country of Birth">
            </div>



</div>



<div class="form-group col-sm-12">
              <label style="" for="">
 Full Home Address Eg. (Broadway 10012, New York, USA) </label>
              <input type="text" class="col-sm-12 form-control" id="address" name="address" value="Broadway 10012, New York, USA">
            </div>



<div class='row'>
<div class="form-group col-sm-4">
              <label style="" for="">
 citizenship Or Nationality</label>
              <input type="text" class="col-sm-12 form-control" id="citizenship" name="citizenship" placeholder="citizenship Or Nationality">
            </div>


<div class="form-group col-sm-4">
              <label style="" for="">
 Ethinicity  </label>
              <input type="text" class="col-sm-12 form-control" id="ethinicity" name="ethinicity" placeholder="Enter Ethinicity.">
            </div>


<div class="form-group col-sm-4">
              <label style="" for="">
 Religion  </label>
              <input type="text" class="col-sm-12 form-control" id="religion" name="religion" placeholder="Enter Religion.">
            </div>



</div>




<div class='row'>
<div class="form-group col-sm-6">
              <label style="" for="">
 Language(Native)</label>
              <input type="text" class="col-sm-12 form-control" id="language" name="language" placeholder="Enter Native Language">
            </div>


<div class="form-group col-sm-6">
              <label style="" for="">
 Other languages Spoken  </label>
              <input type="text" class="col-sm-12 form-control" id="other_language" name="other_language" placeholder="Enter Other languages Spoken.">
            </div>

</div>



</div>








<div class="alerts alert-warning">
<h2>Refugees Identification Details </h2>







 <div class="form-group col-sm-12">
              <label style="" for="">
Document Type</label><br>

<input type="radio" id="doc_type" name="doc_type" value="National Identity card" class="doc_type"/> National Identity card<br>
<input type="radio" id="doc_type" name="doc_type" value="International Passport" class="doc_type"/> International Passport

</div>



<div class='row'>


<div class="form-group col-sm-6">
              <label style="" for="">
 Document Identity Number </label>
              <input type="text" class="col-sm-12 form-control" id="doc_no" name="doc_no" placeholder="Enter Document Identity Number.">
            </div>




<div class="form-group col-sm-6">
              <label style="" for="">
 Your Name as Appears on Documents  </label>
              <input type="text" class="col-sm-12 form-control" id="name_doc" name="name_doc" placeholder="Enter Your Name as Appears on Documents.">
            </div>


</div>




<div class='row'>


<div class="form-group col-sm-6">
              <label style="" for="">
 Documents Place Of Issuance  </label>
              <input type="text" class="col-sm-12 form-control" id="place_issuance" name="place_issuance" placeholder="Enter Documents Place Of Issuance.">
            </div>




<div class="form-group col-sm-6">
              <label style="" for="">
 Issuing Authority  </label>
              <input type="text" class="col-sm-12 form-control" id="issuing_authority" name="issuing_authority" placeholder="Enter Issuing Authority.">
            </div>


</div>





</div>




<style>
.secured_pot{ display:none; } /* hide because is spam protection */
</style>
<input class="secured_pot" type="text" name="emailaddress_pot" id="emailaddress_pot" />


                    <div class="form-group">
                            <div class="upload_progress" style="width:0%">0%</div>

                        <div id="loader"></div>
                        <div class="result_data"></div>
                    </div>

                    <input type="button" id="save_btn" class="pull-right btn btn-primary" value="Submit" />
                </form>

<!--end form-->





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Admin login Modal start -->



<div id="myModal_signup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Admin Signup System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
 
Admin Signup System....<br><br>
 <div class="form-group">
              <label> Fullname: </label>
              <input type="text" class="col-sm-12 form-control" id="fullname_s" name="fullname_s"  value="Alight Humanitarian Services">
            </div>


 


 <div class="form-group">
              <label>Email: </label>
              <input type="text" class="col-sm-12 form-control" id="username_s" name="username_s"  value="Alight">
            </div>
 
 <div class="form-group">
              <label>Password: </label>
              <input type="password" class="col-sm-12 form-control" id="password_s" name="password_s"  value="Alight">
            </div>





<br>
<div id="loader-signup"></div>
<div id="result-signup"></div>


                    <input type="button" id="signup_btn" class="btn btn-primary" value="Signup Now!" />



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- signup Modal ends -->


<!--  login Modal start -->
<div class="modal fade" id="myModal_login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Users Login System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
 
Admin Login System.....<br><br>

 <div class="form-group">
              <label>Email: </label>
              <input type="text" class="col-sm-12 form-control" id="username" name="username"  value="Alight">
            </div>
 
 <div class="form-group">
              <label>Password: </label>
              <input type="password" class="col-sm-12 form-control" id="password" name="password"  value="Alight">
            </div>

<br>
<div id="loader-login"></div>
<div id="result-login"></div>


                    <input type="button" id="login_btn" class="btn btn-primary" value="Login Now!" />



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!--  login Modal ends -->














<!-- Contact Modal start -->
<div class="modal fade" id="myModal_contact">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Contact Us</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
 
Sites Contacts Informations Goes here<br><br>





      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

    </div>
  </div>
</div>

<!-- contact Modal ends -->








<!-- about Modal start -->
<div class="modal fade" id="myModal_about">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">About Us</h4>
        <button type="button" class="btn-close" data-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
 
About Us Informations Goes here<br><br>





      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- about Modal ends -->






<script>
$(document).ready(function(){

var refresh_token = 'refresh_token';


if(refresh_token==''){
alert('Refresh Token Cannot be Empty');

}

else{

$('#loader_recnvxx').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Update in Progress..</div>');
var datasend = {refresh_token:refresh_token};


$.ajax({
			
			type:'POST',
			url:'docusign_token_refresh_new.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_recnvxx').hide();
				//$('#result_recnvxx').fadeIn('slow').prepend(msg);
$('#result_recnvxx').html(msg);
$('#alertdata_recnvxx').delay(5000).fadeOut('slow');
$('.alertdata_rxx').delay(5000).fadeOut('slow');


			
			}
			
		});
		
		}
		
	});
					





</script>

<div id='loader_recnvxx'></div>
<div id='result_recnvxx'></div><br>






