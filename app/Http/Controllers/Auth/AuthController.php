<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Kiểm tra thông tin đăng nhập
        $credentials = $request->only('email', 'password');
    
        // Nếu là admin và mật khẩu chính xác
        if ($credentials['email'] === 'admin@gmail.com' && $credentials['password'] === 'admin123456') {
            // Đăng nhập tài khoản admin
            $user = User::where('email', 'admin@gmail.com')->first();
    
            Auth::login($user); // Đăng nhập
    
            // Chuyển hướng đến trang admin và truyền thông tin admin vào view
            return redirect()->route('categories.index') // Chuyển hướng đến trang admin
                             ->with('user', $user) // Truyền thông tin user vào view
                             ->withSuccess('Welcome Admin!');
        }
    
        // Kiểm tra đăng nhập thông thường với các tài khoản khác
        if (Auth::attempt($credentials)) {
            return redirect()->intended('products') // Chuyển hướng đến trang dashboard cho người dùng bình thường
                             ->withSuccess('You have Successfully logged in');
        }
    
        // Nếu thông tin không hợp lệ
        return redirect("login")->withError('Oops! You have entered invalid credentials');
    }
    
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',       // Ít nhất 8 ký tự
                'confirmed',   // Phải trùng với password_confirmation
                // Regex: đảm bảo có ít nhất một chữ cái và một số
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái và một số, và có độ dài tối thiểu 8 ký tự.',
        ]);

        // Tiếp tục tạo người dùng (sử dụng Hash để mã hóa mật khẩu)
        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Sau khi tạo thành công, có thể đăng nhập tự động hoặc chuyển hướng về trang khác
        return redirect()->route('login')->with('success', 'Tài khoản của bạn đã được tạo thành công!');
    }

    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }

    public function showChangePasswordForm(): View
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('products.index')
                        ->withSuccess('Mật khẩu đã được cập nhật thành công!');
    }
}