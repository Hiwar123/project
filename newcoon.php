<?php
// Database connection parameters
include("config.php");

// Sign up process
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind parameters to prevent SQL injection
    $check_query = "SELECT * FROM users WHERE email=?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        // Email already exists, display error message
        echo "Error: This email is already registered. Please use a different email.";
    } else {
        // Email does not exist, proceed with signup
        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "sss", $username, $email, $password);

        if (mysqli_stmt_execute($insert_stmt)) {
            // Redirect to home.php after successful signup
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Login process
if(isset($_POST['login_email']) && isset($_POST['login_password'])) {
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    // Prepare and bind parameters to prevent SQL injection
    $login_query = "SELECT * FROM users WHERE email=? AND password=?";
    $login_stmt = mysqli_prepare($conn, $login_query);
    mysqli_stmt_bind_param($login_stmt, "ss", $login_email, $login_password);
    mysqli_stmt_execute($login_stmt);
    $login_result = mysqli_stmt_get_result($login_stmt);

    if (mysqli_num_rows($login_result) > 0) {
        // Login successful, redirect to home.php
        header("Location: home.php");
        exit();
    } else {
        // Login failed
        echo "Invalid email or password";
    }
}

// Close the database connection
mysqli_close($conn);
?>
