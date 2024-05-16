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

    public function listUser()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Lấy danh sách người dùng phân trang
            $users = User::paginate(10); // Số lượng người dùng trên mỗi trang 

            // Trả về view 'auth.home' với dữ liệu người dùng phân trang
            return view('manager.manageruser', ['users' => $users]);
        }

        // Nếu người dùng chưa đăng nhập
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    
    // chuyển sang trang sửa thông tin user
    public function editUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);
        return view('manager.edituser', ['user' => $user]);
    }

    //sửa thông tin user 
    public function cfeditUser(Request $request)
    {
        // Lấy thông tin từ request
        $userId = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $sex = $request->input('sex');
        $role = $request->input('role');
        $password = $request->input('password');
        $image = $request->file('image'); // Lấy file hình ảnh từ request

        // Cập nhật thông tin người dùng
        $user = User::findOrFail($userId);
        $user->email = $email;
        // Kiểm tra xem mật khẩu có được cập nhật không, nếu có thì mã hóa nó trước khi lưu vào cơ sở dữ liệu
        if ($password) {
            $user->password = bcrypt($password);
        }
        $user->save();

        // Cập nhật thông tin hồ sơ người dùng
        $userProfile = UserProfile::where('user_id', $userId)->firstOrFail();
        $userProfile->name = $name;
        $userProfile->phone = $phone;
        $userProfile->address = $address;
        $userProfile->sex = $sex;

        // Kiểm tra xem có tệp hình ảnh mới được tải lên không
        if ($image) {
            // Đọc và mã hóa hình ảnh thành dữ liệu base64
            $base64Image = base64_encode(file_get_contents($image));
            // Cập nhật dữ liệu base64 vào hồ sơ người dùng
            $userProfile->image = $base64Image;
        }

        $userProfile->save();

        // Redirect hoặc trả về phản hồi
        return redirect()->route('manageruser')->with('success', 'User information updated successfully.');
    }
}
