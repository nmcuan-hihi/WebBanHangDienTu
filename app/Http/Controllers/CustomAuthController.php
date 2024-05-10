<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function toLogin()
    {
        return view('auth.login');
    }
    public function signout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function toRegister()
    {
        return view('auth.register');
    }


   // hàm đăng ký tài khoản
   public function createUser(Request $request)
{
    // Validate dữ liệu từ request
    $request->validate([
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'sex' => 'required|in:male,female',
        'role' => 'required|in:custom,admin',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
        // Thêm các quy tắc kiểm tra dữ liệu khác nếu cần thiết
    ]);

    // Lưu hình ảnh vào storage
    $imagePath = $request->file('image')->store('images');

    // Tạo một bản ghi mới trong bảng users
    $user = User::create([
        'email' => $request->email,
        'password' => bcrypt($request->password), // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
        'role' => $request->role,
    ]);

    // Tạo một bản ghi mới trong bảng user_profile
    $userProfile = UserProfile::create([
        'user_id' => $user->id,
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'sex' => $request->sex,
        'image' => $imagePath, // Lưu đường dẫn hình ảnh vào cơ sở dữ liệu
        // Thêm các trường dữ liệu khác nếu cần thiết
    ]);

    // Chuyển hướng người dùng đến trang đăng nhập
    return redirect()->route('login');
}
  


    public function checkUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra vai trò của người dùng
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('manager')->withSuccess('Signed in with admin');
                    break;
                case 'custom':
                    return redirect()->intended('home')->withSuccess('Signed in');
                default:
                redirect("login")->withSuccess('Login FAIL'); // gọi router có tên login
            }
        }

        redirect("login")->withSuccess('Login FAIL');
    }
    public function gohome(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // // Lấy danh sách người dùng phân trang
            // $users = User::paginate(20); // Số lượng trên mỗi trang 

            // // Trả về view 'auth.home' với dữ liệu người dùng phân trang
            return view('auth.home');
            // return view('auth.home', ['users' => $users]);
        }

        // Nếu người dùng chưa đăng nhập
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function gomanager(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // // Lấy danh sách người dùng phân trang
            // $users = User::paginate(20); // Số lượng trên mỗi trang 

            // // Trả về view 'auth.home' với dữ liệu người dùng phân trang
            return view('manager.managerhome');
            // return view('auth.home', ['users' => $users]);
        }

        // Nếu người dùng chưa đăng nhập
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
