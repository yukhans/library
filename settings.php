<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
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
            <td><a class="nav" href="dashboard.php">My Profile</a></td>
            <td><a class="nav" href="browse.php">Browse Books</a></td>
            <td><a class="nav" href="manage.php">Manage Books</a></td>
            <td><a class="nav" href="reserve.php">Library</a></td>
            <td class="selected">Settings</td>
        </tr>
    </table>

    <div class="head">
        <h2></br> Settings </h2>
    </div>
    
    <div class="form">
        <p class="default">Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p class="default">You are now on settings section</p>
        <p class="link"><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>

<?php
require('db.php');
?>
