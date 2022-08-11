<?php
//error_reporting(0);







include('data6rst.php');


$data[] = array('Registered Refugees', 'Total Refugees', 'Refugees Awaiting Acceptance', 'Refugees Accepted');

$result = $db->prepare('SELECT * FROM status');
$result->execute(array());
$nosofrows = $result->rowCount();
while($row = $result->fetch()){
$id= $row['id'];


//foreach($json['data'] as $v1){
$all_refugee = $row['all_refugee'];
$open_refugee = $row['open_refugee'];
$closed_refugee = $row['closed_refugee']; 


$rp= 'Registered Refugees';
$data[] = array($rp,(int)$all_refugee,(int)$open_refugee,(int)$closed_refugee);
}




echo json_encode($data);
