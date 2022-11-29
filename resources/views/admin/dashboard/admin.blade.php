<div class="row">
    <div class="col-xl-12 col-12">
        <div class="row">
            <x-app.card_img title="Kunjungan Masuk" value="{{ $kunjungan }}"
                img="{{ asset('template/images/svg-icon/medical/icon-1.svg') }}">
            </x-app.card_img>
            <x-app.card_img title="Poliklinik" value="{{ count($poli) }}"
                img="{{ asset('template/images/svg-icon/medical/icon-4.svg') }}">
            </x-app.card_img>
            <x-app.card_img title="Dokter" value="{{ $dokter }}"
                img="{{ asset('template/images/svg-icon/medical/icon-2.svg') }}">
            </x-app.card_img>
            {{-- <x-app.card_img title="Pasien IGD" value="1"
                img="{{ asset('template/images/svg-icon/medical/icon-2.svg') }}">
            </x-app.card_img> --}}
        </div>
    </div>

    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">Data Kunjungan Rawat Jalan</h3>
        </div>
    </div>
    @php
        $color = ['primary', 'success', 'danger', 'warning', 'info'];
    @endphp
    @foreach ($poli as $item)
        @php
            $rand = $color[rand(0, 4)];
        @endphp
        <x-app.card_logo2 title="POLIKLINIK {{ $item->nama }}" value="{{ $item->getPasien() }}"
            icon="fad fa-hospitals" color="{{ $rand}}"
            border="border-{{ $rand }}"
            antrian="{{ $item->getNomorAntrian() }}">
        </x-app.card_logo2>
    @endforeach

    <div class="d-none d-md-inline d-sm-none col-xl-12 col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Chart Kunjungan Rawat Jalan Bulan {{ $month }} {{ date('Y') }}</h4>
            </div>
            <div class="box-body">
                <div id="spline-chart"></div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">Data Order Penunjang</h3>
        </div>
    </div>
    <x-app.card_logo title="ORDER LAB" value="{{ $lab }}" icon="fad fa-flask-vial" color="success" border="border-success">
    </x-app.card_logo>
    <x-app.card_logo title="ORDER RADIOLOGI" value="{{ $radiologi }}" icon="fad fa-x-ray" color="danger" border="border-danger">
    </x-app.card_logo>
</div>
