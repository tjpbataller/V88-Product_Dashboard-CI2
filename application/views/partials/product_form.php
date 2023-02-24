<?php   if(strpos(uri_string(), "products/edit/") !== FALSE)
        {
?>
        <form class="form w-50 d-flex flex-column mt-3" action="/products/edit_process/<?= $id ?>" method="post">
<?php   }
        else if(strpos(uri_string(), "products/new") !== FALSE)
        {
?>
        <form class="form w-50 d-flex flex-column mt-3" action="/products/new_process" method="post">
<?php
        }
?>
            <label class="form-label" for="name">Name:</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="<?= strpos(uri_string(), "products/edit/") !== FALSE?$name:"";?>">
            <label class="form-label" for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="<?= strpos(uri_string(), "products/edit/") !== FALSE?$description:"";?>"></textarea>
            <label class="form-label" for="price">Price:</label>
            <input class="form-control w-25" type="text" name="price" placeholder="<?= strpos(uri_string(), "products/edit/") !== FALSE?$price:"";?>">
            <label class="form-label" for="quantity">Inventory Count:</label>
            <input class="form-control w-25 number" type="number" name="quantity" min="0" placeholder="<?= strpos(uri_string(), "products/edit/") !== FALSE?$quantity:"";?>">
            <input class="btn btn-success ms-auto" type="submit" value="<?= strpos(uri_string(), "products/edit/") !== FALSE?"Update":"Create";?>">
        </form>
