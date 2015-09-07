<?php

// Global Variables
$array_date = array();
$array_temp = array();


if ($_POST['selection']) { $selected_time = $_POST['selection']; }
if (!isset($selected_time)) { $selected_time = 8; }

// Connect to MySQL Server
$con = mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');
// Select Database
mysql_select_db($dbname);
// Get ´em all
$result = mysql_query("SELECT * FROM temp WHERE time = ".$selected_time) or die ('Error fetching data from table');

while($row = mysql_fetch_assoc($result)) {
    array_push($array_date, $row['day'].'.'.$row['month']);
    array_push($array_temp, $row['temp']);
}

// finally close db connection
mysql_close($con);
?>
