<?php
require 'db.php';


// Get JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data)) {
    foreach ($data as $item) {
        $name = $conn->real_escape_string($item['name']);
        $Price = floatval($item['price']);
        $units = $conn->real_escape_string($item['image']);
        

        $sql = "INSERT INTO cart_items (product_name, price, quantity) VALUES ('$name', '$Price', '$units')";

        if (!$conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    echo "Order successfully placed.";
} else {
    echo "No data received.";
}

$conn->close();
?>
