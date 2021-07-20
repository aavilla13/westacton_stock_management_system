<?php
$page_title = "Manage Products";
include_once "layout_header.php";

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';

$product = new Product();
$stmt = $product->readAll();
$num = $stmt->rowCount();

echo "<div class='left-button-margin'>
            <a href='create_product.php' class='btn btn-success pull-left'>Create Product</a>
        </div>
        <div class='right-button-margin'>
            <a href='/westacton_management_system/' class='btn btn-warning pull-right'>Back to Menu</a>
        </div>
        <br/><br/>";
if( $num > 0) {
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Products</th>";
            echo "<th>Stock</th>";
            echo "<th>Price</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$product_name}</td>";
                echo "<td>{$product_qty}</td>";
                echo "<td>{$product_price}</td>";
  
                echo "<td style='width: 20%;'>";
                    echo "<a href='view_product.php?id={$id}' class='btn btn-sm btn-primary left-margin'>
                            <span class='glyphicon glyphicon-list'></span> View
                        </a>
                        
                        <a href='update_product.php?id={$id}' class='btn btn-sm btn-info left-margin'>
                            <span class='glyphicon glyphicon-edit'></span> Edit
                        </a>
                        
                        <a delete-id='{$id}' class='btn btn-sm btn-danger delete-object'>
                            <span class='glyphicon glyphicon-remove'></span> Delete
                        </a>";
                echo "</td>";
  
            echo "</tr>";
  
        }
  
    echo "</table>";
  
}
  
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}
?>

<?php
include_once "layout_footer.php";
?>