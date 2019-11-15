@extends('layouts.app') @section('content')
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					Company <small>List</small>
				</h2>
				<ul class="nav navbar-right panel_toolbox">
					@if(session('admin.isSuperAdmin'))<li><a href="{{route('companies/create')}}">New record <i class="fa fa-plus"></i></a></li>@endif
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				@if (isset($companies))
				<table id="datatable-buttons" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Category</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($companies as $company)
						<tr style="height: 40px;">
							<td><a href="{{route('companies/details', $company['id'])}}" title="Details" class="icon-table">{{ $company['name'] }}</a></td>
							<td>{{ $company['category'] }}</td>
							<td>
								<a href="{{route('companies/details', $company['id'])}}" title="Details" class="icon-table">
									<i class="fa fa-search"></i>
								</a>
								<a href="{{route('companies/edit', $company['id'])}}" title="Edit" class="icon-table">
									<i class="fa fa-edit"></i>
								</a>
								<a href="{{route('companies/delete', $company['id'])}}" title="Delete" class="icon-table">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p>No hay compañias disponibles.</p>
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
