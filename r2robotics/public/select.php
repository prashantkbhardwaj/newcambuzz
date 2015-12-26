<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
	$query = "SELECT * FROM drones ORDER BY id DESC";	
	$result = mysqli_query($conn, $query);
	confirm_query($query);
	$location = mysqli_fetch_assoc($result);
	echo $location['latitude'].",".$location['longitude'];	
?>