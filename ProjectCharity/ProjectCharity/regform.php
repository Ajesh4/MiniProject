<?php
include 'db.php'; // Include the database connection file
$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $mobile_number = $_POST['mobile-number'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errorMessage = "Passwords do not match";
    }else {
    // SQL query to insert user data into the database
         $sql = "INSERT INTO users (username, address, email, gender, password, mobile_number) 
            VALUES ('$name', '$address', '$email', '$gender', '$password', '$mobile_number')";

         if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to login page
            header("Location: userloginform.php");
             exit;
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
    <link rel="stylesheet" href="regform.css">
    <title>User Registration</title>
    <script>
        // JavaScript function to display an alert if passwords don't match
        function checkPasswords() {
            var errorMessage = "<?php echo $errorMessage; ?>";
            if (errorMessage) {
                alert(errorMessage);
            }
        }
    </script>
</head>
<body onload="checkPasswords()">
    <div class="container">
        <h2>User Registration</h2>
        <form id="registration-form" method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="form-group">
                <label for="mobile-number">Mobile Number:</label>
                <input id="contact"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        name="mobile-number" type="text" class="form-control" placeholder="mobile-number" minlength="10"
                        maxlength="10" required pattern="[0-9]{10}">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>