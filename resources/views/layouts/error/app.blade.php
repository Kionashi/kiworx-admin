<!DOCTYPE html>
<html lang="es">
<head>
	@include('layouts.error.head')
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			@yield('content')
		</div>
	</div>
	@include('layouts.error.scripts')
</body>
</html>
