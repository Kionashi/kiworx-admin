function init_daterangepicker_reservation(searchUrl) {
	
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
}
function initKPIChart(minDate, maxDate, chart_plot_02_data, chart_plot_02_datax) {
	// Skip if script is not loaded
	if( typeof ($.plot) === 'undefined'){ return; }
	
	// Settings
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

function filterCallback(response) {
	// Update data
	$('#viewsCount').text(response.viewsCount);
	$('#applicantsCount').text(response.applicantsCount);
	$('#kiwixCount').text(response.kiwixCount);
	$('#hiringCount').text(response.hiringCount);
	console.log('==================');
	console.log(response);
	var applicantsViewsChartData = response.applicantsViewsChartData;

	// Reinitialize chart data
	chartViewData = [];
	chartApplicantData = [];
    for (var date in applicantsViewsChartData) {
        if (applicantsViewsChartData.hasOwnProperty(date)) {
			chartApplicantData.push([
				// Time
				date,
				// Count 
				applicantsViewsChartData[date].applicants
			]);
			chartViewData.push([
				// Time
				date,
				// Count 
				applicantsViewsChartData[date].views
			]);
        }
    }
    initKPIChart(response.minDate, response.maxDate, chartViewData, chartApplicantData);
	console.log('==================');
}