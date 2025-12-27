<?php
session_start();
require_once "includes/dbconnection.php";

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$userId = $_SESSION['uid'] ?? 'GUEST';

// Generate unique order number
$orderNumber = 'ORD' . time();

foreach ($_SESSION['cart'] as $foodId => $qty) {

    mysqli_query($conn, "
        INSERT INTO tblorders 
        (UserId, FoodId, FoodQty, IsOrderPlaced, OrderNumber)
        VALUES 
        ('$userId', '$foodId', '$qty', 1, '$orderNumber')
    ");
}

// Clear cart
unset($_SESSION['cart']);

// Store order number for success page
$_SESSION['order_id'] = $orderNumber;

// Redirect to success page
header("Location: success.php");
exit();
