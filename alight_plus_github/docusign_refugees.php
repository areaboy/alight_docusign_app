<?php
error_reporting(0);
// <span data-livestamp="{{comment_new.timing}}" ==> data-livestamp="{{comment_new.timing}}" ></span>
// this if line statement below is important otherwise the progressbar will not work perfectly
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$file_content = strip_tags($_POST['file_fname']);
//$username1 = strip_tags($_POST['username']);
//$username = str_replace(' ', '', $username1);



include('data6rst.php');
$resulta = $db->prepare('SELECT * FROM users');
$resulta->execute(array());
$nosofrowsa = $resulta->rowCount();

$rowa = $resulta->fetch();
$access_tokena = $rowa['access_token'];
if($access_tokena ==''){
echo "<div style='color:white;background:red;padding:8px;' id='alerts_reg'>Docusign Token is Empty. Please Tell Admin to Login and Generate Docusign Token First..</div>";
exit();

}



$reg_no = strip_tags($_POST['reg_no']);
$case_no = strip_tags($_POST['case_no']);
$email = strip_tags($_POST['email']);
$lastname = strip_tags($_POST['lastname']);
$firstname = strip_tags($_POST['firstname']);
$middlename = strip_tags($_POST['middlename']);
$gender = strip_tags($_POST['gender']);
$dob = strip_tags($_POST['dob']);
$pob = strip_tags($_POST['pob']);
$address = strip_tags($_POST['address']);
$citizenship = strip_tags($_POST['citizenship']);
$ethinicity = strip_tags($_POST['ethinicity']);
$status = 'Open';
$religion = strip_tags($_POST['religion']);
$country = strip_tags($_POST['country']);
$timing = time();
$language = strip_tags($_POST['language']);
$other_language = strip_tags($_POST['other_language']);
$name_doc = strip_tags($_POST['name_doc']);
$doc_no = strip_tags($_POST['doc_no']);
$doc_type = strip_tags($_POST['doc_type']);
$place_issuance = strip_tags($_POST['place_issuance']);
$issuing_authority = strip_tags($_POST['issuing_authority']);


$fullname ="$lastname $firstname $middlename"; 


$phoneno = trim(strip_tags($_POST['phoneno']));
$comments = strip_tags($_POST['comments']);

//$pet = strip_tags($_POST['pet']);
//$smokers = strip_tags($_POST['smokers']);





$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);



// honey pot spambots
$emailaddress_pot =$_POST['emailaddress_pot'];
if($emailaddress_pot !=''){
//spamboot detected.
//Redirect the user to google site

echo "<script>
window.setTimeout(function() {
    window.location.href = 'https://google.com';
}, 1000);
</script><br><br>";

exit();
}


if ($file_content == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Files Upload is empty</font></div>";
exit();
}


if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Email Address is empty</font></div>";
exit();
}

$em= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$em){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Email Address is Invalid</font></div>";
exit();
}

$ip= filter_var($ipaddress, FILTER_VALIDATE_IP);
if (!$ip){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>IP Address is Invalid</font></div>";
exit();
}




include('settings.php');

if($integratorKey ==''){
echo "<div style='color:white;background:red;padding:6px;'>Docusign Integration Key is Empty</div>";
exit();
}
if($secret_key ==''){
echo "<div style='color:white;background:red;padding:6px;'>Docusign Secret Key is Empty</div>";
exit();
}
if($docusign_redirect_url_token_generate ==''){
echo "<div style='color:white;background:red;padding:6px;'>Docusign Redirect Url is Empty</div>";
exit();
}

if($docusign_document_name_pdf ==''){
echo "<div style='color:white;background:red;padding:6px;'>PDF Document name to be used for signing is Empty</div>";
exit();
}

$recipient_email = $email;
$recipientName = $fullname;
//$documentName = $docusign_document_name_pdf;
$documentId=time();


// Copy the file  on the fly
$source = $docusign_document_name_pdf; 
$new_document_name = $firstname.$reg_no;
$new_document_name1 = "$new_document_name.pdf";
 $destination = $new_document_name1; 
