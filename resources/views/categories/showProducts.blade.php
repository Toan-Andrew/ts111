@extends('products.layout')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Product List</h2>
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('categories.index') }}">
            <i class="fa fa-arrow-left"></i> Back to Categories
        </a>
    </div>

    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Nút thêm sản phẩm -->
    <div class="text-end mb-3">
        <a class="btn btn-success" href="{{ route('categories.createProduct',  $category->id) }}">
            <i class="fa fa-plus"></i> Create New Product
        </a>
    </div>

    <!-- Giao diện thẻ sản phẩm -->
    <div class="row">
        @forelse ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded">
                <div class="position-relative">
                    @if($product->image)
                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}"
                        style="height: 220px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/220" class="card-img-top" alt="No Image">
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="card-title text-primary">{{ Str::limit($product->name, 25) }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->detail, 60) }}</p>
                    <h6 class="text-success">${{ number_format($product->price, 2) }}</h6>

                    <ul class="list-unstyled small">
                        
                        <li><strong>Material:</strong> {{ $product->material }}</li>
                        <li><strong>Frame:</strong> {{ $product->frame ? 'Yes' : 'No' }}</li>
                        <li><strong>Condition:</strong> {{ $product->condition }}</li>
                    </ul>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">No products available.</div>
        </div>
        @endforelse
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center mt-4">
        {!! $products->links() !!}
    </div>
</div>

@endsection
