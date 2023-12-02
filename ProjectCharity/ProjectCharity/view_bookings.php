<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: userlogin.php");
    exit;
}

include 'db.php';

$user_id = $_SESSION['username'];

// Fetch food donations
$sql_food = "SELECT donation_date, food_item FROM food_donations WHERE user_id = '$user_id'";
$result_food = $conn->query($sql_food);

// Fetch money donations
$sql_money = "SELECT donation_id, amount FROM money_donations WHERE user_id = '$user_id'";
$result_money = $conn->query($sql_money);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Food Donations</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('food.jpeg') center/cover no-repeat fixed;
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
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    .booking-container {
        max-width: 600px;
        margin: 0 auto;
    }


    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    
    
 <div class="booking-container">
    <div id="header">
        <button id="username-btn"><?php echo $_SESSION['username']; ?></button>
        <button><a href="donationpg.php">Home</a></button>
        <table border="1">
          <thead>
             <tr>
               <th colspan="2">Food Donations</th>
            </tr>
            <tr>
              <th>Date</th>
               <th>Time</th>
            </tr>
           </thead>
        <tbody>
            <?php
        // Display food donations
        if ($result_food->num_rows > 0) {
            while ($row = $result_food->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['donation_date'] . "</td>";
                echo "<td>" . $row['food_item'] . "</td>";
                echo "</tr>";
            }
        } ?>
         </tbody>
      </table>

      <table border="1">
       <thead>
        <tr>
            <th colspan="2">Money Donations</th>
        </tr>
        <tr>
            <th>Donation ID</th>
            <th>Amount</th>
        </tr>
      </thead>
    <tbody>
        <?php
        // Display money donations
        if ($result_money->num_rows > 0) {
            while ($row = $result_money->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['donation_id'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "</tr>";
            }
        } else if ($result_food->num_rows == 0 && $result_money->num_rows == 0) {
            // No donations found
            echo "<tr><td colspan='2'>No donations found.</td></tr>";
        }
        ?>
    </tbody>
</table>

        <button><a href="donationpg.php">Back To Donation</a></button>
    </div>


</html>
