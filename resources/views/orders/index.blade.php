@extends('products.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Danh sách mua hàng</h1>
    <div class="row">
        @foreach($orders as $order)
        <div class="col-md-4 mb-4">
            <div class="card order-card shadow-sm border-0">
                <!-- Phần hình ảnh với overlay hiển thị Order ID -->
                <div class="order-image">
                    <img src="{{ asset($order->img) }}" class="card-img-top" alt="Order Image" style="height:200px; object-fit: cover;">
                    <div class="order-overlay">
                        <span class="order-id">Order #{{ $order->id }}</span>
                    </div>
                </div>
                <!-- Nội dung chi tiết đơn hàng -->
                <div class="card-body">
                    <h5 class="card-title">{{ $order->product->name }}</h5>
                    <p class="card-text">
                        <strong>Giá sản phẩm:</strong> ${{ number_format($order->price, 2) }}<br>
                        <strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($order->order_time)->format('d M Y, H:i') }}
                    </p>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $order->id }}">
                            Chi tiết
                        </button>
                        <!-- Form xóa đơn hàng -->
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Trở lại</a>
    </div>
</div>

<!-- Modal hiển thị chi tiết sản phẩm (nếu cần) -->
@foreach($orders as $order)
<div class="modal fade" id="viewProductModal{{ $order->id }}" tabindex="-1" aria-labelledby="viewProductModalLabel{{ $order->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="viewProductModalLabel{{ $order->id }}">Chi tiết đơn hàng</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-6">
                @if($order->img)
                <img src="{{ asset($order->img) }}" alt="{{ $order->name }}" class="img-fluid rounded">
                @else
                <img src="{{ asset('images/default-product.png') }}" alt="Default Image" class="img-fluid rounded">
                @endif
            </div>
            <div class="col-md-6">
                <h3>{{ $order->product->name }}</h3>
                <h4 class="text-success">${{ number_format($order->price, 2) }}</h4>
                <p><strong>Mô tả:</strong> {{ $order->product->detail ?? 'No description available.' }}</p>
                <p><strong>Thời gian đặt hàng:</strong> {{ \Carbon\Carbon::parse($order->order_time)->format('d M Y, H:i') }}</p>
            </div>
         </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<style>
    .order-card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .order-image {
        position: relative;
    }
    .order-card .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s;
    }
    .order-card:hover .card-img-top {
        transform: scale(1.05);
    }
    .order-overlay {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.6);
        padding: 5px 10px;
        border-radius: 5px;
    }
    .order-overlay .order-id {
        color: #fff;
        font-weight: bold;
    }
</style>
@endsection
