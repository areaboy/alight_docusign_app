<?php
error_reporting(0);
include('settings.php');
$timerx = time();

session_start();
//set session
if(!isset($_SESSION['user_session']) || (trim($_SESSION['user_session']) == '')) {
echo "<script>alert('Session Expired. Direct access to this Page Not allowed..');</script>";
		header("location: index.php");
		exit();
	}



$fname_sess = $_SESSION['user_fullname_session'];
$id_sess =$_SESSION['user_id_session'];
$email_sess= $_SESSION['user_email_session'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="moment.js"></script>
	<script src="livestamp.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="jquery.dataTables.min.js"></script>
  <script src="dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



    <title>Welcome  <?php echo $fname_sess; ?></title>

<style>

.imagelogo_li_remove {
list-style-type: none;
margin: 0;
 padding: 0;
}

.imagelogo_data{
 width:120px;
 height:80px;
}

 .bottomcorner_css{
  //position:fixed;
position:absolute;
  bottom:0;
  right:0;
  }


 .topcorner_css{
  //position:fixed;
position:absolute;
  top:10;
  right:0;
  }


</style>





</head>

<body>
    <div>
        
 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Alight Docusign</a>
    </div>
    <ul class="nav navbar-nav">
<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>
<li><a <a style='cursor:pointer;' class="nav-link" data-toggle="modal" data-target="#myModal_token" title="Generate Docusign Token">Generate Docusign Token</a></li>
      <li><a style='cursor:pointer;' class="nav-link" href="dashboard.php">Dashboard</a></li>
<li class="nav-item">

                            <a class="nav-link" href="logout.php" title="Logout">Logout</a>
                        </li>
    </ul>
  </div>
</nav> 




<br><br><br>


<h3>Welcome  <b><?php echo $fname_sess; ?></b></h3>

<br>





<?php
include('data6rst.php');


$result = $db->prepare("SELECT * FROM refugees where needy='1' ");
$result->execute(array());
$rows = $result->fetch();
$counting_result = $result->rowCount();




$resultc = $db->prepare("SELECT * FROM refugees where status='Open' ");
$resultc->execute(array());
$rowsc = $resultc->fetch();
$counting_open = $resultc->rowCount();




$resultc = $db->prepare("SELECT * FROM refugees where status='Closed' ");
$resultc->execute(array());
$rowsc = $resultc->fetch();
$counting_closedx = $resultc->rowCount();
?>
<div class='row'>

<div class='col-sm-4' style='background:#ddd;'>
<b style='font-size:20px'>
(<?php echo $counting_result; ?>) </b><br>
Total Registered Refugees

</div>


<div class='col-sm-4' style='background:#ddd;'>
<b style='font-size:20px'>
<?php echo $counting_open; ?>  </b><br>
Total Refugees Awaiting Approval



</div>

<div class='col-sm-4' style='background:#ccc;'>
<b style='font-size:20px'>
(<?php echo $counting_closedx; ?>) </b><br>
Total Refugees Approved/Accepted

</div>


</div><br>









<!-- Modal -->
  <div class="modal fade" id="myModal_token" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Docusign Token Generation</h4>
        </div>
        <div class="modal-body">

<script>


$(document).ready(function(){
$('#token_btn').click(function(){
		

var client_id = $('#client_id').val();
var redirect_url = $('#redirect_url').val();


var token_all ="https://account-d.docusign.com/oauth/auth?response_type=code&scope=YOUR_REQUESTED_SCOPES&client_id=<?php echo $integratorKey; ?>&state=<?php echo $timerx; ?>&redirect_uri=<?php echo $docusign_redirect_url_token_generate; ?>";
//alert(token_all);

if(client_id =''){
alert('Docusign Client ID/Integration Key cannot be Empty. Please set it as Integration Key at settings.php file');
return false;
}

if(redirect_url =''){
alert('Docusign Redirect URL cannot be Empty. Please set it  at settings.php file');
return false;
}


$('#loader_token').hide();
$('#result_token').html(token_all);


$("#result_token").html("<br><br><a href=' "+token_all+"' target='_blank' style='font-size:12px;color:white;background:navy;padding:6px;border:none;border-radius:15%;text-align:center;'>Please Continue with Token Generation</a>");

$(".btn_hide").hide();

})
});
</script>
       

 <div class="form-group">
              <label style="" for="">
Docusign Client ID/Integration Key</label>
              <input disabled type="text" class="col-sm-12 form-control" id="client_id" name="client_id"  value="<?php echo substr($integratorKey, 0,10)."xxxxxxxxxxxxxxxxxxxxx"; ?>">

            </div>


<div class="form-group">
              <label style="" for="">
Redirect URL</label>
              <input disabled type="text" class="col-sm-12 form-control" id="redirect_url" name="redirect_url"  value="<?php echo $docusign_redirect_url_token_generate; ?>">

            </div>

<br>
<div class="form-group">
<div id="loader_token" ></div>

<div id="result_token" class=''></div>
<br />

<button type="button" id="token_btn" class="btn btn-primary btn_hide" title='Generate Token'>Generate Token Now!</button>
</div>


<?php



include('data6rst.php');
$result = $db->prepare('SELECT * FROM users where  id =:id');
$result->execute(array(':id' => $id_sess));
$nosofrows = $result->rowCount();

$row = $result->fetch();

$access_tokenx = $row['access_token'];
if($access_tokenx ==''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Docusign Access Token is Empty. Please Generate Access Token as Admin</div>";

}else{
echo "<div style='background:green;color:white;padding:10px;border:none;'>Docusign Access Token has already been Generated by Admin. The App is set to Use...</div>";
}

?>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>





<span class="alert_server_response"></span>
<span class="loader_x"></span>










<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">  

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(column_chart);
//google.charts.setOnLoadCallback(line_chart);
function column_chart() {

$('#loader1').fadeIn(400).html('<div style="background:#ddd;color:black;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i> &nbsp; &nbsp;Please Wait, Statistics is being Loaded.</div>');

var res = $.ajax({
url: 'chart.php',
dataType:"json",
async: false,
success: function(res)
{

  var options = {'title':'Registered Refugees Over Time', 'width':800, 'height':400,
 series: {
            0: { color: 'purple' },
            1: { color: 'navy' },
          
          }
};


var data = new google.visualization.arrayToDataTable(res);
var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_data'));
chart.draw(data, options);
$('#loader1').hide();

}
}).responseText;
}




google.charts.setOnLoadCallback(line_chart);
function line_chart() {


$('#loader2').fadeIn(400).html('<div style="background:#ddd;color:black;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i> &nbsp; &nbsp;Please Wait,  Statistics is being Loaded</div>');

var res1 = $.ajax({
url: 'chart.php',
dataType:"json",
async: false,
success: function(res1)
{

  var options = {'title':'Registered Refugees Over Time', 'width':800, 'height':400,
 series: {
            0: { color: '#800000' },
            1: { color: 'orange' },
          
          }
};


var data = new google.visualization.arrayToDataTable(res1);
var chart = new google.visualization.BarChart(document.getElementById('areachart_data'));
chart.draw(data, options);
$('#loader2').hide();

}
}).responseText;
}





google.charts.setOnLoadCallback(pie_chart);
function pie_chart() {


$('#loader3').fadeIn(400).html('<div style="background:#ddd;color:black;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i> &nbsp; &nbsp;Please Wait, Statistics is being Loaded</div>');

var res2 = $.ajax({
url: 'chart1.php',
dataType:"json",
async: false,
success: function(res2)
{

  var options = {'title':'Registered Refugees Over Time', 'width':800, 'height':400,
 series: {
            0: { color: '#800000' },
            1: { color: 'orange' },
          
          }
};


var data = new google.visualization.arrayToDataTable(res2);
var chart = new google.visualization.ColumnChart(document.getElementById('piechart_data'));
chart.draw(data, options);
$('#loader3').hide();

}
}).responseText;
}






</script>


<h3><center>Total Registered Refugees Vs Refugeess Awaiting Acceptance Vs Refugees Accepted Over Time</center></h3>
<div id="loader1"></div>
    <div id="areachart_data"></div>

<div id="loader2"></div>
    <div id="columnchart_data"></div>



<div id="loader3"></div>
    <div id="piechart_data"></div>



    </div>



<div id="loader" class='res_center_css'></div>














</body>
</html>

