<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "eventplanner";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die($conn->connect_error);
}

// echo "Connection Successful";