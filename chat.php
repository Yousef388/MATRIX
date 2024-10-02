<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_content'])) {
    $message = $_POST['message_content'];
    $sql = "INSERT INTO messages (content, sender) VALUES ('$message', '{$_SESSION['username']}')";
    $conn->query($sql);
}

$messages = $conn->query("SELECT * FROM messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>گفتگو</title>
</head>
<body>
    <h1>گفتگو همگانی</h1>
    <form method="post" action="">
        <textarea name="message_content" required></textarea>
        <button type="submit">ارسال پیام</button>
    </form>

    <h2>پیام‌ها</h2>
    <?php while ($msg = $messages->fetch_assoc()): ?>
        <div>
            <strong><?php echo $msg['sender']; ?></strong>: <?php echo $msg['content']; ?>
        </div>
    <?php endwhile; ?>
</body>
</html>
