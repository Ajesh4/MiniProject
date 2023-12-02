<?php
session_start(); // Start the session
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['username']; // Replace 'user_id' with the actual column name in your 'users' table
    $amount = $_POST['amount'];
    // You might want to add additional validation for other form fields
    
    // Prepare and execute the SQL query to insert the donation details
    $stmt = $conn->prepare("INSERT INTO money_donations (user_id, amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $user_id, $amount);

    if ($stmt->execute()) {
        echo "<script>alert('Donation successful')</script>";
        // Redirect the user to a success page or perform other actions as needed
        header("Location: donationpg.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Donation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .donation-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select, button {
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="donation-container">
    <h2>Charity Donation</h2>
    <form id="donationForm" method="POST" action="">
        <label for="amount">Donation Amount (Rupee):</label>
        <input type="number" id="amount" name="amount" min="1" required>

        
        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" name="cardNumber" placeholder="**** **** **** ****">

        <label for="expiryDate">Expiry Date:</label>
        <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY">

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" placeholder="123" >

        <button type="submit">Donate Now</button>
    </form>
</div>

</body>
</html>
