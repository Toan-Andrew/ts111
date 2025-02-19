@extends('products.layout')

@section('content')
<div class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow fixed-top">

        <div class="container">
            <!-- Logo hoặc Brand -->
            <div class="d-flex flex-column">
                <h5>BrainyReads</h5>
                <small class="text-white">Sách không chỉ giúp ta hiểu thêm về thế giới, mà còn giúp ta hiểu rõ hơn về chính mình.</small>
            </div>

            <!-- Nút Toggle cho Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Danh sách các nút -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button id="btnShowCategories" class="btn btn-outline-light btn-lg mx-2">
                            Categories
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btnShowOrders" class="btn btn-outline-warning btn-lg mx-2">
                            Order List
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btnAdd" href="{{ route('categories.create') }}" class="btn btn-success btn-lg mx-2">
                            <i class="fa fa-plus"></i> Add New Category
                        </button>
                    </li>
                    <li>
                        <!-- Nút Logout -->
                        <button id="btnlogout">
                            <a href="{{ route('logout') }}">
                                Logout
                            </a>
                        </button>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

<!-- Thêm padding-top để nội dung không bị navbar che khuất -->
<div class="container mt-5 pt-5">
    @yield('content')
    </div>

        <!-- Danh mục (Categories) -->
        <div id="categoriesSection">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                    <div class="card shadow-lg border-0 rounded">
                        <img src="{{ asset($category->image) }}" class="card-img-top rounded-top"
                            style="height: 180px;  object-fit: cover;" alt="{{ $category->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">{{ $category->name }}</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('categories.showProducts', $category->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> View Products
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                                <a href="{{ route('categories.createProduct', $category->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
            </div>
        </div>

        <!-- Danh sách đơn hàng (Order List) -->
        <div id="ordersSection" style="display: none;">
            <form method="GET" action="{{ route('categories.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by email or name"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i> Search
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Price</th>
                            <th>Order Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->email }}</td>
                            <td class="text-success">${{ number_format($order->price, 2) }}</td>
                            <td>{{ $order->order_time }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>

        
    </div>
<script>
    document.getElementById("btnShowOrders").addEventListener("click", function() {
        document.getElementById("categoriesSection").style.display = "none";
        document.getElementById("ordersSection").style.display = "block";
    });

    document.getElementById("btnShowCategories").addEventListener("click", function() {
        document.getElementById("categoriesSection").style.display = "block";
        document.getElementById("ordersSection").style.display = "none";
    });
</script>
<!-- Footer -->
<footer class="custom-footer">
        <div class="container">
            <div class="newsletter-content">
                <i class="fa fa-envelope"></i>
                <span>ĐĂNG KÝ NHẬN BẢN TIN</span>
                
                <input type="email" placeholder="Nhập email của bạn">
                    
                <button>Đăng ký</button>
                
            </div>
        </div>
    </footer>

    <!-- Footer -->
    <footer class="bg-light py-4">
        <div class="container">
            <div class="row">

            <!-- Logo và thông tin liên hệ -->
            <div class="col-md-3 mb-4">
                <!-- Thay đường dẫn ảnh logo tại đây -->
                <p class="mb-1">
                    <strong>BrainyReads</strong><br>
                    Địa chỉ VP Hà Nội: Phố Nguyễn Trác<br>
                    Phường Yên Nghĩa,<br>
                    Quận Hà Đông, Hà Nội
                </p>
                <p class="mb-0">
                    Hotline: <a href="tel:0898657616" class="text-dark">0974838034</a>
                </p>
            </div>

            <!-- Hỗ trợ khách hàng -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Hỗ trợ khách hàng</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-dark">Hướng dẫn mua hàng</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Hình thức thanh toán</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Chính sách bảo hành</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Chính sách đổi trả</a></li>
                </ul>
            </div>

            <!-- Sản phẩm -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Sản phẩm</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-dark">Doanh nhân và Doanh nghiệp</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Nghệ thuật sống - Tâm lý</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Sức khỏe - Hạnh phúc</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Tài chính cá nhân</a></li>
                </ul>
            </div>

            <!-- Tin tức - Sự kiện -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Tin tức - Sự kiện</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-dark">Báo chí truyền thông</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Kiến thức học tập</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Tuyển dụng</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Review sách BrainyReads</a></li>
                </ul>
            </div>

        </div>
    </div>
    </footer>
    <!-- Footer -->
    <footer class="custom-footer">
        <p class="mb-0">© 2025 MyShop. All Rights Reserved.</p>
    </footer>
<style>
        #btnShowCategories,#btnAdd,#btnlogout,
        #btnShowOrders {
            background-color: #4CAF50; /* Xanh lá cho Categories */
            border: none;
            color: white;
            padding: 6px 14px; /* Giảm padding để nút nhỏ hơn */
            font-size: 14px; /* Nhỏ hơn */
            border-radius: 8px; /* Bo tròn nhẹ nhàng */
            transition: all 0.3s ease-in-out;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Bóng nhẹ */  
        }

        #btnShowOrders {
            background-color: #FF5733; /* Cam cho Order List */
        }
        #btnAdd {
            background-color:rgb(13, 93, 28)
        }
        #btnlogout{
            background-color:rgb(255, 0, 0);
        }
        #btnlogout a{
            text-decoration: none;
            color: white;
        }
        /* Hiệu ứng hover */
        #btnShowCategories:hover,#btnAdd:hover,
        #btnShowOrders:hover {
            opacity: 0.8; /* Làm mờ nhẹ khi hover */
            transform: scale(1.05); /* Nhẹ nhàng phóng to một chút */
        }
        html, body {
        height: 100%;
        }

        .wrapper {
        min-height: 100vh; /* Chiều cao tối thiểu bằng toàn màn hình */
        display: flex;
        flex-direction: column;
        }

        .content {
        flex: 1; /* Phần nội dung sẽ chiếm phần còn lại */
        }
        .custom-navbar {
            background-color:rgb(35, 65, 95) !important; /* Màu cam */
            color: white;
        }
        .custom-footer {
            background-color: rgb(35, 65, 95); /* Xám đậm */
            color: #ffffff; /* Chữ trắng */
            text-align: center;
            padding: 15px 0;
            
            width: 100vw;
            position: relative;
            left: 0;
            margin: 0;
        }


        .custom-footer p {
            margin-bottom: 0;
        }

        .newsletter-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px; /* Tạo khoảng cách giữa các phần tử */
            flex-wrap: wrap;
        }

        .newsletter-content i {
            font-size: 24px;
            color: white;
        }

        .newsletter-content span {
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .newsletter-content input {
            border: none;
            padding: 12px 15px;
            font-size: 16px;
            width: 280px;
            outline: none;
            border-radius: 8px; /* Bo viền ô input */
        }

        .newsletter-content button {
            background-color: #3498db; /* Màu xanh dương */
            color: white;
            border: none;
            padding: 12px 18px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 25px; /* Bo tròn viền button */
            font-weight: bold;
            transition: 0.3s;
        }

        .newsletter-content button:hover {
            background-color: #2980b9;
        }

    </style>
@endsection
