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
    return $products;
}

function getProductById($id) {
    global $conn;
    // gắn vào tham số ? để tránh SQL Injection
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Trả về 1 sản phẩm
    }
    return null;
}

function addProduct($name, $price, $quantity) {
    global $conn;
    // Sử dụng tham số ? cho toàn bộ giá trị
    $sql = "INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdi", $name, $price, $quantity);
    return mysqli_stmt_execute($stmt);
}

function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $sql = "UPDATE products SET name=?, price=?, quantity=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdii", $name, $price, $quantity, $id);
    return mysqli_stmt_execute($stmt);
}

function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
?>