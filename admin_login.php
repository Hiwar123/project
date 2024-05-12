<?php
// Check if the admin is already logged in
session_start();
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: admin_panel.php");
    exit;
}

// Check if the login form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check admin credentials (Replace with your authentication logic)
    $admin_username = "admin";
    $admin_password = "password";

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if($input_username === $admin_username && $input_password === $admin_password){
        // Authentication successful, start session and redirect to admin panel
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_panel.php");
        exit;
    } else {
        // Authentication failed
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if(isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
