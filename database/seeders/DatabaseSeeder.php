<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        include_once public_path('images/img.php');
        $img = IMG_VALUE;
        for ($i = 1; $i <= 50; $i++) {
            // Thêm dữ liệu vào bảng 'product' trong cơ sở dữ liệu
            DB::table('product')->insert([
                'category_id' => 1,
                'manufacturer_id' => 1,
                'product_name' => 'Iphone ' . $i,
                'product_image' => IMG_VALUE, // Thay 'IMG_VALUE' bằng giá trị hình ảnh thực tế
                'product_price' => 5000.00,
                'warranty_period' => 12,
                'product_quantity' => 200,
            ]);
        }


        DB::table('users')->insert([           
            'email' => 'moclopxebo3@gmail.com',            
            'password' => Hash::make('123123'),
            'role' => 'admin',
        ]);
        // for ($i = 1; $i <= 50; $i++) {
        //     // Thêm dữ liệu vào bảng 'product' trong cơ sở dữ liệu
        //     DB::table('product')->insert([
        //         'category_id' => 1,
        //         'manufacturer_id' => 1,
        //         'product_name' => 'Iphone ' . $i,
        //         'product_image' => IMG_VALUE, // Thay 'IMG_VALUE' bằng giá trị hình ảnh thực tế
        //         'product_price' => 5000.00,
        //         'warranty_period' => 12,
        //         'product_quantity' => 200,
        //     ]);
        // }  
        for ($i = 1; $i <= 50; $i++) {
            // Thêm dữ liệu vào bảng 'product' trong cơ sở dữ liệu
            DB::table('product')->insert([
                'category_id' => 2,
                'manufacturer_id' => 2,
                'product_name' => 'lap top ' . $i,
                'product_image' => IMG_VALUE, // Thay 'IMG_VALUE' bằng giá trị hình ảnh thực tế
                'product_price' => 5000.00 * $i,
                'warranty_period' => 12,
                'product_quantity' => 200,
            ]);
        }

        // DB::table('users')->insert([           
        //     'email' => 'cus@gmail.com',            
        //     'password' => Hash::make('123123'),
        //     'role' => 'custom',
        // ]);
        DB::table('user_profile')->insert([           
            'user_id' => '1',                       
            'name' => 'nmcuan',
            'phone' => '098453451',
            'address' => 'ThuDuc',
            'image' => $img,
            'sex' => 'boy',
        ]);
        DB::table('user_profile')->insert([           
            'user_id' => '2',                       
            'name' => 'nmcuan',
            'phone' => '098453451',
            'address' => 'ThuDuc',
            'image' => $img,
            'sex' => 'boy',
        ]);
        DB::table('users')->insert([           
            'email' => 'admin@gmail.com',            
            'password' => Hash::make('123123'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([           
            'email' => 'cus@gmail.com',            
            'password' => Hash::make('123123'),
            'role' => 'custom',
        ]);
        DB::table('user_profile')->insert([           
            'user_id' => '1',                       
            'name' => 'nmcuan',
            'phone' => '098453451',
            'address' => 'ThuDuc',
            'image' => $img,
            'sex' => 'boy',
        ]);
        DB::table('user_profile')->insert([           
            'user_id' => '2',                       
            'name' => 'nmcuan',
            'phone' => '098453451',
            'address' => 'ThuDuc',
            'image' => $img,
            'sex' => 'boy',
        ]);

        DB::table('category')->insert([
            'category_name' => 'Smart Phone',
        ]);
        DB::table('category')->insert([
            'category_name' => 'LapTop',
        ]);

        DB::table('manufacturer')->insert([
            'manufacturer_email' => 'apple@gmail.com',
            'manufacturer_name' => 'APPLE',
            'manufacturer_phone' => '093242434',
        ]);
        DB::table('manufacturer')->insert([
            'manufacturer_email' => 'sasung@gmail.com',
            'manufacturer_name' => 'SAMSUNG',
            'manufacturer_phone' => '092435234',
        ]);

        DB::table('product')->insert([
            'category_id' => 1,
            'manufacturer_id' => 1,
            'product_name' => 'Iphone 100',
            'product_image' => IMG_VALUE,
            'product_price' => 5000.00,
            'warranty_period' => 12,
            'product_quantity' => 200,
        ]);

        DB::table('product')->insert([
            'category_id' => 1,
            'manufacturer_id' => 2,
            'product_name' => 'SamSung Note 100',
            'product_image' => IMG_VALUE,
            'product_price' => 5000.00,
            'warranty_period' => 12,
            'product_quantity' => 200,
        ]);

        
        DB::table('invoice')->insert([
            'user_id' => 1,
            'total_amount' => 1000.00,
            'invoice_payment' => 0,
            'created_at' => now(),
        ]);

        DB::table('invoice_details')->insert([
            'invoice_id' => 1,
            'product_id' => 1,
            'invoice_details_quantity' => 3,           
        ]);
        DB::table('invoice_details')->insert([
            'invoice_id' => 1,
            'product_id' => 2,
            'invoice_details_quantity' => 5,           
        ]);

       
        DB::table('comments')->insert([
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            ['user_id' => '1', 'product_id' => '1', 'comment_content' => 'sản phẩm nảy rất tuyệt'],
            ['user_id' => '2', 'product_id' => '1', 'comment_content' => 'sản phẩm này ngon'],
            
        ]);

       

    }
}
