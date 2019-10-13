@extends('layouts.error.app')
@section('section')Access denied @endsection
@section('content')
<!-- page content -->
<div class="col-md-12">
	<div class="col-middle">
		<div class="text-center text-center">
			<h1 class="error-number">500</h1>
			<h2>Internal Server Error</h2>
			<p>
				We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, <a href="javascript:history.back()">Go back?</a>
			</p>
		</div>
	</div>
</div>
<!-- /page content -->
@endsection
@section('extended-css') @endsection
@section('extended-scripts') @endsection
