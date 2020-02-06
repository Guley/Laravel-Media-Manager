@extends('authlayout')
@section('content')
 <div id="page-wrapper">
            <div class="main-page login-page ">
                <h2 class="title1">{{ __('Reset Passwords') }}</h2>
                <div class="widget-shadow">
                    <div class="login-body">
                         @include('includes.notification')
                         <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                         <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Enter Your Email" required autocomplete="email" autofocus>
                           <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password" placeholder="Enter Your New Password">

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter Re-Enter New Password">
                            <div class="forgot-grid">
                                <div class="forgot">
                                    <a href="{{ url('/admin') }}">Already have password?</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <input type="submit" name="submit" value=" {{ __('Reset Password') }}">
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
@endsection
