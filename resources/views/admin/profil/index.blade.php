@section('title', 'Profil')

<x-layouts>
    @push('style')
        <style>
            .form-control {
                color: #000 !important;
            }
        </style>
    @endpush

    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Profil Penggunna <i class="fas fa-id-card fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
                    </div>
                </div>
            </div>

            <section class="content">

                <div class="row">
                    <div class="col-12 col-lg-5 col-xl-4" id="profilRight">
                        <div class="box box-widget widget-user">
                            <div class="widget-user-header bg-img bbsr-0 bber-0" style="background: url({{ asset('images/dokter-success.png') }}) center center;" data-overlay="5">
                                <h3 class="widget-user-username text-white">{{ Str::ucfirst($profil->name) }}</h3>
                                <h6 class="widget-user-desc text-white">{{ Str::ucfirst($profil->role->name) }}</h6>
                            </div>
                            <div class="widget-user-image">
                                @if ($profil->foto == '')
                                    @if ($profil->gender != null)
                                        @if ($profil->gender->jenis_kelamin == 'Laki-laki')
                                            <img class="rounded-circle" src="{{ asset('images/user_male.webp') }}" alt="Foto {{ $profil->name }}">
                                        @else
                                            <img class="rounded-circle" src="{{ asset('images/user_female.webp') }}" alt="Foto {{ $profil->name }}">
                                            @endif
                                    @else
                                        <img class="rounded-circle" src="{{ asset('images/user_male.webp') }}" alt="Foto {{ $profil->name }}">
                                    @endif
                                @else
                                    <img class="rounded-circle" src="{{ asset($profil->foto) }}" alt="Foto {{ $profil->name }}">
                                @endif
                            </div>
                            <div class="box-footer">
                            {{-- <div class="row">
                                <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">12K</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 be-1 bs-1">
                                <div class="description-block">
                                    <h5 class="description-header">550</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">158</h5>
                                    <span class="description-text">TWEETS</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div> --}}
                            <!-- /.row -->
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-10">
                                            <table class="text-gray">
                                                <tr>
                                                    <td width="70">Email</td>
                                                    <td width="10">:</td>
                                                    <td>{{ $profil->email ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>JK</td>
                                                    <td>:</td>
                                                    <td>
                                                        @if ($profil->gender != null)
                                                            {{ $profil->gender->jenis_kelamin }}
                                                            {!! $profil->gender->jenis_kelamin == 'Laki-laki' ? '<i class="fal fa-mars text-info"></i>' : '<i class="fal fa-venus text-danger"></i>' !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TTL</td>
                                                    <td>:</td>
                                                    <td>{{ Str::ucfirst($profil->tempat_lahir) }}, {{ date('d-m-Y', strtotime($profil->tgl_lahir)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>No. HP</td>
                                                    <td>:</td>
                                                    <td>{{ $profil->phone ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>{{ $profil->alamat ?? '' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="pb-15">
                                            <p class="mb-10">Media Sosial</p>
                                            <div class="user-social-acount">
                                                <a href="https://facebook.com/{{ $profil->facebook ?? '#' }}" target="_blank" class="btn btn-circle btn-social-icon btn-facebook"><img src="{{ asset('images/facebook.svg') }}" width="15" class="text-white"></a>
                                                <a href="https://instagram.com/{{ $profil->instagram ?? '#' }}" target="_blank" class="btn btn-circle btn-social-icon btn-instagram"><img src="{{ asset('images/instagram.svg') }}" width="20" class="text-white"></a>
                                                <a href="https://twitter.com/{{ $profil->twitter ?? '#' }}" target="_blank" class="btn btn-circle btn-social-icon btn-twitter"><img src="{{ asset('images/twitter.svg') }}" width="20" class="text-white"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <div class="map-box">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15914.934987970788!2d98.0580425!3d4.2719008!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe21949ccacf34875!2sKlinik%20Abah!5e0!3m2!1sid!2sid!4v1669344013344!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329" width="100%" height="100" frameborder="0" style="border:0" allowfullscreen></iframe> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="box box-inverse" style="background-color: #3b5998">
                            <div class="box-header no-border">
                                <span class="fa fa-facebook fs-30"></span>
                                <div class="box-tools pull-right">
                                    <h5 class="box-title">Facebook feed</h5>
                                </div>
                            </div>

                            <blockquote class="blockquote blockquote-inverse no-border m-0 py-15">
                                <p>Holisticly benchmark plug imperatives for multifunctional deliverables. Seamlessly incubate cross functional action.</p>
                                <div class="flexbox">
                                <time class="text-white" datetime="2017-11-21 20:00">21 November, 2021</time>
                                <span><i class="fa fa-heart"></i> 75</span>
                                </div>
                            </blockquote>
                        </div> --}}
                    </div>
                    <div class="col-12 col-lg-7 col-xl-8">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li><a class="active" href="#settings" data-bs-toggle="tab">Identitas</a></li>
                                <li><a class="" href="#medsos" data-bs-toggle="tab">Medsos</a></li>
                                <li><a class="" href="#gantipassword" data-bs-toggle="tab">Password</a></li>
                                {{-- <li><a href="#usertimeline" data-bs-toggle="tab">Timeline</a></li> --}}
                                {{-- <li><a class="" href="#activity" data-bs-toggle="tab">Activity</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <div class="box no-shadow">
                                        <form class="form-horizontal form-element col-12" id="formInput" enctype="multipart/form-data">
                                            <input type="hidden" id="status" name="status" value="identitas">
                                            <input type="hidden" id="user" name="user" value="{{ $profil->id }}">
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 form-label">Nama Lengkap</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $profil->name ?? '' }}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $profil->email ?? '' }}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 form-label">No. HP</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $profil->phone ?? '' }}" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tempat_lahir" class="col-sm-2 form-label">Tempat Lahir</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $profil->tempat_lahir ?? '' }}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal_lahir" class="col-sm-2 form-label">Tanggal Lahir</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $profil->tgl_lahir ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="alamat" class="col-sm-2 form-label">Alamat</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $profil->alamat ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="gender" class="col-sm-2 form-label">Jenis Kelamin</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" id="gender" name="gender">
                                                        @foreach ($gender as $item)
                                                            <option value="{{ $item->id }}" {{ $profil->gender_id == $item->id ? 'selected' : '' }}>{{ $item->jenis_kelamin }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="photo" class="col-sm-2 form-label">Foto</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="ms-auto col-sm-10">
                                                    <button type="button" id="btn-simpan" class="btn btn-success"><i class="fal fa-floppy-disk"></i> Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="medsos">
                                    <div class="box no-shadow">
                                        <form class="form-horizontal form-element col-12" id="formInputMedsos">
                                            <input type="hidden" id="status" name="status" value="medsos">
                                            <input type="hidden" id="user" name="user" value="{{ $profil->id }}">
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 form-label">Facebook</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $profil->facebook ?? '' }}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 form-label">Instagram</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $profil->instagram ?? '' }}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 form-label">Twitter</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $profil->twitter ?? '' }}" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="ms-auto col-sm-10">
                                                    <button type="button" id="btn-simpan-medsos" class="btn btn-success"><i class="fal fa-floppy-disk"></i> Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="gantipassword">
                                    <div class="box no-shadow">
                                        <form class="form-horizontal form-element col-12" id="formInputPassword">
                                            <input type="hidden" id="status" name="status" value="password">
                                            <input type="hidden" id="user" name="user" value="{{ $profil->id }}">
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 form-label">Password Baru</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="password_baru" name="password_baru" autocomplete="off">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" id="lihat_password_baru" class="btn btn-primary btn-sm btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Password">
                                                        <i class="fad fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 form-label">Konfirmasi Password Baru</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="konfir_password" name="konfir_password" autocomplete="off">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" id="lihat_konfir_password" class="btn btn-primary btn-sm btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Password">
                                                        <i class="fad fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="ms-auto col-sm-10">
                                                    <button type="button" id="btn-simpan-password" class="btn btn-success"><i class="fal fa-floppy-disk"></i> Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- <div class="tab-pane" id="usertimeline">
                                    <div class="publisher publisher-multi bg-white b-1 mb-30">
                                    <textarea class="publisher-input auto-expand" rows="4" placeholder="Write something"></textarea>
                                    <div class="flexbox">
                                        <div class="gap-items">
                                        <span class="publisher-btn file-group">
                                            <i class="fa fa-image file-browser"></i>
                                            <input type="file">
                                        </span>
                                        <a class="publisher-btn" href="#"><i class="fa fa-map-marker"></i></a>
                                        <a class="publisher-btn" href="#"><i class="fa fa-smile-o"></i></a>
                                        </div>

                                        <button class="btn btn-sm btn-bold btn-primary">Post</button>
                                    </div>
                                    </div>

                                    <div class="box b-1 no-shadow">
                                    <div class="media bb-1 border-fade">
                                        <img class="avatar avatar-lg" src="../images/avatar/3.jpg" alt="...">
                                        <div class="media-body">
                                        <p>
                                            <strong>Denial Webar</strong>
                                            <time class="float-end text-fade" datetime="2017">24 min ago</time>
                                        </p>
                                        <p><small>Designer</small></p>
                                        </div>
                                    </div>

                                    <div class="box-body bb-1 border-fade">
                                        <p class="lead">Authoritatively syndicate goal-oriented leadership skills for clicks-and-mortar outsourcing. Synergistically reconceptualize enabled catalysts for change.</p>

                                        <div class="gap-items-4 mt-10">
                                        <a class="text-fade hover-light" href="#">
                                            <i class="fa fa-thumbs-up me-1"></i> 1254
                                        </a>
                                        <a class="text-fade hover-light" href="#">
                                            <i class="fa fa-comment me-1"></i> 25
                                        </a>
                                        <a class="text-fade hover-light" href="#">
                                            <i class="fa fa-share-alt me-1"></i> 12
                                        </a>
                                        </div>
                                    </div>


                                    <div class="media-list media-list-divided bg-lighter">
                                        <div class="media">
                                        <a class="avatar" href="#">
                                            <img src="../images/avatar/6.jpg" alt="...">
                                        </a>
                                        <div class="media-body">
                                            <p>
                                            <a href="#"><strong>Rock Tele</strong></a>
                                            <time class="float-end text-fade" datetime="2017-07-14 20:00">Just now</time>
                                            </p>
                                            <p>Uniquely enhance world-class channels with just in time schemas.</p>

                                            <div class="media px-0 mt-20">
                                            <a class="avatar" href="#">
                                                <img src="../images/avatar/8.jpg" alt="...">
                                            </a>
                                            <div class="media-body">
                                                <p>
                                                <a href="#"><strong>Brock Lensar</strong></a>
                                                <time class="float-end text-fade" datetime="2017-07-14 20:00">26 mins ago</time>
                                                </p>
                                                <p>Thank you for your nice comment.</p>
                                            </div>
                                            </div>

                                        </div>
                                        </div>

                                        <div class="media">
                                        <a class="avatar" href="#">
                                            <img src="../images/avatar/9.jpg" alt="...">
                                        </a>
                                        <div class="media-body">
                                            <p>
                                            <a href="#"><strong>Tony Stark</strong></a>
                                            <time class="float-end text-fade" datetime="2017-07-14 20:00">2 hours ago</time>
                                            </p>
                                            <p>Continually drive user friendly solutions through performance based infomediaries.</p>
                                        </div>
                                        </div>
                                    </div>

                                    <form class="publisher bt-1 border-fade">
                                        <img class="avatar avatar-sm" src="../images/avatar/4.jpg" alt="...">
                                        <input class="publisher-input" type="text" placeholder="Add Your Comment">
                                        <a class="publisher-btn" href="#"><i class="fa fa-smile-o"></i></a>
                                        <span class="publisher-btn file-group">
                                        <i class="fa fa-camera file-browser"></i>
                                        <input type="file">
                                        </span>
                                    </form>

                                    </div>


                                    <div class="box p-15">
                                        <div class="timeline timeline-single-column timeline-single-full-column">

                                            <span class="timeline-label">
                                                <span class="badge badge-info badge-pill">Images</span>
                                            </span>

                                            <div class="timeline-item">
                                                <div class="timeline-point timeline-point-success">
                                                    <i class="fa fa-image"></i>
                                                </div>
                                                <div class="timeline-event">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title"><a href="#">Rakesh Kumar</a><small> uploaded new photos</small></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <img src="../images/150x100.png" alt="..." class="m-10">
                                                        <img src="../images/150x100.png" alt="..." class="m-10">
                                                        <img src="../images/150x100.png" alt="..." class="m-10">
                                                        <img src="../images/150x100.png" alt="..." class="m-10">
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <p class="text-end"><i class="fa fa-clock-o"></i> 8 days ago</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <div class="timeline-point timeline-point-info">
                                                    <i class="ion ion-chatbubble-working"></i>
                                                </div>
                                                <div class="timeline-event">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title"><a href="#">Jone Doe</a><small> commented on your post</small></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-success btn-sm" href="#">View comment</a>
                                                        <p class="pull-right"><i class="fa fa-clock-o"></i> 8 days ago</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <div class="timeline-point timeline-point-danger">
                                                    <i class="ion ion-ios-videocam"></i>
                                                </div>
                                                <div class="timeline-event">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title"><a href="#">Jone Doe</a><small> shared a video</small></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <div class="ratio ratio-16x9">
                                                            <iframe src="https://www.youtube.com/embed/k85mRPqvMbE" frameborder="0" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-success btn-sm" href="#">View comment</a>
                                                        <p class="pull-right"><i class="fa fa-clock-o"></i> 8 days ago</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="timeline-label">
                                                <button class="btn btn-danger"><i class="fa fa-clock-o"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class=" tab-pane" id="activity">

                                    <div class="box no-shadow">
                                    <!-- Post -->
                                    <div class="post">
                                    <div class="user-block">
                                        <img class="img-bordered-sm rounded-circle" src="../images/user1-128x128.jpg" alt="user image">
                                            <span class="username">
                                            <a href="#">Brayden</a>
                                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                            </span>
                                        <span class="description">5 minutes ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="activitytimeline">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                                        </p>
                                        <ul class="list-inline">
                                            <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                            </li>
                                            <li class="pull-right">
                                            <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                                (5)</a></li>
                                        </ul>
                                        <form class="form-element">
                                            <input class="form-control input-sm" type="text" placeholder="Type a comment">
                                        </form>
                                    </div>
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post">
                                    <div class="user-block">
                                        <img class="img-bordered-sm rounded-circle" src="../images/user6-128x128.jpg" alt="user image">
                                            <span class="username">
                                            <a href="#">Evan</a>
                                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                            </span>
                                        <span class="description">5 minutes ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="activitytimeline">
                                        <div class="row mb-20">
                                            <div class="col-sm-6">
                                            <img class="img-fluid" src="../images/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                <img class="img-fluid" src="../images/photo2.png" alt="Photo">
                                                <br><br>
                                                <img class="img-fluid" src="../images/photo3.jpg" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                <img class="img-fluid" src="../images/photo4.jpg" alt="Photo">
                                                <br><br>
                                                <img class="img-fluid" src="../images/photo1.png" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <ul class="list-inline">
                                            <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                            </li>
                                            <li class="pull-right">
                                            <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                                (5)</a></li>
                                        </ul>

                                        <form class="form-element">
                                            <input class="form-control input-sm" type="text" placeholder="Type a comment">
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-bordered-sm rounded-circle" src="../images/user7-128x128.jpg" alt="user image">
                                            <span class="username">
                                            <a href="#">Nicholas</a>
                                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                            </span>
                                        <span class="description">5 minutes ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                        <div class="activitytimeline">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                                        </p>

                                        <form class="form-horizontal form-element">
                                            <div class="form-group row g-0">
                                            <div class="col-sm-9">
                                                <input class="form-control input-sm" placeholder="Response">
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-danger pull-right w-p100">Send</button>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.post -->
                                    </div>

                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    @push('script')
        <script>

            // FUNGSI UNTUK SIMPAN IDENTITAS
            $('#btn-simpan').click((e) => {
                e.preventDefault();
                $('#btn-simpan').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#btn-simpan').attr('disabled', true)

                var formData = new FormData($('#formInput')[0]);

                $.ajax({
                    data: formData,
                    url: "{{ route('admin.profil.store') }}",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        getProfil()
                        alertBerhasil('Data berhasil disimpan')
                        $('#btn-simpan').html('Simpan')
                        $('#btn-simpan').attr('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Data gagal disimpan')
                        $('#btn-simpan').html('Simpan')
                        $('#btn-simpan').attr('disabled', false)
                    }
                });
            })

            // FUNGSI UNTUK SIMPAN MEDSOS
            $('#btn-simpan-medsos').click((e) => {
                e.preventDefault();
                $('#btn-simpan-medsos').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#btn-simpan-medsos').attr('disabled', true)

                $.ajax({
                    data: $('#formInputMedsos').serialize(),
                    url: "{{ route('admin.profil.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        getProfil()
                        alertBerhasil('Data berhasil disimpan')
                        $('#btn-simpan-medsos').html('Simpan')
                        $('#btn-simpan-medsos').attr('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Data gagal disimpan')
                        $('#btn-simpan-medsos').html('Simpan')
                        $('#btn-simpan-medsos').attr('disabled', false)
                    }
                });
            })

            // FUNGSI SIMPAN GANTI PASSWORD
            $('#btn-simpan-password').click((e) => {
                e.preventDefault();
                $('#btn-simpan-password').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#btn-simpan-password').attr('disabled', true)

                $.ajax({
                    data: $('#formInputPassword').serialize(),
                    url: "{{ route('admin.profil.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        getProfil()
                        alertBerhasil('Data berhasil disimpan')
                        $('#btn-simpan-password').html('Simpan')
                        $('#btn-simpan-password').attr('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Data gagal disimpan')
                        $('#btn-simpan-password').html('Simpan')
                        $('#btn-simpan-password').attr('disabled', false)
                    }
                });
            })
            $('#lihat_password_baru').click(function(){
                if($('#password_baru').attr('type') == 'password'){
                    $('#password_baru').attr('type', 'text');
                    $('#lihat_password_baru').html('<i class="fad fa-eye-slash"></i>');
                }else{
                    $('#password_baru').attr('type', 'password');
                    $('#lihat_password_baru').html('<i class="fad fa-eye"></i>');
                }
            });

            $('#lihat_konfir_password').click(function(){
                if($('#konfir_password').attr('type') == 'password'){
                    $('#konfir_password').attr('type', 'text');
                    $('#lihat_konfir_password').html('<i class="fad fa-eye-slash"></i>');
                }else{
                    $('#konfir_password').attr('type', 'password');
                    $('#lihat_konfir_password').html('<i class="fad fa-eye"></i>');
                }
            });

            getProfil = () => {
                $.ajax({
                    url: "{{ route('admin.profil.store') }}" + '/' + "{{ $profil->id }}",
                    type: "GET",
                    dataType: 'html',
                    success: function (data) {
                        $('#profilRight').html(data)
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            }
        </script>
    @endpush
</x-layouts>
