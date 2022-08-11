<?php
error_reporting(0);
include('settings.php');
$timerx = time();

session_start();
//set session
if(!isset($_SESSION['user_session']) || (trim($_SESSION['user_session']) == '')) {
echo "<script>alert('Session Expired. Direct access to this Page Not allowed..');</script>";
		header("location: index.php");
		exit();
	}



$fname_sess = $_SESSION['user_fullname_session'];
$id_sess =$_SESSION['user_id_session'];
$email_sess= $_SESSION['user_email_session'];


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
  <script src="jquery.dataTables.min.js"></script>
  <script src="dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



    <title>Welcome  <?php echo $fname_sess; ?></title>

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





</head>

<body>
    <div>
        
 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Alight Docusign</a>
    </div>
    <ul class="nav navbar-nav">
<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>
<li><a <a style='cursor:pointer;' class="nav-link" data-toggle="modal" data-target="#myModal_token" title="Generate Docusign Token">Generate Docusign Token</a></li>
      <li><a style='cursor:pointer;' class="nav-link" href="statistics.php">Statistics</a></li>
<li class="nav-item">

                            <a class="nav-link" href="logout.php" title="Logout">Logout</a>
                        </li>
    </ul>
  </div>
</nav> 




<br><br><br>


<h3>Welcome  <b><?php echo $fname_sess; ?></b></h3>

<br>





<?php
include('data6rst.php');


$result = $db->prepare("SELECT * FROM refugees where needy='1' ");
$result->execute(array());
$rows = $result->fetch();
$counting_result = $result->rowCount();




$resultc = $db->prepare("SELECT * FROM refugees where status='Open' ");
$resultc->execute(array());
$rowsc = $resultc->fetch();
$counting_open = $resultc->rowCount();




$resultc = $db->prepare("SELECT * FROM refugees where status='Closed' ");
$resultc->execute(array());
$rowsc = $resultc->fetch();
$counting_closedx = $resultc->rowCount();
?>
<div class='row'>

<div class='col-sm-4' style='background:#ddd;'>
<b style='font-size:20px'>
(<?php echo $counting_result; ?>) </b><br>
Total Registered Refugees

</div>


<div class='col-sm-4' style='background:#ddd;'>
<b style='font-size:20px'>
<?php echo $counting_open; ?>  </b><br>
Total Refugees Awaiting Approval



</div>

<div class='col-sm-4' style='background:#ccc;'>
<b style='font-size:20px'>
(<?php echo $counting_closedx; ?>) </b><br>
Total Refugees Approved/Accepted

</div>


</div><br>






<div class="container">
<div class="row">
<div class="col-sm-12 table-responsive">
<div class="alert_server_response"></div>
<div class="loader_x"></div>
<table id="backup_content" class="table table-bordered table-striped">
<thead><tr>
<th>Photo</th>
<th>Fullname</th>
<th>Reg No.</th>
<th>View Docusign Details</th>
<th>Docusign Document Status</th>
<th>Download Signed Documents</th>
<th>Refugee Status</th>
<th>Time</th>
<th>Actions</th>
</tr></thead>
</table>
</div>
</div>
</div>




<!-- Modal -->
  <div class="modal fade" id="myModal_token" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Docusign Token Generation</h4>
        </div>
        <div class="modal-body">

<script>


$(document).ready(function(){
$('#token_btn').click(function(){
		

var client_id = $('#client_id').val();
var redirect_url = $('#redirect_url').val();


var token_all ="https://account-d.docusign.com/oauth/auth?response_type=code&scope=YOUR_REQUESTED_SCOPES&client_id=<?php echo $integratorKey; ?>&state=<?php echo $timerx; ?>&redirect_uri=<?php echo $docusign_redirect_url_token_generate; ?>";
//alert(token_all);

if(client_id =''){
alert('Docusign Client ID/Integration Key cannot be Empty. Please set it as Integration Key at settings.php file');
return false;
}

if(redirect_url =''){
alert('Docusign Redirect URL cannot be Empty. Please set it  at settings.php file');
return false;
}


$('#loader_token').hide();
$('#result_token').html(token_all);


$("#result_token").html("<br><br><a href=' "+token_all+"' target='_blank' style='font-size:12px;color:white;background:navy;padding:6px;border:none;border-radius:15%;text-align:center;'>Please Continue with Token Generation</a>");

$(".btn_hide").hide();

})
});
</script>
       

 <div class="form-group">
              <label style="" for="">
Docusign Client ID/Integration Key</label>
              <input disabled type="text" class="col-sm-12 form-control" id="client_id" name="client_id"  value="<?php echo substr($integratorKey, 0,10)."xxxxxxxxxxxxxxxxxxxxx"; ?>">

            </div>


