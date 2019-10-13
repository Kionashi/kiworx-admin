@extends('layouts.error.app')
@section('section')Access denied @endsection
@section('content')
<!-- page content -->
<div class="col-md-12">
	<div class="col-middle">
		<div class="text-center text-center">
			<h1 class="error-number">404</h1>
			<h2>Sorry but we couldn't find this page</h2>
			<p>
				This page you are looking for does not exist. <a href="javascript:history.back()">Go Back?</a>
			</p>
		</div>
	</div>
</div>
<!-- /page content -->
@endsection
@section('extended-css') @endsection
@section('extended-scripts') @endsection
