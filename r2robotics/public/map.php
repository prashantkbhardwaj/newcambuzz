<?php require_once("../includes/db_connection.php");?>
<!DOCTYPE html>
<html>
<head>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<center>
	<div id="googleMap" style="width:700px;height:580px;"></div>
</center>
<textarea  id="responsecontainer" style="display: none;"></textarea>
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
			var locate = x.split(',');
			var position=new google.maps.LatLng(locate[0], locate[1]);					
			if(marker != null){
            	marker.setMap(null);          
        	}
        	marker = new google.maps.Marker({
            	position: position,
            	map: map,            
        	});
		  	map.setCenter(position);		  					
			}, 1000);
			$.ajaxSetup({ cache: false});		
		});		

	}
	google.maps.event.addDomListener(window, 'load', initialize);		
</script> 	
</body>
</html>

