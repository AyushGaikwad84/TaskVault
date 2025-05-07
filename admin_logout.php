<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="employee.css">
    <title>Logout</title>
</head>
<body>
    <h2>Logout</h2>
    <p>Are you sure you want to log out?</p>
    <button onclick="window.location.href='home.html'">Yes, Logout</button>
</body>
</html>

<?php

session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location: home.html"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy the session
    header("Location: home.html"); // Redirect to homepage
    exit();
}

?>
