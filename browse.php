<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include('db.php');
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
            <td class="selected">Browse Books</td>
            <td><a class="nav" href="manage.php">Manage Books</a></td>
            <td><a class="nav" href="reserve.php">Library</a></td>
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
    <h2> All Books </h2>
</div>

<div class="form">
    <?php
    include('db.php');
        $query = "SELECT * FROM books";
        $result = mysqli_query($con, $query);
        $queryResults = mysqli_num_rows($result);

        if ($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){ 
                echo '<div>';
                echo '<div class="container2">';
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imageData']).'"/ width="100%">';  
                
                echo '<h3>'.$row['title'].'</h3>
                    <font class="default">
                    <p>'.$row['text'].'</p>
                    <p> Author: <i>'.$row['author'].'</i></p>
                    <p> Genre: <i>'.$row['genre'].', </i>
                    Pages: <i>'.$row['pages'].', </i>
                    Available Formats: <i>'.$row['format'].', </i>
                    Published: <i>'.$row['date'].'</i></p>
                    <p> For reservation: <i>';
                    if($row['availability'])    echo 'Yes</i></p>';
                    else                        echo 'No</i></p>';
                echo '</font>
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