@extends('products.layout')

@section('content')
<div class="container mt-5">
    <h1>Thông tin cá nhân</h1>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $user->name }}</h3>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Chưa cập nhật' }}</p>
            <p class="card-text"><strong>Địa chỉ:</strong> {{ $user->address ?? 'Chưa cập nhật' }}</p>
            <!-- Nút Edit Profile để mở modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                Edit Profile
            </button>
            <a href="{{ url('/products') }}" class="btn btn-secondary">Quay lại trang chủ</a>

        </div>
    </div>
</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Sửa tên -->
          <div class="mb-3">
            <label for="name" class="form-label">Họ và Tên</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
          </div>
          <!-- Sửa số điện thoại -->
          <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
          </div>
          <!-- Sửa địa chỉ -->
          <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
          </div>
          <!-- Bạn có thể thêm các trường khác nếu cần -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
