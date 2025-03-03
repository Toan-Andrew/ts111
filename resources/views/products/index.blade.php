@extends('products.layout')
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex flex-column" href="#">
                <h1 style="color:rgb(35, 65, 95);">BrainyReads</h1>
                <small class="text-muted">Sách không chỉ giúp ta hiểu thêm về thế giới, mà còn giúp ta hiểu rõ hơn về chính mình.</small>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item me-3">
                        <a href="{{ route('orders.index') }}" class="nav-link position-relative">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item me-3">
                            <a href="{{ route('profile') }}" class="nav-link btn btn-outline-info">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <form action="{{ route('products.index') }}" method="GET">
        <div class="row mb-5">
            <div class="col-lg-6 mx-auto">
                <div class="input-group rounded shadow-sm">
                    <input type="text" class="form-control" name="search" placeholder="Search for products..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-dark">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Featured Products Carousel -->
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
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Intro Section -->
    <div class="intro-section my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('uploads/category/Phenikaa.jpg') }}" alt="Intro Image" class="img-fluid rounded">
                </a>
            </div>
            <div class="col-md-6">
                <h2 class="mb-3" style="color: rgb(35, 65, 95); font-family: 'Dancing Script', cursive;">Giới thiệu về BrainyReads</h2>
                <p class="lead">
                    BrainyReads là nơi bạn có thể tìm thấy những quyển sách chất lượng, giúp bạn mở rộng kiến thức và khám phá những câu chuyện thú vị.
                    Chúng tôi cung cấp đa dạng các thể loại sách, từ kinh doanh, tâm lý, nghệ thuật đến khoa học và công nghệ. Hãy cùng khám phá và trải nghiệm!
                </p>
                <p class="lead" style="color: rgb(255, 0, 0); font-family: Charmonman;">
                    If you can't fly, then run. If you can't run, then walk. If you walk, then crawl.
                    But no matter what you do, you must keep moving forward.
                </p>
            </div>
        </div>
    </div>

    <!-- Category Buttons Section -->
    <div class="category-section mb-5 text-center">
        <h2 style="color:rgb(35, 65, 95);">SÁCH DÀNH CHO BẠN</h2>
        @php $colors = ['btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-dark']; @endphp
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Tất cả các sách</a>
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Category Product Sliders -->
    @foreach($categories as $category)
        <div class="category-row mb-5">
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
            <div class="scroll-container position-relative">
                <button class="left-arrow" onclick="scrollLeft('slider{{ $category->id }}')">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <div id="slider{{ $category->id }}" class="product-slider">
                    @forelse($category->products as $product)
                        <div class="card product-card" style="width: 250px; margin-right: 1rem;">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img-top rounded" style="height:200px; object-fit:cover; border-radius:15px;">
                            @else
                                <div class="d-flex justify-content-center align-items-center bg-light rounded" style="height:200px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
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
                    @empty
                        <div class="w-100">
                            <p class="text-muted">Không có sản phẩm nào trong danh mục này.</p>
                        </div>
                    @endforelse
                </div>
                <button class="right-arrow" onclick="scrollRight('slider{{ $category->id }}')">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>
    @endforeach

    <!-- Modal Mua Hàng cho từng sản phẩm -->
    @foreach($categories as $category)
        @foreach($category->products as $product)
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
        @endforeach
    @endforeach

    <!-- Feedback Section -->
    <footer class="custom-footer">
        <div class="container">
            <div class="newsletter-content d-flex justify-content-center align-items-center flex-nowrap text-center">
                <i class="fa fa-envelope me-2" style="font-size: 24px;"></i>
                <span class="me-3" style="font-size: 18px; font-weight: bold; white-space: nowrap;">HÒM THƯ GÓP Ý</span>
                <form action="{{ route('suggestions.store') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    @if(Auth::check())
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    @endif
                    <input type="text" name="message" class="form-control me-2" placeholder="Nhập ý kiến của bạn" required style="max-width: 400px;">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
        </div>
    </footer>

    <!-- Footer Contact & Info -->
    <footer class="bg-light py-4">
        <div class="container">
            <div class="row">
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
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-3">Hỗ trợ khách hàng</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Hình thức thanh toán</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Chính sách đổi trả</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-3">Sản phẩm</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Doanh nhân và Doanh nghiệp</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Nghệ thuật sống - Tâm lý</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Sức khỏe - Hạnh phúc</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Tài chính cá nhân</a></li>
                    </ul>
                </div>
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
        <p class="mb-0">© 2025 BrainyReads. All Rights Reserved.</p>
    </footer>
</div>

<!-- JavaScript & Fonts -->
<style>
    .custom-footer {
        background-color: rgb(35, 65, 95);
        color: #ffffff;
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
    .product-card {
        border: 2px solid #ddd;
        border-radius: 30px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .product-card:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
    .price-badge {
        background-color: #ff5722 !important;
        color: #ffffff !important;
        font-weight: bold;
    }
</style>
<style>
    .product-slider {
        overflow-x: auto;
        display: flex;
        flex-wrap: nowrap;
        justify-content: flex-start;
        scroll-behavior: smooth;
        padding: 1rem 3rem;
    }
    .product-slider .product-card {
        flex: 0 0 250px !important;
        width: 250px !important;
        margin-right: 1rem;
    }
    .product-slider::-webkit-scrollbar {
        display: none;
    }
    .left-arrow, .right-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        padding: 0.5rem;
        cursor: pointer;
        border-radius: 50%;
    }
    .left-arrow {
        left: 10px;
    }
    .right-arrow {
        right: 10px;
    }
    .price-badge {
        background-color: #ff5722 !important;
        color: #fff !important;
        font-weight: bold;
    }
</style>
<script>
    function scrollLeft(id) {
        var container = document.getElementById(id);
        container.scrollBy({ left: -300, behavior: 'smooth' });
    }
    function scrollRight(id) {
        var container = document.getElementById(id);
        container.scrollBy({ left: 300, behavior: 'smooth' });
    }
</script>
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&family=Charmonman:wght@400;700&display=swap" rel="stylesheet">
@endsection
