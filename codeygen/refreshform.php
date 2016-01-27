<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "KinG82++");
define("DB_NAME", "codeygen");

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>
<?php  
    $regno2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['regno1']));
    $name2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name1']));
    $email2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email1']));
    $phno2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phno1']));
    
    $query = "INSERT INTO students (regno, name, email, phno)";
    $query .= " VALUES ('{$regno2}', '{$name2}', '{$email2}', '{$phno2}')";
    mysqli_query($conn, $query);
        
  
?>
<?php
    mysqli_close($conn);
?>
