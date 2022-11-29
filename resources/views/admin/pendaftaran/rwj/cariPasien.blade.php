<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width: 100%;">
            <thead class="bg-primary">
                <tr>
                    <th class="text-center" width="1%">No</th>
                    <th class="text-center">No. RM</th>
                    <th>Data Diri</th>
                    <th class="text-center">Sex</th>
                    <th class="text-center">Usia</th>
                    <th class="text-center">No. HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasien as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center"><span class="btn btn-sm btn-success" id="pilihPasien" data-id="{{ $item->no_rm }}">{{ $item->no_rm }}</span></td>
                        <td>
                            <span class="fw-bolder">Nama : </span> {{ Str::title($item->nama) }} <br>
                            <span class="fw-bolder">NIK : </span> {{ $item->nik }}
                        </td>
                        <td class="text-center">
                            @if ($item->gender->jenis_kelamin == 'Pria')
                                <span class="badge badge-info">{{ $item->gender->jenis_kelamin }}</span>
                            @else
                                <span class="badge badge-danger">{{ $item->gender->jenis_kelamin }}</span>
                            @endif
                        </td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tgl_lahir)->age . ' Thn'; }}</td>
                        <td class="text-center">{{ $item->phone }}</td>
                        <td>
                            <span class="fw-bolder">Alamat : </span> {{ $item->alamat }} <br>
                            <span class="fw-bolder">Kelurahan : </span> {{ $item->kelurahan->nama_kelurahan ?? '-' }} <br>
                            <span class="fw-bolder">Kecamatan : </span> {{ $item->kecamatan->nama_kecamatan ?? '-' }} <br>
                            <span class="fw-bolder">Kab/Kota : </span> {{ $item->kabupaten->nama_kabupaten ?? '-' }} <br>
                            <span class="fw-bolder">Provinsi : </span> {{ $item->provinsi->nama_provinsi ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
