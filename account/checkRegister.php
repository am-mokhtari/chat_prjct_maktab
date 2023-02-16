<?php
session_start();

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["pass"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    if (preg_match("/^[a-zA-Z][a-zA-Z0-9_]{2,31}$/", $username) && preg_match("/^[a-z]([a-z]|\s){2,31}$/", $name) && preg_match("/.{4,32}/", $pass)) {

        $file = file_get_contents("users.json");
        $users = json_decode($file, true);

        //  ckech usernames and email unique
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]["username"] == $username) {
                $_SESSION['flash_message'] = "Username is exist!";
                header("location:../register.php");
                die();
            }
            if ($users[$i]['email'] == $email) {
                $_SESSION['flash_message'] = "Email is exist!";
                header("location:../register.php");
                die();
            }
        }

        // check id for unique
        $lastId = end($users)["id"];
        $id = $lastId + 1;
        function checkId()
        {
            global $users;
            global $id;

            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]["id"] == $id) {
                    $id++;
                    checkId();
                }
            }
        }
        checkId();

        // insert usert to json
        $array = ["admin" => false, "username" => $username, "email" => $email, "profiles" => [], "name" => $name, "bio" => null, "password" => $pass, "block" => false];
        array_push($users, $array);
        $encoded = json_encode($users);
        file_put_contents("users.json", $encoded);

        // log in
        $_SESSION['user_id'] = array_keys($users)[count($users) - 1];
        header("location:../chat");
    } else {
        $_SESSION['flash_message'] = "Enter valid values.";
        header("location:../register.php");
        die();
    }
} else {
    $_SESSION['flash_message'] = "Enter all inputs!";
    header("location:../register.php");
    die();
}