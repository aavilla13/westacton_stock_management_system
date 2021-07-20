<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';

$product = new Product();

// Submitted Product
if ($_POST) {

    $product->product_name = $_POST['product_name'];
    $product->product_qty = $_POST['product_qty'];
    $product->product_price = $_POST['product_price'];
    $product->added_by = 'default';
    $product->deleted = 0;
  
    if($product->create()){
        header('location: /westacton_management_system/view/view_product.php?id=' . $product->id);
    }

    else{
        header('location: /westacton_management_system/view/manage_product.php');
    }
}

?>