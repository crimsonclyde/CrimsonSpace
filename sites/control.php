<table id="tfhover" class="tftable" border="1">
<tr><td>Core</td><td><input type="text" id="Core" disabled /></td></tr>
<tr><td>Date</td><td><input type="text" id="Date" disabled /></td></tr>
<tr><td>Time</td><td><input type="text" id="Time" disabled /></td></tr>
<tr><td>WLAN</td><td><input type="text" id="RSSI" disabled /></td></tr>
<tr><td>Temp</td><td><input type="text" id="Temp" disabled /></td></tr>
<tr><td>Photo </td><td><input type="text" id="Photo" disabled /></td></tr>
<tr><td>SCL</td><td><input type="text" id="SCL" disabled /></td></tr>
<tr><td> </td><td>
	<button type="button" id="SCL1" onclick="switchLED(3,1)">SCL On</button>
        <button type="button" id="SCL0" onclick="switchLED(3,0)">SCL Off</button>
</td></tr>
</table>
<div id="connection1">
    <div id="connection2">
    </div>
</div>


<script type="text/javascript">
document.getElementById("connection2").innerHTML = "<pre>Login Date: " + Date() +"<br></b>crimson:~ crimson$ </b>connecting to the cloud<br>... <div class=\"cursor\"> </div></pre>"
    function start() {

	var deviceID = "<?php echo $mCoreId; ?>";
	var accessToken = "<?php echo $mAccessToken; ?>";
	var eventSource = new EventSource("<?php echo $mCloudApi; ?>" + deviceID + "/events/?access_token=" + accessToken);

        eventSource.addEventListener('open', function(e) {
            console.log("Opened!");
	    document.getElementById("connection2").innerHTML = "<pre>Login Date: " + Date() +"<br><b>crimson:~ crimson$ </b>connecting to the cloud<br>Connection established!<br><b>crimson:~ crimson$ </b><div class=\"cursor\"> </div></pre>"
	    window.setTimeout('document.getElementById("connection1").innerHTML = ""', 10000);
	},false);

        eventSource.addEventListener('error', function(e) {
            console.log("Errored!");
	    document.getElementById("connection2").innerHTML = "<pre>Login Date: " + Date() +"<br><b>crimson:~ crimson$ </b>connecting to the cloud<br>Error: Failed connecting to the cloud.<br><b>crimson:~ crimson$ </b><div class=\"cursor\"> </div></pre>"
	    window.setTimeout('document.getElementById("connection1").innerHTML = ""', 10000);
	},false);


// ****************************************************************************************
        // Start getting published informations
        // ****************************************************************************************


        // Data + Core ID
        eventSource.addEventListener('pDate', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // Print the CoreID
            document.getElementById("Core").value = rawData.coreid;

            // Correct the leading 0 problem
            if ( parsedData.Day < 10 )   { var theDay = "0" + parsedData.Day; }
            else var theDay = parsedData.Day;
            if ( parsedData.Month < 10 ) { var theMonth = "0" + parsedData.Month; }
            else var theMonth = parsedData.Month;

            document.getElementById("Date").value = theDay + "." + theMonth + "." + parsedData.Year;
        }, false);


        // Wlan Signal Strength
        eventSource.addEventListener('pMisc', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // from -127 to -1dB
            document.getElementById("RSSI").value =  parsedData.RSSI + " dB";
        }, false);



        // Time
        eventSource.addEventListener('pTime', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // Correct the leading 0 problem
            if (parsedData.Hours < 10 ) { var theHour = "0" + parsedData.Hours; }
            else var theHour = parsedData.Hours;
            if (parsedData.Minutes < 10) { var theMinute = "0" + parsedData.Minutes; }
            else var theMinute = parsedData.Minutes;
            if (parsedData.Seconds < 10) { var theSecond = "0" + parsedData.Seconds ; }
            else var theSecond = parsedData.Seconds;

            document.getElementById("Time").value = theHour + ":" + theMinute + ":" + theSecond;

        }, false);
		// ****************************************************************************************
        // Start getting published informations
        // ****************************************************************************************


        // Data + Core ID
        eventSource.addEventListener('pDate', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // Print the CoreID
            document.getElementById("Core").value = rawData.coreid;

            // Correct the leading 0 problem
            if ( parsedData.Day < 10 )   { var theDay = "0" + parsedData.Day; }
            else var theDay = parsedData.Day;
            if ( parsedData.Month < 10 ) { var theMonth = "0" + parsedData.Month; }
            else var theMonth = parsedData.Month;

            document.getElementById("Date").value = theDay + "." + theMonth + "." + parsedData.Year;
        }, false);


        // Wlan Signal Strength
        eventSource.addEventListener('pMisc', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // from -127 to -1dB
            document.getElementById("RSSI").value =  parsedData.RSSI + " dB";
        }, false);



        // Time
        eventSource.addEventListener('pTime', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // Correct the leading 0 problem
            if (parsedData.Hours < 10 ) { var theHour = "0" + parsedData.Hours; }
            else var theHour = parsedData.Hours;
            if (parsedData.Minutes < 10) { var theMinute = "0" + parsedData.Minutes; }
            else var theMinute = parsedData.Minutes;
            if (parsedData.Seconds < 10) { var theSecond = "0" + parsedData.Seconds ; }
            else var theSecond = parsedData.Seconds;

            document.getElementById("Time").value = theHour + ":" + theMinute + ":" + theSecond;

        }, false);
	
		// Temperature
 	eventSource.addEventListener('pMisc', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);
            document.getElementById("Temp").value = parsedData.Temperature + "º Celsius";
        }, false);
 

	// Photoresistor
  	eventSource.addEventListener('pPhoto', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);
            
	    if (parsedData.Photocell == 1023) {
		document.getElementById("Photo").value = "Day";
	    } else if (parsedData.Photocell <1023 && parsedData.Photocell >900) {
		document.getElementById("Photo").value = "Dawn (" + parsedData.Photocell + ")";
	    } else if (parsedData.Photocell > 0 && parsedData.Photocell < 900) {
		document.getElementById("Photo").value = "Twilight (" + parsedData.Photocell + ")";
	    } else {
		document.getElementById("Photo").value = "Undefined State";
	    }
	    //document.getElementById("Photo").value = parsedData.Photocell + " resistance";
        }, false);


	// StoneCircleLight
	eventSource.addEventListener('pMisc', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

	    if(parsedData.SCL == 0) { 
		document.getElementById("vSCL").value = "Activated";
        	//document.getElementById("SCL").value = parsedData.SCL + " Activated";
		//document.getElementById("bSCL").innerHTML= "Off";
		//document.getElementByID("bSCL").onclick = "('switchLED(3,1)')";
	    } else if (parsedData.SCL == 1 ) {
		  document.getElementById("SCL").value = "Deactivated";
		//document.getElementById("SCL").value = parsedData.SCL + " Deactivated";
		//document.getElementById("bSCL").innerHTML= "On";
		//document.getElementByID("bSCL").onclick = "('switchLED(3,0)')";
	    } else {
		document.getElementById("SCL").value = "Undefined state";
	    }
	}, false);

}

    window.setTimeout('start();', 3000);
    </script>
    <script type="text/javascript">
      var dID    = "<?php echo $mCoreId; ?>";
      var aToken = "<?php echo $mAccessToken; ?>"; 
      var setFunc = "<?php echo $mFunction; ?>";

      function switchLED(ledn,newValue) {
        var paramStr = "d" + ledn.toString();
        if (newValue==1) { 
           paramStr = paramStr + ",LOW";
        } else {
          paramStc cddEventListener('pDate', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // Print the CoreID
            document.getElementById("Core").value = rawData.coreid;

            // Correct the leading 0 problem
            if ( parsedData.Day < 10 )   { var theDay = "0" + parsedData.Day; }
            else var theDay = parsedData.Day;
            if ( parsedData.Month < 10 ) { var theMonth = "0" + parsedData.Month; }
            else var theMonth = parsedData.Month;

            document.getElementById("Date").value = theDay + "." + theMonth + "." + parsedData.Year;
        }, false);


        // Wlan Signal Strength
        eventSource.addEventListener('pMisc', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // from -127 to -1dB
            document.getElementById("RSSI").value =  parsedData.RSSI + " dB";
        }, false);



        // Time
        eventSource.addEventListener('pTime', function(e) {
            var rawData = JSON.parse(e.data);
            var parsedData = JSON.parse(rawData.data);

            // Correct the leading 0 problem
            if (parsedData.Hours < 10 ) { var theHour = "0" + parsedData.Hours; }
            else var theHour = parsedData.Hours;
            if (parsedData.Minutes < 10) { var theMinute = "0" + parsedData.Minutes; }
            else var theMinute = parsedData.Minutes;
            if (parsedData.Seconds < 10) { var theSecond = "0" + parsedData.Seconds ; }
            else var theSecond = parsedData.Seconds;

            document.getElementById("Time").value = theHour + ":" + theMinute + ":" + theSecond;

        }, false);
 paramStr + ",HIGH";
        }
    
	var requestURL = "<?php echo $mCloudApi; ?>" +dID + "/" + setFunc + "/";

	$.post( requestURL, { access_token: aToken, params: paramStr });
	}
</script>
