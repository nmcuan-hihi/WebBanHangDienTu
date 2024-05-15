<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\LoginNotification;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function toLogin()
    {

        return view('auth.login');
    }
    public function tochecktocken()
    {
        return view('manager.checktocken');
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra vai trò của người dùng
            if ($user->role === 'admin') {
                // Tạo token ngẫu nhiên
                $token = Str::random(6);

                // Lưu token vào bảng personal_access_tokens
                DB::table('personal_access_tokens')->insert([
                    'tokenable_id' => $user->id,
                    'tokenable_type' => User::class,
                    'name' => 'login-token',
                    'token' => $token,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $message = "Admin Login to Webbanhang";

                // Gửi email với token
                Mail::to($user->email)->send(new LoginNotification($message, $token));


                return redirect()->route('token')->with('email', $user->email);
            } else if ($user->role === 'custom') {
                return redirect()->intended('home')->withSuccess('Signed in');
            } else {
                return redirect()->route('login')->withErrors('Login FAIL');
            }
        }

        return redirect()->route('login')->withErrors('Login FAIL');
    }
    public function gohome(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // // Lấy danh sách người dùng phân trang
            //  $product = Product::paginate(20); // Số lượng trên mỗi trang 
            $products = Product::paginate(3);
            return view('auth.home', compact('products'));
            // Trả về view 'auth.home' với dữ liệu người dùng phân trang
            // return view('auth.home', ['product' => $product]);
            // return view('auth.home', ['users' => $users]);
        }

        // Nếu người dùng chưa đăng nhập
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function gomanager(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Lấy thông tin người dùng đăng nhập
            $user = Auth::user();

            // Lấy thông tin token được gửi từ form
            $token = $request->input('token');

            // Kiểm tra token có hợp lệ không
            $tokenData = DB::table('personal_access_tokens')
                ->where('tokenable_id', $user->id)
                ->where('tokenable_type', 'App\Models\User')
                ->where('name', 'login-token')
                ->where('token', $token)
                ->first();

            if ($tokenData) {
                // Kiểm tra token đã hết hạn chưa (ví dụ: trong vòng 10 phút)
                $tokenCreatedAt = Carbon::parse($tokenData->created_at);
                $tokenExpiresAt = $tokenCreatedAt->addMinutes(10);
                if ($tokenExpiresAt->isPast()) {
                    return redirect()->back()->withErrors('Token da het han');
                }

                // Token hợp lệ, thực hiện công việc cần thiết
                $products = Product::paginate(7);
                $categories = Category::all();
                return view('manager.managerhome', compact('products', 'categories'));
            } else {
                // Token không hợp lệ
                return redirect()->back()->withErrors('Invalid token.');
            }
        }

        // Nếu người dùng chưa đăng nhập
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
