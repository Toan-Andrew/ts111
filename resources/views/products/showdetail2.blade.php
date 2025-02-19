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
            <h3 class="text-success">${{ number_format($product->price, 2) }}</h3>

            <!-- Nút Quay lại & Mua hàng -->
            <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back to Products</a>
            <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#buyProductModal">
                Buy Now
            </button>
        </div>
    </div>

    <!-- Modal Form Mua Hàng -->
    <div class="modal fade" id="buyProductModal" tabindex="-1" aria-labelledby="buyProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyProductModalLabel">Order Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.buy', $product->id) }}" method="POST">
                        @csrf
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
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @else
    <div class="alert alert-danger">Product not found!</div>
    @endif
    <!-- Product list -->
    <!--Footter -->
    <!-- Footter -->
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
</div>

@endsection