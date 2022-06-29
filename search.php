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
    <img src="logo2.jpg" width="100%">'
    
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
    <h2> Search Results </h2>
</div>

<div class="form">
<p><img src="back.png" width="11px">
<a class="back" href="browse.php">Back to Browse</a></p>
<?php
	if (isset($_POST['searchsubmit'])){
		$search = mysqli_real_escape_string($con, $_POST['searchbar']);
		$sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR text LIKE '%$search%' OR author LIKE '%$search%' OR genre LIKE '%$search%' OR date LIKE '%$search%' OR format LIKE '%$search%'";
		$result = mysqli_query($con, $sql);
		$queryResult = mysqli_num_rows($result);

		if ($queryResult > 0){
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
                    Available Formats: <i>'.$row['format'].'</i></p>
                    <p> Published: <i>'.$row['date'].'</i></p>
                    </font>
                    </div>
                </div>';
			}
		}

		else {
			echo "Not Available!";
        }
	}
?>
<p><img src="back.png" width="11px">
<a class="back" href="browse.php">Back to Browse</a></p>
</div>