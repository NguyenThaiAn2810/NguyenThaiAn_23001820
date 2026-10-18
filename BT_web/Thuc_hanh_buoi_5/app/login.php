<?php
// app/login.php
session_start();
include 'view/header.php';
include_once 'common/dbConnect.php';

// Nếu đã đăng nhập rồi thì đẩy thẳng sang trang danh sách
if (isset($_SESSION['user_id'])) {
    header("Location: product_list.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        global $conn;
        // Tìm user theo username
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Kiểm tra mật khẩu
            if (password_verify($password, $row['password'])) {
                // Đăng nhập thành công, lưu Session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                header("Location: product_list.php"); // Chuyển hướng
                exit();
            } else {
                $error = "Mật khẩu không chính xác!";
            }
        } else {
            $error = "Tên đăng nhập không tồn tại!";
        }
    }
}
?>

    <h2>Đăng nhập hệ thống</h2>
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <label>Tên đăng nhập:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Mật khẩu:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Đăng nhập</button>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </form>

<?php include 'view/footer.php'; ?>