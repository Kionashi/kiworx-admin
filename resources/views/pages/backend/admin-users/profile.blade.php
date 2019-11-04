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
					Profile <small>Details</small>
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
            @if(session('successMsg'))
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span>
                    </button>
                    <p>{{ session('successMsg') }}</p>
                </div>
            @endif
            
            <div class="x_content" style="display: block;">
                <form action="{{ route('admin-users/update') }}" class="form-horizontal form-label-left" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" value="{{$adminUser['name']}}" required class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lastname" name="lastname" required value="{{$adminUser['lastname']}}" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" disabled required value="{{$adminUser['email']}}" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Company
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="text" name="text" disabled value="{{$adminUser['company']['name']}}" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Role
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="text" name="text" disabled value="{{$adminUser['role']['name']}}" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
            
                    <div class="ln_solid"></div>
                    
                    <div class="form-group">
                        <div class="col-md-9 col-sm-12 col-xs-12 col-md-offset-3">
                            <a href="{{route('home')}}" class="btn btn-primary">Back</a>
                            <input type="submit" class="btn btn-success" value="Save" />
                            <a href="{{route('change-password')}}" class="btn btn-success">Change password</a>
                        </div>
                    </div>
                </form>
            </div> 	
        </div>
    </div>
</div>
@endsection @section('extended-css')

@endsection
@section('extended-scripts')
<!-- Validator -->
<script src="{{ asset('gentelella/vendors/validator/validator.js') }}"></script>
@endsection

