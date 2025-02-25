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
        $allCategories = Category::all();
        // Lấy tham số tìm kiếm
        $search = $request->input('search');
        // Lấy tham số danh mục
        $categoryId = $request->input('category');

        // Khởi tạo query với eager loading products
        $query = Category::with(['products' => function ($q) use ($search) {
            // Nếu có từ khóa, thêm điều kiện where cho products
            if ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            }
        }]);

        // Nếu có tham số category, chỉ lấy 1 danh mục
        if ($categoryId) {
            $query->where('id', $categoryId);
        }

        // Lấy danh sách categories (với products đã được lọc)
        $categories = $query->get();

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
        // Lấy 4 sản phẩm cùng category, loại trừ sản phẩm hiện tại
        $similarProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->take(4)
                                ->get();

        return view('products.showdetail2', compact('product', 'similarProducts'));
    }

    public function buy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        Order::create([
            'product_id' => $product->id,
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

        // Xử lý file ảnh nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/product/'), $filename);
            $validated['image'] = 'uploads/product/' . $filename;
        }

        // Xử lý file preview (PDF) nếu có upload
        if ($request->hasFile('preview')) {
            $pdfFile = $request->file('preview');
            $pdfExtension = $pdfFile->getClientOriginalExtension();
            $pdfFilename = time() . '_preview.' . $pdfExtension;
            
            $destinationPath = public_path('uploads/product/previews/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Debug: kiểm tra file preview đã nhận được chưa
            // dd($pdfFile);

            $pdfFile->move($destinationPath, $pdfFilename);
            $validated['preview'] = 'uploads/product/previews/' . $pdfFilename;
        }

        // Tạo product mới với dữ liệu validated (bao gồm cả preview nếu có)
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

    // Xử lý file ảnh nếu có
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('uploads/product/'), $filename);
        $validated['image'] = 'uploads/product/' . $filename;
    }

    // Xử lý file preview (PDF) nếu có upload
    if ($request->hasFile('preview')) {
        $pdfFile = $request->file('preview');
        $pdfExtension = $pdfFile->getClientOriginalExtension();
        $pdfFilename = time() . '_preview.' . $pdfExtension;
        
        // Đường dẫn thư mục lưu file preview
        $destinationPath = public_path('uploads/product/previews/');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        
        $pdfFile->move($destinationPath, $pdfFilename);
        $validated['preview'] = 'uploads/product/previews/' . $pdfFilename;
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