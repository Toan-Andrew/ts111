@extends('products.layout')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative">
    <!-- Background Image -->
    <img src="{{ asset('uploads\category\dsc012.jpg') }}" alt="Hero Background" class="img-fluid w-100" style="height: 100vh; object-fit: cover;">
    <!-- Overlay mờ -->
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5);"></div>
    <!-- Nội dung hero -->
    <div class="hero-content position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 style="font-size: 3rem; font-family: 'Dancing Script', cursive;">Chào mừng đến BrainyReads</h1>
        <p class="lead">Mình leo lên đỉnh núi không phải để cả thế giới ngước lên chiêm ngưỡng mình. Mình leo lên đỉnh núi để chính mình có thể, chiêm ngưỡng cả thế giới.</p>
        <a href="{{ route('login') }}" class="btn btn-lg btn-primary">Đăng nhập ngay</a>
    </div>
</div>

<!-- Phần giới thiệu  -->
<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-5">
            <img src="{{ asset('uploads\category\docsach.jfif') }}" alt="Lợi ích của đọc sách" class="img-fluid rounded">
        </div>
        <div class="col-md-5">
            <h2 style="color: rgb(35, 65, 95);">Tại sao đọc sách?</h2>
            <ul class="list-unstyled lead">
                <li>📖 Mở rộng kiến thức và khám phá thế giới.</li>
                <li>🧠 Cải thiện trí nhớ và sự tập trung.</li>
                <li>🎨 Kích thích sự sáng tạo và trí tưởng tượng.</li>
                <li>💆‍♀️ Giảm căng thẳng và mang lại niềm vui.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
