<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Facades\Toastr;

class ProfileController extends Controller
{
  public function index(){
    $user = Profile::where("email" , session("email"))->first();
    return view('content.pages.account-settings-account' , compact('user'));
  }

  public function edit(Request $request, $id) {
    $user = Profile::find($id);
    if ($user) {
      return view('content.pages.edit-account-setting' , compact('user'));
    }
    return view('content.pages.account-settings-account');

}
public function store(Request $request)
{
  // dd($request);
      $validatedData = $request->validate([
        'name' => 'required|string',
        'phoneNumber' => 'required|string',
        'alternateNumber' => 'required|string',
        'address' => 'required|string',
        'district' => 'required|string',
        'state' => 'required|string',
        'zipCode' => 'required|string|max:6',
        'country' => 'required|string',
        'language' => 'required|string',
        'gstNumber' => 'required|string',
        'remarks' => 'nullable|string',
        'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        $existingUser = Profile::where('email', $request->email)->first();

        if ($request->hasFile('profileImg')) {
          $profileImg = $request->file('profileImg');
          $profileImgName = time().'.'.$profileImg->getClientOriginalExtension();

          $destinationPath = public_path('img/profile');
          $existingImagePath = $destinationPath . '/' . $profileImgName;

          if (file_exists($existingImagePath)) {
              unlink($existingImagePath);
          }

          $profileImg->move($destinationPath, $profileImgName);

          $validatedData['profileImg'] = $profileImgName;

          $request->session()->put('profileImg', $profileImgName);
      }


        if ($existingUser) {
            $userAuth = User::where('email', $request->email)->first();
            $userAuth->update(['name' => $request->name]);
            $existingUser->update($validatedData);
            toastr()->success('Profile details updated successfully.', 'Success');
            return redirect('account-settings-account');

        } else {
            $user = Profile::create($validatedData);
            toastr()->success('Profile details saved successfully.', 'Success');
            return redirect()->back();
        }

        return redirect()->back();
    } catch (\Exception $e) {
      dd($e);
        DB::rollBack();
        toastr()->error('Failed to save profile details.', 'Error');
        return redirect()->back()->withInput();
    }
}

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'fullName' => 'required|string',
      'lastName' => 'required|string',
      'email' => 'required|email',
      'role' => 'required|in:1,2,3',
      'phoneNumber' => 'nullable|string',
      'alternateNumber' => 'nullable|string',
      'address' => 'nullable|string',
      'state' => 'nullable|string',
      'zipCode' => 'nullable|string|max:6',
      'country' => 'nullable|string',
      'language' => 'nullable|string',
      'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
  ]);

    if ($request->hasFile('profileImg')) {
      $profileImg = $request->file('profileImg');
      $profileImgName = time().'.'.$profileImg->getClientOriginalExtension();
      $profileImg->move(public_path('img/profile'), $profileImgName);
      $validatedData['profileImg'] = $profileImgName;
    }

      $user = User::findOrFail($id);

      $user->update($validatedData);

      toastr()->success('Profile details updated successfully..', 'Success');

      return redirect()->back()->with('success', 'Profile details updated successfully.');
  }
}