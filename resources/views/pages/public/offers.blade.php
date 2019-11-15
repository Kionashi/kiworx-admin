@extends('layouts.job-board.public') @section('section',$company['name']) @section('content')
<!-- Navigation Bar-->
<header id="topnav" class="defaultscroll scroll-active">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a href="{{route('offer/public-list', ['company' => $company['friendly_name']])}}" class="logo">
                <img src="{{$company['logo']}}" alt="" class="logo-light" height="58" />
                <img src="{{$company['logo']}}" alt="" class="logo-dark" height="58" />
            </a>
        </div>
        <!-- End Logo container-->
        <div class="menu-extras">

            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <div id="navigation">

            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <a href="{{$company['website']}}" class="btn btn-custom btn-sm"><i class="mdi mdi-cloud-upload"></i> Company website</a>
            </ul>
            <!-- End navigation menu-->
        </div>
    </div>
</header>
<!-- End Navigation Bar-->
<section class="job-details" style="background-image: url({{$company['background_image']}});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="page-header-title text-center text-white">
                    <h1 class="text-uppercase">{{$company['name']}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- EMPLOYERS DETAILS START -->
<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center p-3">
					<div class="employers-details-img mb-2">
						<img src="images/featured-job/img-3.png" alt=""
							class="img-fluid mx-auto d-block">
					</div>
					<h3 class="font-weight-light">
						<a href="#" class="text-dark">{{$company['name']}}</a>
					</h3>
					<ul class="list-inline mb-0">
						<li class="list-inline-item mr-3">
							<p class="text-muted mb-2">
								<i class="mdi mdi-map-marker mr-2"></i><a style="color: #666;" href="{{$company['address_url']}}" target="_blank">{{$company['address']}}</a>
							</p>
						</li>
					</ul>
					<ul class="job-detail-icons list-inline mt-2 mb-0">
						@if($company['facebook'])
							<li class="list-inline-item"><a href="{{$company['facebook']}}" target="_blank"><i class="mdi mdi-facebook"></i></a></li>
						@endif
						@if($company['twitter'])
							<li class="list-inline-item"><a href="{{$company['twitter']}}" target="_blank"><i class="mdi mdi-twitter"></i></a></li>
						@endif
						@if($company['instagram'])
							<li class="list-inline-item"><a href="{{$company['instagram']}}" target="_blank"><i class="mdi mdi-instagram"></i></a></li>
						@endif
						@if($company['linkedin'])
							<li class="list-inline-item"><a href="{{$company['linkedin']}}" target="_blank"><i class="mdi mdi-linkedin"></i></a></li>
						@endif
						@if($company['linkedin'])
							<li class="list-inline-item"><a href="{{$company['youtube']}}" target="_blank"><i class="mdi mdi-youtube"></i></a></li>
						@endif
						@if($company['website'])
							<li class="list-inline-item"><a href="{{$company['website']}}" target="_blank"><i class="mdi mdi-earth"></i></a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="text-dark mt-5">About {{$company['name']}}</h3>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="job-detail mt-2 p-4">
					<div class="job-detail-desc">
						<p class="text-muted f-14 mb-3">{{ $company['description'] }}</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="text-dark mt-4">Jobs</h3>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				@foreach($offers as $offer)
    				<div class="employers-details-item mt-2">
    					<div class="job-list-box job-list-desc p-3">
    						<div class="row align-items-center">
    							<div class="col-md-9">
    								<div class="grid-list-desc">
    									<h5 class="mb-1">
    										<a href="{{route('offer/public', ['company' => $company['friendly_name'], 'code' => $offer['code']])}}" class="text-dark">{{$offer['job_title']}}</a>
    									</h5>
    									<p class="text-muted f-15 mb-0">{{ \App\Enums\OfferExperience::getFriendlyName($offer['experience']) }} - {{\App\Enums\OfferWorkingDays::getFriendlyName($offer['working_days'])}} - {{$offer['salary']?$offer['salary']:$offer['salary_min'].' - '. $offer['salary_max']}}</p>
    								</div>
    							</div>
    
    							<div class="col-md-3">
    								<div class="employers-details-time">
    									<h6 class="text-muted font-weight-light text-right mb-0">
    										<i class="mdi mdi-clock-outline mr-2"></i>{{ $offer['createdAt'] }}
    									</h6>
    								</div>
    							</div>
    						</div>
    
    						<div class="row">
    							<div class="col-md-12">
    								<hr class="employers-details-item-border mt-1 mb-2">
    								<p class="text-muted mb-0">{{ $offer['job_brief'] }}</p>
    							</div>
    						</div>
    					</div>
    				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
<!-- EMPLOYERS DETAILS END -->
@endsection @section('extended-css') @endsection
@section('extended-scripts') @endsection
