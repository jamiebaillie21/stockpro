<?php
session_start();
require 'db.php';
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);
   
    // Query to check user
    $sql = "SELECT * FROM users WHERE name = '$user' LIMIT 1";
    $result = $conn->query($sql);
   
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
        if (password_verify($pass, $row['Password'])) { // Ensure passwords are hashed
            $_SESSION['username'] = $row['name'];
            header("Location: dashboard.php"); // Redirect to the next page
            exit();
        } else {
            echo "<script>alert('Invalid credentials!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='login.html';</script>";
    }
}
 
$conn->close();
?>