<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$current_user = $_SESSION["username"];
	$name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
	$name_result = mysqli_query($conn, $name_query);
	confirm_query($name_result);
	$name_title = mysqli_fetch_assoc($name_result);
?>
<?php include("../includes/layouts/header.php");?>
<div id="main">
	<div id="navigation">
		<ul>
			<li><a href="upload.php">Upload</a></li><br/><br/>
			<li><a href="download.php">Download</a></li><br/><br/>
			<li><a href="logout.php">Logout</a></li><br/><br/>
		</ul>
	</div>
	<div id="page">
		<h2>Tasks</h2>
		<div style="text-align: left;"><b><u>Welcome, <?php echo htmlentities($name_title["name"]); ?></u></b></div>
		<p>Do you want to upload or download?</p>
		<p>
			<table>
				<tr>
					<td><a href="upload.php"><h3>Upload</h3></a></td>
					<td><a href="download.php"><h3>Download</h3></a></td>
				</tr>
			</table>
		</p>
	</div>
</div>
<?php include("../includes/layouts/footer.php");?>