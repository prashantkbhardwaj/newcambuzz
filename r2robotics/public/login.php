<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
	redirect_to ("landing.php");
}
?>
<?php
$username = "";
if (isset($_POST['submit'])) {

	$required_fields = array("username", "password");
	validate_presence($required_fields);
	
	if (empty($errors)) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$found_user = attempt_login($username, $password);

		if ($found_user) {

			$_SESSION["user_id"] = $found_user["id"];
			$_SESSION["username"] = $found_user["username"];
			redirect_to("landing.php");
		} else {
			$_SESSION["message"] = "Hub ID/password not found.";
		}
	}
} else {

}
?>
<?php include("../includes/layouts/header.php");?>
<div id="main">
<div id="navigation">
	&nbsp;
</div>
<div id="page">
<?php echo message(); ?>
<?php echo form_errors($errors); ?>

<h2>Login</h2>
<p>Enter the Hub ID and password</p>
<p><form action="login.php" method="post">
<table>
	<tr>
		<td>Hub ID </td>
		<td><input type="text" name="username" value="" required/></td>
	</tr>
	<tr>
		<td>Password </td>
		<td><input type="password" name="password" value="" required></td>
	</tr>
	<tr>
		<td><input name="submit" type="submit" value="Log in"></td>
	</tr>
</table>
</form>
</p>
</div>
</div>
<?php include("../includes/layouts/footer.php");?>