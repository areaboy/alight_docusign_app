<?php
//error_reporting(0);


session_start();

$fname_sess = $_SESSION['user_fullname_session'];
$id_sess =$_SESSION['user_id_session'];
$email_sess= $_SESSION['user_email_session'];




$id = strip_tags($_POST['id']);

/*

if($id_sess != $userid){
$return_arr = array("status"=>"$userid,$id_sess ","message"=>'2');
echo json_encode($return_arr);
exit();
}
*/

include('data6rst.php');
if($id != ''){
// query table posts to get data
$result = $db->prepare('UPDATE refugees set status =:status WHERE id =:id');
$result->execute(array(':status' => 'Closed', ':id' => $id));

$pst2 = $db->prepare('select * from status');
$pst2->execute(array());
$r2 = $pst2->fetch();
//$rc = $pst2->rowCount();
$rid=$r2['id'];
$open_refugee=$r2['open_refugee'];
$closed_refugee=$r2['closed_refugee'];

$open_r = $open_refugee - 1;
$closed_r = $closed_refugee + 1;

$update= $db->prepare('UPDATE status set closed_refugee =:closed_refugee, open_refugee=:open_refugee');
$update->execute(array(':closed_refugee' => $closed_r, ':open_refugee' => $open_r));
}
$return_arr = array("status"=>'Accepted',"message"=>'1');
echo json_encode($return_arr);