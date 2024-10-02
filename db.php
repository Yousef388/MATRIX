<?php
$servername = "localhost";  // معمولا "localhost" است
$username = "root";  // در XAMPP نام کاربری پیش‌فرض "root" است
$password = "";  // رمز عبور پیش‌فرض برای کاربر "root" خالی است
$dbname = "self_control";  // نام پایگاه داده‌ای که در phpMyAdmin ساخته‌ای

// ایجاد اتصال به پایگاه داده
$conn = new mysqli($servername, $username, $password, $dbname);

// چک کردن اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
