<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    echo "لطفا ابتدا وارد شوید!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_content = $_POST['post_content'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO posts (username, content) VALUES ('$username', '$post_content')";

    if ($conn->query($sql) === TRUE) {
        echo "پست شما با موفقیت ارسال شد!";
    } else {
        echo "خطا در ارسال پست: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ارسال پست</title>
</head>
<body>
    <h2>ارسال پست</h2>
    <form action="post.php" method="post">
        <textarea name="post_content" rows="5" cols="40" required></textarea>
        <button type="submit">ارسال</button>
    </form>
</body>
</html>
