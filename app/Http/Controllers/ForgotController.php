<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class ForgotController extends Controller
{
   
    public function showForgotForm(){
        return view ('auth.forgot');
    }

    
    
    public function sendResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);
    
        $token = Str::random(64);
       
        $existingRecord = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();
    
    if ($existingRecord) {
        // Update the existing record
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->update([
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
    } else {
        // Insert a new record
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
    } 
    
       
    
        Mail::send("emails.email-forgot", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset');
        });

        return redirect()->to(route("forgot.password.form"))->with("success","We have send email");
    }

    public function resetPassword($token){

        return view("auth.reset-password",compact('token'));
    }


    public function resetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed',
        "password_confirmation"=>'required',
        ]);
        

        $updatePassword =DB::table('password_reset_tokens')->where([
            'email'=> $request->email,
            'token' => $request->token,

        ])->first();

        if(!$updatePassword){
            return redirect()->to(route("reset.password.form"))->with("error","Invalid");
        }

        User::where("email",$request->email)->update(["password"=>Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(["email"=> $request->email])->delete();

        return redirect()->to(route("login"))->with("success","password reset success");
    }

   
}
