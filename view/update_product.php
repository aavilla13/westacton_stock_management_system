<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/controller/update_product.php';

$page_title = "Update Product";
include_once "layout_header.php";
  
echo "<div class='right-button-margin'>
        <a href='manage_product.php' class='btn btn-success pull-right'>Manage Products</a>
    </div><br/><br/>";
  
?>

<form action="<?php echo htmlspecialchars('/westacton_management_system/controller/update_product.php?id=' . $id);?>" method="post" style="padding: 5rem 10rem; border: 1px solid #e3e6f0; border-radius: 1rem;">
  
    <div class="form-group row" id='coordinator-group'>
        <label class="col-sm-3 col-form-label" for="Salesman_coordinator">Product Name</label>
        <div class="col-sm-6">
            <div class='control-group'>
                <input type='text' name='product_name' class='form-control' value="<?php echo $product->product_name; ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group row" id='coordinator-group'>
        <label class="col-sm-3 col-form-label" for="Salesman_coordinator">Stock</label>
        <div class="col-sm-6">
            <div class='control-group'>
                <input type='text' name='product_qty' class='form-control' value="<?php echo $product->product_qty; ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group row" id='coordinator-group'>
        <label class="col-sm-3 col-form-label" for="Salesman_coordinator">Price</label>
        <div class="col-sm-6">
            <div class='control-group'>
                <input type='text' name='product_price' class='form-control' value="<?php echo $product->product_price; ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group row" id='coordinator-group'>
        <label class="col-sm-3 col-form-label" for="Salesman_coordinator">&nbsp;</label>
        <div class="col-sm-6">
            <div class='control-group'>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>

</form>

<?php
include_once "layout_footer.php";
?>