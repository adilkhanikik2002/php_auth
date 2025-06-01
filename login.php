<?php
session_start(); // Start session
include "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Compare plain password (you can replace with password_verify later)
        if ($password === $row['password']) {
            // Save user info in session
            $_SESSION['username'] = $row['username'];

            // Redirect to welcome.php
            header("Location: welcome.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Login</h2>
<form method="post" action="login.php">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
    <p style="margin-top:10px; text-align:center;">
        Don't have an account? <a href="register.php">Register here</a>
    </p>
</form>

<?php if ($message): ?>
    <p style="text-align:center; margin-top:20px; color:red;"><?= $message ?></p>
<?php endif; ?>

</body>
</html>
