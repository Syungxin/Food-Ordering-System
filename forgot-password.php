<?php
session_start();
include_once('includes/dbconnection.php');

$error = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);

    $check = mysqli_query(
        $conn,
        "SELECT ID FROM users WHERE Username='$username'"
    );

    if (mysqli_num_rows($check) == 1) {
        $_SESSION['reset_username'] = $username;
        header("Location: reset-password.php");
        exit();
    } else {
        $error = "Username not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 { margin-bottom: 10px; }
        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover { background: #218838; }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .back {
            margin-top: 15px;
        }
        .back a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Forgot Password</h2>
    <p>Enter your username</p>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <button type="submit" name="submit">Continue</button>
    </form>

    <div class="back">
        <a href="login.php">← Back to Login</a>
    </div>
</div>

</body>
</html>
