<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManufacturersController extends Controller
{
    public function edit($id)
    {
        $manufacturer = Manufacturer::find($id);
        return view('auth.editmanufacturers', compact('manufacturer'));
    }

    public function update(Request $request, $id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->manufacturer_name = $request->input('manufacturer_name');
        $manufacturer->manufacturer_phone = $request->input('manufacturer_phone');
        $manufacturer->manufacturer_email = $request->input('manufacturer_email');
        $manufacturer->save();

        return redirect()->route('add.manufacturer', $id)->with('success', 'Manufacturer updated successfully.');
    }

    public function showAddForm(Request $request)
    {
        return $this->list($request);
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

    public function list(Request $request)
    {
        $query = Manufacturer::query();

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'name_asc':
                    $query->orderBy('manufacturer_name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('manufacturer_name', 'desc');
                    break;
            }
        }

        $manufacturers = $query->get();

        return view('auth.addmanufacturers', compact('manufacturers'));
    }
    
}
