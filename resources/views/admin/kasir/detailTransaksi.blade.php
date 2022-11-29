<div class="col-md-12">
    <div class="table-responsive-md">
        <table class="table table-hover" id="tblDT">
            <thead>
                <tr>
                    <th class="text-center" width="1px">No</th>
                    <th width="250px">Deskripsi</th>
                    <th class="text-center">Tgl. Transaksi</th>
                    <th class="text-center" width="10px">Jumlah</th>
                    <th class="text-center">Harga/Produk</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaksi->detailTransaksi as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->keterangan == 'farmasi')
                                {{ $item->obat->nama }} ({{ Str::title($item->keterangan) }})
                            @elseif ($item->keterangan == 'farmasi racik')
                                {{ $item->obat->nama }} ({{ Str::title($item->keterangan) }})
                            @else
                                {{ $item->produk->nama }} ({{ Str::title($item->keterangan) }})
                            @endif
                        </td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($item->tgl_detail)) }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-center">{{ number_format($item->harga, 0, ',','.') }}</td>
                        <td class="text-center">{{ number_format($item->harga*$item->jumlah, 0, ',','.') }}</td>
                    </tr>
                    @php
                        $total = $total + ($item->harga*$item->jumlah);
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@php
    if (substr($total,-3) < 499){
        $result = substr($total,-3);
        ($result == 000 ? $total=round($total,-3) : $total=str_replace($result,500,$total));
    } else if (substr($total,-3 > 501 && substr($total,-3) < 999)){
        $total=round($total,-3);
    } else {
        $total=round($total,-3)+1000;
    }
@endphp
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" id="nomor_transaksi" name="nomor_transaksi" value="{{ $transaksi->id }}">
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="tgl_transaksi" class="fs-20 fw-700">Total Transaksi</label>
                        <input type="text" class="form-control fs-20 fw-700" id="total_transaksi" name="total_transaksi" value="{{ number_format($total, 0,',','.') }}" readonly>
                    </div>
                </div>
                <div class="col-md-5"></div>

                @if ($transaksi->status_transaksi == 'selesai')
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="tgl_transaksi" class="fs-20 fw-700">Bayar</label>
                            <input readonly type="text" class="form-control fs-20 fw-700" id="bayar" name="bayar" value="{{ number_format($transaksi->bayar, 0, ',','.') }}">
                        </div>
                    </div>
                @else
                    @if ($transaksi->status_jaminan == 'umum')
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="tgl_transaksi" class="fs-20 fw-700">Bayar</label>
                                <input type="text" class="form-control fs-20 fw-700" id="bayar" name="bayar" value="">
                            </div>
                        </div>
                    @else
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="tgl_transaksi" class="fs-20 fw-700">Bayar</label>
                                <input readonly type="text" class="form-control fs-20 fw-700" id="bayar" name="bayar" value="{{ number_format($total, 0, ',','.') }}">
                            </div>
                        </div>
                    @endif
                @endif

                <div class="col-md-5"></div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="tgl_transaksi" class="fs-20 fw-700">Kembalian</label>
                        <input type="text" class="form-control fs-20 fw-700" id="kembalian" name="kembalian" readonly value="{{ $transaksi->status_transaksi == 'selesai' ? number_format($transaksi->kembalian, 0, ',','.') : '' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tblDT').DataTable({
        "paging": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
    $('#bayar').on('keyup', function (e) {
        e.preventDefault();
        let bayar = $(this).val()
        if (bayar == ''){
            $('#bayar').val('')
            $('#kembalian').val('')
        } else {
            $('#bayar').val(formatRupiah(bayar, ""))
            let total = $('#total_transaksi').val()
            bayar = bayar.replace(/\./g, '')
            total = total.replace(/\./g, '')
            let kembalian = parseInt(bayar) - parseInt(total);
            let temp = isNaN(kembalian);
            if (temp){
                $('#kembalian').val('')
            } else {
                kembalian = new Intl.NumberFormat('id-ID').format(kembalian)
                $('#kembalian').val(kembalian)
            }
        }
    })

    $('#bayar').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#btn-bayar').click()
        }
    });
</script>