$documentName = $destination;
  
if( !copy($source, $destination) ) { 
    echo "<div style='color:white;background:red;padding:6px;'>Documents Files Copying Failed. Try Again</div>"; 
exit();
} 
else { 
    //echo "<div style='color:white;background:green;padding:6px;'>Documents Files Copying Successful</div><br>"; 
} 



include('data6rst.php');
$result = $db->prepare('SELECT * FROM users');
$result->execute(array());
$nosofrows = $result->rowCount();

$row = $result->fetch();

 $access_token = $row['access_token'];
$accountId = $row['account_id'];
$baseUrl = $row['base_uri'];
$refresh_token = $row['refresh_token'];

// Create and send envelope
    $data = array (
            "emailSubject" => "Alight Refugees DocuSign - Please Sign Refugees Documents",
            "documents" => array( array( "documentId" => $documentId, "name" => $documentName)), 
            "recipients" => array( "signers" => array(
                array(  "email" => $recipient_email,
                        "name" => $recipientName,
                        "recipientId" => $reg_no,
                        "tabs" => array(
                            "signHereTabs" => array(
                                array( "xPosition" => "300",
                                       "yPosition" => "490",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" )
                            ),







"textTabs" => array(array(           "xPosition" => "100",
                                       "yPosition" => "150",
                                       "tabLabel" => "Refugee Personal Information",
                                       "name" => "Refugee_Personal_Information",
                                       "value" => " Refugee Personal Information",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size18",
                                  "fontColor" => "Green"
                            ),


                              array( "xPosition" => "50",
                                       "yPosition" => "175",
                                       "tabLabel" => "Fullname",
                                       "name" => "Fullname",
                                       "value" => "Fullname:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


array( "xPosition" => "150",
                                       "yPosition" => "175",
                                       "tabLabel" => $fullname,
                                       "name" => $fullname,
                                       "value" => $fullname,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),



           array( "xPosition" => "50",
                                       "yPosition" => "190",
                                       "tabLabel" => "Refugee Registration Number",
                                       "name" => "Refugee Registration Number",
                                       "value" => "Refugee Registration Number:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "300",
                                       "yPosition" => "190",
                                       "tabLabel" => $reg_no,
                                       "name" => $reg_no,
                                       "value" => $reg_no,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




 array( "xPosition" => "50",
                                       "yPosition" => "205",
                                       "tabLabel" => "Resettlement Support Center",
                                       "name" => "Resettlement Support Center",
                                       "value" => "Resettlement Support Center:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "300",
                                       "yPosition" => "205",
                                       "tabLabel" => $case_no,
                                       "name" => $case_no,
                                       "value" => $case_no,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),



 array( "xPosition" => "50",
                                       "yPosition" => "220",
                                       "tabLabel" => "Email",
                                       "name" => "Email",
                                       "value" => "Email:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "220",
                                       "tabLabel" => $email,
                                       "name" => $email,
                                       "value" => $email,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),



 array( "xPosition" => "50",
                                       "yPosition" => "235",
                                       "tabLabel" => "Phone No:",
                                       "name" => "Phone No",
                                       "value" => "Phone No:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "235",
                                       "tabLabel" => $phoneno,
                                       "name" => $phoneno,
                                       "value" => $phoneno,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),



 array( "xPosition" => "50",
                                       "yPosition" => "250",
                                       "tabLabel" => "Gender:",
                                       "name" => "Gender",
                                       "value" => "Gender:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "250",
                                       "tabLabel" => $gender,
                                       "name" => $gender,
                                       "value" => $gender,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),

array(           "xPosition" => "100",
                                       "yPosition" => "265",
                                       "tabLabel" => "Refugees Places Information",
                                       "name" => "Refugees Places Information",
                                       "value" => "Refugees Places Information",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size18",
                                  "fontColor" => "Green"
                            ),



 array( "xPosition" => "50",
                                       "yPosition" => "285",
                                       "tabLabel" => "Date Of Birth:",
                                       "name" => "Date Of Birth",
                                       "value" => "Date Of Birth:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "285",
                                       "tabLabel" => $dob,
                                       "name" => $dob,
                                       "value" => $dob,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),








 array( "xPosition" => "50",
                                       "yPosition" => "305",
                                       "tabLabel" => "Full Address:",
                                       "name" => "Full Address",
                                       "value" => "Full Address:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "305",
                                       "tabLabel" => $address,
                                       "name" => $address,
                                       "value" => $address,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




 array( "xPosition" => "50",
                                       "yPosition" => "320",
                                       "tabLabel" => "Citizenship/Nationality:",
                                       "name" => "Citizenship/Nationality",
                                       "value" => "Citizenship/Nationality:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "250",
                                       "yPosition" => "320",
                                       "tabLabel" => $citizenship,
                                       "name" => $citizenship,
                                       "value" => $citizenship,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),



 array( "xPosition" => "50",
                                       "yPosition" => "335",
                                       "tabLabel" => "Ethinicity:",
                                       "name" => "Ethinicity",
                                       "value" => "Ethinicity:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "335",
                                       "tabLabel" => $ethinicity,
                                       "name" => $ethinicity,
                                       "value" => $ethinicity,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




 array( "xPosition" => "50",
                                       "yPosition" => "350",
                                       "tabLabel" => "Religion:",
                                       "name" => "Religion",
                                       "value" => "Religion:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "350",
                                       "tabLabel" => $religion,
                                       "name" => $religion,
                                       "value" => $religion,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




 array( "xPosition" => "50",
                                       "yPosition" => "365",
                                       "tabLabel" => "Language:",
                                       "name" => "Language",
                                       "value" => "Language:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "150",
                                       "yPosition" => "365",
                                       "tabLabel" => $language,
                                       "name" => $language,
                                       "value" => $language,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




array(           "xPosition" => "100",
                                       "yPosition" => "380",
                                       "tabLabel" => "Refugees Identification Details",
                                       "name" => "Refugees Identification Details",
                                       "value" => "Refugees Identification Details",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size18",
                                  "fontColor" => "Green"
                            ),




 array( "xPosition" => "50",
                                       "yPosition" => "400",
                                       "tabLabel" => "Document Type:",
                                       "name" => "Document Type",
                                       "value" => "Document Type:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "250",
                                       "yPosition" => "400",
                                       "tabLabel" => $doc_type,
                                       "name" => $doc_type,
                                       "value" => $doc_type,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),



 array( "xPosition" => "50",
                                       "yPosition" => "415",
                                       "tabLabel" => "Document Number:",
                                       "name" => "Document Number",
                                       "value" => "Document Number:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "250",
                                       "yPosition" => "415",
                                       "tabLabel" => $doc_no,
                                       "name" => $doc_no,
                                       "value" => $doc_no,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),





 array( "xPosition" => "50",
                                       "yPosition" => "430",
                                       "tabLabel" => "Name on Document:",
                                       "name" => "Name on Document",
                                       "value" => "Name on Document:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "250",
                                       "yPosition" => "430",
                                       "tabLabel" => $name_doc,
                                       "name" => $name_doc,
                                       "value" => $name_doc,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),





 array( "xPosition" => "50",
                                       "yPosition" => "445",
                                       "tabLabel" => "Place of Issuance:",
                                       "name" => "Place of Issuance",
                                       "value" => "Place of Issuance:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "200",
                                       "yPosition" => "445",
                                       "tabLabel" => $place_issuance,
                                       "name" => $place_issuance,
                                       "value" => $place_issuance,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




 array( "xPosition" => "50",
                                       "yPosition" => "460",
                                       "tabLabel" => "Issuing Authority:",
                                       "name" => "Issuing Authority",
                                       "value" => "Issuing Authority:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontColor" => "BrightBlue",
                                       "fontSize" => "Size12",
                            ),


                                       array( "xPosition" => "200",
                                       "yPosition" => "460",
                                       "tabLabel" => $issuing_authority,
                                       "name" => $issuing_authority,
                                       "value" => $issuing_authority,
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size12"
                            ),




array( "xPosition" => "150",
                                       "yPosition" => "490",
                                       "tabLabel" => "Agree & Sign:",
                                       "name" => "Agree & Sign:",
                                       "value" => "Agree & Sign:",
                                       "show" => "true",
                                       "documentId" => $documentId,
                                       "pageNumber" => "1" ,
                                       "font" => "verdana",
                                       "fontSize" => "Size16",
                                       
                            )


),




)

                 ))
            ),
        "status" => "sent"
    );




    $data_string = json_encode($data);  

    $file_contents = file_get_contents($documentName);

    $requestBody = "\r\n"
    ."\r\n"
    ."--myboundary\r\n"
    ."Content-Type: application/json\r\n"
    ."Content-Disposition: form-data\r\n"
    ."\r\n"
    ."$data_string\r\n"
    ."--myboundary\r\n"
    ."Content-Type:application/pdf\r\n"
    ."Content-Disposition: file; filename=\"$documentName\"; documentid=$documentId \r\n"
    ."\r\n"
    ."$file_contents\r\n"
    ."--myboundary--\r\n"
    ."\r\n";


$baseUrl1="$baseUrl/restapi/v2.1/accounts/$accountId";

    $curl = curl_init($baseUrl1. "/envelopes" );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);                                                                  
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: multipart/form-data;boundary=myboundary',
        'Content-Length: ' . strlen($requestBody),
        "Authorization: Bearer $access_token")                                                                       
    );

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ( $status != 201 ) {
        echo "<div class='alertdata_r' style='color:white;background:red;padding:10px;'>Docusign Envelope sending Error, status is:$status. Please Try Again </div>";

       // print_r($json_response); echo "\n";

$responsex = json_decode($json_response, true);
$err = $responsex["errorCode"];
$msg = $responsex["message"];
/*
if($msg =='One or both of Username and Password are invalid. Invalid access token'){
echo "Access Token Has Expired. Please Wait.. Refreshing New Token in Progress";
}
*/
        //exit(-1);
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
    echo $envelopeId = $response["envelopeId"];

// start if for docusign envelope
if($envelopeId !=''){





$upload_path = "uploads/";

$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}




 //validate file names, ensures directory tranversal attack is not possible.
//thus replace and allowe filenames with alphanumeric dash and hy

//allow alphanumeric,underscore and dash

$fname_1= preg_replace("/[^\w-]/", "", $filename_string);

// add a new extension name to the uploaded files after stripping out its dots extension name
$new_extension = ".png";
$fname = $fname_1.$new_extension;





// for security reasons, you migh want to avoid files with more than one dot extension name
//file like fred.exe.png might contain virus. only ask the user to rename files to eg fred.png before uploads

echo $fname_dot_count = substr_count($fname,".");
if($fname_dot_count >1){
echo "<div id='alertdata_uploadfiles2' class='alerts alert-danger'>
Your files <b>$filename_string</b> has <b>($fname_dot_count dot extension names)</b>
File with more than one <b>dot(.) extension name are not allowed.
you can rename and ensure it has only one dot extension eg: <b>example.png</b>
</b></div>";
exit();

}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

//give file a random names
$filecontent_name = $username.time();
//$filecontent_name = 'fred1';


if ($fsize > 5 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div id='alertdata' class='alerts alert-danger'>File greater than 5mb not allowed<br></div>";
exit();
}

// Check if file already exists
if (file_exists($upload_path . $filecontent_name.'.'.$ext)) {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>This uploaded File <b>$filecontent_name.$ext</b> already exist<br></div>";
exit(); 
}



$allowed_types=array(

'application/json',
'application/octet-stream',
'text/plain',
'image/gif',

    'image/jpeg',

    'image/png',

'image/jpg',



'image/GIF',

    'image/JPEG',

    'image/PNG',

'image/JPG'

);






if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {

  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Images are allowed bro..<br><br></div>";

exit();

}




// Calling getimagesize() function 
//$image_info = getimagesize("team1.png"); 
//print_r($image_info); 

$image_info =getimagesize($_FILES['file_content']['tmp_name']);

    $width = $image_info[0];
    $height = $image_info[1];
    $mime_image = $image_info['mime'];
/*
//validate file dimension eg 400 by 250
if ($width > "400" || $height > "250") {
       echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>file upload dimension must not be more than 400(width) by 250(height)</div>";
exit();

}
*/


// check file validation using getimagesizes
 if ($image_info === FALSE) {
           echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>cannot determine the image type</div>";
exit();
        }




if ( ! ( in_array($mime_image, $allowed_types) ) ) {

  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Image types are allowed..<br><br></div>";

exit();

}



if (($image_info[2] !== IMAGETYPE_GIF) && ($image_info[2] !== IMAGETYPE_JPEG) && ($image_info[2] !== IMAGETYPE_PNG)) {
           echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>only image format gif,jpg, png are allowed..</div>";
exit();
        }





//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);


if ( ! ( in_array($mime, $allowed_types) ) ) {

  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Images are allowed...<br></div>";

exit();

}
finfo_close($finfo);


include('data6rst.php');





if (move_uploaded_file($ftmp, $upload_path . $filecontent_name.'.'.$ext)) {



//$final_address = "$city, $address, $country";

$address_g = urlencode($address);
// geocode geo location address to longitudes and latitudes

$call_url ="https://maps.googleapis.com/maps/api/geocode/json?key=$google_map_keys&address=$address_g&sensor=false";
 $res = file_get_contents($call_url);
 $json = json_decode($res, true);
//print_r($res);

        if($json['status']='OK'){

         $lat = $json['results'][0]['geometry']['location']['lat'];
         $lng = $json['results'][0]['geometry']['location']['lng'];
         $formatted_address = $json['results'][0]['formatted_address'];

}else{
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Address Could not be Formatted via Google Map Reverse Geo-Codings</font></div>";
//exit();
}

       echo $lat = $json['results'][0]['geometry']['location']['lat'];
      echo  $lng = $json['results'][0]['geometry']['location']['lng'];
		 






//insert into database
$final_filename =  $filecontent_name.'.'.$ext;
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");


$token1= md5(uniqid());
$token2 = time();
$token = $token1.$token2;



$timer1= time();


$statement = $db->prepare('INSERT INTO refugees
(reg_no,case_no,email,lastname,firstname,middlename,dob,pob,address,gender,citizenship,ethinicity,status,religion,country,timing,lat,lng,language,other_language,
name_doc,doc_no,doc_type,place_issuance,issuing_authority,sms_count,email_count,phone_no,needy,comments,pet,smokers,photo,docusign_envelope_id,
docusign_account_id,docusign_base_url,document_name,document_id,download_filename,download_filename_summary,document_status)
                          values
(:reg_no,:case_no,:email,:lastname,:firstname,:middlename,:dob,:pob,:address,:gender,:citizenship,:ethinicity,:status,:religion,:country,:timing,:lat,:lng,:language,:other_language,
:name_doc,:doc_no,:doc_type,:place_issuance,:issuing_authority,:sms_count,:email_count,:phone_no,:needy,:comments,:pet,:smokers,:photo,:docusign_envelope_id,
:docusign_account_id, :docusign_base_url,:document_name,:document_id,:download_filename,:download_filename_summary,:document_status)');

$statement->execute(array( 
':reg_no' => $reg_no,
':case_no' => $case_no,
':email' => $email,
':lastname' => $lastname,
':firstname' => $firstname,
':middlename' => $middlename,
':dob' => $dob,
':pob' => $pob,
':address' => $address,
':gender' => $gender,
':citizenship' => $citizenship,
':ethinicity' => $ethinicity,
':status' => 'Open',
':religion' => $religion,
':country' => $country,
':timing' => $timer1,
':lat' => $lat,
':lng' => $lng,
':language' => $language,
':other_language' => $other_language,
':name_doc' => $name_doc,
':doc_no' => $doc_no,
':doc_type' => $doc_type,
':place_issuance' => $place_issuance,
':issuing_authority' => $issuing_authority,
':sms_count' =>'0',
':email_count' =>'0',
':phone_no' =>$phoneno,
':needy' =>'1',
':comments' => $comments,
':pet'=> $pet,
':smokers'=> $smokers,
':photo'=> $final_filename,
':docusign_envelope_id' =>$envelopeId,
':docusign_account_id' =>$accountId,
':docusign_base_url' =>$baseUrl,
':document_name' =>$destination,
':document_id' =>$documentId,
':download_filename' =>'0',
':download_filename_summary' =>'0',
':document_status' => 'Sent'



));


$res = $db->query("SELECT LAST_INSERT_ID()");
$lastId_post = $res->fetchColumn();

// send Notification to Admin


// query users table to update notification_post table
//$result = $db->prepare('SELECT * FROM users where  status=:status');
//$result->execute(array(':status' => 'Home_Seeker'));

$result = $db->prepare('SELECT * FROM users where  id !=:id');
$result->execute(array(':id' => $id_sess));
$nosofrows = $result->rowCount();




if($nosofrows > 0){
//foreach($row['data'] as $v1){
while($row = $result->fetch()){

$reciever_userid = $row['id'];
$reciever_username = $row['id'];
		    
//insert into notification table

$statement1x = $db->prepare('INSERT INTO notification
(post_id,userid,fullname,photo,user_rank,reciever_id,status,type,timing,title,title_seo)
                        values
(:post_id,:userid,:fullname,:photo,:user_rank,:reciever_id,:status,:type,:timing,:title,:title_seo)');
$statement1x->execute(array( 

':post_id' => $lastId_post,
':userid' => $reg_no,
':fullname' => $fullname,
':photo' => $final_filename,
':user_rank' => 'Refugee',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'post',
':timing' => $timer1,
':title' => $lastId_post,
':title_seo' => $lastId_post
));

}
}



$res= $db->prepare("SELECT * from status");
$res->execute(array());
$counter = $row = $res->rowCount();
 $row = $res->fetch();


$id = $row['id'];
$total = $row['all_refugee'];
$ftotal  =$total + 1 ;

$total1 = $row['open_refugee'];
$ftotal1  =$total1 + 1 ;

if($counter == 0){

$statement1 = $db->prepare('INSERT INTO status (all_refugee,open_refugee,closed_refugee)
                          values
(:all_refugee,:open_refugee,:closed_refugee)');

$statement1->execute(array( 
':all_refugee' => '1',
':open_refugee' => '1',
':closed_refugee' => '0'
));


}else{



//if($counter > 0){
$upx = $db->prepare("UPDATE status SET all_refugee =:all_refugee, open_refugee =:open_refugee where id =:id");
$upx->execute(array( 
':all_refugee' => $ftotal,
':open_refugee' => $ftotal1,
':id' =>$id
));

}









if($statement){
echo "<script>alert('Submission Successful. Please Check Your Email for Document Signing');</script>";
echo "<div id='alertdata' style='background:green;color:white;padding:10px;border:none;'>Submission Successful.. Documents Sent to Your Email<b>($email)</b> for Signing</div>";

//echo "<script>window.location='dashboard.php';</script>";



echo "fred: $destination";
// unlink the file documents
unlink("$destination");




}

                else {
echo "<div id='alertdata' class='alerts alert-danger'>Submission Failed. Please Try Again...<br></div>";
                }









                } else {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Cannot be Uploaded.<br></div>";
     

           }




}// close if envelop docusing sending
else{
echo "<div id='alertdata_uploadfiles' style='background:red;color:white;padding:10px;border:none;'>Docusign Envelope failed to be created and Sent. Try Again.<br></div>";
}



}


?>



