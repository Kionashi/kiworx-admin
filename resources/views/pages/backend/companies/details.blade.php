@section('section', 'Companies')
@extends('layouts.app') @section('content')
 <!-- page content -->
 <div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
                <a href="{{route('companies')}}"><h2>
					Companies <small>Detail</small>
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
                <form id="createCompanyForm" action="{{route('companies/update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" disabled class="form-control col-md-7 col-xs-12" value="{{$company['name']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							{!!$company['description']!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="category" name="category" disabled required="required" class="form-control col-md-7 col-xs-12" value="{{$company['category']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="phone" name="phone" disabled required="required" class="form-control col-md-7 col-xs-12" value="{{$company['phone']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="{{$company['logo']}}" style="max-width: 40em;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="backgroundImage">Background image <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="{{$company['background_image']}}" style="max-width: 40em;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="address" name="address" disabled class="form-control col-md-7 col-xs-12">{{$company['address']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addressUrl">Address url <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="addressUrl" name="addressUrl" disabled class="form-control col-md-7 col-xs-12" value="{{$company['address_url']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="website" name="website" disabled class="form-control col-md-7 col-xs-12" value="{{$company['website']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="linkedin">LinkedIn <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="linkedin" name="linkedin" disabled class="form-control col-md-7 col-xs-12" value="{{$company['linkedin']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="instagram" name="instagram" disabled class="form-control col-md-7 col-xs-12" value="{{$company['instagram']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="facebook" name="facebook" disabled class="form-control col-md-7 col-xs-12" value="{{$company['facebook']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter">Twitter <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="twitter" name="twitter" disabled class="form-control col-md-7 col-xs-12" value="{{$company['twitter']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="youtube">Youtube <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="youtube" name="youtube" disabled class="form-control col-md-7 col-xs-12" value="{{$company['youtube']}}" />
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        	@if(session('admin.isSuperAdmin'))
                    			<a href="{{route('companies')}}" class="btn btn-primary">Back</a>
                    		@else
                        		<a href="{{route('home')}}" class="btn btn-primary">Back</a>
                        	@endif
                        	<a href="{{route('companies/edit', $company['id'])}}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </form>
            </div> 	
        </div>
    </div>
</div>
@endsection @section('extended-css')

@endsection @section('extended-scripts')
<!-- Bootstrap-wysiwyg -->
<script src="{{ asset('gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('gentelella/vendors/google-code-prettify/src/prettify.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#createCompanyForm').submit(function(){
		var descriptionContent = $('#description-container').html();
		
		$('#description').val(descriptionContent);
		
	});
	
	$('.editor-wrapper').each(function(){
		var id = $(this).attr('id');	//editor-one
		console.log('==>'+id);
		$(this).wysiwyg({
			toolbarSelector: '[data-target="#' + id + '"]',
		});	
	});

});
</script>

@endsection
