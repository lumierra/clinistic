@section('title', 'Permintaan Laboratorium')

<x-layouts>
    @push('style')
    <style>
        /* .select2-container{
                z-index:1061 !important;
            } */
        .brd {
            border-radius: 30px;
        }
    </style>
    @endpush
    <div class="content-wrapper" id="fullRefresh">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Proses Permintaan Laboratorium</h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="box">
                            <div class="text-white box-body bg-img text-center py-50 bg-danger" data-overlay="5">
                                <a href="#">
                                    <img class="avatar avatar-xxl rounded-circle bg-warning-light"
                                        src="{{ asset('template/images/avatar/avatar-16.png') }}" alt="">
                                </a>
                                <h5 class="mt-2 mb-0"><a class="text-white" href="#">{{ $data->pasien->nama ?? '' }}</a>
                                </h5>
                                <span>{{ $data->pasien->no_rm }}</span> <br>
                                <span>{{ $data->pasien->alamat ?? '' }}</span>
                            </div>
                            <ul class="flexbox flex-justified text-center p-20">
                                <li>
                                    <span class="text-muted fw-bolder">No. Order</span><br>
                                    <span class="fs-20 btn btn-danger btn-sm rounded-pill">{{ $data->lab2->kd_lab
                                        }}</span>
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
                                        @if ($data->lab2->status == 'belum')
                                            <span class="btn btn-sm btn-warning">BELUM DIPROSES</span>
                                        @elseif ($data->lab2->status == 'diproses')
                                            <span class="btn btn-sm btn-primary">DALAM PROSES</span>
                                        @else
                                            <span class="btn btn-sm btn-success">SELESAI</span>
                                        @endif
                                    </span>
                                </li>
                                <li class="be-1 bs-1">
                                    <span class="text-muted fw-bolder">Jaminan</span><br>
                                    <span class="fs-20">{{ $data->status_jaminan == 'umum' ? 'UMUM' :
                                        $data->asuransi->nama }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="box box-solid bg-danger bb-3 border-danger">
                            <div class="box-header with-border bg-danger">
                                <i class="fad fa-flask-vial fs-50"></i>
                                <h3 class="box-title align-top">Data Order Laboratorium </h3>
                                @if ($data->lab2->status == 'belum')
                                    <button
                                        class="waves-effect waves-light btn btn-danger-light btn-rounded btn-social btn-bitbucket mb-5 float-end"
                                        id="btnProses">
                                        <i class="fal fa-user-clock"></i> PROSES
                                    </button>
                                @endif
                                @if ($data->lab2->status == 'diproses')
                                    <button
                                        class="waves-effect waves-light btn btn-danger-light btn-rounded btn-social btn-bitbucket mb-5 float-end"
                                        id="btnSelesai">
                                        <i class="fal fa-check-circle"></i> SELESAI
                                    </button>
                                @endif
                                @if ($data->lab2->status == 'selesai')
                                    <a href="{{ env('APP_URL').'/layanan/hasil_lab/'.$data->lab2->kd_lab }}" target="_blank"
                                        class="waves-effect waves-light btn btn-danger-light btn-rounded btn-social btn-bitbucket mb-5 float-end"
                                        id="btnCetak">
                                        <i class="fal fa-print"></i> CETAK HASIL
                                    </a>
                                @endif
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="box">
                                            <form class="form" id="formInputHasil">
                                                <div class="box-body" id="bodyHasilLab">
                                                    <h4 class="box-title text-dark mb-0"><i class="fal fa-file-medical"></i><i class="fal fa-flask"></i> Input Hasil Lab</h4>
                                                    <hr class="my-15">
                                                    @foreach ($data->labs as $item)
                                                    {{-- $item->produk_lab_id == 3 ||  --}}
                                                        @if (Str::contains($item->produk->nama, 'SWAB'))
                                                            <div class="form-group">
                                                                <label for="">{{ $item->produk->nama }}</label>
                                                                <select {{ $item->status == 'belum' ? 'disabled' : '' }} {{ $item->status == 'selesai' ? 'disabled' : '' }} class="form-select" id="lab{{ $item->id }}" name="lab{{ $item->id }}">
                                                                    <option value="1" {{ $item->hasil->hasil == '' ? '' : 'selected' }}>Positif</option>
                                                                    <option value="2" {{ $item->hasil->hasil == '' ? '' : 'selected' }}>Negatif</option>
                                                                </select>
                                                            </div>
                                                            @if ($data->lab->status == 'selesai')
                                                                <a href="{{ env('APP_URL').'/layanan/surat_lab/'.$item->id }}" target="_blank" class="btn btn-dark"><i class="fas fa-print"></i>Cetak</a>
                                                            @endif
                                                        @else
                                                        <div class="form-group">
                                                            <label class="form-label">{{ $item->produk->nama }}</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fas fa-square-list"></i></span>
                                                                <input value="{{ $item->hasil->hasil ?? '' }}" {{ $item->status == 'belum' || $item->status == 'selesai' ? 'disabled' : '' }} type="text" class="form-control" id="lab{{ $item->id }}" name="lab{{ $item->id }}" data-id="{{ $item->id }}" placeholder="Input Hasil {{ $item->produk->nama }}">
                                                                <span class="input-group-addon">{{ $item->produk->satuan->nama_satuan ?? '' }}</span>
                                                                <span class="input-group-addon">{{ $item->produk->nilai_rujukan ?? '' }}</span>
                                                            </div>
                                                            {{-- <textarea {{
                                                                $item->status == 'belum' ? 'disabled' : '' }} {{ $item->status == 'selesai' ? 'disabled' : '' }} rows="5" id="lab{{ $item->id }}" name="lab{{ $item->id }}" data-id="{{ $item->id }}" class="form-control" placeholder="Input Hasil {{ $item->produk->nama }}">{{ $item->hasil->hasil ?? '' }}</textarea>
                                                            --}}
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="box-footer">
                                                    @if ($data->lab->status == 'diproses')
                                                    <button type="button" class="btn btn-primary btn-rounded float-end mb-10" id="saveBtn"> <i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> Simpan
                                                    </button>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="kd_lab" name="kd_lab"
                                                    value="{{ $data->lab->kd_lab }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @if ($data->status_lab == 'selesai')
                                @can('SAD')
                                    <button class="btn btn-dark float-end" id="btn-edit"><i class="fad fa-pen-to-square"></i> EDIT</button>
                                @endcan
                                <a href="{{ route('admin.lab.index') }}" class="btn btn-success float-end me-1"><i class="fad fa-circle-arrow-left"></i> KEMBALI</a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @push('script')
    <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
    <script src="{{ asset('template/js/pages/notification.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        $(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            // BUTTON PROSES
            $('body').on('click', '#btnProses', function(e) {
                let kunjungan = "{{ $data->id }}"
                $('#btnProses').attr('disabled', true);
                $('#btnProses').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $.ajax({
                    url: "{{ route('admin.ubah-lab.index') }}" + '/' + kunjungan,
                    type: "PUT",
                    dataType: 'json',
                    data : {
                        status_lab: 'diproses'
                    },
                    success: function (data) {
                        alertBerhasil('Lab akan diproses')
                        $('#btnProses').attr('disabled', false);
                        $('#btnProses').html('<i class="fal fa-user-clock"></i> PROSES')
                        window.setTimeout( function() {
                            window.location.reload()
                        }, 1500);
                    },
                    error: function (data) {
                        alertGagal('Lab gagal diproses')
                        $('#btnProses').attr('disabled', false);
                        $('#btnProses').html('<i class="fal fa-user-clock"></i> PROSES')
                    }
                });
            })

            // BUTTON SELESAI
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
                        url: "{{ route('admin.ubah-lab.index') }}" + '/' + kunjungan,
                        type: "PUT",
                        dataType: 'json',
                        data : {
                            status_lab: 'selesai'
                        },
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Diselesaikan", "success");
                            alertBerhasil('Proses lab telah selesai')
                            $('#btnSelesai').attr('disabled', false);
                            $('#btnSelesai').html('<i class="fal fa-check-circle"></i> SELESAI')
                            window.setTimeout( function() {
                                window.location.reload()
                            }, 1500);
                        },
                        error: function (data) {
                            alertGagal('Proses lab gagal diselesaikan')
                            $('#btnSelesai').attr('disabled', false);
                            $('#btnSelesai').html('<i class="fal fa-check-circle"></i> SELESAI')

                        }
                    });
                });
            })

            // BUTTON SIMPAN
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $('#saveBtn').prop('disabled', true)
                $('#saveBtn').html('<i class="fa fa-spinner fa-spin"></i> Loading')

                $.ajax({
                    data: {
                        kunjungan: "{{ $data->id }}"
                    },
                    url: "{{ route('admin.ubah-lab.create') }}",
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        let status = false;
                        for (let item of data) {
                            window['lab'+item.no] = $('#lab'+item.no).val();
                            if (window['lab'+item.no] == '') {
                                alertGagal(`HASIL ${item.nama} BELUM DI INPUT`)
                                $('#saveBtn').prop('disabled', false)
                                $('#saveBtn').html('<i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> Simpan')
                                status = false;
                                return false;
                            } else {
                                status = true;
                            }
                        }
                        if (status == true) {
                            $.ajax({
                                data: $('#formInputHasil').serialize(),
                                url: "{{ route('admin.hasil-lab.index') }}" + '/1',
                                type: "PUT",
                                dataType: 'html',
                                success: function (data) {
                                    alertBerhasil('Data berhasil disimpan')
                                    $('#saveBtn').prop('disabled', false)
                                    $('#saveBtn').html('<i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> Simpan')
                                },
                                error: function (data) {
                                    alertGagal('Data gagal disimpan')
                                    $('#saveBtn').prop('disabled', false)
                                    $('#saveBtn').html('<i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> Simpan')
                                }
                            });
                        }
                    },
                    error: function (data) {
                        $('#saveBtn').prop('disabled', false)
                        $('#saveBtn').html('<i class="fa-solid fa-floppy-disk-circle-arrow-right"></i> Simpan')
                    }
                });
            });

            // BUTTON EDIT
            $('#btn-edit').click(() => {
                let kunjungan = "{{ $data->id }}"
                $('#btn-edit').attr('disabled', true);
                $('#btn-edit').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $.ajax({
                    url: "{{ route('admin.ubah-lab.index') }}" + '/' + kunjungan,
                    type: "PUT",
                    dataType: 'json',
                    data : {
                        status_lab: 'diproses'
                    },
                    success: function (data) {
                        alertBerhasil('Lab akan diedit')
                        window.setTimeout( function() {
                            window.location.reload()
                        }, 1500);
                    },
                    error: function (data) {
                        alertGagal('Lab gagal diedit')
                    }
                });
            })
    </script>
    @endpush
</x-layouts>
