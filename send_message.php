<?php
session_start();
include 'db.php';

if (isset($_POST['message'])) {
    $user_id = $_SESSION['user_id'];
    $message = $conn->real_escape_string($_POST['message']);
    
    $sql = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo "پیام ارسال شد.";
    } else {
        echo "خطا در ارسال پیام: " . $conn->error;
    }
}

$conn->close();
?>
