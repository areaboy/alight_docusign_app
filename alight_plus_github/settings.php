<?php
error_reporting(0); 



//Docusign Settings
//docusign_client_id is your integration key

$integratorKey = '';  // Docusign Integration Key from your Dev app account
$secret_key='';   // Docusign Secret Key
$docusign_redirect_url_token_generate ='http://localhost/alight_plus/docusign_token_generate.php';  // make sure you configure this Redirect URL at your docusign developers account.

// PDF Document name to be used for signing
$docusign_document_name_pdf = 'documents.pdf';





//Google javascript Map sdk API key
$google_map_keys ='AIxxxxxxxxxxxxx goes here';



// Twilio SMS Settings

$twilio_account_sid='';
$twilio_auth_token='';
$twilio_phoneno='';
 

//Please do not add  http or https to the site url below otherwise Email messages will not work.
$site_url=  "fredjarsoft.com/alight_plus";
//$site_url=  "localhost/alight_plus";



// Admin Email address, Phone no for sending and Recieving Email and SMS Messages respectively
$admin_name ='Alight-NGO..';
$admin_email ='alight@gmail.com';
$admin_phone_no ='';


// Email Server Setup
$smtp_email_host = 'mail.fredjarsoft.com';
$smtp_email_username = 'support@alight.com';
$smtp_email_password = '';
$smtp_email_port = '587';


?>