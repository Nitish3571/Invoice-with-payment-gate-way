@extends('layouts/contentNavbarLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y" style="align-items: flex-start">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="#" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
            <span class="app-brand-text demo text-heading fw-semibold">{{ "Plasma" }}</span>
          </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2">
          <h4 class="mb-5">Reset Password? 🔒</h4>
          {{-- <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p> --}}
          <form id="formAuthentication" class="mb-3" action="{{url('/auth/reset')}}" method="POST">
            @csrf
            {{-- <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password" autofocus>
              <label>New Password</label>

            </div> --}}
            <div class="mb-3">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password" autofocus>
                      <label>New Password</label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control @error('cpassword') is-invalid @enderror" id="cpassword" name="cpassword" placeholder="Enter new password" autofocus>
                      <label>cpassword Password</label>
                    @error('cpassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
            </div>
            {{-- <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control @error('cpassword') is-invalid @enderror" id="cpassword" name="cpassword" placeholder="Enter confirm password" autofocus>
              <label>cpassword Password</label>
              @error('cpassword')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div> --}}
            <button class="btn btn-primary d-grid w-100">Change</button>
          </form>
        </div>
      </div>
      <!-- /Forgot Password -->
      </div>
  </div>
</div>
@endsection
