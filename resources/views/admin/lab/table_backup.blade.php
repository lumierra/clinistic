<table class="table table-bordered">
    <tbody>
        <tr>
            <td width="200px">Pemeriksaan A</td>
            <td>{{ $data->satu }}</td>
            <td class="text-center" width="100px">
                <div class="list-icons d-inline-flex">
                    <a href="javascript:void(0)" data-id="{{ $data->id }}" data-nama="satu" data-pemeriksaan="Pemeriksaan A" data-hasil="{{ $data->satu }}" class="list-icons-item me-10 editPemeriksaan text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                        <i class="fad fa-edit"></i>
                    </a>
                </div>
            </td>
        </tr>
        <tr>
            <td width="200px">Pemeriksaan B</td>
            <td>{{ $data->dua }}</td>
            <td class="text-center" width="100px">
                <div class="list-icons d-inline-flex">
                    <a href="javascript:void(0)" data-id="{{ $data->id }}" data-nama="dua" data-pemeriksaan="Pemeriksaan B" data-hasil="{{ $data->dua }}" class="list-icons-item me-10 editPemeriksaan text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                        <i class="fad fa-edit"></i>
                    </a>
                </div>
            </td>
        </tr>
        <tr>
            <td width="200px">Pemeriksaan C</td>
            <td>{{ $data->tiga }}</td>
            <td class="text-center" width="100px">
                <div class="list-icons d-inline-flex">
                    <a href="javascript:void(0)" data-id="{{ $data->id }}" data-nama="tiga" data-pemeriksaan="Pemeriksaan C" data-hasil="{{ $data->tiga }}" class="list-icons-item me-10 editPemeriksaan text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                        <i class="fad fa-edit"></i>
                    </a>
                </div>
            </td>
        </tr>
    </tbody>
</table>
