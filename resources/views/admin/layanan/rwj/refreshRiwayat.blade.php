<div>
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="ps-15">Data Riwayat Pasien <i class="fad fa-file-contract"></i></h3>
                    </div>
                    <div class="col-md-2">
                        <button onclick="btnRefreshRiwayat()" type="button" class="btn btn-success btn-sm float-end mt-10 btnRefreshRiwayat">TAMPIL</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tableRiwayat">
                <thead>
                    <tr>
                        <th class="text-center" width="1px"></th>
                        <th class="text-center" width="1px">No</th>
                        <th class="text-center" width="200px">Tgl. Kunjungan</th>
                        <th class="text-center" width="200px">Poliklinik</th>
                        <th width="250px">Dokter</th>
                        <th>Diagnosa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungan as $item)
                        <tr data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" class="accordion-toggle">
                            <th class="text-center" width="1px"><i class="fad fa-long-arrow-down"></i></th>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->tgl_masuk)->translatedFormat('l, d F Y') }}</td>
                            <td class="text-center">{{ $item->poliklinik->nama }}</td>
                            <td>{{ $item->dokter->nama }}</td>
                            <td>
                                @foreach ($item->diagnosas as $key => $diagnosa)
                                    <span class="fw-bold">Kode ICD {{ $key+1 }} : <span class="text-danger">{{ $diagnosa->icd->kode ?? '' }}</span></span> <br>
                                    <span class="fw-bold">Nama : <span class="text-danger">{{ $diagnosa->diagnosa ?? '' }}</span></span> <br>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" class="hiddenRow">
                                <div class="accordian-body collapse" id="collapse{{ $item->id }}">
                                    {{-- DATA CATATAN PELAYANAN --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="box">
                                                {{-- <h5 class="ps-15 text-decoration-underline">Data Catatan</h5> --}}
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="table-responsive ps-15">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <th width="5%">Keluhan Utama</th>
                                                                        <td width="40%">{{ $item->catatan->keluhan_utama ?? '-' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="">Anamnesa</th>
                                                                        <td width="40%">{{ $item->catatan->subyektif ?? '-' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="">Alergi Makanan</th>
                                                                        <td width="40%" class="text-capitalize">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->alergi_makanan == '')
                                                                                    -
                                                                                @elseif ($item->catatan->alergi_makanan == 'tidak_ada')
                                                                                    Tidak Ada
                                                                                @elseif ($item->catatan->alergi_makanan == 'susu_sapi')
                                                                                    Susu Sapi
                                                                                @elseif ($item->catatan->alergi_makanan == 'kacang_kacangan')
                                                                                    Kacang Kacangan
                                                                                @elseif ($item->catatan->alergi_makanan == 'makanan_lain')
                                                                                    Makanan Lain
                                                                                @else
                                                                                    {{ $item->catatan->alergi_makanan }}
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="">Alergi Udara</th>
                                                                        <td width="40%">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->alergi_udara == '')
                                                                                    -
                                                                                @elseif ($item->catatan->alergi_udara == 'tidak_ada')
                                                                                    Tidak Ada
                                                                                @elseif ($item->catatan->alergi_udara == 'udara_panas')
                                                                                    Udara Panas
                                                                                @elseif ($item->catatan->alergi_udara == 'udara_dingin')
                                                                                    Udara Dingin
                                                                                @elseif ($item->catatan->alergi_udara == 'udara_kotor')
                                                                                    Udara Kotor
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="">Alergi Obat</th>
                                                                        <td width="40%" class="text-capitalize">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->alergi_obat == '')
                                                                                    -
                                                                                @elseif ($item->catatan->alergi_obat == 'non_steroid')
                                                                                    Non Steroid
                                                                                @elseif ($item->catatan->alergi_obat == 'obat_obatan_lain')
                                                                                    Obat / Obatan Lain
                                                                                @else
                                                                                    {{ $item->catatan->alergi_obat }}
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="">Kecelakaan Lalu Lintas</th>
                                                                        <td width="40%">{{ Str::title($item->catatan->kll ?? '-') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="">Prognosa</th>
                                                                        <td width="40%" class="text-capitalize">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->prognosa == '')
                                                                                    -
                                                                                @elseif ($item->catatan->prognosa == 'sanam_sembuh')
                                                                                    Sanam (Sembuh)
                                                                                @elseif ($item->catatan->prognosa == 'bonam_baik')
                                                                                    Bonam (Baik)
                                                                                @elseif ($item->catatan->prognosa == 'malam_buruk')
                                                                                    Malam (Buruk/Jelek)
                                                                                @elseif ($item->catatan->prognosa == 'dubia_sanam')
                                                                                    Dubia Ad Sanam/Bonam (Tidak tentu/Ragu-ragu,Cenderung Sembuh/Baik)
                                                                                @elseif ($item->catatan->prognosa == 'dubia_malam')
                                                                                    Dubia Ad Malam (Tidak tentu/Ragu-ragu, Cenderung Buruk/Jelek)
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="15%">Kesadaran</th>
                                                                        <td width="40%">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->kesadaran == 'compos_mentis')
                                                                                    Compos Mentis
                                                                                @elseif ($item->catatan->kesadaran == 'somnolens')
                                                                                    Somnolens
                                                                                @elseif ($item->catatan->kesadaran == 'stupor')
                                                                                    Stupor
                                                                                @elseif ($item->catatan->kesadaran == 'coma')
                                                                                    Coma
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="15%">Status Lokasi</th>
                                                                        <td width="40%">{{ $item->catatan->status_lokalis ?? '-' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="15%">Pelayanan Non Kapitasi</th>
                                                                        <td width="40%">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->non_kapitasi == '')
                                                                                    -
                                                                                @elseif ($item->catatan->non_kapitasi == 'kb')
                                                                                    Pelayanan KB
                                                                                @elseif ($item->catatan->non_kapitasi == 'pnc')
                                                                                    Pelayanan PNC
                                                                                @elseif ($item->catatan->non_kapitasi == 'ambulance')
                                                                                    Pelayanan Ambulance
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="15%">Status Pulang</th>
                                                                        <td width="40%">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->tindak_lanjut == '')
                                                                                    -
                                                                                @elseif ($item->catatan->tindak_lanjut == 'sembuh')
                                                                                    Sembuh
                                                                                @elseif ($item->catatan->tindak_lanjut == 'kontrol_ulang')
                                                                                    Kontrol Ulang
                                                                                @elseif ($item->catatan->tindak_lanjut == 'rujuk')
                                                                                    Rujuk
                                                                                @elseif ($item->catatan->tindak_lanjut == 'meninggal')
                                                                                    Meninggal
                                                                                @elseif ($item->catatan->tindak_lanjut == 'rawat_inap')
                                                                                    Rawat Inap
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="15%">Surat Keterangan </th>
                                                                        <td width="40%">
                                                                            @if ($item->catatan)
                                                                                @if ($item->catatan->surat_keterangan == '' || $item->catatan->surat_keterangan == 'tidak_ada')
                                                                                    -
                                                                                @elseif ($item->catatan->surat_keterangan == 'surat_sehat')
                                                                                    Surat Keterangan Sehat <a href="{{ env('APP_URL').'/layanan/surat_sehat/'.$item->id }}" class="btn btn-sm btn-dark" target="_blank"> <i class="fal fa-print"></i> CETAK</a>
                                                                                @elseif ($item->catatan->surat_keterangan == 'surat_sakit')
                                                                                    Surat Keterangan Sakit  <a href="{{ env('APP_URL').'/layanan/surat_sakit/'.$item->id }}" class="btn btn-sm btn-dark" target="_blank"> <i class="fal fa-print"></i> CETAK</a>
                                                                                @elseif ($item->catatan->surat_keterangan == 'surat_berobat')
                                                                                    Surat Keterangan Berobat <a href="{{ env('APP_URL').'/layanan/surat_berobat/'.$item->id }}" class="btn btn-sm btn-dark" target="_blank"> <i class="fal fa-print"></i> CETAK</a>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    {{-- <tr>
                                                                        <th width="15%">Anamnesa</th>
                                                                        <td width="40%">{{ $item->catatan->subyektif ?? '-' }}</td>
                                                                    </tr> --}}
                                                                    {{-- <tr>
                                                                        <th width="15%">Anamnesa</th>
                                                                        <td width="40%">{{ $item->catatan->subyektif ?? '-' }}</td>
                                                                    </tr> --}}
                                                                    {{-- <tr>
                                                                        <th width="15%">Anamnesa</th>
                                                                        <td width="40%">{{ $item->catatan->subyektif ?? '-' }}</td>
                                                                    </tr> --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="box">
                                                            <div class="box-header bg-success">
                                                                <h4 class="box-title text-white">Pemeriksaan Fisik</h4>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row bb-1 pb-10">
                                                                        <div class="col-4">
                                                                            <i class="fad fa-weight fs-30"></i>
                                                                            {{-- <img class="img-fluid float-start w-30 mt-10 me-10" src="{{ asset('template/images/weight.png') }}" alt=""> --}}
                                                                            <div>
                                                                                <p class="mb-0"><small>Berat Badan</small></p>
                                                                                <h5 class="mb-0">
                                                                                    <strong>
                                                                                        @if ($item->catatan)
                                                                                            @if ($item->catatan->berat_badan == '')
                                                                                                -
                                                                                            @else
                                                                                                {{ $item->catatan->berat_badan . ' Kg' }}
                                                                                            @endif
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </strong>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4 bs-1 be-1">
                                                                            <img class="img-fluid float-start w-30 mt-10 me-10" src="{{ asset('template/images/human.png') }}" alt="">
                                                                            <div>
                                                                                <p class="mb-0"><small>Tinggi Badan</small></p>
                                                                                <h5 class=" mb-0">
                                                                                    <strong>
                                                                                        @if ($item->catatan)
                                                                                            @if ($item->catatan->tinggi_badan == '')
                                                                                                -
                                                                                            @else
                                                                                                {{ $item->catatan->tinggi_badan . ' cm' }}
                                                                                            @endif
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </strong>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <img class="img-fluid float-start w-30 mt-10 me-10" src="{{ asset('template/images/bmi.png') }}" alt="">
                                                                            <div>
                                                                                <p class="mb-0"><small>IMT</small></p>
                                                                                <h5 class="mb-0">
                                                                                    <strong>
                                                                                        @if ($item->catatan)
                                                                                            {{ $item->catatan->imt ?? '-' }}
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </strong>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <i class="fad fa-temperature-high fs-30"></i>
                                                                            {{-- <img class="img-fluid float-start w-30 mt-10 me-10" src="{{ asset('template/images/bmi.png') }}" alt=""> --}}
                                                                            <div>
                                                                                <p class="mb-0"><small>Suhu Badan</small></p>
                                                                                <h5 class="mb-0">
                                                                                    <strong>
                                                                                        @if ($item->catatan)
                                                                                            {{ $item->catatan->suhu ?? '-' }}
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </strong>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row pt-5">
                                                                        <div class="col-12">
                                                                            <span class="text-danger">Tekanan Darah</span>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="progress progress-xs mb-0 mt-5 w-40">
                                                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                                </div>
                                                                            </div>
                                                                            <h2 class="float-start mt-0 mr-10"><strong>@if ($item->catatan)
                                                                                {{ $item->catatan->sistole ?? '-' }}
                                                                            @else
                                                                                -
                                                                            @endif</strong></h2>
                                                                            <div>
                                                                                <p class="mb-0"><small>Sistole</small></p>
                                                                                <p class="mb-0 mt-0"><small class="vertical-align-super">mmHg</small></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 bl-1">
                                                                            <div class="progress progress-xs mb-0 mt-5 w-40">
                                                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                                </div>
                                                                            </div>
                                                                            <h2 class="float-start mt-0 mr-10"><strong>@if ($item->catatan)
                                                                                {{ $item->catatan->diastole ?? '-' }}
                                                                            @else
                                                                                -
                                                                            @endif</strong></h2>
                                                                            <div>
                                                                                <p class="mb-0"><small>Diastole</small></p>
                                                                                <p class="mb-0 mt-0"><small class="vertical-align-super">mmHg</small></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 bl-1">
                                                                            <div class="progress progress-xs mb-0 mt-5 w-40">
                                                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                                </div>
                                                                            </div>
                                                                            <h2 class="float-start mt-0 mr-10"><strong>@if ($item->catatan)
                                                                                {{ $item->catatan->respiratory_rate ?? '-' }}
                                                                            @else
                                                                                -
                                                                            @endif</strong></h2>
                                                                            <div>
                                                                                <p class="mb-0"><small>Respiratory Rate</small></p>
                                                                                <p class="mb-0 mt-0"><small class="vertical-align-super">minute</small></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 bl-1">
                                                                            <div class="progress progress-xs mb-0 mt-5 w-40">
                                                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                                </div>
                                                                            </div>
                                                                            <h2 class="float-start mt-0 mr-10"><strong>@if ($item->catatan)
                                                                                {{ $item->catatan->heart_rate ?? '-' }}
                                                                            @else
                                                                                -
                                                                            @endif</strong></h2>
                                                                            <div>
                                                                                <p class="mb-0"><small>Heart Rate</small></p>
                                                                                <p class="mb-0 mt-0"><small class="vertical-align-super">bpm</small></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="box-body pt-0">
                                                                <p><small>Recorded on 25/05/2018</small></p>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @if ($item->poliklinik->nama == 'ESTETIKA')
                                        {{-- DATA FOTO ESTETIKA --}}
                                        <div class="row">
                                            <div class="col-12 ps-15">
                                                <div class="box">
                                                    <h5 class="ps-15 text-decoration-underline">Data Hasil Foto <i class="fal fa-images"></i></h5>
                                                    <div class="row fx-element-overlay">
                                                        <div class="row" id="hasil_foto">
                                                            @foreach ($item->foto_estetika as $key => $estetika)
                                                                <div class="col-md-12 col-lg-3">
                                                                    <div class="box">
                                                                        <div class="fx-card-item">
                                                                            <div class="fx-card-avatar fx-overlay-1">
                                                                                <img src="{{ asset($estetika->photo) }}" alt="{{ $estetika->nama }}">
                                                                                <div class="fx-overlay scrl-dwn">
                                                                                    <ul class="fx-info">
                                                                                        <li><a class="btn default btn-outline image-popup-vertical-fit" href="{{ asset($estetika->photo) }}"><i class="ion-search"></i></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="fx-card-content">
                                                                                <small>Hasil {{ $key+1 }}</small>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- DATA TINDAKAN --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="box">
                                                <h5 class="ps-15 text-decoration-underline">Data Tindakan <i class="fal fa-medkit"></i></h5>
                                                <div class="table-responsive ps-15">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="1%">No</th>
                                                                <th>Nama Tindakan</th>
                                                                <th class="text-center">Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $noTindakan = 1;
                                                            @endphp
                                                            @foreach ($item->detailTindakan as $tindakan)
                                                                <tr>
                                                                    <td class="text-center">{{ $noTindakan++ }}</td>
                                                                    <td class="">{{ $tindakan->produk->nama }}</td>
                                                                    <td class="text-center">{{ $tindakan->jumlah }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- DATA FARMASI --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="box">
                                                <h5 class="ps-15 text-decoration-underline">Data Farmasi <i class="fal fa-pills"></i></h5>
                                                <div class="table-responsive ps-15">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="1%">No</th>
                                                                <th class="text-center" width="15%">No. Order</th>
                                                                <th>Order Detail</th>
                                                                <th class="text-center">Jumlah</th>
                                                                <th class="text-center" width="15%">Tgl. Order</th>
                                                                <th class="text-center" width="5%">Hasil</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $noFar = 1;
                                                            @endphp
                                                            @foreach ($item->farmasis as $farmasi)
                                                                <tr>
                                                                    <td class="text-center">{{ $noFar++ }}</td>
                                                                    <td class="text-center"><span class="btn btn-success btn-sm">{{ $farmasi->kd_farmasi }}</span></td>
                                                                    {{-- <td class="fst-italic">R/ {{ $farmasi->obat->nama }} {{ $farmasi->obat->satuan->alias }} <br> S. {{ $farmasi->keterangan }}</td> --}}
                                                                    <td class="fst-italic">
                                                                        @if ($farmasi->obat_pengganti_id == '')
                                                                            @php
                                                                                $result = 'R/ ' . $farmasi->obat->nama . ' ' . $farmasi->obat->satuan->alias . '<br>' . 'S. ' . $farmasi->keterangan;
                                                                                $cara = $farmasi->cara_penggunaan == 'sebelum_makan' ? 'Sebelum Makan,' : 'Sesudah Makan,';
                                                                                $pagi = $farmasi->pagi == 1 ? 'Pagi' : '';
                                                                                $siang = $farmasi->siang == 1 ? 'Siang' : '';
                                                                                $malam = $farmasi->malam == 1 ? 'Malam' : '';
                                                                                $result .= '<br>' . $cara . ' ' . $pagi . ' ' . $siang . ' ' . $malam;
                                                                            @endphp
                                                                            {!! $result !!}
                                                                        @else
                                                                            @php
                                                                                $result = 'R/ ' . $farmasi->obat->nama . ' ' . $farmasi->obat->satuan->alias . '<br>' . 'S. ' . $farmasi->keterangan;
                                                                                $cara = $farmasi->cara_penggunaan == 'sebelum_makan' ? 'Sebelum Makan,' : 'Sesudah Makan,';
                                                                                $pagi = $farmasi->pagi == 1 ? 'Pagi' : '';
                                                                                $siang = $farmasi->siang == 1 ? 'Siang' : '';
                                                                                $malam = $farmasi->malam == 1 ? 'Malam' : '';
                                                                                $result .= '<br>' . $cara . ' ' . $pagi . ' ' . $siang . ' ' . $malam;

                                                                                $result1 = '<span class="text-danger fw-bolder">Diganti</span> <br>';
                                                                                $result1 .= 'R/ ' . $farmasi->obat_pengganti->nama . ' ' . $farmasi->obat_pengganti->satuan->alias . '<br>' . 'S. ' . $farmasi->keterangan_pengganti;
                                                                                $cara1 = $farmasi->cara_penggunaan_pengganti == 'sebelum_makan' ? 'Sebelum Makan,' : 'Sesudah Makan,';
                                                                                $pagi1 = $farmasi->pagi_pengganti == 1 ? 'Pagi' : '';
                                                                                $siang1 = $farmasi->siang_pengganti == 1 ? 'Siang' : '';
                                                                                $malam1 = $farmasi->malam_pengganti == 1 ? 'Malam' : '';
                                                                                $result1 .= '<br>' . $cara1 . ' ' . $pagi1 . ' ' . $siang1 . ' ' . $malam1;
                                                                            @endphp
                                                                            {!! $result . '<br>' . $result1 !!}
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($farmasi->obat_pengganti_id == '')
                                                                            {{ $farmasi->jumlah }}
                                                                        @else
                                                                            {{ $farmasi->jumlah_pengganti }}
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">{{ date('d-m-Y', strtotime($farmasi->tgl_order)) }}</td>
                                                                    <td class="text-center">
                                                                        @if ($farmasi->status == 'belum')
                                                                            <span class="badge badge-danger">BELUM DIPROSES</span>
                                                                        @elseif ($farmasi->status == 'diproses')
                                                                            <span class="badge badge-warning">SEDANG DIPROSES</span>
                                                                        @elseif ($farmasi->status == 'selesai')
                                                                            <span class="badge badge-success">SELESAI DIPROSES</span>
                                                                        @else
                                                                            <span class="badge badge-dark">TIDAK DIKETAHUI</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- DATA LABORATORIUM --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="box">
                                                <h5 class="ps-15 text-decoration-underline">Data Laboratorium <i class="fal fa-flask"></i></h5>
                                                <div class="table-responsive ps-15">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="1%">No</th>
                                                                <th class="text-center" width="15%">No. Order</th>
                                                                <th>Nama Produk</th>
                                                                <th class="text-center" width="15%">Status</th>
                                                                <th class="text-center" width="15%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $noLab = 1;
                                                            @endphp
                                                            @foreach ($item->labs as $lab)
                                                                <tr>
                                                                    <td class="text-center">{{ $noLab++ }}</td>
                                                                    <td class="text-center"><span class="btn btn-success btn-sm">{{ $lab->kd_lab }}</span></td>
                                                                    <td class="">{{ $lab->produk->nama }}</td>
                                                                    <td class="text-center">
                                                                        @if ($lab->status == 'belum')
                                                                            <span class="badge badge-danger">BELUM DIPROSES</span>
                                                                        @elseif ($lab->status == 'diproses')
                                                                            <span class="badge badge-warning">SEDANG DIPROSES</span>
                                                                        @elseif ($lab->status == 'selesai')
                                                                            <span class="badge badge-success">SELESAI DIPROSES</span>
                                                                        @else
                                                                            <span class="badge badge-dark">TIDAK DIKETAHUI</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($lab->status == 'selesai')
                                                                            <a href="{{ env('APP_URL').'/layanan/hasil_lab/'.$lab->kd_lab }}" class="btn btn-dark btn-sm" target="_blank">
                                                                                <span class="fad fa-print fs-15"></span>
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- DATA RADIOLOGI --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="box">
                                                <h5 class="ps-15 text-decoration-underline">Data Radiologi <i class="fal fa-x-ray"></i></h5>
                                                <div class="table-responsive ps-15">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="1%">No</th>
                                                                <th class="text-center" width="15%">No. Order</th>
                                                                <th>Nama Produk</th>
                                                                <th class="text-center" width="15%">Status</th>
                                                                <th class="text-center" width="15%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $noRad = 1;
                                                            @endphp
                                                            @foreach ($item->radiologis as $rad)
                                                                <tr>
                                                                    <td class="text-center">{{ $noRad++ }}</td>
                                                                    <td class="text-center"><span class="btn btn-success btn-sm">{{ $rad->kd_rad }}</span></td>
                                                                    <td class="">{{ $rad->produk->nama }}</td>
                                                                    <td class="text-center">
                                                                        @if ($rad->status == 'belum')
                                                                            <span class="badge badge-danger">BELUM DIPROSES</span>
                                                                        @elseif ($rad->status == 'diproses')
                                                                            <span class="badge badge-warning">SEDANG DIPROSES</span>
                                                                        @elseif ($rad->status == 'selesai')
                                                                            <span class="badge badge-success">SELESAI DIPROSES</span>
                                                                        @else
                                                                            <span class="badge badge-dark">TIDAK DIKETAHUI</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($rad->status == 'selesai')
                                                                            <a href="{{ env('APP_URL').'/layanan/hasil_radiologi/'.$rad->id }}" class="btn btn-dark btn-sm" target="_blank">
                                                                                <span class="fad fa-print fs-15"></span>
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </a>
                                                                        @endif
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('template/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
<script>
    function btnRefreshRiwayat(){
        let id = "{{ $data->id }}";
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "{{ route('admin.daftar-rwj.index') }}" + '/' + id,
            success: function (data) {
                $('#divRiwayatPasien').html(data)
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>
