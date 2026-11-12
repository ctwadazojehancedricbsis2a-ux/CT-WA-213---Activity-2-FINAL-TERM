<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "121524", "cinemadb");

    function h($str){
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
?>