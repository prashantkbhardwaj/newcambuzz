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
			<li><a href="landing.php">Home</a></li><br/><br/>
			<li><a href="logout.php">Logout</a></li><br/><br/>
		</ul>
	</div>
	<div id="page">
		<h2>Downloads</h2>
		<div style="text-align: left;"><b><u>Welcome, <?php echo htmlentities($name_title["name"]); ?></u></b></div>
		<p>Click on the files to download</p>
		<p>
			<?php
			$query = "SELECT * FROM users WHERE count = 1";
			$result = mysqli_query($conn, $query);
			confirm_query($result);
			while ($title = mysqli_fetch_assoc($result)) {
				echo "<b>".$title['name']."</b><br>";
				$view_name = $title['username'];
				$query_file = "SELECT * FROM uploads WHERE file_owner = '{$view_name}'";
				$result_file = mysqli_query($conn, $query_file);
				confirm_query($result_file);
				while ($down = mysqli_fetch_assoc($result_file)) {
					$down_link = $down['file_name'];
					echo "<a href='uploads/"."$down_link"."'>"."click to download"."</a>"."<br>";
				}
			}
			//echo "<a href='uploads/riya12015-11-01%2021-06-46..png'>"."click to download"."</a>";								
			?>
		</p>
	</div>
</div>
<?php include("../includes/layouts/footer.php");?>