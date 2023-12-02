<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin@123') {
    header("Location: userloginform.php");
    exit;
}

include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming fields for donation_date and food_item
    $donation_id = $_POST['donation_id'];
    $donation_date = $_POST['donation_date'];
    $food_item = $_POST['food_item'];

    $sql = "UPDATE food_donations SET donation_date='$donation_date', food_item='$food_item' WHERE donation_id='$donation_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Food donation details updated successfully";
        header("Location: admin_booking.php"); // Redirect to admin food donations view

    } else {
        echo "Error updating food donation details: " . $conn->error;
    }
}

// Fetch food donation details based on donation ID from the URL parameter
if (isset($_GET['id'])) {
    $donation_id = $_GET['id'];
    $sql = "SELECT * FROM food_donations WHERE donation_id='$donation_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Food donation not found";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donation Update</title>
    <link rel="stylesheet" href="regform.css">
</head>
<body>
    <div class="container">
        <h2>Update Food Donation</h2>
        <form id="registration-form" method="POST" action="">
            <input type="hidden" name="donation_id" value="<?php echo $row['donation_id']; ?>">
            <div class="form-group">
                <label for="donation_date">Donation Date:</label>
                <input type="date" id="donation_date" name="donation_date" value="<?php echo $row['donation_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="food_item">Food Item:</label>
                <input type="text" id="food_item" name="food_item" value="<?php echo $row['food_item']; ?>" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
