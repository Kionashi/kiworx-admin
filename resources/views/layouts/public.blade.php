<!DOCTYPE html>
<html lang="es">
<head>
	@include('layouts.head')
</head>

<body class="nav-md" style="background: white;">
	<div class="container body">
		<div class="main_container">
			<!-- page content -->
			<!-- page content -->
   			<div class="right_col" role="main" style="margin-left:0;">
				@yield('content')
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				@include('layouts.footer')
			</footer>
			<!-- /footer content -->
		</div>
	</div>
	
	@include('layouts.scripts')
	
</body>
</html>
