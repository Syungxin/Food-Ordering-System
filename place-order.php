<?php
session_start();
require_once "includes/dbconnection.php";

// Safety checks
if (empty($_SESSION['cart']) || empty($_POST['address'])) {
    header("Location: cart.php");
    exit();
}

$address = mysqli_real_escape_string($conn, $_POST['address']);
$userId = $_SESSION['uid'] ?? 0;

// Insert order
$query = mysqli_query($conn, "
    INSERT INTO orders (user_id, address, order_date)
    VALUES ('$userId', '$address', NOW())
");

if (!$query) {
    die("Order insert failed: " . mysqli_error($conn));
}

// Get generated order ID
$order_id = mysqli_insert_id($conn);

// Insert each cart item
foreach ($_SESSION['cart'] as $foodId => $qty) {
    mysqli_query($conn, "
        INSERT INTO order_items (order_id, food_id, quantity)
        VALUES ('$order_id', '$foodId', '$qty')
    ");
}

// Clear cart after successful order
unset($_SESSION['cart']);

// Store order ID for success page
$_SESSION['order_id'] = $order_id;

// Redirect to success page
header("Location: success.php");
exit();
