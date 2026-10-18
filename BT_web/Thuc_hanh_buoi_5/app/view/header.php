<!-- app/view/header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống Quản lý Giỏ Hàng</title>
</head>
<body>
<h1>Quản Lý Giỏ Hàng</h1>

<nav>
    <!-- Chỉ hiển thị menu quản lý nếu đã đăng nhập -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <span>Xin chào, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>! | </span>
        <a href="index.php">[Trang Chủ]</a> |
        <a href="product_list.php">[Danh Sách Sản Phẩm]</a> |
        <a href="product_add.php">[Thêm Sản Phẩm]</a> |
        <a href="logout.php" style="color: red;">[Đăng Xuất]</a>
    <?php else: ?>
        <a href="login.php">[Đăng Nhập]</a> |
        <a href="register.php">[Đăng Ký]</a>
    <?php endif; ?>
</nav>
<hr>
<div>
