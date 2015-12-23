<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
	redirect_to ("news.php");
}
?>
<?php
if(isset($_POST['submit'])){
	
	$required_fields = array("username", "password");
	validate_presence($required_fields);
	
	$fields_with_max_lengths = array("username" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if (empty($errors)) {

		$name = $_POST['name'];
		$username = mysql_prep($_POST["username"]);
		$email = $_POST['email'];
		$hashed_password = password_encrypt($_POST["password"]);
		$category = $_POST['category'];				

		$query = "INSERT INTO users (name, username, email, hashed_password, category)";
		$query .= " VALUES ('{$name}', '{$username}', '{$email}', '{$hashed_password}', '{$category}')";
		$result = mysqli_query($conn, $query);

        if ($result) {
          	$_SESSION["message"] = "Your profile created!";
	       	redirect_to("login.php");
	    } else {
		   	$_SESSION["message"] = "Profile creation failed.";
	    }        	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><title>Cambuzz Creane</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript"><!--
$(function() {
    $("#txtConfirmPassword").keyup(function() {
        var password = $("#txtNewPassword").val();
        $("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
    });

});
//--></script>
<link href="css/public.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="header">
<h1>Cambuzz Creane</h1>
</div>
<div id="main">
<div id="navigation">
	&nbsp;
</div>
<div id="page">
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<h2>Sign Up</h2>
	<p>Please enter your details.</p>
	<p>
	   	<form action="signup.php" method="post">
	   		<table>
	   			<tr>
	   				<td>Name</td>
	   				<td><input type="text" name="name" value="" required /></td>
	   			</tr>
	   			<tr>
	   				<td>Email</td>
	   				<td><input type="email" name="email" value="" required /></td>
	   			</tr>
	   			<tr>
	   				<td>Username</td>
	   				<td><input type="text" name="username" value="" required /></td>
	   			</tr>
	   			<tr>
	   				<td>Password</td>
	   				<td><input type="password" name="password" id="txtNewPassword" value="" required /></td>
	   			</tr>
	   			<tr>
	   				<td>Repeat Password</td>
	   				<td><input type="password" id="txtConfirmPassword" required /></td>
	   				<td><div class="registrationFormAlert" id="divCheckPasswordMatch" style="margin-left: 160px;"></div></td>
	   			</tr>
	   			<tr>
	   				<td>Category</td>
	   				<td><input type="radio" name="category" value="student" checked> Student</td>	   				
	   				<td><input type="radio" name="category" value="parent"> Parent</td>	   				
	   				<td><input type="radio" name="category" value="teacher"> Teacher</td>
	   			</tr>	   			
	   			<tr>
	   				<td><input name="submit" type="submit" value="Submit"></td>
	   			</tr>
	   		</table>			
		</form>
	</p>
</p>
<p>Already have an account? <a href="login.php">Sign In</a></p>
</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>