<div class="form-group">
              <label style="" for="">
Redirect URL</label>
              <input disabled type="text" class="col-sm-12 form-control" id="redirect_url" name="redirect_url"  value="<?php echo $docusign_redirect_url_token_generate; ?>">

            </div>

<br>
<div class="form-group">
<div id="loader_token" ></div>

<div id="result_token" class=''></div>
<br />

<button type="button" id="token_btn" class="btn btn-primary btn_hide" title='Generate Token'>Generate Token Now!</button>
</div>


<?php



include('data6rst.php');
$result = $db->prepare('SELECT * FROM users where  id =:id');
$result->execute(array(':id' => $id_sess));
$nosofrows = $result->rowCount();

$row = $result->fetch();

$access_tokenx = $row['access_token'];
if($access_tokenx ==''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Docusign Access Token is Empty. Please Generate Access Token as Admin</div>";

}else{
echo "<div style='background:green;color:white;padding:10px;border:none;'>Docusign Access Token has already been Generated by Admin. The App is set to Use...</div>";
}

?>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>





<span class="alert_server_response"></span>
<span class="loader_x"></span>



<script>
$(document).ready(function(){
//$('.btn_call').click(function(){
$(document).on( 'click', '.btn_call', function(){ 



var id = $(this).data('id');
var address = $(this).data('address');
var country = $(this).data('country');
var email = $(this).data('email');
var fullname = $(this).data('fullname');

var comments = $(this).data('comments');
var phone_no  = $(this).data('phone_no');
//alert(id);
//alert(title);



$('.p_id').html(id);
$('.p_address').html(address);
$('.p_country').html(country);
$('.p_email').html(email);
$('.p_fullname').html(fullname);
$('.p_comments').html(comments);
$('.p_identity_value').val(id).value;
$('.p_email_value').val(email).value;
$('.p_fullname_value').val(fullname).value;
$('.p_phone_no_value').val(phone_no).value;
$('.p_phone_no').html(phone_no);

});

});






// clear Modal div content on modal closef closed
$(document).ready(function(){

$("#myModal_carto").on("hidden.bs.modal", function(){
    //$(".modal-body").html("");
 $('.mydata_empty').empty(); 
$('#qty').val(''); 
});



});


</script>




<script>
$(document).ready(function(){
//$('.btn_action').click(function(){
$(document).on( 'click', '.btn_action', function(){ 

var id = $(this).data('id');
var reg_no = $(this).data('reg_no');
var case_no = $(this).data('case_no');
var email = $(this).data('email');
var lastname = $(this).data('lastname');
var firstname = $(this).data('firstname');
var middlename = $(this).data('middlename');
var dob = $(this).data('dob');
var pob = $(this).data('pob');
var address = $(this).data('address');
var gender = $(this).data('gender');
var citizenship = $(this).data('citizenship');
var ethinicity = $(this).data('ethinicity');
var status = $(this).data('status');
var religion = $(this).data('religion');
var country = $(this).data('country');
var timing = $(this).data('timing');
var lat = $(this).data('lat');
var lng = $(this).data('lng');
var language = $(this).data('language');
var other_language = $(this).data('other_language');
var name_doc = $(this).data('name_doc');
var doc_no = $(this).data('doc_no');
var doc_type = $(this).data('doc_type');
var place_issuance = $(this).data('place_issuance');
var issuing_authority = $(this).data('issuing_authority');
var fullname = $(this).data('fullname');
var photo = $(this).data('photo');
var docufile = $(this).data('docufile');
var phone_no = $(this).data('phone_no');

var document_name = $(this).data('document_name');
var document_status = $(this).data('document_status');
var docusign_envelope_id = $(this).data('docusign_envelope_id');
var docusign_account_id = $(this).data('docusign_account_id');
var docusign_base_url = $(this).data('docusign_base_url');


$('.p_id').html(id);
$('.p_reg_no').html(reg_no);
$('.p_case_no').html(case_no);
$('.p_email').html(email);
$('.p_lastname').html(lastname);
$('.p_firstname').html(firstname);
$('.p_middlename').html(middlename);
$('.p_dob').html(dob);
$('.p_pob').html(pob);
$('.p_address').html(address);
$('.p_gender').html(gender);
$('.p_citizenship').html(citizenship);
$('.p_ethinicity').html(ethinicity);
$('.p_status').html(status);
$('.p_religion').html(religion);
$('.p_country').html(country);
$('.p_timing').html(timing);
$('.p_lat').html(lat);
$('.p_lng').html(lng);
$('.p_language').html(language);
$('.p_other_language').html(other_language);
$('.p_name_doc').html(name_doc);
$('.p_doc_no').html(doc_no);
$('.p_doc_type').html(doc_type);
$('.p_place_issuance').html(place_issuance);
$('.p_issuing_authority').html(issuing_authority);
$('.p_fullname').html(fullname);
$('.p_phone_no').html(phone_no);

$('.p_docufile').html(docufile);

$('.p_document_name').html(document_name);
$('.p_document_status').html(document_status);
$('.p_docusign_envelope_id').html(docusign_envelope_id);
$('.p_docusign_account_id').html(docusign_account_id);
$('.p_docusign_base_url').html(docusign_base_url);



$('.p_docusign_envelope_id_value').val(docusign_envelope_id).value;
$('.p_lname_value').val(lastname).value;
$('.p_file_namex_value').val(document_name).value;

$('.p_idx_value').val(id).value;

var pix = "<span>" +
"<img src='uploads/" + photo +"'  style='text-align:left;border-radius:50%;width:160px;max-width:160px;height:160px;max-height:160px;border-style: solid; border-width:3px; border-color: orange;'>" +
 "</span>";

$('.p_photo').html(pix);



});

});






