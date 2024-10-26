<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view("auth.forgot-password");
    }

     public function sendToken(ForgotPasswordRequest $forgotPasswordRequest){
         try {

            $token = Str::random(64);

             DB::table('password_reset_tokens')->where('email', $forgotPasswordRequest->email)->delete();

            DB::table('password_reset_tokens')->insert([
                'email' => $forgotPasswordRequest->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            $hashEmail=Hash::make($forgotPasswordRequest->email);
            $base64EncodeEmail=base64_encode($hashEmail);

            Mail::send('auth.mail-reset-password-token', ['token' => $token,'email' => $base64EncodeEmail], function ($message) use ($forgotPasswordRequest) {
                $message->to($forgotPasswordRequest->email);
                $message->subject('Reset Password');
            });

            return redirect()->back()->with('link_success', ' Reset Link Send Successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('link_error', $e->getMessage());
        }
    }

    public function resetPasswordForm($email, $token){
        if(!isset($email)){
            return redirect()->route("forgot-password")->with('error_token', 'Token not found');
        }

        if(!isset($token)){
            return redirect()->route("forgot-password")->with('error_token', 'Token not found');
        }

        $dataToken = DB::table('password_reset_tokens','email')
            ->where([
                'token' => $token,
            ])->first();


        if (!$dataToken) {
            return redirect()->route("forgot-password")->with('error_token', 'Token not valid!');
        }

        $base64DecodeEmail=base64_decode($email);
        
        if(!Hash::check($dataToken->email, $base64DecodeEmail)){
            return redirect()->route("forgot-password")->with('error_token', 'Token not valid!');
        }

        $data=[
            "email" => $email,
            "token" => $token
        ];

        return view("auth.reset-password-form", $data);
    }

    public function resetPassword(string $email, string $token, ResetPasswordRequest $resetPasswordRequest){
          try {
            if(!isset($email)){
                return redirect()->route("forgot-password")->with('error_token', 'Token not found');
            }

            if(!isset($token)){
                return redirect()->route("forgot-password")->with('error_token', 'Token not found');
            }

            $updatePassword = DB::table('password_reset_tokens')
                ->where([
                    'token' => $token,
                ])->first();

            if (!$updatePassword) {
                return redirect()->route("forgot-password")->with('error_token', 'Token not valid!');
            }

            $base64DecodeEmail=base64_decode($email);
            
            if(!Hash::check($updatePassword->email, $base64DecodeEmail)){
                return redirect()->route("forgot-password")->with('error_token', 'Token not valid!');
            }

            User::query()->where('email', $updatePassword->email)
                       ->update(['password' => Hash::make($resetPasswordRequest->new_password)]);


            DB::table('password_reset_tokens')->where(['email' => $updatePassword->email])->delete();

          
            return redirect()->route('login')->with('reset_success', 'Password successfully updated.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error_reset', $e->getMessage());

        }
    }
}
