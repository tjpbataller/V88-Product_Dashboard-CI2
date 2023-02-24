<?php $this->load->view("partials/header"); ?>
    <div class="container-fluid mx-auto w-75">
        <div class="row">
            <h1 class="mb-5">Edit Profile</h1>
            <fieldset class="col-6 px-5">
                <legend>Edit Information</legend>
                <form action="edit_process" method="post">
                    <label class="form-label" for="email_address">Email Address:</label>
                    <input class="form-control" type="email" name="email_address">
                    <label class="form-label" for="first_name">First Name:</label>
                    <input class="form-control" type="text" name="first_name">
                    <label class="form-label" for="last_name">Last Name:</label>
                    <input class="form-control" type="text" name="last_name">
                    <input class="btn btn-success mt-5" type="submit" value="Save">
                </form>   
            </fieldset> 
            <fieldset class="col-6 px-5">
                <legend>Change Password</legend>
                <form action="change_password" method="post">
                    <label class="form-label" for="old_password">Old Password:</label>
                    <input class="form-control" type="password" name="old_password">
                    <label class="form-label" for="new_password">New Password:</label>
                    <input class="form-control" type="password" name="new_password">
                    <label class="form-label" for="confirm_password">Confirm Password:</label>
                    <input class="form-control" type="password" name="confirm_password">
                    <input class="btn btn-success mt-5" type="submit" value="Save">
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>