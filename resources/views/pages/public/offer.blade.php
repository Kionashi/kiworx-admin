@extends('layouts.public') @section('section', $offer['company']['name'].'-'.$offer['job_title'])
@section('content')
<!-- top tiles -->
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false"><i
							class="fa fa-wrench"></i></a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Settings 1</a> <a
								class="dropdown-item" href="#">Settings 2</a>
						</div></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<!-- start project-detail sidebar -->
				<div class="col-md-9 col-sm-9 col-xs-12">
					<section class="panel">
						<div class="x_title">
							<h2>{{$offer['company']['name']}} - {{$offer['job_title']}}</h2>
							<a style="float:right" href="#" class="btn btn-sm btn-primary">Aplicar</a>
							<div class="clearfix"></div>
						</div>
						<div class="panel-body">
							<h3 class="green">
								<img src="{{$offer['company']['logo']}}" />
							</h3>
							<div class="project_detail">
								<p class="title">Descriptin</p>
    							<p>{{$offer['description']}}</p>
    							<p class="title">Responsibilities</p>
    							<p>{{$offer['responsibilities']}}</p>
    							<br />
								<p class="title">Salary</p>
								<p>{{$offer['salary']}}</p>
								<p class="title">Experience</p>
								<p>{{$offer['experience']}}</p>
								<p class="title">Contract type</p>
								<p>{{$offer['contract_type']}}</p>
								<p class="title">Category</p>
								<p>{{$offer['category']}}</p>
								<p class="title">Working days</p>
								<p>{{$offer['working_days']}}</p>
								<p class="title">Location</p>
								<p>{{$offer['location']}}</p>
							</div>
							<br />
						</div>
					</section>
				</div>
				<!-- end project-detail sidebar -->
			</div>
		</div>
	</div>
</div>
<!-- /top tiles -->
@endsection @section('extended-css') @endsection
@section('extended-scripts') @endsection
