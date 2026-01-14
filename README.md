#  ĐỒ ÁN WEBSITE BÁN QUẦN ÁO

Đây là quy hoạch code của nhóm, đề nghị tuân thủ để tránh conflict:

---

### Minh: CORE SYSTEM & AUTH (Trưởng Nhóm Kỹ Thuật)
* **Nhiệm vụ chính:**
    * Xây dựng CSDL (Migrations) cho toàn bộ dự án.
    * Thiết lập Models và các mối quan hệ (Relationships).
    * Xử lý Đăng nhập, Đăng ký, Quên mật khẩu.
    * Viết Middleware phân quyền (Admin vs User).
* **Khu vực code (Được phép sửa):**
    * `app/Http/Controllers/Auth/`
    * `resources/views/auth/`
    * `database/migrations/` (Tạo bảng)
    * `app/Models/` (Cấu hình quan hệ)
    * `app/Http/Middleware/`
    * `routes/web.php` (Quy hoạch luồng đi chính)

### Phú: CLIENT (KHÁCH MUA HÀNG)
* **Nhiệm vụ:** Trang chủ, Giỏ hàng.
* **Code tại:**
    * `app/Http/Controllers/Client/`
    * `resources/views/client/`
    * `public/assets/client/`
* **Lưu ý:** Không sửa code trong folder Admin!

### Phong: ADMIN (QUẢN TRỊ)
* **Nhiệm vụ:** Dashboard, Quản lý Sản phẩm/Đơn.
* **Code tại:**
    * `app/Http/Controllers/Admin/`
    * `resources/views/admin/`
    * `public/assets/admin/`

---

## ⚠️ LƯU Ý QUAN TRỌNG
1.  **Pull trước khi làm:** Luôn chạy `git pull origin main` đầu buổi.
2.  **Không sửa file của người khác:** Nếu cần sửa, hãy hú nhau một tiếng.
3.  **Route:** Viết đúng vào khu vực đã chia trong `routes/web.php`.
