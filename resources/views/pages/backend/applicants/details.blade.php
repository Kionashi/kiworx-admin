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
				@if($applicant['user']['comments'])
				<ul class="messages">
					@foreach($applicant['user']['comments'] as $comment)
					<li>
						<div class="message_date">
							<h5 class="date text-info">{{App\Helpers\DateHelper::relativeTime($comment['created_at'])}}</h5>
						</div>
						<div class="message_wrapper">
							<h4 class="heading">{{$comment['admin_user']['name']}} {{$comment['admin_user']['lastname']}}</h4>
							<blockquote class="message">{!! $comment['comment'] !!}</blockquote>
						</div>
					</li>
					@endforeach
				</ul>
				@else
					<p>There are no comments yet</p>
				@endif
				<form id="commentsForm" action="{{ route('comments/store') }}" method="post">
					@csrf
    				<div class="form-group">
    					<div class="col-md-12 col-sm-12 col-xs-12">
    						<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#requirements-container">
    							<div class="btn-group">
    								<a class="btn dropdown-toggle" data-toggle="dropdown"
    									title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
    								<ul class="dropdown-menu">
    								</ul>
    							</div>
    							
    							<div class="btn-group">
    								<a class="btn dropdown-toggle" data-toggle="dropdown"
    									title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b
    									class="caret"></b>
    								</a>
    								<ul class="dropdown-menu">
    									<li><a data-edit="fontSize 5">
    											<p style="font-size: 17px">Huge</p>
    									</a></li>
    									<li><a data-edit="fontSize 3">
    											<p style="font-size: 14px">Normal</p>
    									</a></li>
    									<li><a data-edit="fontSize 1">
    											<p style="font-size: 11px">Small</p>
    									</a></li>
    								</ul>
    							</div>
    
    							<div class="btn-group">
    								<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i
    									class="fa fa-bold"></i></a> <a class="btn" data-edit="italic"
    									title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a> <a
    									class="btn" data-edit="strikethrough" title="Strikethrough"><i
    									class="fa fa-strikethrough"></i></a> <a class="btn"
    									data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
    									class="fa fa-underline"></i></a>
    							</div>
    
    							<div class="btn-group">
    								<a class="btn" data-edit="insertunorderedlist"
    									title="Bullet list"><i class="fa fa-list-ul"></i></a> <a
    									class="btn" data-edit="outdent"
    									title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
    								<a class="btn" data-edit="indent" title="Indent (Tab)"><i
    									class="fa fa-indent"></i></a>
    							</div>
    
    							<div class="btn-group">
    								<a class="btn" data-edit="justifyleft"
    									title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
    								<a class="btn" data-edit="justifycenter"
    									title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
    								<a class="btn" data-edit="justifyright"
    									title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
    								<a class="btn" data-edit="justifyfull"
    									title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
    							</div>
    
    							<div class="btn-group">
    								<a class="btn dropdown-toggle" data-toggle="dropdown"
    									title="Hyperlink"><i class="fa fa-link"></i></a>
    								<div class="dropdown-menu input-append">
    									<input class="span2" placeholder="URL" type="text"
    										data-edit="createLink" />
    									<button class="btn" type="button">Add</button>
    								</div>
    								<a class="btn" data-edit="unlink" title="Remove Hyperlink"><i
    									class="fa fa-cut"></i></a>
    							</div>
    							<div class="btn-group">
    								<a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i
    									class="fa fa-undo"></i></a> <a class="btn" data-edit="redo"
    									title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
    							</div>
    						</div>
    						
    						<div id="comment-container" class="editor-wrapper"></div>
    						
    						<textarea name="comment" id="comment" style="display: none;"></textarea>
    					</div>
    				</div>
    				<div class="ln_solid"></div>
    				<div class="form-group">
    					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    						<button type="submit" class="btn btn-success">Submit</button>
    					</div>
    				</div>
    				
    				<input type="hidden" name="userId" value="{{ $applicant['user']['id'] }}">
    				<input type="hidden" name="adminUserId" value="{{ session('admin.id') }}">
    				<input type="hidden" name="applicantId" value="{{ $applicant['id'] }}">
    				
				</form>
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
	<!-- Bootstrap-wysiwyg -->
    <script src="{{ asset('gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/google-code-prettify/src/prettify.js') }}"></script>
    
    <!-- jQuery Tags Input -->
    <script src="{{ asset('gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    
	<!-- Switchery -->
	<script src="{{ asset('gentelella/vendors/switchery/dist/switchery.min.js') }}"></script>
	<script src="{{ asset('js/pdfjs/pdf.js') }}"></script>
	<script type="text/javascript">
	$(document).ready(function(){
    	$('#commentsForm').submit(function(){
    		var commentContent = $('#comment-container').html();
    		$('#comment').val(commentContent);
    	});
    	
    	$('.editor-wrapper').each(function(){
    		var id = $(this).attr('id');	//editor-one
    		console.log('==>'+id);
    		$(this).wysiwyg({
    			toolbarSelector: '[data-target="#' + id + '"]',
    		});	
    	});
    
    	$('#tags_1').tagsInput({
    	  width: 'auto'
    	});
		
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
	});
	</script>
@endsection