// clear Modal div content on modal closef closed
$(document).ready(function(){

$("#myModal_sales").on("hidden.bs.modal", function(){
    //$(".modal-body").html("");
 $('.mydata_emptyx').empty(); 
});



});











   $(document).ready(function(){
//$(".reloadData").click(function(){
$(document).on( 'click', '.reloadData', function(){ 

location.reload();

});

});





$(document).ready(function(){

//$('.updates_btn').click(function(){
$(document).on( 'click', '.updates_btn', function(){ 

// confirm start
if(confirm("Are you sure you want to Mark this Refugee as Accepted... ")){
var id = $(this).data('id');


$(".loader-updates_"+id).fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait, Refugee Status is being Updated...</div>');
var datasend = {'id': id};
		$.ajax({
			
			type:'POST',
			url:'updates.php',
			data:datasend,
                         dataType: 'json',
                        crossDomain: true,
			cache:false,
			success:function(msg){

var status = msg['status'];
var message = msg['message'];
//alert(status);
//alert(message);

if(message == 2){
alert('Only Admin can Mark Refugee as Accepted..');
}


	if(message == 1){

//$(".loader-updates_"+id).hide();
//$(".result-updates_"+id).html("<div style='width: 90px;color:white;background:green;padding:10px;'>Updates  Successfully</div>");
//setTimeout(function(){ $(".result-updates_"+id).html(''); }, 5000);
//location.reload();

alert('Updates Successful');
$("#status_"+id).text(status);
$("#status1_"+id).text('Accepted');
$(".statuscolor_"+id).text('green_css');

$(".stx_"+id).html("<div style='width: 90px;font-size:12px;color:white;background:green;padding:6px;border:none;border-radius:15%;text-align:center;'>Accepted</div>");

$("#statushide_"+id).hide();
$("#statushide2_"+id).hide();

$(".loader-updates_"+id).hide();

}



}
			
});
}

// confirm ends

                });


            });



















$(document).ready(function(){

//$('.docupdates_btn').click(function(){
$(document).on( 'click', '.docupdates_btn', function(){ 

// confirm start
if(confirm("Are you sure you want to Check/Update Docusign Document Status... ")){
var id = $(this).data('id');
var envelope_id = $(this).data('envelope_id');

//alert(id);
//alert(envelope_id);

$(".docloader-updates_"+id).fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait, Docusign Status is being Check and Updated...</div>');
var datasend = {'id': id,envelope_id:envelope_id};
		$.ajax({
			
			type:'POST',
			url:'docusign_updates.php',
			data:datasend,
                         dataType: 'html',
                        crossDomain: true,
			cache:false,
			success:function(msg){

//alert(msg);
//var status = msg['status'];
//var message = msg['message'];
//alert(status);
//alert(message);

var status = '';


	if(msg.trim() == 'sent'){

alert('Docusign Documents Status: (Sent)');
$("#docstatus_"+id).text(status);
$("#docstatus1_"+id).text('Sent');
$(".docstatuscolor_"+id).text('red_css');

//$(".docstx_"+id).html("<div style='width: 70px;font-size:12px;color:white;background:red;padding:6px;border:none;border-radius:15%;text-align:center;'>Sent</div>");

//$("#docstatushide_"+id).hide();
//$("#docstatushide2_"+id).hide();

$(".docloader-updates_"+id).hide();

}




	if(msg.trim() == 'completed'){

alert('Docusign Documents Status: (Completed)');
$("#docstatus_"+id).text(status);
$("#docstatus1_"+id).text('Completed');
$(".docstatuscolor_"+id).text('green_css');

$(".docstx_"+id).html("<div style='width: 70px;font-size:12px;color:white;background:green;padding:6px;border:none;border-radius:15%;text-align:center;'>Completed</div>");

$("#docstatushide_"+id).hide();
$("#docstatushide2_"+id).hide();

$(".docloader-updates_"+id).hide();

}









}
			
});
}

// confirm ends

                });


            });





