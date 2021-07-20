<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$product = new Product();
$product->id = $id;
$stmt = $product->readOne();

?>