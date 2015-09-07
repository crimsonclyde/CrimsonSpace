<?php


/* require the user as the parameter */
if(isset($_GET['CrimsonSpaceWebService']) &&
intval($_GET['CrimsonSpaceWebService'])) {

/* require global variables*/
require '/var/www/area51/ctrl_vars.php';

/* soak in the passed variable or set our own */
$number_of_results = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
$time = isset($_GET['time']) ? intval($_GET['time']) : 8; // 8:00 is default
$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
$user_id = intval($_GET['CrimsonSpaceWebService']); //no default

/* connect to the db */
$link = mysql_connect($dbhost, $dbuser, $dbpass) or die('Cannot connect to the DB');
mysql_select_db($dbname,$link) or die('Cannot select the DB');

/* grab the posts from the db */
$result = mysql_query("SELECT * FROM temp WHERE time = ".$time." LIMIT ".$number_of_results) or die ('Error fetching data from table!');

/* create one master array of the records */
$data = array();
if(mysql_num_rows($result)) {
		while($data = mysql_fetch_assoc($result)) {
			$datas[] = array('jObject'=>$data);
		}
}

/* output in necessary format */
if($format == 'json') {
	header('Content-type: application/json');
	echo json_encode(array('jArrayNode'=>$datas));
}
else {
	header('Content-type: text/xml');
	echo '<temperature>';
	foreach($datas as $index => $data) {
		if(is_array($data)) {
			foreach($data as $key => $value) {
				echo '<',$key,'>';
				if(is_array($value)) {
					foreach($value as $tag => $val) {
						echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
					}
				}
				echo '</',$key,'>';
			}
		}
	}
	echo '</temperature>';
}

/* disconnect from the db */
@mysql_close($link);
}
?>
