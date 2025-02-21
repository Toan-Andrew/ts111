<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     public function index(Request $request)
{
    // Nếu có truyền tham số 'category' thì chỉ lấy danh mục đó và các sản phẩm của nó
    if ($request->has('category') && $request->category != null) {
         $categories = Category::with('products')
                            ->where('id', $request->category)
                            ->get();
    } else {
         // Lấy tất cả các danh mục kèm theo sản phẩm của từng danh mục
         $categories = Category::with('products')->get();
    }
    
    return view('products.index', compact('categories'));
}


     

    public function admin(): View
    {
        $products = Product::latest()->paginate(5);

        return view('products.admin', compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function showdetail2($id)
{
    $product = Product::findOrFail($id);
    return view('products.showdetail2', compact('product'));
}
public function buy(Request $request, $id)
{
    $product = Product::findOrFail($id);

    Order::create([
        'name'       => $request->name,
        'phone'      => $request->phone,
        'address'    => $request->address,
        'email'      => $request->email,  // Lấy email từ form, không dùng Auth::user()->email nếu bạn muốn dùng dữ liệu nhập từ form
        'price'      => $product->price,
        'order_time' => now(),
        'img'        => $product->image ?? 'default_image.jpg', // Nếu cần lưu hình ảnh sản phẩm
    ]);

    return redirect()->route('products.index')->with('success', 'Your order has been placed successfully!');
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // Lấy phần mở rộng của file
            $filename = time() . '.' . $extension; // Tạo tên file duy nhất
            $file->move(public_path('uploads/product/'), $filename); // Lưu file vào thư mục
            $validated['image'] = 'uploads/product/' . $filename; // Lưu đường dẫn vào database
        }

        // Tạo sản phẩm với dữ liệu đã xác thực
        Product::create($validated);

        return redirect()->route('products.admin')
                         ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh khi cập nhật
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/product/'), $filename);
            $validated['image'] = 'uploads/product/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('products.admin')
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.admin')
                         ->with('success', 'Product deleted successfully.');
    }
    /**
     * Phần Category_id.
     */
    
}