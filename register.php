<?php
// --------- PHP PART (TOP OF FILE) ----------
$success = "";
$error   = "";

// Run this only when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    $conn = new mysqli("localhost", "root", "", "mydatabase");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $sql  = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        // Insert new user
        $insert = "INSERT INTO users (username, email, password)
                   VALUES ('$username', '$email', '$hashedPassword')";

        if ($conn->query($insert) === TRUE) {
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<h2>User Registration (Single Page)</h2>

<!-- Show messages -->
<?php if ($success != ""): ?>
    <p style="color:green;"><?php echo $success; ?></p>
<?php endif; ?>

<?php if ($error != ""): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<!-- HTML FORM -->
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
