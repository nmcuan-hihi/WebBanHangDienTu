<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
    public function addToCart(Request $request)
    {
        $product = json_decode($request->input('product'));
        $quantity = $request->input('quantity', 1);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$product->product_id])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên
            $cart[$product->product_id]['quantity'] += $quantity;
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
            $cart[$product->product_id] = [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'quantity' => $quantity,
                // Các thông tin sản phẩm khác bạn muốn lưu
            ];
        }

        // Cập nhật giỏ hàng trong session
        Session::put('cart', $cart);

       //  trả về 
       return redirect()->back()->with('success', 'Product add from cart successfully!');
    }
    public function removetocart(Request $request)
    {
        $product_id = $request->get('product_id');
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$product_id])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$product_id]);

            // Lưu giỏ hàng cập nhật vào session
            Session::put('cart', $cart);

            // Redirect hoặc trả về phản hồi phù hợp
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }

        // Nếu sản phẩm không tồn tại trong giỏ hàng
        return redirect()->back()->with('error', 'Product not found in cart!');
    }
}