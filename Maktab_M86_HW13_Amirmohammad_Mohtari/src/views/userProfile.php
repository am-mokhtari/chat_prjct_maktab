<div class="container">
    <h1><?= $info->full_name ?></h1>
    <br>
    <div class="row">
        <div class="col-4">
            <table class="table table-primary table-hover table-striped">
                <thead>
                <tr>
                    <td class="bg-secondary text-light text-center" colspan="2">* Your Info *</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Full Name:</th>
                    <td><?= $info->full_name ?></td>
                </tr>
                <tr>
                    <th scope="row">User Name:</th>
                    <td><?= $info->user_name ?></td>
                </tr>
                <tr>
                    <th scope="row">Role:</th>
                    <td><?= $info->role ?></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-8">
            <table class="table table-info table-hover table-striped">
                <thead>
                <tr>
                    <td colspan="4" class="bg-secondary text-light text-center">* Upcoming Turns *</td>
                </tr>
                <tr>
                    <th class="bg-info text-light" scope="col">Date</th>
                    <th class="bg-info text-light" scope="col">Name</th>
                    <th class="bg-info text-light" scope="col">Speciality</th>
                    <th class="bg-info text-light" scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (empty($reserves)) {
                    ?>
                    <tr class="table-secondary">
                        <td colspan="4">empty...</td>
                    </tr>
                    <?php
                } else {
                    foreach ($reserves as $reserved):
                        $now = date_create(Date("Y-m-d"));
                        $reservedDate = date_create($reserved->day);

                        if (date_diff($now, $reservedDate)->invert === 0) {
                            ?>
                            <tr>
                                <th scope="row"><?= $reserved->day ?></th>
                                <td>Dr.<?= $reserved->full_name ?></td>
                                <td><?= $reserved->specialty_name ?></td>
                                <td><?= $reserved->start_time . " - " . $reserved->end_time ?></td>
                            </tr>
                            <?php
                        }
                    endforeach;
                } ?>
                </tbody>
            </table>
        </div>

        <div class="col">
            <table class="table table-info table-hover table-striped">
                <thead>
                <tr>
                    <td colspan="4" class="bg-secondary text-light text-center">* All Reserves *</td>
                </tr>
                <tr>
                    <th class="bg-info text-light" scope="col">Date</th>
                    <th class="bg-info text-light" scope="col">Name</th>
                    <th class="bg-info text-light" scope="col">Speciality</th>
                    <th class="bg-info text-light" scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (empty($reserves)) {
                    ?>
                    <tr class="table-secondary">
                        <td colspan="4">empty...</td>
                    </tr>
                    <?php
                } else {
                    foreach ($reserves as $reserved):
                        ?>
                        <tr>
                            <td><?= $reserved->day ?></td>
                            <td>Dr.<?= $reserved->full_name ?></td>
                            <td><?= $reserved->specialty_name ?></td>
                            <td><?= $reserved->start_time . " - " . $reserved->end_time ?></td>
                        </tr>
                    <?php
                    endforeach;
                } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>