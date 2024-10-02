<?php
// اتصال به پایگاه داده
include 'db.php';

// دریافت اطلاعات کاربران از پایگاه داده و محاسبه روزهای پاکی
$query = "SELECT id, username, start_date, DATEDIFF(NOW(), start_date) AS days_count FROM competition ORDER BY days_count DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیگ رقابت</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>لیگ رقابت</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>رتبه</th>
                    <th>نام کاربری</th>
                    <th>روزهای پاکی</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $rank = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $rank++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . $row['days_count'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>هیچ کاربری در رقابت نیست.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>