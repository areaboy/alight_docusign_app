
<?php
error_reporting(0);
include('data6rst.php');


$id = strip_tags($_POST['id']);
$docusign_envelope_id = strip_tags($_POST['envelope_id']);
$lastname= strip_tags($_POST['lastnamex']);
$file_name = strip_tags($_POST['file_namex']);


// first check if the file has been downloaded before

$resultb = $db->prepare('SELECT * FROM refugees where docusign_envelope_id =:docusign_envelope_id');
$resultb->execute(array(':docusign_envelope_id' =>$docusign_envelope_id));
$nosofrowsb = $resultb->rowCount();

$rowb = $resultb->fetch();

 $download_status= $rowb['download_status'];
 $main_filex = $rowb['download_filename'];
$summary_filex = $rowb['download_filename_summary'];



if($download_status == 'ok' ){

echo "<div style='color:white;background:green;padding:10px;'>Documents Successfully Downloaded Already... </div><br>";
echo "<p><a  target='_blank' href='download/$main_filex'><b>Download Documents Main File:</b> $main_filex</a></p>
<p><a target='_blank' href='download/$summary_filex'><b>Download Documents Summary File:</b> $summary_filex</a></p>";

//exit();
}else{


$result = $db->prepare('SELECT * FROM users');
$result->execute(array());
$nosofrows = $result->rowCount();

$row = $result->fetch();

 $access_token = $row['access_token'];
 $refresh_token = $row['refresh_token'];
$uid = $row['id'];
$accountId = $row['account_id'];
$baseUrl = $row['base_uri'];

$sp ='_';
$fx = $lastname.$sp.$file_name;

$up = $db->prepare("UPDATE refugees SET download_filename =:download_filename where docusign_envelope_id =:docusign_envelope_id");
$up->execute(array( 
':download_filename' => "$fx.pdf",
':docusign_envelope_id' =>$docusign_envelope_id
));


$envelopeId =$docusign_envelope_id;


// STEP 2 - Get document information
$baseUrl1="$baseUrl/restapi/v2.1/accounts/$accountId";
                                                                                
$curl = curl_init($baseUrl1 . "/envelopes/" . $envelopeId . "/documents" );
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    "Authorization: Bearer $access_token" )                                                                       
);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
  echo "<div class='alertdata_r' style='color:white;background:red;padding:10px;'>Docusign Document Information Error, status :$status </div>";
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
curl_close($curl);
//print envelope informations
//print_r($response); echo "\n";

// download documents
foreach( $response["envelopeDocuments"] as $document ) {
    $docUri = $document["uri"];

    $curl = curl_init($baseUrl1 . $docUri );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);  
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        "Authorization: Bearer $access_token")                                                                       
    );

   $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    




$lname = $lastname.$sp;

$dname= $document["name"];
$fname =time();
$final_filename=$lname.$dname;


//create a new file temp
if(file_exists("download/$final_filename")){
	//unlink("download/temp.pdf");
//unlink("download/$final_filename.pdf");
}
$filepath = "download/$final_filename.pdf";  
$fp = fopen($filepath, "w");  //creates a new file temp file on our web server
fwrite($fp, $result);  //write the data in our variable to our temp file
//Your archive is now ready for download on your web server

fclose($fp);

    curl_close($curl);


    
}



$summary = 'Summary';
$download_filename_summary = $lname.$summary;
$dfs = "$download_filename_summary.pdf";


$upx = $db->prepare("UPDATE refugees SET download_filename_summary =:download_filename_summary, download_status=:download_status where docusign_envelope_id =:docusign_envelope_id");
$upx->execute(array( 
':download_filename_summary' => $dfs,
':download_status' => 'ok',
':docusign_envelope_id' =>$docusign_envelope_id
));


echo "<div style='color:white;background:green;padding:10px;'>Documents Successfully Downloaded </div><br>";



$resultb = $db->prepare('SELECT * FROM refugees where docusign_envelope_id =:docusign_envelope_id');
$resultb->execute(array(':docusign_envelope_id' =>$docusign_envelope_id));
$nosofrowsb = $resultb->rowCount();

$rowb = $resultb->fetch();

 $main_file = $rowb['download_filename'];
 $summary_file = $rowb['download_filename_summary'];



echo "<p><a  target='_blank' href='download/$main_file'><b>Download Documents Main File:</b> $main_file</a></p>
<p><a target='_blank' href='download/$summary_file'><b>Download Documents Summary File:</b> $summary_file</a></p>";


}
?>


















