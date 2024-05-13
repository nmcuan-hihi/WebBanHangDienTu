<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Lọc theo danh mục nếu có category được chọn
        if ($request->has('category')) {
            $category_id = $request->category;
            if (!empty($category_id)) {
                $query->where('category_id', $category_id);
            }
        }

        // Sắp xếp theo giá nếu có yêu cầu sắp xếp
        if ($request->has('sort')) {
            $sortOrder = $request->sort == 'asc' ? 'asc' : 'desc';
            $query->orderBy('product_price', $sortOrder);
        }

        // Kiểm tra nếu không có yêu cầu lọc hoặc sắp xếp
        if (!$request->has('category') && !$request->has('sort')) {
            $products = Product::paginate(3);
        } else {
            $products = $query->paginate(3);
        }

        $categories = Category::all();

        return view('auth.home', compact('products', 'categories'));
    }
    public function toproductedit(Request $request)
    {
        $product_id = $request->get('id');
        $prd = Product::find($product_id);
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        return view('manager.editproduct', ['product' => $prd, 'categories' => $categories, 'manufacturers' => $manufacturers]);
    }
    public function productedit(Request $request)
    {
        $product_id = $request->get('id');
        $prd = Product::find($product_id);
        return view('manager.editproduct', ['product' => $prd]);
    }
}
