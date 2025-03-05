@extends('products.layout')

@section('content')
<!-- Common Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow fixed-top">
    <div class="container">
        <!-- Logo hoặc Brand -->
        <div class="d-flex flex-column">
            <h5>BrainyReads</h5>
            <small class="text-white">
                Sách không chỉ giúp ta hiểu thêm về thế giới, mà còn giúp ta hiểu rõ hơn về chính mình.
            </small>
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
                    <a id="btnShowCategories" href="{{ route('categories.index') }}" class="btn btn-outline-light btn-lg mx-2">
                        Loại sách
                    </a>
                </li>
                <li class="nav-item">
                    <button id="btnShowOrders" class="btn btn-outline-warning btn-lg mx-2">
                        Danh sách đặt hàng
                    </button>
                </li>
                <li class="nav-item">
                    <a id="btnShowSuggestions" href="{{ route('suggestions.index') }}" class="btn btn-outline-warning btn-lg mx-2">
                        Hòm thư góp ý
                    </a>
                </li>
                <li class="nav-item">
                    <a id="btnAdd" href="{{ route('categories.create') }}" class="btn btn-success btn-lg mx-2">
                        <i class="fa fa-plus"></i> Thêm loại sách mới
                    </a>
                </li>
                <li class="nav-item">
                    <button id="btnlogout" class="btn btn-danger btn-lg mx-2">
                        <a href="{{ route('logout') }}" class="text-white text-decoration-none">Đăng xuất</a>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Nội dung chính: Orders -->
<div class="container mt-5 pt-5">
    <h1 class="mb-4 text-center">Đơn mua hàng</h1>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Trở về</a>
        <a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm">Giỏ hàng</a>
    </div>

    <form method="GET" action="{{ route('ordersAdmin.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by email or name" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Thời gian đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
    @foreach($orders as $order)
    <tr class="text-center">
        <td>{{ $order->name }}</td>
        <td>{{ $order->phone }}</td>
        <td>{{ $order->address }}</td>
        <td>{{ $order->email }}</td>
        <td>{{ optional($order->product)->name ?? 'N/A' }}</td> <!-- Kiểm tra có sản phẩm không -->
        <td class="text-success">${{ number_format($order->price, 2) }}</td>
        <td>{{ $order->order_time }}</td>
        <td>
            <!-- Form cập nhật trạng thái đơn hàng -->
            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="status-form">
                @csrf
                @method('PUT')
                <select name="status" class="form-select order-status" data-id="{{ $order->id }}">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                    <option value="shipping" {{ $order->status === 'shipping' ? 'selected' : '' }}>Đang vận chuyển</option>
                    <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Thành công</option>
                </select>
            </form>
        </td>
        <td>
            <!-- Nút Xóa đơn hàng -->
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này không?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

        </table>
    </div>

    <!-- Pagination cho Orders -->
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
<style>
        #btnShowCategories,#btnAdd,#btnlogout,#btnShowSuggestions,
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
        #btnShowOrders:hover, #btnShowSuggestions:hover {
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

    if (!csrfTokenMeta) {
        console.error("CSRF Token meta tag not found!");
        return; // Không chạy tiếp nếu không có CSRF token
    }

    let csrfToken = csrfTokenMeta.getAttribute("content");

    document.querySelectorAll('.order-status').forEach(select => {
        select.addEventListener('change', function() {
            let orderId = this.getAttribute('data-id');
            let status = this.value;

            fetch(`/orders/${orderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Cập nhật trạng thái thành công!");
                } else {
                    alert("Lỗi: " + data.message);
                }
            })
            .catch(error => console.error('Lỗi:', error));
        });
    });
});

</script>

<script>
console.log("CSRF Token:", document.querySelector('meta[name="csrf-token"]'));
</script>

