<?php 
    require '/var/www/prot/ctrl_vars.php';
    require '/var/www/CrimsonSpace/sites/temp.php'; 
?>
	<div>
	    <div id="chart-graph">
		<canvas id="canvas" height="250" width="600"></canvas>
	    </div>
	</div>
    <script>
	var lineChartData = {
	    labels : [ <?php for($i = 0; $i < sizeof($array_date); $i++) { print_r( $array_date[$i] ); print ",";} ?>],
	    datasets : [
		{
		    animation: true,
		    label: "Temperature",            
                    fillColor : "rgba(151,187,205,0.2)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(151,187,205,1)",
		    data : [ <?php for($i = 0; $i < sizeof($array_temp); $i++) { print_r( $array_temp[$i] ); print ",";} ?> ]
		}
	    ]

	}

    window.onload = function(){
	var ctx = document.getElementById("canvas").getContext("2d");
	window.myLine = new Chart(ctx).Line(lineChartData, {
	    responsive: true
	});
    }


    </script>

<div id="chart-info">
    Time selected: <?php echo $selected_time; ?>
</div>
<div id="chart-select">
    <form action="<?php echo $dp_site;?>/?s=members" method="post">
    <select name="selection">
	<option value="">Select...</option>
        <option value="8">8:00</option>
	<option value="10">10:00</option>
        <option value="12">12:00</option>
	<option value="14">14:00</option>
        <option value="16">16:00</option>
        <option value="18">18:00</option>
        <option value="20">20:00</option>
        <option value="22">22:00</option>
        <option value="0">00:00</option>
    </select>
    <input type="submit"/>
    </form>
</div>