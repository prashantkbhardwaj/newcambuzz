<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
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
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<center>
	<div id="googleMap" style="width:700px;height:580px;"></div>
	<h3><a href="drone_count.php">Go to drone list</a></h3>
</center>
<textarea id="dcount" style="display: none;"><?php echo $total_drones; ?></textarea>
<textarea  id="responsecontainer" style="display: none;"></textarea>
<script>	
	function initialize()
	{	
		var marker = [];			
		var stat = new google.maps.LatLng(28.683702, 77.208618);
		var mapProp = {	
			center: new google.maps.LatLng(28.683702, 77.208618),	  	
		  	zoom:15,
		  	mapTypeId:google.maps.MapTypeId.ROADMAP
		};	
		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
		$(document).ready(function() {
			$("#responsecontainer").load("select.php");
			var refreshId = setInterval(function() {
				$("#responsecontainer").load('select.php?randval='+ Math.random());
				var x = document.getElementById("responsecontainer").value;			
				var dcount = document.getElementById("dcount").value;
				var loop = dcount*3;
				var locate = x.split(',');
				var position = [];
				var b = 2;
				for (var i = 2; i < loop; i+=1) {				
					position[i-b]=new google.maps.LatLng(locate[i-2], locate[i-1]);					
					if(marker[i-b] != null){
		            	marker[i-b].setMap(null);          
		        	}
		        	marker[i-b] = new google.maps.Marker({
		            	position: position[i-b],
		            	map: map,            
		        	});
				  	map.setCenter(stat);
				  	b = 2*i;				
				};					  					
			}, 1000);
			$.ajaxSetup({ cache: false});		
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);		
</script> 	
</body>
</html>

