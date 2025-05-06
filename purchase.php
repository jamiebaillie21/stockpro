<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Database connection details
$servername = "localhost";
$username   = "root";  // ← replace this
$password   = "root";  // ← replace this
$dbname     = "SALES";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "fail", "message" => "Database connection failed."]);
    exit;
}

// Read and decode JSON input
$inputJSON = file_get_contents("php://input");
$input = json_decode($inputJSON, true);

// Check if JSON decoding worked
if ($input === null) {
    http_response_code(400);
    echo json_encode(["status" => "fail", "message" => "Invalid JSON received."]);
    exit;
}

// Validate required fields
if (!isset($input['user_id']) || !isset($input['items'])) {
    http_response_code(400);
    echo json_encode(["status" => "fail", "message" => "Missing required fields."]);
    exit;
// Generate a tracker number for this order batch
$tracker_number = uniqid("TRACK_");

// Prepare statement for inserting data
$stmt = $conn->prepare("INSERT INTO orders (user_id, item_name, price, quantity, tracker_number) VALUES>

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["status" => "fail", "message" => "Failed to prepare statement."]);
    exit;
}

// Bind parameters and execute for each item
foreach ($items as $item) {
    $product_name = $item['name'];
    $price        = floatval($item['price']);
    $quantity     = intval($item['quantity']);

    $stmt->bind_param("ssdis", $user_id, $product_name, $price, $quantity, $tracker_number);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(["status" => "fail", "message" => "Failed to insert item: " . $product_name]);
        $stmt->close();
        $conn->close();
        exit;
    }
}

// Close connections
$stmt->close();
$conn->close();

// Respond success
echo json_encode(["status" => "success", "message" => "Order placed successfully!", "tracker_number" =>>
?>
