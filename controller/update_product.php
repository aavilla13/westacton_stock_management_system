<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$product = new Product();
$product->id = $id;

if ($_POST) {

    $product->id = $id;
    $product->product_name = $_POST['product_name'];
    $product->product_qty = $_POST['product_qty'];
    $product->product_price = $_POST['product_price'];
    $product->updated_when = date('Y-m-d H:i:s');
    $product->updated_by = 'default';
  
    if ($product->update()) {
        header('location: /westacton_management_system/view/view_product.php?id=' . $product->id);
    } else {
        header('location: /westacton_management_system/view/update_product.php?id=' . $product->id);
    }
}

$stmt = $product->readOne();


?>