<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
