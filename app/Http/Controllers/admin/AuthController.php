<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
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
}
