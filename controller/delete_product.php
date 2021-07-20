<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';

$product = new Product();
// Submitted Product
if ($_POST) {
    
    $product->id = $_POST['product_id'];
    $product->deleted_when = date('Y-m-d H:i:s');
    $product->deleted_by = 'default';
    $product->deleted = 1;
  
    if($product->delete()){
        echo "<div class='alert alert-success'>Product was updated.</div>";
    }

    else{
        echo "<div class='alert alert-danger'>Unable to update product.</div>";
    }
}

$stmt = $product->readOne();



?>