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
<?php
	date_default_timezone_set('Asia/Calcutta');
    $id_time = date("Y-m-d H-i-s");
    $picture_id = $current_user.$id_time;
?>
<?php
	if (isset($_POST['submit'])) {
		if (isset($_POST['status'])) {
			$status = $_POST['status'];
		} else {
			$status = " ";
		}
		if (!empty($_FILES['picture']['name'])) {
			$picset=1;      
	        $target_dir = "images/";
	        $target_file = $target_dir . basename($_FILES["picture"]["name"]);                
	        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	        move_uploaded_file($_FILES["picture"]["tmp_name"],"images/$picture_id.jpg"); 
		} else {
			$picset = 0;
		}
		date_default_timezone_set('Asia/Calcutta');
    	$post_time = date("Y-m-d\TH:i:s");

		$query = "INSERT INTO feeds (status, picset, post_user, post_time) VALUES ('{$status}', {$picset}, '{$current_user}', '{$post_time}')";
    	$sql = mysqli_query($conn, $query);
	}
?>
<?php include("../includes/layouts/header.php");?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div id="main">
	<div id="navigation">
		<ul>			
			<li><a href="logout.php">Logout</a></li><br/><br/>
		</ul>
	</div>
	<div id="page">
		<h2>News Feed</h2>
		<div style="text-align: left;"><b><u>Welcome, <?php echo htmlentities($name_title["name"]); ?></u></b></div>	
		<p>
			<div <?php //echo $show; ?> >
				<button id="buzz">Buzz</button>
			</div>
			<div id="divbuzz" style="display: none;">			
				<p>
					<form>
						<table>
							<tr>
								<td><input type="text" name="title" required></td>
							</tr>
							<tr>
								<td><textarea name="content" required></textarea></td>
							</tr>
							<tr>
								<td><input type="file" name="poster"></td>
							</tr>
							<tr>
								<td><input type="datetime-local" name="endtime" required></td>
							</tr>
							<tr>
								<td><input type="submit" name="submit" value="Submit"></td>
							</tr>
						</table>
					</form>
				</p>
			</div>
		</p>	
		<p>
			<form action="news.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>					
						<td><textarea name="status" placeholder="What's on your mind?"></textarea></td>
					</tr>
					<tr>
						<td><input type="file" name="picture"></td>
						<td><input type="submit" name="submit" value="Update!"></td>
					</tr>
				</table>
			</form>
		</p>
		<hr>
		<p>
			<?php
				$feed_query = "SELECT * FROM feeds ORDER BY id DESC";
				$feed_result = mysqli_query($conn, $feed_query);
				confirm_query($feed_result);
				while ($feed_view = mysqli_fetch_assoc($feed_result)) {
					$feed_user = $feed_view['post_user'];
					$user_query = "SELECT * FROM users WHERE username = '{$feed_user}'";
					$user_result = mysqli_query($conn, $user_query);
					confirm_query($user_query);
					$user_name = mysqli_fetch_assoc($user_result);
					if ($user_name['propic']==0) {
						echo "<img src='images/nopic.png' style='border-radius: 50%;' height='10%' width='10%'>";
					}
					echo $user_name['name']."<br>";
					echo $feed_view['post_time']."<br>";					
					if ($feed_view['status']!=" ") {
						echo $feed_view['status'];
						echo "<br><br>";
					}
					if ($feed_view['picset']==1) {
						$picture_time = strtotime($feed_view['post_time']);                                                    
                        $pictureid=$feed_view['post_user'].date("Y-m-d H-i-s", $picture_time);                                                                                                      
                        echo '<img src="images/' . $pictureid . '.jpg" >';
                        echo "<br><hr>";
                        echo "Like  Comment";
                        echo "<hr><br>";
					} else {
						echo "<hr>";
						echo "Like  Comment";
						echo "<hr><br>";
					}
				}				
			?>
		</p>
	</div>
</div>
<script type="text/javascript">
	$('#buzz').click(function() {
		$('#divbuzz').slideDown();		
	});	
</script>
<?php include("../includes/layouts/footer.php");?>