<?php
// app/product_edit.php
include 'view/header.php';
include_once 'model/product.php';

$error = "";
$success = "";

// Lấy ID từ URL, nếu không có thì báo lỗi
if (!isset($_GET['id'])) {
    die("Không tìm thấy sản phẩm cần sửa!");
}

$id = $_GET['id'];
$product = getProductById($id);

if (!$product) {
    die("Sản phẩm không tồn tại!");
}

// Xử lý khi Submit Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (empty($name)) {
        $error = "Tên sản phẩm không được rỗng!";
    } elseif ($price <= 0) {
        $error = "Giá sản phẩm phải lớn hơn 0!";
    } elseif ($quantity < 0) {
        $error = "Số lượng không được nhỏ hơn 0!";
    } else {
        if (updateProduct($id, $name, $price, $quantity)) {
            $success = "Cập nhật sản phẩm thành công!";
            // Load lại data mới nhất
            $product = getProductById($id);
        } else {
            $error = "Lỗi khi cập nhật!";
        }
    }
}
?>

    <h2>Sửa sản phẩm</h2>
    <a href="product_list.php">Về danh sách</a>
    <br><br>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST" action="">
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="<?php echo $product['name']; ?>"><br><br>

        <label>Giá:</label><br>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>"><br><br>

        <label>Số lượng:</label><br>
        <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>"><br><br>

        <button type="submit">Cập nhật</button>
    </form>

<?php include 'view/footer.php'; ?>