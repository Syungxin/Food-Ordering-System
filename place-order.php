<?php
session_start();
require_once "includes/dbconnection.php";

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$orderNumber = "ORD" . rand(100000, 999999);
$userId = "Guest"; // you can change later if login exists

foreach ($_SESSION['cart'] as $foodId => $qty) {

    $sql = "INSERT INTO tblorders 
            (UserId, FoodId, FoodQty, IsOrderPlaced, OrderNumber)
            VALUES 
            ('$userId', '$foodId', '$qty', 1, '$orderNumber')";

    mysqli_query($conn, $sql);
}

// Clear cart
unset($_SESSION['cart']);

// Redirect to success page
header("Location: success.php?order=$orderNumber");
exit;
