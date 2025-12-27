<?php
session_start();
require_once "includes/dbconnection.php";

if (empty($_SESSION['cart']) || empty($_POST['address'])) {
    header("Location: cart.php");
    exit();
}

$address = mysqli_real_escape_string($con, $_POST['address']);
$userId = $_SESSION['uid'] ?? 0; // if you have login

// 1️⃣ Insert order
$query = mysqli_query($con, "
    INSERT INTO orders (user_id, address, order_date)
    VALUES ('$userId', '$address', NOW())
");

if (!$query) {
    die("Order failed");
}

// 2️⃣ Get order ID
$order_id = mysqli_insert_id($con);

// 3️⃣ Insert order items
foreach ($_SESSION['cart'] as $foodId => $qty) {
    mysqli_query($con, "
        INSERT INTO order_items (order_id, food_id, quantity)
        VALUES ('$order_id', '$foodId', '$qty')
    ");
}

// 4️⃣ Clear cart
unset($_SESSION['cart']);

// 5️⃣ Store order ID in session
$_SESSION['order_id'] = $order_id;

// 6️⃣ Redirect
header("Location: success.php");
exit();
