<?php
error_reporting(0);


session_start();

$fname_sess = $_SESSION['user_fullname_session'];
$id_sess =$_SESSION['user_id_session'];
$email_sess= $_SESSION['user_email_session'];



$id = strip_tags($_POST['id']);
$envelopeId = strip_tags($_POST['envelope_id']);


include('data6rst.php');


$result = $db->prepare('SELECT * FROM users');
$result->execute(array());
$nosofrows = $result->rowCount();

$row = $result->fetch();

$access_token = $row['access_token'];
$refresh_token = $row['refresh_token'];
$uid = $row['id'];
$accountId = $row['account_id'];
$baseUrl = $row['base_uri'];

 
$url = "$baseUrl/restapi/v2.1/accounts/$accountId/envelopes/$envelopeId";                                                                                
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    "Authorization: Bearer $access_token" )                                                                       
);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
  echo "<div class='alertdata_r' style='color:white;background:red;padding:10px;'>Docusign Envelope Information Error, status is:$status </div>";
   
}




if($status == 0){
 echo "<div class='alertdata_r' style='color:white;background:red;padding:10px;'>Ensure there is Internect Connection and Try Again...</div>";
}

// Trying to use expired docusign access token will result in error 401 unauthorized
if($status == 401){
 echo "<div class='alertdata_r' style='color:white;background:red;padding:10px;'>Docusign Access Token has Expired. Please Wait...</div>";



echo "<script>
$(document).ready(function(){

var refresh_token = '$refresh_token';
var uid = '$uid';

if(refresh_token==''){
alert('Refresh Token Cannot be Empty');

}

else{

$('#loader_recnv').fadeIn(400).html('<br><div style=color:black;background:#ddd;padding:10px;><img src=loader.gif style=font-size:20px> &nbsp;Please Wait, Docusign Access Token is being Refreshed.....</div>');
var datasend = {refresh_token:refresh_token, uid:uid};


$.ajax({
			
			type:'POST',
			url:'docusign_token_refresh.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

                        $('#loader_recnv').hide();
				//$('#result_recnv').fadeIn('slow').prepend(msg);
$('#result_recnv').html(msg);
$('#alertdata_recnv').delay(5000).fadeOut('slow');
$('.alertdata_r').delay(5000).fadeOut('slow');


			
			}
			
		});
		
		}
		
	});
					





</script>

<div id='loader_recnv'></div>
<div id='result_recnv'></div><br>
";



exit();
}





    $response = json_decode($json_response, true);
    $status = $response["status"];
    curl_close($curl);




if($status == 'sent'){
//$return_arr = array("status"=>'Sent',"message"=>'1');
//echo json_encode($return_arr);


$docst = "Sent";

$up = $db->prepare("UPDATE refugees SET document_status =:document_status where docusign_envelope_id =:docusign_envelope_id");
$up->execute(array( 
':document_status' => $docst,
':docusign_envelope_id' =>$envelopeId
));


echo "sent";
}

if($status == 'completed'){
//$return_arr = array("status"=>'Completed',"message"=>'2');
//echo json_encode($return_arr);


$docst = "Completed";

$up = $db->prepare("UPDATE refugees SET document_status =:document_status where docusign_envelope_id =:docusign_envelope_id");
$up->execute(array( 
':document_status' => $docst,
':docusign_envelope_id' =>$envelopeId
));


echo "completed";

}






?>

