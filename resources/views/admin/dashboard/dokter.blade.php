<div class="row">
    <div class="col-12 col-xl-5">
        <div class="box">
            <div class="box-header bg-primary">
                {{-- MOBILE --}}
                <div class="d-inline d-sm-none">
                    <h4 class="box-title text-white">Data Kunjungan <br> {{ $day }}</h4>
                </div>
                {{-- DESKTOP --}}
                <div class="d-none d-md-inline d-sm-none">
                    <h4 class="box-title text-white">Data Kunjungan {{ $day }}</h4>
                </div>
            </div>
            <div class="box-body px-0 bg-primary rounded-0">
                <div id="spark2" class="text-dark"></div>
            </div>
            <div class="box-body up-mar60 pb-0">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="bg-lightest px-30 py-5 rounded20 mb-20">
                            <span class="fad fa-user-injured d-block1 fs-40"><span class="path1"></span><span class="path2"></span></span>
                            <span class="fs-40 mx-20">{{ $kunjungan }}</span>
                            <br>
                            <a href="#" class="text-primary fw-500 fs-18">
                                Total Pasien
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="bg-lightest px-30 py-5 rounded20 mb-20">
                            <span class="icon-Equalizer d-block1 fs-40"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                            <span class="fs-40 mx-20">{{ $kasus }}</span>
                            <br>
                            <a href="#" class="text-warning fw-500 fs-18">
                                Kasus
                            </a>
                        </div>
                    </div>
                    @php
                        $color = ['primary', 'success', 'danger', 'warning', 'info'];
                    @endphp
                    @foreach ($poli as $item)
                        @php
                            $rand = $color[rand(0, 4)];
                        @endphp
                        <div class="col-12 col-md-6">
                            <div class="bg-lightest px-30 py-5 rounded20 mb-20">
                                <span class="fad fa-hospitals d-block1 fs-40"><span class="path1"></span><span class="path2"></span></span>
                                <span class="fs-40 mx-20">{{ $item->getPasienByDokter($dokter) }}</span>
                                <br>
                                <a href="#" class="text-{{ $rand }} fw-500 fs-18">
                                    {{ $item->nama }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 col-md-6">
                        <div class="bg-lightest px-30 py-5 rounded20 mb-20">
                            <span class="fad fa-building-user d-block1 fs-40"><span class="path1"></span><span class="path2"></span></span>
                            <span class="fs-40 mx-20">{{ $bpjs }}</span>
                            <br>
                            <a href="#" class="text-primary fw-500 fs-18">
                                BPJS
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="bg-lightest px-30 py-5 rounded20 mb-20">
                            <span class="fad fa-universal-access d-block1 fs-40"><span class="path1"></span><span class="path2"></span></span>
                            <span class="fs-40 mx-20">{{ $umum }}</span>
                            <br>
                            <a href="#" class="text-success fw-500 fs-18">
                                UMUM
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="box">
            <div class="box-header bg-success">
                <h4 class="box-title text-white">Pendapatan {{ date('Y') }}</h4>
            </div>
            <div class="box-body px-0 py-0 bg-success rounded-0">
                <div id="revenue1" class="text-dark"></div>
            </div>
            <div class="box-body up-mar40 bg-white position-relative">
                <div class="row">
                    <h4>Rincian Pendapatan Bulan {{ $month }}</h4>
                    <div class="col-6">
                        <div class="px-30 py-20">
                            <div class="text-fade fw-600">Pendaftaran</div>
                            <div class="fs-18 fw-600">Rp. {{ number_format($pendapatanPendaftaran, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="px-30 py-20">
                            <div class="text-fade fw-600">Tindakan</div>
                            <div class="fs-18 fw-600">Rp. {{ number_format($pendapatanTindakan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="px-30 py-20">
                            <div class="text-fade fw-600">Total</div>
                            <div class="fs-18 fw-600">Rp. {{ number_format($pendapatanPendaftaran+$pendapatanTindakan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="box box-solid box-danger bb-3 border-danger">
            <div class="box-header">
                <h4 class="box-title">Diagnosa 10 Terbanyak
                    {{-- <small class="subtitle">More than 400+ new members</small> --}}
                </h4>
            </div>
            <div class="box-body p-0">
                <div class="table-responsive">
                    <table class="table no-border table-vertical-center">
                        <thead>
                            <tr>
                                <th class="p-0" style="width: 50px"></th>
                                <th class="p-0" style="min-width: 150px"></th>
                                <th class="p-0" style="min-width: 140px"></th>
                                <th class="p-0" style="min-width: 120px"></th>
                                {{-- <th class="p-0" style="min-width: 40px"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosa as $item)
                                <tr>
                                    <td>
                                        <div class="bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                            <img src="{{ asset('images/diagnoses.png') }}" class="h-30" alt="Diagnosa">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark fw-600 hover-primary fs-16">{{ $item->icd->nama ?? '' }}</a>
                                    </td>
                                    <td class="text-start">
                                        <span class="text-fade">
                                            Kode ICD : {{ $item->icd_id }}
                                        </span>
                                    </td>
                                    <td class="text-end fs-15">
                                        <span class="badge badge-dark">{{ $item->getCountIcd($dokter) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-info-light btn-sm"><span class="icon-Arrow-right fs-18"><span class="path1"></span><span class="path2"></span></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
