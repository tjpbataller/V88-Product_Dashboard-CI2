<?php $this->load->view("partials/header") ?>
    <div class="container-fluid w-25">
        <h1 class="mb-4">Login</h1>
        <form class="form d-flex flex-column mb-3" action="users/login_process" method="post">
            <label class="form-label" for="">Email Address:</label>
            <input class="form-control mb-2" type="email" name="email_address">
            <label class="form-label" for="">Password:</label>
            <input class="form-control mb-4" type="password" name="password">
            <input class="btn btn-primary" type="submit" value="Login">
        </form>
        <a class="" href="register">Don't have an account? Register</a>
    </div>
</body>
</html>
