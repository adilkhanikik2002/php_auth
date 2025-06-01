<?php
include "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $message = "Email already exists.";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql)) {
            $message = "Registered successfully. <a href='login.php'>Login now</a>";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Register Your Self</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Register</h2>
<form method="post" action="register.php">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
    <p style="margin-top:10px; text-align:center;">
        Already have an account? <a href="login.php">Login here</a>
    </p>
</form>

<!-- Message shown below the form -->
<?php if ($message): ?>
    <p style="text-align:center; margin-top:20px; color:red;"><?= $message ?></p>
<?php endif; ?>

</body>
</html>
