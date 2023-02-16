<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    $_SESSION['flash_message'] = "Please login!";
    header("location:../login.php");
    die();
}
$userId = $_SESSION["user_id"];

$file = file_get_contents("../account/users.json");
$users = json_decode($file, true);
$file = file_get_contents("chats.json");
$chats = json_decode($file, true);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
    body {
        background-image: linear-gradient(45deg, #fd5, #e18fff, #4c97f7);
        height: 100%;
    }

    nav {
        background: linear-gradient(50deg, #970000, #4c0068, #004296);
    }

    textarea {
        height: 80px;
    }

    #subBtn {
        height: fit-content;
    }

    #subBtn:hover {
        color: #fff;
        background-color: #9300ad;
    }

    footer {
        background-color: #ddd;
    }
    </style>
</head>

<body class="d-flex flex-column">
    <header>
        <nav class="navbar navbar-dark d-flex justify-content-between px-5 fixed-top">
            <div class="navbar-brand fw-bold">* Public Chat *</div>
            <div class="d-flex gap-3">
                <?php if ($users[$userId]['admin'] == "true") { ?>
                <a href="../account/members.php">
                    <button class="btn btn-warning px-3 btn-outline-light text-black border-0">Members</button>
                </a>
                <?php } ?>
                <a href="../account/profile.php">
                    <button class="btn btn-warning px-3 btn-outline-light text-black border-0">Profile</button>
                </a>
                <a href="exit.php">
                    <button class="btn btn-warning px-3 btn-outline-danger text-black border-0">Exit</button>
                </a>
            </div>
        </nav>
    </header>


    <main class="d-flex flex-column gap-3 justify-content-start w-100 mt-5 p-3 pb-5" style="margin-bottom: 70px;">
        <?php
        // check existing messege
        if (!$chats == null) {
            // check messege of our or other 
            for ($i = 1; $i <= array_keys($chats)[count($chats) - 1]; $i++) {
                if (array_key_exists($i, $chats)) {
                    // our messeges:
                    if ($chats[$i]['authorId'] == $userId) {
        ?>
        <div class="w-100 d-flex justify-content-end align-items-center gap-2">
            <div style="background-color: #004296;" class="w-50 text-light position-relative p-3 pt-2 rounded">

                <!-- options -->
                <span style="top: 5px;"
                    class="btn-group dropstart position-absolute start-0 translate-middle badge rounded-pill btn-light text-dark btn btn-outline-warning border-0"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="dropdown-toggle" src="../icons/three-dots-vertical.svg" alt="three dots">
                </span>
                <ul class="dropdown-menu">
                    <li class="text-center">
                        <a class="text-decoration-none link-dark" href="edit.php?number=<?= $i ?>">Edit</a>
                    </li>
                    <li class="text-center">
                        <a class="text-decoration-none link-dark" href="delete.php?number=<?= $i ?>">Delete</a>
                    </li>
                </ul>

                <!-- print messege: -->
                <div class="d-flex flex-column justify-content-center p-2 gap-3">
                    <?php if ($chats[$i]["file"] != null) { ?>
                    <img class="w-100" src="<?= $chats[$i]["file"] ?>">
                    <?php } ?>
                    <?php if ($chats[$i]["messege"] != null) { ?>
                    <p class="m-0">
                        <?= $chats[$i]["messege"]; ?>
                    </p>
                    <?php } ?>
                </div>
                <!-- seen: -->
                <span style="font-size: 12px;"
                    class="position-absolute top-100 start-100 translate-middle badge rounded-pill bg-light text-dark">
                    <?php if ($chats[$i]["isSeen"] == true) { ?>
                    <img src="../icons/check2-all.svg" alt="check2-all">
                    <?php } else { ?>
                    <img src="../icons/check2.svg" alt="check2">
                    <?php } ?>
                </span>
            </div>

            <!-- name: -->
            <?php if ($users[$userId]['profiles'] != []) { ?>
            <img style="width: 100px;" class="rounded" src="<?= $users[$userId]['profiles'][0] ?>">
            <?php } else { ?>
            <div class="bg-warning rounded-pill p-2 fw-bold border border-2 border-dark">
                <?= $users[$userId]["name"]; ?>
            </div>
            <?php } ?>

        </div>

        <?php }
                    // other's messeges:
                    else {
                        // seen other's messeges:
                        $chats[$i]["isSeen"] = true;
                        $authorId = $chats[$i]['authorId'];
                        // show messeges:
                    ?>
        <div class="w-100 d-flex justify-content-start align-items-center gap-2">
            <!-- name: -->
            <?php if ($users[$authorId]['profiles'] != []) { ?>
            <!-- <div class="bg-light"> -->
            <img style="width: 100px;" class="rounded" src="<?= $users[$authorId]['profiles'][0] ?>">
            <!-- </div> -->
            <?php } else { ?>
            <div class="bg-warning rounded-pill p-2 fw-bold border border-2 border-dark">
                <?= $users[$authorId]["name"]; ?>
            </div>
            <?php } ?>

            <div style="background-color: #4c0068;" class="w-50 text-light position-relative p-3 pt-2 rounded">

                <!-- options: -->
                <?php if ($users[$userId]['admin'] == "true") { ?>
                <span style="top: 5px;"
                    class="position-absolute start-100 translate-middle badge rounded-pill btn-light text-dark btn btn-outline-warning border-0"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="dropdown-toggle" src="../icons/three-dots-vertical.svg" alt="three dots">
                </span>
                <ul class="dropdown-menu">
                    <li class="text-center">
                        <a class="text-decoration-none link-dark" href="edit.php?number=<?= $i ?>">Edit</a>
                    </li>
                    <li class="text-center">
                        <a class="text-decoration-none link-dark" href="delete.php?number=<?= $i ?>">Delete</a>
                    </li>
                </ul>
                <?php } ?>

                <!-- print messege -->
                <div class="d-flex flex-column justify-content-center p-2 gap-3">
                    <?php if ($chats[$i]["file"] != null) { ?>
                    <img class="w-100" src="<?= $chats[$i]["file"] ?>">
                    <?php } ?>
                    <?php if ($chats[$i]["messege"] != null) { ?>
                    <p class="m-0">
                        <?= $chats[$i]["messege"]; ?>
                    </p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
                    } // end of else
                } // end of if
            } // end of for()

            $encoded = json_encode($chats);
            file_put_contents("chats.json", $encoded);
        } else { ?>

        <div class="alert alert-warning" role="alert">
            No messeges!
        </div>
        <?php
        }
        ?>

    </main>


    <footer class="px-3 fixed-bottom w-100 border-top border-2 border-dark py-2">
        <?php
        if ($users[$userId]["block"] == "true") {
        ?>
        <div class="alert alert-danger" role="alert">
            you are BLOCK!
        </div>
        <?php
        } else {
        ?>
        <form class="w-100 d-flex align-items-center gap-2" action="sendMessege.php" method="post"
            enctype="multipart/form-data">
            <?php
                if (isset($_SESSION['flash_message'])) {
                    $message = $_SESSION['flash_message'];
                    unset($_SESSION['flash_message']);
                ?>
            <div class="alert alert-danger my-3" role="alert">
                <?= $message; ?>
            </div>
            <?php
                }
                ?>

            <input type="hidden" name="author" value="<?= $users[$userId]["name"] ?>">

            <textarea name="text" class="flex-grow-1"></textarea>

            <button id="subBtn" type="submit"
                class="btn fs-4 p-1 px-2 border border-2 border-dark rounded-circle shadow-lg">
                <i class="bi bi-send-fill"></i>
            </button>

            <button id="subBtn" class="btn fs-4 p-1 px-2 border border-2 border-dark rounded-circle shadow-lg"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-image"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <input class="dropdown-item form-control form-control-sm" name="file" id="formFileSm" type="file">
                </li>
            </ul>
        </form>
        <?php } ?>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
    $(document).ready(function() {
        $(document).scrollTop($(document).height());
    });
    </script>
</body>

</html>