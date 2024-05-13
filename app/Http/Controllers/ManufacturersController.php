<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManufacturersController extends Controller
{
    public function showAddForm()
    {
        $manufacturers = Manufacturer::all();
        return view('auth.addmanufacturers', ['manufacturers' => $manufacturers]);
    }
    // Lưu nhà sản xuất mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manufacturer_name' => 'required',
            'manufacturer_phone' => 'required|numeric|digits:10',
            'manufacturer_email' => 'required|email',
        ], [
            'manufacturer_name.required' => 'The manufacturer name field is required.',
            'manufacturer_phone.required' => 'The phone number field is required.',
            'manufacturer_phone.numeric' => 'The phone number must be a number.',
            'manufacturer_phone.digits' => 'The phone number must be 10 digits.',
            'manufacturer_email.required' => 'The email field is required.',
            'manufacturer_email.email' => 'The email must be a valid email address.',
        ]);
    
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }
        

        // Tạo một nhà sản xuất mới
        Manufacturer::create([
            'manufacturer_name' => $request->manufacturer_name,
            'manufacturer_phone' => $request->manufacturer_phone,
            'manufacturer_email' => $request->manufacturer_email,
        ]);

        // Chuyển hướng về trang trước đó hoặc trang nào đó khác
        Session::flash('success', 'Manufacturer added successfully!');

        return redirect()->route('add.manufacturer');
    }
}
