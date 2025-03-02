@extends('products.layout')

@section('content')
<div class="card mt-5 custom-card">
    <h2 class="card-header custom-header">Thêm sản phẩm mới</h2>
    <div class="card-body">
        <!-- Nút Quay lại -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
            <a class="btn custom-back-btn" href="{{ route('categories.index') }}">
                <i class="fa fa-arrow-left"></i> Trở lại
            </a>
        </div>

        <!-- Form thêm sản phẩm -->
        <form action="{{ route('categories.storeProduct', ['categoryId' => $categoryId]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tên sách (Floating Label) -->
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       id="inputName" placeholder="Tên sách" value="{{ old('name') }}">
                <label for="inputName"><strong>Tên sách:</strong></label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô tả (Floating Label) -->
            <div class="form-floating mb-3">
                <textarea class="form-control @error('detail') is-invalid @enderror" style="height:150px" 
                          name="detail" id="inputDetail" placeholder="Mô tả">{{ old('detail') }}</textarea>
                <label for="inputDetail"><strong>Mô tả:</strong></label>
                @error('detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Giá tiền (Floating Label) -->
            <div class="form-floating mb-3">
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                       id="inputPrice" placeholder="Giá tiền" value="{{ old('price') }}">
                <label for="inputPrice"><strong>Giá tiền:</strong></label>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Số lượng sản phẩm (Floating Label) -->
                <div class="form-floating mb-3">
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" 
                        id="inputQuantity" placeholder="Số lượng sản phẩm" value="{{ old('quantity', 1) }}" min="1">
                    <label for="inputQuantity"><strong>Số lượng sản phẩm:</strong></label>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <!-- Ảnh minh họa (Floating Label) -->
            <div class="form-floating mb-3">
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                       id="inputImage" placeholder="Ảnh minh họa">
                <label for="inputImage" style="color: black;"><strong>Hình ảnh minh họa:</strong></label>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Preview (PDF) (Floating Label) -->
            <div class="form-floating mb-3">
                <input type="file" name="preview" class="form-control @error('preview') is-invalid @enderror" 
                       id="inputPreview" placeholder="Preview (PDF)" accept="application/pdf">
                <label for="inputPreview" style="color: black;"><strong>Preview (PDF):</strong></label>
                @error('preview')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn custom-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i> Lưu
            </button>
        </form>
    </div>
</div>

<!-- Inline CSS tùy chỉnh giao diện -->
<style>
    /* Custom card style */
    .custom-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
    }
    /* Custom header style */
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
