<?php
    require_once "config.php";
if(!isset($_SESSION['user_id'])){ header('location: index.php'); exit; }

$filmid =$_GET['filmid'];

$deletefilm = mysqli_query($conn, "DELETE FROM film WHERE id = '$filmid'");

if($deletefilm){
    echo"<script>
    alert('Deleted succesfully');

    window.location.href='films.php';
    </script>";
}

else{
    echo"<script>
    alert('Something went wrong. please try again!');

    window.location.href='films.php';
    </script>";
}


?>