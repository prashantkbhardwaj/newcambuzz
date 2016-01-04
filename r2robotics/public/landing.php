<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$current_user = $_SESSION["username"];
	$name_query = "SELECT * FROM hubs WHERE username = '{$current_user}' LIMIT 1";
	$name_result = mysqli_query($conn, $name_query);
	confirm_query($name_result);
	$name_title = mysqli_fetch_assoc($name_result);
?>
<?php
	$count_query = "SELECT DISTINCT(drone_id) FROM drones WHERE hub_id = '{$current_user}' ORDER BY id DESC";
	$count_result = mysqli_query($conn, $count_query);
?>
<?php include("../includes/layouts/header.php");?>

<div id="main">
	<div id="navigation">
		<ul>
			<li><a href="logout.php">Logout</a></li><br/><br/>			
		</ul>
	</div>	
	<div id="page">
		<style>
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th, td {
			    padding: 5px;
			}
			th {
			    text-align: left;
			}
		</style>
		<h2 style="text-align: left;"><b>Welcome, <?php echo htmlentities($name_title["username"]); ?></b></h2><br><br>
		<p>
			<center>
				<h3>Active Drones</h3><br>
				<table style="width:100%;">
					<tr>
						<th>Drone ID</th>						
						<th>Delete Drone</th>
						<th>Track Drone</th>
					</tr>
					<?php
					while ($count_drone = mysqli_fetch_assoc($count_result)) {
						echo "<tr>";
							echo "<td>".$count_drone['drone_id']."</td>";	
							$did = $count_drone['drone_id']; ?>								 
							<td><a href="delete_drone.php?drone_id=<?php echo urlencode($did); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>					
							<td><a href="map.php?drone_id=<?php echo urlencode($did); ?>"><?php echo "Track"; ?></a></td> <?php													
						echo "</tr>";
					}
					?>
				</table>
			</center>
		</p>
		<p>
			<center>
				<br><br><a href="multiple_view.php">Track all drones</a>
			</center>
		</p>
	</div>
</div>
<?php include("../includes/layouts/footer.php");?>