@extends('layouts.app')

@section('content')
   <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
            <a href="{{route('users')}}"><h3>Vendedores</a> <small>Detalles</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content" style="display: block;">
            <form action="#" class="form-horizontal form-label-left" method="post">
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" disabled value="{{$user->name}}" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Correo <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="email" name="email" value="{{$user->email}}" disabled class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rif <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="rif" name="rif" disabled class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Teléfono <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="phone" name="phone" disabled class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Relación <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="reference" name="reference" disabled class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fecha de nacimiento <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" id="birth_date" name="birth_date" disabled class="form-control col-md-7 col-xs-12">
                    </div>
                </div> -->
            
                <div class="ln_solid"></div>
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{{route('users')}}" class="btn btn-primary">Volver</a>
                </div>
                </div>
            </form>
        </div> 	
    </div>
    <!-- /page content -->
@endsection
