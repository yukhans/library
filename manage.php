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
            <td><a class="nav" href="dashboard.php">My Profile</a></td>
            <td><a class="nav" href="browse.php">Browse Books</a></td>
            <td class="selected">Manage Books</td>
            <td><a class="nav" href="reserve.php">Library</a></td>
            <td><a class="nav" href="settings.php">Settings</a></td>
        </tr>
    </table>

    <div class="head">
        <h2></br> My Books </h2>
    </div>
    
    <div class="form">
    <?php
        $un = $_SESSION['username'];
        $query = "SELECT `book1` , `book2` , `book3` FROM `member` WHERE username = '$un'";
        $result = mysqli_query($con, $query) or die(mysql_error($con));
        $queryResults = mysqli_num_rows($result);

        if ($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){ 
                $book1 = $row['book1'];
                $book2 = $row['book2'];
                $book3 = $row['book3'];

                if($row['book1']==NULL && $row['book2']==NULL && $row['book3']==NULL) {
                    echo '<p class="default">';
                    echo 'You have not reserved any book yet! Go to the Reserve Books section to reserve books.';
                    echo "</div>";
                }
                else    {
                    $query = "SELECT * FROM `books` WHERE title = '$book1' OR title = '$book2' OR title = '$book3'";
                    $result = mysqli_query($con, $query);
                    $queryResults = mysqli_num_rows($result);

                    if ($result){
                        while($row = mysqli_fetch_assoc($result)){ 
                            echo '<div class="container2">';
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imageData']).'"/ width="100%">';  
                            
                            echo '<h3>'.$row['title'].'</h3>
                                <font class="default">
                                <p>'.$row['text'].'</p>
                                <p> Author: <i>'.$row['author'].'</i></p>
                                <p> Genre: <i>'.$row['genre'].', </i>
                                Pages: <i>'.$row['pages'].', </i>
                                Available Formats: <i>'.$row['format'].', </i>
                                Published: <i>'.$row['date'].'</i></p>';
                            echo '</font></div>';
                        }
                    }
                }
            }
        }
        ?>
    </div>

</body>
</html>

<?php
require('db.php');
?>
