<?php
error_reporting(0);




// start users registrations.


if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
$fullname = strip_tags($_POST['fullname']);
$phone_no = strip_tags($_POST['phone_no']);
$status = strip_tags($_POST['status']);


//hash password before sending it to database...
$options = array("cost"=>4);
$hashpass = password_hash($password,PASSWORD_BCRYPT,$options);


if ($username == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Username is empty</div>";
exit();
}



//insert into database

$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");


$token1= md5(uniqid());
$token2 = time();
$token = $token1.$token2;

include('data6rst.php');


// check if user with this username already exits
//$result_verified = $db->prepare('select * from users where username=:username');
//$result_verified->execute(array(':username' =>$username));

$result_verified = $db->prepare('select * from users');
$result_verified->execute(array());
 $rows= $result_verified->fetch();
$norows= $result_verified->rowCount();

//if($norows== 1){

if($norows ==1){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Only 1 Admin Account is Allowed to be Created. Please Login as Admin</div>";
exit();
}


$statement = $db->prepare('INSERT INTO users

(username,fullname,password,created_time,timing,phone_no,status)
 
                          values
(:username,:fullname,:password,:created_time,:timing,:phone_no,:status)');

$statement->execute(array( 

':username' => $username,
':fullname' => $fullname,
':password' => $hashpass,		
':created_time' => $created_time,
':timing' => $timer,
':phone_no' =>$phone_no,
':status' =>$status

));


if($statement){
echo  "<script>alert('Account Successfully Created. You can Login Now');</script>";
echo "<div style='background:green;padding:8px;color:white;border:none;'>Account Successfully Created. You can Login Now...</div>";
echo "<script>
$('#myModal_signup').modal('hide');
$('#myModal_login').modal('show');
</script>
";

}

              else {
echo "<div style='background:red;padding:8px;color:white;border:none;'>Account Creation Failed. Ensure there is internet connections...</div>";
                }

}


?>



