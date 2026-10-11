# Bài Thực Hành 4 - Quản Lý Giỏ Hàng (PHP & MySQL)

## Hướng dẫn cài đặt và chạy hệ thống
Để chạy được giao diện HTML kết hợp PHP và Database, vui lòng thực hiện theo các bước sau:

**1. Chuẩn bị môi trường Web Server:**
- Bật module **Apache** và **MySQL** trên phần mềm XAMPP Control Panel.

**2. Import Cơ sở dữ liệu:**
- Truy cập vào `http://localhost/phpmyadmin`
- Tạo một cơ sở dữ liệu mới với tên exat là: `shopping_cart`
- Chọn tab **Import**, duyệt tìm đến file `shopping_cart.sql` có sẵn trong thư mục này và nhấn nút Import để tự động tạo bảng `products` và tự điền dữ liệu.

**3. Khởi chạy mã nguồn:**
- Copy thư mục `app` trong kho lưu trữ này và dán vào thư mục gốc của web server (đường dẫn thường là `C:\xampp\htdocs\`).
- Mở trình duyệt web và truy cập vào đường dẫn: `http://localhost/app/index.php` để xem và sử dụng hệ thống.