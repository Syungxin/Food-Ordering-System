<?php
session_start();
require_once "includes/dbconnection.php";

/* =========================
   ADD TO CART (FROM MENU)
========================= */
if (isset($_POST['add_to_cart'])) {
    $foodid = (int)$_POST['foodid'];
    $qty = (int)$_POST['qty'];

    if ($qty < 1) $qty = 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$foodid])) {
        $_SESSION['cart'][$foodid] += $qty;
    } else {
        $_SESSION['cart'][$foodid] = $qty;
    }

    header("Location: our-menu.php");
    exit;
}

/* =========================
   CART ACTIONS
========================= */
if (isset($_POST['action'], $_POST['foodid'])) {
    $foodid = (int)$_POST['foodid'];

    if ($_POST['action'] === 'increase') {
        $_SESSION['cart'][$foodid]++;

    } elseif ($_POST['action'] === 'decrease') {
        $_SESSION['cart'][$foodid]--;
        if ($_SESSION['cart'][$foodid] < 1) {
            $_SESSION['cart'][$foodid] = 1;
        }

    } elseif ($_POST['action'] === 'remove') {
        unset($_SESSION['cart'][$foodid]);
    }

    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
<?php include "includes/header.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">
        My Cart (<?php echo array_sum($_SESSION['cart'] ?? []); ?>)
    </h2>

<?php if (empty($_SESSION['cart'])) { ?>
    <p class="text-center text-muted">Your cart is empty.</p>
<?php } else { ?>

<table class="table table-bordered align-middle">
    <thead class="thead-light">
        <tr>
            <th>Item</th>
            <th style="width:160px;">Qty</th>
            <th>Price (RM)</th>
            <th>Subtotal (RM)</th>
            <th></th>
        </tr>
    </thead>

<tbody>
<?php
$total = 0;

foreach ($_SESSION['cart'] as $foodid => $qty):
    $query = mysqli_query($conn, "SELECT ItemName, ItemPrice, Image FROM tblfood WHERE ID=$foodid");
    $row = mysqli_fetch_assoc($query);

    $subtotal = $row['ItemPrice'] * $qty;
    $total += $subtotal;

    // FIX IMAGE PATH
    $imagePath = "assets/images/cloud-food/" . basename($row['Image']);
?>
<tr>
    <td>
        <img src="<?php echo $imagePath; ?>"
             style="width:60px;height:60px;object-fit:cover;border-radius:6px;margin-right:10px;">
        <?php echo htmlspecialchars($row['ItemName']); ?>
    </td>

    <td>
        <form method="post" style="display:inline;">
            <input type="hidden" name="foodid" value="<?php echo $foodid; ?>">
            <input type="hidden" name="action" value="decrease">
            <button class="btn btn-sm btn-outline-secondary">−</button>
        </form>

        <strong class="mx-2"><?php echo $qty; ?></strong>

        <form method="post" style="display:inline;">
            <input type="hidden" name="foodid" value="<?php echo $foodid; ?>">
            <input type="hidden" name="action" value="increase">
            <button class="btn btn-sm btn-outline-secondary">+</button>
        </form>
    </td>

    <td><?php echo number_format($row['ItemPrice'], 2); ?></td>
    <td><?php echo number_format($subtotal, 2); ?></td>

    <td>
        <form method="post">
            <input type="hidden" name="foodid" value="<?php echo $foodid; ?>">
            <input type="hidden" name="action" value="remove">
            <button class="btn btn-sm btn-danger">✕</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

<tfoot>
<tr>
    <th colspan="3" class="text-right">Total (RM)</th>
    <th><?php echo number_format($total, 2); ?></th>
    <th></th>
</tr>
</tfoot>
</table>
<div class="text-right mt-4">
    <a href="checkout.php" class="btn btn-success px-4 py-2">
        Proceed to Checkout
    </a>

</div>
 <a href="our-menu.php">← Continue Order</a>
<?php } ?>
</div>

</body>
</html>
