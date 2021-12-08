<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\ForgotPasswordMail;

use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function forgetpasswordView()
    {
        return view('auth.forgotPassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users' ]);

        $token = Str::random(64);

        $saveData = DB::table('password_resets')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now() ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request)
        {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()
            ->with('message', 'We have E-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        if (empty($token))
        {
            return redirect('forget-password')->with('message', 'Invalid Token');
        }
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users', 'password' => 'required|string|min:6|confirmed', 'password_confirmation' => 'required']);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request
            ->token])
            ->first();

        if (!$updatePassword)
        {
            return back()->withInput()
                ->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password) ]);

        DB::table('password_resets')
            ->where(['email' => $request
            ->email])
            ->delete();

        return redirect('/auth/login')
            ->with('message', 'Your password has been changed!');
    }

}

