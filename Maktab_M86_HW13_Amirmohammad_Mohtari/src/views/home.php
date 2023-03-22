<h1>Home</h1>

<div class="container d-flex justify-content-around">

    <div class="w-25 m-2">

        <form method="get">

            <div class="mb-3">
                <lable class="form-label">Doctor Name:</lable>
                <input class="form-control" type="text" name="name">
            </div>

            <div>
                <?php
                foreach ($specialtyList as $specialtyName) {
                    ?>
                    <div class="form-check">
                        <input name="specialty[]" class="form-check-input" type="checkbox"
                               value="<?= $specialtyName->specialty_name ?>">
                        <label class="form-check-label">
                            <?= $specialtyName->specialty_name ?>
                        </label>
                    </div>
                    <?php
                }
                ?>
            </div>

            <button class="btn btn-primary btn-sm ">search</button>
        </form>
    </div>

    <div class="m-2 justify-content-center">
        <p class="lead text-center w-100">Result For:
            <?php
            if ((!isset($_GET['name']) || empty($_GET['name'])) && (!isset($_GET['specialty']) || empty($_GET['specialty']))) {
                echo " All Doctors.";
            }
            if (isset($_GET['name']) && !empty($_GET['name'])) {
                echo $_GET['name'] . ' , ';
            }
            if (isset($_GET['specialty']) && !empty($_GET['specialty'])) {
                echo ' ' . implode(' , ', $_GET['specialty']);
            }
            ?>
        </p>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            foreach ($doctorsList as $doctorInfo):
                ?>
                <div style="width: 45%" class="card bg-secondary text-white m-1">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title text-center"><?= $doctorInfo->full_name ?></h5>
                        <p class="card-text text-center">specialty: <?= $doctorInfo->specialty_name ?></p>
                        <form action="/showDetails" method="get" class="d-flex align-items-center justify-content-center w-50">
                            <input name="id" type="hidden" value="<?= $doctorInfo->id ?>">
                            <input name="doctorName" type="hidden" value="<?= $doctorInfo->full_name ?>">
                            <button type="submit" class="btn btn-info btn-sm text-white">See Details</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>