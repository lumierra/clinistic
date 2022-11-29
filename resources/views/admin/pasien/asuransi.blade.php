<div class="col-md-12 table-responsive">
    <table class="table table-bordered">
        <thead class="bg-primary">
            <tr>
                <th class="text-center" width="1%">No</th>
                <th>Nama Asuransi</th>
                <th class="text-center">Nomor Asuransi</th>
                <th class="text-center" width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bpjs as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->asuransi->nama }}</td>
                    <td class="text-center">{{ $item->nomor }}</td>
                    <td class="text-center">
                        <div class="list-icons d-inline-flex">
                            <a href="javascript:void(0)"  data-id="{{ $item->id }}" class="list-icons-item me-10 btnUbah" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="fad fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" data-id="{{ $item->id }}" class="list-icons-item text-danger me-10 btnHapus" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                <i class="fad fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

