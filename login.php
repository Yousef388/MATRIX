<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "رمز عبور اشتباه است.";
        }
    } else {
        echo "نام کاربری یافت نشد.";
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود</title>
</head>
<body>
    <h1>ورود</h1>
    <form method="post" action="">
        <label for="username">نام کاربری:</label>
        <input type="text" name="username" required>
        <label for="password">رمز عبور:</label>
        <input type="password" name="password" required>
        <button type="submit">ورود</button>
    </form>
</body>
</html>
