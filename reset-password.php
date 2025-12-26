<?php
session_start();
include_once('includes/dbconnection.php');

if (!isset($_SESSION['reset_username'])) {
    header("Location: forgot-password.php");
    exit();
}

$error = "";
$success = "";

if (isset($_POST['reset'])) {
    $newpass = $_POST['newpass'];
    $confirm = $_POST['confirm'];

    if ($newpass !== $confirm) {
        $error = "Passwords do not match";
    } else {
        $hashed = password_hash($newpass, PASSWORD_DEFAULT);
        $username = $_SESSION['reset_username'];

        mysqli_query(
            $conn,
            "UPDATE users SET Password='$hashed' WHERE Username='$username'"
        );

        session_destroy();
        $success = "Password successfully changed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
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
        h2 { margin-bottom: 15px; }
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
        }
        button:hover { background: #218838; }
        .error { color: red; }
        .success { color: green; }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Reset Password</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
        <a href="login.php">← Back to Login</a>
    <?php else: ?>
        <form method="post">
            <input type="password" name="newpass" placeholder="New Password" required>
            <input type="password" name="confirm" placeholder="Confirm Password" required>
            <button type="submit" name="reset">Reset Password</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
