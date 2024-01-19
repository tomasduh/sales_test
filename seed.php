<?php
require_once 'db_connection.php';
// reed json file
$jsonData = file_get_contents('sales.json');

// decode json data to php array
$data = json_decode($jsonData, true);

$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

foreach ($data as $item) {

    // INSERT statement to save the data
    $sql = "INSERT INTO `sales`(`id`, `customer_name`, `customer_mail`, `product_id`, `product_name`, `product_price`, `date`, `created_at`) 
    VALUES 
    ('" . $item['sale_id'] . "','" . mysqli_real_escape_string($connection, $item['customer_name']) . "','" . mysqli_real_escape_string($connection, $item['customer_mail']) . "','" . $item['product_id'] . "',
    '" . mysqli_real_escape_string($connection, $item['product_name']) . "','" . $item['product_price'] . "','" . $item['sale_date'] . "','" . $date . "')";

    // Execute the INSERT statement

    // echo $sql.'<br>';
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($connection);
    }
}
  




?>
