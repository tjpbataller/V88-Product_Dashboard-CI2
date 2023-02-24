<?php $this->load->view("partials/header") ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Do you want to delete item? <p></p></div>
                <form class="modal-footer" action="" method="post">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" name="product_id" value="">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid w-75 mx-auto row">
        <h1 class="col-10">All Products</h1>
<?php   if($this->session->userdata("user_level") > 1){
?>
        <a class="btn btn-primary col-2 mb-5" href="/products/new">Add Product</a>
<?php   }
?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Inventory Count</th>
                    <th>Quantity Sold</th>
<?php               if($this->session->userdata("user_level") > 1){
?>
                    <th>Action</th>
<?php               }
?>
                </tr>
            </thead>
            <tbody>
<?php       foreach($products as $key=>$product)
            {
?>
                <tr <?= ($key%2 == 0)?'class="table-light"':'class="table-secondary"'; ?>>
                    <td><?= $product["id"]?></td>
                    <td class="product-name"><a href="/products/show/<?= $product["id"] ?>"><?= $product["name"] ?></a></td>
                    <td><?= $product["quantity"] ?></td>
                    <td><?= $product["sold"] ?></td>
<?php               if($this->session->userdata("user_level") > 1){
?>
                    <td><!--
                    --><a class="bi bi-pencil btn btn-secondary w-50 h-50 fs-6" href="/products/edit/<?= $product["id"] ?>"></a><!--
                    --><i class="bi bi-trash3 btn btn-danger w-50 h-50 fs-6 delete-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-product-id="<?= $product["id"] ?>"></i>
                    </td>
<?php               }
?>
                </tr>
<?php       }
?>
            </tbody>
        </table>
    </div>
</body>
</html>