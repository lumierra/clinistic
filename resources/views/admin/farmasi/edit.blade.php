@section('title', 'Farmasi')

<x-layouts>
    @push('style')
        <style>
            /* .select2-container{
                z-index:1061 !important;
            } */
            .brd {
                border-radius:30px;
            }
        </style>
    @endpush
    <div class="content-wrapper" id="fullRefresh">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Rincian Pelayanan Farmasi</h3>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="box">
                            <div class="text-white box-body bg-img text-center py-50 bg-primary" data-overlay="5">
                                <a href="#">
                                <img class="avatar avatar-xxl rounded-circle bg-warning-light" src="{{ asset('template/images/avatar/avatar-16.png') }}" alt="">
                                </a>
                                <h5 class="mt-2 mb-0"><a class="text-white" href="#">{{ $data->pasien->nama ?? '' }}</a></h5>
                                <span>{{ $data->pasien->no_rm }}</span>
                            </div>
                            <ul class="flexbox flex-justified text-center p-20">
                                <li>
                                    <span class="text-muted fw-bolder">No. Order</span><br>
                                    <span class="fs-20 badge badge-primary badge-sm rounded-pill">{{ $data->farmasi->kd_farmasi }}</span>
                                </li>
                            </ul>
                            <ul class="flexbox flex-justified text-center p-20">
                                <li class="be-1 bs-1 border-light">
                                    <span class="text-muted fw-bolder">Dokter</span><br>
                                    <span class="fs-20">{{ $data->dokter->nama }}</span>
                                </li>
                                <li>
                                    <span class="text-muted fw-bolder">Poli</span><br>
                                    <span class="fs-20">{{ $data->poliklinik->nama }}</span>
                                </li>
                            </ul>
                            <ul class="flexbox flex-justified text-center p-20">
                                <li class="be-1 bs-1">
                                    <span class="text-muted fw-bolder">Status Permintaan</span><br>
                                    <span class="fs-20">
                                        @if ($data->farmasi->status == 'belum')
                                            <span class="btn btn-sm btn-danger">BELUM DIPROSES</span>
                                        @elseif ($data->farmasi->status == 'diproses')
                                            <span class="btn btn-sm btn-warning">SEDANG DIPROSES</span>
                                        @else
                                            <span class="btn btn-sm btn-success">SELESAI DIPROSES</span>
                                        @endif
                                    </span>
                                </li>
                                <li class="be-1 bs-1">
                                    <span class="text-muted fw-bolder">Jaminan</span><br>
                                    <span class="fs-20">{{ $data->status_jaminan == 'umum' ? 'UMUM' : $data->asuransi->nama }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">

                                <h3 class="box-title align-top">Data Order Farmasi <i class="fad fa-pills fs-30"></i></h3>
                                @if ($data->farmasi->status == 'belum')
                                    <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="btnProses">
                                        <i class="fal fa-user-clock"></i> PROSES
                                    </button>
                                @endif
                                @if ($data->farmasi->status == 'diproses')
                                    <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="btnSelesai">
                                        <i class="fal fa-check-circle"></i> SELESAI
                                    </button>
                                @endif
                                @if ($data->farmasi->status == 'selesai')
                                    <a href="{{ env('APP_URL').'/layanan/hasil_farmasi/'.$data->farmasi->kd_farmasi }}" target="_blank" class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="btnCetak">
                                        <i class="fal fa-receipt"></i> CETAK RESEP
                                    </a>
                                @endif
                            </div>
                            <div class="box-body">
                                <div class="table-responsive" id="tblRefresh">
                                    <table class="table table-bordered tblFarmasi">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="1px">No</th>
                                                <th>Keterangan Order Farmasi</th>
                                                <th class="text-center">Jumlah</th>
                                                <th width="300px">Keterangan Ganti Obat</th>
                                                <th class="text-center" width="1px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->farmasis as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="fst-italic">
                                                        @if ($item->status_racik == 'tidak' || $item->status_racik == '' || $item->status_racik == null)
                                                            R/ {{ $item->obat->nama }} {{ $item->obat->satuan->alias }} <br> S. {{ $item->keterangan }} <br>
                                                        @else
                                                            @php
                                                                $details = $item->detail_farmasi_racik;
                                                                $hasil_detail = '';
                                                                foreach ($details as $detail){
                                                                    $hasil_detail .= $detail->obat->nama . ' ' . $detail->obat->satuan->alias . ' No.' . $detail->jumlah . '<br>';
                                                                }
                                                                $result = 'R/ ' . $hasil_detail . 'S. ' . $item->keterangan . '<br>' . '<span class="text-danger">(Racikan)</span>';
                                                            @endphp
                                                            {!! $result !!}
                                                        @endif
                                                        {{-- Cara : {{ $item->cara_penggunaan == 'sebelum_makan' ? 'Sebelum Makan,' : '' }}
                                                        {{ $item->cara_penggunaan == 'sesudah_makan' ? 'Sesudah Makan,' : '' }}
                                                        {{ $item->pagi == '1' ? 'Pagi' : '' }}
                                                        {{ $item->siang == '1' ? 'Siang' : '' }}
                                                        {{ $item->malam == '1' ? 'Malam' : '' }} --}}
                                                    </td>
                                                    <td class="text-center">{{ $item->jumlah }}</td>
                                                    <td class="fst-italic">
                                                        @if ($item->obat_pengganti_id != '')
                                                            R/ {{ $item->obat_pengganti->nama }} {{ $item->obat_pengganti->satuan->alias }} <br> S. {{ $item->keterangan_pengganti }} <br>
                                                            Jumlah : {{ $item->jumlah_pengganti }}
                                                            {{-- Nama : {{ $item->obat_pengganti->nama ?? '' }} {{ $item->obat_pengganti->satuan->alias }} <br>
                                                            Jumlah : {{ $item->jumlah_pengganti }} <br>
                                                            Cara : {{ $item->keterangan_pengganti }}
                                                            {{ $item->cara_penggunaan_pengganti == 'sebelum_makan' ? 'Sebelum Makan,' : '' }}
                                                            {{ $item->cara_penggunaan_pengganti == 'sesudah_makan' ? 'Sesudah Makan,' : '' }}
                                                            {{ $item->pagi_pengganti == '1' ? 'Pagi' : '' }}
                                                            {{ $item->siang_pengganti == '1' ? 'Siang' : '' }}
                                                            {{ $item->malam_pengganti == '1' ? 'Malam' : '' }} --}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- @if ($item->status == 'diproses')
                                                            <div class="list-icons d-inline-flex">
                                                                <a href="javascript:void(0)"  data-id="{{ $item->id }}" class="list-icons-item me-10 editProduct text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Obat">
                                                                    <i class="fad fa-edit fs-20"></i>
                                                                </a>
                                                            </div>
                                                        @endif --}}
                                                        @if ($item->kunjungan->status_farmasi == 'diproses')
                                                            <div class="list-icons d-inline-flex">
                                                                <a href="javascript:void(0)"  data-id="{{ $item->id }}" class="list-icons-item me-10 editProduct text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Obat">
                                                                    <i class="fad fa-edit fs-20"></i>
                                                                </a>
                                                            </div>
                                                        {{-- @elseif ($item->kunjungan->status_farmasi == 'selesai')
                                                            @if ($item->status == 'belum')
                                                                <div class="list-icons d-inline-flex">
                                                                    <a href="javascript:void(0)"  data-id="{{ $item->id }}" class="list-icons-item me-10 editProduct text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Obat">
                                                                        <i class="fad fa-edit fs-20"></i>
                                                                    </a>
                                                                </div>
                                                            @endif --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            @if ($data->farmasi->status == 'selesai')
                                <a href="{{ route('admin.farmasi.index') }}" class="btn btn-success">KEMBALI</a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <x-modal_size size="">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Obat</label><br>
                    <select class="form-control" id="obat" name="obat" style="width:100%">
                        <option value="" selected>--Pilih--</option>
                        <option value="kosong">Kosongkan</option>
                        @foreach ($obat as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }} - (Stok : {{ $item->stok }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Jumlah Obat</label><br>
                    <input type="input" class="form-control" id="jumlah" name="jumlah" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Cara Pakai</label>
                    <input type="input" class="form-control" id="keterangan" name="keterangan">
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Cara Penggunaan</label><br>
                    <select class="form-control" id="cara_penggunaan" name="cara_penggunaan" style="width:100%">
                        <option value="sebelum_makan">Sebelum Makan</option>
                        <option value="sesudah_makan">Sesudah Makan</option>
                        <option value="lain">Lainnya</option>
                    </select>
                </div>
                <div class="form-group d-none" id="caraLainnya">
                    <label class="form-label">Ketik Disini</label>
                    <input type="input" class="form-control" id="cara_lainnya" name="cara_lainnya">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group pt-10">
                    <input type="checkbox" id="pagiTemp" class="filled-in chk-col-primary" />
                    <label for="pagiTemp" class="pe-50">Pagi</label>
                    <input type="checkbox" id="siangTemp" class="filled-in chk-col-warning" />
                    <label for="siangTemp" class="pe-50">Siang</label>
                    <input type="checkbox" id="malamTemp" class="filled-in chk-col-success" />
                    <label for="malamTemp">Malam</label>
                </div>
                <input type="hidden" id="pagi" name="pagi" value="0">
                <input type="hidden" id="siang" name="siang" value="0">
                <input type="hidden" id="malam" name="malam" value="0">
            </div> --}}
        </div>
    </x-modal_size>

    @push('script')
    <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
    <script src="{{ asset('template/js/pages/notification.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    {{-- <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script> --}}

        <script>
            $('#obat').select2();
            // $('.tblFarmasi').DataTable({})
            $(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $('body').on('click', '.editProduct', function (e) {
                var product_id = $(this).data('id');
                $('#headerModal').html("Ganti Obat");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $('#product_id').val(product_id);
                $('#obat').val('').trigger('change');
                $('#jumlah').val('');
                $('#keterangan').val('');
                $('#cara_penggunaan').val('sebelum_makan').trigger('change');
                $('#cara_lainnya').val('');
                $('#pagiTemp').prop('checked', false);
                $('#siangTemp').prop('checked', false);
                $('#malamTemp').prop('checked', false);
                $('#pagi').val('0');
                $('#siang').val('0');
                $('#malam').val('0');
                $('#caraLainnya').addClass('d-none');
            })

            $('body').on('click', '#btnProses', function(e) {
                let kunjungan = "{{ $data->id }}"
                $('#btnProses').attr('disabled', true);
                $('#btnProses').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $.ajax({
                    url: "{{ route('admin.ubah-farmasi.index') }}" + '/' + kunjungan,
                    type: "PUT",
                    dataType: 'json',
                    data : {
                        status_farmasi: 'diproses'
                    },
                    success: function (data) {
                        alertBerhasil('Farmasi akan diproses')
                        $('#btnProses').attr('disabled', false);
                        $('#btnProses').html('<i class="fal fa-user-clock"></i> PROSES')
                        window.location.reload()
                    },
                    error: function (data) {
                        alertGagal('Farmasi gagal diproses')
                        $('#btnProses').attr('disabled', false);
                        $('#btnProses').html('<i class="fal fa-user-clock"></i> PROSES')
                    }
                });
            })

            $('body').on('click', '#btnSelesai', function(e) {
                let kunjungan = "{{ $data->id }}";
                $('#btnSelesai').attr('disabled', true);
                $('#btnSelesai').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                swal({
                    title: "Apakah Anda Yakin ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Selesai!",
                    closeOnConfirm: false,
                    cancelButtonText: 'Batal',
                }, function() {
                    $.ajax({
                        url: "{{ route('admin.ubah-farmasi.index') }}" + '/' + kunjungan,
                        type: "PUT",
                        dataType: 'json',
                        data : {
                            status_farmasi: 'selesai'
                        },
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Diselesaikan", "success");
                            alertBerhasil('Proses farmasi telah selesai')
                            $('#btnSelesai').attr('disabled', false);
                            $('#btnSelesai').html('<i class="fal fa-check-circle"></i> SELESAI')
                            window.setTimeout( function() {
                                window.location.reload()
                            }, 1500);
                        },
                        error: function (data) {
                            alertGagal('Proses farmasi gagal diselesaikan')
                            $('#btnSelesai').attr('disabled', false);
                            $('#btnSelesai').html('<i class="fal fa-check-circle"></i> SELESAI')

                        }
                    });
                });
            })

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $('#saveBtn').prop('disabled', true)
                $('#saveBtn').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                if (cekFarmasi()){
                    $.ajax({
                        data: $('#formInput').serialize(),
                        url: "{{ route('admin.farmasi.index') }}" + '/' + 1,
                        type: "PUT",
                        dataType: 'html',
                        success: function (data) {
                            alertBerhasil('Data berhasil disimpan')
                            $('#formInput').trigger("reset");
                            $('#saveBtn').prop('disabled', false)
                            $('#saveBtn').html('Simpan')
                            $('#obat').val(null).trigger("reset");
                            $('#modalForm').modal('hide');
                            $('#tblRefresh').html(data)

                        },
                        error: function (data) {
                            alertGagal('Data gagal disimpan')
                            // alertGagal(data.responseText)
                            $('#saveBtn').html('Simpan');
                            $('#modalForm').modal('hide');
                        }
                    });
                } else {
                    $('#saveBtn').prop('disabled', false)
                    $('#saveBtn').html('Simpan')
                }
                // $('#saveBtn').prop('disabled', false)
            });

            function cekFarmasi(){
                let obat = $('#obat').val()
                let jumlah = $('#jumlah').val()
                let keterangan = $('#keterangan').val()
                let cara_penggunaan = $('#cara_penggunaan').val()
                let cara_lainnya = $('#cara_lainnya').val()
                let pagi = $('#pagi').val()
                let siang = $('#siang').val()
                let malam = $('#malam').val()

                if (obat == 'kosong'){
                    return true;
                } else {
                    if (obat == ''){
                        swal("Gagal !!", "Pilih Obat Terlebih Dahulu", "error");
                        return false;
                    } else if (jumlah == ''){
                        swal("Gagal !!", "Jumlah Obat Tidak Boleh Kosong", "error");
                        return false;
                    } else if (keterangan == ''){
                        swal("Gagal !!", "Cara Pakai Tidak Boleh Kosong", "error");
                        return false;
                    }
                    // else if (cara_penggunaan == 'lain' && cara_lainnya == ''){
                    //     swal("Gagal !!", "Ketik Cara Penggunaan Obat", "error");
                    //     return false;
                    // } else if (pagi == 0 && siang == 0 && malam == 0){
                    //     swal("Gagal !!", "Pilih Waktu Penggunaan Obat", "error");
                    //     return false;
                    // }
                    else {
                        return true;
                    }
                }
            }
            $('body').on('change', '#obat', function(){
                let obat = $(this).val()
                if (obat == 'kosong'){
                    $('#jumlah').val('')
                    $('#keterangan').val('')
                    $('#cara_penggunaan').val('sebelum_makan')
                    $('#cara_lainnya').val('')
                    $('#pagiTemp').prop('checked', false);
                    $('#siangTemp').prop('checked', false);
                    $('#malamTemp').prop('checked', false);
                    $('#pagi').val('0');
                    $('#siang').val('0');
                    $('#malam').val('0');
                    $('#caraLainnya').addClass('d-none');
                }

                // if (obat == ''){
                //     swal("Gagal !!", "Pilih Obat Terlebih Dahulu", "error");
                // } else {
                //     if (obat == 'kosong'){
                //         swal("Gagal !!", "Jumlah Obat Tidak Boleh Kosong", "error");
                //     } else {
                //         $.ajax({
                //             data: {
                //                 obat: obat,
                //                 jumlah: jumlah,
                //             },
                //             url: "{{ route('admin.obat.index') }}" + '/1',
                //             type: "GET",
                //             dataType: 'json',
                //             success: function (data) {
                //                 if (data == 0){
                //                     swal("Gagal !!", "Stok Obat Tidak Mencukupi", "error");
                //                     $('#jumlah').val('')
                //                     $('#jumlah').focus('')
                //                 }
                //             },
                //             error: function (data) {
                //                 console.log('Error cek obat');
                //             }
                //         });
                //     }
                // }
            })
            $('body').on('change', '#jumlah', function(){
                let jumlah = $(this).val()
                let obat = $('#obat').val()
                if (obat == ''){
                    swal("Gagal !!", "Pilih Obat Terlebih Dahulu", "error");
                } else {
                    // if (obat == 'kosong'){
                    //     swal("Gagal !!", "Jumlah Obat Tidak Boleh Kosong", "error");
                    // } else {
                        $.ajax({
                            data: {
                                obat: obat,
                                jumlah: jumlah,
                            },
                            url: "{{ route('admin.obat.index') }}" + '/1',
                            type: "GET",
                            dataType: 'json',
                            success: function (data) {
                                if (data == 0){
                                    swal("Gagal !!", "Stok Obat Tidak Mencukupi", "error");
                                    $('#jumlah').val('')
                                    $('#jumlah').focus('')
                                }
                            },
                            error: function (data) {
                                console.log('Error cek obat');
                            }
                        });
                    // }
                }
            })



            $('body').on('change', '#cara_penggunaan', function(e){
                let cara_penggunaan = $(this).val()
                if (cara_penggunaan == 'lain'){
                    $('#caraLainnya').removeClass('d-none')
                } else {
                    $('#caraLainnya').addClass('d-none')
                }
            })

            $('#pagiTemp').on('change', function(){
                if ($(this).is(':checked')) {
                    $('#pagi').val(1)
                } else {
                    $('#pagi').val(0)
                }
            });
            $('#siangTemp').on('change', function(){
                if ($(this).is(':checked')) {
                    $('#siang').val(1)
                } else {
                    $('#siang').val(0)
                }
            });
            $('#malamTemp').on('change', function(){
                if ($(this).is(':checked')) {
                    $('#malam').val(1)
                } else {
                    $('#malam').val(0)
                }
            });

        </script>
    @endpush
</x-layouts>
