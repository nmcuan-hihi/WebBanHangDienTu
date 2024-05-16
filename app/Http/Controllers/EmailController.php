<?php

namespace App\Http\Controllers;

use App\Mail\LoginNotification;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class EmailController extends BaseController
{
    public function sendEmail(Request $request)
    {
        $toEmail = $request->input('email');


        $user = User::where('email', $toEmail)->firstOrFail();

        // Tạo token ngẫu nhiên
        $token = "Key is: " . Str::random(6);
        $message = "Admin Login to Webbanhang";

        // Gửi email với token
        Mail::to($toEmail)->send(new LoginNotification($message, $token));
        DB::table('personal_access_tokens')->insert([
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class, 
            'name' => 'login-token',
            'token' => $token,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


       

        return response()->json(['message' => 'Email sent successfully.']);
    }
}
