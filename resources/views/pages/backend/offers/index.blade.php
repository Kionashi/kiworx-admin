@extends('layouts.app')
@section('section', 'Jobs')
@section('content')
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					Jobs <small>List</small>
				</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a href="{{route('offers/create')}}">New job <i class="fa fa-plus"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				@if (isset($offers))
				<table id="datatable-buttons" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Public URL</th>
							<th>Position</th>
							<th>Category</th>
							<th>Company</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($offers as $offer)
						<tr style="height: 40px;">
							<td><a href="{{route('offer/public', ['company' => $offer['company']['friendly_name'], 'code' => $offer['code']])}}" target="_blank">View offer</a></td>
							<td><a href="{{route('offers/details', ['id' => $offer['id'], 'order' => 1])}}">{{ $offer['job_title'] }}</a></td>
							<td>{{\App\Enums\OfferCategory::getFriendlyName($offer['category'])}}</td>
							<td>{{ $offer['company']['name'] }}</td>
							<td>
								@if($offer['finished'])
									<button class="btn btn-danger btn-xs">Inactivo</button>
								@else
									<button class="btn btn-success btn-xs">Activo</button>
								@endif
							</td>
							<td>
								<a href="{{ route('offers/details', ['id' => $offer['id'], 'order' => 1]) }}" title="Detalles" class="icon-table">
									<i class="fa fa-search"></i>
								</a>
								<a href="{{route('offers/edit', $offer['id'])}}" title="Editar" class="icon-table">
									<i class="fa fa-edit"></i>
								</a>
								<a href="{{route('offers/delete', $offer['id'])}}" title="Eliminar" class="icon-table">
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
