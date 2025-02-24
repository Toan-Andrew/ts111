<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    // Lấy danh sách người dùng
    public function index()
    {
        return UserResource::collection(User::all());
    }

    // Lấy chi tiết người dùng
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function store(Request $request)
{
    // Xác thực dữ liệu nhập vào (validation)
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        // Tạo người dùng mới và lưu vào cơ sở dữ liệu
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),  // Mã hóa mật khẩu
        ]);

        // Trả về tài nguyên người dùng đã được tạo
        return new UserResource($user);

    } catch (\Exception $e) {
        // Xử lý lỗi khi tạo người dùng
        return response()->json([
            'error' => 'Có lỗi xảy ra khi tạo người dùng',
            'message' => $e->getMessage()
        ], 500);
    }}
    public function profile(Request $request)
    {
        $user = auth()->user(); // Lấy thông tin user hiện tại
        return view('user.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate dữ liệu, bao gồm trường avatar nếu có
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra file ảnh
        ]);

        // Nếu có file avatar được upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Lưu file vào thư mục storage/app/public/uploads/avatars
            $path = $file->storeAs('uploads/avatars', $filename, 'public');
            $user->avatar = $path;
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
            // 'avatar' đã được cập nhật nếu có file upload
        ]);

        return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật!');
    }




}