<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_content'])) {
    $content = $_POST['post_content'];
    $sql = "INSERT INTO posts (content, author) VALUES ('$content', '{$_SESSION['username']}')";
    $conn->query($sql);
}

$posts = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>داشبورد</title>
</head>
<body>
    <h1>خوش آمدید، <?php echo $_SESSION['username']; ?></h1>
    <form method="post" action="">
        <textarea name="post_content" required></textarea>
        <button type="submit">ارسال پست</button>
    </form>

    <h2>پست‌ها</h2>
    <?php while ($post = $posts->fetch_assoc()): ?>
        <div>
            <strong><?php echo $post['author']; ?></strong>: <?php echo $post['content']; ?>
        </div>
    <?php endwhile; ?>
</body>
</html>
