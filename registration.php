<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $fname = stripslashes($_REQUEST['fname']);
        $fname = mysqli_real_escape_string($con, $fname);

        $lname = stripslashes($_REQUEST['lname']);
        $lname = mysqli_real_escape_string($con, $lname);

        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);

        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $create_datetime = date("Y-m-d H:i:s");

        // check if name is taken already
        $sql_u = "SELECT * FROM member WHERE username='$username'";
        $sql_e = "SELECT * FROM member WHERE email='$email'";
        $res_u = mysqli_query($con, $sql_u);
        $res_e = mysqli_query($con, $sql_e);

        if (mysqli_num_rows($res_u) > 0) {                      // username taken
            echo "<div class='form'>
                  <h3>Username taken. Please choose another username.</h3>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
        }
        else if(mysqli_num_rows($res_e) > 0){                   // email taken
            echo "<div class='form'>
                  <h3>An account is already linked to your email.</h3>
                  <p class='link'>Click here to <a href='index.php'>login.</a></p>
                  </div>";
        }
        else{
            $query    = "INSERT into `member` (fname, lname, username, password, email, create_datetime)
                        VALUES ('$fname', '$lname', '$username', '" . md5($password) . "', '$email', '$create_datetime')";
            $result   = mysqli_query($con, $query) or die(mysqli_error($con));
            
            if($result) {
                echo "<div class='form'>
                    <h3>Account created.</h3>
                    <p class='link'>Click here to <a href='index.php'>Login</a>.</p>
                    </div>";
            }

            else{
                echo "<div class='form'>
                    <h3>Required fields are missing.</h3>
                    <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                    </div>";
            }
        }
    }

    else {
?>
  <img src="logo2.jpg" width="100%">

  <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="fname" placeholder="First Name" required />
        <input type="text" class="login-input" name="lname" placeholder="Last Name" required />
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Address" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="default">Already have an account? <font class="link"><a href="login.php">Login here</a></font></p>
    </form>
<?php
    }
?>
</body>
</html>
