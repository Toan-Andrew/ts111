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
                    <button id="btnShowCategories" class="btn btn-outline-light btn-lg mx-2">
                        Loại sách
                    </button>
                </li>
                <li class="nav-item">
                    <a id="btnShowOrders" href="{{ route('ordersAdmin.index') }}" class="btn btn-outline-warning btn-lg mx-2">
                        Danh sách đặt hàng
                    </a>
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

<!-- Nội dung chính: Categories -->
<div class="container mt-5 pt-5">
    <h1 class="mb-4 text-center">Danh mục sách</h1>
    <div class="row">
        @foreach($categories as $category)
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
            <div class="card shadow-lg border-0 rounded">
                <img src="{{ asset($category->image) }}" class="card-img-top rounded-top"
                    style="height: 180px; object-fit: cover;" alt="{{ $category->name }}">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">{{ $category->name }}</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('categories.showProducts', $category->id) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i> Xem sản phẩm
                        </a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-pen"></i> Chỉnh sửa
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fa fa-trash"></i> Xóa
                            </button>
                        </form>
                        <a href="{{ route('categories.createProduct', $category->id) }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Thêm sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination cho Categories -->
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
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