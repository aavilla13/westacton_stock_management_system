<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/sales.php';

$product = new Product();
$sales = new Sales();

// Submitted Product
if ($_POST) {


    $ids = $_POST['id'];
    $sales_qtys = $_POST['sales_qty'];
    $sales_totals = $_POST['sales_total'];

    for ($i = 0; $i < count($ids); $i++) {

        $sales_qty = $sales_qtys[$i];

        if(isset($sales_qty)) {
            $sales->product_id = $ids[$i];
            $sales->sales_qty = $sales_qty;
            $sales->sales_total = $sales_totals[$i];
            $sales->added_when = date('Y-m-d H:i:s');
            if($sales->create()){

            }
        }
    }

}

?>