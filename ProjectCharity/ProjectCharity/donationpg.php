<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: userloginform.php"); // Replace with your login page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif; /* Changed the font to 'Roboto' */
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        #header {
            display: flex;
            justify-content: flex-end; /* Align buttons to the right */
            align-items: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }

        #header button {
            background-color: #e74c3c; /* Red color */
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px; /* Add margin between the buttons */
        }

        #donation-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .half {
            flex: 1;
            overflow: hidden;
            position: relative;
        }

        .money-donation {
            background-image: url('money.jpeg'); /* Replace with your image */
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
        }

        .food-donation {
            background-image: url('food.jpeg'); /* Replace with your image */
            background-size: cover;
            background-position: center;
            color: #27ae60; /* Green color */
            padding: 20px;
            box-sizing: border-box;
        }

        .donate-button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: block;
            width: 200px;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            background-color: #e74c3c; /* Red color */
            color: #fff;
            border-radius: 5px;
            font-size: 18px;
        }

        h2, p {
            text-align: left; /* Align text on the left side */
            font-size: 24px; /* Increased font size */
            line-height: 1.5; /* Improved readability with increased line height */
            margin: 0; /* Remove default margin */
        }

        p {
            font-size: 18px; /* Increased font size for the description */
            line-height: 1.5;
            width:45%;
            font-family: 'YourDecorativeFont', cursive; /* Replace with your decorative font */
        }
    </style>
</head>
<body>
    <div id="header">
        <button id="username-btn"><?php echo $_SESSION['username']; ?></button>
        <button><a href="logout.php">Sign Out</a></button> <!-- Create a logout.php file for logout logic -->
        <button><a href="view_bookings.php">View  Donations</a></button> 
        <button><a href="userupdate.php">User Update</a></button>

    </div>

    <div id="donation-container">
        <div class="half money-donation">
            <h2>Money Donation</h2>
            <p>Support our cause by making a monetary donation. Your contribution helps us make a positive impact on the community.</p>
            <a href="moneydonation.php" class="donate-button">Money Donation</a>
        </div>

        <div class="half food-donation">
            <h2>Food Donation</h2>
            <p>Make a difference in someone's life by contributing to our food donation program. Your generosity ensures that no one goes hungry.</p>
            <a href="fooddonation.php" class="donate-button">Food Donation Booking</a>
        </div>
    </div>

</body>
</html>
