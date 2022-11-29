<div class="row" id="comPasien">
    <div class="col-lg-12 col-12 position-fixed1" style="z-index:1; padding-right:1%">
        <div class="box bg-img" style="background-image: url({{ asset('template/images/abstract-4.svg') }});background-position: right top; background-size: 30% auto;">
            <div class="box-body py-2">
                <div class="row">
                    <div class="col-md-5">
                        <a href="#" class="box-title fw-600 text-muted hover-primary fs-18"><i class="fad fa-user-injured me-5"></i> {{ $pasien->pasien->nama }} / {{ $pasien->no_rm }}
                            @if ($pasien->status_pasien == 'belum_selesai')
                                <i class="fad fa-user-times text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Pasien Belum Dilayanin"></i>
                            @elseif ($pasien->status_pasien == 'diproses')
                                <i class="fad fa-user-clock text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Pasien Sedang Dilayani"></i>
                            @elseif ($pasien->status_pasien == 'selesai')
                                <i class="fad fa-user-check text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Pasien Selesai Dilayani"></i>
                            @endif
                        </a>
                        <table class="">
                            <tbody>
                                <tr>
                                    <th scope="row">No. Register</th>
                                    <td>:</td>
                                    <td class="text-danger fw-bold">{{ $pasien->register }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">NIK</th>
                                    <td>:</td>
                                    <td>{{ $pasien->pasien->nik }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td>:</td>
                                    <td>
                                        {{ $pasien->pasien->gender->jenis_kelamin }}
                                        <span class="fw-bold ps-20">Gol. Darah : </span>{{ $pasien->pasien->golongan_darah ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tgl. Lahir</th>
                                    <td>:</td>
                                    <td>{{ $pasien->pasien->tempat_lahir . ',' }} {{ date('d/m/Y', strtotime($pasien->pasien->tgl_lahir)) }} ( {{ \Carbon\Carbon::parse($pasien->pasien->tgl_lahir)->diff(\Carbon\Carbon::now())->format('%y Thn %m Bln %d Hari') }} )</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>:</td>
                                    <td>{{ $pasien->pasien->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <a href="#" class="box-title fw-600 text-muted hover-primary fs-18"><i class="fad fa-user-md me-5"></i> {{ $pasien->dokter->nama }}</a>
                        <table class="">
                            <tbody>
                                <tr>
                                    <th scope="row">Penjamin</th>
                                    <td>:</td>
                                    <td class="text-uppercase">
                                        @if ($pasien->status_jaminan == 'umum')
                                            {{ $pasien->status_jaminan }}
                                        @else
                                            {{ $pasien->asuransi->nama }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">No. SEP</th>
                                    <td>:</td>
                                    <td id="SEP"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tgl. Masuk</th>
                                    <td>:</td>
                                    <td>{{ date('d/m/Y', strtotime($pasien->tgl_masuk)) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ruang</th>
                                    <td>:</td>
                                    <td class="text-uppercase">Poliklinik {{ $pasien->poliklinik->nama }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Antrian</th>
                                    <td>:</td>
                                    <td class="text-uppercase">{{ $pasien->antrian->nomor_antrian }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Waktu Respon</th>
                                    <td>:</td>
                                    <td class="text-uppercase">{{ $pasien->respon_waktu_dokter }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
