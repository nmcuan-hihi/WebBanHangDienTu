<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class CategoryController extends Controller
{
    public function toAddCategory()
    {
        $categories = Category::all();
        return view('manager.addcategory', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        // Validate form data
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Tạo mới danh mục
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        $categories = Category::all();

        return view('manager.addcategory', compact('categories'))->with('success', 'Danh mục đã được thêm mới thành công.');
    }

    public function editCategory(Category $category)
    {
        return view('manager.editcategory', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        // Validate form data
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Cập nhật thông tin danh mục
        $category->category_name = $request->input('category_name');
        $category->save();

      
        return redirect()->route('addcategory')->with('success', 'Danh mục đã được cập nhật thành công.');
    }
}
