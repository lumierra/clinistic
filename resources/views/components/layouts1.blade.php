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
	<link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/skin_color.css') }}">
    @stack('style')
</head>
<body class="hold-transition light-skin sidebar-mini theme-{{ $dataWebsite->template ?? 'primary' }} fixed">

<div class="wrapper">
	<div id="loader"></div>

    <header class="main-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard.index') }}" class="logo">
            <!-- logo-->
            <div class="logo-mini w-50">
                <span class="light-logo"><i class="fad fa-landmark-alt fs-40 text-primary mt-20"></i></span>
            </div>
            <div class="logo-lg">
                <span class="light-logo"><img src="{{ asset('images/dashboard.png') }}" alt="logo"></span>
            </div>
            </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
                        <i data-feather="align-left"></i>
                    </a>
                </li>
                <li class="btn-group d-lg-inline-flex d-none">
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <form>
                                <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn" type="submit" id="button-addon3"><i data-feather="search"></i></button>
                                </div>
                                </div>
                            </form>
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
                <!-- Notifications -->
                {{-- <li class="dropdown notifications-menu">
                    <a href="#" class="waves-effect waves-light dropdown-toggle btn-info-light" data-bs-toggle="dropdown" title="Notifications">
                    <i data-feather="bell"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Notifications</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                        <li>
                            <a href="#">
                            <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all</a>
                    </li>
                    </ul>
                </li> --}}

                <!-- Control Sidebar Toggle Button -->
                {{-- <li class="btn-group nav-item">
                        <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect full-screen waves-light btn-danger-light">
                            <i data-feather="settings"></i>
                        </a>
                </li> --}}

                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow" data-bs-toggle="dropdown" title="User">
                        <div class="d-flex pt-5">
                            <div class="text-end me-10">
                                <p class="pt-5 fs-14 mb-0 fw-700 text-primary">{{ Auth::user()->name }}</p>
                                <small class="fs-10 mb-0 text-uppercase text-mute">{{ Str::ucfirst(implode(', ', Auth::user()->roles()->get()->pluck('name')->toArray())) }}</small>
                            </div>
                            <img src="{{ asset('template/images/avatar/avatar-1.png') }}" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="" />
                        </div>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                    <li class="user-body">
                        {{-- <a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My Wallet</a>
                        <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i> Settings</a> --}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ti-lock text-muted me-2"></i> Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar position-relative">
            <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                @include('components.menu')

                <div class="sidebar-widgets">
                    <div class="copyright text-center m-25">
                        <p><strong class="d-block">{{ $dataWebsite->nama_website ?? '' }}</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    {{ $slot }}
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        &copy; <script>document.write(new Date().getFullYear())</script> {{ $dataWebsite->footer ?? '' }}
    </footer>
    <div class="control-sidebar-bg"></div>
</div>


	<!-- Vendor JS -->
	<script src="{{ asset('template/js/vendors.min.js') }}"></script>
	<script src="{{ asset('template/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('template/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
	<!-- Rhythm Admin App -->
	<script src="{{ asset('template/js/template.js') }}"></script>

    @stack('script')
    <script>
        $('.select2').select2();

        function alertSucces(){
            $.toast({
                heading: 'SUKSES',
                text: 'Data Berhasil Disimpan',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
        }

        function alertDelete(){
            $.toast({
                heading: 'SUKSES',
                text: 'Data Berhasil Dihapus !!!',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
        }

        function alertDanger(){
            $.toast({
                heading: 'GAGAL',
                text: 'Data Gagal Disimpan !!!',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3500
            });
        }
    </script>
</body>
</html>
