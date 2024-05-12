<?php
session_start();

// Check if admin is already logged in, if yes, redirect to admin panel
if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
    header("Location: admin_panel.php");
    exit();
}

// Check if form is submitted for admin login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "admin"; // Admin username
    $admin_password = "admin123"; // Admin password (You should hash this in a real-world scenario)
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate admin credentials
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = $username; // Set admin session variable
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
