<?php
session_start();

// Check if the user is logged in as admin, otherwise redirect to login
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin@123') {
    header("Location: userloginform.php"); // Redirect to admin login page
    exit;
}

include 'db.php'; // Include the database connection file

// Fetch all user details from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
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
            background: url('cimage.png') center/cover no-repeat fixed;
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
        <h2>User Details</h2>
        <button><a href="admin_dashboard.php">Home</a></button>
        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        // Add more columns for other details if required

                        // Add update and delete options as links/buttons for each user
                        echo "<td>";
                        echo "<a href='update_user.php?id=" . $row['user_id'] . "'>Update</a> ";
                        echo "<a href='delete_user.php?id=" . $row['user_id'] . "'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
