<?php
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

// بررسی اینکه درخواست از نوع POST است
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت داده‌های JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // بررسی اینکه آیا پیام و نام کاربری موجود است یا خیر
    if (isset($data['message']) && isset($_SESSION['username'])) {
        $username = $_SESSION['username']; // نام کاربری از سشن
        $message = $conn->real_escape_string($data['message']); // پاکسازی پیام

        // درج پیام در پایگاه داده
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
    // اگر درخواست POST نباشد
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// بستن اتصال به پایگاه داده
$conn->close();
?>
