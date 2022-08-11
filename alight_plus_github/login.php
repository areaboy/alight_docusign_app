<?php
error_reporting(0);


$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);


if ($username == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Username/Email is Empty.</div>";
exit();
}


if ($password == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Password is Empty..</div>";
exit();
}





include('data6rst.php');
$result = $db->prepare('SELECT * FROM users where username = :username');

		$result->execute(array(
			':username' => $username

    ));

$count = $result->rowCount();

$row = $result->fetch();

if( $count == 1 ) {





//start hashed passwordless Security verify
if(password_verify($password,$row["password"])){
            //echo "Password verified and ok";



$userid = $row['id'];
$fullname = $row['fullname'];



// initialize session if things where ok

session_start();
session_regenerate_id();
$timer = time();

// initialize session if things where ok.
$_SESSION['user_session'] = $timer;
$_SESSION['user_fullname_session'] = $row['fullname'];
$_SESSION['user_id_session'] = $row['id'];
$_SESSION['user_email_session'] = $row['username'];

echo "<div style='background:green;padding:8px;color:white;border:none;'>Login sucessful <img src='ajax-loader.gif'></div>";
echo "<script>window.location='dashboard.php'</script>";




}
else{

echo "<div style='background:red;padding:8px;color:white;border:none;'>Password does not match..</div>";

}



}
else {

echo "<div style='background:red;padding:8px;color:white;border:none;'>User with this Email/Username does not Exist</div>";
}








?>

<?php ob_end_flush(); ?>
