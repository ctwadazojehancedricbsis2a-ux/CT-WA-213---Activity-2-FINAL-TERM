<?php
    require_once "config.php";
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header('location: dashboard.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
td,th{
    text-align: center;
}
</style>
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
    <h1>User Management</h1>
<br>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Status</th>
            <th>Role</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $fetchquery = "SELECT * FROM users";

        $fetch = mysqli_query($conn, $fetchquery);

        if(mysqli_num_rows($fetch)>0){
            while($users=mysqli_fetch_assoc($fetch)){
                ?>
                <tr>
                    <td><?php echo $users['username'];

                    ?></td>
                                        <td><?php echo $users['status'];
                    
                    ?></td>
                                        <td><?php echo $users['role'];
                    
                    ?></td>
                                        <td><?php echo $users['created_at'];
                    
                    ?></td>
                    <td>
    <?php if($users['status'] !== 'approved'): ?>
        <a href="approveuser.php?userid=<?= (int)$users['id'] ?>"><button type="button">Approve</button></a>
    <?php else: ?>
        <a href="disableduser.php?userid=<?= (int)$users['id'] ?>"><button type="button">Disable</button></a>
    <?php endif; ?>
</td>
                </tr>
                <?php
            }
        }
        else{
            ?>
                    <td colspan="5">No users found.</td>
                </tr>
                <?php
        }
        ?>
    </tbody>
</table>

</body>
</html>