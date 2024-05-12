<?php

include("config.php");







// Feedback submission process
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $message = $_POST['message'];

    // Prepare and bind parameters to prevent SQL injection
    $insert_query = "INSERT INTO feedback (name, email, gender, message) VALUES (?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "ssss", $name, $email, $gender, $message);

    if (mysqli_stmt_execute($insert_stmt)) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
