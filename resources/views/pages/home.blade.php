@extends('layouts.app') @section('content')
<div class="row tile_count">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<select id="experience" name="experience" required="required"
			class="form-control col-md-7 col-xs-12">
			<option value="1">Todas</option>
			<option value="2">Programador Junior PHP - Laravel</option>
			<option value="3">Fullstack backend developer</option>
			<option value="3">Product manager senior</option>
		</select>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<fieldset>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend input-group">
						<span class="add-on input-group-addon"><i
							class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> <input
							type="text" style="width: 200px" name="reservation"
							id="reservation" class="form-control"
							value="01/01/2016 - 01/25/2016" />
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<!-- top tiles -->
<div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Visualizaciones</span>
		<div class="count">2500</div>
		<span class="count_bottom"><i class="green">4% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Aplicantes</span>
		<div class="count">123.50</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3%
		</i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Elenius</span>
		<div class="count green">2,500</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34%
		</i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Contrataciones</span>
		<div class="count">4,567</div>
		<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12%
		</i> From last Week</span>
	</div>
	<div class="col-md-4 col-sm-8 col-xs-12 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Tiempo medio de
			contratación</span>
		<div class="count">2,315</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34%
		</i> From last Week</span>
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
						<div id="chart_plot_02" class="demo-placeholder"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /top tiles -->
@endsection @section('extended-css') @endsection
@section('extended-scripts') @endsection