</script>




<style>
.full-screen-modal {
    width: 80%;
    height: 80%;
    margin: 0;
    top: 0;
    left: 0;
}



.red_css {
    background:red;
    color: white;
    padding: 6px;
border:none;
border-radius:15%;
text-align:center;
font-size:12px;
}

.green_css {
    background:green;
    color: white;
    padding: 6px;
border:none;
border-radius:15%;
text-align:center;
font-size:12px;
width: 90px;
}

.email_css{
background: navy;
color:white;
padding:6px;
cursor:pointer;
border:none;
font-size:12px;
//border-radius:25%;
//font-size:16px;
}

.email_css:hover{
background: black;
color:white;

}



.email_users_css{
background: fuchsia;
color:white;
padding:6px;
cursor:pointer;
border:none;
font-size:12px;

}

.email_users_css:hover{
background: black;
color:white;

}





.report_css{
//background: purple;
color:purple;
padding:4px;
cursor:pointer;
border:none;
font-size:12px;
//border-radius:25%;
//font-size:16px;
}

.report_css:hover{
background: black;
color:white;

}

</style>








 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog full-screen-modal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Refugees Docusign Details</h4>
        </div>
        <div class="modal-body">
<div class='row'>
<p><b>Photo: </b><span class='p_photo'></span></p>
<p><b>Dcusign Document Name: </b><span class='p_document_name'></span></p>
<p><b>Docusign Document Status: </b><span class='p_document_status'></span></p>
<p><b>Docusign Envelope Id: </b><span class='p_docusign_envelope_id'></span></p>
<p><b>Docusign Account Id: </b><span class='p_docusign_account_id'></span></p>
<p><b>Docusign Account BaseUrl: </b><span class='p_docusign_base_url'></span></p>



<div class='well col-sm-4'>
<h3>Refugee Personal Information</h3>
          
<p><b>Refugee Registration Number:</b> <span class='p_reg_no'></span></p>
<p><b>Resettlement Support Center(RSC) Case No: </b><span class='p_case_no'></span></p>
<p><b>Lastname: </b><span class='p_lastname'></span></p>
<p><b>Firstname: </b><span class='p_firstname'></span></p>
<p><b>Middlename: </b><span class='p_middlename'></span></p>
<p><b>Email: </b><span class='p_email'></span></p>
<p><b>Phone No: </b><span class='p_phone_no'></span></p>
<p><b>Gender: </b><span class='p_gender'></span></p>

</div>




<div class='alerts alert-info  col-sm-4'>
<h3>Refugees Places Information</h3><br>
          <p><b>Date Of Birth:</b> <span class='p_dob'></span></p>
<p><b>Place/Country of Birth:</b> <span class='p_pob'></span></p>
<p><b>Full Home Address:</b> <span class='p_address'></span></p>
<p><b>Latitude:</b> <span class='p_lat'></span></p>
<p><b>Longitude: </b><span class='p_lng'></span></p>
<p><b>citizenship Or Nationality:</b> <span class='p_citizenship'></span></p>
<p><b>Ethinicity: </b><span class='p_ethinicity'></span></p>
<p><b>Religion: </b><span class='p_religion'></span></p>
<p><b>Language(Native):</b> <span class='p_language'></span></p>
<p><b>Other languages Spoken:</b> <span class='p_other_language'></span></p>


</div>



 


<div class='alerts alert-warning  col-sm-4'>
<h3>Refugees Identification Details</h3><br>
<p><b>Document Type: </b><span class='p_doc_type'></span></p>
<p><b>Document Identity Number: </b><span class='p_doc_no'></span></p>
<p><b>Name on the Documents: </b><span class='p_name_doc'></span></p>
<p><b>Documents Place Of Issuance: </b><span class='p_place_issuance'></span></p>
<p><b>Issuing Authority: </b><span class='p_issuing_authority'></span></p>
</div>

</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  







