<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin@123') {
    header("Location: userloginform.php");
    exit;
}

include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming fields for donation_id and amount
    $donation_id = $_POST['donation_id'];
    $amount = $_POST['amount'];

    $sql = "UPDATE money_donations SET amount='$amount' WHERE donation_id='$donation_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Money donation details updated successfully";
        header("Location: admin_booking.php"); // Redirect to admin money donations view

    } else {
        echo "Error updating money donation details: " . $conn->error;
    }
}

// Fetch money donation details based on donation ID from the URL parameter
if (isset($_GET['id'])) {
    $donation_id = $_GET['id'];
    $sql = "SELECT * FROM money_donations WHERE donation_id='$donation_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Money donation not found";
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
    <title>Money Donation Update</title>
    <link rel="stylesheet" href="regform.css">
</head>
<body>
    <div class="container">
        <h2>Update Money Donation</h2>
        <form id="registration-form" method="POST" action="">
            <input type="hidden" name="donation_id" value="<?php echo $row['donation_id']; ?>">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" value="<?php echo $row['amount']; ?>" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
