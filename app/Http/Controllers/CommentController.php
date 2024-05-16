<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function toviewcomment(Request $request)
    {
        // Lấy product_id từ request
        $product_id = $request->query('id');

        // Lấy thông tin sản phẩm và danh sách comment
        $product = Product::findOrFail($product_id);
        $comments = $product->comments()->orderBy('created_at', 'desc')->get(); // Sắp xếp comment theo thời gian tạo mới nhất

        // Trả về view hiển thị danh sách comment của sản phẩm
        return view('auth.comments', compact('product', 'comments'));
    }

    public function sendcomment(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required',
            'comment_content' => 'required',
        ]);

        // Lấy user hiện tại
        $user = Auth::user();

        // Tạo mới bình luận
        $comment = new Comment();
        $comment->product_id = $request->input('product_id');
        $comment->comment_content = $request->input('comment_content');
        $comment->user_id = $user->id;
        $comment->save();

        // Redirect to the toviewcomment method with the product ID
        return redirect()->route('view.comment', ['id' => $request->input('product_id')])
            ->with('success', 'Comment sent successfully!');
    }
    public function deletecomment(Request $request)
    {
        $id = $request->input('id');
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }
        return redirect()->back()->with('error', 'Failed to delete comment.');
    }
}
