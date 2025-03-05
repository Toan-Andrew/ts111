<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Lấy giá trị tìm kiếm từ request
    $search = $request->input('search');

    // Truy vấn đơn hàng, đồng thời truy cập thông tin từ bảng products
    $orders = Order::with('product') // Eager Load product
        ->when($search, function ($query) use ($search) {
            $query->whereHas('product', function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%"); // Tìm theo tên sản phẩm
            })->orWhere('phone', 'like', "%{$search}%"); // Tìm theo số điện thoại
        })
        ->latest()
        ->paginate(10);

        // Trả về view với dữ liệu đơn hàng và giá trị tìm kiếm
        return view('ordersAdmin.index', compact('orders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,shipping,paid',
        ]);

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái đơn hàng đã được cập nhật!',
            'status' => $order->status
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        // Nếu là AJAX request, trả về JSON
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Đơn hàng đã được xóa!']);
        }

        return redirect()->back()->with('success', 'Đơn hàng đã được xóa!');
    }


}
