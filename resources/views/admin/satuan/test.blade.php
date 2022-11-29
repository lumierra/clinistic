<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="login form">
    <meta name="author" content="yoriadiatma">
    <link rel="icon" href="https://demo.sisfonet.com/app-klinikgigi/assets/img/favicon.png">
    <title>Odontogram - Sistem Klinik Gigi dan Odontogram</title>
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/css/font-css.css" rel="stylesheet">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/vendor/datatables/dataTables.bootstrap4.min.css"
        rel="stylesheet">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/css/toastr.min.css" rel="stylesheet">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/css/jquery-ui.css" rel="stylesheet">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/css/laporan/daterangepicker.css" rel="stylesheet">
    <link href="https://demo.sisfonet.com/app-klinikgigi/assets/css/custom-css.css?1619231998" rel="stylesheet">
</head>

<body id="page-top">
    <div align="center"><noscript>
            <div style="position:fixed;top:0;left:0;z-index:3000;height:100%;width:100%;background-color:#FFF">
                <div style="font-family:Arial;color:white;font-size:17px;background-color:blue;padding:11pt;">Mohon
                    aktifkan javascript pada browser untuk mengakses aplikasi ini!</div>
            </div>
        </noscript></div>
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"><a
                class="sidebar-brand d-flex align-items-center justify-content-center"
                href="https://demo.sisfonet.com/app-klinikgigi/dashboard.html">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-tooth"></i></div>
                <div class="sidebar-brand-text mx-3">Klinik Gigi</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active"><a class="nav-link"
                    href="https://demo.sisfonet.com/app-klinikgigi/dashboard.html"><i
                        class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <hr class="sidebar-divider">
            <li class="nav-item"><a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i
                        class="fas fa-fw fa-folder"></i><span>Master</span></a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/user.html">Data User</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/dokter.html">Data Dokter</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/supplier.html">Data Suplier</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/obatbarang.html">Data Obat/Barang</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i
                        class="fas fa-clinic-medical"></i><span>Klinik</span></a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/simbol.html">Simbol Odontogram</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/tindakan.html">Data Tindakan</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/pengeluaran.html">Biaya
                            Pengeluaran</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/master/piutang.html">Data Piutang</a></div>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link"
                    href="https://demo.sisfonet.com/app-klinikgigi/master/pasien.html"><i
                        class="fas fa-user-friends"></i><span>Pasien & Odontogram</span></a></li>
            <li class="nav-item"><a class="nav-link"
                    href="https://demo.sisfonet.com/app-klinikgigi/master/pembelian.html"><i
                        class="fas fa-shopping-cart"></i><span>Pembelian</span></a></li>
            <hr class="sidebar-divider">
            <li class="nav-item"><a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices"><i
                        class="fas fa-teeth-open"></i><span>Layanan</span></a>
                <div id="collapseServices" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/layanan/ambil-antrian.html">Ambil
                            Antrian</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/layanan/pemeriksaan.html">Pemeriksaan</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item"><a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan"><i
                        class="far fa-file-alt"></i><span>Laporan</span></a>
                <div id="collapseLaporan" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item" target="_blank"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/data-barang.html">Laporan Data
                            Barang</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/pembelian-pilih.html">Laporan
                            Pembelian</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/pengeluaran-pilih.html">Laporan
                            Pengeluaran</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/piutang-pilih.html">Laporan
                            Piutang</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/kunjungan-pilih.html">Laporan
                            Kunjungan</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/tindakan-pilih.html">Laporan
                            Tindakan</a><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/laporan/penjualan-pilih.html">Laporan
                            Penjualan</a></div>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseTools" aria-expanded="true" aria-controls="collapseTools"><i
                        class="fas fa-fw fa-cog"></i><span>Tools</span></a>
                <div id="collapseTools" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/tools/klinik.html">Identitas Klinik</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/tools/diskon.html">Diskon/Promo</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/tools/kartustok.html">Kartu Stok</a><a
                            class="collapse-item"
                            href="https://demo.sisfonet.com/app-klinikgigi/tools/stokmin.html">Stok Minimal</a></div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline"><button class="rounded-circle border-0" id="sidebarToggle"
                    title="Sidebar Toggle"></button></div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"><button
                        id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i
                            class="fa fa-bars"></i></button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="https://demo.sisfonet.com/app-klinikgigi/master/search-data-pasien" method="get">
                        <div class="input-group"><input type="text" class="form-control bg-light border-0 small"
                                title="Nama Pasien" placeholder="Cari nama pasien..." name="que" aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append"><button class="btn btn-primary" type="submit"><i
                                        class="fas fa-search fa-sm"></i></button></div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none"><a class="nav-link dropdown-toggle" href="#"
                                id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="fas fa-search fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search"
                                    action="https://demo.sisfonet.com/app-klinikgigi/master/search-data-pasien"
                                    method="get">
                                    <div class="input-group"><input type="text"
                                            class="form-control bg-light border-0 small" title="Nama Pasien"
                                            placeholder="Cari nama pasien..." name="que" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append"><button class="btn btn-primary" type="button"><i
                                                    class="fas fa-search fa-sm"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="pt-4 tanggal-header"><span>Sabtu, 08 Oktober 2022</span></div>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow"><a class="nav-link dropdown-toggle" href="#"
                                id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span><img
                                    class="img-profile rounded-circle"
                                    src="https://demo.sisfonet.com/app-klinikgigi/assets/img/profile-pict.png"></a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown"><a class="dropdown-item"
                                    href="https://demo.sisfonet.com/app-klinikgigi/welcome/logout"><i
                                        class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</a></div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="d-inline m-0 font-weight-bold text-primary"><a
                                            href="https://demo.sisfonet.com/app-klinikgigi/master/pasien.html">Odontogram</a>
                                        P000057 / Azka <span class="float-right"><a
                                                href="https://demo.sisfonet.com/app-klinikgigi/medis/pemeriksaan-fisik/UDAwMDA1Nw=="
                                                class="btn btn-sm btn-success">Pemeriksaan Fisik</a> <a target="_blank"
                                                href="https://demo.sisfonet.com/app-klinikgigi/medis/cetakodonto/P000057"
                                                class="btn btn-sm btn-danger">Cetak</a></span></h6>
                                </div>
                                <div class="card-body" style="overflow-x:auto;">
                                    <script src="https://demo.sisfonet.com/app-klinikgigi/assets/odonto/jquery-jr.js">
                                    </script>
                                    <script src="https://demo.sisfonet.com/app-klinikgigi/assets/odonto/jquery.min.js">
                                    </script>
                                    <script src="https://demo.sisfonet.com/app-klinikgigi/assets/odonto/jquery.js">
                                    </script>
                                    <table width="100%" style="overflow-x:auto;">
                                        <tr>
                                            <td>
                                                <div id="svgselect" style="width:710px;height:300px;"><svg version="1.1"
                                                        height="100%" width="100%"
                                                        style="padding-left:10px;padding-right:10px">
                                                        <g transform="scale(1.7)" id="gmain">
                                                            <g id="18" transform="translate(0,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="LightCyan"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="LightCyan" stroke="navy" stroke-width="0.5"
                                                                    id="B" opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="LightCyan" stroke="navy" stroke-width="0.5"
                                                                    id="R" opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="LightCyan"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">18</text>
                                                            </g>
                                                            <g id="17" transform="translate(25,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">17</text>
                                                            </g>
                                                            <g id="16" transform="translate(50,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">16</text>
                                                            </g>
                                                            <g id="15" transform="translate(75,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">15</text>
                                                            </g>
                                                            <g id="14" transform="translate(100,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">14</text>
                                                            </g>
                                                            <g id="13" transform="translate(125,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">13</text>
                                                            </g>
                                                            <g id="12" transform="translate(150,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">12</text>
                                                            </g>
                                                            <g id="11" transform="translate(175,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">11</text>
                                                            </g>
                                                            <g id="55" transform="translate(75,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">55</text>
                                                            </g>
                                                            <g id="54" transform="translate(100,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">54</text>
                                                            </g>
                                                            <g id="53" transform="translate(125,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">53</text>
                                                            </g>
                                                            <g id="52" transform="translate(150,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">52</text>
                                                            </g>
                                                            <g id="51" transform="translate(175,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">51</text>
                                                            </g>
                                                            <g id="85" transform="translate(75,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">85</text>
                                                            </g>
                                                            <g id="84" transform="translate(100,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">84</text>
                                                            </g>
                                                            <g id="83" transform="translate(125,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Coral"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Coral"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Coral" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Coral" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Coral"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">83</text>
                                                            </g>
                                                            <g id="82" transform="translate(150,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">82</text>
                                                            </g>
                                                            <g id="81" transform="translate(175,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">81</text>
                                                            </g>
                                                            <g id="48" transform="translate(0,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">48</text>
                                                            </g>
                                                            <g id="47" transform="translate(25,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">47</text>
                                                            </g>
                                                            <g id="46" transform="translate(50,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">46</text>
                                                            </g>
                                                            <g id="45" transform="translate(75,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">45</text>
                                                            </g>
                                                            <g id="44" transform="translate(100,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">44</text>
                                                            </g>
                                                            <g id="43" transform="translate(125,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">43</text>
                                                            </g>
                                                            <g id="42" transform="translate(150,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">42</text>
                                                            </g>
                                                            <g id="41" transform="translate(175,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">41</text>
                                                            </g>
                                                            <g id="21" transform="translate(210,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">21</text>
                                                            </g>
                                                            <g id="22" transform="translate(235,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">22</text>
                                                            </g>
                                                            <g id="23" transform="translate(260,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">23</text>
                                                            </g>
                                                            <g id="24" transform="translate(285,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">24</text>
                                                            </g>
                                                            <g id="25" transform="translate(310,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">25</text>
                                                            </g>
                                                            <g id="26" transform="translate(335,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">26</text>
                                                            </g>
                                                            <g id="27" transform="translate(360,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">27</text>
                                                            </g>
                                                            <g id="28" transform="translate(385,0)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">28</text>
                                                            </g>
                                                            <g id="61" transform="translate(210,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">61</text>
                                                            </g>
                                                            <g id="62" transform="translate(235,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">62</text>
                                                            </g>
                                                            <g id="63" transform="translate(260,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">63</text>
                                                            </g>
                                                            <g id="64" transform="translate(285,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">64</text>
                                                            </g>
                                                            <g id="65" transform="translate(310,40)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">65</text>
                                                            </g>
                                                            <g id="71" transform="translate(210,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">71</text>
                                                            </g>
                                                            <g id="72" transform="translate(235,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">72</text>
                                                            </g>
                                                            <g id="73" transform="translate(260,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">73</text>
                                                            </g>
                                                            <g id="74" transform="translate(285,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">74</text>
                                                            </g>
                                                            <g id="75" transform="translate(310,80)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">75</text>
                                                            </g>
                                                            <g id="31" transform="translate(210,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">31</text>
                                                            </g>
                                                            <g id="32" transform="translate(235,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">32</text>
                                                            </g>
                                                            <g id="33" transform="translate(260,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">33</text>
                                                            </g>
                                                            <g id="34" transform="translate(285,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">34</text>
                                                            </g>
                                                            <g id="35" transform="translate(310,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">35</text>
                                                            </g>
                                                            <g id="36" transform="translate(335,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">36</text>
                                                            </g>
                                                            <g id="37" transform="translate(360,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">37</text>
                                                            </g>
                                                            <g id="38" transform="translate(385,120)">
                                                                <polygon points="5,5  15,5  15,15   5,15" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="C" opacity="1">
                                                                </polygon>
                                                                <polygon points="0,0  20,0  15,5  5,5" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="T" opacity="1">
                                                                </polygon>
                                                                <polygon points="5,15   15,15   20,20   0,20"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="B"
                                                                    opacity="1"></polygon>
                                                                <polygon points="15,5   20,0  20,20   15,15"
                                                                    fill="Ivory" stroke="navy" stroke-width="0.5" id="R"
                                                                    opacity="1"></polygon>
                                                                <polygon points="0,0  5,5   5,15  0,20" fill="Ivory"
                                                                    stroke="navy" stroke-width="0.5" id="L" opacity="1">
                                                                </polygon><text x="6" y="30" stroke="navy" fill="navy"
                                                                    stroke-width="0.1"
                                                                    style="font-size:6pt;font-weight:normal">38</text>
                                                            </g>
                                                        </g>
                                                    </svg></div><br><span>Gigi <span id="kposisi"></span>
                                                    :</span><br><span id="kondisi-gigi">--</span>
                                            </td>
                                            <td style="width:20%;padding-left:10px"><span class="gigi">Posisi Gigi
                                                    :</span> <br><span id="nomorgigi">XX</span><span
                                                    class="gigi">-</span><span id="posisigigi">X</span><br></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card shadow mb-4"><a href="#collapseOdonto" class="d-block card-header py-3"
                                    data-toggle="collapse" role="button" aria-expanded="true"
                                    aria-controls="collapseOdonto">
                                    <h6 class="m-0 font-weight-bold text-primary">Keterangan Tambahan</h6>
                                </a>
                                <div class="collapse show" id="collapseOdonto">
                                    <div class="card-body">
                                        <form target="blank"
                                            action="https://demo.sisfonet.com/app-klinikgigi/medis/simpanketodonto"
                                            method="post"><input type="hidden" name="idpasien" value="P000057">
                                            <div class="form-group row"><label for="occlusi"
                                                    class="col-lg-3 col-form-label">Occlusi</label>
                                                <div class="col-lg-4"><select name="occlusi" id="occlusi"
                                                        class="form-control">
                                                        <option selected value="">Pilih</option>
                                                        <option value="Normal Bite">Normal Bite</option>
                                                        <option value="Cross Bite">Cross Bite</option>
                                                        <option value="Steep Bite">Steep Bite</option>
                                                    </select></div>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="ket_occlusi" id="ket_occlusi"></div>
                                            </div>
                                            <div class="form-group row"><label for="t_palatinus"
                                                    class="col-lg-3 col-form-label">Torus Palatinus</label>
                                                <div class="col-lg-4"><select name="t_palatinus" id="t_palatinus"
                                                        class="form-control">
                                                        <option selected value="">Pilih</option>
                                                        <option value="Tidak Ada">Tidak Ada</option>
                                                        <option value="Kecil">Kecil</option>
                                                        <option value="Sedang">Sedang</option>
                                                        <option value="Besar">Besar</option>
                                                        <option value="Multiple">Multiple</option>
                                                    </select></div>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="ket_tp" id="ket_tp"></div>
                                            </div>
                                            <div class="form-group row"><label for="t_mandibularis"
                                                    class="col-lg-3 col-form-label">Torus Mandibularis</label>
                                                <div class="col-lg-4"><select name="t_mandibularis" id="t_mandibularis"
                                                        class="form-control">
                                                        <option selected value="">Pilih</option>
                                                        <option value="Tidak Ada">Tidak Ada</option>
                                                        <option value="Sisi kiri">Sisi kiri</option>
                                                        <option value="Sisi kanan">Sisi kanan</option>
                                                        <option value="Kedua sisi">Kedua sisi</option>
                                                    </select></div>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="ket_tm" id="ket_tm"></div>
                                            </div>
                                            <div class="form-group row"><label for="palatum"
                                                    class="col-lg-3 col-form-label">Palatum</label>
                                                <div class="col-lg-4"><select name="palatum" id="palatum"
                                                        class="form-control">
                                                        <option selected value="">Pilih</option>
                                                        <option value="Dalam">Dalam</option>
                                                        <option value="Sedang">Sedang</option>
                                                        <option value="Rendah">Rendah</option>
                                                    </select></div>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="ket_palatum" id="ket_palatum"></div>
                                            </div>
                                            <div class="form-group row"><label for="diastema"
                                                    class="col-lg-3 col-form-label">Diastema</label>
                                                <div class="col-lg-4"><select name="diastema" id="diastema"
                                                        class="form-control">
                                                        <option selected value="">Pilih</option>
                                                        <option value="Tidak Ada">Tidak Ada</option>
                                                        <option value="Ada">Ada</option>
                                                    </select></div>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="ket_diastema" id="ket_diastema"></div>
                                            </div>
                                            <div class="form-group row"><label for="anomali"
                                                    class="col-lg-3 col-form-label">Gigi Anomali</label>
                                                <div class="col-lg-4"><select name="anomali" id="anomali"
                                                        class="form-control">
                                                        <option selected value="">Pilih</option>
                                                        <option value="Tidak Ada">Tidak Ada</option>
                                                        <option value="Ada">Ada</option>
                                                    </select></div>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="ket_anomali" id="ket_anomali"></div>
                                            </div>
                                            <div class="form-group row"><label for="lain"
                                                    class="col-lg-3 col-form-label">Lain-lain</label>
                                                <div class="col-lg-4"><input type="text" class="form-control" value=""
                                                        name="lain" id="lain"></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-10"><button type="submit" name="simpan"
                                                        class="btn btn-primary">Simpan & Cetak Odontogram</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="d-inline m-0 font-weight-bold text-primary">Riwayat Pemeriksaan <span
                                            class="float-right"><a target="_blank"
                                                href="https://demo.sisfonet.com/app-klinikgigi/medis/tabel-rawatan/P000057"
                                                class="btn btn-sm btn-danger">Cetak Riwayat</a></span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tabelRiwayat" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Gigi</th>
                                                    <th>Kondisi</th>
                                                    <th>Anamnesa</th>
                                                    <th>Tindakan</th>
                                                    <th>Pemeriksa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>04 Oktober 2022</td>
                                                    <td>18-ALL</td>
                                                    <td><span style="background-color:Indigo">&nbsp; &nbsp;&nbsp;</span>
                                                        gigi tidak ada, tidak diketahui ada atau tidak ada. (non)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>Administrator</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>04 Oktober 2022</td>
                                                    <td>83-ALL</td>
                                                    <td><span style="background-color:Coral">&nbsp; &nbsp;&nbsp;</span>
                                                        Missing teeth (mis)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>Administrator</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>04 Oktober 2022</td>
                                                    <td>18-ALL</td>
                                                    <td><span style="background-color:LightCyan">&nbsp;
                                                            &nbsp;&nbsp;</span> Normal (TAK)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>Administrator</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>04 Oktober 2022</td>
                                                    <td>18-C</td>
                                                    <td><span style="background-color:Ivory">&nbsp; &nbsp;&nbsp;</span>
                                                        Normal/ baik (sou)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>Administrator</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto"><span>Copyright &copy; 2022 Sistem Klinik Gigi dan
                                Odontogram</span></div>
                    </div>
                </footer>
                <div class="flash-sukses" data-flashdata=""></div>
                <div class="flash-error" data-flashdata=""></div>
                <div class="flash-warning" data-flashdata=""></div>
                <div class="flash-info" data-flashdata=""></div>
                <div class="base-url" data-url="https://demo.sisfonet.com/app-klinikgigi/"></div>
                <div class="id-pasien" data-id="P000057"></div>
            </div>
        </div><a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/vendor/bootstrap/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/vendor/jquery-easing/jquery.easing.min.js">
        </script>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/js/sb-admin-2.min.js"></script>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/vendor/datatables/jquery.dataTables.min.js">
        </script>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/vendor/datatables/dataTables.bootstrap4.min.js">
        </script>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/js/toastr.min.js"></script>
        <script src="https://demo.sisfonet.com/app-klinikgigi/assets/script/script-utility-odon.js?1620013024"></script>
        <script>
            eval(function (p, a, c, k, e, d) {
                e = function (c) {
                    return c
                };
                if (!''.replace(/^/, String)) {
                    while (c--) {
                        d[c] = k[c] || c
                    }
                    k = [function (e) {
                        return d[e]
                    }];
                    e = function () {
                        return '\\w+'
                    };
                    c = 1
                };
                while (c--) {
                    if (k[c]) {
                        p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])
                    }
                }
                return p
            }('$(8).7(6(){$(\'#5\').4({"3":2,"1":0})});', 9, 9,
                '25|iDisplayLength|false|ordering|DataTable|tabelRiwayat|function|ready|document'.split('|'),
                0, {}))

        </script>
</body>

</html>
