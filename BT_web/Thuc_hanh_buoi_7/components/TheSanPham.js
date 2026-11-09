// Khai báo component, xuất ra dưới dạng một biến
const TheSanPham = {
    // 2 & 3. Khai báo kiểu dữ liệu, bắt buộc và mặc định
    props: {
        ten: { type: String, required: true },
        gia: { type: Number, required: true },
        anh: { type: String, default: "https://via.placeholder.com/150" },
        moTa: { type: String, default: "Đang cập nhật mô tả..." },
        tonKho: { type: Number, default: 0 }
    },
    // 5. Data riêng của component
    data() {
        return {
            hienMoTa: false
        };
    },
    template: `
        <div class="product-card">
            <img :src="anh" :alt="ten" style="width: 100%; height: 150px; object-fit: cover;">
            <h4>{{ ten }}</h4>
            <p style="color: red; font-weight: bold;">{{ gia.toLocaleString('vi-VN') }} đ</p>
            
            <!-- 7. Nhãn hết hàng / nút mua -->
            <p v-if="tonKho === 0" style="color: gray; font-style: italic;">Hết hàng</p>
            <p v-else>Còn lại: {{ tonKho }}</p>
            
            <button :disabled="tonKho === 0" style="background: green; color: white; border: none; padding: 8px; width: 100%;">
                MUA HÀNG
            </button>
            
            <!-- 5 & 6. Mở mô tả (Không ảnh hưởng thẻ khác) -->
            <button @click="hienMoTa = !hienMoTa" style="margin-top: 10px; width: 100%;">
                {{ hienMoTa ? 'Ẩn mô tả' : 'Xem mô tả' }}
            </button>
            
            <p v-if="hienMoTa" style="margin-top: 10px; font-size: 13px; color: #555;">{{ moTa }}</p>
        </div>
    `
};