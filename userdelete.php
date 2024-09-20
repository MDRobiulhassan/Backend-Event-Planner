<?php
include("config.php");

if (isset($_GET['deleteID'])) {
    $user_id = $_GET['deleteID'];

    // First, delete the record from the `userdetails` table
    $sql1 = "DELETE FROM userdetails WHERE user_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $user_id);
    $stmt1->execute();

    // Then, delete the record from the `user` table
    $sql2 = "DELETE FROM user WHERE user_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $user_id);
    
    if ($stmt2->execute()) {
        header('Location: usertable.php');
        exit();
    } else {
        die("Error deleting user: " . $stmt2->error);
    }
} else {
    echo "Invalid Request.";
}
?>
