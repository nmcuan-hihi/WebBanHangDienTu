<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
class CartController extends Controller
{
    public function viewInvoice($id)
{
    // Lấy thông tin hóa đơn dựa trên ID
    $invoice = Invoice::findOrFail($id);

    // Lấy chi tiết hóa đơn dựa trên ID hóa đơn, cùng với thông tin sản phẩm tương ứng
    $invoiceDetails = InvoiceDetail::where('invoice_id', $id)->with('product')->get();

    // Trả về view kèm theo dữ liệu cần thiết
    return view('auth.invoice_detail', compact('invoice', 'invoiceDetails'));
}

    public function purchaseHistory()
{
    // Lấy lịch sử mua hàng từ cơ sở dữ liệu
    $invoices = Invoice::where('user_id', auth()->id())->orderByDesc('created_at')->get();
    
    // Chuyển dữ liệu đến view
    return view('auth.purchase_history', compact('invoices'));
}
    public function index()
    {
        return view('auth.cart');
    }
    public function purchase(Request $request)
    {
        $user_id = Auth::user()->id;
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
        session()->forget('cart');
    
        // Redirect to the invoice page with invoice details
        return view('auth.invoice', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'invoice_number' => 'INV-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'customer_name' => 'John Doe',
            'customer_address' => '1234 Main St, Anytown, USA',
            'customer_email' => 'john.doe@example.com',
            'payment_method' => 'Credit Card',
        ]);
    }
    public function sendInvoiceEmail(Request $request)
    {
        $invoiceData = $request->all();
        
        // Validate the email address
        $request->validate([
            'email' => 'required|email',
        ]);
        
        // Send invoice email
        Mail::to($invoiceData['email'])->send(new InvoiceMail($invoiceData));

        return response()->json(['success' => 'Hóa đơn đã được gửi qua email!']);
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
