<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Order;

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

        $orders = $query->latest()->paginate(6);

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



}