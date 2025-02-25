@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Danh sách sản phẩm</h2>
    <div class="card-body">

        @session('success')
        <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <div class="d-flex justify-content-end gap-2">
            <a class="btn btn-secondary btn-sm" href="{{ route('categories.index') }}">
                Trở lại
            </a>
            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">
                <i class="fa fa-plus"></i> Thêm sách mới
            </a>
        </div>


        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Tên sách</th>
                    <th>Mô tả</th>
                    <th>Giá tiền</th> <!-- Thêm cột Price -->
                    <th>Hình ảnh</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->detail }}</td>
                    <td>{{ $product->price }} </td> <!-- Hiển thị giá -->
                    <td>
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" width="100">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                            <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}"> 
                            <i class="fa fa-eye"></i> Xem chi tiết</a>

                            <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}">
                            <i class="fa fa-pen"></i>  Chỉnh sửa</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">There are no data.</td>
                </tr>
                @endforelse
            </tbody>

        </table>

        {!! $products->links() !!}

    </div>
</div>
@endsection