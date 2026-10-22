<?php
class Student {
	private $name;
	private $age;
	private $score;

	// Constructor
	function __construct($name, $age, $score) {
		$this->name = $name;
		$this->age = $age;
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

	// kiểm tra sinh viên có đạt hay không
	function isPassed() {
		if ($this->score >= 5) {
			return "Đạt";
		} else {
			return "Không đạt";
		}
	}

	// hiển thị thông tin sinh viên
	function display() {
		echo "Tên sinh viên: " . $this->name
			. ", Tuổi: " . $this->age
			. ", Điểm: " . $this->score
			. ", Xếp loại: " . $this->getRank()
			. ", Kết quả: " . $this->isPassed()
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
// Tìm và trả về sinh viên có điểm cao nhất.
	function findBestStudent($listStudents) {
		$max = -9999;
		$maxStudent = null;
		foreach ($listStudents as $student) {
			if($student->getScore() > $max) {
				$max = $student->getScore();
				$maxStudent = $student->getName();
			}
		}
		unset($student);
		return $maxStudent;
	}
	// Đếm số sinh viên đạt.
	function countPassedStudents($listStudents) {
		$count = 0;
		foreach ($listStudents as $student) {
			if($student->isPassed() == "Đạt") {
				$count++;
			}
		}
		unset($student);
		return $count;
	}
	// Điểm trung bình chung của sinh viên
	function calculateAverage($listStudents) {
		$sum = 0;
		$count = 0;
		foreach ($listStudents as $student) {
			$sum += $student->getScore();
			$count++;
		}
		unset($student);
		return $sum / $count;
	}

$student1 = new Student("Nguyen Van An", 20, 8.5);
$student2 = new Student("Tran Thi Binh", 21, 6.5);
$student3 = new Student("Le Van Cuong", 19, 4.5);
$student4 = new Student("Pham Thi Dung", 20, 7.5);

$listStudents = array($student1, $student2, $student3, $student4);
echo "Bài 4:\n";
// duyệt danh sách
echo "Danh sách các sinh viên:\n";
foreach ($listStudents as $student) {
	$student->display();
}
// gọi các hàm của bài 4
echo "Điểm trung bình của tất cả học sinh: ", calculateAverage($listStudents), "\n";
echo "Sinh viên có điểm cao nhất: ", findBestStudent($listStudents), "\n";
echo "Số học sinh qua môn: ", countPassedStudents($listStudents), "\n";
?>