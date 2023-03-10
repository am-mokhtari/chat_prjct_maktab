<?php

use src\Repository\UserRepository;
use \src\helper\Session;

?>
<nav class="d-flex justify-content-between navbar navbar-expand-md bg-light px-3">
    <?php
    //            src\helper\Test::print(UserRepository::find("users", ["full_name"])->full_name );
    if (Session::getSession('auth_id')) { ?>
        <section>
            <b><?= UserRepository::find("users", ["full_name"])->full_name ?></b>
        </section>
        <section>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <?php
                    if (Session::getSession('auth_role') !== 'patient') {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/panel">Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/home">Home</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <form method="post" action="/logout">
                            <button class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </section>
        <?php
    } else { ?>
        <section class="btn-group" role="group" aria-label="Basic example">
            <a href="/login">
                <button type="button"
                        class="btn border-end-0 btn-outline-primary btn-sm m-0 rounded-0 rounded-start">Login
                </button>
            </a>
            <a href="/register">
                <button type="button"
                        class="btn border-start-0 btn-outline-danger btn-sm m-0 rounded-0 rounded-end">Register
                </button>
            </a>
        </section>
        <section>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </section>
        <?php
    }
    ?>
</nav>

<?php
if (Session::getFlash()) {
    $messages = Session::getFlash();
    Session::deleteFlash();
    foreach ($messages as $type => $message):
        ?>
        <div class="alert alert-<?= $type ?>" role="alert">
            <?= $message ?>
        </div>
    <?php
    endforeach;
}
?>
