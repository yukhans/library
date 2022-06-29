<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
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
            <td><a class="nav" href="settings.php">Settings</a></td>
        </tr>
    </table>

    <table class="table2">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <form action="search.php" class="searchbar" method="post">
                    <input type="text" name="searchbar" class="searchbar" placeholder="Search title, author, genre, etc.">
                    <input type="submit" name="searchsubmit"  value="Search">
                </form>
            </td>
        </tr>
    </table> 

    <div class="head">
        <h2> My Profile </h2>
    </div>
    
    <div class="form">
        <p class="default">Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p class="default">Successfully reserved!</p>
        <p class="link"><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>

<?php
require('db.php');
?>
