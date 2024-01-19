<?php 
    require_once 'db_connection.php';

    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $reset = $_POST['reset'];

    $total = 0;

    if($reset == "true"){
        $filter = "";
    }else{    
        if($customer != ""){
        $filter = " WHERE customer_name = '$customer'";
    }else if($product != ""){
        $filter = "WHERE product_name = '$product'";
    }else{
        $filter = "WHERE product_price = '$price'";
    }}

    $sql = "SELECT * FROM `sales`  $filter";
    $result = mysqli_query($connection, $sql);

?>

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