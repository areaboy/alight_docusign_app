
<?php 



// check for int, string etc..
include('data6rst.php');

// get total count
$pstmt = $db->prepare('SELECT * FROM refugees');
$pstmt->execute();
$total_count = $pstmt->rowCount();

// ensure that they cotain only alpha numericals
if(strip_tags(isset($_POST["get_content"]))){
$get_content = strip_tags($_POST["get_content"]);
if($get_content == 'get_data'){

$sql_query = '';
$error = '';
$message='';
$response_bl = array();

$sql_query .= "SELECT * FROM refugees ";
if(strip_tags(isset($_POST["search"]["value"]))){

$search_value= strip_tags($_POST["search"]["value"]);
$sql_query .= 'WHERE firstname LIKE "%'.$search_value.'%" ';
$sql_query .= 'OR lastname LIKE "%'.$search_value.'%" ';
$sql_query .= 'OR phone_no LIKE "%'.$search_value.'%" ';
$sql_query .= 'OR email LIKE "%'. $search_value.'%" ';
$sql_query .= 'OR reg_no LIKE "%'.$search_value.'%" ';
$sql_query .= 'OR case_no LIKE "%'. $search_value.'%" ';
$sql_query .= 'OR middlename LIKE "%'.$search_value.'%" ';
$sql_query .= 'OR document_name LIKE "%'. $search_value.'%" ';
$sql_query .= 'OR document_status LIKE "%'. $search_value.'%" ';
  }

//ensure that order post is set
$start = $_POST['start'];
$length = $_POST['length'];
$draw= $_POST["draw"];
if(strip_tags(isset($_POST["order"]))){
$order_column = strip_tags($_POST['order']['0']['column']);
$order_dir = strip_tags($_POST['order']['0']['dir']);

$sql_query .= 'ORDER BY '.$order_column.' '.$order_dir.' ';
}
else{
$sql_query .= 'ORDER BY id DESC ';
}
if($length != -1){
$sql_query .= 'LIMIT ' . $start . ', ' . $length;
}

$pstmt = $db->prepare($sql_query);
$pstmt->execute();
$rows_count = $pstmt->rowCount();

//$result = $pstmt->fetchAll();
//foreach($result as $row){
while($row = $pstmt->fetch()){
$rows1 = array();
$id = $row['id'];
$photo = $row['photo'];
$fname = $row['firstname'];
$lname = $row['lastname'];
$mname = $row['middlename'];
$reg_no = $row['reg_no'];
$case_no = $row['case_no'];
$docufile = $row['document_name'];
$timing = $row["timing"];
$email_count = $row["email_count"];
$sms_count = $row["sms_count"];

$document_name = $row['document_name'];
$document_id = $row['document_id'];
$document_status = $row['document_status'];
$docusign_envelope_id = $row['docusign_envelope_id'];
$docusign_account_id = $row['docusign_account_id'];
$docusign_base_url = $row['docusign_base_url'];


$status = $row['status'];

if($status == 'Open'){

$st = "Awaiting Acceptance";
$colorx ="red_css";
}else{

$st = "Accepted";
$colorx ="green_css";

}




if($status == 'Open'){


                  
$rxc= "<div style='color:green;background:;padding:4px;font-size:12px;' id='status1_$id'></div>
<button id='statushide_$id' title='Click to Accept' class='report_css updates_btn'
 data-id='$id'
 data-userid='$id'
 >
 Click to Accept</button>
 <div class='loader-updates_$id'></div>
   <div class='result-updates_$id'></div>";

}else{
$rxc="<div style='color:green;background:;padding:4px;font-size:12px;'>Accepted";

}




if($document_status == 'Sent'){

$docst = "Sent";
$doccolorx ="red_css";
}else{

$docst = "Completed";
$doccolorx ="green_css";

}




if($document_status == 'Sent'){


                  
$rxc_doc= "<div style='color:green;background:;padding:4px;font-size:12px;' id='docstatus1_$id'></div>
<button id='docstatushide_$id' title='Check/Update Document Status' class='report_css docupdates_btn'
 data-id='$id'
 data-userid='$id'
data-envelope_id='$docusign_envelope_id'
 >
 Check/Update Document Status</button>
 <div class='docloader-updates_$id'></div>
   <div class='docresult-updates_$id'></div>";

}else{
$rxc_doc="<div style='color:green;background:;padding:4px;font-size:12px;'>Completed";

}

            


$fullname = "$lname $fname $mname";
$rows1[] = '<img style="max-height:60px;max-width:60px;" class="img-circle" src="uploads/'.$photo.'" >';
$rows1[] = $fullname;
$rows1[] = $row['reg_no'];

$rows1[] = '<span title="View Docusign Details" style="cursor:pointer" class="btn_action btn btn-info btn-xs" data-toggle="modal" data-target="#myModal"  
data-id="'. intval($row["id"]).'"
data-reg_no="'. strip_tags($row["reg_no"]).'"
data-case_no="'. strip_tags($row["case_no"]).'"
data-email="'. strip_tags($row["email"]).'"
data-lastname="'. strip_tags($row["lastname"]).'"
data-firstname="'. strip_tags($row["firstname"]).'"
data-middlename="'. strip_tags($row["middlename"]).'"
data-dob="'. strip_tags($row["dob"]).'"
data-pob="'. strip_tags($row["pob"]).'"
data-address="'. strip_tags($row["address"]).'"
data-gender="'. strip_tags($row["gender"]).'"
data-citizenship="'. strip_tags($row["citizenship"]).'"
data-ethinicity="'. strip_tags($row["ethinicity"]).'"
data-status="'. strip_tags($row["status"]).'"
data-religion="'. strip_tags($row["religion"]).'"
data-country="'. strip_tags($row["country"]).'"
data-timing="'. strip_tags($row["timing"]).'"
data-lat="'. strip_tags($row["lat"]).'"
data-lng="'. strip_tags($row["lng"]).'"
data-language="'. strip_tags($row["language"]).'"
data-other_language="'. strip_tags($row["other_language"]).'"
data-name_doc="'. strip_tags($row["name_doc"]).'"
data-doc_no="'. strip_tags($row["doc_no"]).'"
data-doc_type="'. strip_tags($row["doc_type"]).'"
data-place_issuance="'. strip_tags($row["place_issuance"]).'"
data-issuing_authority="'. strip_tags($row["issuing_authority"]).'"
data-fullname="'. strip_tags($fullname).'"
data-photo="'. strip_tags($row["photo"]).'"
data-docufile="'. strip_tags($docufile).'"
data-phone_no="'. strip_tags($row["phone_no"]).'"
data-document_name="'. strip_tags($document_name).'"
data-document_status="'. strip_tags($document_status).'"
data-docusign_envelope_id="'. strip_tags($docusign_envelope_id).'"
data-docusign_account_id="'. strip_tags($docusign_account_id).'"
data-docusign_base_url="'. strip_tags($docusign_base_url).'"

 >View Docusign Details</span>';

$rows1[] = '<span id="docstatushide2_'.$id.'" class="'.$doccolorx.'" > '.$docst.' </span><span id="docstatus_'.$id.'" class="docstx_'.$id.'" > </span> <span>'.$rxc_doc.'</span>';


$rows1[] = ' <span>'.$document_name.'</span> <br><span title="Download Signed Docusign" style="cursor:pointer" class="btn_action btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal_download"  
data-id="'. intval($row["id"]).'"
data-reg_no="'. strip_tags($row["reg_no"]).'"
data-case_no="'. strip_tags($row["case_no"]).'"
data-email="'. strip_tags($row["email"]).'"
data-lastname="'. strip_tags($row["lastname"]).'"
data-firstname="'. strip_tags($row["firstname"]).'"
data-middlename="'. strip_tags($row["middlename"]).'"
data-dob="'. strip_tags($row["dob"]).'"
data-pob="'. strip_tags($row["pob"]).'"
data-address="'. strip_tags($row["address"]).'"
data-gender="'. strip_tags($row["gender"]).'"
data-citizenship="'. strip_tags($row["citizenship"]).'"
data-ethinicity="'. strip_tags($row["ethinicity"]).'"
data-status="'. strip_tags($row["status"]).'"
data-religion="'. strip_tags($row["religion"]).'"
data-country="'. strip_tags($row["country"]).'"
data-timing="'. strip_tags($row["timing"]).'"
data-lat="'. strip_tags($row["lat"]).'"
data-lng="'. strip_tags($row["lng"]).'"
data-language="'. strip_tags($row["language"]).'"
data-other_language="'. strip_tags($row["other_language"]).'"
data-name_doc="'. strip_tags($row["name_doc"]).'"
data-doc_no="'. strip_tags($row["doc_no"]).'"
data-doc_type="'. strip_tags($row["doc_type"]).'"
data-place_issuance="'. strip_tags($row["place_issuance"]).'"
data-issuing_authority="'. strip_tags($row["issuing_authority"]).'"
data-fullname="'. strip_tags($fullname).'"
data-photo="'. strip_tags($row["photo"]).'"
data-docufile="'. strip_tags($docufile).'"
data-phone_no="'. strip_tags($row["phone_no"]).'"
data-document_name="'. strip_tags($document_name).'"
data-document_status="'. strip_tags($document_status).'"
data-docusign_envelope_id="'. strip_tags($docusign_envelope_id).'"
data-docusign_account_id="'. strip_tags($docusign_account_id).'"
data-docusign_base_url="'. strip_tags($docusign_base_url).'"

 >Download Signed Document</span>';




$rows1[] = '<span id="statushide2_'.$id.'" class="'.$colorx.'" > '.$st.' </span><span id="status_'.$id.'" class="stx_'.$id.'" > </span> <span>'.$rxc.'</span>';





$rows1[] = '<span data-livestamp="'.$timing.'"></span>';




//$rows1[] = '<button type="button"  class="btn btn-warning btn-xs update">Update</button>';

$rows1[] = '<button type="button"  class="btn btn-success btn-xs btn_call "  data-toggle="modal" data-target="#myModal_map"
data-id="'. intval($row["id"]).'"
data-reg_no="'. strip_tags($row["reg_no"]).'"
data-case_no="'. strip_tags($row["case_no"]).'"
data-email="'. strip_tags($row["email"]).'"
data-lastname="'. strip_tags($row["lastname"]).'"
data-firstname="'. strip_tags($row["firstname"]).'"
data-middlename="'. strip_tags($row["middlename"]).'"
data-dob="'. strip_tags($row["dob"]).'"
data-pob="'. strip_tags($row["pob"]).'"
data-address="'. strip_tags($row["address"]).'"
data-gender="'. strip_tags($row["gender"]).'"
data-citizenship="'. strip_tags($row["citizenship"]).'"
data-ethinicity="'. strip_tags($row["ethinicity"]).'"
data-status="'. strip_tags($row["status"]).'"
data-religion="'. strip_tags($row["religion"]).'"
data-country="'. strip_tags($row["country"]).'"
data-timing="'. strip_tags($row["timing"]).'"
data-lat="'. strip_tags($row["lat"]).'"
data-lng="'. strip_tags($row["lng"]).'"
data-language="'. strip_tags($row["language"]).'"
data-other_language="'. strip_tags($row["other_language"]).'"
data-name_doc="'. strip_tags($row["name_doc"]).'"
data-doc_no="'. strip_tags($row["doc_no"]).'"
data-doc_type="'. strip_tags($row["doc_type"]).'"
data-place_issuance="'. strip_tags($row["place_issuance"]).'"
data-issuing_authority="'. strip_tags($row["issuing_authority"]).'"
data-fullname="'. strip_tags($fullname).'"
data-photo="'. strip_tags($row["photo"]).'"
data-docufile="'. strip_tags($docufile).'"
data-phone_no="'. strip_tags($row["phone_no"]).'"
data-comments="'. strip_tags($row["comments"]).'"
data-document_name="'. strip_tags($document_name).'"
data-document_status="'. strip_tags($document_status).'"
data-docusign_envelope_id="'. strip_tags($docusign_envelope_id).'"
data-docusign_account_id="'. strip_tags($docusign_account_id).'"
data-docusign_base_url="'. strip_tags($docusign_base_url).'"

>Map Location</button>

<button type="button"  class="btn btn-info btn-xs btn_call" data-toggle="modal" data-target="#myModal_sms"
data-id="'. intval($row["id"]).'"
data-reg_no="'. strip_tags($row["reg_no"]).'"
data-case_no="'. strip_tags($row["case_no"]).'"
data-email="'. strip_tags($row["email"]).'"
data-lastname="'. strip_tags($row["lastname"]).'"
data-firstname="'. strip_tags($row["firstname"]).'"
data-middlename="'. strip_tags($row["middlename"]).'"
data-dob="'. strip_tags($row["dob"]).'"
data-pob="'. strip_tags($row["pob"]).'"
data-address="'. strip_tags($row["address"]).'"
data-gender="'. strip_tags($row["gender"]).'"
data-citizenship="'. strip_tags($row["citizenship"]).'"
data-ethinicity="'. strip_tags($row["ethinicity"]).'"
data-status="'. strip_tags($row["status"]).'"
data-religion="'. strip_tags($row["religion"]).'"
data-country="'. strip_tags($row["country"]).'"
data-timing="'. strip_tags($row["timing"]).'"
data-lat="'. strip_tags($row["lat"]).'"
data-lng="'. strip_tags($row["lng"]).'"
data-language="'. strip_tags($row["language"]).'"
data-other_language="'. strip_tags($row["other_language"]).'"
data-name_doc="'. strip_tags($row["name_doc"]).'"
data-doc_no="'. strip_tags($row["doc_no"]).'"
data-doc_type="'. strip_tags($row["doc_type"]).'"
data-place_issuance="'. strip_tags($row["place_issuance"]).'"
data-issuing_authority="'. strip_tags($row["issuing_authority"]).'"
data-fullname="'. strip_tags($fullname).'"
data-photo="'. strip_tags($row["photo"]).'"
data-docufile="'. strip_tags($docufile).'"
data-phone_no="'. strip_tags($row["phone_no"]).'"
data-comments="'. strip_tags($row["comments"]).'"
data-document_name="'. strip_tags($document_name).'"
data-document_status="'. strip_tags($document_status).'"
data-docusign_envelope_id="'. strip_tags($docusign_envelope_id).'"
data-docusign_account_id="'. strip_tags($docusign_account_id).'"
data-docusign_base_url="'. strip_tags($docusign_base_url).'"
>Send SMS <span class="badge bg-danger sms_count"> '.$sms_count.'</span></button>


<button type="button"  class="btn btn-primary btn-xs btn_call" data-toggle="modal" data-target="#myModal_email"
data-id="'. intval($row["id"]).'"
data-reg_no="'. strip_tags($row["reg_no"]).'"
data-case_no="'. strip_tags($row["case_no"]).'"
data-email="'. strip_tags($row["email"]).'"
data-lastname="'. strip_tags($row["lastname"]).'"
data-firstname="'. strip_tags($row["firstname"]).'"
data-middlename="'. strip_tags($row["middlename"]).'"
data-dob="'. strip_tags($row["dob"]).'"
data-pob="'. strip_tags($row["pob"]).'"
data-address="'. strip_tags($row["address"]).'"
data-gender="'. strip_tags($row["gender"]).'"
data-citizenship="'. strip_tags($row["citizenship"]).'"
data-ethinicity="'. strip_tags($row["ethinicity"]).'"
data-status="'. strip_tags($row["status"]).'"
data-religion="'. strip_tags($row["religion"]).'"
data-country="'. strip_tags($row["country"]).'"
data-timing="'. strip_tags($row["timing"]).'"
data-lat="'. strip_tags($row["lat"]).'"
data-lng="'. strip_tags($row["lng"]).'"
data-language="'. strip_tags($row["language"]).'"
data-other_language="'. strip_tags($row["other_language"]).'"
data-name_doc="'. strip_tags($row["name_doc"]).'"
data-doc_no="'. strip_tags($row["doc_no"]).'"
data-doc_type="'. strip_tags($row["doc_type"]).'"
data-place_issuance="'. strip_tags($row["place_issuance"]).'"
data-issuing_authority="'. strip_tags($row["issuing_authority"]).'"
data-fullname="'. strip_tags($fullname).'"
data-photo="'. strip_tags($row["photo"]).'"
data-docufile="'. strip_tags($docufile).'"
data-phone_no="'. strip_tags($row["phone_no"]).'"
data-comments="'. strip_tags($row["comments"]).'"
data-document_name="'. strip_tags($document_name).'"
data-document_status="'. strip_tags($document_status).'"
data-docusign_envelope_id="'. strip_tags($docusign_envelope_id).'"
data-docusign_account_id="'. strip_tags($docusign_account_id).'"
data-docusign_base_url="'. strip_tags($docusign_base_url).'"
>Send Email <span class="badge bg-success email_count"> '.$email_count.'</span></button>


<button type="button" name="delete" id="'. intval($row["id"]).'" class="btn btn-danger btn-xs delete">Delete</button>

';

$response_bl[] = $rows1;
}

$data = array(
"draw"    => $draw,
"recordsTotal"  => $rows_count,
"recordsFiltered" => $total_count,
"data"    => $response_bl);
}// you can close this

if($_POST["get_content"] == 'get_one_content')
 {
  $id =  $_POST["id"];
  $sql_query = "SELECT * FROM refugees WHERE id = '$id'";
  $pstmt = $db->prepare($sql_query);
  $pstmt->execute();
  while($row = $pstmt->fetch()){
   $data['first_name'] = $row['firstname'];
   $data['last_name'] = $row['lastname'];
   $data['phone'] = $row['phone_no'];
   $data['email_address'] = $row['email'];
  }
 }

 //}
 
 



// delete content
if(strip_tags($_POST["get_content"]) == 'Delete'){
$error='';
$error1='';
$message='';
$pstmt_del='';	
$id = intval($_POST["id"]);
  
$pstmt_del = $db->prepare('DELETE from refugees where id=:id');
$pstmt_del->execute(array(':id' =>$id));
$message = 'Deleted';
if($pstmt_del){
    $data = array(
    'error'   => $error,
    'message'  =>$message);
	}else{
	$data = array(
	'error'   => $error,
    'message'   => 'deleted-error'
    );
	}	
 }
 // end delete contents

 echo json_encode($data);
}



?>