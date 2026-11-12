<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
        header('location: dashboard.php');
        exit;
    }

    $userid = (int)($_GET['userid'] ?? 0);

    $stmt = $conn->prepare("UPDATE users SET status = 'pending' WHERE id = ?");
    $stmt->bind_param('i', $userid);
    $ok = $stmt->execute();
    $stmt->close();

    $msg = $ok ? 'User is disabled' : 'Failed to disable user';
    echo "<script>
        alert('$msg');
        window.location.href='user.php';
    </script>";
?> 