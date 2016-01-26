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
  if (isset($_POST['submit'])) {
    $regno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['regno']));
    $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $phno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phno']));
    
        $query = "INSERT INTO students (regno, name, email, phno)";
        $query .= " VALUES ('{$regno}', '{$name}', '{$email}', '{$phno}')";
        mysqli_query($conn, $query);
        
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Code Y Gen</title>
    <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <div class='login'>
        <div class='login_title'>
            <span>Workshop for Web Development in PHP and MySql</span>
        </div>
        <form method="post">
            <div class='login_fields'>
            <div class='login_fields__user'>
                
                <input placeholder='Registration Number' name="regno" required type='text'>
                <div class='validation'>
                    <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
                </div>
                </input>
            </div>
            <div class='login_fields__name'>
                
                <input placeholder='Name' name="name" required type='text'>
                <div class='validation'>
                    <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
                </div>
                </input>
            </div>
            <div class='login_fields__email'>
                
                <input placeholder='Email' name="email" required type='email'>
                <div class='validation'>
                    <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
                </div>
                </input>
            </div>
            
            <div class='login_fields__password'>
                
                <input placeholder='Phone Number' name="phno" required type='text'>
                <div class='validation'>
                    <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
                </div>
            </div>
            <div class='login_fields__submit'>
                <input type='submit' name="submit" value='Submit'>
                
            </div>
            
        </div>
        </form>
        <div class='success'>
            <h2>Succefully Registered</h2>
            <p>Thank You.</p>
        </div>
        <div class='disclaimer'>
            <p>Developed by Prashant Bhardwaj</p>
        </div>
    </div>
    <div class='authent'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/puff.svg'>
        <p>Submitting...</p>
    </div>
    
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src="js/index.js"></script>
</body>

</html>