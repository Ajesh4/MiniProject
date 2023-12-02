<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin@123') {
    header("Location: admin_login.php");
    exit;
}

include 'db.php'; // Include the database connection file

// Check if the user ID is set in the URL parameter
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete the user based on the provided user ID
    $sql = "DELETE FROM users WHERE user_id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
        header("Location: admin_view_users.php"); // Redirect to admin dashboard after deletion
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request";
    exit;
}
?>
