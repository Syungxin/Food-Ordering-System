<?php
$host = "csc3074-food-db.cX0kiw0e6v6l.ap-southeast-2.rds.amazonaws.com";
$user = "admin";
$pass = "csc3074-food-ordering-system-db";  
$db   = "food_ordering";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

