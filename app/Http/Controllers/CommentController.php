<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function toviewcomment(Request $request)
    {
        // Lấy product_id từ request
        $product_id = $request->query('id');

        // Lấy thông tin sản phẩm và danh sách comment
        $product = Product::findOrFail($product_id);
        $comments = $product->comments;

        // Trả về view hiển thị danh sách comment của sản phẩm
        return view('auth.comments', compact('product', 'comments'));
    }
}
