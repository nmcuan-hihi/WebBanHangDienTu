<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends BaseController
{
    public function tocart()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            return view('auth.cart');
        }
        // Nếu người dùng chưa đăng nhập
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function addtocart(Request $request)
    {
        $product_id = $request->get('id');
        $quantity = $request->get('quantity', 1); // Mặc định số lượng là 1 nếu không có trong request
    
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);
    
        // Tìm sản phẩm từ cơ sở dữ liệu
        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$product_id])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
            $cart[$product_id] = [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'quantity' => $quantity,
                // Các thông tin sản phẩm khác bạn muốn lưu
            ];
        }
    
        // Lưu lại giỏ hàng vào session
        Session::put('cart', $cart);
    
        // Redirect với thông báo thành công
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
}