<script>
$(document).ready(function(){

var get_content = 'get_data';
var backup_type = 'googledrive';
if(get_content=="" && backup_type==""){
alert('There is an Issue with Cotent Database Retrieval');
}
else{
$('.loader_x').fadeIn(400).html('<br><div style="background:#eee; width:100%;height:30%;text-align:center"><img src="ajax-loader.gif">&nbsp;Please Wait, Your Data is being Loaded</div>');
		
 var backupLord144 = $('#backup_content').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"dashboard_action.php",
   type:"POST",
   data:{get_content:get_content, backup_type:backup_type}
  },
  "columnDefs":[
   {
    "orderable":false,
   },
  ],
  "pageLength": 10
 });

if(backupLord144 !=''){
$('.loader_x').hide();
}

}

 





// Delete content
$(document).on('click', '.delete', function(){
var id = $(this).attr("id");
var get_content = "Delete";

var datasend = "id="+ id + "&get_content=" + get_content;
if(confirm("Are you sure you want to delete this Content?")){

$('.loader_x').fadeIn(400).html('<br><div style="background:#eee; width:100%;height:30%;text-align:center"><img src="ajax-loader.gif">&nbsp;Please Wait, Your Data is being Deleted...</div>');

$.ajax({
url:"dashboard_action.php",
method:"POST",
data:datasend,
dataType:"json",
success:function(msg){
$('.loader_x').hide();

if(msg.message == 'Deleted'){
alert('Message Deleted Successfully');
$('.alert_server_response').html('<div class= "alert alert-success" style="background:#4CAF50;color:white;padding:14px 18px;border: none;width:100%;height:30px;text-align:center">Message Deleted Successfully</div>');
}

//check if Database is not Deleted
if(msg.error == 'deleted-error'){
alert('Error: Database Could not be Deleted');
$('.alert_server_response').html('<div class= "alert alert-danger" style="background:#f44336;color:white;padding:14px 18px;border: none;width:100%;height:30px;text-align:center">Error: Database Could not be Deleted</div>');
}

$('#contentModal').modal('hide');
backupLord144.ajax.reload();
    }
   });
  }
  else
  {
   return false;
  }
 });
 
});
</script>














 <!-- email Modal -->
  <div class="modal fade" id="myModal_email" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Contact Refugee Via Email</h4>
        </div>
        <div class="modal-body">



<script>



$(document).ready(function(){
$('#email_users_btn').click(function(){

var email_title = $('#email_title').val();		
var email_message = $('#email_message').val();
var email = $('.p_email_valuex').val();
var fullname = $('.p_fullname_valuex').val();
var userid = $('.p_identity_value').val();

//alert(userid);
/*
if(isNaN(discount)){
return false;
}
*/
if(email_message==""){
alert('Email Message cannot be Empty.');
$('.email_message_alert').html("<div class='alert alert-warning' style='color:red;'>Email Message Cannot be Empty.</div>");


}


else{


$('#loader_recxx').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif" style="font-size:20px"> &nbsp;Please Wait, Email is being sent in Progress.</div>');
var datasend = {email_title:email_title, email_message:email_message,email:email,fullname:fullname,userid:userid};


$.ajax({
			
			type:'POST',
			url:'email_users.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_recxx').hide();
				//$('#result_recxx').fadeIn('slow').prepend(msg);
$('#result_recxx').html(msg);
$('#alertdata_recxx').delay(7000).fadeOut('slow');
$('#alertdata_recxx').delay(7000).fadeOut('slow');

email_function();

$('#email_title').val('');
$('#email_message').val('');
			
			}
			
		});
		
		}
		
	})
					
});




</script>






<input type="hidden" class="p_email_value p_email_valuex"  value="">
<input type="hidden" class="p_fullname_value p_fullname_valuex"  value="">


<div class='row'>
<div class='col-sm-12' style='background:#ddd;'>

<h4>Users Info</h4>


<b>Name: </b><span class='p_fullname'></span><br>
<b>Email: </b><span class='p_email'></span><br>


               </div>


</div>


<br>

<h5> Send Email to User</h5><br>



 <div class="form-group">
           <b>Email Title</b>
              <input type='text' class="col-sm-12 form-control email_title" id="email_title" name="email_title" value="">

            </div>



 <div class="form-group">
           <b>Message</b>
              <textarea class="col-sm-12 form-control" id="email_message" name="email_message" ></textarea>

            </div>

<div class='email_message_alert mydata_empty'></div>





<div class="form-group">
<div id="loader_recxx" ></div>

<div id="result_recxx" class='mydata_empty'></div>
<br />

<button type="button" id="email_users_btn" class="btn btn-primary" title='Email User'>Email User</button>
</div>







<script>




