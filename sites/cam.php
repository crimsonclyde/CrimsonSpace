<?php

// We need the basic variables
require $_SERVER['DOCUMENT_ROOT']."/prot/ctrl_vars.php";

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
                echo '<script type="text/javascript">window.open("http://crimsoncam:23095ncz93nrd38n@crimson.space:2323")</script>';
		}
        }
 }

  else{ //if the cookie does not exist, they are taken to the login screen
         header("Location: https://crimson.space/?s=login");
  }

?>
