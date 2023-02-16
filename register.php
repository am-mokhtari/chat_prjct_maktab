<?php
session_start();

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

    <div class="container text-center">
        <h1 class="h1 text-center d-inline">Register</h1>
        <a class="text-decoration-none link-dark" href="login.php"><button
                class="btn btn-danger btn-sm d-inline badge">Login</button></a>

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

        <form class="d-flex flex-column align-items-center w-100" action="account/checkRegister.php" method="post">
            <input name="username" type="text" class="form-control m-1 w-50" placeholder="Username">
            <input name="email" type="email" class="form-control m-1 w-50" placeholder="Email">
            <input name="name" type="text" class="form-control m-1 w-50" placeholder="Enter your name">
            <input name="pass" type="text" class="form-control m-1 w-50" placeholder="Password">
            <button type="submit" class="btn btn-primary">Submit</button>
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