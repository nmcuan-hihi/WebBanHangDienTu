<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
class CartController extends Controller
{
    public function index()
    {
        return view('auth.cart');
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

        return redirect()->route('add.cart')->with('success', 'Product added to cart successfully.');
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $action = $request->input('action');
    
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);
    
        // Kiểm tra xem sản phẩm có trong giỏ hàng không
        if (isset($cart[$productId])) {
            // Nếu có, thực hiện hành động tương ứng
            switch ($action) {
                case 'increase':
                    $cart[$productId]['quantity']++;
                    break;
                case 'decrease':
                    if ($cart[$productId]['quantity'] > 1) {
                        $cart[$productId]['quantity']--;
                    }
                    break;
            }
    
            // Lưu lại giỏ hàng đã cập nhật
            Session::put('cart', $cart);
        }
    
        // Redirect lại trang giỏ hàng
        return redirect()->route('add.cart');
    }
    public function removeItem(Request $request)
    {
        $productId = $request->input('product_id');
    
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);
    
        // Kiểm tra xem sản phẩm có trong giỏ hàng không
        if (isset($cart[$productId])) {
            // Nếu có, xóa sản phẩm khỏi giỏ hàng
            unset($cart[$productId]);
    
            // Lưu lại giỏ hàng đã cập nhật
            Session::put('cart', $cart);
        }
    
        // Redirect lại trang giỏ hàng
        return redirect()->route('add.cart');
    }
        

}
