<div class="col-md-12 table-responsive">
    <table class="table table-bordered">
        <thead class="bg-primary">
            <tr>
                <th class="text-center" width="1%">No</th>
                <th>Nama Barang</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
                 <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $item->barang->nama_barang ?? '' }}</td>
                     <td class="text-center">{{ $item->satuan->nama_satuan ?? '' }}</td>
                     <td class="text-center">{{ $item->jumlah }}</td>
                     <td class="text-center">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                 </tr>
            @endforeach
        </tbody>
    </table>
</div>
