<?php
	$latitude = $_GET['latitude'];
	$longitude = $_GET['longitude'];
?>
<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script>

	var position=new google.maps.LatLng(<?php echo $latitude.", ".$longitude; ?>);
	function initialize()
	{
		var mapProp = {
		  center:position,
		  zoom:18,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);	
		var marker=new google.maps.Marker({  
			position: position,						
	  	});		

	  	marker.setMap(map);
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap" style="width:500px;height:380px;"></div>
</body>
</html>