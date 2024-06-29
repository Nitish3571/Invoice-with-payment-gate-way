<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-forgot-password');
  }

  public function reset()
  {
    return view('content.authentications.auth-reset');
  }
  public function store(Request $request )
  {
    $email = session('email');

    $request->validate([
      'password' => 'required|min:8',
      'cpassword' => 'required|same:password',
    ]);

    $password = $request->password;
    $hashedPassword = Hash::make($password);

    User::where('email', $email)->update([
      'password' => $hashedPassword,
    ]);

    toastr()->success('Password Update successfully', 'Success');
    return redirect()->intended('dashboard');
  }

}