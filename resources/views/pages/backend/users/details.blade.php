@extends('layouts.app')
@section('section', 'Administradores')
@section('content')
 <!-- page content -->
 <div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
                <a href="{{route('users')}}"><h2>
					Candidate <small>Details</small>
				</h2></a>
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
                <form action="#" class="form-horizontal form-label-left" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" disabled value="{{$user['name']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lastname" name="lastname" disabled value="{{$user['lastname']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" disabled value="{{$user['email']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="text" name="text" disabled value="{{$user['phone']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    @if(session('admin.isSuperAdmin'))
                    <div class="form-group">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="enabled">Enabled 
                        </label>
                    	<div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input name="enabled" type="checkbox" class="js-switch" {{$user['enabled']?'checked':''}} disabled="disabled" />
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Deleted 
                        </label>
                    	<div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input name="deleted" type="checkbox" class="js-switch" {{$user['deleted']?'deleted':''}} disabled="disabled" /> 
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        	@if(session('admin.isSuperAdmin'))
                                <a href="{{route('users')}}" class="btn btn-primary">Back</a>
                            @else
                            	<a href="javascript:history.back()" class="btn btn-primary">Back</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div>
            	<canvas id="user-cv"></canvas>
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
    <script src="{{ asset('js/pdfjs/pdf.js') }}"></script>
    <script type="text/javascript">
    var url = "{{$user['curriculum']}}";
 // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('js/pdfjs/pdf.worker.js') }}";

    // Asynchronous download of PDF
    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function(pdf) {
      console.log('PDF loaded');
      
      // Fetch the first page
      var pageNumber = 1;
      pdf.getPage(pageNumber).then(function(page) {
        console.log('Page loaded');
        
        var scale = 1.5;
        var viewport = page.getViewport({scale: scale});

        // Prepare canvas using PDF page dimensions
        var canvas = document.getElementById('user-cv');
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
          canvasContext: context,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);
        renderTask.promise.then(function () {
          console.log('Page rendered');
        });
      });
    }, function (reason) {
      // PDF loading error
      console.error(reason);
    });
    </script>
@endsection
