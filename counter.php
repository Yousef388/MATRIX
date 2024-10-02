<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>روزشمار</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center">روزشمار</h2>
            <form action="counter.php" method="post" class="text-center">
                <button type="submit" name="start" class="btn btn-primary">شروع روزشمار</button>
                <button type="submit" name="reset" class="btn btn-warning">شروع مجدد</button>
            </form>
            <div class="mt-4">
                <?php
                include 'db.php';
                session_start();

                if (!isset($_SESSION['username'])) {
                    echo "لطفا ابتدا وارد شوید!";
                    exit();
                }

                $username = $_SESSION['username'];

                // شروع زمان
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['start'])) {
                        $start_date = date('Y-m-d H:i:s'); // زمان فعلی

                        // ذخیره زمان شروع
                        $sql = "INSERT INTO counters (username, start_date) VALUES ('$username', '$start_date')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success'>زمان شروع ثبت شد!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>خطا: " . $conn->error . "</div>";
                        }
                    }

                    if (isset($_POST['reset'])) {
                        // حذف تمامی رکوردها برای کاربر
                        $sql = "DELETE FROM counters WHERE username='$username'";
                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success'>روزشمار ریست شد!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>خطا: " . $conn->error . "</div>";
                        }
                    }
                }

                // محاسبه تعداد روزها، ساعت‌ها، دقیقه‌ها و ثانیه‌ها
                $sql = "SELECT * FROM counters WHERE username='$username'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if ($row) {
                    $start_date = new DateTime($row['start_date']);
                    $current_date = new DateTime();
                    $interval = $start_date->diff($current_date);

                    // تعداد روزها، ساعت‌ها، دقیقه‌ها و ثانیه‌ها
                    $days_count = $interval->days;
                    $hours_count = $interval->h;
                    $minutes_count = $interval->i;
                    $seconds_count = $interval->s;

                    echo "<div class='alert alert-info'>شما {$days_count} روز، {$hours_count} ساعت، {$minutes_count} دقیقه و {$seconds_count} ثانیه از تاریخ {$row['start_date']} گذشته‌اید.</div>";
                } else {
                    echo "<div class='alert alert-warning'>زمان شروع ثبت نشده است.</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>