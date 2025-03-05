@extends('products.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Đơn mua hàng</h1>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <!-- Nút "Giỏ hàng": chuyển đến trang xem đơn hàng -->
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Trở về</a>
        <a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm">Giỏ hàng</a>
    </div>
    {{-- Giả sử $orders là danh sách các đơn hàng --}}
    @foreach($orders as $order)
        <div class="card mb-4 shadow-sm">
            <!-- Header: Hiển thị trạng thái đơn hàng -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    @if($order->status === 'paid')
                        <span class="badge bg-success">Giao hàng thành công</span>
                        <span class="text-danger fw-bold ms-2">HOÀN THÀNH</span>
                    @elseif($order->status === 'shipping')
                        <span class="badge bg-warning text-dark">Đang vận chuyển</span>
                    @else($order->status === 'wait')
                        <span class="badge bg-secondary">Chờ phê duyệt</span>
                    @endif
                </div>
                <div>
                    <!-- <button class="btn btn-link text-decoration-none p-0">
                        <small>Xem Shop</small>
                    </button> -->
                </div>
            </div>

            <!-- Body: Hiển thị thông tin sản phẩm của đơn hàng -->
            <div class="card-body">
                <div class="row g-3 align-items-center mb-3 border-bottom pb-3">
                    <div class="col-auto">
                        @if($order->product && $order->product->image)
                            <img src="{{ asset($order->product->image) }}" alt="Product Image" 
                                class="img-fluid rounded" 
                                style="width: 80px; height:80px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-product.png') }}" alt="Default Image" 
                                class="img-fluid rounded" 
                                style="width: 80px; height:80px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col">
                        <h5 class="mb-1">{{ $order->product->name }}</h5>
                        {{-- Nếu có thông tin phân loại (variation) sản phẩm, bạn có thể hiển thị tại đây --}}
                        <!-- <p class="mb-1 text-muted">
                            Phân loại hàng: {{ $order->product->variation ?? 'N/A' }}
                        </p> -->
                        <p class="mb-0">
                            Số lượng: <strong>{{ $order->quantity }}</strong>
                        </p>
                    </div>
                    <div class="col-auto text-end">
                        {{-- Hiển thị giá gốc nếu có và lớn hơn giá bán --}}
                        <!-- @if($order->product && $order->product->original_price && $order->product->original_price > $order->product->price)
                            <div class="text-decoration-line-through text-muted">
                                {{ number_format($order->product->original_price, 0) }}$
                            </div>
                        @endif -->
                        <div class="fs-5 fw-bold text-danger">
                            {{ number_format($order->price, 0) }}$
                        </div>
                    </div>
                </div>
                
                <!-- Thông tin giao hàng -->
                <div class="mb-3">
                    <p class="mb-1"><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
                    <p class="mb-1"><strong>SĐT:</strong> {{ $order->phone }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                </div>
            </div>

            <!-- Footer: Tổng tiền và nút hành động -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <span class="me-3">
                        Thành tiền: 
                        <strong class="text-danger">
                            {{ number_format($order->price * $order->quantity, 0) }}$
                        </strong>
                    </span>
                </div>
            </div>
        </div>
    @endforeach



</div>
@endsection
