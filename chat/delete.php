<?php
session_start();

$id = $_GET["number"];
$json = file_get_contents("chats.json");
$chats = json_decode($json, true);

unlink($chats[$id]["file"]);
unset($chats[$id]);
$encoded = json_encode($chats);
file_put_contents("chats.json", $encoded);
$_SESSION['flash_message'] = "messege deleted.";
header("location:./");