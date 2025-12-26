<?php
$order = $_GET['order'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Successful</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 text-center">
    <h2 class="text-success">🎉 Order Successful!</h2>
    <p>Your order number is:</p>
    <h4><?php echo htmlspecialchars($order); ?></h4>

    <br>
    <a href="our-menu.php" class="btn btn-primary">Back to Menu</a>
</div>

</body>
</html>
