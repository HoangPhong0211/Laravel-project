# 🛒 ĐỒ ÁN WEBSITE BÁN QUẦN ÁO (NHÓM CỦA BẠN)

Đây là quy hoạch code của nhóm, đề nghị tuân thủ để tránh conflict:

---

Minh: CORE & AUTH
* **Nhiệm vụ:** Đăng nhập/ký, Database gốc.
* **Code tại:**
    * `app/Http/Controllers/Auth/`
    * `resources/views/auth/`
* **Lưu ý:** Chỉ ông được sửa file `database/migrations` và đầu file `routes/web.php`.

Phú: CLIENT (KHÁCH MUA HÀNG)
* **Nhiệm vụ:** Trang chủ, Giỏ hàng.
* **Code tại:**
    * `app/Http/Controllers/Client/`
    * `resources/views/client/`
    * `public/assets/client/`
* **Lưu ý:** Không sửa code trong folder Admin!

Phong: ADMIN (QUẢN TRỊ)
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
