<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<form action="test.php" method="post">
	<input type="text" name="test" />
</form>
<?php
if (isset($_POST['test'])) {
	$test = $_POST['test'];
	echo $test;
}
?>
