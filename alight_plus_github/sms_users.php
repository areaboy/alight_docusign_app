<?php
include('settings.php');
include('data6rst.php');


session_start();
$sender_name = $_SESSION['user_fullname_session'];
$sender_email = $_SESSION['user_email_session'];
//$sender_phoneno = $_SESSION['user_phoneno_session'];



$sms_message = strip_tags($_POST['sms_message']);
$email = strip_tags($_POST['email']);
$fullname = strip_tags($_POST['fullname']);

$userid = strip_tags($_POST['userid']);
$phone_no = strip_tags($_POST['phone_no']);
$timer1 = time();
$sms_title = "SMS from $sender_name";


$sms_sender_name=$sender_name;
$recipient_phoneno=$phone_no;
$sms_msg ="Message from $sms_sender_name, $sms_message. Sender: $sender_email";


//require_once('../vendor/autoload.php');

require_once 'twilio_sms/vendor/autoload.php';

use Twilio\Rest\Client;
$twilio = new Client($twilio_account_sid, $twilio_auth_token);

$message = $twilio->messages
                  ->create($recipient_phoneno, // recipient no
                           array(
                               "body" => $sms_msg,
                               "from" => $twilio_phoneno  // From a valid Twilio number
                           )
                  );


$ssid = $message->sid;
$status = $message->status;



if($ssid != ""){
 $ssid = $message->sid;
$status = $message->status;


$res= $db->prepare("SELECT * FROM refugees where id=:id");
$res->execute(array(':id' =>$userid));
$t_row = $res->fetch();
$fcount = $t_row['sms_count'];

$totalcount = $fcount + 1;


$up= $db->prepare("UPDATE refugees set sms_count=:sms_count where id=:id");
$up->execute(array(':sms_count' =>$totalcount, ':id' =>$userid));

//create table messages_homey(id int primary key auto_increment, fullname varchar(200), msg text, timing varchar(20), status varchar(20),userid varchar(100),title text);


$statement = $db->prepare('INSERT INTO messages
(fullname,msg,timing,status,userid,title)
                          values
(:fullname,:msg,:timing,:status,:userid,:title)');
$statement->execute(array( 
':fullname' => $admin_name,
':msg' => $sms_msg,
':timing' => $timer1,
':status' => 'sms',
':userid' => $userid,
':title' => $sms_title
));


echo "<div style='color:white;background:green;padding:10px;'>SMS Sent Successfully. SMS SID: $ssid, SMS status: $status</div>";
}else{
echo "<div style='color:white;background:red;padding:10px;'>SMS Sending Failed. Ensure there is Internet Connection</div>";

}




?>


