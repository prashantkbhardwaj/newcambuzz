<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$drone = find_drone_by_id($_GET["drone_id"]);
	if (!$drone) {
		redirect_to("drone_count.php");
	}
	$drone_id = $drone["drone_id"];
?>
<?php
	$count = "SELECT count( DISTINCT(drone_id) ) FROM drones";
	$count_result = mysqli_query($conn, $count);
	confirm_query($count_result);
    $row = mysqli_fetch_array($count_result);
    $total_drones = $row[0];    
?>
<!DOCTYPE html>
<html>
<head>
<title>R2 Robotics</title>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['gauge']}]}"></script>
</head>
<body>
<table>
	<tr>
		<td><div id="googleMap" style="width:600px;height:480px;"></div></td>
		<td><div id="chart_div" style="width: 500px; height: 220px;"></div></td>
	</tr>
</table>
<center>	
	<h3><a href="landing.php">Home</a></h3>
</center>
<textarea id="dcount" style="display: none;"><?php echo $total_drones; ?></textarea>
<textarea id="did" style="display: none;"><?php echo $drone_id; ?></textarea>
<textarea  id="responsecontainer" style="display: none;"></textarea>
<textarea id="alti" style="display: none;"></textarea>
<script>	
	function initialize()
	{		 
		var marker;		
		var mapProp = {	
			center: new google.maps.LatLng(0,0),	  	
		  	zoom:15,
		  	mapTypeId:google.maps.MapTypeId.ROADMAP
		};	
		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
		$(document).ready(function() {
			$("#responsecontainer").load("select.php");
			var refreshId = setInterval(function() {
				$("#responsecontainer").load('select.php?randval='+ Math.random());
				var x = document.getElementById("responsecontainer").value;
				var drone = document.getElementById("did").value;
				var dcount = document.getElementById("dcount").value;
				var loop = dcount*4;				
				var locate = x.split(',');
				for (var i = 3; i < loop; i+=4) {
					
					if (locate[i]==drone) {
						var position=new google.maps.LatLng(locate[i-3], locate[i-2]);		
						document.getElementById("alti").innerHTML = locate[i-1];				
						if(marker != null){
			            	marker.setMap(null);          
			        	}
			        	marker = new google.maps.Marker({
			            	position: position,
			            	map: map,            
			        	});
					  	map.setCenter(position);					  	
					};				
				};					  					
			}, 1000);
			$.ajaxSetup({ cache: false});		
		});	
	}
	google.maps.event.addDomListener(window, 'load', initialize);		
</script> 	

<script type="text/javascript">
	google.setOnLoadCallback(drawChart);
    function drawChart() {

	    var data = google.visualization.arrayToDataTable([
		    ['Label', 'Value'],
		    ['Altitude', 0]          
	    ]);

	    var options = {
		    width: 500, height: 220,
		    redFrom: 90, redTo: 100,
		    yellowFrom:75, yellowTo: 90,
		    minorTicks: 5
	    };

	    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

	    chart.draw(data, options);
	    var alti;
	    setInterval(function() {
		    alti  = document.getElementById("alti").value;
		    data.setValue(0, 1, alti);
		    chart.draw(data, options);
	    }, 1000);        
    }
</script>
</body>
</html>

