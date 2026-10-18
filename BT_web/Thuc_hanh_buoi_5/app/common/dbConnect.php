<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_cart";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// mysqli_close($conn);
// charset, tránh lỗi Tiếng Việt
mysqli_set_charset($conn, "utf8mb4");
?>