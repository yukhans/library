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
            <td class="selected">Library</a></td>
            <td><a class="nav" href="settings.php">Settings</a></td>
        </tr>
    </table>

    

    

    <div class="head">
        <h2></br> Return Books </h2>
    </div>

    <table class="form2">
        <tr>
            <td width="15%">
                <img src="right.png" width="15px">   <a class="nav2" href="reserve.php">Reserve   </a></br></br>
                <img src="right.png" width="15px">   <a class="selected3" href="return.php">Return   </a>
            </td>
            <td>
                <div class="div2">
                <p class="comment"> * please input full title and full author name - open Browse Books for details </p>
                <form action="" class="login" method="post">
                    <input type="text" name="title" class="login-input" placeholder="Title">
                    <input type="text" name="author" class="login-input" placeholder="Author">

                    <p class="text">How was the book? Give a feedback!</p>
                <form action="" class="login" method="post">
                    <input type="text" name="feedback" class="login-input" placeholder="feedback">

                    <input type="submit" name="retsubmit" class="reserve-button" value="Return">
                </form>
                </div>
            </td>
        </tr>
    </table>

    <?php
        require('db.php');
        if(isset($_POST['title']))    {
            $title = stripslashes($_REQUEST['title']);    // removes backslashes
            $title = mysqli_real_escape_string($con, $title);

            $author = stripslashes($_REQUEST['author']);    // removes backslashes
            $author = mysqli_real_escape_string($con, $author);

            $query = "SELECT `title` , `author` , `imageData` , `availability` 
                FROM `books` WHERE title='$title'";
            $result = mysqli_query($con, $query);
            $queryResults = mysqli_num_rows($result);

            if ($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){ 
                    echo '<div class="form">';
                    echo '<div class="container2">';
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imageData']).'"/ width="100%">';  
                    echo '<font class="default">
                        <p> Title: '.$row['title'].'</p>
                        <p> Author: '.$row['author'].'</p>
                        </font>';
                    $un = $_SESSION['username'];

                    if($row['availability']==0) {
                        $query = "SELECT `book1` , `book2` , `book3` FROM `member` WHERE username = '" . mysqli_escape_string($con,$un) . "'";
                        $result = mysqli_query($con, $query);
                        $queryResults = mysqli_num_rows($result);
                        

                        if($queryResults > 0)   {
                            while($row = mysqli_fetch_assoc($result))   {
                                if($row['book1']==$title) {
                                    $query    = "UPDATE `member` SET `book1`='' WHERE username = '$un'";
                                    $result   = mysqli_query($con, $query) or die(mysqli_error($con));

                                    if ($result) {
                                        $sql = "UPDATE `books` SET `availability`='1' WHERE title='$title' AND author='$author'";
                                        if(mysqli_query($con, $sql))    {
                                                echo '<p class="default">';
                                                echo 'Returned successfully!</p>';
                                                echo "</div></div>";        
                                        }
                                        else {
                                            echo "RESERVATION ERROR: $sql. " . mysqli_error($link);
                                        }
                                    }
                                }
                                else if($row['book2']==$title) {
                                    $query    = "UPDATE `member` SET `book2`='' WHERE username = '$un'";
                                    $result   = mysqli_query($con, $query) or die(mysqli_error($con));

                                    if ($result) {
                                        $sql = "UPDATE `books` SET `availability`='1' WHERE title='$title' AND author='$author'";
                                        if(mysqli_query($con, $sql))    {
                                            echo '<p class="default">';
                                            echo 'Returned successfully!</p>';
                                            echo "</div></div>";            
                                        }
                                        else {
                                            echo "RESERVATION ERROR: $sql. " . mysqli_error($link);
                                        }
                                    }
                                }
                                else if($row['book3']==$title) {
                                    $query    = "UPDATE `member` SET `book3`='' WHERE username = '$un'";
                                    $result   = mysqli_query($con, $query) or die(mysqli_error($con));

                                    if ($result) {
                                            $sql = "UPDATE `books` SET `availability`='1' WHERE title='$title' AND author='$author'";
                                            if(mysqli_query($con, $sql))    {
                                                echo '<p class="default">';
                                                echo 'Returned successfully!</p>';
                                                echo "</div></div>";        
                                            }
                                            else {
                                                echo "RESERVATION ERROR: $sql. " . mysqli_error($link);
                                            }
                                        }
                                }
                                else if($row['book1']!=$title && $row['book2']!=$title && $row['book3']!=$title) {
                                    echo '<p class="default">';
                                    echo 'You have not reserved this title.';
                                    echo "</div></div>";
                                }
                            }
                        } 
                    }
                    else{
                        echo '<p class="default">';
                        echo 'Book not available!</p>';
                        echo '</div></div>';
                    }
                }
            }
        }
    ?>

  


</body>
</html>

<?php
require('db.php');
?>