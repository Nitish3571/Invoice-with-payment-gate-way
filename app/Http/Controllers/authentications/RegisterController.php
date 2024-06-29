<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yoeunes\Toastr\Facades\Toastr;

class RegisterController extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register');
  }
  public function store(Request $request)
{
  // dd($request);

    // Validate the incoming request
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phoneNumber' => 'nullable|string',
          'alternateNumber' => 'nullable|string',
          'address' => 'nullable|string',
          'state' => 'nullable|string',
          'zipCode' => 'nullable|string|max:6',
          'country' => 'nullable|string',
          'language' => 'nullable|string',
          'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    $emailExists = User::where('email', $request->email)->exists();

    if ($emailExists) {

        toastr()->error('Email already exists.', 'Error');
        return redirect()->back()->withInput();
    }

    DB::beginTransaction();

    try {
      // Insert user data
      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
      ]);

      // Retrieve the user_id after creating the user
      // $user_id = $user->id;

      // Insert profile data using the retrieved user_id
      Profile::create([
          'name' => $request->name,
          'email' => $request->email,
          // Add more profile data as needed
      ]);

      // Commit the transaction
      DB::commit();

      // Display toastr success message
      toastr()->success('User registered successfully.', 'Success');
      return redirect()->route('auth-login');
  } catch (\Exception $e) {
      // Roll back the transaction on error
      DB::rollBack();
      dd($e);
      toastr()->error('Failed to register user.', 'Error');
      return redirect()->back()->withInput();
  }

}
}