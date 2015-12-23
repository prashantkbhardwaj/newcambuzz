<?php require_once("../includes/db_connection.php");?>
<?php
	$drone_id = $_GET['drone_id'];
	$altitude = $_GET['altitude'];
	$latitude = $_GET['latitude'];
	$longitude = $_GET['longitude'];
	date_default_timezone_set('Asia/Calcutta');
    $location_time = date("Y-m-d\TH:i:s");

   	$query = "INSERT INTO drones (drone_id, altitude, latitude, longitude, location_time) VALUES ({$drone_id}, {$altitude}, {$latitude}, {$longitude}), '{$location_time}'";
   	mysqli_query($conn, $query);
?>