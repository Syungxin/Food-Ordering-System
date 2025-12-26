<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food Ordering System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP (REQUIRED) -->
    <link rel="stylesheet" href="assets/css/main.css?v=999">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <!-- CUSTOM STYLE -->
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* NAVBAR */
        .top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background: #ffffff;
            border-bottom: 1px solid #ddd;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
        }

        .nav-links a {
            color: #000;
            font-weight: 600;
            text-decoration: none;
        }

        .nav-links span {
            margin: 0 8px;
            color: #000;
        }

        /* HERO */
        .hero {
            height: calc(100vh - 70px);
            background: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
        }

        .hero p {
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="top-nav">
    <!-- LEFT -->
    <div class="brand">
        🍔 FOS
    </div>
<div class="ml-auto d-flex align-items-center">


    <!-- Login | Register -->
    <a href="login.php" class="text-dark font-weight-bold">Login</a>
    <span class="mx-2 text-dark">|</span>
    <a href="register.php" class="text-dark font-weight-bold">Register</a>

</div>

</div>

<!-- HERO SECTION -->
<section class="hero">
    <div>
        <h1>Delicious Food, Delivered Fast 🍕</h1>
<p class="hero-subtext">
    Order your favourite meals anytime, anywhere
</p>

<div class="hero-btn">
    <a href="our-menu.php" class="btn btn-success btn-lg">
        View Food Menu
    </a>
</div>

        </a>
    </div>
</section>

</body>
</html>
