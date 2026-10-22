<?php
class Student {
    private $name;
    private $score;

    // Constructor
    function __construct($name, $score) {
        $this->name = $name;
        $this->score = $score;
    }

    // trả về xếp loại
    function getRank() {
        if ($this->score > 10 || $this->score < 0) {
            return "Điểm không phù hợp";
        }
        if ($this->score >= 8) {
            return "Giỏi";
        } elseif ($this->score >= 6.5) {
            return "Khá";
        } elseif ($this->score >= 5) {
            return "Trung bình";
        } else {
            return "Yếu";
        }
    }

    // hiển thị thông tin sinh viên
    function display() {
        echo "Tên sinh viên: " . $this->name
            . ", Điểm: " . $this->score
            . ", Xếp loại: " . $this->getRank()
            . "\n";
    }
    // các hàm getter
    // lấy điểm của sinh viên
    function getScore() {
        return $this->score;
    }
    // lấy tên của sinh viên
    function getName() {
        return $this->name;
    }
}
// hàm phụ trợ in mảng
function printStudents($listStudents) {
    if (empty($listStudents)) {
        throw new Exception("The array is empty.");
    }
    foreach ($listStudents as $student) {
        $student->display();
    }
}
$student1 = new Student("Nguyen Van An", 8.5);
$student2 = new Student("Tran Thi Binh", 6.5);
$student3 = new Student("Le Van Cuong", 4.5);
$student4 = new Student("Pham Thi Dung", 7.5);
$student5 = new Student("Pham Thi Dung", 5.5);
$listStudents = array($student1, $student2, $student3, $student4, $student5);
echo "Danh sách các sinh viên:\n", printStudents($listStudents), "\n";
?>