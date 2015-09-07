<div id="dp-frame">
<div id="dp-ascii1">
<div id="dp-ascii2">
_________        .__                              
\_   ___ \_______|__| _____   __________   ____   
/    \  \/\_  __ \  |/     \ /  ___/  _ \ /    \  
\     \____|  | \/  |  | |  \\___ (  <_> )   |  \ 
 \______  /|__|  |__|__|_|  /____  >____/|___|  / 
        \/                \/     \/           \/  
<?php 
    if ($_GET['s'] == 'wos') {
	print "<div id=\"center\">";
	echo $mod; 
	print "	</div>" . "\n";
    } else if ($_GET['s'] == 'ctrl') {
	print "<div id=\"center\">";
	echo "Control (CrimsonCore)";
	print "	</div>" . "\n";
    } else if ($_GET['s'] == 'chart') {
	print "<div id=\"center\">";
	echo "Home";
	print " </div>" . "\n";
    } else {
	print "<div id=\"center\">";
	echo $mod;
	print " </div>" . "\n";
    }
?>
</div>
</div>