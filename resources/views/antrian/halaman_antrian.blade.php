<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $dataWebsite->nama_website }}">
    <meta name="author" content="{{ $dataWebsite->nama_singkat }}">
    <meta property="og:title" content="{{ $dataWebsite->nama_website }}" />
    <meta property="og:description" content="{{ $dataWebsite->nama_website ?? '' }}" />
    <meta property="og:url" content="{{ route('login') }}" />
    <meta property="og:image" content="{{ asset($dataWebsite->logo ?? '') }}" />
    <link rel="icon" href="{{ asset($dataWebsite->logo ?? '') }}">

    <title>{{ $dataWebsite->nama_singkat ?? '' }} - @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('template/css/vendors_css.css') }}">

	<!-- Style-->
	<link rel="stylesheet" href="{{ asset('template/css/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/skin_color.css') }}">
    <style>
        .btn-primary3 {
            background-color: #77D9DA !important;
            border-color: #77D9DA !important;
        }
        .modal.fade {
            z-index: 10000 !important;
        }
        .select2-container{
            z-index: 10001 !important;
        }
        .jq-toast-wrap {
            z-index: 10003 !important;
        }
    </style>
    @stack('style')
</head>
<body class="layout-top-nav light-skin theme-{{ $dataWebsite->template ?? 'primary' }} fixed">

<div class="wrapper">
	<div id="loader"></div>

    <header class="main-header">
        <div class="inside-header">
            <div class="d-flex align-items-center logo-box justify-content-start">
                <a href="{{ route('admin.dashboard.index') }}" class="logo">
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{ asset($dataWebsite->logo ?? 'images/logo.png') }}" alt="logo" width="100%"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group d-lg-inline-flex d-none">
                        <div class="app-menu">
                            <div class="fs-20 fw-bold btn btn-primary">
                                <i class="fa-solid fa-alarm-clock fa-beat"></i>
                                {{ $hariini }}
                                <span id="jam"></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group nav-item d-lg-inline-flex d-none">
                        <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen btn-warning-light" title="Full Screen">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                </ul>
            </div>
            </nav>
        </div>
    </header>
    <nav class="main-nav" role="navigation">

        <!-- Mobile menu toggle button (hamburger/x icon) -->
        {{-- <input id="main-menu-state" type="checkbox" /> --}}
        {{-- <label class="main-menu-btn" for="main-menu-state">
            <span class="main-menu-btn-icon"></span> Toggle main menu visibility
        </label> --}}

        <!-- Sample menu definition -->
        <ul id="main-menu" class="sm sm-blue">
            {{-- MOBILE --}}
            {{-- <div class="d-inline d-sm-none col-md-6 col-12">
                <h3 class="text-center test">Selamat Datang, {{ Str::title(Auth::user()->name) }}</h3>
                <h5 class="text-center test">Di Sistem Informasi Manajemen Klinik</h5>
                <h5 class="text-center test">{{ $dataWebsite->nama_website ?? '' }}</h5>
            </div> --}}
            {{-- DESKTOP --}}
            <div class="d-none d-md-inline d-sm-none col-md-6 col-12">
                <div class="box text-center p-0 m-0">
                    <div class="box-body p-0">
                        <div class="row p-0">
                            <div class="col-12 p-0">
                                <h1 class="p-0 m-0">ANTRIAN <i class="fa-solid fa-person-walking-arrow-right"></i></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </ul>

    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            {{-- MOBILE --}}
                            <div class="d-inline d-sm-none col-md-8 col-12">
                                <iframe width="100%" height="350" src="https://www.youtube.com/embed/kSmMOsJmkfs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                            <div class="col-md-4 col-12" id="poliUmum">
                                <div class="col-12">
                                    <div class="box" style="border-radius:10px">
                                        <div class="card-body bg-primary text-center" style="border-radius:15px 15px 0px 0px">
                                            <span class="text-muted me-1 fw-bold text-white fs-20">NOMOR ANTRIAN</span>
                                        </div>
                                        <div class="box-body">
                                            <div class="text-center">
                                                <div class="fs-60 text-info">{{ $antrianUmum }}</div>
                                                <span class="text-muted text-uppercase fw-bold">{{ $statusUmum }}</span>
                                            </div>
                                        </div>
                                        <div class="card-body bg-primary text-center" style="border-radius:0px 0px 15px 15px">
                                            <span class="text-muted me-1 fw-bold text-white fs-20">POLI UMUM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- DESKTOP --}}
                            <div class="d-none d-md-inline d-sm-none col-md-8 col-12">
                                <iframe width="100%" height="350" src="https://www.youtube.com/embed/kSmMOsJmkfs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row" id="semuaPoli">
                            @php
                                $color = ['success','danger','warning','info','dark', 'success', 'danger', 'warning', 'info', 'dark'];
                            @endphp
                            @foreach ($poli as $key => $item)
                                <div class="col-md-3 col-12">
                                    <div class="box box-solid bg-{{ $color[$key] }} bb-3 border-{{ $color[$key] }}" style="border-radius:10px">
                                        <div class="box-header bg-{{ $color[$key] }} text-center">
                                            <span class="text-muted me-1 fw-bold text-white fs-20">{{ $item->nama }}</span>
                                        </div>
                                        <div class="box-body">
                                            <div class="text-center">
                                            <div class="fs-60 text-{{ $color[$key] }}">{{ $item->getNomorAntrian() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box bg-primary text-center align-middle">
                            <span style="margin-top:5px; margin-bottom:5px;">JAM BUKA LAYANAN KAMI ADALAH PUKUL 07:00 s/d 22.00 TERIMA KASIH ATAS KUNJUNGAN ANDA. KAMI SENANTIASA MELAYANI SEPENUH HATI</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.content-wrapper -->

    {{-- <footer class="main-footer">
        &copy; <script>document.write(new Date().getFullYear())</script> {{ $dataWebsite->footer }}
    </footer>

    <div class="control-sidebar-bg"></div> --}}
    {{-- <button id="play">Unmute</button> --}}
</div>


	<!-- Vendor JS -->
    <script src="{{ asset('template/js/vendors.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('template/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>

	<!-- Rhythm Admin App -->
	<script src="{{ asset('template/js/jquery.smartmenus.js') }}"></script>
	<script src="{{ asset('template/js/menus.js') }}"></script>
    <script src="{{ asset('template/js/template.js') }}"></script>

    @stack('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h +':'+ m +':'+ s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
        }
        jam();

        setInterval(function(){
            $.ajax({
                url: "{{ route('halaman-antrian.create') }}",
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $('#poliUmum').html(data);
                }
            });
            $.ajax({
                url: "{{ route('halaman-antrian.index') }}" + '/1',
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $('#semuaPoli').html(data);
                }
            });
        }, 1000);

    </script>
</body>
</html>
