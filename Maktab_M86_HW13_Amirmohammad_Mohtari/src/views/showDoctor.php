<div class="container">
    <h2><?= $name ?></h2>
    <table class="table table-striped">
        <tr class="table-light">
            <td>Medical Number: <?= $info->medical_number ?></td>
        </tr>
        <tr class="table-light">
            <td>Specialty Name: <?= $info->specialty_name ?></td>
        </tr>
        <tr class="table-light">
            <td>Birthday: <?= $info->birthday ?></td>
        </tr>
        <tr class="table-light">
            <td>Education: <?= $info->education ?></td>
        </tr>
        <tr class="table-light">
            <td>Address: <?= $info->address ?></td>
        </tr>
        <tr class="table-light">
            <td>Department Id: <?= $info->department_id ?></td>
        </tr>
        <tr class="table-light">
            <td>Work History: <?= $info->work_history ?></td>
        </tr>
    </table>

    <table class="table table-striped">
        <tr class="table-secondary">
            <td>Day: <?= $time->day ?? ' Not Set...' ?></td>
            <td>Start Time: <?= $time->start_time ?? ' Not Set...' ?></td>
            <td>End Time: <?= $time->end_time ?? ' Not Set...' ?></td>
        </tr>
    </table>
</div>