<?php
// Start session to check admin login status
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to admin login page if not logged in
    header("Location: admin_login.php");
    exit;
}

// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "your_database;"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if delete request is submitted for users
if (isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['user_id_to_delete'];
    
    // SQL query to delete user from database
    $sql = "DELETE FROM users WHERE id = $user_id_to_delete";
    
    if ($conn->query($sql) === TRUE) {
        // User deleted successfully
        $message = "User deleted successfully.";
    } else {
        // Error deleting user
        $error = "Error deleting user: " . $conn->error;
    }
}

// Fetch list of users
$sql_users = "SELECT id, username, email FROM users";
$result_users = $conn->query($sql_users);

// Check if delete request is submitted for feedback
if (isset($_POST['delete_feedback'])) {
    $feedback_id_to_delete = $_POST['feedback_id_to_delete'];
    
    // SQL query to delete feedback from database
    $sql_feedback = "DELETE FROM feedback WHERE id = $feedback_id_to_delete";
    
    if ($conn->query($sql_feedback) === TRUE) {
        // Feedback deleted successfully
        $message_feedback = "Feedback deleted successfully.";
    } else {
        // Error deleting feedback
        $error_feedback = "Error deleting feedback: " . $conn->error;
    }
}

// Fetch list of feedback
$sql_feedback = "SELECT id, name, email, gender, message FROM feedback";
$result_feedback = $conn->query($sql_feedback);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/signs.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to Admin Panel</h2>
        <h3>User Management</h3>
        <?php if(isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if(isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php while($row = $result_users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="user_id_to_delete" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="delete_user" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h3>Feedback Management</h3>
        <?php if(isset($message_feedback)): ?>
            <p><?php echo $message_feedback; ?></p>
        <?php endif; ?>
        <?php if(isset($error_feedback)): ?>
            <p><?php echo $error_feedback; ?></p>
        <?php endif; ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            <?php while($row = $result_feedback->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="feedback_id_to_delete" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="delete_feedback" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
