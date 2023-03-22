<div class="container">
    <h2><?= $name ?></h2>
    <table class="table table-striped">
        <tr class="table-light">
            <td>Medical Number: <?php
                if (empty($info->medical_number)) {
                    echo " - ";
                } else {
                    echo $info->medical_number;
                }
                ?></td>
        </tr>
        <tr class="table-light">
            <td>Specialty Name: <?php
                if (empty($info->specialty_name)) {
                    echo " - ";
                } else {
                    echo $info->specialty_name;
                }
                ?></td>
        </tr>
        <tr class="table-light">
            <td>Birthday: <?php
                if (empty($info->birthday)) {
                    echo " - ";
                } else {
                    echo $info->birthday;
                }
                ?></td>
        </tr>
        <tr class="table-light">
            <td>Education: <?php
                if (empty($info->education)) {
                    echo " - ";
                } else {
                    echo $info->education;
                }
                ?></td>
        </tr>
        <tr class="table-light">
            <td>Address: <?php
                if (empty($info->address)) {
                    echo " - ";
                } else {
                    echo $info->address;
                }
                ?></td>
        </tr>
        <tr class="table-light">
            <td>Department Id: <?php
                if (empty($info->department_id)) {
                    echo " - ";
                } else {
                    echo $info->department_id;
                }
                ?></td>
        </tr>
        <tr class="table-light">
            <td>Work History: <?php
                if (empty($info->work_history)) {
                    echo " - ";
                } else {
                    echo $info->work_history;
                }
                ?></td>
        </tr>
    </table>

    <table class="table table-striped">
        <?php
        if (empty($times)) {
            ?>
            <tr class="table-secondary">
                <td>Not Set...</td>
            </tr>
                <?php
        } else {
            foreach ($times as $time):
                ?>
                <tr class="table-secondary">
                    <td>Day: <?= $time->day ?></td>
                    <td>Start Time: <?= $time->start_time ?></td>
                    <td>End Time: <?= $time->end_time ?></td>
                    <td>
                        <form action="/showDetails/reserve" method="post">
                            <input name="timeId" type="hidden" value="<?= $time->id ?>">
                            <button type="submit" class="btn btn-warning">reserve</button>
                        </form>
                    </td>
                    <td>
                        <form action="/showDetails/cancel" method="post">
                            <input name="timeId" type="hidden" value="<?= $time->id ?>">
                            <button type="submit" class="btn btn-danger">cancel</button>
                        </form>
                    </td>
                </tr>
            <?php
            endforeach;
        } ?>
    </table>


</div>