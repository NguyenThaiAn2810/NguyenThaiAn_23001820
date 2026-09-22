<?php
	    $students = [
            [
            "name"  => "Nguyen Van An",
            "age"  => 20,
            "score"  => 8.5
            ],
            [
            "name"  => "Tran Thi Binh",
            "age"  => 21,
            "score"  => 6.5
            ],
            [
            "name"  => "Le Van Cuong",
            "age"  => 19,
            "score"  => 4.5
            ],
            [
            "name"  => "Pham Thi Dung",
            "age"  => 20,
            "score"  => 7.5
            ]
            ];
	function printStudent($students) {
		foreach ($students as $student) {
			displayStudent($student);
		}
	}
	function calculateAverage($students) {
		$sum = 0;
		$count = 0;
		foreach ($students as $row) {
			foreach ($row as $key => $value) {
				if ($key == "score") {
				$sum += $value;
				$count++;
				}
			}
		}
		return $sum / $count;
	}
	function getRank($score) {
		if ($score > 10 || $score < 0) {
			return "Điểm không phù hợp";
		}
		if ($score >= 8) {
		return "Giỏi";
		} elseif ($score >= 6.5) {
		return "Khá";
		} elseif ($score >= 5) {
		return "Trung bình";
		} else {
		return "Yếu";
		}
	}
	function displayStudent($student) {
		$student["rank"] = getRank($student["score"]);
		foreach ($student as $key => $value) {
			echo "$key: $value\n";
		}
	}
	// Tìm và trả về sinh viên có điểm cao nhất.
	function findBestStudent($students) {
		$max = -9999;
		$maxStudent = null;
		foreach ($students as &$student) {
			if($student["score"] > $max) {
				$max = $student["score"];
				$maxStudent = $student["name"];
			}
		}
		unset($student);
		return $maxStudent;
	}
	// Tìm và trả về sinh viên có điểm thấp nhất.
	function findWorstStudent($students) {
		$min = 9999;
		$minStudent = null;
		foreach ($students as &$student) {
			if($student["score"] < $min) {
				$min = $student["score"];
				$minStudent = $student["name"];
			}
		}
		unset($student);
		return $minStudent;
	} 
	// Đếm số sinh viên đạt. Sinh viên đạt khi điểm >= 5.
	function countPassedStudents($students) {
		$count = 0;
		foreach ($students as &$student) {
			if($student["score"] >= 5) {
				$count++;
			}
		}
		unset($student);
		return $count;
	}
	// Tìm sinh viên theo tên và trả về sinh viên tìm được.
	function findStudentByName($students, $name) {
		$foundStudent = null;
		foreach ($students as &$student) {
			if($student["name"] == $name) {
				$foundStudent = $student;
			}
		}
		unset($student);
		if (is_null($foundStudent)) {
			echo "Không tìm thấy sinh viên có tên $name.";
		} else {
			echo "Thông tin của học sinh có tên $name là:\n";
			foreach ($foundStudent as $key => $value) {
				echo "$key: $value\n";
			}
		}
	}
	// Bài 1 và 2:
	echo "Bài 1 và 2:\n";
	echo "\nDanh sách học sinh có xếp hạng:\n";
	printStudent($students);
	echo "Điểm trung bình của tất cả học sinh: ", calculateAverage($students), "\n";
	// Bài 3:
	echo "Bài 3:\n";
	echo "\nSinh viên có điểm thấp nhất: ", findWorstStudent($students), "\n";
	echo "Sinh viên có điểm cao nhất: ", findBestStudent($students), "\n";
	echo "Số học sinh qua môn: ", countPassedStudents($students), "\n";
	$name = "Nguyen Van An";
	echo findStudentByName($students, $name);
?>