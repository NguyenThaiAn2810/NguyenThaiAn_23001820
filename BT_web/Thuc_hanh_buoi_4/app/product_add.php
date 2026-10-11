<?php
// app/product_add.php
include 'view/header.php';
include_once 'model/product.php';

$error = "";
$success = "";

// Nếu form được Submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Yêu cầu: Kiểm tra dữ liệu
    if (empty($name)) {
        $error = "Tên sản phẩm không được rỗng!";
    } elseif ($price <= 0) {
        $error = "Giá sản phẩm phải lớn hơn 0!";
    } elseif ($quantity < 0) {
        $error = "Số lượng không được nhỏ hơn 0!";
    } else {
        // Hợp lệ, gọi hàm Model để lưu
        if (addProduct($name, $price, $quantity)) {
            $success = "Thêm sản phẩm thành công!";
        } else {
            $error = "Có lỗi xảy ra khi thêm vào cơ sở dữ liệu.";
        }
    }
}
?>

    <h2>Thêm sản phẩm</h2>
    <a href="product_list.php">Về danh sách</a>
    <br><br>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST" action="">
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value=""><br><br>

        <label>Giá:</label><br>
        <input type="number" step="0.01" name="price" value=""><br><br>

        <label>Số lượng:</label><br>
        <input type="number" name="quantity" value=""><br><br>

        <button type="submit">Thêm mới</button>
    </form>

<?php include 'view/footer.php'; ?>