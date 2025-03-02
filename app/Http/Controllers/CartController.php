<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        // Kiểm tra tồn kho
        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho hiện có.');
        }

        // Lấy giỏ hàng từ session (nếu chưa có, tạo mảng rỗng)
        $cart = Session::get('cart', []);

        // Nếu sản phẩm đã tồn tại trong giỏ, cộng dồn số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => $quantity,
                'image'    => $product->image,
            ];
        }

        // Lưu giỏ hàng vào session
        Session::put('cart', $cart);

        // Lưu lịch sử giỏ hàng vào cơ sở dữ liệu
        $userId = Auth::check() ? Auth::id() : null;
        CartHistory::create([
            'user_id'    => $userId,
            'product_id' => $product->id,
            'quantity'   => $quantity,
        ]);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // Hiển thị giỏ hàng
    

    public function index()
    {
        // Lấy dữ liệu giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Tính tổng số sản phẩm trong giỏ (để hiển thị trong "Chọn tất cả (x sản phẩm)")
        $totalItems = 0;
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
        }

        return view('cart.index', compact('cart', 'totalItems'));
    }




    // Thanh toán giỏ hàng: trừ số lượng tồn kho của sản phẩm

    public function checkout(Request $request)
    {
        // Validate thông tin giao hàng
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'selected_items' => 'required'
        ]);

        $selectedItems = $request->input('selected_items'); // Dạng chuỗi "0,2,3"
        $selectedKeys = explode(',', $selectedItems);

        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        foreach($selectedKeys as $key) {
            if(isset($cart[$key])) {
                $item = $cart[$key];
                Order::create([
                    'product_id' => $item['id'],
                    'name'       => $request->name,
                    'phone'      => $request->phone,
                    'address'    => $request->address,
                    'email'      => $request->email,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'] * $item['quantity'],
                    'img'        => $item['image'] ?? 'default.jpg',
                    'order_time' => now(),
                    'status'     => 'paid'
                ]);
        
                // Cập nhật tồn kho cho từng sản phẩm
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('quantity', $item['quantity']);
                }
            }
        }
        


        // Xóa các mục đã thanh toán khỏi giỏ hàng
        foreach($selectedKeys as $key) {
            unset($cart[$key]);
        }
        session()->put('cart', $cart);

        return redirect()->route('orders.index')->with('success', 'Thanh toán thành công! Kiểm tra đơn hàng của bạn.');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantityToAdd = (int) $request->quantity;
        $currentQuantityInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $totalQuantity = $currentQuantityInCart + $quantityToAdd;

        // Kiểm tra nếu số lượng trong giỏ hàng vượt quá số lượng tồn kho
        if ($totalQuantity > $product->quantity) {
            return redirect()->back()->with('error', 'Số lượng đặt hàng vượt quá số lượng trong kho!');
        }

        // Thêm vào giỏ hàng
        $cart[$id] = [
            'name' => $product->name,
            'quantity' => $totalQuantity,
            'price' => $product->price,
            'image' => $product->image
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }




}
