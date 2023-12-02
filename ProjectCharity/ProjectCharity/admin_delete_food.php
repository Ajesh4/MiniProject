<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin@123') {
    header("Location: userloginform.php");
    exit;
}

include 'db.php'; // Include the database connection file

// Check if the donation ID is set in the URL parameter
if (isset($_GET['id'])) {
    $donation_id = $_GET['id'];

    // Delete the food donation based on the provided donation ID
    $sql = "DELETE FROM food_donations WHERE donation_id='$donation_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Food donation deleted successfully";
        header("Location: admin_booking.php"); // Redirect to admin donations view after deletion
    } else {
        echo "Error deleting food donation: " . $conn->error;
    }
} else {
    echo "Invalid request";
    exit;
}
?>
