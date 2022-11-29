<table class="table table-bordered tblFarmasi">
    <thead>
        <tr>
            <th class="text-center" width="1px">No</th>
            <th>Keterangan Order Farmasi</th>
            <th class="text-center">Jumlah</th>
            <th width="300px">Ganti Obat</th>
            <th class="text-center" width="1px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->farmasis as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="fst-italic">
                    R/ {{ $item->obat->nama }} {{ $item->obat->satuan->alias }} <br> S. {{ $item->keterangan }} <br>
                    Cara : {{ $item->cara_penggunaan == 'sebelum_makan' ? 'Sebelum Makan,' : '' }}
                    {{ $item->cara_penggunaan == 'sesudah_makan' ? 'Sesudah Makan,' : '' }}
                    {{ $item->pagi == '1' ? 'Pagi' : '' }}
                    {{ $item->siang == '1' ? 'Siang' : '' }}
                    {{ $item->malam == '1' ? 'Malam' : '' }}
                </td>
                <td class="text-center">{{ $item->jumlah }}</td>
                <td class="fst-italic">
                    @if ($item->obat_pengganti_id != '')
                        Nama : {{ $item->obat_pengganti->nama ?? '' }} {{ $item->obat_pengganti->satuan->alias }}<br>
                        Jumlah : {{ $item->jumlah_pengganti }} <br>
                        Cara : {{ $item->keterangan_pengganti }}
                        {{ $item->cara_penggunaan_pengganti == 'sebelum_makan' ? 'Sebelum Makan,' : '' }}
                        {{ $item->cara_penggunaan_pengganti == 'sesudah_makan' ? 'Sesudah Makan,' : '' }}
                        {{ $item->pagi_pengganti == '1' ? 'Pagi' : '' }}
                        {{ $item->siang_pengganti == '1' ? 'Siang' : '' }}
                        {{ $item->malam_pengganti == '1' ? 'Malam' : '' }}
                    @endif
                </td>
                <td class="text-center">
                    @if ($item->status == 'diproses')
                        <div class="list-icons d-inline-flex">
                            <a href="javascript:void(0)"  data-id="{{ $item->id }}" class="list-icons-item me-10 editProduct text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Obat">
                                <i class="fad fa-edit"></i>
                            </a>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
