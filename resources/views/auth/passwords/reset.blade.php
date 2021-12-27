<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('plugins/fontawesome/js/all.min.js') }}"></script>

    <link id="theme-style" rel="stylesheet" href="{{ asset('css/portal.css') }}">
</head>

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="{{ route('home') }}"><img class="logo-icon me-2" src="{{ asset('images/logo.png') }}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Reset Password</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action="{{ route('admin.password.update') }}" method="POST">
                            @csrf

							<input type="hidden" name="token" value="{{ $token }}">
							@error('token')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="signin-email" name="email" type="email" class="form-control signin-email" value="{{ $email ?? old('email') }}" placeholder="Email address" required="required">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!--//form-group-->
							<div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
								<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="New Password" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="password_confirm">Password</label>
								<input id="password_confirm" name="password_confirmation" type="password" class="form-control signin-password" placeholder="Confirm Password" required="required">
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div><!--//form-group-->
							<div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Reset Password</button>
							</div>
						</form>
						
						{{-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html" >here</a>.</div> --}}
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">Welcome to Hotel Sunshine</h5>
					    <div>Lost you way. Click <a href="{{ route('home') }}">here</a>.</div>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html>