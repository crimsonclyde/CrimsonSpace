<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title><?php echo $name.$mod; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="<?php echo $site ?>/favicon.ico" />

    <!-- Choose stylesheet based on device (desktop/mobile) -->
    <?php
	if ($iphone || $android || $palmpre || $ipod || $berry == true)
	{
	    $lnk_mob_norm = $css_url . "mob_normalize.css";
	    $lnk_mob_main = $css_url . "mob_main.css";
	    print "<link rel=\"stylesheet\" href=\"$lnk_mob_norm\" />";
	    print "<link rel=\"stylesheet\" href=\"$lnk_mob_main\" />";
	} else {
	    $lnk_main = $css_url . "main_crimson.css";
	    print "<link rel=\"stylesheet\" href=\"$lnk_main\" />";
	}
    ?>

    <?php
	if ($_GET['s'] == "members") {
	    $lnk_chart_js = $js_url . "chart.js";
	    print "<script src=\"$lnk_chart_js\"></script>";
	}
	if ($_GET['s'] == "login") {
	    print '<script type="text/javascript">
		function makePassword() {
			document.getElementById("passcontainer").innerHTML = "<input id=\"password\" class=\"inputbox\" name=\"pass\" type=\"password\"/>";
			document.getElementById("password").focus();
		}
		function makeUsername() {
			document.getElementById("usercontainer").innerHTML = "<input id=\"username\" class=\"inputbox\" name=\"user\" type=\"text\"/>";
			document.getElementById("username").focus();
		}
	    </script>';
      print '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"';

	}
    ?>
    <script src="<?php echo $js_url; ?>vendor/modernizr-2.6.2.min.js"></script>
</head>

<body>
<!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Content -->
