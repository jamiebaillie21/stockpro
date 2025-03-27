
<?php
$host = "localhost"; // Change if using an external server
$user = "root"; // Default for localhost
$password = "root"; // Default for localhost (use your own password if set)
$database = "SALES"; // Your database name
 
try {
    $pdo = new PDO("mysql:host=localhost;dbname=USERS", "stockpro", "stockpro");
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
