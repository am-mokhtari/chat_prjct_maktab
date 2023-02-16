<?php
session_start();

$userName = $_POST["username"];
$userPass = $_POST["pass"];

$file = file_get_contents("users.json");
$users = json_decode($file, true);

for ($i = 1; $i <= count($users); $i++) {
    if ($users[$i]["username"] == $userName && $users[$i]["password"] == $userPass) {
        $_SESSION['user_id'] = $i;
        header("location:../chat/");
    }
}
if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_message'] = "Username or Password is invalid!";
    header("location:../login.php");
}