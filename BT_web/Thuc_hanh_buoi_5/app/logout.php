<?php
// app/logout.php
session_start();
session_unset(); // Xóa các biến session
session_destroy(); // Hủy session
header("Location: login.php"); // Chuyển về trang đăng nhập
exit();
?>
