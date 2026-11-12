<?php
    require_once "config.php";
if(!isset($_SESSION['user_id'])){ header('location: index.php'); exit; }

    $result = $conn->query("SELECT * FROM film");

    $totaluser = $conn -> query("SELECT COUNT(*) AS total from users ") -> fetch_assoc()['total'];
    $totalnotapproved = $conn -> query("SELECT COUNT(*) AS total from users WHERE status = 'pending'") -> fetch_assoc()['total'];
    $totalfilm = $conn -> query("SELECT COUNT(*) AS total from film ") -> fetch_assoc()['total'];
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
             <?php if($_SESSION['role'] === 'admin'):?>
        <a href="films.php">Films</a>
        <a href="user.php">User Management</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </nav>
    <header>
        <h1>Hello, <?= h($_SESSION['username']) ?>!</h1>
        <h2>Welcome to Cinema App</h2>
    </header>
<div class="stats">
    <div>
        <h2>total of users</h2>
        <h3><?php echo $totaluser;?></h3>
    </div>
    <div>
        <h2>total of not Approved</h2>
        <h3><?php echo $totalnotapproved;?></h3>
    </div>
    <div>
        <h2>total of film</h2>
        <h3><?php echo $totalfilm;?></h3>
    </div>
</div>
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
                                             <?php if($_SESSION['role'] === 'admin'):?>
                <th>Action</th>
                   <?php endif; ?>
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
                             <?php if($_SESSION['role'] === 'admin'):?>
                        <td>
                            <button onclick="window.location.href='editfilm.php?filmid=<?php echo $film['id'];?>'">Edit</button>

                            <button onclick="window.location.href='deletefilm.php?filmid=<?php echo $film['id'];?>'">Delete</button>
                        </td>
                                <?php endif; ?>
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