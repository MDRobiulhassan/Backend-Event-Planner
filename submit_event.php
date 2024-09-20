<?php
session_start(); // Start the session

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to create an event.";
        exit();
    }

    $eventType = $_POST['eventType'];
    $eventName = $_POST['eventName'];
    $venue = $_POST['venue'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventtime'];
    $user_id = $_SESSION['user_id']; // Retrieve user ID from the session

    // Check if the event date is at least 20 days in the future
    $currentDate = new DateTime();
    $eventDateObj = new DateTime($eventDate);
    $interval = $currentDate->diff($eventDateObj);

    if ($interval->days < 20 || $currentDate > $eventDateObj) {
        echo "<script>alert('The event date must be at least 20 days in the future.'); window.location.href='eventcreate.php';</script>";
        exit();
    }

    // Check if the venue is available on the selected date
    $stmt = $conn->prepare("SELECT COUNT(*) FROM Event WHERE venue = ? AND date = ?");
    $stmt->bind_param("ss", $venue, $eventDate);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "<script>alert('The selected venue is not available on this date.'); window.location.href='eventcreate.php';</script>";
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Event (title, description, date, time, venue, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $eventName, $eventType, $eventDate, $eventTime, $venue, $user_id);

    if ($stmt->execute()) {
        // Redirect to dashboard.php after successful event creation
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
