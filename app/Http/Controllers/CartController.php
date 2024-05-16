<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
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


    public function finalizePurchase(Request $request)
    {
        $user_id = Auth::user()->id;

        // Get data from the request
        $cart = json_decode($request->input('cart'), true);
        $subtotal = $request->input('subtotal');
        $tax = $request->input('tax');
        $total = $request->input('total');
        $invoice_number = $request->input('invoice_number');
        $customer_name = $request->input('customer_name');
        $customer_address = $request->input('customer_address');
        $customer_email = $request->input('customer_email');
        $payment_method = $request->input('payment_method');

        // Create a new invoice record
        $invoice = Invoice::create([
            'user_id' => $user_id,
            'total_amount' => $total,
            'invoice_payment' => '1', // Or other payment method
        ]);

        // Save invoice details
        foreach ($cart as $item) {
            InvoiceDetail::create([
                'invoice_id' => $invoice->invoice_id, // Change to invoice_id
                'product_id' => $item['id'],
                'invoice_details_quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart
        //session()->forget('cart');

        // Redirect to the purchase history page
        $invoices = Invoice::where('user_id', auth()->id())->orderByDesc('created_at')->get();

        // Chuyển dữ liệu đến view
        return view('auth.purchase_history', compact('invoices'));
    }

    public function viewInvoice($id)
    {
        // Lấy thông tin hóa đơn
        $invoice = Invoice::findOrFail($id);

        // Lấy thông tin hồ sơ người dùng từ bảng user_profile
        $userProfile = $invoice->userProfile;

        // Lấy chi tiết hóa đơn và thông tin sản phẩm tương ứng
        $invoiceDetails = InvoiceDetail::where('invoice_id', $id)->with('product')->get();

        // Trả về view kèm theo dữ liệu cần thiết
        return view('auth.invoice_detail', compact('invoice', 'invoiceDetails', 'userProfile'));
    }
    public function purchaseHistory()
    {
        // Lấy lịch sử mua hàng từ cơ sở dữ liệu
        $invoices = Invoice::with('userProfile')->where('user_id', auth()->id())->orderByDesc('created_at')->get();
    
        // Chuyển dữ liệu đến view
        return view('auth.purchase_history', compact('invoices'));
    }
    

    public function index()
    {   
        return view('auth.cart');
    }

    public function purchase(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate subtotal
        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Calculate tax (assuming a 10% tax rate)
        $tax = $subtotal * 0.10;

        // Calculate total
        $total = $subtotal + $tax;

        return view('auth.invoice', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'invoice_number' => 'INV-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'customer_name' => 'Van Duc',
            'customer_address' => 'Thủ Đức, Tp.HCM',
            'customer_email' => 'nhomz9@gmail.com',
            'payment_method' => 'Thẻ tín dụng',
        ]);
    }

    public function sendInvoiceEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Lấy dữ liệu từ request
        $data = $request->all();

        // Logic để gửi email (sử dụng mailable, v.v.)
        Mail::to($data['email'])->send(new InvoiceMail($data));

        return response()->json(['message' => 'Hóa đơn đã được gửi thành công!'], 200);
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
