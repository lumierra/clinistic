@section('title', 'Layanan RWJ')

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
                        <h3 class="page-title">Pelayanan Rawat Jalan <i class="fas fa-display-medical fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
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
                                <p class="fs-40 text-danger">
                                    <strong>{{ $belum }}</strong>
                                </p>
                            </div>
                            <div class="box-body py-25 bg-danger-light btsr-0 bter-0">
                                <p class="fw-600">
                                    <span class="fas fa-user-times me-5 text-danger fs-20"><span class="path1"></span><span class="path2"></span></span> BELUM DILAYANI
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12">
                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                            <div class="box-body">
                                <p class="fs-40 text-warning">
                                    <strong>{{ $diproses }}</strong>
                                </p>
                            </div>
                            <div class="box-body py-25 bg-warning-light btsr-0 bter-0">
                                <p class="fw-300">
                                    <span class="fas fa-user-clock me-5 text-warning fs-20"><span class="path1"></span><span class="path2"></span></span> SEDANG DILAYANI
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12">
                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                            <div class="box-body">
                                <p class="fs-40 text-success">
                                    <strong>{{ $dilayani }}</strong>
                                </p>
                            </div>
                            <div class="box-body py-25 bg-success-light btsr-0 bter-0">
                                <p class="fw-600">
                                    <span class="fas fa-user-check me-5 text-success fs-20"><span class="path1"></span><span class="path2"></span></span> SUDAH DILAYANI
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Pasien</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" width="100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th width="15%">No. Register</th>
                                            <th width="1%">Tanggal</th>
                                            <th width="30%">Pasien</th>
                                            <th width="1%">Poli</th>
                                            <th width="25%">Dokter</th>
                                            <th width="1%">Jaminan</th>
                                            <th width="20%">Status</th>
                                            <th class="text-center" width="1%">Action</th>
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

                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.layanan-rwj.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'register', name: 'register', className: 'text-center'},
                        {data: 'tanggal', name: 'tanggal', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-start'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center'},
                        {data: 'status_pasien', name: 'status_pasien'},
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
                        "emptyTable": "Tidak ada data pelayanan",
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
                    'ajax': "{{ route('admin.layanan-rwj.index') }}" + '/' + tanggal + '/edit',
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'register', name: 'register', className: 'text-center'},
                        {data: 'tanggal', name: 'tanggal', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-start'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center'},
                        {data: 'status_pasien', name: 'status_pasien'},
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
                        "emptyTable": "Tidak ada data pelayanan",
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
        </script>
    @endpush
</x-layouts>
