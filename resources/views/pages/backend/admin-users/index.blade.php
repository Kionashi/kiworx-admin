@extends('layouts.app') @section('content')
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					Admin users <small>List</small>
				</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a href="{{route('admin-users/create')}}">nuevo registro <i class="fa fa-plus"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				@if (isset($adminUsers))
				<table id="datatable-buttons"
					class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($adminUsers as $adminUser)
						<tr style="height: 40px;">
							<td>{{ $adminUser['name'] }}</td>
							<td>{{ $adminUser['email'] }}</td>
							<td><a href="{{route('admin-users/details', $adminUser['id'])}}"
								title="Detalles" class="icon-table"><i class="fa fa-search"></i></a>
								<a href="{{route('admin-users/edit', $adminUser['id'])}}"
								title="Editar" class="icon-table"><i class="fa fa-edit"></i></a>
								<a href="{{route('admin-users/delete', $adminUser['id'])}}"
								title="Eliminar" class="icon-table"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p>There are no admin users available.</p>
				@endif
			</div>
		</div>
	</div>

</div>
@endsection @section('extended-css')
<!-- Datatables -->
<link
	href="{{asset('gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}"
	rel="stylesheet">
@endsection @section('extended-scripts')
<!-- Datatables -->
<script
	src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/jszip/dist/jszip.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
@endsection
