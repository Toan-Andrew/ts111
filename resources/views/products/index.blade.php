@extends('products.layout')

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <!-- Thương hiệu (Brand) -->
            <a class="navbar-brand d-flex flex-column" href="#">
                <h1 style="color:rgb(35, 65, 95);">BrainyReads</h1>
                <small class="text-muted">Sách không chỉ giúp ta hiểu thêm về thế giới, mà còn giúp ta hiểu rõ hơn về chính mình.</small>
            </a>

            <!-- Nút toggler cho màn hình nhỏ -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nội dung navbar -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <<ul class="navbar-nav align-items-center">
                    <!-- Giỏ hàng -->
                    <li class="nav-item me-3">
                        <a href="{{ route('orders.index') }}" class="nav-link position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount ?? 0 }}
                            </span>
                        </a>
                    </li>

                    @if(Auth::check())
                        <!-- Nút Profile -->
                        <li class="nav-item me-3">
                            <a href="{{ route('profile') }}" class="nav-link btn btn-outline-info">Profile</a>
                        </li>
                        <!-- Nút Logout -->
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @else
                        <!-- Nút Login nếu người dùng chưa đăng nhập -->
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <div class="row mb-5">
        <div class="col-lg-6 mx-auto">
            <div class="input-group rounded shadow-sm">
                <input type="text" class="form-control" name="search" placeholder="Search for products..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </div>
    </div>

    <!-- Featured Products (Carousel) -->
    <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($categories->take(5) as $category)
                <div class="carousel-item @if($loop->first) active @endif">
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" class="d-block w-100" alt="Category Image" style="height: 450px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/1200x600" class="d-block w-100" alt="Placeholder Image" style="height: 450px; object-fit: cover;">
                    @endif
                </div>
            @endforeach
        </div>
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Category Buttons Section -->
    <div class="category-section mb-5 text-center">
        <h2 style="color:rgb(35, 65, 95);">SÁCH DÀNH CHO BẠN</h2>
        @php
            $colors = ['btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-dark'];
        @endphp
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
            <!-- Nút Tất cả các sách -->
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                Tất cả các sách
            </a>
            <!-- Các nút danh mục -->
            @foreach ($categories as $index => $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>


    <!-- Category Rows Section: Mỗi hàng cho 1 loại sách -->
    @foreach ($categories as $category)
        <div class="category-row mb-5">
            <!-- Header của loại sách -->
            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid" style="width: 100px;">
                    @else
                        <img src="https://via.placeholder.com/100" alt="No image" class="img-fluid">
                    @endif
                </div>
                <h2 class="mb-0">{{ $category->name }}</h2>
            </div>
            <!-- Danh sách các sản phẩm của loại sách đó -->
            <div class="row">
                @forelse($category->products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <!-- Hình sản phẩm -->
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 200px; object-fit: cover; border-radius: 15px;">
                        @else
                            <div class="d-flex justify-content-center align-items-center bg-light" style="height: 200px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif

                        <!-- Nội dung card -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center">{{ Str::limit($product->name, 30) }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->detail, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="badge price-badge">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.showdetail2', $product->id) }}" class="btn btn-outline-dark btn-sm">Chi tiết</a>
                            </div>
                            <button type="button" class="btn btn-success btn-sm mt-3 w-100" data-bs-toggle="modal" data-bs-target="#buyProductModal{{ $product->id }}">
                                Mua ngay
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Mua Hàng cho sản phẩm -->
                <div class="modal fade" id="buyProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="buyProductModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('products.buy', $product->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buyProductModalLabel{{ $product->id }}">Thông tin đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name{{ $product->id }}" class="form-label">Họ và tên</label>
                                        <input type="text" name="name" id="name{{ $product->id }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone{{ $product->id }}" class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" id="phone{{ $product->id }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address{{ $product->id }}" class="form-label">Địa chỉ giao hàng</label>
                                        <input type="text" name="address" id="address{{ $product->id }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email{{ $product->id }}" class="form-label">Email</label>
                                        <input type="email" name="email" id="email{{ $product->id }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary w-100">Đặt hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                    <div class="col-12">
                        <p class="text-muted">Không có sản phẩm nào trong danh mục này.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach

    <!-- Footer Section -->
    <footer class="custom-footer">
        <div class="container">
            <div class="newsletter-content">
                <i class="fa fa-envelope"></i>
                <span>HÒM THƯ GÓP Ý</span>
                <input type="email" placeholder="Nhập ý kiến của bạn">
                <button>Gửi</button>
            </div>
        </div>
    </footer>

    <footer class="bg-light py-4">
        <div class="container">
            <div class="row">
                <!-- Logo và thông tin liên hệ -->
                <div class="col-md-3 mb-4">
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
    <footer class="custom-footer">
        <p class="mb-0">© 2025 MyShop. All Rights Reserved.</p>
    </footer>
</div>

<style>
    .custom-footer {
        background-color: rgb(35, 65, 95); /* Xám đậm */
        color: #ffffff; /* Chữ trắng */
        text-align: center;
        padding: 15px 0;
        width: 100%;
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
        gap: 20px;
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
        border-radius: 8px;
    }
    .newsletter-content button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 18px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 25px;
        font-weight: bold;
        transition: 0.3s;
    }
    .newsletter-content button:hover {
        background-color: #2980b9;
    }
    .custom-navbar {
        background-color: rgb(35, 65, 95) !important;
        color: white;
    }
</style>
<style>
    /* Tùy chỉnh cho card sản phẩm */
    .product-card {
        border: 2px solid #ddd; /* viền nhẹ */
        border-radius: 30px; /* bo tròn viền */
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .product-card:hover {
        transform: scale(1.02); /* phóng to nhẹ khi hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
    /* Tùy chỉnh cho giá tiền */
    .price-badge {
        background-color: #ff5722 !important; /* màu cam đậm */
        color: #ffffff !important;
        font-weight: bold;
    }
</style>

@endsection
