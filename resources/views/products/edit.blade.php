@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Chỉnh sửa sách</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('categories.index') }}"><i class="fa fa-arrow-left"></i>
                Trở lại</a>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Tên sách:</strong></label>
                <input type="text" name="name" value="{{ $product->name }}"
                    class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name">
                @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputDetail" class="form-label"><strong>Mô tả:</strong></label>
                <textarea class="form-control @error('detail') is-invalid @enderror" style="height:150px" name="detail"
                    id="inputDetail" placeholder="Detail">{{ $product->detail }}</textarea>
                @error('detail')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputPrice" class="form-label"><strong>Giá tiền:</strong></label>
                <input type="number" name="price" value="{{ $product->price }}"
                    class="form-control @error('price') is-invalid @enderror" id="inputPrice" placeholder="Price">
                @error('price')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="inputImage" class="form-label"><strong>Hình ảnh:</strong></label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="inputImage">

                @if($product->image)
                <div class="mt-2">
                    <strong>Hình ảnh trước đó:</strong><br>
                    <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" width="100">
                </div>
                @endif

                @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Thêm phần Preview (file PDF) -->
            <div class="mb-3">
                <label for="inputPreview" class="form-label"><strong>Preview (PDF):</strong></label>
                <input type="file" name="preview" class="form-control @error('preview') is-invalid @enderror" id="inputPreview" accept="application/pdf">
                @if(isset($product) && $product->preview)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $product->preview) }}" target="_blank" class="btn btn-outline-info btn-sm">
                            Xem Preview trước đó
                        </a>
                    </div>
                @endif
                @error('preview')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Cập nhật</button>
        </form>

    </div>
</div>
@endsection