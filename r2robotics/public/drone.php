<?php require_once("../includes/db_connection.php");?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="map.php" method="get">
		<table>			
			<tr>
				<td>Altitude</td>
				<td><input type="text" name="altitude" required></td>
			</tr>
			<tr>
				<td>Latitude</td>
				<td><input type="text" name="latitude" required></td>
			</tr>
			<tr>
				<td>Longitude</td>
				<td><input type="text" name="longitude" required></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>

