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
        @media(max-width: 575px) {
            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                justify-content: center;
                flex-wrap: wrap;
            }
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
                        <span class="light-logo"><img src="{{ asset($dataWebsite->logo ?? 'images/logo.png') }}" alt="logo" width="50%"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group d-lg-inline-flex d-none">
                        <div class="app-menu">
                            <div class="fs-17 fw-bold btn btn-primary">
                                <i class="fa-solid fa-alarm-clock fa-beat"></i>
                                {{ $hariini }}
                                <span id="jam"></span>
                            </div>
                            {{-- <div class="search-bx mx-5">
                                <form>
                                    <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" id="button-addon3"><i data-feather="search"></i></button>
                                    </div>
                                    </div>
                                </form>
                            </div> --}}
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
                        <a href="#" class="waves-effect waves-light dropdown-toggle btn-info-light" data-bs-toggle="dropdown" title="Notifikasi">
                        <i data-feather="bell"></i>
                        </a>
                        <ul class="dropdown-menu animated bounceIn">

                        <li class="header">
                            <div class="p-20">
                                <div class="flexbox">
                                    <div>
                                        <h4 class="mb-0 mt-0">Notifikasi</h4>
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
                    <!-- User Account-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow" data-bs-toggle="dropdown" title="User">
                            <div class="d-flex pt-5">
                                <div class="text-end me-10">
                                    <p class="pt-5 fs-14 mb-0 fw-700 text-primary">{{ Auth::user()->name }}</p>
                                    <small class="fs-10 mb-0 text-uppercase text-mute">{{ Str::ucfirst(Auth::user()->role->name) }}</small>
                                </div>
                                @if (Auth::user()->foto == null)
                                    @if (Auth::user()->gender == null)
                                        <img src="{{ asset('images/user_male.webp') }}" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="Foto {{ Auth::user()->name }}" />
                                    @else
                                        @if (Auth::user()->gender->jenis_kelamin == 'Laki-laki')
                                            <img src="{{ asset('images/user_male.webp') }}" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="Foto {{ Auth::user()->name }}" />
                                        @else
                                            <img src="{{ asset('images/user_female.webp') }}" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="Foto {{ Auth::user()->name }}" />
                                        @endif
                                    @endif
                                @else
                                    <img src="{{ asset(Auth::user()->foto) }}" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="" />
                                @endif
                            </div>
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('admin.profil.index') }}"><i class="ti-user text-muted me-2"></i> Profil</a>
                            <a class="dropdown-item gantiPassword" href="#"><i class="fad fa-lock-alt text-muted me-2"></i> Ganti Password</a>
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
        </div>
    </header>
    <nav class="main-nav" role="navigation">

        <!-- Mobile menu toggle button (hamburger/x icon) -->
        <input id="main-menu-state" type="checkbox" />
        <label class="main-menu-btn" for="main-menu-state">
            <span class="main-menu-btn-icon"></span> Toggle main menu visibility
        </label>

        <!-- Sample menu definition -->
        <ul id="main-menu" class="sm sm-blue">
            {{-- @if (Auth::user()->role_id == 1 || Auth::user()->name == 'aji') --}}
                <li class="{{ request()->routeIs('admin.dashboard*') ? 'current' : '' }}"><a href="{{ route('admin.dashboard.index') }}"><i class="fad fa-desktop"></i>Dashboard</a></li>
            {{-- @endif --}}
            @if (Auth::user()->role_id == 1 || Auth::user()->id == 1)
                @php
                    $menuAll = Auth::user()->getAllMenu();
                @endphp
                @foreach ($menuAll as $item)
                    @if ($item->url == '')
                        <li><a href="#"><i class="{{ $item->icon }}"></i>{{ $item->nama }}</a>
                            <ul>
                                @foreach ($item->submenu->where('status', 'aktif') as $item2)
                                    @if ($item2->url == '')
                                        <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $item2->nama }}</a>
                                            <ul>
                                                @foreach ($item2->submenudetail as $item3)
                                                    <li class="{{ request()->routeIs('admin.'.$item3->url.'*') ? 'current' : '' }}"><a href="{{ route('admin.'.$item3->url.'.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $item3->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        @if ($item2->menu_id == $item->id)
                                            <li class="{{ request()->routeIs('admin.'.$item2->url.'*') ? 'current' : '' }}"><a href="{{ route('admin.'.$item2->url.'.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $item2->nama }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="{{ request()->routeIs('admin.'.$item->url.'*') ? 'current' : '' }}">
                            <a href="{{ route('admin.'.$item->url.'.index') }}">
                                <i class="{{ $item->icon }}"></i>
                                {{ $item->nama }}
                            </a>
                        </li>
                    @endif
                @endforeach
                {{-- <li><a href="#"><i class="fad fa-layer-group"></i>Master</a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.menu*') ? 'current' : '' }}"><a href="{{ route('admin.menu.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Setting Menu</a></li>
                        <li class="{{ request()->routeIs('admin.pengguna*') ? 'current' : '' }}"><a href="{{ route('admin.pengguna.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pengguna</a></li>
                        <li class="{{ request()->routeIs('admin.poliklinik*') ? 'current' : '' }}"><a href="{{ route('admin.poliklinik.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Poliklinik</a></li>
                        <li class="{{ request()->routeIs('admin.dokter.*') ? 'current' : '' }}"><a href="{{ route('admin.dokter.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dokter</a></li>
                        <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Parameter</a>
                            <ul>
                                <li class="{{ request()->routeIs('admin.satuan*') ? 'current' : '' }}"><a href="{{ route('admin.satuan.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Satuan</a></li>
                                <li class="{{ request()->routeIs('admin.kategori-obat*') ? 'current' : '' }}"><a href="{{ route('admin.kategori-obat.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kategori Obat</a></li>
                                <li class="{{ request()->routeIs('admin.jenis-waste*') ? 'current' : '' }}"><a href="{{ route('admin.jenis-waste.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Jenis Waste</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rujukan</a>
                            <ul>
                                <li class="{{ request()->routeIs('admin.kategori-rujukan*') ? 'current' : '' }}"><a href="{{ route('admin.kategori-rujukan.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kategori Rujukan</a></li>
                                <li class="{{ request()->routeIs('admin.asal-rujukan*') ? 'current' : '' }}"><a href="{{ route('admin.asal-rujukan.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Asal Rujukan</a></li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('admin.asuransi*') ? 'current' : '' }}"><a href="{{ route('admin.asuransi.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Asuransi</a></li>
                        <li class="{{ request()->routeIs('admin.produk*') ? 'current' : '' }}"><a href="{{ route('admin.produk.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Produk</a></li>
                        <li class="{{ request()->routeIs('admin.website*') ? 'current' : '' }}"><a href="{{ route('admin.website.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Profile Klinik</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fad fa-registered"></i>Pendaftaran</a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.pasien.*') ? 'current' : '' }}"><a href="{{ route('admin.pasien.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Pasien</a></li>
                        <li class="{{ request()->routeIs('admin.rawat-jalan.*') ? 'current' : '' }}"><a href="{{ route('admin.rawat-jalan.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rawat Jalan</a></li>
                        <li class="{{ request()->routeIs('admin.pendaftaran-lab.*') ? 'current' : '' }}"><a href="{{ route('admin.pendaftaran-lab.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Laboratorium</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fad fa-stethoscope"></i>Pelayanan</a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.layanan-rwj.*') ? 'current' : '' }}"><a href="{{ route('admin.layanan-rwj.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rawat Jalan</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fad fa-pills"></i>Farmasi</a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.farmasi.*') ? 'current' : '' }}"><a href="{{ route('admin.farmasi.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard Farmasi</a></li>
                        <li class="{{ request()->routeIs('admin.obat.*') ? 'current' : '' }}"><a href="{{ route('admin.obat.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Obat</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fad fa-flask"></i>Laboratorium</a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.lab.*') ? 'current' : '' }}"><a href="{{ route('admin.lab.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard Laboratorium</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fad fa-x-ray"></i>Radiologi</a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.radiologi.*') ? 'current' : '' }}"><a href="{{ route('admin.radiologi.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard Radiologi</a></li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.kasir*') ? 'current' : '' }}"><a href="{{ route('admin.kasir.index') }}"><i class="fad fa-cash-register"></i>Kasir</a></li> --}}
            @else
                @php
                    $datamenu = Auth::user(0)->getMenu();
                    $menuAll = Auth::user()->getAllMenu();
                @endphp

                {{-- BARU --}}
                @foreach ($menuAll as $item)
                    @if ($item->cekMenu())
                        @if ($item->url == '')
                            <li><a href="#"><i class="{{ $item->icon }}"></i>{{ $item->nama }}</a>
                                <ul>
                                    @foreach ($item->submenu->where('status', 'aktif') as $item2)
                                        @if ($item2->url == '')
                                            @if ($item2->cekSubmenu())
                                                <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $item2->nama }}</a>
                                                    <ul>
                                                        @foreach ($item2->submenudetail as $item3)
                                                            <li class="{{ request()->routeIs('admin.'.$item3->url.'*') ? 'current' : '' }}"><a href="{{ route('admin.'.$item3->url.'.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $item3->nama }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @else
                                            @if ($item2->menu_id == $item->id)
                                                @if ($item2->cekSubmenu())
                                                    <li class="{{ request()->routeIs('admin.'.$item2->url.'*') ? 'current' : '' }}"><a href="{{ route('admin.'.$item2->url.'.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $item2->nama }}</a></li>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="{{ request()->routeIs('admin.'.$item->url.'*') ? 'current' : '' }}">
                                <a href="{{ route('admin.'.$item->url.'.index') }}">
                                    <i class="{{ $item->icon }}"></i>
                                    {{ $item->nama }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
            <li class="{{ request()->routeIs('admin.profil.*') ? 'current' : '' }}">
                <a href="{{ route('admin.profil.index') }}">
                    <i class="fad fa-id-card"></i>
                    Profil
                </a>
            </li>
        </ul>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    {{ $slot }}
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        &copy; <script>document.write(new Date().getFullYear())</script> {{ $dataWebsite->footer }}
    </footer>

    <div class="control-sidebar-bg"></div>

    <x-password.modal>
        <div class="row">
            <div class="col-md-10 col-10">
                <div class="form-group">
                    <label class="form-label">Password Baru</label><br>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="col-md-2 col-2">
                <div class="form-group">
                    <label class="form-label">&nbsp;</label><br>
                    <button type="button" id="lihatPassword" class="btn btn-primary btn-sm btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Password">
                        <i class="fad fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-10">
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label><br>
                    <input type="password" class="form-control" id="confirm" name="confirm">
                </div>
            </div>
            <div class="col-md-2 col-2">
                <div class="form-group">
                    <label class="form-label">&nbsp;</label><br>
                    <button type="button" id="lihatPassword2" class="btn btn-primary btn-sm btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Password">
                        <i class="fad fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
    </x-password.modal>
</div>


	<!-- Vendor JS -->
    <script src="{{ asset('template/js/vendors.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>

	<!-- Rhythm Admin App -->
	<script src="{{ asset('template/js/jquery.smartmenus.js') }}"></script>
	<script src="{{ asset('template/js/menus.js') }}"></script>
    <script src="{{ asset('template/js/template.js') }}"></script>
    @stack('script')
    <script>
        // $('.select2').select2();
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

        function alertBayar(){
            $.toast({
                heading: 'SUKSES',
                text: 'Pembayaran Berhasil Dilakukan!!',
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

        $('#lihatPassword').click(function(){
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text');
                $('#lihatPassword').html('<i class="fad fa-eye-slash"></i>');
            }else{
                $('#password').attr('type', 'password');
                $('#lihatPassword').html('<i class="fad fa-eye"></i>');
            }
        });

        $('#lihatPassword2').click(function(){
            if($('#confirm').attr('type') == 'password'){
                $('#confirm').attr('type', 'text');
                $('#lihatPassword2').html('<i class="fad fa-eye-slash"></i>');
            }else{
                $('#confirm').attr('type', 'password');
                $('#lihatPassword2').html('<i class="fad fa-eye"></i>');
            }
        });

        $('body').on('click', '.gantiPassword', function () {
            var product_id = "{{ Auth::user()->id }}";
            $('#headerModal10').html("Ganti Password");
            $('#saveBtn10').val("edit-jenis");
            $('#modalGantiPassword').modal('show');
            $('#product_id10').val("{{ Auth::user()->id }}")
            $('#password').val("");
            $('#confirm').val("");
        });

        $('#saveBtn10').click(function (e) {
            e.preventDefault();
            $('#saveBtn10').prop('disabled', true)
            $(this).html('Simpan');

            $.ajax({
                data: $('#formInput10').serialize(),
                url: "{{ route('admin.pengguna.index') }}" + '/' + $('#product_id10').val(),
                type: "PUT",
                dataType: 'json',
                success: function (data) {
                    alertSucces()
                    $('#formInput10').trigger("reset");
                    $('#modalGantiPassword').modal('hide');
                    window.location.href = "{{ route('login') }}";
                },
                error: function (data) {
                    alertDanger()
                    $('#saveBtn10').html('Simpan');
                }
            });
            $('#saveBtn10').prop('disabled', false)
        });

        function alertBerhasil(text){
            $.toast({
                heading: 'Berhasil !!',
                text: text,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg:'#ff6849',
                position: 'top-right'
            })
        }
        function alertGagal(text){
            $.toast({
                heading: 'Gagal !!',
                text: text,
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#ff6849',
                position: 'top-right'
            })
        }
    </script>

</body>
</html>
