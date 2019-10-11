@extends('layouts.app') @section('content')
 <!-- page content -->
 <div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
                <a href="{{route('companies')}}"><h2>
					Compañias <small>Crear</small>
				</h2></a>
				<!-- <ul class="nav navbar-right panel_toolbox">
					<li><a href="{{route('companies/create')}}">nuevo registro <i class="fa fa-plus"></i></a></li>
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
                <form action="#" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['name']}}" type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea disabled id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">{{$company['description']}}</textarea disabled value="{{$company['name']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Categoria <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['category']}}" type="text" id="category" name="category" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Dirección <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea disabled id="address" name="address"  class="form-control col-md-7 col-xs-12">{{$company['address']}}</textarea disabled value="{{$company['name']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address_url">Dirección url <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['address_url']}}" type="text" id="address_url" name="address_url"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Sitio web <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['website']}}" type="text" id="website" name="website"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="linkedin">Linkedin <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['linkedin']}}" type="text" id="linkedin" name="linkedin" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['instagram']}}" type="text" id="instagram" name="instagram" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['facebook']}}" type="text" id="facebook" name="facebook" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter">Twitter <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['twitter']}}" type="text" id="twitter" name="twitter" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="youtube">Youtube <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['youtube']}}" type="text" id="youtube" name="youtube" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyPersonName">Nombre del representante <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['key_person_name']}}" type="text" id="keyPersonName" name="keyPersonName" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyPersonTitle">Cargo del representante <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['key_person_title']}}" type="text" id="keyPersonTitle" name="keyPersonTitle" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adminUserId">Usuario administrador <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input disabled value="{{$company['admin_user']['name']}}" type="text" id="adminUser" name="adminUser" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
            
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a href="{{route('companies')}}" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </form>
            </div> 	
        </div>
    </div>
</div>
@endsection @section('extended-css')

@endsection @section('extended-scripts')


@endsection
