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
            $products = Product::paginate(6);
        } else {
            $products = $query->paginate(6);
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
    $request->validate([
        'product_id' => 'required|integer', // Thêm validation cho product_id
        'product_name' => 'required|string',
        'category_id' => 'required|integer',
        'manufacturer_id' => 'required|integer',
        'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file hình ảnh (tối đa 2MB)// cho phep khong co anh moi van luu dc
        'product_price' => 'required|numeric',
        'warranty_period' => 'required|string',
        'product_quantity' => 'required|integer',
    ]);

    // Tìm sản phẩm theo product_id
    $product = Product::find($request->input('product_id'));

    if (!$product) {
        return redirect()->route('manager')->with('error', 'Product not found');
    }

    $product->product_name = $request->input('product_name');
    $product->category_id = $request->input('category_id');
    $product->manufacturer_id = $request->input('manufacturer_id');

    if ($request->hasFile('product_image')) {
        // Lưu dữ liệu hình ảnh dưới dạng base64
        $imageData = base64_encode(file_get_contents($request->file('product_image')->path()));
        $product->product_image = $imageData;
    }

    $product->product_price = $request->input('product_price');
    $product->warranty_period = $request->input('warranty_period');
    $product->product_quantity = $request->input('product_quantity');

    // Save the product to the database
    $product->save();

    // Redirect with success message
    return redirect()->route('manager')->with('success', 'Successfully updated!');
}

  
   
    public function showAddForm()
    {
        $manufacturers = Manufacturer::all(); 
        $categories = Category::all();
        return view('./auth/addproduct',['manufacturers' => $manufacturers],['categories' => $categories]);
    }
    

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Tìm kiếm sản phẩm trong cơ sở dữ liệu với từ khóa $searchTerm
        $products = Product::where('product_name', 'like', '%' . $searchTerm . '%')
                           ->paginate(6);
        $categories = Category::all();
        return view('auth.home', compact('products','categories'));
    }

   
    
    public function getProductImage($id)
    {
        $product = Product::find($id);
        $image = $product->product_image; // Assume 'product_image' is the column name in your database
        return response($image)->header('Content-type', 'image/jpeg'); // Adjust the image type if necessary
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'manufacturer_id' => 'required|integer',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file size limit as needed
            'product_price' => 'required|numeric',
            'warranty_period' => 'required|string',
            'product_quantity' => 'required|integer',
        ]);

     
        $imageName = base64_encode(file_get_contents($request->file('product_image')->path()));
            // Create a new product instance
            $product = new Product;
            $product->product_name = $request->input('product_name');
            $product->category_id = $request->input('category_id');
            $product->manufacturer_id = $request->input('manufacturer_id');
            $product->product_image = $imageName; // Save the image file name
            $product->product_price = $request->input('product_price');
            $product->warranty_period = $request->input('warranty_period');
            $product->product_quantity = $request->input('product_quantity');

            // Save the product to the database
            $product->save();

            // Redirect with success message
            return redirect()->route('manager')->with('success', 'Product added successfully!');
         
    }
    public function delete(Request $request ){
        $product_id = $request->get('id');
        $product = Product::destroy($product_id);
        return redirect("manager")->withSuccess('You have signed-in');
    }
}
