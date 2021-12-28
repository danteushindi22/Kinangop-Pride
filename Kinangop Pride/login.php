<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
     <title>Kinangop Pride Academy</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico">

    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db_connect.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    
        // removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE   username ='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect user to index page
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <br>
    <center>
    <img src="./logo.jpg" alt="logo" height="130" width="130">
    </center>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="email" class="login-input" name="email" placeholder="Email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="forgot_password.html">Forgot Your Password?</a></p>
        <p class="link"><a href="register.php">New Registration</a></p>
        
  </form>
<?php
    }
?>
</body>
</html>