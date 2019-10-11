@extends('layouts.app') @section('content')
 <!-- page content -->
 <div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
                <a href="{{route('offers')}}"><h2>
					Ofertas <small>Crear</small>
				</h2></a>
				<!-- <ul class="nav navbar-right panel_toolbox">
					<li><a href="{{route('offers/create')}}">nuevo registro <i class="fa fa-plus"></i></a></li>
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
                <form action="{{route('offers/update')}}" class="form-horizontal form-label-left" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Posición <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="{{$offer['id']}}" type="hidden" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12">
                            <input type="text" id="position" name="position" value="{{$offer['position']}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="experience">Experiencia <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="experience" name="experience" value="{{$offer['experience']}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contract_type">Tipo de contrato <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="contract_type" name="contract_type" value="{{$offer['contract_type']}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">{{$offer['description']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Categoria <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="category" name="category" value="" required="required" class="form-control col-md-7 col-xs-12">
                                <option @if($offer['category'] == 'IT') selected @endif value="IT">IT</option>
                                <option @if($offer['category'] == 'Marketing') selected @endif value="Marketing">Marketing</option>
                                <option @if($offer['category'] == 'Business') selected @endif value="Business">Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Estado <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="finished" name="finished" value="" required="required" class="form-control col-md-7 col-xs-12">
                                <option @if($offer['finished'] == false) selected @endif value="false">Habilitado</option>
                                <option @if($offer['finished'] == true) selected @endif value="true">Deshabilitado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address_url">Fecha de inicio<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" id="start_date" value="{{$offer['start_date']}}" name="start_date"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="companyId">Compañia <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="companyId" name="companyId" required="required" class="form-control col-md-7 col-xs-12">
                                @foreach($companies as $company)
                                    <option @if($offer['company']['id'] == $company['id']) selected @endif value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Enviar</button>
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
