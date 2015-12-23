<?php require_once("../includes/db_connection.php");?>
<?php
	if (isset($_GET['drone_id'])) { $drone_id = $_GET['drone_id'];	} else { $drone_id = ""; }
	if (isset($_GET['altitude'])) { $altitude = $_GET['altitude'];	} else { $altitude = ""; }
	if (isset($_GET['latitude'])) { $latitude = $_GET['latitude'];	} else { $latitude = ""; }
	if (isset($_GET['longitude'])) { $longitude = $_GET['longitude']; } else { $longitude = ""; }	
	
	date_default_timezone_set('Asia/Calcutta');
    $location_time = date("Y-m-d\TH:i:s");

   	$query = "INSERT INTO drones (drone_id, altitude, latitude, longitude, location_time) VALUES ({$drone_id}, {$altitude}, {$latitude}, {$longitude}), '{$location_time}'";
   	mysqli_query($conn, $query);
?>