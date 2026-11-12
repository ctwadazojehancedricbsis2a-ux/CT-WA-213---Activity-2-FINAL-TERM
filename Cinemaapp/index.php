<?php
    require_once "config.php";


    $errors = [];

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param('s',$username);
        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        $stmt->close();

        if($user && $password === $user['password']){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('location: dashboard.php');

            exit;
        }else{
            $errors[] = "Invalid username or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
    <title>Sign in</title>
</head>
<body>
    <h1>Wellcome to Cinema app</h1>
    <h1>Sign in</h1>
    <h2>Please sign in first</h2>

    <?php foreach ($errors as $e): ?>
        <p style="color: red"><?= h($e) ?></p>
    <?php endforeach;?>

    <form action="" method="POST">
        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" placeholder="Enter your username" required autofocus><br><br>

        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password"><br><br>

        <button type="submit">Sign in</button>
    </form>
    <p>No Account? <a href="register.php">Register</a></p>
</body>
</html>