<?php
    require_once "config.php";
if(!isset($_SESSION['user_id'])){ header('location: index.php'); exit; }

    $result = $conn->query("SELECT * FROM film");


    $filmid =$_GET['filmid'];

    $fetchfilm = mysqli_query($conn, "SELECT * FROM film WHERE id = '$filmid'");

    if(mysqli_num_rows($fetchfilm)===0){
            echo"
    <script>
    alert('No Movies Found!');
    window.location.href='films.php';
    </script>
    ";
    }

    $film = mysqli_fetch_assoc($fetchfilm);
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
    <h3>Edit Movie ID <?php echo $film['id'];?></h3>
    <br>
    <form action="" method="post">

   <div>
     <div>
        <label for="">Movie Name:</label>
        <input type="text" name="Movie_name" required value="<?php echo $film['title'];?>">
    </div>
        <div>
        <label for="">Description:</label>
        <textarea name="description" id="" cols="30" rows="10" required><?php echo $film['description'];?></textarea>
    </div>
        <div>
        <labe for="">Genre:</labe>

<select name="genre" required>
  <option value="Action">Action</option>
  <option value="Drama">Drama</option>
  <option value="Horror">Horror</option>
  <option value="Fantasy">Fantasy</option>
<option value="<?php echo $film['genre'];?>" selected><?php echo $film['genre'];?></option>
</select>
    </div>
        <div>
        <label for="">Duration:</label>
     <input type="number" name="duration" id="" required value="<?php echo $film['duration'];?>">
    </div>
   </div>
           <div>
             <div>
        <label for="">Poster:</label>
        <input type="text" name="poster" id="" value="<?php echo $film['poster'];?>">
    </div>
            <div>
        <label for="">Rating:</label>
        <input type="number" name="rating" id="" value="<?php echo $film['rating'];?>">
    </div>
            <div>
        <label for="">Status:</label>
<select name="status" required>
  <option value="now_showing">now_showing</option>
  <option value="coming_soon">coming_soon</option>
   <option value="<?php echo $film['status'];?>" selected><?php echo $film['status'];?></option>
</select>
    </div>
            <div>
        <label for="">Release_date:</label>
        <input type="date" name="release_date" id="" value="<?php echo $film['release_date'];?>">
    </div>
           </div>
           <div><input type="submit" value="Edit" name="editmovitbtn"></div>
    

    </form>
</body>
    </html>
    <?php 

if(isset($_POST['editmovitbtn'])){
$name = $_POST['Movie_name'];
$desc = $_POST['description'];
$gen = $_POST['genre'];
$dur = $_POST['duration'];
$pos = $_POST['poster'];
$rat = $_POST['rating'];
$rel = $_POST['release_date'];
$sta = $_POST['status'];

$updatequery = "UPDATE film SET title='$name',description='$desc',genre='$gen',duration='$dur',poster='$pos',rating='$rat',release_date='$rel',status='$sta' WHERE id='$filmid'";

$updatefunc = mysqli_query($conn, $updatequery);

if($updatefunc){
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
}}
?>