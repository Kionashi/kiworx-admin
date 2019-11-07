@extends('layouts.app')
@section('section', $offer['job_title'])
@section('content')
<!-- page content -->
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

			<div class="x_title">
				<h2>
					<i class="fa fa-bars"></i> {{$offer['job_title']}}
				</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false"><i
							class="fa fa-wrench"></i></a>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			
			<div class="x_content">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab_content1"
							id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Candidatos</a>
						</li>
						<li role="presentation" class=""><a href="#tab_content2"
							role="tab" id="profile-tab" data-toggle="tab"
							aria-expanded="false">Job</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in"
							id="tab_content1" aria-labelledby="home-tab">
							<!-- top tiles -->
							<div class="row tile_count">
								@foreach($offer['phases'] as $interview)
    							<a href="{{ route('offers/details', ['id' => $offer['id'], 'order' => $interview['order']]) }}">
								<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
									<span class="count_top"><i class="fa fa-user"></i> {{$interview['name']}}</span>
									<div class="count">{{count($interview['applyments'])}}</div>
									<span class="count_bottom">
										<a href="#" class="red">Rejected {{$interview['rejected']}}</a>
									</span>
								</div>
    							</a>
								@endforeach
							</div>
							<!-- /top tiles -->
							
							<!-- applicant list -->
							@if (isset($applicants))
            				<table id="datatable-buttons"
            					class="table table-striped table-bordered">
            					<thead>
            						<tr>
            							<th>Name</th>
            							<th>Email</th>
            							<th>Status</th>
            							<th>Actions</th>
            						</tr>
            					</thead>
            					<tbody>
            						@foreach($applicants as $applicant)
            						<tr style="height: 40px;">
            							<td><a href="#">{{ $applicant['user']['name'] }} {{ $applicant['user']['lastname'] }}</a></td>
            							<td><a href="mailto:{{ $applicant['user']['email'] }}">{{ $applicant['user']['email'] }}</a></td>
            							<td>
            								@if($applicant['status'] == 'PENDING')
            									<button class="btn btn-warning btn-xs">Pending</button>
            								@elseif($applicant['status'] == 'ACCEPTED')
            									<button class="btn btn-success btn-xs">Accepted</button>
            								@else
            									<button class="btn btn-danger btn-xs">Rejected</button>
            								@endif
            							</td>
            							<td>
            								<a href="#" title="Details" class="icon-table"><i class="fa fa-search"></i></a>
            								<a href="{{ route('offers/details', ['id' => $offer['id'], 'order' => $interview['order']]) }}" title="Accept" class="icon-table green">
            									<i class="fa fas fa-check"></i>
        									</a>
            								<a href="#" title="Reject" class="icon-table red">
            									<i class="fa fas fa-times"></i>
        									</a>
            							</td>
            						</tr>
            						@endforeach
            					</tbody>
            				</table>
            				@else
            				<p>There are no applicants on this phase.</p>
            				@endif
							<!-- /applicant list -->
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
							<form action="" class="form-horizontal form-label-left" method="post">
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
							</form>
						</div>
					</div>
				</div>
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
@endsection
@section('extended-scripts')
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
