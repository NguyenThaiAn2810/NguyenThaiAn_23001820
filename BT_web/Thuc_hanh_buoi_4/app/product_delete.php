<?php
// app/product_delete.php
include 'view/header.php';
include_once 'model/product.php';

// Kiểm tra ID
if (!isset($_GET['id'])) {
    die("<h3>Lỗi: Không cung cấp ID sản phẩm!</h3> <a href='product_list.php'>Quay lại</a>");
}

$id = $_GET['id'];
$product = getProductById($id);

// Thông báo nếu sản phẩm không tồn tại
if (!$product) {
    die("<h3>Sản phẩm không tồn tại trong hệ thống!</h3> <a href='product_list.php'>Quay lại</a>");
}

// Nếu người dùng ấn nút "Xác nhận xóa"
if (isset($_POST['confirm_delete'])) {
    if (deleteProduct($id)) {
        echo "<h3 style='color:green;'>Đã xóa sản phẩm '{$product['name']}' thành công!</h3>";
        echo "<a href='product_list.php'>Về danh sách</a>";
        include 'view/footer.php';
        exit(); // Dừng trang tại đây
    } else {
        echo "<h3 style='color:red;'>Lỗi khi xóa sản phẩm.</h3>";
    }
}
?>

    <h2>Xóa sản phẩm</h2>
    <div style="border: 1px solid red; padding: 15px; width: fit-content;">
        <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
        <ul>
            <li><b>Tên sản phẩm:</b> <?php echo $product['name']; ?></li>
            <li><b>Giá:</b> <?php echo $product['price']; ?></li>
        </ul>

        <form method="POST" action="">
            <button type="submit" name="confirm_delete" style="color: red;">Xác nhận Xóa</button>
            <a href="product_list.php" style="margin-left: 15px;">Hủy / Quay lại</a>
        </form>
    </div>

<?php include 'view/footer.php'; ?>