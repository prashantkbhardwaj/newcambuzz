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
<!-- This one is for NewsFeed -->
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
<!-- This one is for the Buzz-->
<?php 
	if(isset($_POST['buzz'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];
		$end_time = $_POST['time'];
	
		if (!empty($_FILES['poster']['name'])) {
			$poset=1;      
		    $target_dir1 = "images/";
		    $target_file1 = $target_dir1 . basename($_FILES["poster"]["name"]);                
		    $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
		    move_uploaded_file($_FILES["poster"]["tmp_name"],"images/$picture_id.jpg"); 
		} else {
			$poset = 0;
		}
	
		date_default_timezone_set('Asia/Calcutta');
		$post_time = date("Y-m-d\TH:i:s");

		$query = "INSERT INTO buzzes (title, content, end_time, poset, post_user, post_time) VALUES ('{$title}', '{$content}', '{$end_time}', {$poset}, '{$current_user}', '{$post_time}')";
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
			<div>
				<button id="buzz">Buzz</button>
			</div>
			<div id="divbuzz" style="display: none;">			
				<fieldset>
				<legend>BUZZ</legend>
				<form action="landing.php" method="post" enctype="multipart/form-data">
				Title:<br /><input type="text" name="title" required><br />
					<table>
					<tr>					
						<td><textarea name="content" placeholder="Tell me something about your buzz?" required></textarea></td>
					</tr>
					<tr>
						<td><input type="file" name="poster"></td>
						<td>Ending Time:<br /><input type="datetime-local" name="time" required></td>
						<td><input type="submit" name="buzz" value="New Buzz!"></td>
					</tr>
				</table>
				</form>
				</fieldset>
			</div>
		</p>
		<p>
			<form action="landing.php" method="post" enctype="multipart/form-data">
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
		<!-- this is for the news feed. -->
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
						echo "<br>";
					}
					if ($feed_view['picset']==1) {
						$picture_time = strtotime($feed_view['post_time']);                                                    
                        $pictureid=$feed_view['post_user'].date("Y-m-d H-i-s", $picture_time);                                                                                                      
                        echo '<img src="images/' . $pictureid . '.jpg" >';
                        echo "<br>";
					}
				}				
			?>
		</p>
		<!--this is for the buzz.--> 
		<p>
			<?php  
				$buzz_query = "SELECT * FROM buzzes ORDER BY id DESC";
				$buzz_result = mysqli_query($conn, $buzz_query);
				confirm_query($buzz_result);
				while ($buzz_view = mysqli_fetch_assoc($buzz_result)) {
					$buzz_user = $buzz_view['post_user'];
					$user_query = "SELECT * FROM users WHERE username = '{$buzz_user}'";
					$user_result = mysqli_query($conn, $user_query);
					confirm_query($user_query);
					$user_name = mysqli_fetch_assoc($user_result);
					if ($user_name['propic']==0) {
						echo "<img src='images/nopic.png' style='border-radius: 50%;' height='10%' width='10%'>";
					}
					echo $user_name['name']."<br>";
					echo $buzz_view['post_time']."<br>";					
					echo $buzz_view['title']."<br />";
					echo $buzz_view['content'];
					echo "<br>";
					
					if ($buzz_view['poset']==1) {
						$picture_time = strtotime($buzz_view['post_time']);                                                    
                        $pictureid = $buzz_view['post_user'].date("Y-m-d H-i-s", $picture_time);                                                                                                      
                        echo '<img src="images/' . $pictureid . '.jpg" >';
                        echo "<br>";
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