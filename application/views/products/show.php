<?php $this->load->view("partials/header"); ?>
    <div class="container-fluid w-50 mx-auto mb-5">
        <h1><?= $product["name"] ?> ($<?= $product["price"] ?>)</h1>
        <p>Added since: December 20th 2021</p>
        <p>Product ID: #<?= $product["id"] ?></p>
        <p>Description: <?= $product["description"] ?></p>
        <p>Total sold: <?= $product["sold"] ?></p>
        <p>Number of available stocks: <?= $product["quantity"] ?></p>
        <section class="row" id="review">
            <form class="row m-0 p-0" action="/reviews/add/<?= $product["id"] ?>" method="post">
                <h4>Leave a review</h4>
                <textarea class="form-control" name="description"></textarea>
                <input class="btn btn-success ms-auto my-3 w-25" type="submit" value="Post">
            </form>
            <?= $reviews ?>
        </section>
    </div>
</body>
</html>