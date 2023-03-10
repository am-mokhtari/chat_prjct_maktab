<div class="container">
    <form method="post" action="/panel/updateDprt" class="p-3 d-flex flex-column align-items-center bg-secondary">

        <input class="input-group-text" name="prtId" type="hidden" value="<?= $prt->id; ?>">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Department Code: </span>
            </div>
            <input name="prtCode" type="text" class="form-control" aria-label="Default"
                   aria-describedby="inputGroup-sizing-default" value="<?= $prt->department_code; ?>">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Title: </span>
            </div>
            <input name="prtName" type="text" class="form-control" aria-label="Default"
                   aria-describedby="inputGroup-sizing-default" value="<?= $prt->title; ?>">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
    </form>
</div>