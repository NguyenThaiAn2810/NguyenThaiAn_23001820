-- tạo database
CREATE DATABASE buoi_3

-- BÀI 1 – QUẢN LÝ GIỎ HÀNG

-- Tạo bảng cart_items
CREATE TABLE cart_items (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	price DECIMAL(10, 2) NOT NULL,
	quantity INT NOT NULL
);

-- 1. Thêm ít nhất 5 sản phẩm vào bảng.
INSERT INTO cart_items
VALUES (157, "meat", 20.5, 8), 
(238, "rice", 25.7, 10), 
(324, "sugar", 15.3, 15), 
(193, "butter", 45.5, 12), 
(289, "cabbage", 12.5, 40);

-- 2. Hiển thị toàn bộ sản phẩm.
SELECT * FROM cart_items

-- 3. Hiển thị sản phẩm có giá lớn hơn 100000.
SELECT * FROM cart_items
WHERE price > 100000

-- 4. Hiển thị sản phẩm có số lượng lớn hơn 5.
SELECT * FROM cart_items
WHERE quantity > 5

-- 5. Sắp xếp sản phẩm theo giá giảm dần.
SELECT * FROM cart_items
ORDER BY price DESC

-- 6. Cập nhật giá của một sản phẩm.
UPDATE cart_items
SET price = 27.5
WHERE name = "rice"

-- 7. Cập nhật số lượng của một sản phẩm.
UPDATE cart_items
SET price = 18.5
WHERE name = "sugar"

-- 8. Xóa một sản phẩm.
DELETE FROM cart_items
WHERE name = "butter"

-- 9. Hiển thị tên sản phẩm, giá, số lượng và thành tiền (price × quantity).
SELECT name, price, quantity, (price * quantity) AS total_amount
FROM cart_items

-- 10. Tính tổng tiền của toàn bộ giỏ hàng.
SELECT SUM(price * quantity) AS total_price FROM cart_items

-- BÀI 2 – QUẢN LÝ VÉ XEM PHIM

-- Tạo bảng movies
CREATE TABLE movies (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(100) NOT NULL,
	price DECIMAL(10, 2) NOT NULL,
	total_seats INT NOT NULL,
	available_seats INT NOT NULL
);

-- 1. Thêm ít nhất 5 bộ phim.
INSERT INTO movies
VALUES (157, "Avengers", 20.5, 300, 280), 
(238, "Superman", 25.7, 400, 350), 
(324, "Conan", 15.3, 500, 470), 
(193, "Doraemon", 45.5, 400, 320), 
(289, "Infinity", 12.5, 750, 720);

-- 2. Hiển thị toàn bộ danh sách phim.
SELECT * FROM movies

-- 3. Hiển thị phim có giá vé lớn hơn 100000.
SELECT * FROM movies
WHERE price > 100000

-- 4. Hiển thị phim còn nhiều hơn 50 ghế.
SELECT * FROM movies
WHERE available_seats > 50

-- 5. Sắp xếp phim theo giá vé giảm dần.
SELECT * FROM movies
ORDER BY price DESC

-- 6. Cập nhật số ghế còn lại của một phim.
UPDATE movies
SET available_seats = 150
WHERE title = "Conan"

-- 7. Xóa một phim.
DELETE FROM movies
WHERE title = "Doraemon"

-- 8. Hiển thị số vé đã bán của từng phim: total_seats - available_seats.
SELECT title, total_seats, available_seats, (total_seats - available_seats) AS sold_seats
FROM movies

-- 9. Tính doanh thu của từng phim: (total_seats - available_seats) × price.
SELECT title, total_seats, available_seats, price, (total_seats - available_seats)*price AS revenue
FROM movies

-- 10. Tính tổng doanh thu của tất cả các phim.
SELECT SUM((total_seats - available_seats)*price) AS total_revenue
FROM movies

-- 11. Tìm phim có số vé bán ra nhiều nhất.
SELECT title, total_seats, available_seats, (total_seats - available_seats) AS max_sold_seats
FROM movies
WHERE total_seats - available_seats >= ALL (
    SELECT (total_seats - available_seats) AS sold_seats 
    FROM movies)