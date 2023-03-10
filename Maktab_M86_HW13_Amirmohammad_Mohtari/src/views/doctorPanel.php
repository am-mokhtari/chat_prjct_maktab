<?php

use \src\helper\Session;
use \src\helper\Test;

$medicalNumber = $info->medical_number ?? '';
$specialtyName = $info->specialty_name ?? '';
$birthday = $info->birthday ?? '';
$education = $info->education ?? '';
$address = $info->address ?? '';
$workHistory = $info->work_history ?? '';

if ($info) {
    foreach ($info as $key => $value) {
        if (is_null($value) || empty($value)) {
            Session::setSession("profile_defect", "Please complete your profile!");
        }
    }
} else {
    Session::setSession("profile_defect", "Please complete your profile!");
}

?>

<!------------------------------>

<?php
if (Session::getSession("profile_defect")) {
    Session::deleteSession("profile_defect");
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
         class="bi bi-exclamation-triangle text-danger" viewBox="0 0 16 16">
        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
    </svg>
    <?php
}
?>
<h2>Hi Doctor !</h2>

<div>
    <hr>
    <form action="/panel/setInfo" method="post" class="d-flex flex-column align-items-center">
        <input name="userId" type="hidden" value="<?= Session::getSession("auth_id") ?>">

        <div class="mb-3 w-75">
            <lable class="form-label">medical number:</lable>
            <input class="form-control" type="number" name="mdclNum" value="<?= $medicalNumber ?>">
        </div>

        <div class="mb-3 w-75">
            <lable class="form-label">specialty name:</lable>
            <input class="form-control" type="number" name="specialtyName" value="<?= $specialtyName ?>">
        </div>

        <div class="mb-3 w-75">
            <lable class="form-label">birthday:</lable>
            <input class="form-control" type="date" name="birthday" value="<?= $birthday ?>">
        </div>

        <div class="mb-3 w-75">
            <label class="form-label">education: </label>
            <textarea class="form-control" name="education" rows="3"><?= $education ?></textarea>
        </div>

        <div class="mb-3 w-75">
            <label class="form-label">address: </label>
            <textarea class="form-control" name="address" rows="3"><?= $address ?></textarea>
        </div>

        <div class="mb-3 w-75">
            <lable class="form-label">department id:</lable>
            <select name="prtId">
                <?php
                if (!$departments) {
                    ?>
                    <option value="" selected disabled>not exist any thing.</option>
                    <?php
                } else { ?>
                    <option value="" selected disabled>Select...</option>
                    <?php
                    foreach ($departments as $department) {
                        ?>
                        <option
                            <?php if ($department->id === ($info->department_id ?? '')) { ?>
                                selected
                            <?php } ?>
                                value="<?= $department->id ?>">
                            <?= $department->title ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class="mb-3 w-75">
            <label class="form-label">work_history: </label>
            <textarea class="form-control" name="workHistory" rows="3"><?= $workHistory ?></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>

    <!------------------->

    <h4 class="text-center mt-5">*Time Table*</h4>

    <hr>
    <form action="/panel/setTime" method="post" class="d-flex flex-column align-items-center my-4">

        <div class="d-flex justify-content-center w-50 m-2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Day:</span>
            </div>

            <select name="day" class="form-select" aria-label="Default select example">
            <option selected disabled>Select...</option>
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</option>
            <option value="tuesday">tuesday</option>
            <option value="wednesday">wednesday</option>
            <option value="thursday">thursday</option>
            <option value="friday">friday</option>
        </select>
        </div>

        <div class="d-flex justify-content-center">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Start:</span>
            </div>

            <div class="d-flex justify-content-around">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">H:</span>
                    </div>
                    <input name="startHour" type="number" class="form-control" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">M:</span>
                    </div>
                    <input name="startMinutes" type="number" class="form-control" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">End</span>
            </div>

            <div class="d-flex justify-content-around">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">H:</span>
                    </div>
                    <input name="endHour" type="number" class="form-control" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">M:</span>
                    </div>
                    <input name="endMinutes" type="number" class="form-control" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>

</div>