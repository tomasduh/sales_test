<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Test</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php
require_once 'db_connection.php';
$sql = "SELECT * FROM `sales`";
$result = mysqli_query($connection, $sql);

if($_POST){
    echo "POST";
}
$total = 0;
// Fetch customers
$customerSql = "SELECT DISTINCT customer_name FROM `sales`";
$customerResult = mysqli_query($connection, $customerSql);

// Fetch products
$productSql = "SELECT DISTINCT product_name FROM `sales`";
$productResult = mysqli_query($connection, $productSql);

// Fetch prices
$priceSql = "SELECT DISTINCT product_price FROM `sales`";
$priceResult = mysqli_query($connection, $priceSql);
?>
<body>
    <h1 style="text-align: center;">Sales Reports</h1> 
    <div class="container">
        <br>     
        <div class="filter">
            <label for="customer">Customer:</label>
            <select name="customer" id="customer">
                <option value="">Select Customer</option>
                <?php
                while ($customerRow = mysqli_fetch_assoc($customerResult)) {
                    echo "<option value='" . $customerRow["customer_name"] . "'>" . $customerRow["customer_name"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="filter">
            <label for="product">Product:</label>
            <select name="product" id="product">
                <option value="">Select Product</option>
                <?php
                while ($productRow = mysqli_fetch_assoc($productResult)) {
                    echo "<option value='" . $productRow["product_name"] . "'>" . $productRow["product_name"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="filter">
            <label for="price">Price:</label>
            <select name="price" id="price">
                <option value="">Select Price</option>
                <?php
                while ($priceRow = mysqli_fetch_assoc($priceResult)) {
                    echo "<option value='" . $priceRow["product_price"] . "'>" . $priceRow["product_price"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="filter">
            <div class="container">
                <button class='reset' onclick="resetFilters()">Reset</button>
            </div>
        </div>  
        <br>
    </div>
    <div class="container" id="table">
        <table class="table_info">
            <thead>
                <tr>
                    <th width="150px">Customer Name</th>
                    <th width="350px">Customer Email</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Sale Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total += $row["product_price"];
                        echo "<tr>
                        <td>" . $row["customer_name"] . "</td>
                        <td>" . $row["customer_mail"] . "</td>
                        <td>" . $row["product_name"] . "</td>
                        <td>" . $row["product_price"] . "</td>
                        <td>" . $row["date"] . "</td>
                        </tr>";
                    }
                    echo "<tr>
                    <td style='font-weight: bolder;'>Total</td>
                    <td></td>
                    <td></td>
                    <td style='font-weight: bolder;'>".$total."</td>
                    <td></td>
                    </tr>";
                } else {
                    echo "0 results";
                }?>
            </tbody>
        </table>
    </div>
</body>
</html>

<script>

    $(document).ready(function() {
        $('#customer, #product, #price').change(function() {
            var customer = $('#customer').val();
            var product = $('#product').val();
            var price = $('#price').val();

            $.ajax({
                url: 'filter.php', // Ruta al archivo PHP que ejecutará la consulta SQL
                method: 'POST',
                data: {
                    customer: customer,
                    product: product,
                    price: price,
                    reset: false
                },
                success: function(data) {
                    // Aquí puedes actualizar la tabla con los nuevos datos
                    // Suponiendo que tienes un elemento con id 'table', podrías hacer algo como esto:
                    $('#table').html(data);
                }
            });
        });

    });

    function resetFilters() {
        
        $.ajax({
            url: 'filter.php', // Ruta al archivo PHP que ejecutará la consulta SQL
            method: 'POST',
            data: {
                customer: '',
                product: '',
                price: '',
                reset: true
            },
            success: function(data) {
                // Aquí puedes actualizar la tabla con los nuevos datos
                // Suponiendo que tienes un elemento con id 'table', podrías hacer algo como esto:
                $('#table').html(data);
            }
        });
    }

</script>