$(document).ready(function(){
//$('.btn_call').click(function(){
$(document).on( 'click', '.btn_call', function(){ 
var id = $(this).data('id');


if(id==""){
alert('There is an Issue with User Id.');
}
else{
$('#loader_msg').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif" style="font-size:20px"> &nbsp;Please Wait,Loading Message.</div>');
var datasend = {userid:id};


$.ajax({
			
			type:'POST',
			url:'msg_email.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_msg').hide();
				//$('#result_msg').fadeIn('slow').prepend(msg);
$('#result_msg').html(msg);
$('#alertdata_msg').delay(7000).fadeOut('slow');
$('#alertdata_msg').delay(7000).fadeOut('slow');


			
			}
			
		});
		
		}
		
	});
					
});






</script>


<div id="loader_msg"></div>
<div id="result_msg"></div>




     </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<!-- The Modal contact/email users Ends -->







<script>



//$(document).ready(function(){
function sms_function(){
//$(document).on( 'click', '.btx_action', function(){ 
var id =  $('.pidx').val();

//alert(id);
if(id==""){
alert('There is an Issue with User Id.');
}
else{
$('#loader_msgs').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif" style="font-size:20px"> &nbsp;Please Wait,Loading Message.</div>');
var datasend = {userid:id};


$.ajax({
			
			type:'POST',
			url:'msg_sms.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_msgs').hide();
				//$('#result_msg').fadeIn('slow').prepend(msg);
$('#result_msgs').html(msg);
$('#alertdata_msgs').delay(7000).fadeOut('slow');
$('#alertdata_msgs').delay(7000).fadeOut('slow');


			
			}
			
		});
		
		}
		
	}
					
//});






//$(document).ready(function(){
//$('.btn_action').click(function(){
//$(document).on( 'click', '.btx_action', function(){ 

function email_function(){
var id = $('.pidx').val();


if(id==""){
alert('There is an Issue with User Id.');
}
else{
$('#loader_msg').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif" style="font-size:20px"> &nbsp;Please Wait,Loading Message.</div>');
var datasend = {userid:id};


$.ajax({
			
			type:'POST',
			url:'msg_email.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_msg').hide();
				//$('#result_msg').fadeIn('slow').prepend(msg);
$('#result_msg').html(msg);
$('#alertdata_msg').delay(7000).fadeOut('slow');
$('#alertdata_msg').delay(7000).fadeOut('slow');


			
			}
			
		});
		
		}
		
}




</script>




<input type="hidden" class="p_identity_value pidx"  value="">









<!-- The Modal sms users start -->
<div class="modal fade" id="myModal_sms" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Contact Refugees Via SMS</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body starts-->
      <div class="modal-body">



<script>



$(document).ready(function(){
$('#sms_users_btn').click(function(){

	
var sms_message = $('#sms_message').val();
var email = $('.p_email_valuex').val();
var fullname = $('.p_fullname_valuex').val();
var userid = $('.p_identity_value').val();
var phone_no = $('.p_phone_no_value').val();

//alert(phone_no);
/*
if(isNaN(discount)){
return false;
}
*/
if(sms_message==""){
alert('SMS Message cannot be Empty.');
$('.sms_message_alert').html("<div class='alert alert-warning' style='color:red;'>SMS Message Cannot be Empty.</div>");


}


else{


$('#loader_s').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif" style="font-size:20px"> &nbsp;Please Wait, SMS is being sent in Progress.</div>');
var datasend = {sms_message:sms_message,email:email,fullname:fullname,userid:userid,phone_no:phone_no};


$.ajax({
			
			type:'POST',
			url:'sms_users.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_s').hide();
				//$('#result_s').fadeIn('slow').prepend(msg);
$('#result_s').html(msg);
$('#alertdata_s').delay(7000).fadeOut('slow');
$('#alertdata_s').delay(7000).fadeOut('slow');


sms_function();
$('#sms_message').val('');			
			}
			
		});
		
		}
		
	})
					
});




</script>






<input type="hidden" class="p_email_value p_email_valuex"  value="">
<input type="hidden" class="p_fullname_value p_fullname_valuex"  value="">


<div class='row'>
<div class='col-sm-12' style='background:#ddd;'>

<h4>Users Info</h4>


<b>Name: </b><span class='p_fullname'></span><br>
<b>Email: </b><span class='p_email'></span><br>
<b>Phone No: </b><span class='p_phone_no'></span><br>

               </div>


</div>


<br>

<h5> Send SMS to User</h5><br>
 <div class="form-group">
           <b>Recipient Phone No.</b>
<input disabled type="" class="p_phone_no_value p_phone_no_valuex col-sm-12 form-control"  value="">
</div>

 <div class="form-group">
           <b>Message</b>
              <textarea class="col-sm-12 form-control" id="sms_message" name="sms_message" ></textarea>

            </div>

