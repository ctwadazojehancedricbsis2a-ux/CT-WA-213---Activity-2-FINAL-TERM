<?php
    require_once "config.php";
if(!isset($_SESSION['user_id'])){ header('location: index.php'); exit; }

    $result = $conn->query("SELECT * FROM film");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
    <title>Cinema Dashboard</title>
</head>
<body>

    <nav>
        <a href="dashboard.php">dashboard</a>
        <a href="films.php">Films</a>
        <?php if($_SESSION['role'] === 'admin'):?>
        <a href="user.php">User Management</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </nav>
 
    <br>

<br>
<div>
    <h3>Add Movie</h3>
    <br>
    <form action="" method="post">

   <div>
     <div>
        <label for="">Movie Name:</label>
        <input type="text" name="Movie_name" required>
    </div>
        <div>
        <label for="">Description:</label>
        <textarea name="description" id="" cols="30" rows="10" required></textarea>
    </div>
        <div>
        <labe for="">Genre:</labe>

<select name="genre" required>
  <option value="Action">Action</option>
  <option value="Drama">Drama</option>
  <option value="Horror" selected>Horror</option>
  <option value="Fantasy">Fantasy</option>
</select>
    </div>
        <div>
        <label for="">Duration:</label>
     <input type="number" name="duration" id="" required>
    </div>
   </div>
           <div>
             <div>
        <label for="">Poster:</label>
        <input type="text" name="poster" id="">
    </div>
            <div>
        <label for="">Rating:</label>
        <input type="number" name="rating" id="">
    </div>
            <div>
        <label for="">Status:</label>
<select name="status" required>
  <option value="now_showing">now_showing</option>
  <option value="coming_soon" selected>coming_soon</option>
</select>
    </div>
            <div>
        <label for="">Release_date:</label>
        <input type="date" name="release_date" id="">
    </div>
           </div>
           <div><input type="submit" value="Add Movie" name="addmovitbtn"></div>
    

    </form>
    
    <br>
       <hr>
            <h1>Movies List</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Genre</th>
                <th>Duration</th>
                  <th>Poster</th>
                <th>Rating</th>
                <th>Release Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       <?php
            $fetchfilms = mysqli_query($conn, "SELECT * FROM film");

            if(mysqli_num_rows($fetchfilms)>0){
                while($film = mysqli_fetch_assoc($fetchfilms)){
                    ?>
                    <tr>
                        <td><?php echo $film['id'];?></td>
                        <td><?php echo $film['title'];?></td>
                        <td><?php echo $film['description'];?></td>
                        <td><?php echo $film['genre'];?></td>
                        <td><?php echo $film['duration'];?></td>
                       <td><?php echo $film['poster'];?></td>
                        <td><?php echo $film['rating'];?></td>
                        <td><?php echo $film['release_date'];?></td>
                        <td><?php echo $film['status'];?></td>
                        <td>
                            <button onclick="window.location.href='editfilm.php?filmid=<?php echo $film['id'];?>'">Edit</button>

                            <button onclick="window.location.href='deletefilm.php?filmid=<?php echo $film['id'];?>'">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
            }else{
        ?>
        <tr>
            <td colspan="11"> No Movies Found.>:</td>
        </tr>
        <?php
            }
       ?>
        </tbody>
    </table>
</body>
</html>
<?php 

if(isset($_POST['addmovitbtn'])){
$name = $_POST['Movie_name'];
$desc = $_POST['description'];
$gen = $_POST['genre'];
$dur = $_POST['duration'];
$pos = $_POST['poster'];
$rat = $_POST['rating'];
$rel = $_POST['release_date'];
$sta = $_POST['status'];

$insertquery = "INSERT INTO film (title, description, genre, duration, poster, rating, release_date, status)
VALUES ('$name', '$desc', '$gen', '$dur', '$pos', '$rat', '$rel', '$sta')";

$insertfunc = mysqli_query($conn, $insertquery);

if($insertfunc){
    echo"
    <script>
    alert('Movie saved succesfully!');
    window.location.href='films.php';
    </script>
    ";
}
else{
    echo"
    <script>
    alert('Something went wrong. please try again!');
    window.location.href='films.php';
    </script>
    ";
}

}
?>