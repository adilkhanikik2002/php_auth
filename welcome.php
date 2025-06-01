<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="text-align:center; margin-top:50px;">
        Welcome to Adil's Website, <?= htmlspecialchars($_SESSION['username']) ?>!
    </h1>

    <!-- Logout button on the next line -->
    <div style="text-align:center; margin-top:20px;">
        <form method="post" action="logout.php">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
    