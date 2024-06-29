<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Facades\Toastr;

class LoginController extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect('dashboard');
    }
    return view('content.authentications.auth-login');
  }

  public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $profileImg = Profile::where("email" , $request->email)->first();

            session([
                'email' => $user->email,
                'name' => $user->name,
                'profileImg' =>$profileImg->profileImg
            ]);

            toastr()->success('Login successful', 'Success');
            return redirect()->intended('dashboard');
        } else {
            toastr()->error('Login failed. Please check your credentials.', 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        Session::flush();
        toastr()->success('You have been logged out successfully.', 'Success');
        return redirect('/');
    }
}