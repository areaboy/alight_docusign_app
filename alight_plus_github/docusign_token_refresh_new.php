<?php 
 error_reporting(0);

//https://www.docusign.com/blog/developers/authorization-code-grant-refresh-tokens



include('data6rst.php');
$result = $db->prepare('SELECT * FROM users');
$result->execute(array());
$nosofrows = $result->rowCount();

$row = $result->fetch();

$access_tokenx = $row['access_token'];
$refresh_tokenx = $row['refresh_token'];
$accountId = $row['account_id'];
$baseUrl = $row['base_uri'];
$id = $row['id'];

if($access_tokenx ==''){
echo "<script>alert('Docusign Access Token is Empty. Please Generate Access Token as Admin when Login');</script>";
echo "<div style='background:red;color:white;padding:10px;border:none;'>Docusign Access Token is Empty. Please Generate Access Token as Admin when Login</div>";
}






//https://developers.docusign.com/platform/auth/authcode/authcode-get-token/


include('settings.php');

if($integratorKey ==''){
echo "<div style='color:white;background:red;padding:6px;'>Docusign Integration Key is Empty</div>";
}
if($secret_key ==''){
echo "<div style='color:white;background:red;padding:6px;'>Docusign Secret Key is Empty</div>";
//exit();
}
if($docusign_redirect_url_token_generate ==''){
echo "<div style='color:white;background:red;padding:6px;'>Docusign Redirect Url is Empty</div>";
//exit();
}


if($access_tokenx !=''){

$key_all = "$integratorKey:$secret_key";

$base64_key = base64_encode($key_all);

$curl = curl_init();
$auth_data = array(

'grant_type' 		=> 'refresh_token',
	'refresh_token' 	=> $refresh_tokenx
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

//echo "<br><br>";
$access_token_r = $json["access_token"];
$refresh_token_r = $json["refresh_token"];
$expires_in_r = $json["expires_in"];


if($access_token_r !=''){

$upx = $db->prepare("UPDATE users SET access_token =:access_token, refresh_token =:refresh_token, expires_in=:expires_in where id =:id");
$upx->execute(array( 
':access_token' => $access_token_r,
':refresh_token' => $refresh_token_r,
':expires_in' =>  $expires_in_r,
':id' =>$id
));

echo "<script>alert('Everything Ok.')</script>";
echo "<div id='' style='color:white;background:green;padding:6px;'>Everything Ok.</div>";


}else{
//echo "<div id='alertdata_recnv' style='color:white;background:red;padding:6px;'>Docusign Access Token Refreshing Failed. Try Again</div>";



}



}


?>