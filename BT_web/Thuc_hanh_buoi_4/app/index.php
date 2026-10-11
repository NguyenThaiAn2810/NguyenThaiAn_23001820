<?php
// app/index.php
// Gọi file header để hiển thị phần đầu trang
include 'view/header.php';
?>

    <h2>Bảng điều khiển</h2>

    <p>Hệ thống quản lý các sản phẩm trong giỏ hàng (Shopping cart).</p>
    <p>Vui lòng chọn một trong các chức năng dưới đây để bắt đầu:</p>

    <ul>
        <li>
            <a href="product_list.php"><strong>Xem và quản lý danh sách sản phẩm</strong></a>
            (Bao gồm chức năng sửa và xóa)
        </li>
        <li>
            <a href="product_add.php"><strong>Thêm sản phẩm mới</strong></a>
        </li>
    </ul>

    <br><br>

<?php
// Gọi file footer để đóng trang
include 'view/footer.php';
?>