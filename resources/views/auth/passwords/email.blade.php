@extends('authlayout')
@section('content')

 <div id="page-wrapper">
            <div class="main-page login-page ">
                <h2 class="title1">{{ __('Reset Password') }}</h2>
                <div class="widget-shadow">
                    <div class="login-body">
                         @include('includes.notification')
                         <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                           <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required autocomplete="email" autofocus>
                            <div class="forgot-grid">
                                <div class="forgot">
                                    <a href="{{ url('/admin') }}">Already have password?</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <input type="submit" name="submit" value="{{ __('Send Password Reset Link') }}">
                        </form>
                    </div>
                </div>
                
            </div>
        </div>



@endsection
