<?php
session_start();
require_once "includes/dbconnection.php";

if (empty($_SESSION['cart']) || empty($_POST['address'])) {
    header("Location: cart.php");
    exit();
}

$address = mysqli_real_escape_string($conn, $_POST['address']);
$userId = $_SESSION['uid'] ?? 0;

// 1️⃣ Insert into tblorders
mysqli_query($conn, "
    INSERT INTO tblorders (UserID, OrderDate, OrderStatus)
    VALUES ('$userId', NOW(), 'Pending')
");

$order_id = mysqli_insert_id($conn);

// 2️⃣ Insert address
mysqli_query($conn, "
    INSERT INTO tblorderaddresses (OrderId, Address)
    VALUES ('$order_id', '$address')
");

// 3️⃣ Insert food items
foreach ($_SESSION['cart'] as $foodId => $qty) {
    mysqli_query($conn, "
        INSERT INTO tblfoodtracking (OrderId, FoodId, Quantity)
        VALUES ('$order_id', '$foodId', '$qty')
    ");
}

// 4️⃣ Clear cart
unset($_SESSION['cart']);

// 5️⃣ Store order ID for success page
$_SESSION['order_id'] = $order_id;

// 6️⃣ Redirect
header("Location: success.php");
exit();
