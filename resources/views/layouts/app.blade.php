<!DOCTYPE html>
<html lang="es">
<head>
	@include('layouts.head')
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					@include('layouts.sidebar')
				</div>
			</div>

			<!-- top navigation -->
			@include('layouts.top-navigation')
			<!-- /top navigation -->

			<!-- page content -->
			<!-- page content -->
   			<div class="right_col" role="main">
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
