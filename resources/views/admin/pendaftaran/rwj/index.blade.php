@section('title', 'Pasien')

<x-layouts>
    @push('style')
        <style>
            /* .select2-container{
                z-index:1061 !important;
            } */
        </style>
    @endpush
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Pendaftaran Rawat Jalan <i class="fas fa-hospital-user fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h4 class="box-title">Pencarian Pasien</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="tanggal" name="tanggal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" onClick="btnCari('find')" id="btnFind" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-search"></i> Cari</button>
                                        <button type="button" onClick="btnCari('today')" id="btnToday" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-calendar-day"></i> Hari ini</button>
                                        <button type="button" onClick="btnCari('before')" id="btnSebelumnya" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-circle-arrow-left"></i> Kemarin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12">
                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                            <div class="box-body">
                                <p class="fs-40 text-success">
                                    <strong>{{ $umum }}</strong>
                                </p>
                            </div>
                            <div class="box-body py-25 bg-success-light btsr-0 bter-0">
                                <p class="fw-600">
                                    <span class="fas fa-user-vneck-hair me-5 text-success fs-20"><span class="path1"></span><span class="path2"></span></span> PASIEN UMUM
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12">
                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                            <div class="box-body">
                                <p class="fs-40 text-danger">
                                    <strong>{{ $asuransi }}</strong>
                                </p>
                            </div>
                            <div class="box-body py-25 bg-danger-light btsr-0 bter-0">
                                <p class="fw-300">
                                    <span class="fas fa-user-shield me-5 text-danger fs-20"><span class="path1"></span><span class="path2"></span></span> PASIEN ASURANSI
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Pasien</h3>
                                <a href="{{ route('admin.rawat-jalan.create') }}" class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" width="100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th width="15%">No. Register</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="30%">Pasien</th>
                                            <th width="10%">Poliklinik</th>
                                            <th width="24%">Dokter</th>
                                            <th width="5%">Jaminan</th>
                                            <th class="text-center" width="5%">Action</th>
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

    <x-modal_size size="">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Poliklinik</label><br>
                    <select class="form-select" id="poliklinik" name="poliklinik">
                        <option value="" selected>--Pilih--</option>
                        @foreach ($poli as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">DPJP</label><br>
                    <select class="form-select" id="dokter" name="dokter">
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Jaminan</label><br>
                    <select class="form-select" id="jaminan" name="jaminan">
                        <option value="umum">UMUM</option>
                        <option value="asuransi">ASURANSI</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row d-none" id="asuransi">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Asuransi</label><br>
                    <select class="form-select" id="asuransi2" name="asuransi2">
                        @foreach ($dataAsuransi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">No. Kartu</label><br>
                    <input type="text" class="form-control" id="no_kartu" name="no_kartu" autocomplete="off">
                </div>
            </div>
            <input type="hidden" id="kdpasien" name="kdpasien">
        </div>
    </x-modal_size>

    @push('script')
    <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
    <script src="{{ asset('template/js/pages/notification.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

        <script>
            $('.dataServer').DataTable({
                'processing': true,
                'serverSide': true,
                'responsive': true,
                'ajax': "{{ route('admin.rawat-jalan.index') }}",
                'columns': [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                    {data: 'register', name: 'register', className: 'text-center'},
                    {data: 'tanggal', name: 'tanggal', className: 'text-center'},
                    {data: 'no_rm', name: 'no_rm', className: 'text-start'},
                    {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                    {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                    {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center text-uppercase'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                        className: 'text-center',
                    },
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "Tidak ada data pasien",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Menampilkan _MENU_ data",
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada data yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": '<i class="fa fa-angle-right"></i>',
                        "previous": '<i class="fa fa-angle-left"></i>',
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom naik",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom turun"
                    }
                }
            })
            .on( 'error.dt', function ( e, settings, techNote, message ) {
                window.location.reload();
            });
            $.fn.dataTable.ext.errMode = 'none';

            document.addEventListener("keydown", e => {
                if (e.key.toLowerCase() === 'f2'){
                    let link = "{{ route('admin.rawat-jalan.create') }}"
                    window.location.href = link;
                }
            })

            $('body').on('click', '.deletePendaftaran', function () {
                var id = $(this).data("id");
                swal({
                    title: "Yakin Ingin Menghapus ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false,
                    cancelButtonText: 'Batal',
                }, function() {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.rawat-jalan.store') }}" + '/' + id,
                        success: function (data) {
                            if (data == 'error'){
                                swal("Gagal", "Kunjungan Tidak Dapat Dihapus", "error");
                            } else {
                                $('.dataServer').DataTable().ajax.reload();
                                swal("Berhasil", "Kunjungan Berhasil Dihapus", "success");
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            function btnCari(status){
                let tanggal = '';
                if (status == 'find'){
                    tanggal = $('#tanggal').val();
                } else if (status == 'today'){
                    let today = new Date();
                    let dd = String(today.getDate()).padStart(2, '0');
                    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    let yyyy = today.getFullYear();
                    today = yyyy + '-' + mm + '-' + dd;
                    tanggal = today;
                } else if (status == 'before'){
                    let today = new Date();
                    let dd = String(today.getDate() - 1).padStart(2, '0');
                    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    let yyyy = today.getFullYear();
                    today = yyyy + '-' + mm + '-' + dd;
                    tanggal = today;
                }

                $('.dataServer').DataTable().clear().destroy();
                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.rawat-jalan.index') }}" + '/' + tanggal,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'register', name: 'register', className: 'text-center'},
                        {data: 'tanggal', name: 'tanggal', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-start'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center text-uppercase'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
                    language: {
                        "decimal": "",
                        "emptyTable": "Tidak ada data pasien",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Menampilkan _MENU_ data",
                        "loadingRecords": "Memuat...",
                        "processing": "Memproses...",
                        "search": "Cari:",
                        "zeroRecords": "Tidak ada data yang cocok",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": '<i class="fa fa-angle-right"></i>',
                            "previous": '<i class="fa fa-angle-left"></i>',
                        },
                        "aria": {
                            "sortAscending": ": aktifkan untuk mengurutkan kolom naik",
                            "sortDescending": ": aktifkan untuk mengurutkan kolom turun"
                        }
                    }
                });
            }

            $('body').on('click', '.copyrm', function () {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(this).text()).select();
                document.execCommand("copy");
                $temp.remove();
                $(this).attr('data-original-title', 'Copied!').tooltip('show');
            });

            $('body').on('click', '.editPendaftaran', function () {
                var id = $(this).data('id');
                $('#headerModal').html("Edit Pendaftaran");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.rawat-jalan.index') }}" + '/' + id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#poliklinik').val(data.poliklinik_id);
                        $('#jaminan').val(data.status_jaminan);
                        $('#kdpasien').val(data.pasien_id);
                        if (data.status_jaminan == 'umum'){
                            $('#asuransi').addClass('d-none');
                        } else {
                            $('#asuransi').removeClass('d-none');
                            getAsuransi()
                        }
                        getDokter(data.poliklinik_id);
                        window.setTimeout( function() {
                            $('#dokter').val(data.dokter_id);
                        }, 500);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            })

            $('#poliklinik').change(() => {
                let poli = $('#poliklinik').val()
                getDokter(poli);
            })

            getDokter = (poli) => {
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.dokter-rwj.index') }}" + '/' + poli,
                    success: function (data) {
                        $('#dokter').empty();
                        for (let i = 0; i < data.length; i++) {
                            $('#dokter').append(new Option(data[i].dokter.nama, data[i].dokter.id))
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

            $('#jaminan').change(() => {
                let jaminan = $('#jaminan').val()
                if (jaminan == 'umum'){
                    $('#asuransi').addClass('d-none');
                } else {
                    $('#asuransi').removeClass('d-none');
                    getAsuransi();
                }
            })

            $('#asuransi2').change(() => {
                getAsuransi();
            })

            getAsuransi = () => {
                let asuransi = $('#asuransi2').val()
                let pasien = $('#kdpasien').val()
                $.ajax({
                    url: "{{ route('admin.bpjs-pasien.index') }}" + '/1',
                    type: "PUT",
                    dataType: "JSON",
                    data: {
                        asuransi: asuransi,
                        pasien: pasien
                    },
                    success: function(result){
                        $('#no_kartu').val(result.nomor);
                        console.log(result);
                    }
                })
            }

            $('#saveBtn').click((e) => {
                e.preventDefault();
                $('#saveBtn').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#saveBtn').attr('disabled', true)
                let kunjungan = $('#product_id').val();

                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route('admin.ubah-rwj.index') }}" + '/' + kunjungan,
                    type: "PUT",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Data berhasil disimpan')
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                        $('#saveBtn').html('Simpan')
                        $('#saveBtn').attr('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Data gagal disimpan')
                        $('#saveBtn').html('Simpan')
                        $('#saveBtn').attr('disabled', false)
                    }
                });
            })

        </script>
    @endpush
</x-layouts>
