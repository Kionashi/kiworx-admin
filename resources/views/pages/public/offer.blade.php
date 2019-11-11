@extends('layouts.job-board.public') @section('section', $offer['company']['name'].'-'.$offer['job_title'])
@section('content')
@include('layouts.job-board.apply')
<!-- Navigation Bar-->
<header id="topnav" class="defaultscroll scroll-active">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a href="{{route('offer/public-list', ['company' => $offer['company']['friendly_name']])}}" class="logo">
                <img src="{{$offer['company']['logo']}}" alt="" class="logo-light" height="58" />
                <img src="{{$offer['company']['logo']}}" alt="" class="logo-dark" height="58" />
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
                <a href="{{$offer['company']['website']}}" class="btn btn-custom btn-sm"><i class="mdi mdi-cloud-upload"></i> Company website</a>
            </ul>
            <!-- End navigation menu-->
        </div>
    </div>
</header>
<!-- End Navigation Bar-->
<section class="job-details" style="background-image: url({{$offer['company']['background_logo']}});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="page-header-title text-center text-white">
                    <h4 class="text-uppercase">{{$offer['job_title']}}</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JOB DETAILS START -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-dark">Job Details</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <div class="job-detail mt-2 p-4">
                    <div class="job-detail-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="job-detail-com-desc">
                                    <h4 class="mb-2"><a href="#" class="text-dark">{{$offer['job_title']}}</a></h4>
                                    <p class="text-muted mb-0"><i class="mdi mdi-link-variant mr-2"></i>{{$offer['company']['name']}}</p>
                                    <p class="text-muted mb-0"><i class="mdi mdi-map-marker mr-2"></i>{{$offer['location']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="job-detail-desc">
                        <p class="text-muted">{{$offer['job_brief']}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-dark mt-4">Job Description</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="job-detail mt-2 p-4">
                            <div class="job-detail-desc text-muted">
                                {!! $offer['description'] !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-dark mt-4">Responsibilities</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="job-detail mt-2 p-4">
                            <div class="job-detail-desc text-muted">
                            	{!! $offer['responsibilities'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="job-detail mt-2 mt-40 p-2">
                    <h5 class="text-muted text-center mb-1 p-2"><i class="mdi mdi-map-marker mr-2"></i>Location</h5>
                    <hr class="mt-0 mb-0">

                    <div class="job-detail-location p-2">
                        <div class="job-details-desc-item">
                            <div class="float-left mr-2">
                                <i class="mdi mdi-bank text-muted f-16"></i>
                            </div>
                            <p class="text-muted mb-2 f-14">: {{$offer['company']['address']}}</p>
                        </div>

                        <div class="job-details-desc-item">
                            <div class="float-left mr-2">
                                <i class="mdi mdi-web text-muted f-16"></i>
                            </div>
                            <p class="text-muted mb-2 f-14">: <a target="_blank" href="{{$offer['company']['website']}}">{{$offer['company']['website']}}</a></p>
                        </div>

                        <div class="job-details-desc-item">
                            <div class="float-left mr-2">
                                <i class="mdi mdi-cellphone-iphone text-muted f-16"></i>
                            </div>
                            <p class="text-muted mb-2 f-14">: {{$offer['company']['phone']}}</p>
                        </div>

                        <div class="job-details-desc-item">
                            <div class="float-left mr-2">
                                <i class="mdi mdi-currency-usd text-muted f-16"></i>
                            </div>
                            <p class="text-muted mb-2 f-14">: {{$offer['salary']?$offer['salary']:$offer['salary_min'].' - '. $offer['salary_max']}}</p>
                        </div>

                        <div class="job-details-desc-item">
                            <div class="float-left mr-2">
                                <i class="mdi mdi-security text-muted f-16"></i>
                            </div>
                            <p class="text-muted mb-2 f-14">: {{ \App\Enums\OfferExperience::getFriendlyName($offer['experience']) }}</p>
                        </div>

                        <div class="job-details-desc-item">
                            <div class="float-left mr-2">
                                <i class="mdi mdi-clock-outline text-muted f-16"></i>
                            </div>
                            <p class="text-muted mb-2 f-14">: {{\App\Enums\OfferWorkingDays::getFriendlyName($offer['working_days'])}}</p>
                        </div>

                        <h6 class="text-dark f-17 mt-3 mb-0">Share Job</h6>
                        <ul class="job-detail-icons list-inline mt-2 mb-0">
                            <li class="list-inline-item"><a href="#" class=""><i class="mdi mdi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#" class=""><i class="mdi mdi-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#" class=""><i class="mdi mdi-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="#" class=""><i class="mdi mdi-whatsapp"></i></a></li>
                            <li class="list-inline-item"><a href="#" class=""><i class="mdi mdi-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="job-detail mt-4 p-2">
                </div>

                <div class="job-detail mt-4 p-1">
                    @if(session('disabledSubmit'))
                    	<input type="button" disabled class="btn btn-success btn-block btn-sm" value="Thanks for applying" />
                    @else
                    	<a href="#ModalCenter1" class="btn btn-custom btn-block btn-sm" data-toggle="modal" data-target="#ModalCenter1">Apply For Job</a>
                    	<p style="color:red;">{{session('errorMessage')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- JOB DETAILS END -->
@endsection @section('extended-css') @endsection
@section('extended-scripts') @endsection
