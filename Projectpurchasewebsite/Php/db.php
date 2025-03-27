
<?php
$host = "184.72.103.98"; // Change if using an external server
$user = "root"; // Default for localhost
$password = "root"; // Default for localhost (use your own password if set)
$database = "SALES"; // Your database name
 
$conn = new mysqli($host, $user, $password, $database);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
?>