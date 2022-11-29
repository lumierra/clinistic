<ul class="menu">
    <li class="{{ request()->routeIs('home*') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="">Beranda</a>
    </li>
    {{-- <li><a href="about.html">About</a></li>
    <li class="dropdown">
        <a href="#">Department</a>
        <ul class="dropdown-menu">
            <li><a href="department.html">Department</a></li>
            <li><a href="department-details.html">Department Details</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#">Doctor</a>
        <ul class="dropdown-menu">
            <li><a href="doctor.html">Doctor</a></li>
            <li><a href="doctor-details.html">Doctor Details</a></li>
        </ul>
    </li>
    <li><a href="appointment.html">Appointment</a></li> --}}


    {{-- <li class="megamenu">
        <a href="#">Pages</a>
        <div class="megamenu-content">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <ul class="list-group">
                        <li><a href="faqs.html"><i class="ti-arrow-circle-right me-10"></i>FAQs</a></li>
                        <li><a href="inovice.html"><i class="ti-arrow-circle-right me-10"></i>Invoice</a></li>
                        <li><a href="membership.html"><i class="ti-arrow-circle-right me-10"></i>Membership</a></li>
                        <li><a href="doctor.html"><i class="ti-arrow-circle-right me-10"></i>Staff</a></li>
                        <li><a href="testimonial.html"><i class="ti-arrow-circle-right me-10"></i>Testimonial</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <ul class="list-group">
                        <li><a href="typography.html"><i class="ti-arrow-circle-right me-10"></i>Typography</a></li>
                        <li><a href="about.html"><i class="ti-arrow-circle-right me-10"></i>About</a></li>
                        <li><a href="contact_us.html"><i class="ti-arrow-circle-right me-10"></i>Contact</a></li>
                        <li><a href="doctor.html"><i class="ti-arrow-circle-right me-10"></i>Doctor</a></li>
                        <li><a href="doctor-details.html"><i class="ti-arrow-circle-right me-10"></i>Doctor Details</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <ul class="list-group">
                        <li><a href="register.html"><i class="ti-arrow-circle-right me-10"></i>Register</a></li>
                        <li><a href="login.html"><i class="ti-arrow-circle-right me-10"></i>Login</a></li>
                        <li><a href="register_login.html"><i class="ti-arrow-circle-right me-10"></i>Register & Login</a></li>
                        <li><a href="forgot_pass.html"><i class="ti-arrow-circle-right me-10"></i>Forgot Password</a></li>
                        <li><a href="lockscreen.html"><i class="ti-arrow-circle-right me-10"></i>Lock Screen</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <ul class="list-group">
                        <li><a href="department.html"><i class="ti-arrow-circle-right me-10"></i>Department</a></li>
                        <li><a href="department-details.html"><i class="ti-arrow-circle-right me-10"></i>Department Details</a></li>
                        <li><a href="maintenance.html"><i class="ti-arrow-circle-right me-10"></i>Under Constructions</a></li>
                        <li><a href="404.html"><i class="ti-arrow-circle-right me-10"></i>404</a></li>
                        <li><a href="500.html"><i class="ti-arrow-circle-right me-10"></i>500</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li> --}}
    {{-- <li class="dropdown">
        <a href="#">Berita</a>
        <ul class="dropdown-menu">
            <li class="dropdown">
                <a href="#">Grid Blog</a>
                <ul class="dropdown-menu">
                    <li><a href="blog_grid_2.html">Grid 2 colunm</a></li>
                    <li><a href="blog_grid_3.html">Grid 3 colunm</a></li>
                    <li><a href="blog_grid_left_sidebar.html">blog left sidebar</a></li>
                    <li><a href="blog_grid_right_sidebar.html">blog right sidebar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">List Blog</a>
                <ul class="dropdown-menu">
                    <li><a href="blog_list.html">Blog List</a></li>
                    <li><a href="blog_list_left_sidebar.html">Blog List Left Sidebar</a></li>
                    <li><a href="blog_list_right_sidebar.html">Blog List right Sidebar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Single Blog Post</a>
                <ul class="dropdown-menu">
                    <li><a href="blog_single_grid_post.html">Single Grid Post</a></li>
                    <li><a href="blog_single_html5video_post.html">Single html5 Video-post</a></li>
                    <li><a href="blog_single_image_post.html">Single Image Post</a></li>
                    <li><a href="blog_single_slider_post.html">Single Slider Post</a></li>
                    <li><a href="blog_single_soundcloud_post.html">Single SoundCloud Post</a></li>
                    <li><a href="blog_single_vimeo_post.html">Single Vimeo Post</a></li>
                    <li><a href="blog_single_post.html">Single without image post</a></li>
                    <li><a href="blog_single_youtube_post.html">Single Youtube Post</a></li>
                </ul>
            </li>
        </ul>
    </li> --}}

    <li class="dropdown">
        <a href="#">Profil</a>
        <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('so*') ? 'active' : '' }}"><a href="{{ route('so.index') }}">Struktur Organisasi</a></li>
            <li class="{{ request()->routeIs('video*') ? 'active' : '' }}"><a href="{{ route('video.index') }}">Visi Dan Misi</a></li>
            <li class="{{ request()->routeIs('video*') ? 'active' : '' }}"><a href="{{ route('video.index') }}">Tentang Kami</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#">Informasi</a>
        <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('news*') ? 'active' : '' }}"><a href="{{ route('news.index') }}">Berita</a></li>
            <li class="{{ request()->routeIs('video*') ? 'active' : '' }}"><a href="{{ route('video.index') }}">Berita Video</a></li>
            <li class="{{ request()->routeIs('file*') ? 'active' : '' }}"><a href="{{ route('file.index') }}">File Download</a></li>
        </ul>
    </li>
    <li class="{{ request()->routeIs('contact*') ? 'active' : '' }}">
        <a href="{{ route('contact.index') }}">Kontak</a>
    </li>
</ul>
