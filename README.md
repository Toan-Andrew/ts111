
# 🌟 BrainyReads – Website Bán Sách 📚

## 🎓 Trịnh Văn Toàn – 22010491  
From Phenikaa University

## **📌 Tổng quan**
BrainyReads là một website thương mại điện tử chuyên cung cấp và phân phối các loại sách đa dạng, từ sách giáo khoa, sách kỹ năng, đến tiểu thuyết và sách chuyên ngành. Với giao diện thân thiện và dễ sử dụng, nền tảng này giúp người dùng dễ dàng tìm kiếm, chọn mua và quản lý bộ sưu tập sách cá nhân một cách nhanh chóng, tạo ra một trải nghiệm mua sắm sách trực tuyến tối ưu và thuận tiện nhất.


 - Detailed project documentation is [here](https://drive.google.com/file/d/17nAGMk5YoxeQELg16IybnZEFi_HVwa88/view?usp=sharing)
 - API documentaion is [here](https://github.com/Toan-Andrew/ts111/wiki)
 - Github: https://github.com/Toan-Andrew/ts111
---

## **🛠️ Các danh mục chức năng**

### 🔹 Đối với Admin
- 📌 Quản lý loại sản phẩm
- 📌 Quản lý sản phẩm
- 📌 Quản lý đơn hàng
- 📌 Quản lý lời góp ý

### 🔹 Đối với người dùng
- 🛒 Mua sản phẩm
- 🔍 Tìm kiếm sản phẩm
- 🏷️ Lọc sản phẩm theo từng loại
- 💬 Góp ý nhận xét với website
- 👤 Quản lý tài khoản

---

## **🚀 Cài đặt (Installation)**
1. **Cài đặt dự án bằng lệnh:**
   ```bash
   composer create-project --prefer-dist laravel/laravel ts111
   ```
2. Di chuyển vào thư mục dự án:  
   ```bash
   cd ts111
   ```
3. Cài đặt các thư viện phụ thuộc:  
   ```bash
   composer install
   ```
4. Sao chép file `.env.example` thành `.env`:  
   ```bash
   cp .env.example .env
   ```
5. Tạo khoá ứng dụng (APP_Key) cho Laravel:  
   ```bash
   php artisan key:generate
   ```
6. Chạy migration để tạo các bảng trong cơ sở dữ liệu:  
   ```bash
   php artisan migrate
   ```
7. Khởi động server:  
   ```bash
   php artisan serve
   ```

---

## **🏗️ Công nghệ sử dụng**
- 🐘 **PHP/Laravel** – Framework PHP mạnh mẽ để phát triển ứng dụng web.
- 🌐 **HTML** – Ngôn ngữ đánh dấu giúp cấu trúc nội dung trang web.
- ⚡ **JavaScript** – Ngôn ngữ lập trình giúp tạo các hiệu ứng động và tương tác.
- 🎨 **CSS** – Ngôn ngữ tạo kiểu giúp thiết kế giao diện trực quan.
- 🗄️ **Cơ sở dữ liệu MySQL** – Hệ quản trị cơ sở dữ liệu để lưu trữ thông tin sản phẩm, người dùng, đơn hàng.

---

## **🎯 Mục tiêu và kỳ vọng**
- 💬 Thêm chức năng Chat với Admin để hỗ trợ khách hàng.
- 📖 Phát triển tính năng E-Book giúp người dùng đọc sách trực tuyến.
- 🎧 Hỗ trợ AudioBook cho những người thích nghe sách.
- 🛍️ Cải thiện trải nghiệm mua sắm với hệ thống gợi ý sách theo sở thích.
- 🌟 Tích hợp hệ thống đánh giá sách chi tiết hơn.
- 📱 Tối ưu giao diện trên thiết bị di động.

---

🚀 Chúc bạn có trải nghiệm tuyệt vời cùng **BrainyReads**! 📚✨
```

