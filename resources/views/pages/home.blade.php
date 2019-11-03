@extends('layouts.app')
@section('section', 'Dashboard')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row tile_count">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<select id="jobTitle" name="jobTitle" required="required"
			class="form-control col-md-7 col-xs-12">
			<option value="0">Todas</option>
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
		<span class="counTitlet_top"><i class="fa fa-eye"></i> Visualizaciones</span>
		<div id="viewsCount" class="count">{{$viewsCount}}</div>
<!-- 		<span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-users"></i> Aplicantes</span>
		<div id="applicantsCount" class="count">{{$applicantsCount}}</div>
<!-- 		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3%</i> From last Week</span> -->
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-flask"></i> Kiwix</span>
		<div id="kiwixCount" class="count green">{{$kiwixCount}}</div>
<!-- 		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34%</i> From last Week</span> -->
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Contrataciones</span>
		<div id="hiringCount" class="count">{{$hiringCount}}</div>
<!-- 		<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12%</i> From last Week</span> -->
	</div>
	<div class="col-md-4 col-sm-8 col-xs-12 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Tiempo medio de contratación</span>
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
@endsection @section('extended-css') @endsection
@section('extended-scripts')
<script type="text/javascript">
$(document).ready(function(){

	$('#jobTitle').click(function(){
		var startDate = $('#dateRange').data('daterangepicker').startDate._d;
		var endDate = $('#dateRange').data('daterangepicker').endDate._d;
		var body = {
			initDate: startDate.toISOString(),
			endDate: endDate.toISOString(),
			offerId: $('#jobTitle').val()
		};
		
		$.ajax({
			type: 'POST',
			url: '{{route("home")}}',
			dataType: 'json',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data: body,
			success: function(respuesta) {
				// Update data
				$('#viewsCount').text(respuesta.viewsCount);
				$('#applicantsCount').text(respuesta.applicantsCount);
				$('#kiwixCount').text(respuesta.kiwixCount);
				$('#hiringCount').text(respuesta.hiringCount);
			},
			error: function() {
		        console.log("No se ha podido obtener la información");
		    }
		});
	});
	
	function init_daterangepicker_reservation() {
		
		if(typeof ($.fn.daterangepicker) === 'undefined'){ return; }
	
		$('#dateRange').daterangepicker(null, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
			console.log($('#jobTitle').val());
			var body = {
				initDate: start.toISOString(),
				endDate: end.toISOString(),
				offerId: $('#jobTitle').val()
			};
			
			$.ajax({
				type: 'POST',
				url: '{{route("home")}}',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				data: body,
				success: function(respuesta) {
					// Update data
					$('#viewsCount').text(respuesta.viewsCount);
					$('#applicantsCount').text(respuesta.applicantsCount);
					$('#kiwixCount').text(respuesta.kiwixCount);
					$('#hiringCount').text(respuesta.hiringCount);
					
					console.log();
				},
				error: function() {
			        console.log("No se ha podido obtener la información");
			    }
			});
			
		});

	}
	
    function init_flot_chart(){
    	
    	if( typeof ($.plot) === 'undefined'){ return; }
    	
    	var chart_plot_02_data = [];
    	var chart_plot_02_datax = [];
    	
    	@foreach($applicantsViewsChartData as $i => $applicantViewChartData)
    		chart_plot_02_datax.push([
    			// Time
    			{{$i}},
    			// Count 
    			{{$applicantViewChartData['applicants']}}
    		]);
    		chart_plot_02_data.push([
    			// Time
    			{{$i}},
    			// Count 
    			{{$applicantViewChartData['views']}}
    		]);
    	@endforeach
    	
    	var maxDate = {{$maxDate}};
    	var minDate = {{$minDate}};
		
    	var chart_plot_02_settings = {
    		grid: {
    			show: true,
    			aboveData: true,
    			color: "#3f3f3f",
    			labelMargin: 10,
    			axisMargin: 0,
    			borderWidth: 0,
    			borderColor: null,
    			minBorderMargin: 5,
    			clickable: true,
    			hoverable: true,
    			autoHighlight: true,
    			mouseActiveRadius: 100
    		},
    		series: {
    			lines: {
    				show: true,
    				fill: true,
    				lineWidth: 2,
    				steps: false
    			},
    			points: {
    				show: true,
    				radius: 4.5,
    				symbol: "circle",
    				lineWidth: 3.0
    			}
    		},
    		legend: {
    			position: "ne",
    			margin: [0, -25],
    			noColumns: 0,
    			labelBoxBorderColor: null,
    			labelFormatter: function(label, series) {
    				return label + '&nbsp;&nbsp;';
    			},
    			width: 40,
    			height: 1
    		},
    		colors: ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'],
    		shadowSize: 0,
    		tooltip: true,
    		tooltipOpts: {
    			content: "%s: %y.0",
    			xDateFormat: "%d/%m",
    		shifts: {
    			x: -30,
    			y: -50
    		},
    		defaultTheme: false
    		},
    		yaxis: {
    			min: 0
    		},
    		xaxis: {
    			mode: "time",
    			minTickSize: [1, "day"],
    			timeformat: "%d/%m/%y",
    			min: minDate,
    			max: maxDate
    		}
    	};	
    	
    	if ($("#view-apply-chart").length){
    		
    		$.plot( $("#view-apply-chart"), 
    		[{ 
    			label: "Visualizaciones", 
    			data: chart_plot_02_data, 
    			lines: { 
    				fillColor: "rgba(150, 202, 89, 0.12)" 
    			}, 
    			points: { 
    				fillColor: "#fff" } 
    		},
    		{ 
    			label: "Aplicaciones", 
    			data: chart_plot_02_datax, 
    			lines: { 
    				fillColor: "rgba(0, 0, 89, 0.12)" 
    			}, 
    			points: { 
    				fillColor: "#fff" } 
    		}
    		], chart_plot_02_settings);
    		
    	}
    } 
    
    init_flot_chart();
    init_daterangepicker_reservation()
});
</script>

@endsection
