<?php
error_reporting(0);
include('settings.php');

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
$phoneno_sess = $_SESSION['user_phoneno_session'];

?>




<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title></title>
    <style>
    
      #map {
        height: 80%;
      }
    
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>



  <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>


<script src="moment.js"></script>
	<script src="livestamp.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">











<style>



.section_padding {
padding: 60px 40px;
}

.imagelogo_li_remove {
list-style-type: none;
margin: 0;
 padding: 0;
}

.imagelogo_data{
 width:120px;
 height:80px;
}



  .navbar {
    letter-spacing: 1px;
    font-size: 14px;
    border-radius: 0;
    margin-bottom: 0;
   background-color:#8B008B;

    z-index: 9999;
    border: 0;
    font-family: comic sans ms;
//color:white;
  }



  
.navbar-toggle {
background-color:orange;
  }

.navgate {
padding:16px;color:white;

}

.navgate:hover{
 color: black;
 background-color: orange;

}


.navbar-header{
height:60px;
}

.navbar-header-collapse-color {
background:white;
}

.dropdown_bgcolor{

background: #ec5574;
color:white;
}

.dropdown_dashedline{
 border-bottom: 2px dotted white;
}

.navgate101:hover{
background:purple;
color:white;

}



.res_center_css{
position:absolute;top:50%;left:50%;margin-top: -50px;margin-left -50px;width:100px;height:100px;
}


</style>

<html>
  <body>

<!-- start column nav-->
   <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container">
               





<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">/



                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php" title="All Homes">Dashboard(All Homes)</a>
                        </li>/

                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_open_home.php" title="Available Home">Available Home</a>
                        </li>/

 <li class="nav-item">
                            <a class="nav-link" href="dashboard_closed_home.php" title="Matched Home">Matched Home</a>
                        </li>/


 <li class="nav-item">
                            <a class="nav-link" href="statistics_home.php" title="Home Statistics">Home Statistics</a>
                        </li>/

<li class="nav-item">
                            <a class="nav-link" href="profile.php" title="My Home Profile">My Home Profile</a>
                        </li>/


     <li class="nav-item">
                            <a class="nav-link" href="admin_logout.php" title="Logout">Logout</a>
                        </li>
                      
                    </ul>
<button style='' title='Refresh Page' class='btn btn-warning reloadData'>Refresh Page</button>
                </div>
            </div>
        </nav>


    </div><br /><br />

<!-- end column nav-->





<style>
/*
body {
    width: 660px;
    margin: 0 auto;
}
*/
</style>


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

  var options = {'title':'Published Home/House Over Time', 'width':800, 'height':400,
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

  var options = {'title':'Published Home/House Over Time', 'width':800, 'height':400,
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

  var options = {'title':'Publish Home/House Over Time', 'width':800, 'height':400,
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

<br><br>
<h3><center>Total Home Vs Available Home Vs Matched Home Over Time</center></h3>
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






