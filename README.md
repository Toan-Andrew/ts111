
# 🌟 BrainyReads – Website Bán Sách 📚

## 🎓 Trịnh Văn Toàn – 22010491  
From Phenikaa University

## **📌 Tổng quan**
BrainyReads là một website thương mại điện tử chuyên cung cấp và phân phối các loại sách đa dạng, từ sách giáo khoa, sách kỹ năng, đến tiểu thuyết và sách chuyên ngành. Với giao diện thân thiện và dễ sử dụng, nền tảng này giúp người dùng dễ dàng tìm kiếm, chọn mua và quản lý bộ sưu tập sách cá nhân một cách nhanh chóng, tạo ra một trải nghiệm mua sắm sách trực tuyến tối ưu và thuận tiện nhất.


 - Detailed project documentation is [here](https://drive.google.com/file/d/1GMC3Xkb_7E_38nj__eUz10EEAtnHFHmf/view?usp=sharing)
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

## Hình ảnh trang web

### 🏠 Giao diện trang giới thiệu  
![Image](https://github.com/user-attachments/assets/2048a6d4-87e0-43eb-bbbb-6e6a8f366218)

### 🔐 Giao diện đăng nhập  
![Giao diện đăng nhập](https://github.com/user-attachments/assets/a9d58371-ded0-4fb6-abd9-82e9b33aa768)

### 📝 Giao diện đăng ký  
![Giao diện đăng ký](https://github.com/user-attachments/assets/0ee5504f-bb24-400b-a358-76c9fd3e7919)

### 🏡 Giao diện trang chủ  
![Giao diện trang chủ](https://github.com/user-attachments/assets/9fe70582-fa2f-4c56-a4e1-029618e39957)

### 📂 Giao diện chọn loại sản phẩm  
![Giao diện chọn loại sản phẩm](https://github.com/user-attachments/assets/7fad9f5e-ec9d-4505-92d0-f35ad95cc190)

### 🔍 Giao diện xem chi tiết sản phẩm  
![Giao diện xem chi tiết sản phẩm](https://github.com/user-attachments/assets/1e09535b-5b93-4bf4-8f8a-2c0e51329ab2)

### 👀 Giao diện Xem trước sản phẩm 
![Giao diện Xem trước sản phẩm](https://github.com/user-attachments/assets/3bf95fba-6659-49ab-8a37-cbd36d067756)

### 🛒 Giao diện Mua sản phẩm  
![Giao diện Mua sản phẩm](https://github.com/user-attachments/assets/0c388607-1b79-4183-b89d-974d285942bf)

### 📦 Giao diện Đơn hàng đã mua
![Giao diện Đơn hàng đã mua](https://github.com/user-attachments/assets/9c8ca5e1-5ffe-4b55-a57b-16c9ba4fb83e)

### 📄 Giao diện Xem chi tiết sản phẩm đã mua
![Giao diện Xem chi tiết sản phẩm đã mua](https://github.com/user-attachments/assets/5f6ee9c3-0fae-4b0e-9219-5408ccfce176)

### 👤 Giao diện Thông tin tài khoản người dùng
![Giao diện Thông tin tài khoản người dùng](https://github.com/user-attachments/assets/196adb17-ed6d-47f2-8b09-67f50cd08d65)

### 🔄 Giao diện Cập nhập thông tin người dùng 
![Giao diện Cập nhập thông tin người dùng](https://github.com/user-attachments/assets/f4d29b79-0cb4-4134-949f-f6a08a9cc35d)

### 🏢 Giao diện Trang chủ Admin  
![Giao diện Trang chủ Admin](https://github.com/user-attachments/assets/d0db3320-f9e6-451d-92a1-e833cdb7e81d)

### ➕ Giao diện Thêm loại sản phẩm 
![Giao diện Thêm loại sản phẩm](https://github.com/user-attachments/assets/ea118109-7f62-471d-b6d8-1da062a2ef5a)

### ✏️ Giao diện Chỉnh sửa loại sản phẩm  
![Giao diện Chỉnh sửa loại sản phẩm](https://github.com/user-attachments/assets/8cefcfb1-0fbe-4c16-b834-c836eb9c8a4a)

### 📋 Giao diện Danh sách sản phẩm trong loại sản phẩm  
![Giao diện Danh sách sản phẩm trong loại sản phẩm](https://github.com/user-attachments/assets/082d93ec-37d6-45ae-a07e-ed0c4501ef86)

### 🗂️ Giao diện Danh sách sản phẩm đã tạo  
![Giao diện Danh sách sản phẩm đã tạo](https://github.com/user-attachments/assets/53bfeb99-1e15-4790-bc74-5f3a174ef093)

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

- [Xem Video Demo](https://drive.google.com/file/d/1OpfDMILuyVyPnxFbu8IRszh0WZ1ucwwa/view?usp=sharing)
