<?php
// اتصال به پایگاه داده
include 'db.php';

// چک کردن اینکه درخواست از نوع POST است
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت نام کاربری از فرم
    $username = $_POST['username'];

    // بررسی اینکه آیا کاربر قبلاً وارد رقابت شده است یا خیر
    $check_query = "SELECT * FROM competition WHERE username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // کاربر قبلاً ثبت‌نام کرده است
        echo "شما قبلاً وارد رقابت شده‌اید.";
    } else {
        // ثبت کاربر جدید در رقابت
        $start_date = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO competition (username, start_date, days_count) VALUES (?, ?, 0)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ss', $username, $start_date);

        if ($stmt->execute()) {
            // هدایت به صفحه لیگ پس از موفقیت‌آمیز بودن ثبت‌نام
            header("Location: league.php");
            exit();
        } else {
            echo "مشکلی در ثبت‌نام رخ داد.";
        }
    }
}
?>