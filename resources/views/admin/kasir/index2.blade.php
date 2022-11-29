@section('title', 'Kasir')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <div class="row">
                <div class="col-md-12">
                    <marquee><h2>SELAMAT DATANG DI TOKO {{ $dataWebsite->nama_website ?? 'PENJUALAN' }}</h2></marquee>
                    <div class="text-center text-danger">
                        {{ \Carbon\Carbon::now()->format('d F Y') }}
                        <h3 id="jam"></h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-8">
                                <div class="box">
                                    <div class="box-header with-border bg-primary">
                                        <div class="row">
                                            <div class="col-4">
                                                <select onchange="myToko()" class="form-control" id="toko" name="toko">
                                                    <option value="">Pilih Toko</option>
                                                    @foreach ($toko as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_toko }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <select onchange="myBarang()" class="form-control" id="barang" name="barang">
                                                    <option value="">Pilih Barang</option>
                                                    {{-- @foreach ($barang as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_barang }} - --}}
                                                            {{-- @if ($item->kode_barang != '')
                                                                ({{ $item->kode_barang }})
                                                            @endif --}}
                                                            {{-- @foreach ($item->details as $code)
                                                                ({{ $code->barcode }})
                                                            @endforeach
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                            {{-- <div class="col-4"></div> --}}
                                            <div class="col-3">
                                                <h3>Petugas : {{ Auth::user()->name ?? '' }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-bordered table-striped table-hover dataServer">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-center" width="1%">No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Satuan</th>
                                                    <th>Qty</th>
                                                    <th>Harga</th>
                                                    <th class="text-center" width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" id="dataTotal">
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
                                                <input type="hidden" id="totalHarga" value="{{ $totalHarga }}">
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border bg-danger">
                                <h3 class="box-title">History Transaksi</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered table-striped table-hover dataHistory">
                                    <thead class="bg-danger">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Invoice</th>
                                            <th>Toko</th>
                                            <th>Total</th>
                                            <th>Bayar</th>
                                            <th>Kembalian</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <input type="hidden" id="kode" value="0">

    <x-modal2>
        <input type="hidden" id="barangEdit" name="barang">
        <input type="hidden" id="tokoEdit" name="toko">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Satuan Barang</label><br>
                    <select class="form-control" id="satuan" name="satuan">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Jumlah barang</label><br>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" autocomplete="off">
                </div>
            </div>
        </div>
    </x-modal2>

    <x-modal3>
    </x-modal3>

    @push('script')
        <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
        <script src="{{ asset('template/js/pages/notification.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
        <script>
            $('#toko').select2()
            $('#toko').select2('open')

            function myToko(){
                let toko = $('#toko').val()
                $.ajax({
                    url: "{{ route('admin.toko.index') }}" + '/' + toko,
                    type: "GET",
                    dataType: 'json',
                    data: null,
                    success: function (data) {
                        $('#barang').empty();
                        $('#barang').append(`<option value="" selected>--Pilih Barang--</option>`);
                        data.map(function(item, index){
                            $('#barang').append(`<option value="${item.barang.id}">${item.barang.nama_barang} - (${item.barang.stok})</option>`);
                        })
                        $('#barang').select2('open');
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            }

            $(function () {
                'use strict';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'ajax': "{{ route('admin.tampung.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'barang', name: 'barang'},
                        {data: 'alias', name: 'alias', className: 'text-center'},
                        {data: 'jumlah', name: 'jumlah', className: 'text-center'},
                        {data: 'harga', name: 'harga', className: 'text-center'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
                });

                $('.dataHistory').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'ajax': "{{ route('admin.history.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'invoice', name: 'invoice'},
                        {data: 'toko_id', name: 'toko_id'},
                        {data: 'total', name: 'total', className: 'text-center'},
                        {data: 'bayar', name: 'bayar', className: 'text-center'},
                        {data: 'kembalian', name: 'kembalian', className: 'text-center'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
                });

                $('#barang').select2()
                // $('#barang').select2('open')

                document.addEventListener("keydown", e => {
                    if (e.key.toLowerCase() === 'f4'){
                        $('#toko').select2('open');
                    } else if (e.key.toLowerCase() === 'f2'){
                        $('#barang').select2('close');
                        $('#bayar').focus();
                    } else if (e.key.toLowerCase() === 'delete'){
                        refreshPembayaran();
                    } else if (e.key.toLowerCase() === 'f8'){
                        pembayaran();
                    } else if (e.key.toLowerCase() === 'f9'){
                        $('#toko').select2('close');
                        $('#barang').select2('open');
                    }
                })
            });

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

            function pembayaran(){
                $('#btn-simpan').prop('disabled', true)
                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route('admin.kasir.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBayar()
                        let bayar2 = $('#bayar').val()
                        let total2 = $('#totalHarga').val()
                        bayar2 = bayar2.replace(".", '')
                        bayar2 = parseInt(bayar2);
                        total2 = parseInt(total2);
                        let kembalian = bayar2 - total2;
                        kembalian = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(kembalian)
                        // swal("Kembalian : " + kembalian, 'Uang Kembalian', "success");
                        swal({
                            title: "Kembalian : " + kembalian,
                            text: "Uang Kembalian",
                            timer: 3000,
                            showConfirmButton: false,
                            type: 'success',
                        });
                        $('.dataServer').DataTable().ajax.reload();
                        $('.dataHistory').DataTable().ajax.reload();
                        $('#barang').empty();
                        $('#barang').val(null).trigger('change');
                        $('#toko').val(null).trigger('change');
                        $('#toko').select2('open');
                        $.ajax({
                            url: "{{ route('admin.kasir.create') }}",
                            type: "GET",
                            dataType: 'html',
                            success: function (data) {
                                $('#dataTotal').html(data)
                            },
                            error: function (data) {
                                console.log('error');
                            }
                        });
                    },
                    error: function (data) {
                        alertDanger()
                    }
                });
                $('#btn-simpan').prop('disabled', false)
            }

            $('#btn-simpan').click(function (e) {
                e.preventDefault();
                $('#btn-simpan').prop('disabled', true)
                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route('admin.kasir.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBayar()
                        let bayar2 = $('#bayar').val()
                        let total2 = $('#totalHarga').val()
                        bayar2 = bayar2.replace(".", '')
                        bayar2 = parseInt(bayar2);
                        total2 = parseInt(total2);
                        let kembalian = bayar2 - total2;
                        kembalian = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(kembalian)
                        // swal("Kembalian : " + kembalian, 'Uang Kembalian', "success");
                        swal({
                            title: "Kembalian : " + kembalian,
                            text: "Uang Kembalian",
                            timer: 3000,
                            showConfirmButton: false,
                            type: 'success',
                        });
                        $('.dataServer').DataTable().ajax.reload();
                        $('.dataHistory').DataTable().ajax.reload();
                        $('#barang').empty();
                        $('#barang').val(null).trigger('change');
                        $('#toko').val(null).trigger('change');
                        $('#toko').select2('open');
                        $.ajax({
                            url: "{{ route('admin.kasir.create') }}",
                            type: "GET",
                            dataType: 'html',
                            success: function (data) {
                                $('#dataTotal').html(data)
                            },
                            error: function (data) {
                                console.log('error');
                            }
                        });
                    },
                    error: function (data) {
                        alertDanger()
                    }
                });

                $('#btn-simpan').prop('disabled', false)
            });

            $('body').on('change', '#bayar', function () {
                let bayar = $('#bayar').val()
                let total = $('#totalHarga').val()
                bayar = bayar.replace(".", '')
                bayar = parseInt(bayar);
                total = parseInt(total);
                let kembalian = bayar - total;
                let kembalian2 = kembalian;
                let result = new Intl.NumberFormat('id-ID').format(bayar)
                kembalian = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(kembalian)
                $('#kembalian').val(kembalian)
                $('#kembalian2').val(kembalian2)
                $('#bayar').val(result)
                // if (bayar < total){
                //     swal({
                //         title: "Gagal!",
                //         text: "Uang Anda Kurang",
                //         timer: 1500,
                //         showConfirmButton: false,
                //         type: 'error',
                //     });
                // }
            });

            function myBarang(){
                let kode = $('#kode').val();
                let barang = $('#barang').val();
                let toko = $('#toko').val();

                if (kode != barang) {
                    $('#kode').val(barang);
                    $.ajax({
                        url: "{{ route('admin.tampung.index') }}" + '/insert/' + toko + '/' + barang,
                        type: "GET",
                        dataType: 'json',
                        data: null,
                        success: function (data) {
                            // alertSucces()
                            console.log(data);
                            if (data.message == 'Failed'){
                                swal({
                                    title: "Stok Tidak Tersedia",
                                    text: "Stok : " + data.stok,
                                    timer: 1000,
                                    showConfirmButton: false,
                                    type: 'error',
                                });
                                $('#barang').val(null).trigger('change');
                                $('#barang').select2('open');
                            } else {
                                $('.dataServer').DataTable().ajax.reload();
                                $('#barang').val(null).trigger('change');
                                $('#barang').select2('open');
                                $.ajax({
                                    url: "{{ route('admin.kasir.create') }}",
                                    type: "GET",
                                    dataType: 'html',
                                    success: function (data) {
                                        $('#dataTotal').html(data)
                                    },
                                    error: function (data) {
                                        console.log('error');
                                    }
                                });
                            }
                        },
                        error: function (data) {
                            console.log('error');
                        }
                    });
                }
            }

            function refreshPembayaran(){
                swal({
                    title: "Yakin Ingin Menghapus ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false,
                    cancelButtonText: 'Batal',
                }, function() {
                    swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                    $.ajax({
                        url: "{{ route('admin.tampung.create') }}",
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            $('.dataServer').DataTable().ajax.reload();
                            $('#barang').val(null).trigger('change');
                            $('#barang').select2('open');
                            $.ajax({
                                url: "{{ route('admin.kasir.create') }}",
                                type: "GET",
                                dataType: 'html',
                                success: function (data) {
                                    $('#dataTotal').html(data)
                                },
                                error: function (data) {
                                    console.log('error');
                                }
                            });
                        },
                        error: function (data) {
                            console.log('error');
                        }
                    });
                });
            }


            // window.onload = function() { jam(); }

            function jam() {
                var e = document.getElementById('jam'),
                d = new Date(), h, m, s;
                h = d.getHours();
                m = set(d.getMinutes());
                s = set(d.getSeconds());

                e.innerHTML = h +':'+ m +':'+ s;

                setTimeout('jam()', 1000);
            }

            function set(e) {
                e = e < 10 ? '0'+ e : e;
                return e;
            }
            jam();

            $('body').on('click', '.deleteProduct', function () {
                var id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.tampung.store') }}" + '/' + id,
                    success: function (data) {
                        $('.dataServer').DataTable().ajax.reload();
                        $('#barang').val(null).trigger('change');
                        $('#barang').select2('open');
                        $.ajax({
                            url: "{{ route('admin.kasir.create') }}",
                            type: "GET",
                            dataType: 'html',
                            success: function (data) {
                                $('#dataTotal').html(data)
                            },
                            error: function (data) {
                                console.log('error');
                            }
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal2').html("Edit Barang");
                $('#saveBtn2').val("edit-jenis");
                $('#modalForm2').modal('show');
                $.ajax({
                    url: "{{ route('admin.tampung.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id2').val(data.id);
                        $('#jumlah').val(data.jumlah);
                        $('#barangEdit').val(data.barang_id);
                        $('#tokoEdit').val(data.toko_id);
                        getSatuan(data.barang_id);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });

            function getSatuan(barang){
                $.ajax({
                    url: "{{ route('admin.history.index') }}" + '/' + barang,
                    type: "GET",
                    dataType: 'json',
                    data: null,
                    success: function (data) {
                        $('#satuan').empty();
                        data.map(function(item, index){
                            $('#satuan').append(`<option class="satuan2" value="${item.satuan.id}">${item.satuan.nama_satuan} (${item.satuan.alias})</option>`);
                        })
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            }
            $('#saveBtn2').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');
                $('#saveBtn2').prop('disabled', true)
                $.ajax({
                    data: $('#formInput2').serialize(),
                    url: "{{ route('admin.tampung.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.message == 'Failed'){
                            swal({
                                title: "Stok Tidak Tersedia",
                                text: "Stok : " + data.stok,
                                timer: 1000,
                                showConfirmButton: false,
                                type: 'error',
                            });
                            $('#barang').val(null).trigger('change');
                            $('#barang').select2('open');
                        } else {
                            $('#formInput2').trigger("reset");
                            $('#modalForm2').modal('hide');
                            $('.dataServer').DataTable().ajax.reload();
                            $('#barang').val(null).trigger('change');
                            $('#barang').select2('open');
                            $.ajax({
                                url: "{{ route('admin.kasir.create') }}",
                                type: "GET",
                                dataType: 'html',
                                success: function (data) {
                                    $('#dataTotal').html(data)
                                },
                                error: function (data) {
                                    console.log('error');
                                }
                            });
                        }
                    },
                    error: function (data) {
                        $('#saveBtn2').html('Simpan');
                    }
                });
                $('#saveBtn2').prop('disabled', false)
            });

            $('body').on('click', '.detailProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal3').html("Detail Barang");
                $('#saveBtn3').val("edit-jenis");
                $('#modalForm3').modal('show');
                $.ajax({
                    url: "{{ route('admin.history.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'html',
                    success: function (data) {
                        $('#modalBody').html(data);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });
        </script>
    @endpush
</x-layouts>
