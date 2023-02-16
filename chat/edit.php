<?php
session_start();

$id = $_GET["number"];
$json = file_get_contents("chats.json");
$chats = json_decode($json, true);
$json = file_get_contents("../account/users.json");
$users = json_decode($json, true);

$userId = $_SESSION['user_id'];

if ($chats[$id]['authorId'] != $userId && $users[$userId]['admin'] != "true") {
    $_SESSION['flash_message'] = "You are not admin!";
    header("location:./");
    die();
}

if (isset($_POST['text']) || isset($_POST['text'])) {
    // text:
    if (trim($_POST['text']) != "") {
        $chats[$id]["messege"] = nl2br(trim($_POST['text']));
    } else {
        $chats[$id]["messege"] = null;
    }

    // file:
    $file = $_FILES['file'];
    if ($file['error'] == 0) {
        $fileFormat = mime_content_type($file['tmp_name']);
        $types = ['image/png', 'image/jpg', 'image/jpeg', 'image/svg', 'image/tfif'];
        if (in_array($fileFormat, $types)) {
            // upload new file
            $filePath = "../img/messeges/" . rand(100000, 999999) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
            move_uploaded_file($file['tmp_name'], $filePath);

            // delete previous file
            unlink($chats[$id]["file"]);

            $chats[$id]["file"] = $filePath;
        } else {
            $_SESSION['flash_message'] = "file format is invalid.";
            header("location:./");
            die();
        }
    }

    // insert in chats.json:
    $encoded = json_encode($chats);
    file_put_contents("chats.json", $encoded);
    $_SESSION['flash_message'] = "messege edited.";
    header("location:./");
    die();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
    #subBtn {
        width: fit-content;
        height: fit-content;
    }

    #subBtn:hover {
        color: #fff;
        background-color: #9300ad;
    }
    </style>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center rounded m-3">
        <div style="color:#000;" class="w-75 bg-primary p-3 m-2 text-center rounded">
            <?php if ($chats[$id]["file"] != null) { ?>
            <img class="w-75 p-2" src="<?= $chats[$id]["file"] ?>">
            <?php } ?>
            <?php if ($chats[$id]["messege"] != null) { ?>
            <p class="m-0 bg-dark text-light p-2">
                <?= $chats[$id]["messege"]; ?>
            </p>
            <?php } ?>
        </div>

        <form class="w-100 d-flex flex-column justify-content-center align-items-center gap-2 form-group" method="post"
            enctype="multipart/form-data">
            <input type="file" name="file" class="form-control">

            <textarea name="text" class="form-control"><?= $chats[$id]["messege"] ?></textarea>

            <button id="subBtn" type="submit"
                class="btn fs-4 py-1 px-2 border border-2 border-dark rounded-circle shadow-lg">
                <i class="bi bi-send-fill"></i>
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>