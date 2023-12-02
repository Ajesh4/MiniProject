<?php
include 'db.php'; // Include the database connection file
$errorMessage = "";

session_start(); // Starting the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Define admin credentials
    $adminUsername = 'admin@123';
    $adminPassword = 'admin@123';

    // Check if the entered credentials match the admin credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        // Authentication successful, set session variables for admin
        $_SESSION['user_id'] = 'admin'; // You can set any identifier for admin
        $_SESSION['username'] = $username;
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit;
    }
    // SQL query to check if the username and password match
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful, set session variables and redirect to dashboard
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: donationpg.php"); // Replace with your dashboard file
        exit;
    } else {
        $errorMessage = "Invalid Username or Password match";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userlogin.css">
    <title>User Login</title>
    <script>
        
        function login() {
            var errorMessage = "<?php echo $errorMessage; ?>";
            if (errorMessage) {
                alert(errorMessage);
            }
        }
    </script>
</head>
<body onload="login()">
    <div class="container">
        <form id="login-form" class="login-form" method="POST" action="">
            <h2>User Login</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <a href="index.php" class="donate-button">Back</a>
        </form>
        <div class="create-account">
            <p>Don't have an account? <a href="regform.php">Create a new account</a></p>
        </div>
    </div>
</body>
</html>
