<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrainyReads - Chào mừng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS Animation Library CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Fixed header */
        .fixed-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.7);
        }
        .fixed-header .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }
        /* Hero section */
        .hero-section {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }
        .hero-section img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }
        .hero-content h1 {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
        }
        /* Footer */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Fixed Header -->
    <header class="fixed-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">BrainyReads</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#intro">Giới thiệu</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" href="#testimonials">Khách hàng</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <img src="{{ asset('uploads\category\dsc012.jpg') }}" alt="Hero Background">
        <div class="hero-overlay"></div>
        <div class="hero-content" data-aos="fade-up">
            <h1>Chào mừng đến BrainyReads</h1>
            <p class="lead">Mình leo lên đỉnh núi không phải để cả thế giới ngước lên chiêm ngưỡng mình. 
                Mình leo lên đỉnh núi để chính mình có thể, chiêm ngưỡng cả thế giới.</p>
            <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary">Khám phá ngay</a>
        </div>
    </section>

    <!-- Intro Section -->
    <section id="intro" class="py-5">
        <div class="container" data-aos="fade-right">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('uploads\category\docsach.jfif') }}" alt="Lợi ích của đọc sách" class="img-fluid rounded">
                </div>
                <div class="col-md-6" data-aos="fade-left">
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
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Khách hàng nói gì</h2>
            <div class="row">
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="card p-3">
                        <p class="card-text">"BrainyReads đã thay đổi cách tôi nhìn nhận thế giới, mỗi cuốn sách là một hành trình."</p>
                        <h5 class="card-title">Nguyễn Văn A</h5>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-3">
                        <p class="card-text">"Sự đa dạng về thể loại sách ở đây thật tuyệt vời, luôn có điều mới mẻ để khám phá."</p>
                        <h5 class="card-title">Trần Thị B</h5>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card p-3">
                        <p class="card-text">"Một nguồn cảm hứng vô tận cho những tâm hồn yêu sách."</p>
                        <h5 class="card-title">Lê Văn C</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© 2025 BrainyReads. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 1000 });
    </script>
</body>
</html>
