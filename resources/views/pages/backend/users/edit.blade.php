@extends('layouts.app')
@section('section', 'Administradores')
@section('content')
 <!-- page content -->
 <div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
                <a href="{{route('admin-users')}}"><h2>
					Candidato <small>Editar</small>
				</h2></a>
				<!-- <ul class="nav navbar-right panel_toolbox">
					<li><a href="{{route('admin-users/create')}}">nuevo registro <i class="fa fa-plus"></i></a></li>
				</ul> -->
				<div class="clearfix"></div>
			</div>
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="x_content" style="display: block;">
                <form action="{{route('users/update')}}" class="form-horizontal form-label-left" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" required="required" value="{{$user['id']}}" class="form-control col-md-7 col-xs-12">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" required="required" value="{{$user['name']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lastname" name="lastname" required="required" value="{{$user['lastname']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" disabled="disabled" value="{{$user['email']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="phone" name="phone" value="{{$user['phone']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">CV <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="enabled">Enabled
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input name="enabled" type="checkbox" class="js-switch" {{$user['enabled']?'checked':''}} />
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Deleted
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input name="deleted" type="checkbox" class="js-switch" {{$user['deleted']?'deleted':''}} /> 
                            </label>
                        </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="{{ route('users') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </form>
            </div> 	
        </div>
    </div>
</div>
@endsection 
@section('extended-css')
    <!-- Switchery -->
    <link href="{{asset('gentelella/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
@endsection
@section('extended-scripts')
    <!-- Switchery -->
    <script src="{{ asset('gentelella/vendors/switchery/dist/switchery.min.js') }}"></script>
@endsection
