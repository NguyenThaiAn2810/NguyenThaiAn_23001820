<?php
// app/product_list.php
include 'view/header.php';
include_once 'model/product.php';

$products = getAllProducts();
?>

    <h2>Danh sách sản phẩm</h2>
    <a href="product_add.php">Thêm sản phẩm mới</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
        <?php if (empty($products)): ?>
            <tr><td colspan="5">Chưa có sản phẩm nào.</td></tr>
        <?php else: ?>
            <?php foreach ($products as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>
                        <a href="product_edit.php?id=<?php echo $row['id']; ?>">[Sửa]</a>
                        <a href="product_delete.php?id=<?php echo $row['id']; ?>">[Xóa]</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

<?php include 'view/footer.php'; ?>