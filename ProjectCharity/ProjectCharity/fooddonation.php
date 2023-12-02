<?php
session_start(); // Start the session
// After verifying user credentials and login success
// Set the 'user_id' in the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: userlogin.php"); // Replace with your login page
    exit;
}

include 'db.php'; // Include the database connection file


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time_slot = $_POST['time_slot'];
    $user_id = $_SESSION['username'];

    // Check if the user has already booked for the selected date and time
    $checkQuery = "SELECT * FROM food_donations WHERE  donation_date = '$date' AND food_item = '$time_slot'";
    $result = $conn->query($checkQuery);
   
    if ($result->num_rows > 0) {
        echo "<script>alert('Slot Already booked.')</script>";
    }else {
        // Proceed with the booking
        $sql = "INSERT INTO food_donations (user_id, donation_date, food_item) 
                VALUES ('$user_id', '$date', '$time_slot')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking successful')</script>";
            header("Location: donationpg.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donation Booking</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('fbooking.jpg') center/cover no-repeat fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333; /* Darkened text color */
        }

        .booking-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select, button {
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        select:hover {
            background-color: #45a049;
        }

        button:hover {
            background-color: #45a049;
        }

        h2 {
            color: #333;
        }

        p {
            color: #333;
            margin-bottom: 10px;
        }

        ol, ul {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
    
</head>
<body>
    

    <div class="booking-container">
    <div id="header">
        <button id="username-btn"><?php echo $_SESSION['username']; ?></button>
        <button><a href="donationpg.php">Home</a></button>
        <button><a href="logout.php">Sign Out</a></button> <!-- Create a logout.php file for logout logic -->

    </div>
    <h2>Food Donation Booking</h2>
    <p>Welcome to our organization! We appreciate your generosity.</p>
    <p><strong>Instructions:</strong></p>
    <ol>
        <li>The organization contains 35 members.</li>
        <li>Food should be provided before the following times:</li>
        <ul>
            <li>Breakfast - 8:30</li>
            <li>Lunch - 12:30</li>
            <li>Dinner - 8:00</li>
        </ul>
        <li>In case of any difficulty or issues, inform the authority at least two days before the booked date to cancel the booking.</li>
        <li>We allow and encourage the presence of donors and their families to spend time with us during the time of food serving.</li>
    </ol>
    <div class="booking-container">
        <!-- ... -->
        <form id="bookingForm" method="POST" action="">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Select Time:</label>
        <select id="time_slot" name="time_slot" required>
          <option value="Select">Select</option>
          <option value="breakfast">Breakfast</option>
          <option value="lunch">Lunch</option>
          <option value="dinner">Dinner</option>
        </select>

        
       
        <button type="submit">Book Now</button>
        </form>
    </div>
    </form>
    </div>

</body>
</html>
