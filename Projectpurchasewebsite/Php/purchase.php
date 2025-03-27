<?php
$servername = "54.159.206.66";
$username = "root";
$password = "root";
$database = "Sales";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data)) {
    foreach ($data as $item) {
        $Item = $conn->real_escape_string($item['name']);
        $Price = floatval($item['price']);
        $units = $conn->real_escape_string($item['image']);
        $created_at = date("Y-m-d H:i:s");

        $sql = "INSERT INTO orders (item, Price, units, created_at) VALUES ('$name', '$Price', '$units', '$created_at')";

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