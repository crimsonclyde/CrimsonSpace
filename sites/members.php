<?php
// We need the basic variables
require  $_SERVER['DOCUMENT_ROOT']."/prot/ctrl_vars.php";

// Connect to MySQL & select the Database
mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');
mysql_select_db($dbname) or die('Cannot select database');


 //checks cookies to make sure they are logged in
 if(isset($_COOKIE['crimsonspace_id'])){
 	$username = $_COOKIE['crimsonspace_id'];
 	$pass = $_COOKIE['crimsonspace_key'];
 	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
 	while($info = mysql_fetch_array( $check )){
		//if the cookie has the wrong password, they are taken to the login page
 		if ($pass != $info['password']){
			header("Location: https://crimson.space/?s=login");
 		}
		//otherwise they are shown the admin area
		else{

echo '<div class="wos-main-container">';
echo '<div class="tabs">';

// Temperature
echo '   <div class="tab">';
echo '       <input type="radio" id="tab-1" name="tab-group-1" checked>';
echo '       <label for="tab-1">Core Control</label>';

echo '       <div class="content">';
		include 'control.php';
echo '       </div> ';
echo '   </div>';

// Gas
echo '   <div class="tab">';
echo '       <input type="radio" id="tab-2" name="tab-group-1">';
echo '       <label for="tab-2">Gas</label>';

echo '       <div class="content">';
echo '           Gas';
echo '       </div> ';
echo '   </div>';

// Water
echo '    <div class="tab">';
echo '       <input type="radio" id="tab-3" name="tab-group-1">';
echo '       <label for="tab-3">Water</label>';

echo '       <div class="content">';
echo '           Water';
echo '       </div> ';
echo '   </div>';

// Electricity
echo '	<div class="tab">';
echo '       <input type="radio" id="tab-4" name="tab-group-1">';
echo '       <label for="tab-4">Electricity</label>';

echo '       <div class="content">';
echo '           Electricity';
echo '       </div> ';
echo '   </div>';

// CrimsonCore Control
echo '  <div class="tab">';
echo '       <input type="radio" id="tab-5" name="tab-group-1">';
echo '       <label for="tab-5">Temperature</label>';

echo '       <div class="content">';
		include 'chart.php';
echo '       </div> ';
echo '   </div>';

// Camera
echo '  <div class="tab">';
echo '       <input type="radio" id="tab-6" name="tab-group-1">';
echo '       <label for="tab-6">Camera</label>';

echo '       <div class="content">';
echo '          <a href="https://crimson.space/?s=cam">Camera</a>';
echo '       </div> ';
echo '   </div>';

// Logout
echo '  <div class="tab">';
echo '       <input type="radio" id="tab-7" onclick="return load()" name="tab-group-1">';
echo '       <label for="tab-7">Logout</label>';

echo '<p><h1>Logging out</h1><p>';
echo '<script language="javascript" type="text/javascript">';
echo 'function load() {';
echo 'window.location.href = "http://crimson.space/?s=logout";';
echo '}';
echo '</script>';
echo '   </div>';

echo '</div>';
echo '</div>';


 		}
	}
}
 else{ //if the cookie does not exist, they are taken to the login screen
	header("Location: https://crimson.space/?s=login");
 }
 ?>
