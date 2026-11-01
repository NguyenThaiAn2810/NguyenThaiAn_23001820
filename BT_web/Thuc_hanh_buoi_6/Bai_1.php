<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 1: Thẻ thông tin sinh viên</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .card { border: 1px solid #ccc; padding: 20px; width: 300px; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        .avatar { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; }
        .gioi { color: green; font-weight: bold; }
        .kha { color: blue; font-weight: bold; }
        .trung-binh { color: orange; font-weight: bold; }
        .chua-dat { color: red; font-weight: bold; }
    </style>
</head>
<body>
<div id="app" class="card">
    <!-- 3. v-bind cho src và alt -->
    <img v-bind:src="sinhVien.anhDaiDien" :alt="'Ảnh của ' + sinhVien.hoTen" class="avatar">

    <!-- 2. Hiển thị họ tên bằng {{ }} -->
    <h3>Họ tên: {{ sinhVien.hoTen }}</h3>

    <!-- 1 & 2. Hiển thị mã SV và lớp bằng v-text -->
    <p>Mã SV: <span v-text="sinhVien.maSV"></span></p>
    <p>Lớp: <span v-text="sinhVien.lop"></span></p>
    <p>Điểm trung bình: {{ sinhVien.diemTB }}</p>

    <!-- 4 & 5. Tính toán xếp loại và v-bind class để đổi màu -->
    <p>Xếp loại: <span :class="mauXepLoai">{{ xepLoai }}</span></p>

    <!-- 6. Hiển thị trạng thái bằng v-if / v-else -->
    <p>Trạng thái:
        <span v-if="sinhVien.dangHoc" style="color: green;">Đang học</span>
        <span v-else style="color: gray;">Đã nghỉ</span>
    </p>

    <!-- 7. Tạo nút bật tắt giới thiệu bằng v-show -->
    <button @click="hienThiGioiThieu = !hienThiGioiThieu">
        {{ hienThiGioiThieu ? 'Ẩn giới thiệu' : 'Hiện giới thiệu' }}
    </button>
    <p v-show="hienThiGioiThieu" style="margin-top: 10px; font-style: italic; color: #555;">
        Đây là phần giới thiệu ngắn về sinh viên này. Sinh viên rất tích cực trong học tập.
    </p>
</div>

<script>
    Vue.createApp({
        data() {
            return {
                // 1. Khai báo dữ liệu
                sinhVien: {
                    maSV: "23001820",
                    hoTen: "Nguyen Thai An",
                    lop: "K68A3",
                    anhDaiDien: "https://www.invert.vn/media/uploads/uploads/2024/2/19153009-2-meme-meo-cuoi-deu.jpg",
                    diemTB: 8.5,
                    dangHoc: true
                },
                hienThiGioiThieu: false
            }
        },
        // Dùng computed để tự tính xếp loại dựa trên điểm TB
        computed: {
            xepLoai() {
                let d = this.sinhVien.diemTB;
                if (d >= 8) return "Giỏi";
                if (d >= 6.5) return "Khá";
                if (d >= 5) return "Trung bình";
                return "Chưa đạt";
            },
            mauXepLoai() {
                let d = this.sinhVien.diemTB;
                if (d >= 8) return "gioi";
                if (d >= 6.5) return "kha";
                if (d >= 5) return "trung-binh";
                return "chua-dat";
            }
        }
    }).mount("#app");
</script>
</body>
</html>
