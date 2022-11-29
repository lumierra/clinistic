<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Resume Medis RSUD Langsa">
        <meta name="author" content="IT RSUD Langsa">
        <meta property="og:title" content="{{ $dataWebsite->nama_website }}" />
        <meta property="og:description" content="{{ $dataWebsite->nama_website ?? '' }}" />
        <meta property="og:url" content="{{ route('login') }}" />
        <meta property="og:image" content="{{ asset($dataWebsite->logo ?? '') }}" />
        <link rel="icon" href="{{ asset($dataWebsite->logo ?? '') }}">

        <title>{{ $dataWebsite->nama_singkat ?? '' }} - @yield('title') </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Vendors Style-->
        <link rel="stylesheet" href="{{ asset('fe/css/vendors_css.css') }}">

        <!-- Revolution Slider -->
        <link rel="stylesheet" type="text/css" href="{{ asset('fe/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fe/revolution-slider/revolution/css/settings.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fe/revolution-slider/revolution/css/layers.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fe/revolution-slider/revolution/css/navigation.css') }}">

        <!-- Style-->
        <link rel="stylesheet" href="{{ asset('fe/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('fe/css/skin_color.css') }}">
        @stack('style')
    </head>

<body class="theme-{{ $dataWebsite->template ?? 'primary' }}">

	<!-- The social media icon bar -->
	<div class="icon-bar-sticky">
        <a href="{{ $dataWebsite->facebook ?? '#' }}" target="_blank" class="waves-effect waves-light btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
        <a href="{{ $dataWebsite->instagram ?? '#' }}" target="_blank" class="waves-effect waves-light btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
        <a href="{{ $dataWebsite->youtube ?? '#' }}" target="_blank" class="waves-effect waves-light btn btn-social-icon btn-youtube"><i class="fa fa-youtube-play"></i></a>
	</div>
	<header class="top-bar">
		<div class="topbar">
            <div class="container">
                <div class="row justify-content-end">
                <div class="col-md-7 col-12 d-md-block d-none">
                    <div class="topbar-social text-center text-md-start topbar-left">
                    <ul class="list-inline d-md-flex d-inline-block text-danger">
                        <li class="ms-10 pe-10 fs-20"><a href="{{ route('home') }}">{{ $dataWebsite->nama_website ?? '-' }}</a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-12">
                    <div class="topbar-social text-center text-md-right">
                    <ul class="list-inline d-md-flex justify-content-end">
                        <li class="ms-10 pe-10"><a href = "mailto: {{ $dataWebsite->email ?? 'test@mail.com' }}"><i class="text-white fa fa-envelope"></i> {{ $dataWebsite->email ?? '' }}</a></li>
                        <li class="ms-10 pe-10"><a href="tel:{{ $dataWebsite->phone ?? '00' }}"><i class="text-white fa fa-phone"></i> {{ $dataWebsite->phone ?? '' }}</a></li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
		</div>

		<nav hidden class="nav-white nav-transparent">
			<div class="nav-header">
				<a href="index.html" class="brand">
                    <img src="{{ asset($dataWebsite->logo ?? '') }}" class="img-fluid" alt="" style="width: 50%" />
					{{-- <img src="{{ asset('template/images/logo-light-text2.png') }}" class="img-fluid" alt=""/> --}}
				</a>
				<button class="toggle-bar">
					<span class="ti-menu"></span>
				</button>
			</div>
			<x-beranda.menu />


			<ul class="attributes">
				<li><a href="#" class="toggle-search-fullscreen"><span class="ti-search"></span></a></li>
			</ul>
			<div class="wrap-search-fullscreen">
				<div class="container">
					<button class="close-search"><span class="ti-close"></span></button>
					<input type="text" placeholder="Search..." />
				</div>
			</div>
		</nav>
	</header>

	<!--Slider Here-->

    {{ $slot }}

    <!--Footer-->
    <x-beranda.footer />


	<!-- Vendor JS -->
	<script src="{{ asset('fe/js/vendors.min.js') }}"></script>
	<!-- Corenav Master JavaScript -->
    <script src="{{ asset('fe/corenav-master/coreNavigation-1.1.3.js') }}"></script>
    <script src="{{ asset('fe/js/nav.js') }}"></script>
	<script src="{{ asset('template/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js') }}"></script>
	<script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>

    <!-- REVOLUTION JS FILES -->
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

	<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('fe/revolution-slider/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('fe/js/revolution-slider.js') }}" type="text/javascript"></script>


	<!-- Rhythm front end -->
	<script src="{{ asset('fe/js/template.js') }}"></script>

    <script src="{{ asset('template/js/vendors.min.js') }}"></script>
    @stack('script')

</body>
</html>
