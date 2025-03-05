
# 🌟 BrainyReads – Website Bán Sách 📚

## 🎓 Trịnh Văn Toàn – 22010491  
From Phenikaa University

## **📌 Tổng quan**
BrainyReads là một website thương mại điện tử chuyên cung cấp và phân phối các loại sách đa dạng, từ sách giáo khoa, sách kỹ năng, đến tiểu thuyết và sách chuyên ngành. Với giao diện thân thiện và dễ sử dụng, nền tảng này giúp người dùng dễ dàng tìm kiếm, chọn mua và quản lý bộ sưu tập sách cá nhân một cách nhanh chóng, tạo ra một trải nghiệm mua sắm sách trực tuyến tối ưu và thuận tiện nhất.


 - Detailed project documentation is [here](https://drive.google.com/file/d/1hNkPq4pBIFqGrtWDNo84s7gPof2CmomG/view?usp=sharing)
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

2. Cài đặt các thư viện phụ thuộc:  
   ```bash
   composer install
   ```
3. Sao chép file `.env.example` thành `.env`:  
   ```bash
   cp .env.example .env
   ```
4. Tạo khoá ứng dụng (APP_Key) cho Laravel:  
   ```bash
   php artisan key:generate
   ```
5. Chạy migration để tạo các bảng trong cơ sở dữ liệu:  
   ```bash
   php artisan migrate
   ```
6. Khởi động server:  
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

## Hình ảnh trang web

### 🏠 Giao diện trang giới thiệu  
![Image](https://github.com/user-attachments/assets/ee586644-ae9a-434b-aa0e-55aeeaf4a5cc)

### 🏡 Giao diện trang chủ  
![Giao diện trang chủ](https://github.com/user-attachments/assets/9fe70582-fa2f-4c56-a4e1-029618e39957)

### 🔍 Giao diện xem chi tiết sản phẩm  
![Giao diện xem chi tiết sản phẩm](https://github.com/user-attachments/assets/2742de65-6252-4467-9c66-bfa444542024)

### 👀 Giao diện Xem trước sản phẩm 
![Giao diện Xem trước sản phẩm](https://github.com/user-attachments/assets/3bf95fba-6659-49ab-8a37-cbd36d067756)

### 📦 Giao diện Đơn hàng đã mua
![Giao diện Đơn hàng đã mua](https://github.com/user-attachments/assets/c0e762ab-2b51-4b2c-9108-93d6f47dd8de)

### 📄 Giao diện Giỏ hàng
![Giao diện Xem chi tiết sản phẩm đã mua](https://github.com/user-attachments/assets/eeef3128-9c86-4762-baaa-3795d8fe7f84)

### 👤 Giao diện Thông tin tài khoản người dùng
![Giao diện Thông tin tài khoản người dùng](https://github.com/user-attachments/assets/196adb17-ed6d-47f2-8b09-67f50cd08d65)

### 🏢 Giao diện Trang chủ Admin  
![Giao diện Trang chủ Admin](https://github.com/user-attachments/assets/d0db3320-f9e6-451d-92a1-e833cdb7e81d)

### ➕ Giao diện Thêm loại sản phẩm 
![Giao diện Thêm loại sản phẩm](https://github.com/user-attachments/assets/ea118109-7f62-471d-b6d8-1da062a2ef5a)

### ✏️ Giao diện Chỉnh sửa loại sản phẩm  
![Giao diện Chỉnh sửa loại sản phẩm](https://github.com/user-attachments/assets/8cefcfb1-0fbe-4c16-b834-c836eb9c8a4a)

### ➕ Giao diện Thêm sản phẩm  
![Giao diện Thêm sản phẩm](https://github.com/user-attachments/assets/e119659d-d4d7-49df-88ff-a2fa563538d1)

### ✏️ Giao diện Chỉnh sửa sản phẩm
![Giao diện Chỉnh sửa sản phẩm](https://github.com/user-attachments/assets/f6625209-2294-4c8b-a1ad-8200f3e0b6b2)

### 📦 Giao diện Danh sách các đơn hàng
![Giao diện Danh sách các đơn hàng](https://github.com/user-attachments/assets/d1e92328-0855-49f7-8b13-fa4f019a1c5f)

### 📦 Giao diện Danh sách đóng góp ý kiến  
![Giao diện Danh sách các đơn hàng](https://github.com/user-attachments/assets/47b22c50-905f-4dac-aa21-989799e5deb6)

## Tài liệu tham khảo

- [Laravel Documentation 11.x](https://laravel.com/docs/11.x)
- [PHP Documentation](https://www.php.net/docs.php)
- Slide bài giảng môn học Thiết kế Web nâng cao

## Triển khai

- [Trang triển khai ứng dụng](https://automatic-potato-v66wp4qg5wxghp9-8001.app.github.dev/)

## Video demo

Xem video demo của ứng dụng tại link dưới đây:

- [Xem Video Demo](https://drive.google.com/file/d/1rB2s7l0PEYv1x6zgyBYhi0xu1AmMvObE/view?usp=sharing)
