<?php
session_start();
include('db.php');

if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Unauthorized access";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameToBlock = mysqli_real_escape_string($conn, $_POST['username']);

    // به‌روزرسانی وضعیت مسدود کردن کاربر در پایگاه داده
    $query = "UPDATE users SET is_blocked = 1 WHERE username = '$usernameToBlock'";
    
    if (mysqli_query($conn, $query)) {
        echo "کاربر مسدود شد.";
    } else {
        echo "خطا در مسدود کردن کاربر: " . mysqli_error($conn);
    }
}
?>
