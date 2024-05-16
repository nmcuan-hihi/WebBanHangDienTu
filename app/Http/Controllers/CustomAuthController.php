<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

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
        if (Auth::check()) {
            return view('auth.home');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function gomanager(Request $request)
    {
        if (Auth::check()) {
            return view('manager.managerhome');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function toAddCategory()
    {
        $categories = Category::all();
        return view('manager.addcategory', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
    
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();
    
        return view('manager.managerhome')->with('success', 'Danh mục đã được thêm mới thành công.');
    }
    public function deleteCategorys(Request $request ){
        $category_id = $request->get('id');
        $category = Category::destroy($category_id);
        return redirect("manager.addcategory")->withSuccess('You have signed-in');
    }
}