<div class='sms_message_alert mydata_empty'></div>





<div class="form-group">
<div id="loader_s" ></div>

<div id="result_s" class='mydata_empty'></div>
<br />

<button type="button" id="sms_users_btn" class="btn btn-primary" title='SMS User'>Send SMS Now</button>
</div>







<script>




$(document).ready(function(){
//$('.btn_action').click(function(){
$(document).on( 'click', '.btn_call', function(){ 
var id = $(this).data('id');


if(id==""){
alert('There is an Issue with User Id.');
}
else{
$('#loader_msgs').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="loader.gif" style="font-size:20px"> &nbsp;Please Wait,Loading Message.</div>');
var datasend = {userid:id};


$.ajax({
			
			type:'POST',
			url:'msg_sms.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_msgs').hide();
				//$('#result_msg').fadeIn('slow').prepend(msg);
$('#result_msgs').html(msg);
$('#alertdata_msgs').delay(7000).fadeOut('slow');
$('#alertdata_msgs').delay(7000).fadeOut('slow');


			
			}
			
		});
		
		}
		
	});
					
});






</script>


<div id="loader_msgs"></div>
<div id="result_msgs"></div>




      </div>

      <!-- Modal body ends-->


      <!-- Modal footer -->
      <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Modal sms users Ends -->




<!-- map  modal starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_map" role="dialog">
    <div class="modal-dialog modal-lg modal-appear-center pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Refugee/Users Map Locations</h4>
        </div>
        <div class="modal-body">



      <h3>Refugee/Users Maps Locations</h3>

<!-- start map loading-->
<style>
#map {
        height: 80%;
      }
    
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
.res_center_css{
position:absolute;top:50%;left:50%;margin-top: -50px;margin-left -50px;width:100px;height:100px;
}

</style>

<div id="loader" class='res_center_css'></div>

    <div style='width:600px; height:600px;' id="map"></div>

    <script>
      var customLabel = {
        Vaccine: {
          label: 'P'
        }
      };
//center: new google.maps.LatLng(-33.863276, 151.207977),
//zoom: 12
 
/*
 var url_content1 = window.location.href;
var url_p1 = new URL(url_content1);
var identity = url_p1.searchParams.get("identity");
*/



        function initMap() {
//function {
//$('.btn_action_map').click(function(){
$(document).on( 'click', '.btn_call', function(){ 


var postid = $(this).data('id');
var identity = $(this).data('id');
var lngx = $(this).data('lng');
var latx = $(this).data('lat');

//alert(postid);

//center: new google.maps.LatLng(32.944012, -85.953850),

        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latx, lngx),
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow;

$('#loader').fadeIn(400).html('<br><div style="color:black;background:#c1c1c1;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i>  &nbsp;Please Wait, Google Map is being Loaded...</div>');

          //downloadUrl('map1_backend.php', function(data) {
			  downloadUrl('map.php?identity='+identity, function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
var timing = markerElem.getAttribute('timing');
var data_type = markerElem.getAttribute('data_type');
var fullname = markerElem.getAttribute('fullname');	
              var type = markerElem.getAttribute('type');
var country = markerElem.getAttribute('country');

var reg_no = markerElem.getAttribute('reg_no');
var case_no = markerElem.getAttribute('case_no');
var dob = markerElem.getAttribute('dob');
var pob = markerElem.getAttribute('pob');
var address = markerElem.getAttribute('address');
var photo =markerElem.getAttribute('photo');
var gender =markerElem.getAttribute('gender');
var citizenship =markerElem.getAttribute('citizenship');
var ethinicity =markerElem.getAttribute('ethinicity');
var religion =markerElem.getAttribute('religion');
var country =markerElem.getAttribute('country');
var timing =markerElem.getAttribute('timing');
var language =markerElem.getAttribute('language');
var other_language =markerElem.getAttribute('other_language');
var name_doc =markerElem.getAttribute('name_doc');
var doc_no =markerElem.getAttribute('doc_no');
var doc_type =markerElem.getAttribute('doc_type');
var place_issuance =markerElem.getAttribute('place_issuance');
var issuing_authority =markerElem.getAttribute('issuing_authority');



              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

$('#loader').hide();

              var infowincontent = document.createElement('div');
             var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};

                var map_data = "<div style='background:#c1c1c1; border-bottom: 2px dashed purple;'>" +
"<div style='background:#800000;color:white;padding:10px;'>Refugee/Users Map Location Center</div><br />" +

"<img src='uploads/" + photo +"' style='width:150px;max-width:150px;max-height:150px;height:150px;border-radius:50%'><br>" +
"<span><b> Name:</b> " + fullname + "</span><br />" +
"<span><b>Refugee Reg No:</b> " + reg_no + "</span><br />" +

"<span><b>Date of Birth:</b> " + dob + "</span><br />" +
"<span><b>Place of Birth:</b> " + pob + "</span><br />" +
"<span><b>Gender:</b> " + gender + "</span><br />" +
"<span><b>Latitude:</b> " + latx + "</span><br />" +
"<span><b>Longitude:</b> " + lngx + "</span><br />" +
"<span><b>Home Location Address: </b>" + address + "</span><br />" +
"<span><b>Country:</b> " + country + "</span><br />" +
"<span><b>Citizenship/Nationality:</b> " + citizenship + "</span><br />" +

"<span><b>Ethinicity:</b> " + ethinicity + "</span><br />" +
"<span><b>Religion:</b> " + religion + "</span><br />" +
"<span><b>Language: </b>" + language + "</span><br />" +
"<span><b>Other Languages Spoken:</b> " + other_language + "</span><br />" +


"<span><b>Documents Type:</b> " + doc_type + "</span><br />" +
"<span><b>Document No:</b> " + doc_no + "</span><br />" +
"<span><b>Your Name on Document: </b>" + name_doc + "</span><br />" +
"<span><b>Place of Issuance:</b> " + place_issuance + "</span><br />" +
"<span><b>Issuing Authority:</b> " + issuing_authority + "</span><br />" +


  "<span><b> <span class='fa fa-calendar'></span>Time:</b></span>" +
"<span data-livestamp='" + timing + "'></span></span><br /><br />"+
                    "</div>";



              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
 title : 'welcome'
              });
              marker.addListener('click', function() {
                //infoWindow.setContent(infowincontent);

//infoWindow.setContent('<b>'+name + "</b><br>" + address);

infoWindow.setContent(map_data);
                infoWindow.open(map, marker);
              });
            });
          });
		  
		   });  // close jquery clickbutton
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}

 $('#myModal_map').on('shown.bs.modal', function(){
    //init();
initMap();

    });


    </script>

  


