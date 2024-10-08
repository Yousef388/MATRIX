﻿<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "self_control";

// اتصال به پایگاه داده
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['message']) && isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $message = $conn->real_escape_string($data['message']);

        $sql = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Message not set or user not logged in']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>
