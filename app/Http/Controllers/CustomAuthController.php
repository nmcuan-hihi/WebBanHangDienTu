<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    //delete user
    
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        
        // Tìm người dùng dựa trên ID
        $user = User::find($user_id);
    
        if ($user) {
            // Xóa hồ sơ người dùng nếu tồn tại
            $user->userProfile()->delete();
    
            // Xóa người dùng
            $user->delete();
    
            return redirect("manageruser")->withSuccess('Delete ok');
        } else {
            return redirect("manageruser")->withSuccess('User not found');
        }
    }
    
    
   
}
