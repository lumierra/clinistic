<ul class="sidebar-menu" data-widget="tree">
    <li class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard.index') }}" class="ps-2">
            <i class="fas fa-house-flood fs-5"></i>
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('home') }}" class="ps-2" target="_blank">
            <i class="fas fa-house-user fs-5"></i>
            Beranda
        </a>
    </li>
    {{-- <li class="{{ request()->routeIs('admin.website*') ? 'active' : '' }}">
        <a href="{{ route('admin.website.index') }}" class="ps-2">
            <i class="fas fa-address-card fs-5"></i>
            Website
        </a>
    </li> --}}

    <li class="treeview">
        <a href="#" class="ps-2">
            <i class="fas fa-users-cog fs-5"></i>
            Master Pengguna
            <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->routeIs('admin.pengguna*') ? 'active' : '' }}"><a href="{{ route('admin.pengguna.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pengguna</a></li>
            <li class="{{ request()->routeIs('admin.roles*') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Hak Akses</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="ps-2">
            <i class="fab fa-mendeley fs-5"></i>
            Menu Utama
            <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->routeIs('admin.website*') ? 'active' : '' }}">
                <a href="{{ route('admin.website.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Website
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.banner*') ? 'active' : '' }}">
                <a href="{{ route('admin.banner.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Banner
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.template*') ? 'active' : '' }}">
                <a href="{{ route('admin.template.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Template Warna
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="ps-2">
            <i class="fas fa-user-tie fs-5"></i>
            Menu Pegawai
            <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->routeIs('admin.divisi*') ? 'active' : '' }}">
                <a href="{{ route('admin.divisi.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bidang
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.pejabat*') ? 'active' : '' }}">
                <a href="{{ route('admin.pejabat.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pejabat
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.anggota*') ? 'active' : '' }}">
                <a href="{{ route('admin.anggota.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Anggota
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.struktur*') ? 'active' : '' }}">
                <a href="{{ route('admin.struktur.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Struktur Organisasi
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.visi*') ? 'active' : '' }}">
                <a href="{{ route('admin.visi.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Visi & Misi
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="ps-2">
            <i class="fas fa-newspaper fs-5"></i>
            Master Berita
            <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->routeIs('admin.kategori-berita*') ? 'active' : '' }}"><a href="{{ route('admin.kategori-berita.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kategori Berita</a></li>
            <li class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"><a href="{{ route('admin.berita.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Berita</a></li>
            <li class="{{ request()->routeIs('admin.berita-video*') ? 'active' : '' }}">
                <a href="{{ route('admin.berita-video.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Berita Video
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="ps-2">
            <i class="fas fa-pager fs-5"></i>
            Master Interaksi
            <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->routeIs('admin.agenda*') ? 'active' : '' }}">
                <a href="{{ route('admin.agenda.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agenda
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                <a href="{{ route('admin.pengumuman.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> Pengumuman
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.notice*') ? 'active' : '' }}">
                <a href="{{ route('admin.notice.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> Notice
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.infografis*') ? 'active' : '' }}">
                <a href="{{ route('admin.infografis.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> Infografis
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.dokumen*') ? 'active' : '' }}">
                <a href="{{ route('admin.dokumen.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> Dokumen
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.kontak-masuk*') ? 'active' : '' }}">
                <a href="{{ route('admin.kontak-masuk.index') }}">
                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> Kontak Masuk
                </a>
            </li>
        </ul>
    </li>

    {{-- <li class="{{ request()->routeIs('admin.banner*') ? 'active' : '' }}">
        <a href="{{ route('admin.banner.index') }}" class="ps-2">
            <i class="fas fa-presentation fs-5"></i>
            Banner
        </a>
    </li> --}}
    {{-- <li class="{{ request()->routeIs('admin.banner*') ? 'active' : '' }}">
        <a href="{{ route('admin.banner.index') }}" class="ps-2">
            <i class="fas fa-presentation fs-5"></i>
            Banner
        </a>
    </li> --}}



    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="ps-2">
            <i class="fas fa-sign-out-alt fs-5"></i>
            Logout
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </a>
    </li>

    {{-- <li class="treeview">
        <a href="#">
            <i data-feather="monitor"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="index.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 1</a></li>
            <li><a href="index2.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 2</a></li>
            <li><a href="index3.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 3</a></li>
            <li><a href="index4.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 4</a></li>
        </ul>
    </li>
    <li>
        <a href="appointments.html">
            <i data-feather="calendar"></i>
            <span>Appointments</span>
        </a>
    </li> --}}
</ul>
