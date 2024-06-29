@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Account Settings /</span> Account
</h4>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header">Profile Details</h4>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="@if($user->profileImg){{ asset('img/profile/' . $user->profileImg) }} @else  {{ asset('assets/img/avatars/1.png') }}@endif" alt="user-avatar" class="d-block w-px-50 h-px-50 rounded" id="uploadedAvatar" />
          {{-- <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
              <input type="file" id="upload" name="profileImg" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>

            <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 800K</div>
          </div> --}}
        </div>
      </div>
      <div class="card-body pt-2 mt-1">

          <div class="row mt-2 gy-4">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="name" name="name" value="@if($user->name) {{ $user->name }} @else {{ '' }} @endif" disabled />
                <label for="name">Full Name</label>
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" name="lastName" id="lastName" value=" " disabled/>
                <label for="lastName">Last Name</label>
              </div>
            </div> --}}
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="email" id="email" name="email" value="@if(session('email')) {{ session('email') }} @endif" disabled />
                <label for="email">E-mail</label>
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select class="form-control" id="role" name="role" disabled>
                  <option value="1" @if(session('role') == 1) selected @endif>Admin</option>
                  <option value="2" @if(session('role') == 2) selected @endif>Leader</option>
                  <option value="3" @if(session('role') == 3) selected @endif>User</option>
              </select>
               <label for="role">Role</label>
              </div>
            </div> --}}
            <div class="col-md-6">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="@if($user->phoneNumber) {{ $user->phoneNumber }} @else {{ '' }} @endif" placeholder="202 555 0111" disabled />
                  <label for="phoneNumber">Phone Number</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="alternateNumber" name="alternateNumber" class="form-control" value="@if($user->alternateNumber) {{ $user->alternateNumber }} @else {{ '' }} @endif" placeholder="202 555 0111" disabled/>
                  <label for="alternateNumber">Alternate Number</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="district" name="district" class="form-control" value="@if($user->district) {{ $user->district }} @else {{ '' }} @endif" placeholder="Ahmedabad" disabled/>
                  <label for="district">District</label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating form-floating-outline">
                <textarea class="form-control h-px-100" id="address" name="address" placeholder="106 Ganesh Glory , Jagatpur Ahmedabad" disabled>@if($user->address) {{ $user->address }} @else {{ '' }} @endif</textarea>
                <label for="address">Address</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="state" name="state" value="@if($user->state) {{ $user->state }} @else {{ '' }} @endif" placeholder="California" disabled />
                <label for="state">State</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" value="@if($user->zipCode) {{ $user->zipCode }} @else {{ '' }} @endif" maxlength="6"  disabled/>
                <label for="zipCode">Zip Code</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="country" class="select2 form-select" disabled>
                  <option value="">Select</option>
                  <option value="Australia" @if($user->country == 'Australia') selected @endif >Australia</option>
                  <option value="Bangladesh" @if($user->country == 'Bangladesh') selected @endif >Bangladesh</option>
                  <option value="Belarus" @if($user->country == 'Belarus') selected @endif >Belarus</option>
                  <option value="Brazil" @if($user->country == 'Brazil') selected @endif >Brazil</option>
                  <option value="Canada" @if($user->country == 'Canada') selected @endif >Canada</option>
                  <option value="China" @if($user->country == 'China') selected @endif >China</option>
                  <option value="France" @if($user->country == 'France') selected @endif >France</option>
                  <option value="Germany" @if($user->country == 'Germany') selected @endif >Germany</option>
                  <option value="India" @if($user->country == 'India') selected @endif >India</option>
                  <option value="Indonesia" @if($user->country == 'Indonesia') selected @endif >Indonesia</option>
                  <option value="Israel" @if($user->country == 'Israel') selected @endif >Israel</option>
                  <option value="Italy" @if($user->country == 'Italy') selected @endif >Italy</option>
                  <option value="Japan" @if($user->country == 'Japan') selected @endif >Japan</option>
                  <option value="Korea" @if($user->country == 'Korea') selected @endif >Korea, Republic of</option>
                  <option value="Mexico" @if($user->country == 'Mexico') selected @endif >Mexico</option>
                  <option value="Philippines" @if($user->country == 'Philippines') selected @endif >Philippines</option>
                  <option value="Russia" @if($user->country == 'Russia') selected @endif >Russian Federation</option>
                  <option value="South Africa" @if($user->country == 'South Africa') selected @endif >South Africa</option>
                  <option value="Thailand" @if($user->country == 'Thailand') selected @endif >Thailand</option>
                  <option value="Turkey" @if($user->country == 'Turkey') selected @endif >Turkey</option>
                  <option value="Ukraine" @if($user->country == 'Ukraine') selected @endif >Ukraine</option>
                  <option value="United Arab Emirates" @if($user->country == 'United Arab Emirates') selected @endif >United Arab Emirates</option>
                  <option value="United Kingdom" @if($user->country == 'United Kingdom') selected @endif >United Kingdom</option>
                  <option value="United States" @if($user->country == 'United States') selected @endif >United States</option>
                </select>
                <label for="country">Country</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="language" class="select2 form-select" disabled>
                  <option value="">Select Language</option>
                  <option value="English" @if ($user->language == 'English') selected @endif >English</option>
                  <option value="Hindi" @if ($user->language == 'Hindi') selected @endif>Hindi</option>
                  <option value="Gujrati" @if ($user->language == 'Gujrati') selected @endif>Gujrati</option>
                </select>
                <label for="language">Language</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="gstNumber" disabled value="@if($user->gstNumber) {{ $user->gstNumber }} @else {{ '' }} @endif" placeholder="GST Number"
                    name="gstNumber" />
                <label for="gstNumber">GST Number</label>
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-floating form-floating-outline mb-4">
              <textarea class="form-control h-px-100 " id="remarks" placeholder="Remarks" disabled
                  name="remarks">@if($user->remarks) {{ $user->remarks }} @else {{ '' }} @endif</textarea>
              <label for="remarks">Remarks</label>
          </div>
          </div>
            {{-- <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="timeZones" class="select2 form-select">
                  <option value="">Select Timezone</option>
                  <option value="-12">(GMT-12:00) International Date Line West</option>
                  <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                  <option value="-10">(GMT-10:00) Hawaii</option>
                  <option value="-9">(GMT-09:00) Alaska</option>
                  <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                  <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                  <option value="-7">(GMT-07:00) Arizona</option>
                  <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                  <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                  <option value="-6">(GMT-06:00) Central America</option>
                  <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                  <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                  <option value="-6">(GMT-06:00) Saskatchewan</option>
                  <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                  <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                  <option value="-5">(GMT-05:00) Indiana (East)</option>
                  <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                  <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                </select>
                <label for="timeZones">Timezone</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="currency" class="select2 form-select">
                  <option value="">Select Currency</option>
                  <option value="usd">USD</option>
                  <option value="euro">Euro</option>
                  <option value="pound">Pound</option>
                  <option value="bitcoin">Bitcoin</option>
                </select>
                <label for="currency">Currency</label>
              </div>
            </div> --}}
          </div>
          <div class="mt-4">
            <a href="{{ url('edit-account-setting',$user->id) }}" ><button type="submit" class="btn btn-primary me-2">Edit</button></a>

            <a href="{{url('/')}}"><button type="reset" class="btn btn-outline-secondary">Cancel</button></a>
          </div>
        </div>
      </form>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
