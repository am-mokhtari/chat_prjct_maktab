<?php
session_start();
$file = file_get_contents("users.json");
$users = json_decode($file, true);

if (!isset($_SESSION["user_id"])) {
    $_SESSION['flash_message'] = "Please login!";
    header("location:../login.php");
    die();
}
$userId = $_SESSION["user_id"];
if ($users[$userId]['admin'] != true) {
    $_SESSION['flash_message'] = "You are not admin!";
    header("location:../chat/");
    die();
}

if (isset($_GET["blck"]) && isset($_GET["id"])) {
    if ($_GET["blck"] == "true") {
        $users[$_GET['id']]['block'] = false;
    } else if ($_GET["blck"] == "false") {
        $users[$_GET['id']]['block'] = true;
    }
    $encoded = json_encode($users);
    file_put_contents("users.json", $encoded);
    $_SESSION['flash_message'] = "user status is changed.";
    header("location:./members.php");
    die();
}

if (isset($_GET["admin"]) && isset($_GET["id"])) {
    if ($_GET["admin"] == "true") {
        $users[$_GET['id']]['admin'] = false;
    } else if ($_GET["admin"] == "false") {
        $users[$_GET['id']]['admin'] = true;
    }
    $encoded = json_encode($users);
    file_put_contents("users.json", $encoded);
    $_SESSION['flash_message'] = "user status is changed.";
    header("location:./members.php");
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

    <div class="w-100 p-3 bg-light d-flex flex-column gap-3 justify-content-center align-items-center">
        <a class="w-100" href="../chat/"><button class="btn btn-secondary w-100">GoBack To Chats</button></a>
        <div class="w-100 d-flex gap-3 justify-content-evenly">
            <div class="w-100 text-center">Name</div>
            <div class="w-100 text-center">Username</div>
            <div class="w-100 text-center">Email</div>
            <div class="w-100 text-center">Bio</div>
            <div class="w-100 text-center">Block</div>
            <div class="w-100 text-center">admin</div>
        </div>
        <?php
        for ($i = 1; $i <= count($users); $i++) { ?>
        <div class="w-100 d-flex gap-3 justify-content-evenly">
            <div class="w-100 text-center">
                <?= $users[$i]['name'] ?>
            </div>
            <div class="w-100 text-center">
                <?= $users[$i]['username'] ?>
            </div>
            <div class="w-100 text-center">
                <?= $users[$i]['email'] ?>
            </div>
            <div class="w-100 text-center">
                <?= $users[$i]['bio'] ?>
            </div>
            <div class="w-100 text-center">
                <?php if ($users[$i]['block']) { ?>
                <a href="?blck=true&id=<?= $i ?>"><button class="btn btn-danger">blocked</button></a>
                <?php } else { ?>
                <a href="?blck=false&id=<?= $i ?>"><button class="btn btn-success">normal</button></a>
                <?php } ?>
            </div>
            <div class="w-100 text-center">
                <?php if ($users[$i]['admin']) { ?>
                <a href="?admin=true&id=<?= $i ?>"><button class="btn btn-success">admin</button></a>
                <?php } else { ?>
                <a href="?admin=false&id=<?= $i ?>"><button class="btn btn-danger">user</button></a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
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