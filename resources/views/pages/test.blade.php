@extends('layouts.app')
@section('section', 'Job')
@section('content')
<!-- page content -->
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<a href="{{route('offers')}}">
					<h2>
						Jobs <small>Create</small>
					</h2></a>
				<div class="clearfix"></div>
			</div>
			@if($errors->any())
			<div class="alert alert-danger alert-dismissible fade in"
				role="alert">
				<button class="close" aria-label="Close" type="button"
					data-dismiss="alert">
					<span aria-hidden="true">×</span>
				</button>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li> @endforeach
				</ul>
			</div>
			@endif
			<div class="x_content">
				<form action="{{route('test-post')}}"
					class="form-horizontal form-label-left" method="post">
					@csrf
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="responsibilities">Responsabilities <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
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
							
							<div id="editor-one" class="editor-wrapper"></div>
							
							<textarea name="responsibilities" id="responsibilities"></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection @section('extended-css') @endsection

@section('extended-scripts')
<!-- Bootstrap-wysiwyg -->
<script src="{{ asset('gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('gentelella/vendors/google-code-prettify/src/prettify.js') }}"></script>

<!-- jQuery Tags Input -->
<script src="{{ asset('gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>

<script src="{{ asset('js/offers/create.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('form').submit(function(){
		var content = $('#editor-one').html();
		$('#responsibilities').val(content);
	});
// 	$('#responsibilities').wysiwyg();
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
