<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

        <div class="container-fluid">
            
            <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:340px;">
                <h2 class="text-center">My School</h2>
                <img src="<?=ROOT?>/assets/logo.png" class="d-block mx-auto rounded-circle border border-primary" style="width:100px">
                <h3>Add User</h3>
                <input class="my-2 form-control" type="text" name="firstname" placeholder="First Name">
                <input class="my-2 form-control" type="text" name="lastname" placeholder="Last Name">
                <input class="my-2 form-control" type="email" name="email" placeholder="Email">
                <select class="my-2 form-control">
                    <option value="">--Select a Gender--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <select class="my-2 form-control">
                    <option value="">--Select a Rank--</option>
                    <option value="student">Student</option>
                    <option value="reception">Reception</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                </select>
                <input class="my-2 form-control" type="text" name="password" placeholder="Password">
                <input class="my-2 form-control" type="text" name="password2" placeholder="Retype Password">
                <br>
                <button class="btn btn-primary float-end">Login</button>
                <button class="btn btn-danger">Cancel</button>
            </div>

        </div>

<?php $this->view('includes/footer') ?>

