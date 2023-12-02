<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin@123') {
    header("Location: admin_login.php");
    exit;
}

include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming a form with fields for username, email, address, gender, and password
    $user_id = $_POST['user_id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile-number'];

    $sql = "UPDATE users SET username='$username', email='$email', address='$address', gender='$gender', password='$password', mobile_number='$mobile_number' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "User details updated successfully";
        header("Location: admin_view_users.php"); // Redirect to admin dashboard

    } else {
        echo "Error updating user details: " . $conn->error;
    }
}

// Fetch user details based on user ID from the URL parameter
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found";
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
    <link rel="stylesheet" href="regform.css">
    <title>User Details Update</title>
</head>
<body>
    <div class="container">
        <h2>Update User details</h2>
        <form id="registration-form" method="POST" action="">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male" <?php if($row['gender'] === 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if($row['gender'] === 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if($row['gender'] === 'other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile-number">Mobile Number:</label>
                <input type="tel" id="mobile-number" name="mobile-number" value="<?php echo $row['mobile_number']; ?>" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
