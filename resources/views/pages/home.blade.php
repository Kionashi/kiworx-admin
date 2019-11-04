@extends('layouts.app')
@section('section', 'Dashboard')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row tile_count">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<select id="jobTitle" name="jobTitle" required="required"
			class="form-control col-md-7 col-xs-12">
			<option value="0">All</option>
			@foreach($offers as $offer)
				<option value="{{$offer['id']}}">{{$offer['job_title']}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<fieldset>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend input-group">
						<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> 
						<input type="text" style="width: 200px" name="dateRange" id="dateRange" class="form-control" value="" />
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<!-- top tiles -->
<div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="counTitlet_top"><i class="fa fa-eye"></i> Views</span>
		<div id="viewsCount" class="count">{{$viewsCount}}</div>
<!-- 		<span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-users"></i> Applicants</span>
		<div id="applicantsCount" class="count">{{$applicantsCount}}</div>
<!-- 		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3%</i> From last Week</span> -->
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-flask"></i> Kiwix</span>
		<div id="kiwixCount" class="count green">{{$kiwixCount}}</div>
<!-- 		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34%</i> From last Week</span> -->
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Hiring</span>
		<div id="hiringCount" class="count">{{$hiringCount}}</div>
<!-- 		<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12%</i> From last Week</span> -->
	</div>
	<div class="col-md-4 col-sm-8 col-xs-12 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Hiring time</span>
		<div class="count">-</div>
<!-- 		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34%</i> From last Week</span> -->
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					KPIs <small>Weekly progress</small>
				</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="demo-container" style="height: 280px">
						<div id="view-apply-chart" class="demo-placeholder"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /top tiles -->
@endsection

@section('extended-scripts')
<script src="{{ asset('js/home.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	// Initial chart data
	var chartViewData = [];
	var chartApplicantData = [];
	
	@foreach($applicantsViewsChartData as $i => $applicantViewChartData)
	chartApplicantData.push([
		// Time
		{{$i}},
		// Count 
		{{$applicantViewChartData['applicants']}}
	]);
	chartViewData.push([
		// Time
		{{$i}},
		// Count 
		{{$applicantViewChartData['views']}}
	]);
	@endforeach
	
	var maxDate = {{$maxDate}};
	var minDate = {{$minDate}};
	var searchUrl = '{{route("search-home")}}';
	console.log('Initial');
	console.log(maxDate);
	// Filters
	$('#jobTitle').change(function(){
		var initDate = $('#dateRange').data('daterangepicker').startDate._d;
		var endDate = $('#dateRange').data('daterangepicker').endDate._d;
		var body = {
			initDate: initDate.toISOString(),
			endDate: endDate.toISOString(),
			offerId: $('#jobTitle').val()
		};
		
		$.ajax({
			type: 'POST',
			url: searchUrl,
			dataType: 'json',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data: body,
			success: filterCallback,
			error: function() {
				console.log("No se ha podido obtener la información");
			}
		});
	});
	
	// Init chart
	initKPIChart(minDate, maxDate, chartViewData, chartApplicantData);
	init_daterangepicker_reservation(searchUrl);
});
</script>

@endsection
