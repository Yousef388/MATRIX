<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ماتریکس</title>
    <!-- اضافه کردن فایل CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>ماتریکس ترک خودارضایی</h1>
    </header>

    <nav>
        <a href="#register">ثبت‌نام</a>
        <a href="#login">ورود</a>
    </nav>

    <section id="register">
        <h2>ثبت‌نام</h2>
        <form action="register.php" method="POST">
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">ثبت‌نام</button>
        </form>
    </section>

    <section id="login">
        <h2>ورود</h2>
        <form action="login.php" method="POST">
            <label for="login-username">نام کاربری:</label>
            <input type="text" id="login-username" name="login-username" required>
            <label for="login-password">رمز عبور:</label>
            <input type="password" id="login-password" name="login-password" required>
            <button type="submit">ورود</button>
        </form>
    </section>

</body>
</html>
