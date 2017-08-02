<?php
    session_start();
    error_reporting(0);
    include 'config.php';

    if(!isset($_SESSION['login'])){
        exit("<script>location.href='./index.php'</script>");
    }

    if(isset($_GET['idx'])){
        $query = "DELETE FROM `data` WHERE idx=".(int)$_GET['idx'];
    	mysqli_query($conn, $query);
    	exit("<script>location.href='./home.php'</script>");
    }
    exit("<script>location.href='./home.php'</script>");
?>