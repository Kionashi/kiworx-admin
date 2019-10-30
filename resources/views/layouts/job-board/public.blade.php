<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	@include('layouts.job-board.head')
</head>

<body>
	<style>
        @media (min-width: 992px){
            #topnav.scroll {
                background: #FFF !important;
            }
        }
        
        .footer-alt {
            background: #293663;
        }
	</style>
	@include('layouts.job-board.apply')
    <!-- Navigation Bar-->
    <header id="topnav" class="defaultscroll scroll-active">
        <div class="container">
            <!-- Logo container-->
            <div>
                <a href="index.html" class="logo">
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
    <!-- end home -->

    @yield('content')

    <!-- footer-alt start -->
    <section class="footer-alt pt-3 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="copyright mb-0">2019 © Powered by Kiworx</p>
                </div>
            </div>
        </div>
    </section>
    <!-- footer-alt end -->

	@include('layouts.job-board.scripts')

</body>
</html>