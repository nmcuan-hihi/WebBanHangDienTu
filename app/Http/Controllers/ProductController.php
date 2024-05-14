<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
   
   
    public function showAddForm()
    {
        $manufacturers = Manufacturer::all(); 
        return view('./auth/addproduct',['manufacturers' => $manufacturers]);
    }
    

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Tìm kiếm sản phẩm trong cơ sở dữ liệu với từ khóa $searchTerm
        $products = Product::where('product_name', 'like', '%' . $searchTerm . '%')
                           ->paginate(10);

        return view('auth.home', compact('products'));
    }

    public function index()
    {
        $products = Product::paginate(10);
        return view('auth.home', compact('products'));
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
            return redirect()->route('home')->with('success', 'Product added successfully!');
         
    }
}
