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
<div class="row top_tiles">
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-eye gray-blue"></i></div>
            <div id="viewsCount" class="count">{{$viewsCount}}</div>
            <h3 class="gray-blue">Views</h3>
        </div>
    </div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-users gray-blue"></i></div>
            <div id="applicantsCount" class="count">{{$applicantsCount}}</div>
            <h3 class="gray-blue">Applicants</h3>
        </div>
    </div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-flask gray-blue"></i></div>
            <div id="kiwixCount" class="count">{{$kiwixCount}}</div>
            <h3 class="gray-blue">Kiwix</h3>
        </div>
    </div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-user gray-blue"></i></div>
            <div id="hiringCount" class="count">{{$hiringCount}}</div>
            <h3 class="gray-blue">Hiring</h3>
        </div>
    </div>
<!--     <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12"> -->
<!--         <div class="tile-stats"> -->
<!--             <div class="icon"><i class="fa violet fa-clock-o"></i></div> -->
<!--             <div id="hiringCount" class="count">-</div> -->
<!--             <h3>Hiring time</h3> -->
<!--         </div> -->
<!--     </div> -->
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
