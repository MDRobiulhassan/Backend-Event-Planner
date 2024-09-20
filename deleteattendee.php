<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['attendee_id']) || !isset($_GET['event_id'])) {
    header("Location: dashboard.php");
    exit;
}

$attendee_id = $_GET['attendee_id'];
$event_id = $_GET['event_id'];
$user_id = $_SESSION['user_id'];

$sql_validate_event = "SELECT event_id FROM Event WHERE event_id = ? AND user_id = ?";
$stmt_validate_event = $conn->prepare($sql_validate_event);
$stmt_validate_event->bind_param("ii", $event_id, $user_id);
$stmt_validate_event->execute();
$stmt_validate_event->store_result();

if ($stmt_validate_event->num_rows === 0) {
    header("Location: dashboard.php");
    exit;
}

$stmt_validate_event->close();

$sql_delete_attendee = "DELETE FROM Attendee WHERE attendee_id = ? AND event_id = ?";
$stmt_delete_attendee = $conn->prepare($sql_delete_attendee);
$stmt_delete_attendee->bind_param("ii", $attendee_id, $event_id);
$stmt_delete_attendee->execute();

if ($stmt_delete_attendee->affected_rows > 0) {
    header("Location: eventdetails.php?event_id=" . $event_id);
} else {
    header("Location: eventdetails.php?event_id=" . $event_id . "&error=delete_failed");
}

$stmt_delete_attendee->close();
$conn->close();
