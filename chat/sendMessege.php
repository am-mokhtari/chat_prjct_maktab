<?php
session_start();
$text = nl2br(trim($_POST['text']));
if ($text == "") {
    $text = null;
}
if (strlen($text) > 100) {
    $_SESSION['flash_message'] = "text is too long!";
    header("location:./");
    die();
}

$file = $_FILES['file'] ?? null;
if ($file['error'] != 0) {
    $file = null;
} else {
    $fileFormat = mime_content_type($file['tmp_name']);
    $types = ['image/png', 'image/jpg', 'image/jpeg', 'image/svg', 'image/tfif'];
    if (in_array($fileFormat, $types)) {
        $filePath = "../img/messeges/" . rand(100000, 999999) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
        move_uploaded_file($file['tmp_name'], $filePath);
        $_SESSION['flash_message'] = "success!";
    }
}
if ($file == null && $text == null) {
    $_SESSION['flash_message'] = "inputs are empty!";
    header("location:./");
    die();
}
$author = $_POST['author'];
$userId = $_SESSION["user_id"];

$json = file_get_contents("chats.json");
$chats = json_decode($json, true);

$array = ["authorId" => $userId, "author" => $author, "messege" => $text, "file" => $filePath, "isSeen" => false];
array_push($chats, $array);
$encoded = json_encode($chats);
file_put_contents("chats.json", $encoded);

header("location:./");