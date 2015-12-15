<?php
	if (isset($_POST['submit'])) {
		$campus = $_POST['campus'];
		if ($campus=="blank") {
			$view = "<b>Select your campus!</b>"
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cambuzz</title>
</head>
<body>
	<center>
		<h1>Cambuzz</h1>
		check
		<p>A new way of exploring your campus</p>
		<p>
			<form action="index.php" method="post">
				<select name="campus" required>
					<option value="blank">Select Your Campus</option>
					<option value="vitcc">Vellore Institute of Technology, Chennai Campus</option>
					<option value="creane">Creane Memorial School, Gaya</option>
				</select>
				<input type="submit" name="submit" value="Go!">
			</form>
		</p>
	</center>
</body>
</html>