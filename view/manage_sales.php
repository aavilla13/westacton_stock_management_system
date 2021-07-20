<?php
$page_title = "Manage Sales";
include_once "layout_header.php";

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/model/product.php';

$product = new Product();
$stmt = $product->readAll();
$num = $stmt->rowCount();

echo "
        <div class='left-button-margin'>
            <a href='view_sales.php' class='btn btn-primary pull-left'>View Sales</a>
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
            echo "<th>Stock</th>";
            echo "<th>Price</th>";
            echo "<th>Quantity</th>";
            echo "<th>Total</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$product_name}<input type='hidden' name='id[]' value='{$id}'></td>";
                echo "<td class='stock'>{$product_qty}</td>";
                echo "<td class='price'>{$product_price}</td>";
                echo "<td style='width: 10%;'><input type='number' name='sales_qty[]' class='form-control qty' id='product_quantity' style='width:100%;'></td>";
                echo "<td style='width: 10%;'><input type='number' name='sales_total[]' class='form-control total_price_qty' style='width:100%;' readonly></td>";
  
            echo "</tr>";
  
        }

        echo "<tr>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td><b>Total</b></td>";
            echo "<td style='width: 10%;'><input type='number' class='form-control' id='grand_total_qty' style='width:100%;' readonly></td>";

        echo "</tr>";
  
    echo "</table>";

    echo "<div class='right-button-margin'>
            <button type='button' class='btn btn-success pull-right' id='submit_sales'> Submit</button>
        </div>
        <br/><br/>";

    echo "</form>";
}
  
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}
?>

<?php
include_once "layout_footer.php";
?>

<script type="text/javascript">
    $(function(){

        $('[id="product_quantity"]').on("input", function() {
            var qty_input = parseInt(this.value);
        
            var price = $(this).closest('tr').find('.price').text();
            var stock = $(this).closest('tr').find('.stock').text();

            if (qty_input > stock) {
                $(this).val("");
                $(this).closest('tr').find('.total_price_qty').val("");
            } else {
                var total = price * qty_input;
                $(this).closest('tr').find('.total_price_qty').val(total);
            }

            var total_price = 0;
            $(this).closest('.sales_table').find('.total_price_qty').each(function() {
                var total_price_qty = parseInt(this.value);
                if (!isNaN(total_price_qty)) {
                    total_price += total_price_qty;
                }
            });

            $('#grand_total_qty').val(total_price);

            if($('#grand_total_qty').val() != 0) {
                $('#submit_sales').attr('disabled', false);
            } else {
                $('#submit_sales').attr('disabled', 'disabled');
            }
        });

        if($('#grand_total_qty').val() !== "" || $('#grand_total_qty').val() !== 0) {
            $('#submit_sales').attr('disabled', 'disabled');
        } else {
            $('#submit_sales').attr('disabled', false);
        }

        $('#submit_sales').on('click',function(){

            bootbox.confirm({
                message: "<h4>Are you sure?</h4>",
                buttons: {
                    confirm: {
                        label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: '<span class="glyphicon glyphicon-remove"></span> No',
                        className: 'btn-primary'
                    }
                },
                callback: function (result) {
        
                    if(result == true){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo '/westacton_management_system/controller/manage_sales.php' ?>',
                            data: $('#sales-form').serialize(),
                            beforeSend: function() {
                                $('.page-loading').fadeIn();
                            },
                            success: function(data) {
                                location.reload();
                            },
                            error: function() {
                                alert('Unable to proceed.');
                            }
                        });
                    }
                }
            });
        });
    });


</script>