<!-- end map loading-->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- map modal ends here -->


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_keys; ?>&callback=initMap">
    </script>














<script>


// clear Modal div content on modal closef closed
$(document).ready(function(){

$("#myModal_download").on("hidden.bs.modal", function(){
    //$(".modal-body").html("");
 $('.mydata_emptyx_download').empty(); 
});



});



$(document).ready(function(){

$('.download_btn').click(function(){
//$(document).on( 'click', '.download_btn', function(){ 


var envelope_id = $('.p_docusign_envelope_id_value').val();
var lastnamex = $('.p_lname_value').val();
var file_namex = $('.p_file_namex_value').val();
var id = $('.p_idx_value').val();

//alert(id);

$(".loader_download").fadeIn(400).html('<br><div style="color:black;background:#ccc;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait, Signed Documents is being Downloaded...</div>');
var datasend = {'envelope_id': envelope_id, lastnamex:lastnamex, file_namex:file_namex};
		$.ajax({
			
			type:'POST',
			url:'docusign_download.php',
			data:datasend,
                         dataType: 'html',
                        crossDomain: true,
			cache:false,
			success:function(msg){

$(".loader_download").hide();
$(".result_download").html(msg);
//alert(msg);


}
			
});


                });


            });


</script>



 <!-- Modal -->
  <div class="modal fade" id="myModal_download" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Download Signed Documents</h4>
        </div>
        <div class="modal-body">
<div class='row'>
<p><b>Photo: </b><span class='p_photo'></span></p>
<p><b>Docusign Document Name: </b><span class='p_document_name'></span></p>
<p><b>Docusign Document Status: </b><span class='p_document_status'></span></p>
<p><b>Docusign Envelope Id: </b><span class='p_docusign_envelope_id'></span></p>
<p><b>Docusign Account Id: </b><span class='p_docusign_account_id'></span></p>
<p><b>Docusign Account BaseUrl: </b><span class='p_docusign_base_url'></span></p>




<input type="hidden" class="p_file_namex_value"  value="">

<input type="hidden" class="p_docusign_envelope_id_value"  value="">

<input type="hidden" class="p_lname_value"  value="">


<input type="hidden" class="p_idx_value"  value="">

<div class='loader_download'></div>
<div class='result_download  mydata_emptyx_download'></div>

<br>

<button type="button" id="download_btn" class="download_btn btn btn-primary" title='Download Documents Now'>Download Documents Now Now!</button>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>













</body>
</html>

