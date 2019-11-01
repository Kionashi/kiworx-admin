@extends('layouts.app')
@section('section', 'Administradores')
@section('content')
 <!-- page content -->
 <div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
                <a href="{{route('notifications')}}"><h2>
					Notificaciones <small>Detalles</small>
				</h2></a>
				<div class="clearfix"></div>
			</div>
           
            <div class="x_content" style="display: block;">
                <form action="#" class="form-horizontal form-label-left" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" disabled value="{{$notification['title']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contenido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" disabled>{{$notification['content']}}</textarea>
                        </div>
                    </div>
            
                    <div class="ln_solid"></div>
                        <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{{route('notifications')}}" class="btn btn-primary">Volver</a>
                    </div>
                    </div>
                </form>
            </div> 	
        </div>
    </div>
</div>
@endsection @section('extended-css')

@endsection @section('extended-scripts')
<!-- Datatables -->

@endsection
