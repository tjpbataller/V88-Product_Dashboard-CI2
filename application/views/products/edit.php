<?php $this->load->view("partials/header"); ?>
    <div class="container-fluid mx-auto w-75 row">
        <h3 class="col-10">Edit Product #<?= $id ?></h3>
        <a class="btn btn-primary col-2" href="/dashboard">Return to Dashboard</a>
<?php   $this->load->view("partials/product_form") ?>
    </div>
</body>
</html>