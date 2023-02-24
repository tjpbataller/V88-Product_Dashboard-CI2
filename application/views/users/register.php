<?php $this->load->view("partials/header") ?>
    <div class="container-fluid w-25 mx-auto">
        <h1 class="mb-4">Register</h1>
        <?php

        ?>
        <form class="form d-flex flex-column mb-4" action="users/register_process" method="post">
            <label class="form-label" for="email">Email Address:</label>
            <input class="form-control mb-3" name="email_address" type="email">
            <label class="form-label" for="">First Name:</label>
            <input class="form-control mb-3" name="first_name" type="text">
            <label class="form-label" for="">Last Name:</label>
            <input class="form-control mb-3" name="last_name" type="text">
            <label class="form-label" for="">Password:</label>
            <input class="form-control mb-3" name="password" type="password">
            <label class="form-label" for="">Confirm Password:</label>
            <input class="form-control mb-4" name="password_confirm" type="password">
            <input class="btn btn-success" type="submit">
        </form>
        <a href="login">Already have an account? Login</a>
    </div>
</body>
</html>