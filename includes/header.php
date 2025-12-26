<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===== CART COUNT ===== */
$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $cartCount += (int)$qty;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FOS</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

<header class="header-area">
    <div class="container">
        <div class="row align-items-center">

            <!-- LOGO -->
            <div class="col-md-6 col-sm-6">
                <a href="index.php" class="logo">
                    🍔 <strong>FOS</strong>
                </a>
            </div>

            <!-- CART -->
		<?php
		$currentPage = basename($_SERVER['PHP_SELF']);
		if ($currentPage !== 'cart.php') {
		?>
    		<a href="cart.php" class="cart-btn">
        		<i class="fa fa-shopping-cart"></i>
        		Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)
    		</a>
		<?php } ?>

        </div>
    </div>
</header>
