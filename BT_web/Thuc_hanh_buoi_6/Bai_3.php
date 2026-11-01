<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 3: Quản lý công việc</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .todo-box { width: 500px; border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        .done-text { text-decoration: line-through; color: gray; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .filters { margin: 15px 0; }
        .filters button { margin-right: 5px; cursor: pointer; }
        .active-filter { font-weight: bold; background: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 3px; }
    </style>
</head>
<body>
<div id="app" class="todo-box">
    <h2>Quản lý công việc</h2>

    <!-- 2. Thêm bằng nút hoặc Enter -->
    <input type="text" v-model.trim="viecMoi" @keyup.enter="themViec" placeholder="Nhập tên công việc..." style="width: 70%; padding: 5px;">
    <button @click="themViec" style="padding: 5px 10px;">Thêm</button>
    <p v-if="loiThem" style="color: red; font-size: 12px; margin-top: 5px;">{{ loiThem }}</p>

    <!-- 7. Bộ lọc -->
    <div class="filters">
        <span>Lọc: </span>
        <button @click="trangThaiLoc = 'TatCa'" :class="{'active-filter': trangThaiLoc === 'TatCa'}">Tất cả</button>
        <button @click="trangThaiLoc = 'ChuaXong'" :class="{'active-filter': trangThaiLoc === 'ChuaXong'}">Chưa hoàn thành</button>
        <button @click="trangThaiLoc = 'DaXong'" :class="{'active-filter': trangThaiLoc === 'DaXong'}">Đã hoàn thành</button>
    </div>

    <!-- 10. Thông báo rỗng -->
    <p v-if="dsHienThi.length === 0" style="color: orange; font-style: italic;">Không có công việc nào trong mục này.</p>

    <!-- 4. Danh sách v-for -->
    <ul>
        <li v-for="viec in dsHienThi" :key="viec.id">
            <label style="cursor: pointer;">
                <!-- 5. Đánh dấu hoàn thành -->
                <input type="checkbox" v-model="viec.hoanThanh">
                <span :class="{'done-text': viec.hoanThanh}">{{ viec.ten }}</span>
            </label>
            <!-- 6. Nút xóa -->
            <button @click="xoaViec(viec.id)" style="color: red; border: none; background: none; cursor: pointer;">✖</button>
        </li>
    </ul>

    <hr>
    <!-- 8. Thống kê bằng computed -->
    <p>Tổng cộng: <b>{{ tongSoViec }}</b> việc | Còn lại: <b>{{ soViecChuaXong }}</b> việc chưa xong.</p>

    <!-- 9. Xóa việc đã xong -->
    <button v-if="tongSoViec > soViecChuaXong" @click="xoaViecDaXong" style="background: red; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer;">
        Xóa các việc đã hoàn thành
    </button>
</div>

<script>
    Vue.createApp({
        data() {
            return {
                viecMoi: "",
                loiThem: "",
                trangThaiLoc: "TatCa",
                // 1. Cấu trúc 1 việc
                dsCongViec: [
                    { id: 1, ten: "Học Vue cơ bản", hoanThanh: true },
                    { id: 2, ten: "Làm bài tập thực hành số 6", hoanThanh: false }
                ]
            }
        },
        computed: {
            dsHienThi() {
                if (this.trangThaiLoc === 'ChuaXong') {
                    return this.dsCongViec.filter(v => !v.hoanThanh);
                } else if (this.trangThaiLoc === 'DaXong') {
                    return this.dsCongViec.filter(v => v.hoanThanh);
                }
                return this.dsCongViec;
            },
            tongSoViec() { return this.dsCongViec.length; },
            soViecChuaXong() { return this.dsCongViec.filter(v => !v.hoanThanh).length; }
        },
        methods: {
            themViec() {
                // 3. Không cho tên rỗng
                if (this.viecMoi === "") {
                    this.loiThem = "Tên công việc không được để trống!";
                    return;
                }
                this.loiThem = "";
                this.dsCongViec.push({
                    id: Date.now(),
                    ten: this.viecMoi,
                    hoanThanh: false
                });
                this.viecMoi = "";
            },
            xoaViec(id) {
                this.dsCongViec = this.dsCongViec.filter(v => v.id !== id);
            },
            xoaViecDaXong() {
                this.dsCongViec = this.dsCongViec.filter(v => !v.hoanThanh);
            }
        }
    }).mount("#app");
</script>
</body>
</html>
