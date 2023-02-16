<?php
session_start();
unset($_SESSION['user_id']);
$_SESSION['flash_message'] = "you are exit!";
header("location:../login.php");