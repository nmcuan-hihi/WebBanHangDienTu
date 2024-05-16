<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManufacturersController extends Controller
{
    // Phương thức hiển thị form chỉnh sửa nhà sản xuất
    public function edit($id)
    {
        // Tìm nhà sản xuất dựa trên id được cung cấp
        $manufacturer = Manufacturer::find($id);

        // Trả về view 'auth.editmanufacturers' với thông tin nhà sản xuất
        return view('auth.editmanufacturers', compact('manufacturer'));
    }

    // Phương thức cập nhật thông tin nhà sản xuất
    public function update(Request $request, $id)
    {
        // Tìm nhà sản xuất cần cập nhật
        $manufacturer = Manufacturer::find($id);

        // Cập nhật thông tin nhà sản xuất từ dữ liệu gửi qua biểu mẫu
        $manufacturer->manufacturer_name = $request->input('manufacturer_name');
        $manufacturer->manufacturer_phone = $request->input('manufacturer_phone');
        $manufacturer->manufacturer_email = $request->input('manufacturer_email');
        $manufacturer->save();

        // Chuyển hướng người dùng đến trang hiển thị nhà sản xuất với thông báo
        return redirect()->route('add.manufacturer', $id)->with('success', 'Manufacturer updated successfully.');
    }
    public function search(Request $request)
{
    // Lấy tên nhà cung cấp từ yêu cầu
    $manufacturer_name = $request->input('manufacturer_name');

    // Tìm kiếm nhà cung cấp dựa trên tên
    $manufacturers = Manufacturer::where('manufacturer_name', 'LIKE', "%$manufacturer_name%")->get();

    // Trả về view với kết quả tìm kiếm
    return view('auth.addmanufacturers', ['manufacturers' => $manufacturers]);
}


    // Phương thức hiển thị form thêm mới nhà sản xuất
    public function showAddForm()
    {
        // Lấy danh sách tất cả các nhà sản xuất
        $manufacturers = Manufacturer::all();

        // Trả về view 'auth.addmanufacturers' với danh sách nhà sản xuất
        return view('auth.addmanufacturers', ['manufacturers' => $manufacturers]);
    }

    // Phương thức lưu nhà sản xuất mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu gửi từ biểu mẫu
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

        // Nếu dữ liệu không hợp lệ, hiển thị thông báo lỗi và chuyển hướng về trang trước
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        // Tạo mới một nhà sản xuất và lưu vào cơ sở dữ liệu
        Manufacturer::create([
            'manufacturer_name' => $request->manufacturer_name,
            'manufacturer_phone' => $request->manufacturer_phone,
            'manufacturer_email' => $request->manufacturer_email,
        ]);

        // Hiển thị thông báo thành công và chuyển hướng về trang thêm mới nhà sản xuất
        Session::flash('success', 'Manufacturer added successfully!');
        return redirect()->route('add.manufacturer');
    }
}
