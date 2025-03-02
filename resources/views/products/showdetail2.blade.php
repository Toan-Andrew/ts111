@extends('products.layout')

@section('content')
<div class="container mt-5">
    @if(isset($product))
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/500x500" class="img-fluid rounded shadow" alt="Placeholder Image">
                @endif
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h1 class="display-5 text-primary">{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->detail }}</p>
                <div class="price-section d-flex align-items-center">
                    <h3 class="text-success me-3">Giá sản phẩm: {{ number_format($product->price, 2)  }}$</h3>
                    @if($product->discount_price)
                        <h5 class="text-danger text-decoration-line-through">${{ number_format($product->original_price, 2) }}</h5>
                    @endif
                </div>
                <p class="text-info">Số lượng còn lại: <strong>{{ $product->quantity }}</strong></p>
                @if($product->quantity <= 5 && $product->quantity > 0)
                    <p class="text-warning">⚠️ Sắp hết hàng!</p>
                @elseif($product->quantity == 0)
                    <p class="text-danger">⛔ Hết hàng!</p>
                @endif

                <!-- Các nút hành động -->
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Trở lại</a>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pdfPreviewModal">Đọc trước</button>
                    @if($product->quantity > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buyProductModal">Mua ngay</button>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="number" name="quantity" class="form-control me-2" min="1" max="{{ $product->quantity }}" value="1" style="width: 80px;">
                                <button type="submit" class="btn btn-outline-primary">Thêm vào giỏ</button>
                            </form>
                    @else
                        <button class="btn btn-secondary" disabled>Hết hàng</button>
                    @endif
                </div>
            </div>
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif



                <!-- Modal hiển thị PDF -->
                <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pdfPreviewModalLabel">Bản xem trước sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ asset($product->preview) }}" frameborder="0" style="width:100%; height:600px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form Mua Hàng -->
        <div class="modal fade" id="buyProductModal" tabindex="-1" aria-labelledby="buyProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('products.buy', $product->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="buyProductModalLabel">Order Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Delivery Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary w-100">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger">Product not found!</div>
    @endif

    <!-- Phần Sản phẩm tương tự -->

    <div class="similar-products mt-5">
        <h3 class="text-center mb-4">Sản phẩm tương tự</h3>
        <div class="row">
            @forelse($similarProducts as $similar)
                <div class="col-md-3 mb-4">
                    <div class="card product-card">
                        @if($similar->image)
                            <img src="{{ asset($similar->image) }}" class="card-img-top rounded" alt="{{ $similar->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/500x500" class="card-img-top rounded" alt="Placeholder Image">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($similar->name, 30) }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($similar->detail, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="price-badge">${{ number_format($similar->price, 2) }}</span>
                                    <a href="{{ route('products.showdetail2', $similar->id) }}" class="btn btn-outline-dark btn-sm">Chi tiết</a>  
                                </div>
                            <div class="mt-auto">
                                
                                <button type="button" class="btn btn-success btn-sm mt-2 w-100" data-bs-toggle="modal" data-bs-target="#buyProductModal{{ $similar->id }}">
                                    Mua ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Không có sản phẩm tương tự.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Mua Hàng cho từng sản phẩm tương tự -->
    @foreach($similarProducts as $similar)
    <div class="modal fade" id="buyProductModal{{ $similar->id }}" tabindex="-1" aria-labelledby="buyProductModalLabel{{ $similar->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('products.buy', $similar->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="buyProductModalLabel{{ $similar->id }}">Thông tin đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name{{ $similar->id }}" class="form-label">Your Name</label>
                            <input type="text" name="name" id="name{{ $similar->id }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone{{ $similar->id }}" class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="phone{{ $similar->id }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address{{ $similar->id }}" class="form-label">Delivery Address</label>
                            <input type="text" name="address" id="address{{ $similar->id }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email{{ $similar->id }}" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email{{ $similar->id }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Footer -->
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


    <!-- Footer -->
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
@endsection
<style>
    .price-badge {
        background-color: #ff5722 !important;
        color: #fff !important;
        font-weight: bold;
        
        border: 2px solid #ddd; /* viền nhẹ */
        border-radius: 30px; /* bo tròn viền */
        transition: transform 0.3s, box-shadow 0.3s;
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