<?php
$page_title = "View Sales";
include_once "layout_header.php";

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/sales.php';

$sales = new Sales();
$stmt = $sales->readAll();
$num = $stmt->rowCount();

echo "
        <div class='left-button-margin'>
            <a href='manage_sales.php' class='btn btn-primary pull-left'>Manage Sales</a>
        </div>
        <div class='right-button-margin'>
            <a href='/westacton_management_system/' class='btn btn-warning pull-right'>Back to Menu</a>
        </div>
        <br/><br/>";
if( $num > 0) {
    echo "<form id='sales-form'>";
    echo "<table class='table table-hover table-responsive table-bordered sales_table'>";
        echo "<tr>";
            echo "<th>Products</th>";
            echo "<th>Quantity</th>";
            echo "<th>Total</th>";
            echo "<th style='width: 20%;'>Added When</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$product_name}</td>";
                echo "<td>{$sales_qty}</td>";
                echo "<td>{$sales_total}</td>";
                echo "<td>{$added_when}</td>";
            echo "</tr>";
  
        }
    echo "</table>";

    echo "</form>";
}
  
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}
?>

<?php
include_once "layout_footer.php";
?>
