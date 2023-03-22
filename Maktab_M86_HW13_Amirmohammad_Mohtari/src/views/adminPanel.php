<h2>Hi Admin !</h2>
</div>
<div class="container">
    <div class="row">

        <!--    admins    -->
        <div class="col-6">
            <table class="table  table-striped text-center">
                <thead>
                <tr>
                    <th colspan="5">Admins</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Role</th>
                    <th scope="col" colspan="2">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($users as $user):

                    if ($user->role == 'admin') {
                        ?>

                        <tr>
                            <th scope="row"><?= $i ?></th scope="row">
                            <td><?= $user->full_name ?></td>
                            <td><?= $user->role ?></td>

                            <?php
                            if ($user->register_status) {
                                ?>
                                <td>enable</td>
                                <td>
                                    <form action="panel/changeStatus" method="post">
                                        <input name="userId" type="hidden" value="<?= $user->id ?>">
                                        <input name="status" type="hidden" value="<?= $user->register_status ?>">
                                        <button class="btn btn-danger">change</button>
                                    </form>
                                </td>

                            <?php } else { ?>

                                <td>disable</td>
                                <td>
                                    <form action="panel/changeStatus" method="post">
                                        <input name="userId" type="hidden" value="<?= $user->id ?>">
                                        <input name="status" type="hidden" value="<?= $user->register_status ?>">
                                        <button class="btn btn-success">change</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>

                        <?php
                    }
                    $i++;
                endforeach;
                ?>
                </tbody>
            </table>
        </div>

        <!--    doctors    -->
        <div class="col-6">
            <table class="table  table-striped text-center">
                <thead>
                <tr>
                    <th colspan="5">Doctors</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Role</th>
                    <th scope="col" colspan="2">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($users as $user):

                    if ($user->role === 'doctor') {
                        ?>

                        <tr>
                            <th scope="row"><?= $i ?></th scope="row">
                            <td><?= $user->full_name ?></td>
                            <td><?= $user->role ?></td>

                            <?php
                            if ($user->register_status) {
                                ?>
                                <td>enable</td>
                                <td>
                                    <form action="panel/changeStatus" method="post">
                                        <input name="userId" type="hidden" value="<?= $user->id ?>">
                                        <input name="status" type="hidden" value="<?= $user->register_status ?>">
                                        <button class="btn btn-danger">change</button>
                                    </form>
                                </td>

                            <?php } else { ?>

                                <td>disable</td>
                                <td>
                                    <form action="panel/changeStatus" method="post">
                                        <input name="userId" type="hidden" value="<?= $user->id ?>">
                                        <input name="status" type="hidden" value="<?= $user->register_status ?>">
                                        <button class="btn btn-success">change</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>

                        <?php
                    }
                    $i++;
                endforeach;
                ?>
                </tbody>
            </table>
        </div>


        <!--    Departments    -->
        <div class="col">
            <table class="table  table-striped text-center">
                <thead>
                <tr>
                    <th colspan="5">Departments</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Title</th>
                    <th scope="col" colspan="2">Operations</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($departments as $department): ?>
                    <tr>
                        <th scope="row"><?= $i ?></th scope="row">
                        <td><?= $department->department_code ?></td>
                        <td><?= $department->title ?></td>
                        <td>
                            <form action="/panel/updatePage" method="post">
                                <input name="prtId" type="hidden" value="<?= $department->id ?>">
                                <button class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="/panel/delete" method="post">
                                <input name="prtId" type="hidden" value="<?= $department->id ?>">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach; ?>

                <tr>
                    <form action="/panel/addPart" method="post">
                        <div class="row">
                            <div class="col">
                                <td colspan="2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Code: </span>
                                        </div>
                                        <input name="prtCode" type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </td>
                                <td colspan="2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Title: </span>
                                        </div>
                                        <input name="prtName" type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </td>
                            </div>
                            <div class="col">
                                <td>
                                    <button class="btn btn-primary" type="submit">Add</button>
                                </td>
                            </div>
                        </div>
                    </form>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
