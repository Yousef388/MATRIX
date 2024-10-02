<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "ثبت‌نام با موفقیت انجام شد!";
    } else {
        echo "خطا: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
</head>
<body>
    <h1>ثبت‌نام</h1>
    <form method="post" action="">
        <label for="username">نام کاربری:</label>
        <input type="text" name="username" required>
        <label for="password">رمز عبور:</label>
        <input type="password" name="password" required>
        <button type="submit">ثبت‌نام</button>
    </form>
</body>
</html>
