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
                        <h3 class="page-title">Riwayat Pasien <i class="fad fa-laptop-medical"></i></h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
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
                                            <th>No. RM</th>
                                            <th>Data Diri</th>
                                            <th>Sex</th>
                                            <th>Usia</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
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
                    'ajax': "{{ route('admin.riwayat-kunjungan.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'pasien.id', className:'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                        {data: 'nama', name: 'nama'},
                        {data: 'gender_id', name: 'gender_id', className: 'text-center'},
                        {data: 'tgl_lahir', name: 'tgl_lahir', className: 'text-center'},
                        {data: 'phone', name: 'phone', className: 'text-center'},
                        {data: 'alamat', name: 'alamat', className: 'text-capitalize'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
                });
            });

            $('body').on('click', '#btnFind', function(e){
                let tanggal = $('#tanggal').val()
                $('.dataServer').DataTable().clear().destroy();
                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.riwayat-kunjungan.index') }}" + '/' + tanggal + '/edit',
                    'columns': [
                        {data: 'DT_RowIndex', name: 'kunjungan.id', className:'text-center'},
                        {data: 'register', name: 'register', className: 'text-center'},
                        {data: 'tanggal', name: 'tanggal', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-center'},
                        {data: 'tgl_lahir', name: 'tgl_lahir', className: 'text-center'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id', className: 'text-center'},
                        {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center text-uppercase'},
                        {data: 'status_pasien', name: 'status_pasien'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
                });
            })
        </script>
    @endpush
</x-layouts>
