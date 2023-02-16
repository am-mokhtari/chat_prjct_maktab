<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    $_SESSION['flash_message'] = "Please login!";
    header("location:../login.php");
    die();
}
$userId = $_SESSION["user_id"];

$file = file_get_contents("users.json");
$users = json_decode($file, true);

if (isset($_POST['name']) || isset($_POST['bio']) || isset($_FILES['file'])) {
    // name:
    if (trim($_POST['name']) != "") {
        $users[$userId]["name"] = trim($_POST['name']);
    }

    // bio:
    if (trim($_POST['bio']) != "") {
        $users[$userId]["bio"] = trim($_POST['bio']);
    } else {
        $users[$userId]["bio"] = null;
    }

    // file:
    $file = $_FILES['file'];

    if ($file['error'][0] == 0) {
        for ($i = 0; $i < count($file['name']); $i++) {
            $fileFormat = mime_content_type($file['tmp_name'][$i]);
            // var_dump($fileFormat);
            $types = ['image/png', 'image/jpg', 'image/jpeg', 'image/svg', 'image/tfif'];
            if (in_array($fileFormat, $types)) {
                // upload new file
                $filePath = "../img/profiles/" . rand(100000, 999999) . "." . pathinfo($file['name'][$i], PATHINFO_EXTENSION);
                move_uploaded_file($file['tmp_name'][$i], $filePath);
                array_unshift($users[$userId]["profiles"], $filePath);
            } else {
                $_SESSION['flash_message'] = "file format is invalid, its " . $fileFormat . ". file name : " . $file['name'][$i];
            }
        }
    }
    // insert in users.json:
    $encoded = json_encode($users);
    file_put_contents("users.json", $encoded);
    $_SESSION['flash_message'] .= " * profile edited.";
    header("location:./profile.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="w-100 p-2">
        <?php
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $message; ?>
        </div>
        <?php
        }
        ?>

        <a href="../chat/"><button class="btn btn-success w-100 my-3">Chat</button></a>

        <div class="bg-light d-flex flex-column flex-sm-row flex-wrap gap-3 justify-content-center align-items-center">
            <?php
            for ($i = 0; $i < count($users[$userId]['profiles']); $i++) { ?>
            <div style="width:260px;" class="d-flex flex-column gap-2">
                <img src="<?= $users[$userId]['profiles'][$i] ?>">
                <a href="deleteProfile.php?num=<?= $i ?>">
                    <button class="btn btn-danger btn-outline-dark w-100">delete</button>
                </a>
            </div>
            <?php }
            ?>
        </div>
        <br>
        <form
            class="w-100 d-flex flex-column justify-content-center align-items-center gap-2 form-group bg-info p-5 rounded"
            method="post" enctype="multipart/form-data">
            <div class="w-75 d-flex gap-2">
                <label class="w-25 d-flex justify-content-center">New profile: </label>
                <input class="form-control rounded" type="file" name="file[]" multiple>
            </div>
            <div class="w-75 d-flex gap-2">
                <label class="w-25 d-flex justify-content-center">Name: </label>
                <input class="form-control flexflex-grow-1 rounded" type="text" value="<?= $users[$userId]['name'] ?>"
                    name="name">
            </div>
            <div class="w-75 d-flex gap-2">
                <label class="w-25 d-flex justify-content-center">Bio: </label>
                <input class="form-control flexflex-grow-1 rounded" type="text" value="<?= $users[$userId]['bio'] ?>"
                    name="bio">
            </div>
            <button class="btn btn-primary btn-outline-light">Send</button>
        </form>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>