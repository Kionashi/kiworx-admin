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
        .job-detail-icons li a {
            color: #293663;
            border: 1px solid; 
        }
        .job-detail-icons li a:hover {
            background-color: #293663;
        }
	</style>

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