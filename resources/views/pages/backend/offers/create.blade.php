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
			<div class="x_content" style="display: block;">
				<form action="{{route('offers/store')}}"
					class="form-horizontal form-label-left" method="post">
					@csrf
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="position">Título <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="position" name="position"
								required="required" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="experience">Experiencia <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="experience" name="experience" required="required"
								class="form-control col-md-7 col-xs-12">
								<option value="1">Prácticas</option>
								<option value="2">1 a 3 años</option>
								<option value="3">3 a 5 años</option>
								<option value="3">más de 5 años</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="description">Job brief <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea id="description" name="description" required="required"
								class="form-control col-md-7 col-xs-12"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="functions">Responsabilidades <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="btn-toolbar editor" data-role="editor-toolbar"
								data-target="#editor-one">
								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown"
										title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
									<ul class="dropdown-menu">
									</ul>
								</div>

								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown"
										title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b
										class="caret"></b></a>
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

							<textarea name="functions" id="functions" style="display: none;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="requirements">Requisitos <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="btn-toolbar editor" data-role="editor-toolbar"
								data-target="#editor-one">
								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown"
										title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
									<ul class="dropdown-menu">
									</ul>
								</div>

								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown"
										title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b
										class="caret"></b></a>
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

							<textarea name="requirements" id="requirements" style="display: none;"></textarea>
						</div>
					</div>
					<div class="form-group">
						
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="contract_type">Tipo de contrato  <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="contract_type" name="contract_type" required="required"
								class="form-control col-md-7 col-xs-12">
								<option>Seleccione</option>
								<option value="1">Prácticas</option>
								<option value="2">Duración determinada</option>
								<option value="3">Freelance</option>
								<option value="4">Indefinido</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="working_time">Tipo de jornada  <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="contract_type" name="contract_type" required="required"
								class="form-control col-md-7 col-xs-12">
								<option>Seleccione</option>
								<option value="1">Part time</option>
								<option value="2">Full time</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="email">Categoria <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="category" name="category" required="required"
								class="form-control col-md-7 col-xs-12">
								<option value="IT">IT</option>
								<option value="Marketing">Marketing</option>
								<option value="Business">Business</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"
							for="companyId">Compañia <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="companyId" name="companyId" required="required"
								class="form-control col-md-7 col-xs-12"> @foreach($companies as
								$company)
								<option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Hashtag</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="tags_1" type="text" class="tags form-control"
								value="" />
							<div id="suggestions-container"
								style="position: relative; float: left; width: 250px; margin: 10px;"></div>
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
@endsection @section('extended-css') @endsection
@section('extended-scripts')
<!-- bootstrap-wysiwyg -->
<script src="{{ asset('gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('gentelella/vendors/google-code-prettify/src/prettify.js') }}"></script>
<script src="{{ asset('gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
@endsection
