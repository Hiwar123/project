<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  echo "no";
    // die("Connection failed: " . $conn->connect_error);
}else{
  echo "yes";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo $email;
        echo $password;

        // Insert data into database
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email and password are required.";
    }
} else {
    echo "Form not submitted.";
}

$conn->close();
?>
