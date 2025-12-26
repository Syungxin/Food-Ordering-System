<?php
session_start();
require_once "includes/dbconnection.php";

$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Food Menu</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        .navbar { padding: 15px 25px; }
        .cart-link { position:absolute; right:20px; top:18px; font-weight:bold; }
        .food-img { height:220px; object-fit:cover; }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white position-relative">
    <a class="navbar-brand font-weight-bold" href="index.php">🍔 FOS</a>
    <a href="cart.php" class="cart-link">🛒 Cart (<?php echo $cartCount; ?>)</a>
</nav>

<div class="container mt-4">
    <h2 class="text-center mb-4">🍽 Our Sibeh Jeng Food Menu</h2>
    <div class="row">

<?php
$sql = "SELECT ID, ItemName, ItemPrice, Image FROM tblfood";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="col-md-4 mb-4">
        <div class="card">
		<img src="assets/images/cloud-food/<?php echo htmlspecialchars($row['Image']); ?>" 
     		     class="card-img-top food-img"
		     onerror="this.src='assets/images/no-image.png';">

            <div class="card-body text-center">
                <h5><?php echo htmlspecialchars($row['ItemName']); ?></h5>
                <p class="text-success font-weight-bold">
                    RM <?php echo number_format($row['ItemPrice'], 2); ?>
                </p>

			<form method="post" action="cart.php">
			    <input type="hidden" name="foodid" value="<?php echo $row['ID']; ?>">
    			    <input type="number" name="qty" value="1" min="1" class="form-control mx-auto mb-3" 
			    style="width:70px; text-align:center;">
    			    <button type="submit" name="add_to_cart" class="btn btn-primary">
        			Add to Cart
    			    </button>
			</form>

            </div>
        </div>
    </div>
<?php } ?>

    </div>
</div>
</body>
</html>
