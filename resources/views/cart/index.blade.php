@extends('products.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Giỏ hàng của bạn</h2>
    <!-- Phần nút điều hướng Giỏ hàng -->
    <div class="d-flex justify-content-end gap-2 mb-3">
        <!-- Nút "Giỏ hàng": chuyển đến trang xem đơn hàng -->
        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">Đã thanh toán</a>
    </div>

    <div class="row">
        <!-- Left Column (80% - 10/12): Danh sách sản phẩm trong giỏ -->
        <div class="col-md-8">
            @if(count($cart) > 0)
                <!-- Dòng đầu: Chọn tất cả -->
                <div class="d-flex align-items-center mb-3">
                    <input type="checkbox" id="selectAll" class="form-check-input" />
                    <label for="selectAll" class="ms-2 fw-bold">
                        Chọn tất cả ({{ $totalItems }} sản phẩm)
                    </label>
                </div>
                <!-- Danh sách sản phẩm -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="cartTable">
                        <thead>
                            <tr>
                                <th>Chọn</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $key => $item)
                            <tr data-price="{{ $item['price'] }}">
                                <td>
                                    <input type="checkbox" class="form-check-input select-item" data-key="{{ $key }}">
                                </td>
                                <td>
                                    <img src="{{ asset($item['image']) }}"
                                         class="img-fluid rounded"
                                         style="width:80px; height:auto;"
                                         alt="{{ $item['name'] }}">
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <div class="input-group quantity-control">
                                        <button class="btn btn-outline-secondary btn-sm decrease-qty">-</button>
                                        <input type="text" 
                                               class="form-control form-control-sm text-center quantity-input" 
                                               value="{{ $item['quantity'] }}" 
                                               data-key="{{ $key }}" 
                                               style="max-width:50px;">
                                        <button class="btn btn-outline-secondary btn-sm increase-qty">+</button>
                                    </div>
                                </td>
                                @php 
                                    $subtotal = $item['price'] * $item['quantity'];
                                @endphp
                                <td class="subtotal">
                                    ${{ number_format($subtotal, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Giỏ hàng của bạn trống.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
            @endif
        </div>

        <!-- Right Column (20% - 2/12): Thông tin giao hàng & thanh toán -->
        <div class="col-md-4">
            @if(count($cart) > 0)
            <div class="card p-3 mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Thông tin giao hàng</h5>
                    <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="name" id="shipName" class="form-control" placeholder="Họ và Tên" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="phone" id="shipPhone" class="form-control" placeholder="Số điện thoại" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="address" id="shipAddress" class="form-control" placeholder="Địa chỉ" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" id="shipEmail" class="form-control" placeholder="Email" required>
                        </div>
                        
                        <!-- Thêm input hidden chứa danh sách sản phẩm được chọn -->
                        <input type="hidden" name="selected_items" id="selectedItems">
                        
                        <hr>
                        <h6>Tóm tắt đơn hàng</h6>
                        <p id="selectedItemsCount" class="mb-1">Sản phẩm: 0</p>
                        <p id="shippingFee" class="mb-1">Phí vận chuyển: $0.00</p>
                        <h6 id="billTotal" class="text-success">Tổng: $0.00</h6>
                        <button type="submit" class="btn btn-primary w-100 mt-2" id="checkoutButton">Thanh toán</button>
                    </form>

                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- JavaScript để xử lý checkbox, tăng giảm số lượng và tính tổng tiền --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.select-item');
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const selectedItemsCountEl = document.getElementById('selectedItemsCount');
    const shippingFeeEl = document.getElementById('shippingFee');
    const billTotalEl = document.getElementById('billTotal');
    const checkoutButton = document.getElementById('checkoutButton');

    function recalcTotal() {
        let selectedCount = 0;
        let total = 0;
        document.querySelectorAll('#cartTable tbody tr').forEach(row => {
            const checkbox = row.querySelector('.select-item');
            const quantityInput = row.querySelector('.quantity-input');
            const price = parseFloat(row.getAttribute('data-price'));
            let quantity = parseInt(quantityInput.value);
            if(checkbox && checkbox.checked) {
                total += price * quantity;
                selectedCount++;
            }
            row.querySelector('.subtotal').innerText = `$${(price * quantity).toFixed(2)}`;
        });
        // Phí vận chuyển: nếu sản phẩm được chọn < 3 thì phí = $3, ngược lại phí = 0
        let shippingFee = (selectedCount > 0 && selectedCount < 3) ? 3 : 0;
        selectedItemsCountEl.innerText = "Sản phẩm: " + selectedCount;
        shippingFeeEl.innerText = "Phí vận chuyển: $" + shippingFee.toFixed(2);
        billTotalEl.innerText = "Tổng: $" + (total + shippingFee).toFixed(2);
    }

    if(selectAllCheckbox){
        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(cb => cb.checked = this.checked);
            recalcTotal();
        });
    }

    itemCheckboxes.forEach(cb => {
        cb.addEventListener('change', recalcTotal);
    });

    document.querySelectorAll('.increase-qty').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.previousElementSibling;
            input.value = parseInt(input.value) + 1;
            recalcTotal();
        });
    });

    document.querySelectorAll('.decrease-qty').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.nextElementSibling;
            if(parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                recalcTotal();
            }
        });
    });

    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        let itemCheckboxes = document.querySelectorAll('.select-item');
        let selected = [];
        itemCheckboxes.forEach(cb => {
            if(cb.checked) {
                selected.push(cb.getAttribute('data-key'));
            }
        });
        
        if(selected.length === 0) {
            e.preventDefault();
            alert("Vui lòng chọn ít nhất 1 sản phẩm trước khi thanh toán!");
            return;
        }
        
        // Gán giá trị cho trường hidden
        document.getElementById('selectedItems').value = selected.join(',');
    });



    // Tính lại tổng ngay khi trang load
    recalcTotal();
});
</script>

@endsection
