<?php
$host = "127.0.0.1";
$user = "root";
$pass = "Root@1234";  
$db   = "food_ordering";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
