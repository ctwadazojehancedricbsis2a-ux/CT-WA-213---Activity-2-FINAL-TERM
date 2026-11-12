<?php
    require_once "config.php";

    $mess = [];
    $errors = [];

    if($_SERVER['REQUEST_METHOD']==="POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if($password === $password2){
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
            $stmt->bind_param('ss',$username,$password);

               if($stmt->execute()){
                $mess[] = "Registered successfully. Please wait for the admin approval of your account.";
            }else{
                $errors[] = "Something went wrong. Please try again later.";
            }
        }else{
            $errors[] = "Passwords should match";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="style.css">

    <title>Register</title>
</head>
<body>
    <h1>Cinema App</h1>
    <h2>Create your Account</h2>
    <br>
    <?php foreach ($errors as $e): ?>
        <p style="color: red;"><?= h($e) ?></p>
    <?php endforeach;?>
    <br>
    <?php foreach ($mess as $m): ?>
        <p style="color: green;"><?= h($m) ?></p>
    <?php endforeach;?>
    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" placeholder="Enter username" required autofocus>
        <br><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Enter password" required>
        <br><br>
        <label for="password2">Re-enter Password: </label>
        <input type="password" name="password2" id="password2" placeholder="Re-enter password" required>
        <br><br>
        <input type="submit" value="Register">
    </form>
    <br><br>
    <p>Already have an account? <a href="index.php">Sign In</a></p>
</body>
</html>