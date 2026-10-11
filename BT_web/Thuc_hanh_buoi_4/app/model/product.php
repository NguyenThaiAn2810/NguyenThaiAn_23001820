<?php
// app/model/product.php
include_once __DIR__ . '/../common/dbConnect.php';

function getAllProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    $products = [];
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    return $products; // Trả về mảng để file giao diện sử dụng
}

function getProductById($id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Trả về 1 sản phẩm
    }
    return null;
}

function addProduct($name, $price, $quantity) {
    global $conn;
    // Tên (string) phải được bọc trong nháy đơn
    $sql = "INSERT INTO products (name, price, quantity) VALUES ('$name', $price, $quantity)";
    return mysqli_query($conn, $sql);
}

function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $sql = "UPDATE products SET name='$name', price=$price, quantity=$quantity WHERE id=$id";
    return mysqli_query($conn, $sql);
}

function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id=$id";
    return mysqli_query($conn, $sql);
}
?>