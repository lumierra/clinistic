@section('title', 'Pelayanan Farmasi')

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
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Pelayanan Farmasi <i class="fas fa-pills fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h4 class="box-title">Pencarian Farmasi</h4>
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
                                    <div class="col-md-12">
                                        <button type="button" onClick="btnCari('find')" id="btnFind" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-search"></i> Cari</button>
                                        <button type="button" onClick="btnCari('today')" id="btnToday" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-calendar-day"></i> Hari ini</button>
                                        <button type="button" onClick="btnCari('before')" id="btnSebelumnya" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-circle-arrow-left"></i> Sebelumnya</button>
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
                                    <span class="fas fa-user-times me-5 text-danger fs-20"><span class="path1"></span><span class="path2"></span></span> BELUM DIPROSES
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
                                    <span class="fas fa-user-clock me-5 text-warning fs-15"><span class="path1"></span><span class="path2"></span></span> SEDANG DIPROSES
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12">
                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                            <div class="box-body">
                                <p class="fs-40 text-success">
                                    <strong>{{ $selesai }}</strong>
                                </p>
                            </div>
                            <div class="box-body py-25 bg-success-light btsr-0 bter-0">
                                <p class="fw-600">
                                    <span class="fas fa-user-check me-5 text-success fs-20"><span class="path1"></span><span class="path2"></span></span> SUDAH DIPROSES
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Order Farmasi</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th width="20%">Kode Order</th>
                                            <th width="10%">Tgl. Order</th>
                                            <th width="30%">Pasien</th>
                                            <th width="1%">Poli</th>
                                            <th width="20%">Dokter</th>
                                            <th width="1%">Status</th>
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

    <x-modal_size size="modal-lg">

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
                    'ajax': "{{ route('admin.farmasi.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kd_farmasi', name: 'kd_farmasi', className: 'text-center'},
                        {data: 'tgl_order', name: 'tgl_order', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-start'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status', name: 'status', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data order farmasi",
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

            function counting(){
                $('#belum').each(function () {
                    var $this = $(this);
                    jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                        duration: 1500,
                        easing: 'swing',
                        step: function () {
                        $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
                $('#diproses').each(function () {
                    var $this = $(this);
                    jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                        duration: 1500,
                        easing: 'swing',
                        step: function () {
                        $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
                $('#selesai').each(function () {
                    var $this = $(this);
                    jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                        duration: 1500,
                        easing: 'swing',
                        step: function () {
                        $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
                $('#batal').each(function () {
                    var $this = $(this);
                    jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                        duration: 1500,
                        easing: 'swing',
                        step: function () {
                        $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
            }
            counting()

            $('#status').click(function(){
                let status = $(this).data('status');
            });

            function myStatus(status){
                $('.dataServer').DataTable().clear().destroy();
                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'ajax': "{{ route('admin.ubah-farmasi.index') }}" + '/' + status,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kd_farmasi', name: 'kd_farmasi', className: 'text-center'},
                        {data: 'tgl_order', name: 'tgl_order', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-center'},
                        {data: 'tgl_lahir', name: 'tgl_lahir', className: 'text-center'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status', name: 'status', className: 'text-center'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
                });
            }

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
                    'ajax': "{{ route('admin.ubah-farmasi.index') }}" + '/' + tanggal + '/edit',
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kd_farmasi', name: 'kd_farmasi', className: 'text-center'},
                        {data: 'tgl_order', name: 'tgl_order', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-start'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status', name: 'status', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data order farmasi",
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
