<?php 
 error_reporting(0);

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



//https://developers.docusign.com/platform/auth/authcode/authcode-get-token/

$code = $_GET['code'];

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



$key_all = "$integratorKey:$secret_key";

$base64_key = base64_encode($key_all);

$curl = curl_init();
$auth_data = array(

	'grant_type' 		=> 'authorization_code',
	'code' 	=> $code
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
curl_setopt($curl, CURLOPT_URL, 'https://account-d.docusign.com/oauth/token');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic $base64_key"));  

$result = curl_exec($curl);
if(!$result){die("Connection Failure");}
curl_close($curl);
//echo $result;

$json = json_decode($result, true);
$access_token = $json["access_token"];
$refresh_token = $json["refresh_token"];
$expires_in = $json["expires_in"];

//alter table users add column(access_token text, refresh_token text, expires_in varchar(100));



// user detail base url

$url ='https://account-d.docusign.com/oauth/userinfo';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $access_token"));  
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$outputx = curl_exec($ch); 

//echo $outputx;

//echo "<br><br>";

$jsonx = json_decode($outputx, true);
$account_id = $jsonx["accounts"][0]["account_id"];
$base_uri = $jsonx["accounts"][0]["base_uri"];


if($access_token !='' && $account_id !=''){
include('data6rst.php');
$upx = $db->prepare("UPDATE users SET access_token =:access_token, refresh_token =:refresh_token, expires_in=:expires_in, account_id =:account_id, base_uri =:base_uri where id =:id");
$upx->execute(array( 
':access_token' => $access_token,
':refresh_token' => $refresh_token,
':expires_in' =>  $expires_in,
':account_id' =>$account_id,
':base_uri' => $base_uri,
':id' =>$id_sess
));

echo "<div style='color:white;background:green;padding:6px;'>Docusign Access Token Successfully Generated</div>
.Redirecting in 5 Second to Dashboard.....<img src='loader.gif'><br></div>";


echo "<script>
window.setTimeout(function() {
    window.location.href = 'dashboard.php';
}, 5000);
</script><br><br>";


}else{
echo "<div style='color:white;background:red;padding:6px;'>Docusign Access Token Generation Failed. Try Again</div>";



}



?>