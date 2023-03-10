<h1 class="text-center">Register Page</h1>
    <form method="post">
        <div class="form-group m-2">
            <label>Full Name: </label>
            <input type="text" name="name" class="form-control" placeholder="Enter Full Name">
        </div>
        <div class="form-group m-2">
            <label>Username: </label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
        </div>
        <div class="form-group m-2">
            <label>Password: </label>
            <input name="password" type="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group m-2">
            <label>Role: </label>
            <select name="role" class="form-select" aria-label="Default select example">
                <option selected value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </div>
    </form>