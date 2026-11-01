<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 2: Đặt vé xem phim</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-box { border: 1px solid #ccc; padding: 20px; width: 400px; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .result { margin-top: 20px; padding: 15px; background: #e9ecef; border-radius: 5px; }
    </style>
</head>
<body>
<div id="app" class="form-box">
    <h2>Đặt vé xem phim</h2>

    <!-- 9. Gửi form bằng @submit.prevent -->
    <form @submit.prevent="xacNhanDatVe">
        <div class="form-group">
            <label>Họ tên khách hàng:</label><br>
            <!-- 1. Nhập họ tên với modifier .trim -->
            <input type="text" v-model.trim="khachHang" style="width: 100%;">
        </div>

        <div class="form-group">
            <label>Suất chiếu:</label><br>
            <!-- 2. Chọn suất chiếu -->
            <select v-model="suatChieu">
                <option value="">-- Chọn suất chiếu --</option>
                <option value="9:00 AM">Sáng - 9:00 AM</option>
                <option value="2:00 PM">Chiều - 2:00 PM</option>
                <option value="8:00 PM">Tối - 8:00 PM</option>
            </select>
        </div>

        <div class="form-group">
            <label>Loại vé:</label><br>
            <!-- 3. Chọn loại vé (value là giá vé) -->
            <label><input type="radio" value="70000" v-model.number="giaVe"> Vé thường (70.000đ)</label><br>
            <label><input type="radio" value="100000" v-model.number="giaVe"> Vé VIP (100.000đ)</label>
        </div>

        <div class="form-group">
            <label>Số lượng vé:</label><br>
            <!-- 7. Nút tăng giảm số lượng -->
            <button type="button" @click="giamSL" :disabled="soLuong <= 1">-</button>
            <!-- 4. Nhập số lượng với .number -->
            <input type="number" v-model.number="soLuong" min="1" max="10" style="width: 50px; text-align: center;">
            <button type="button" @click="tangSL" :disabled="soLuong >= 10">+</button>
        </div>

        <div class="form-group">
            <!-- 5. Checkbox combo -->
            <label><input type="checkbox" v-model="coCombo"> Kèm Combo Bắp + Nước (45.000đ)</label>
        </div>

        <hr>
        <!-- 6. Hiển thị tổng tiền tự động tính bằng computed -->
        <h3>Tổng tiền: {{ tongTien.toLocaleString('vi-VN') }} đ</h3>

        <!-- 8. Nút đặt vé bật/tắt dựa trên computed 'hopLe' -->
        <button type="submit" :disabled="!hopLe" style="background: green; color: white; padding: 10px;">Đặt vé</button>
        <!-- 7. Nút đặt lại form -->
        <button type="button" @click="datLaiForm" style="padding: 10px; margin-left: 10px;">Đặt lại</button>
    </form>

    <!-- 9. Hiển thị xác nhận -->
    <div v-if="daXacNhan" class="result">
        <h4>Thông tin đặt vé thành công!</h4>
        <p>Khách hàng: <b>{{ khachHang }}</b></p>
        <p>Suất chiếu: <b>{{ suatChieu }}</b></p>
        <p>Số lượng: <b>{{ soLuong }}</b> vé {{ giaVe === 100000 ? 'VIP' : 'Thường' }}</p>
        <p>Combo: <b>{{ coCombo ? 'Có' : 'Không' }}</b></p>
        <h3 style="color: red;">Đã thanh toán: {{ tongTien.toLocaleString('vi-VN') }} đ</h3>
    </div>
</div>

<script>
    Vue.createApp({
        data() {
            return {
                khachHang: "",
                suatChieu: "",
                giaVe: 70000,
                soLuong: 1,
                coCombo: false,
                daXacNhan: false
            }
        },
        computed: {
            // 6. Tính tổng tiền
            tongTien() {
                let tienCombo = this.coCombo ? 45000 : 0;
                return (this.giaVe * this.soLuong) + tienCombo;
            },
            // 8. Kiểm tra tính hợp lệ
            hopLe() {
                return this.khachHang.length > 0
                    && this.soLuong >= 1
                    && this.soLuong <= 10
                    && this.suatChieu !== "";
            }
        },
        methods: {
            tangSL() { if (this.soLuong < 10) this.soLuong++; },
            giamSL() { if (this.soLuong > 1) this.soLuong--; },
            datLaiForm() {
                this.khachHang = "";
                this.suatChieu = "";
                this.giaVe = 70000;
                this.soLuong = 1;
                this.coCombo = false;
                this.daXacNhan = false;
            },
            xacNhanDatVe() {
                this.daXacNhan = true;
            }
        }
    }).mount("#app");
</script>
</body>
</html>
