<?php
class Movie {
    public $id;
    public $title;
    public $price;
    public $totalSeats;
    public $availableSeats;

    // Khởi tạo
    public function __construct($id, $title, $price, $totalSeats) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        // Ban đầu số ghế còn lại bằng tổng số ghế
        $this->availableSeats = $totalSeats; 
    }

    // Đặt vé
    public function bookTicket($quantity) {
        if ($quantity <= 0) {
            echo "Lỗi đặt vé - phim {$this->title}: Số lượng vé đặt phải lớn hơn 0 (Yêu cầu: $quantity).\n";
            return false;
        }
        if ($quantity > $this->availableSeats) {
            echo "Lỗi đặt vé - phim {$this->title}: Không đủ ghế trống! Chỉ còn {$this->availableSeats} ghế.\n";
            return false;
        }
        
        $this->availableSeats -= $quantity;
        echo "Đã đặt $quantity vé cho phim '{$this->title}'.\n";
        return true;
    }

    // Hủy vé
    public function cancelTicket($quantity) {
        if ($quantity <= 0) {
            echo "Lỗi hủy vé - phim {$this->title}: Số lượng vé hủy phải lớn hơn 0 (Yêu cầu: $quantity).\n";
            return false;
        }
        
        $soldSeats = $this->getSoldSeats();
        if ($quantity > $soldSeats) {
            echo "Lỗi hủy vé - phim {$this->title}: Không thể hủy vượt số vé đã bán! (Đã bán: {$soldSeats}).\n";
            return false;
        }
        
        $this->availableSeats += $quantity;
        echo "Đã hủy $quantity vé của phim '{$this->title}'.\n";
        return true;
    }

    // Lấy số vé đã bán
    public function getSoldSeats() {
        return $this->totalSeats - $this->availableSeats;
    }

    // Lấy doanh thu
    public function getRevenue() {
        return $this->getSoldSeats() * $this->price;
    }

    // Hiển thị thông tin
    public function displayInfo() {
        echo sprintf(
            "ID: %d | Phim: %-10s | Giá: %6d | Tổng ghế: %3d | Còn trống: %3d | Đã bán: %3d | Doanh thu: %d\n",
            $this->id, $this->title, $this->price, $this->totalSeats, $this->availableSeats, $this->getSoldSeats(), $this->getRevenue()
        );
    }
}

function findMovieById($movies, $id) {
    if (empty($movies)) {
        return null;
    }
    foreach ($movies as $movie) {
        if ($movie->id === $id) {
            return $movie;
        }
    }
    return null;
}

function getTotalRevenue($movies) {
    if (empty($movies)) {
        return 0;
    }
    $total = 0;
    foreach ($movies as $movie) {
        $total += $movie->getRevenue();
    }
    return $total;
}

function getBestSellingMovie($movies) {
    if (empty($movies)) {
        return null;
    }
    $bestMovie = null;
    $maxSold = -1; // Đặt mốc số lượng bán ban đầu

    foreach ($movies as $movie) {
        $sold = $movie->getSoldSeats();
        if ($sold > $maxSold) {
            $maxSold = $sold;
            $bestMovie = $movie;
        }
    }
    return $bestMovie;
}

echo "Quản lý vé xem phim:\n\n";

// 1. Tạo danh sách các object Movie
$movies = [
    new Movie(1, "Avengers", 100000, 100),
    new Movie(2, "Avatar", 120000, 80),
    new Movie(3, "Batman", 90000, 120)
];

// 2. Đặt vé cho phim Avengers
echo "Thực hiện đặt vé:\n";
$movies[0]->bookTicket(20);  // Hợp lệ: Avengers đặt 20 vé
$movies[0]->bookTicket(-5);  // Không hợp lệ: Đặt vé âm
$movies[0]->bookTicket(100); // Không hợp lệ: Vượt quá 80 ghế còn lại

// 3. Đặt vé cho phim Avatar
$movies[1]->bookTicket(50);  // Hợp lệ: Avatar đặt 50 vé

echo "\nThực hiện huỷ vé:\n";
// 4. Hủy một số vé đã đặt của phim Avengers
$movies[0]->cancelTicket(5);  // Hợp lệ: Avengers hủy 5 vé
$movies[0]->cancelTicket(0);  // Không hợp lệ: Hủy vé <= 0
$movies[0]->cancelTicket(50); // Không hợp lệ: Hủy vượt quá 15 vé đã bán (20 đặt - 5 hủy = 15)

echo "\nTìm kiếm phim:\n";
// Tìm phim tồn tại và không tồn tại
$foundMovie = findMovieById($movies, 3);
if ($foundMovie) echo "Tìm thấy phim: {$foundMovie->title}\n";

$notFoundMovie = findMovieById($movies, 99);
if (!$notFoundMovie) echo "Không tìm thấy phim có ID 99.\n";

// Test danh sách rỗng
echo "Test trường hợp danh sách phim rỗng:\n";
$emptyTest = getBestSellingMovie([]);
if (!$emptyTest) echo "Danh sách phim rỗng, không thể tìm phim bán chạy nhất.\n"; 


// 5. Hiển thị thông tin của tất cả các phim
echo "\nThông tin tất cả các phim:\n";
foreach ($movies as $movie) {
    $movie->displayInfo();
}

// 6. Tính tổng doanh thu của tất cả các phim
echo "Tổng doanh thu: " . number_format(getTotalRevenue($movies)) . "\n";

// 7. Tìm và hiển thị phim có số vé bán ra nhiều nhất
$bestMovie = getBestSellingMovie($movies);
if ($bestMovie) {
    echo "Phim bán chạy nhất là: {$bestMovie->title} (Bán được {$bestMovie->getSoldSeats()} vé)\n";
}
?>