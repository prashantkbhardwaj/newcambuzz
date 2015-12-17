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
	if (isset($_POST['submit'])) {
		$question = $_POST['question'];
		date_default_timezone_set('Asia/Calcutta');
    	$question_time = date("Y-m-d\TH:i:s");

    	$query = "INSERT INTO questions (question, quest_user, question_time) VALUES ('{$question}', '{$current_user}', '{$question_time}')";
    	$sql = mysqli_query($conn, $query);
	}
?>
<?php include("../includes/layouts/header.php");?>
<div id="main">
	<div id="navigation">
		<ul>			
			<li><a href="logout.php">Logout</a></li><br/><br/>
		</ul>
	</div>
	<div id="page">
		<h1>Q and A</h1>
		<p>
			<form action="qna.php" method="post">
				<table>
					<tr>
						<td><textarea name="question" placeholder = "Ask your question" required></textarea></td>
						<td><input type="submit" name="submit" value="Post"></td>
					</tr>
				</table>
			</form>
		</p>
		<p>
			<?php
				$feed_query = "SELECT * FROM questions ORDER BY id DESC";
				$feed_result = mysqli_query($conn, $feed_query);
				confirm_query($feed_result);
				while ($feed_view = mysqli_fetch_assoc($feed_result)) {
					$feed_user = $feed_view['quest_user'];
					$user_query = "SELECT * FROM users WHERE username = '{$feed_user}'";
					$user_result = mysqli_query($conn, $user_query);
					confirm_query($user_query);
					$user_name = mysqli_fetch_assoc($user_result);									 
					if ($user_name['propic']==0) {
						echo "<img src='images/nopic.png' style='border-radius: 50%;' height='10%' width='10%'>";
					}
					echo $user_name['name']."<br>";
					echo $feed_view['question_time']."<br>";
					echo $feed_view['question'];
					echo "<br>";										
                    echo "<br><hr>";
                    echo "Like";
                   	echo "<button>Comment</button>";                        
                    echo "<hr><br>";
                    $quest_id = $feed_view['id'];
                    $display_query = "SELECT * FROM comments WHERE qid = {$quest_id}";
					$display_result = mysqli_query($conn, $display_query);
					confirm_query($display_query);
					while ($display_comment = mysqli_fetch_assoc($display_result)) {
						$comment_user = $display_comment['comment_user'];
						$comment_user_query = "SELECT * FROM users WHERE username = '{$comment_user}'";
						$comment_user_result = mysqli_query($conn, $comment_user_query);
						confirm_query($comment_user_query);
						$comment_user_name = mysqli_fetch_assoc($comment_user_result);									 
						if ($comment_user_name['propic']==0) {
							echo "<img src='images/nopic.png' style='border-radius: 50%;' height='5%' width='5%'>";
						}
						echo $comment_user_name['name']."<br>";
						echo $display_comment['comment_time']."<br>";
						echo $display_comment['comment'];
						echo "<br><br>";
					}
                    echo "<br>";
                    echo "<form action='qna.php' method='post'>";
                    	echo "<input type='text' name='c".$feed_view['id']."' ><br><hr><br>";
                    echo "</form>";                                        
                    if (isset($_POST['c'.$quest_id])) {
                    	$comment = $_POST['c'.$quest_id];  
	                    $qid = $feed_view['id'];
	                    date_default_timezone_set('Asia/Calcutta');
	    				$comment_time = date("Y-m-d\TH:i:s");
	                    $comment_query = "INSERT INTO comments (comment, comment_user, comment_time, qid) VALUES ('{$comment}', '{$current_user}', '{$comment_time}', {$qid})";
	    				mysqli_query($conn, $comment_query); 
	    				redirect_to('qna.php');  
	    			}
				}				
			?>
		</p>
	</div>
</div>
<?php include("../includes/layouts/footer.php");?>