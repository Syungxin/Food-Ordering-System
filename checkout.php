<?php
session_start();
require_once "includes/dbconnection.php";

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $foodId => $qty): ?>
            <tr>
                <td>Food ID #<?php echo $foodId; ?></td>
                <td><?php echo $qty; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form method="post" action="place-order.php">
        <div class="form-group">
            <label>Delivery Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success text-white">
            Place Order
        </button>
    </form>

    <br>
    <a href="cart.php">← Back to Cart</a>
</div>

</body>
</html>
