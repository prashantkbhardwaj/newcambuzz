<?php require_once("../includes/db_connection.php");?>
<?php
	if (isset($_GET['drone_id'])) { $drone_id = mysqli_real_escape_string($conn, htmlspecialchars($_GET['drone_id']));	} else { $drone_id = ""; }
	if (isset($_GET['altitude'])) { $altitude = mysqli_real_escape_string($conn, htmlspecialchars($_GET['altitude']));	} else { $altitude = ""; }
	if (isset($_GET['latitude'])) { $latitude = mysqli_real_escape_string($conn, htmlspecialchars($_GET['latitude']));	} else { $latitude = ""; }
	if (isset($_GET['longitude'])) { $longitude = mysqli_real_escape_string($conn, htmlspecialchars($_GET['longitude'])); } else { $longitude = ""; }	
	if (isset($_GET['hub_id'])) { $hub_id = mysqli_real_escape_string($conn, htmlspecialchars($_GET['hub_id'])); } else { $hub_id = ""; }	
	
	date_default_timezone_set('Asia/Calcutta');
    $location_time = date("Y-m-d\TH:i:s");

   	$query = "INSERT INTO drones (drone_id, altitude, latitude, longitude, location_time, hub_id) VALUES ('{$drone_id}', '{$altitude}', '{$latitude}', '{$longitude}', '{$location_time}', '{$hub_id}')";
   	mysqli_query($conn, $query);
?>