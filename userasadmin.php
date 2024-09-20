<?php
include("config.php");

// Check if the AdminID is set
if (isset($_GET['AdminID'])) {
    $user_id = $_GET['AdminID'];

    // Prepare SQL queries to retrieve the user data
    $sql = "SELECT name, email FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];

        // Secure password generation (replace with the actual password logic or form input)
        $default_password = 'Admin@123'; // Example password (you can replace this)
        $hashed_password = password_hash($default_password, PASSWORD_BCRYPT); // Hash the password securely

        // Add the user to the admin table with a hashed password
        $sql_add_admin = "INSERT INTO admin (user_id, name, email, password) VALUES (?, ?, ?, ?)";
        $stmt_add_admin = $conn->prepare($sql_add_admin);
        $stmt_add_admin->bind_param("isss", $user_id, $name, $email, $hashed_password);
        if ($stmt_add_admin->execute()) {
            // Update user table to set is_admin to 1
            $sql_update_user = "UPDATE user SET is_admin = 1 WHERE user_id = ?";
            $stmt_update_user = $conn->prepare($sql_update_user);
            $stmt_update_user->bind_param("i", $user_id);
            $stmt_update_user->execute();

            // Redirect to the admin display page
            header('Location: admindisplay.php');
            exit();
        } else {
            echo "Failed to add user to the admin table.";
        }

        $stmt_add_admin->close();
        $stmt_update_user->close();
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
