<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;


class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::query();

        // Nếu có từ khóa tìm kiếm, lọc đơn hàng theo email, tên hoặc số điện thoại
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('email', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%');
            });
        }

        $orders = $query->latest()->paginate(5);

        return view('orders.index', compact('orders'));
    }
    public function search(Request $request): View
    {
        $query = Order::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                // Tìm kiếm theo tên sản phẩm qua quan hệ
                ->orWhereHas('product', function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            });
        }

        $orders = $query->latest()->paginate(6);

        return view('orders.search', compact('orders'));
    }





    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
    
    public function store(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }
        Order::create([
            'product_id' => $id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'quantity' => 1, // Nếu đặt hàng trực tiếp, mặc định là 1 sản phẩm
            'price' => $product->price, // Lấy giá từ sản phẩm đã tìm thấy
            'order_time' => now(),
            'status' => 'paid'
        ]);

        return redirect()->route('orders.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,shipping,paid',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }

    



}