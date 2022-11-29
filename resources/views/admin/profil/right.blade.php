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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
