<?php
// app/register.php
session_start();
include 'view/header.php';
include_once 'common/dbConnect.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Tên đăng nhập và mật khẩu không được để trống!";
    } else {
        global $conn;

        // 1. Kiểm tra username đã tồn tại chưa
        $sql_check = "SELECT id FROM users WHERE username = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, "s", $username);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $error = "Tên đăng nhập này đã tồn tại!";
        } else {
            // 2. Mã hóa mật khẩu và lưu vào DB
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt_insert, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt_insert)) {
                $success = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
            } else {
                $error = "Có lỗi xảy ra, vui lòng thử lại!";
            }
        }
    }
}
?>

<h2>Đăng ký tài khoản</h2>
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST" action="">
    <label>Tên đăng nhập:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Mật khẩu:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Đăng ký</button>
    <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
</form>

<?php include 'view/footer.php'; ?>
