<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\AuthenticationServices;
use App\Mail\ForgetPassword;
use App\Mail\SignupEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class MailController extends Controller
{
    public static function sendSignupEmail($name, $email, $otp, $lang = '')
    {
        $data = [
            'name' => $name,
            'otp' => $otp,
            'lang' => $lang,
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }

    public static function forgetPasswordEmail($name, $email, $otp, $lang = "en")
    {
        $token = DB::table('password_resets')->select('token')->where('email', $email)->latest()->first();
        $data = [
            'name' => $name,
            'email' => $email,
            'lang' => $lang,
            'link' => "http://172.21.1.116:8080/reset-password?email=" . $email . "&token=" . $token->token
        ];
        // dd($data);

        Mail::to($email)->send(new ForgetPassword($data));
    }
}
