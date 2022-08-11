<?php
//error_reporting(0);







include('data6rst.php');


$data[] = array('Published Home', 'Total Homes', 'Available Home', 'Matched Home');

$result = $db->prepare('SELECT * FROM homey_status');
$result->execute(array());
$nosofrows = $result->rowCount();
while($row = $result->fetch()){
$id= $row['id'];


//foreach($json['data'] as $v1){
$all_home = $row['all_home'];
$open_home = $row['open_home'];
$closed_home = $row['closed_home']; 


$rp= 'Published Home';
$data[] = array($rp,(int)$all_home,(int)$open_home,(int)$closed_home);
}




echo json_encode($data);
