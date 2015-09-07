<?php
// We need the basic variables
require  $_SERVER['DOCUMENT_ROOT']."/prot/ctrl_vars.php";

// Connect to MySQL & select the Database
mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');
mysql_select_db($dbname) or die('Cannot select database');

//Checks if there is a login cookie
if(isset($_COOKIE['crimsonspace_id'])){ //if there is, it logs you in and directes you to the members page
    $user = $_COOKIE['crimsonspace_id'];
    $pass = $_COOKIE['crimsonspace_key'];
    $check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());

    while($info = mysql_fetch_array( $check )){
	if ($pass != $info['password']){}
	else{
	    header("Location: https://crimson.space/?s=members");
	}
    }
 }

 //if the login form is submitted
 if (isset($_POST['submit'])) {

    // makes sure they filled it in
    if(!$_POST['user']){
	die('You did not fill in a username.');
    }
    if(!$_POST['pass']){
	die('You did not fill in a password.');
    }

    // checks it against the database
    if (!get_magic_quotes_gpc()){
	$_POST['email'] = addslashes($_POST['email']);
    }

    $check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['user']."'")or die(mysql_error());

 //Gives error if user dosen't exist
 $check2 = mysql_num_rows($check);
 if ($check2 == 0){
    die('That user does not exist in our database.<br /><br />If you think this is wrong <a href="https://crimson.space/?s=login">try again</a>.');
}

while($info = mysql_fetch_array( $check )){
    $_POST['pass'] = stripslashes($_POST['pass']);
    $info['pass'] = stripslashes($info['pass']);
    $_POST['pass'] = md5($_POST['pass']);

    //gives error if the password is wrong
    if ($_POST['pass'] != $info['password']){
	die('Incorrect password, please <a href="https://crimson.space/?s=login">try again</a>.');
    }

    else{ // if login is ok then we add a cookie
	$_POST['user'] = stripslashes($_POST['user']);
	$hour = time() + 3600;
	setcookie(crimsonspace_id, $_POST['user'], $hour);
	setcookie(crimsonspace_key, $_POST['pass'], $hour);

	//then redirect them to the members area
	header("Location: https://crimson.space/?s=members");
    }
}
}
else{
// if they are not logged in
?>




 <div id="center">


<form name="loginbox" action="<?php echo $site; ?>/?s=login"  method="post">
 <p>
    <span id="usercontainer">
	<input class="inputbox" onfocus="return makeUsername()" name="user" id="username" type="text" value="Username" maxlength="23">
    </span>
 </p>

 <p>
    <span id="passcontainer">
	<input class="inputbox" onfocus="return makePassword()" name="pass" id="password" type="text "value="Password" maxlength="23">
    </span>
    <input type="submit" name="submit" value"Login" style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px;"
    hidefocus="true" tabindex="-1"/>
 </p>
</form>




 </div>
 <?php
 }
 ?>
