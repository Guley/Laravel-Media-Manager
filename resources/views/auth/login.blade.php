@extends('authlayout')
@section('content')
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
    <div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						 @include('includes.notification')
						 <form method="POST" action="{{ route('login') }}">
                        @csrf

							<input type="email" class="user" name="email" placeholder="Enter Your Email">
							<input type="password" name="password" class="lock" placeholder="Password">
                            <div class="col-md-6">

                                {!! captcha_image_html('CaptchaCode') !!}

                                <input class="form-control" type="text" id="CaptchaCode" name="CaptchaCode" style="margin-top:5px;">
                            </div>

                        </div>
							<div class="forgot-grid">
								<div class="forgot">
									<a href="{{ url('admin/forgotpassword') }}">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Sign In" value="Sign In">
						</form>
					</div>
				</div>
				
			</div>
		</div>
@stop
<!-- *9CCB9A4D4B53C9A518822D042195AB3D43618862 -->