@extends('layouts.error.app')
@section('section')Access denied @endsection
@section('content')
<!-- page content -->
<div class="col-md-12">
	<div class="col-middle">
		<div class="text-center text-center">
			<h1 class="error-number">403</h1>
			<h2>Access denied</h2>
			<p>
				Full authentication is required to access this resource. <a href="{{route('login')}}">Log in?</a>
			</p>
		</div>
	</div>
</div>
<!-- /page content -->
@endsection
@section('extended-css') @endsection
@section('extended-scripts') @endsection
