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
						Jobs <small>Edit</small>
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
				<form id="createOfferForm" action="{{route('offers/update')}}" class="form-horizontal form-label-left" method="post">
					@csrf
					<input type="hidden" id="id" name="id" required="required" value="{{$offer['id']}}" class="form-control col-md-7 col-xs-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="jobTitle">Position <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="jobTitle" name="jobTitle" value="{{$offer['job_title']}}" required class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="experience">Experience <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="experience" name="experience" required="required" class="form-control col-md-7 col-xs-12">
								@foreach (\App\Enums\OfferExperience::values() as $offerExperience)
									<option @if($offer['experience'] == $offerExperience)selected @endif value="{{$offerExperience}}">{{ \App\Enums\OfferExperience::getFriendlyName($offerExperience) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="jobBrief">Job brief <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea id="jobBrief" name="jobBrief" required="required" class="form-control col-md-7 col-xs-12">{{$offer['job_brief']}}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="salary">Salary text
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="salary" name="salary" required value="{{$offer['salary']}}" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="salaryMin">Salary min
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="number" id="salaryMin" name="salaryMin" value="{{$offer['salary_min']}}" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="salaryMax">Salary max
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="number" id="salaryMax" name="salaryMax" value="{{$offer['salary_max']}}" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="description">Description <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#description-container">
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
							
							<div id="description-container" class="editor-wrapper">
								{!! $offer['description'] !!}
							</div>
							
							<textarea name="description" id="description" style="display: none;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="responsabilities">Responsabilities <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#responsabilities-container">
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
							
							<div id="responsabilities-container" class="editor-wrapper">
								{!! $offer['responsibilities'] !!}
							</div>
							
							<textarea name="responsibilities" id="responsibilities" style="display:none;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="requirements">Requisitos <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
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
							
							<div id="requirements-container" class="editor-wrapper">
								{!! $offer['requirements'] !!}
							</div>
							
							<textarea name="requirements" id="requirements" style="display: none;"></textarea>
						</div>
					</div>
					<div class="form-group">
						
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="contractType">Contract type  <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="contractType" name="contractType" required="required"
								class="form-control col-md-7 col-xs-12">
								@foreach (\App\Enums\OfferContractType::values() as $offerContractType)
									<option @if($offer['contract_type'] == $offerContractType)selected @endif value="{{$offerContractType}}">{{ \App\Enums\OfferContractType::getFriendlyName($offerContractType) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="workingTime">Working days  <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="workingDays" name="workingDays" required="required" class="form-control col-md-7 col-xs-12">
								@foreach (\App\Enums\OfferWorkingDays::values() as $offerWorkingDay)
									<option @if($offer['working_days'] == $offerWorkingDay)selected @endif value="{{$offerWorkingDay}}">{{ \App\Enums\OfferWorkingDays::getFriendlyName($offerWorkingDay) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="category">Category <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="category" name="category" required="required"
								class="form-control col-md-7 col-xs-12">
								@foreach (\App\Enums\OfferCategory::values() as $offerCategory)
									<option @if($offer['category'] == $offerCategory)selected @endif value="{{$offerCategory}}">{{ \App\Enums\OfferCategory::getFriendlyName($offerCategory) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="workingLanguage">Working language <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="workingLanguage" name="workingLanguage" required="required"
								class="form-control col-md-7 col-xs-12">
								@foreach (\App\Enums\OfferWorkingLanguages::values() as $offerLanguage)
									<option @if($offer['working_language'] == $offerLanguage)selected @endif value="{{$offerLanguage}}">{{ \App\Enums\OfferWorkingLanguages::getFriendlyName($offerLanguage) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="companyId">Company <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="companyId" name="companyId" required="required" class="form-control col-md-7 col-xs-12">
								@foreach($companies as $company)
									<option @if($offer['company']['id'] == $company['id'])selected @endif value="{{ $company['id'] }}">{{ $company['name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="location">Location
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="location" name="location" required value="{{$offer['location']}}" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Hashtag</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="tags_1" name="tags" type="text" class="tags form-control"
								value="{{$offer['hashStr']}}" />
							<div id="suggestions-container"
								style="position: relative; float: left; width: 250px; margin: 10px;"></div>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-success">Update</button>
							<a href="{{route('offers')}}" class="btn btn-primary">Back</a>
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

<script type="text/javascript">
$(document).ready(function(){
	$('#createOfferForm').submit(function(){
		var descriptionContent = $('#description-container').html();
		var responsabilitiesContent = $('#responsabilities-container').html();
		var requirementsContent = $('#requirements-container').html();
		
		$('#description').val(descriptionContent);
		$('#responsibilities').val(responsabilitiesContent);
		$('#requirements').val(requirementsContent);
		
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
	
});
</script>
@endsection
