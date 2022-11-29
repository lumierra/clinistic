<div class="box box-body p-40 bg-dark mb-0">
    <img src="{{ asset($data->logo2) }}" style="width: 25%" alt="{{ $data->nama_website }}" class="img-fluid1 img-thumbnail1 round">
    <h2 class="box-title text-white">{{ $data->nama_website }}</h2>
    <div class="widget fs-18 my-20 py-20 by-1 border-light">
        <ul class="list list-unstyled text-white-80">
            <li class="ps-5">
                <i class="ti-mobile pe-20"></i>
                {{ $data->phone }}
            </li>
            <li class="ps-5 my-20">
                <i class="ti-email pe-20"></i>
                {{ $data->email }}
            </li>
            <li class="ps-5">
                <i class="ti-location-pin pe-20"></i>
                {{ $data->alamat }}
            </li>
        </ul>
    </div>
    <h4 class="mb-20">Media Sosial</h4>
    <ul class="list-unstyled d-flex gap-items-1">
        <li>
            <a href="{{ $data->facebook ?? '#' }}" target="_blank" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook">
                <i class="mdi mdi-facebook fs-20"></i>
            </a>
        </li>
        <li>
            <a href="{{ $data->instagram ?? '#' }}" target="_blank" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-instagram">
                <i class="mdi mdi-instagram fs-20"></i>
            </a>
        </li>
        <li>
            <a href="{{ $data->youtube ?? '#' }}" target="_blank" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube">
                <i class="mdi mdi-youtube-play fs-20"></i>
            </a>
        </li>
    </ul>
</div>
