
<?php

include ("data6rst.php");
      
$userid=strip_tags($_POST['userid']);
$res= $db->prepare("SELECT * from messages where status='email' and userid=:userid order by id desc");
$res->execute(array(':userid' =>$userid));

$counter = $row = $res->rowCount();

if($counter == 0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Email Message Sent Yet.<b></b></div>";
//exit();
}


while($row = $res->fetch()){
                $id= $row['id'];
                $msg = $row['msg'];
                $fullname = $row['fullname'];
$timing = $row['timing'];
$title = $row['title'];



?>

<div style='background:#ccc;'>
<b>Name:</b> <?php echo $fullname; ?><br>
<b>Title:</b> <?php echo $title; ?><br>
<b>Message:</b> <?php echo $msg; ?><br>
<b>Time:</b>  <span data-livestamp='<?php echo $timing; ?>'></span></span><br>


</div><p></p>


<?php
}

?>