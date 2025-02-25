@extends('products.layout')

@section('content')
<div class="card mt-5 custom-card">
    <h2 class="card-header custom-header">THÊM MỚI LOẠI SÁCH</h2>
    <div class="card-body">
        <!-- Nút quay lại danh mục -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
            <a class="btn custom-back-btn" href="{{ route('categories.index') }}">
                <i class="fa fa-arrow-left"></i> Trở về
            </a>
        </div>

        <!-- Form thêm danh mục với hiệu ứng floating label -->
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       id="inputName" placeholder="Category Name" value="{{ old('name') }}">
                <label for="inputName"><strong>Tên loại sách:</strong></label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                       id="inputImage" placeholder="Category Image">
                <label for="inputImage" style="color: black;"><strong>Hình ảnh minh họa:</strong></label>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn custom-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i> Tạo loại sách
            </button>
        </form>
    </div>
</div>

<!-- Inline CSS để tùy chỉnh giao diện -->
<style>
    /* Custom card style */
    .custom-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
    }
    /* Custom header with Dancing Script */
    .custom-header {
        background-color: #0D47A1;
        color: #fff;
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        text-align: center;
        padding: 1rem;
    }
    /* Floating label input fields */
    .form-floating > .form-control {
        border-radius: 10px;
        height: calc(3.5rem + 2px);
    }
    /* Custom Back Button */
    .custom-back-btn {
        background-color: #ff9800;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
        transition: transform 0.2s, background-color 0.2s;
    }
    .custom-back-btn:hover {
        transform: scale(1.05);
        background-color: #e68900;
    }
    /* Custom Submit Button */
    .custom-submit-btn {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        transition: background-color 0.3s, transform 0.2s;
        width: 100%;
        font-size: 1.1rem;
    }
    .custom-submit-btn:hover {
        background-color: #43a047;
        transform: scale(1.02);
    }
</style>
@endsection
