<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php")
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <img src="logo2.jpg" width="100%">
    
    <table class="table1">   
        <tr>
            <td class="selected">My Profile</td>
            <td><a class="nav" href="browse.php">Browse Books</a></td>
            <td><a class="nav" href="manage.php">Manage Books</a></td>
            <td><a class="nav" href="reserve.php">Library</a></td>
            <td><a class="nav" href="settings.php">Settings</a></td>
        </tr>
    </table>

    <div class="head">
        <h2></br> My Profile </h2>
    </div>
    
    <div class="form">
    <?php
        $username = $_SESSION['username'];
        $username = mysqli_real_escape_string($con, $username);    
        $query = "SELECT `username`, `fname`, `lname`, `email`, `create_datetime`
                FROM `member` WHERE username='$username'";
        $result = mysqli_query($con, $query);
        $queryResults = mysqli_num_rows($result);

        if ($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){ 
                echo '<div>';
                echo '<div class="container2">';
                
                echo '<font class="default">
                    <p> First Name: '.$row['fname'].'</p>
                    <p> Last Name: '.$row['lname'].'</p>
                    <p> Username: '.$row['username'].'</p>
                    <p> Email: '.$row['email'].'</p>
                    <p> Account created: '.$row['create_datetime'].'</p>
                    <p class="link"><a href="logout.php">Logout</a></p>
                    </font>
                    </div>
                </div>';
            }
        }
    ?>

  
</div>
</body>
</html>

<?php
require('db.php');
?>
