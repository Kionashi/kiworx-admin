<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kiworx - Admin</title>
<!-- Bootstrap -->
<link
	href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}"
	rel="stylesheet">
<!-- Font Awesome -->
<link
	href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}"
	rel="stylesheet">
<link href="{{asset('assets/vendors/font-awesome/css/all.min.css')}}"
	rel="stylesheet">
<!-- NProgress -->
<link href="{{asset('assets/vendors/nprogress/nprogress.css')}}"
	rel="stylesheet">
<!-- Animate.css -->
<link href="{{asset('assets/vendors/animate.css/animate.min.css')}}"
	rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
</head>

<body class="login">
	<div>
		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<h1>{{env('APP_NAME')}}</h1>
						<div>
							<input type="email" class="form-control" placeholder="Correo" required="" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="Contraseña" required="" @error('password') is-invalid @enderror" name="password" required />
						</div>
						<div>
							<input type="submit" class="btn btn-default submit" value="Ingresar" />
						</div>
						@if (Route::has('password-recovery'))
							<a class="btn btn-link" href="{{ route('password-recovery') }}"> {{ __('Forgot Your Password?') }} </a>
						@endif
						@if($errors->any())
    						@foreach ($errors->all() as $error)
    							<p style="color:red;">{{ $error }}</p>
    						@endforeach
						@endif 
						@if(session('successMsg'))
							<p style="color:green;">{{ session('successMsg') }}</p>
						@endif 
						<div class="clearfix"></div>
						<div class="separator">
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
