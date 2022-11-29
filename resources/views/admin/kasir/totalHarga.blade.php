<div class="box">
    <div class="box-header with-border bg-primary">
        <h3 class="box-title">Total : <span class="fs-1">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span></h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="example11" class="table">
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($tampung as $item)
                    <tr>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>x{{ $item->jumlah }}</td>
                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $total = $total + $item->harga;
                    @endphp
                @endforeach
                <tr class="fw-bolder fs-5">
                    <td class="fw-bolder">Total : </td>
                    <td></td>
                    <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="row">
            <form id="formInput">
                <input type="hidden" id="totalHarga" name="totalHarga" value="{{ $totalHarga }}">
                <input type="hidden" id="kembalian2" name="kembalian2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Bayar</label>
                        <input type="text" class="form-control" id="bayar" name="bayar" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="text" class="form-control" id="kembalian" name="kembalian" placeholder="Kembalian" readonly>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block" id="btn-simpan">BAYAR</button>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <button type="button" class="btn btn-warning btn-block" id="btn-simpanPrint">BAYAR & PRINT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#bayar').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            pembayaran()
        }
    });
    $('#kembalian').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            pembayaran()
        }
    });
</script>
