@extends('layouts.app') @section('section', 'Administradores')
@section('content')
<!-- page content -->
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<a href="{{route('admin-users')}}"><h2>
						Profile <small>Change password</small>
					</h2></a>
				<!-- <ul class="nav navbar-right panel_toolbox">
					<li><a href="{{route('admin-users/create')}}">nuevo registro <i class="fa fa-plus"></i></a></li>
				</ul> -->
				<div class="clearfix"></div>
			</div>
			@if($errors->any())
			<div class="alert alert-danger alert-dismissible fade in"
				role="alert">
				<button class="close" aria-label="Close" type="button"
					data-dismiss="alert">
					<span aria-hidden="true">×</span>
				</button>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li> @endforeach
				</ul>
			</div>
			@endif
			<div class="x_content" style="display: block;">
				<form action="{{route('change-password')}}"
					class="form-horizontal form-label-left" method="post">
					@csrf
					<div class="item form-group">
						<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
						<div class="col-md-6 col-sm-6">
							<input id="password" type="password" name="password" data-validate-length-range="6" class="form-control" required="required">
						</div>
					</div>
					<div class="item form-group">
						<label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12 ">Repeat Password</label>
						<div class="col-md-6 col-sm-6">
							<input id="password2" type="password" name="password2"
								data-validate-linked="password" class="form-control" required="required">
						</div>
					</div>
					<div class="ln_solid"></div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<a href="{{route('profile')}}" class="btn btn-primary">Back</a>
							<input type="submit" class="btn btn-success" value="Save" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection @section('extended-css') @endsection
@section('extended-scripts')
<!-- Validator -->
<script src="{{ asset('gentelella/vendors/validator/validator.js') }}"></script>
@endsection
