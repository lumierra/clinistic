@section('title', 'Permintaan Radiologi')

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
                        <h3 class="page-title">Proses Permintaan Radiologi</h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="box">
                            <div class="text-white box-body bg-img text-center py-50 bg-dark" data-overlay="5">
                                <a href="#">
                                <img class="avatar avatar-xxl rounded-circle bg-warning-light" src="{{ asset('template/images/avatar/avatar-16.png') }}" alt="">
                                </a>
                                <h5 class="mt-2 mb-0"><a class="text-white" href="#">{{ $data->pasien->nama ?? '' }}</a></h5>
                                <span>{{ $data->pasien->no_rm }}</span>
                            </div>
                            <ul class="flexbox flex-justified text-center p-20">
                                <li>
                                    <span class="text-muted fw-bolder">No. Order</span><br>
                                    <span class="fs-20 badge badge-dark badge-sm rounded-pill">{{ $data->radiologi->kd_rad }}</span>
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
                                        @if ($data->radiologi->status == 'belum')
                                            <span class="btn btn-sm btn-warning">BELUM DIPROSES</span>
                                        @elseif ($data->radiologi->status == 'diproses')
                                            <span class="btn btn-sm btn-primary">SEDANG DIPROSES</span>
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
                            <div class="box-header with-border bg-dark">
                                <i class="fad fa-x-ray fs-50"></i>
                                <h3 class="box-title align-top">Data Order Radiologi </h3>
                                @if ($data->radiologi->status == 'belum')
                                    <button class="waves-effect waves-light btn btn-dark-light btn-rounded btn-social btn-bitbucket mb-5 float-end" id="btnProses">
                                        <i class="fal fa-user-clock"></i> PROSES
                                    </button>
                                @endif
                                @if ($data->radiologi->status == 'diproses')
                                    <button class="waves-effect waves-light btn btn-dark-light btn-rounded btn-social btn-bitbucket mb-5 float-end" id="btnSelesai">
                                        <i class="fal fa-check-circle"></i> SELESAI
                                    </button>
                                @endif
                                @if ($data->radiologi->status == 'selesai')
                                    <a href="{{ env('APP_URL').'/layanan/hasil_radiologi/'.$data->radiologi->id }}" target="_blank" class="waves-effect waves-light btn btn-dark-light btn-rounded btn-social btn-bitbucket mb-5 float-end" id="btnCetak">
                                        <i class="fal fa-receipt"></i> CETAK HASIL
                                    </a>
                                @endif
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="box">
                                            <form class="form" id="formInputHasil">
                                                <div class="box-body" id="bodyHasilRad">
                                                    <h4 class="box-title text-info mb-0"><i class="fal fa-file-medical"></i><i class="fal fa-x-ray"></i> Input Hasil Radiologi</h4>
                                                    <hr class="my-15">
                                                    @foreach ($data->radiologis as $item)
                                                        <div class="mb-3 form-group {{ $item->hasil->hasil_foto == '' ? '' : 'has-success' }}">
                                                            <label for="rad{{ $item->id }}" class="form-label">Upload Hasil (Gambar) {{ $item->hasil->hasil_foto == '' ? '' : 'Uploaded' }}</label>
                                                            <input {{ $item->status == 'belum' ? 'disabled' : '' }} {{ $item->status == 'selesai' ? 'disabled' : '' }} class="form-control" type="file" id="rad{{ $item->id }}" name="rad{{ $item->id }}">
                                                        </div>
                                                        @if ($item->hasil->hasil_foto != null)
                                                            <div class="mb-3">
                                                                <a href="{{ asset($item->hasil->hasil_foto) }}" target="_blank">
                                                                    <img class="img-fluid" src="{{ asset($item->hasil->hasil_foto) }}" style="width:80%">
                                                                </a>
                                                            </div>
                                                        @endif

                                                        <div class="form-group">
                                                            <label class="form-label">{{ $item->produk->nama }}</label>
                                                            <textarea {{ $item->status == 'belum' ? 'disabled' : '' }} {{ $item->status == 'selesai' ? 'disabled' : '' }} rows="5" id="radhasil{{ $item->id }}" name="radhasil{{ $item->id }}" data-id="{{ $item->id }}" class="form-control" placeholder="Input Hasil {{ $item->produk->nama }}">{{ $item->hasil->hasil ?? '' }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="box-footer">
                                                    @if ($data->radiologi->status == 'diproses')
                                                        <button type="button" class="btn btn-primary btn-rounded" id="saveBtn">
                                                            <i class="fal fa-save"></i> Simpan
                                                        </button>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="kd_rad" name="kd_rad" value="{{ $data->radiologi->kd_rad }}">
                                            </form>
                                        </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            @if ($data->status_radiologi == 'selesai')
                                <a href="{{ route('admin.radiologi.index') }}" class="btn btn-success">KEMBALI</a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- <x-modal_size
        size="modal-lg"
    >
        <div id="modal-body">

        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Nama Pemeriksaan</label>
                    <input disabled type="input" class="form-control" id="nama_pemeriksaan" name="nama_pemeriksaan">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Hasil</label>
                    <textarea class="form-control" id="hasil" name="hasil" rows="3"></textarea>
                </div>
            </div>
        </div>

        <input type="hidden" id="pemeriksaanID" name="pemeriksaanID" value="">
        <input type="hidden" id="pemeriksaanNama" name="pemeriksaanNama" value="">

    </x-modal_size> --}}

    @push('script')
    <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
    <script src="{{ asset('template/js/pages/notification.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    {{-- <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script> --}}

        <script>
            $(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $('body').on('click', '#btnProses', function(e) {
                let kunjungan = "{{ $data->id }}"
                $('#btnProses').attr('disabled', true)
                $('#btnProses').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $.ajax({
                    url: "{{ route('admin.ubah-radiologi.index') }}" + '/' + kunjungan,
                    type: "PUT",
                    dataType: 'json',
                    data : {
                        status_rad: 'diproses'
                    },
                    success: function (data) {
                        alertBerhasil('Radiologi akan diproses')
                        $('#btnProses').attr('disabled', false)
                        $('#btnProses').html('<i class="fal fa-user-clock"></i> PROSES')
                        window.setTimeout( function() {
                            window.location.reload()
                        }, 1500);
                    },
                    error: function (data) {
                        alertGagal('Radiologi gagal diproses')
                        $('#btnProses').attr('disabled', false)
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
                        url: "{{ route('admin.ubah-radiologi.index') }}" + '/' + kunjungan,
                        type: "PUT",
                        dataType: 'json',
                        data : {
                            status_rad: 'selesai'
                        },
                        success: function (data) {
                            swal("Berhasil !!", "Proses radiologi telah selesai", "success");
                            alertBerhasil('Proses radiologi telah selesai')
                            $('#btnSelesai').attr('disabled', false);
                            $('#btnSelesai').html('<i class="fal fa-check-circle"></i> SELESAI')
                            window.setTimeout( function() {
                                window.location.reload()
                            }, 1500);
                        },
                        error: function (data) {
                            alertGagal('Radioilogi gagal diselesaikan')
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
                // $(this).html('Simpan');
                var formData = new FormData($('#formInputHasil')[0]);
                $.ajax({
                    data: formData,
                    url: "{{ route('admin.hasil-radiologi.store') }}",
                    type: "POST",
                    // dataType: 'html',
                    enctype: 'multipart/form-data',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        alertBerhasil('Data berhasil disimpan')
                        $('#saveBtn').prop('disabled', false)
                        $('#saveBtn').html('<i class="fal fa-save"></i> Simpan')
                    },
                    error: function (data) {
                        alertGagal('Data gagal disimpan')
                        $('#saveBtn').prop('disabled', false)
                        $('#saveBtn').html('<i class="fal fa-save"></i> Simpan')
                    }
                });
            });


            // TIDAK DI PAKAI
            $('body').on('click', '.editProduct', function (e) {
                var product_id = $(this).data('id');
                var nama = $(this).data('nama');
                $('#headerModal').html('Input Hasil ' + nama);
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $('#product_id').val(product_id);
                $('#saveBtn').prop('disabled', true);
                $.ajax({
                    url: "{{ route('admin.ubah-radiologi.index') }}" + '/' + product_id,
                    type: "GET",
                    dataType: 'html',
                    success: function (data) {
                        $('#modal-body').html(data)
                        $('#nama_pemeriksaan').val('')
                        $('#hasil').val('')
                        $('#pemeriksaanID').val('')
                        $('#pemeriksaanNama').val('')
                        $('#hasil').val('')
                    },
                    error: function (data) {
                        // alertDanger()
                    }
                });
            })

            $('body').on('click', '.editPemeriksaan', function(e) {
                let id = $(this).data('id');
                let pemeriksaan = $(this).data('pemeriksaan');
                let nama = $(this).data('nama');
                let hasil = $(this).data('hasil');
                $('#pemeriksaanID').val(id);
                $('#pemeriksaanNama').val(nama);
                $('#nama_pemeriksaan').val(pemeriksaan);
                $('#hasil').val(hasil);
                $('#saveBtn').prop('disabled', false);
            })

        </script>
    @endpush
</x-layouts>
