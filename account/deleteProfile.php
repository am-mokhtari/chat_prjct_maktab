<?php
session_start();
$num = $_GET['num'];
$file = file_get_contents("users.json");
$users = json_decode($file, true);
$userId = $_SESSION["user_id"];
$array = [];
unlink($users[$userId]['profiles'][$num]);
foreach ($users[$userId]['profiles'] as $element) {
    if ($element != $users[$userId]['profiles'][$num]) {
        array_push($array, $element);
    }
}

$users[$userId]['profiles'] = $array;
$encoded = json_encode($users);
file_put_contents("users.json", $encoded);
$_SESSION['flash_message'] .= "image is deleted.";
header("location:./profile.php");
die();