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
	date_default_timezone_set('Asia/Calcutta');
    $id_time = date("Y-m-d H-i-s");    
    $file_id = $current_user.$id_time;
    $status = " ";
?>
<?php
if (isset($_POST['submit'])) {
	$file_owner = $current_user;
	$ext = $_POST['type'];
	$file_name = $file_id.$ext;	
	$target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);                
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], "uploads/$file_name"); 
	$query = "INSERT INTO uploads (file_owner, file_name) VALUES ('{$file_owner}', '{$file_name}')"; 
	$sql = mysqli_query($conn, $query);	
	$query_count = "UPDATE users SET count = '1' WHERE username = '{$current_user}'"; 
	$sql_count = mysqli_query($conn, $query_count);
	$status = "Uploaded.";
}
?>
<?php include("../includes/layouts/header.php");?>
<div id="main">
	<div id="navigation">
		<ul>
			<li><a href="landing.php">Home</a></li><br/><br/>
			<li><a href="download.php">Download</a></li><br/><br/>
			<li><a href="logout.php">Logout</a></li><br/><br/>
		</ul>
	</div>
	<div id="page">
		<h2>Upload</h2>
		<div style="text-align: left;"><b><u>Welcome, <?php echo htmlentities($name_title["name"]); ?></u></b></div>
		<p>Select the file to upload</p>
		<p>
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td><input type="file" name="uploaded_file" value="" required/></td>
						<td>
							<select name="type" required>
								<option value=" ">Select the file type</option>
								<option value=".jpg">.jpg</option>
								<option value=".JPG">.JPG</option>
								<option value=".jpeg">.jpeg</option>
								<option value=".JPEG">.JPEG</option>
								<option value=".bmp">.bmp</option>
								<option value=".BMP">.BMP</option>
								<option value=".png">.png</option>
								<option value=".PNG">.PNG</option>
								<option value=".ppt">.ppt</option>
								<option value=".pptx">.pptx</option>
								<option value=".doc">.doc</option>
								<option value=".docx">.docx</option>
								<option value=".pdf">.pdf</option>
								<option value=".mp3">.mp3</option>
								<option value=".mp4">.mp4</option>
							</select>
						</td>					
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Upload"></td>
						<td><?php echo $status; ?></td>
					</tr>
				</table>
			</form>
		</p>
		<p>
			<table>
				<tr>
					<th><b><u>Your uploaded files</u></b></th>
				</tr>
				<tr>
					<td>
						<?php
							$query = "SELECT * FROM uploads WHERE file_owner = '{$current_user}' ORDER BY id DESC";
							$result = mysqli_query($conn, $query);
							confirm_query($result);
							while ($list = mysqli_fetch_assoc($result)) {
								echo $list['file_name']."&nbsp;". "<select name='author'><option value='public'>Public</option><option value='private'>Private</option></select>"."<br>";
							}							
						?>
					</td>
				</tr>
			</table>
		</p>
	</div>
</div>
<?php include("../includes/layouts/footer.php");?>