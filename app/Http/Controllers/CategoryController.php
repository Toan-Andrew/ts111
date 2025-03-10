<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Suggestion;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        // Tìm kiếm các đơn hàng dựa trên email hoặc tên
        $orders = Order::query()
            ->when($search, function ($query) use ($search) {
                $query->where('email', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->latest()
            ->paginate(5); // Sử dụng 6 đơn hàng mỗi trang

        // Lấy danh sách các danh mục
        $categories = Category::latest()->paginate(6);

        // Lấy danh sách góp ý
        $suggestions = Suggestion::latest()->paginate(5);

        return view('categories.index', compact('orders', 'categories', 'suggestions'));
    }



    public function showProducts($categoryId): View
    {
        // Lấy danh mục theo ID
        $category = Category::findOrFail($categoryId);
        
        // Lấy các sản phẩm thuộc danh mục này
        $products = Product::where('category_id', $categoryId)->paginate(6);
        
        return view('categories.showProducts', compact('category', 'products'));
    }





    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category/'), $filename);
            $validated['image'] = 'uploads/category/' . $filename;
        }

        // Tạo danh mục mới
        $category = Category::create($validated);

        return redirect()->route('categories.index')
                     ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();

        // Debug: in ra dữ liệu validated
        // dd($validated);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category/'), $filename);
            $validated['image'] = 'uploads/category/' . $filename;
        }

        // Debug: in ra validated sau khi xử lý file
        // dd($validated);

        $category->update($validated);

        return redirect()->route('categories.index')
                        ->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

    public function createProduct($categoryId): View
{
    // Truyền category_id vào view
    return view('products.create', compact('categoryId'));
}

    /**
     * Store a newly created product in storage.
     */
    public function storeProduct(Request $request, $categoryId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'preview' => 'nullable|mimes:pdf|max:5120',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->price = $request->price;
        $product->quantity = $request->quantity; // Thêm số lượng sản phẩm
        $product->category_id = $categoryId;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/product/' . $filename;
            $file->move(public_path('uploads/product/'), $filename);
            
            $product->image = $filePath;  // Lưu đường dẫn vào DB
        }
        

        if ($request->hasFile('preview')) {
            $previewPath = $request->file('preview')->store('previews', 'public');
            $product->preview = $previewPath;
        }
        
        $product->save();
        

        return redirect()->route('categories.showProducts', ['categoryId' => $product->category_id])
            ->with('success', 'Sản phẩm đã được cập nhật!');
    }

}