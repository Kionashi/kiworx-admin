@extends('layouts.app')
@section('section', 'Candidate')
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
                            <input type="text" id="name" name="name" disabled value="{{$applicant['user']['name']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lastname" name="lastname" disabled value="{{$applicant['user']['lastname']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" disabled value="{{$applicant['user']['email']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="text" name="text" disabled value="{{$applicant['user']['phone']}}" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="text" name="text" disabled value="{{\App\Enums\OfferApplicationStatus::getFriendlyName($applicant['status'])}}" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    @if(session('admin.isSuperAdmin'))
                    <div class="form-group">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="enabled">Enabled 
                        </label>
                    	<div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input name="enabled" type="checkbox" class="js-switch" {{$applicant['user']['enabled']?'checked':''}} disabled="disabled" />
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Deleted 
                        </label>
                    	<div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input name="deleted" type="checkbox" class="js-switch" {{$applicant['user']['deleted']?'deleted':''}} disabled="disabled" /> 
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
                            @if($applicant['status'] != 'ACCEPTED')
								<span title="Accept" class="icon-table green" data-toggle="modal" data-target=".bs-accept-modal-sm">
									<a class="btn btn-success">Accept</a>
								</span>
							@endif
							@if($applicant['status'] == 'PENDING')
								<span title="Reject" class="icon-table red" data-toggle="modal" data-target=".bs-reject-modal-sm">
    								<a class="btn btn-danger">Reject</a>
								</span>
							@endif
							<span title="CV" class="icon-table red" data-toggle="modal" data-target=".bs-cv-modal-sm">
								<a class="btn btn-primary">CV</a>
							</span>
                        </div>
                    </div>
                </form>
                
                <form id="promoteForm" action="{{ route('offers/promote') }}" method="post">
					@csrf
					<input type="hidden" name="applicantId" value="{{ $applicant['id'] }}">
					<input type="hidden" name="phase" value="{{ $applicant['phase']['id'] }}">
					<input type="hidden" name="offerId" value="{{ $applicant['offer']['id'] }}">
					
				</form>
				<form id="rejectForm" action="{{ route('offers/reject') }}" method="post">
					@csrf
					<input type="hidden" name="applicantId" value="{{ $applicant['id'] }}">
					<input type="hidden" name="phase" value="{{ $applicant['phase']['id'] }}">
					<input type="hidden" name="offerId" value="{{ $applicant['offer']['id'] }}">
				</form>
            </div>
            <h2>Comments</h2>
            <!-- start recent activity -->
            <div>
    			<ul class="messages">
    				@foreach($applicant['user']['comments'] as $comment)
    				<li>
    					<div class="message_date">
    						<h3 class="date text-info">24</h3>
    						<p class="month">May</p>
    					</div>
    					<div class="message_wrapper">
    						<h4 class="heading">{{$comment['user']['name']}}</h4>
    						<blockquote class="message">{{$comment['comment']}}</blockquote>
    						<br />
    						<p class="url">
    							<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
    							<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc</a>
    						</p>
    					</div>
					</li>
					@endforeach
    			</ul>
			</div>
			<!-- end recent activity -->
		</div>
    </div>
</div>

<!-- CONFIRMATION ACCEPT MODAL -->
<div class="modal fade bs-accept-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<h4>Promote Candidate</h4>
				<p>Are you sure you want to promote this candidate to the next stage?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-primary" onclick="$('#promoteForm').submit();">Yes</button>
			</div>
		</div>
	</div>
</div>

<!-- CONFIRMATION REJECT MODAL -->
<div class="modal fade bs-reject-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<h4>Reject candidate</h4>
				<p>Are you sure you want to reject this candidate?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-primary" onclick="$('#rejectForm').submit();">Yes</button>
			</div>
		</div>
	</div>
</div>

<!-- CONFIRMATION REJECT MODAL -->
<div class="modal fade bs-cv-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<canvas id="user-cv"></canvas>
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
        var url = "{{$applicant['user']['curriculum']}}";
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
