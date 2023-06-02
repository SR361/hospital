<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Mail;
use Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
		$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $model = User::where('email', $request->get('email'))->first();
        if (empty($model)) {
		   return redirect()->back()->with("emailError",__("Invalid Email!!!"));
        }
        if (! Hash::check($request->get('password'), $model->password)) {
            //return redirect()->back()->withError("Password Not matching")->withInput();
			return redirect()->back()->with("passwordError",__("Password not match"));
        }
        Auth::login($model);
        return redirect()->route('super.admin.dashboard');
    }

	public function logout()
    {
        Session::flush();
        return redirect('/admin/login')->with('success', 'You are logged out.');
    }

    public function showResetPasswordForm($token) {
        return view('admin.forgetPasswordLink', ['token' => $token]);
    }


    public function forgotPassword(Request $request){
        $request->validate([
              'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('admin.email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                            'email' => $request->email,
                            'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect(route('admin.login'))->with('message', 'Your password has been changed!');
    }
}
