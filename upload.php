<?php
// Start a session to use session variables
session_start();

// Include the database configuration file
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $image = file_get_contents($_FILES['image']['tmp_name']);

    // Prepare an SQL statement to insert the user details
    $sql = "INSERT INTO users (username, email, password, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $image);

    if ($stmt->execute()) {
        // If the insert is successful, redirect to a page to view all users
        header("Location: view_users.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}