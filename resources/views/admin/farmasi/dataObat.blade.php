@section('title', 'Data Obat')

<x-layouts>
    @push('style')
        <style>
            .select2-container{
                z-index: 10 !important;
            }
        </style>
    @endpush
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Data Obat <i class="fas fa-pills fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h4 class="box-title">Pencarian Berdasarkan Kategori</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <select class="form-select" id="kategori_obat">
                                                <option disabled selected>--Pilih Kategori Obat--</option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_kategori ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Obat</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th width="20%">Kategori</th>
                                            <th width="40%">Nama</th>
                                            <th width="15%">Satuan</th>
                                            <th width="10%">Stok</th>
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

        <script>
            $('#kategori_obat').select2();
            $(function () {

                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': false,
                    'responsive': true,
                    'ajax': "{{ route('admin.data-obat.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kategori_obat_id', name: 'kategori_obat_id', className: 'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'satuan_id', name: 'satuan_id', className: 'text-center'},
                        {data: 'stok', name: 'stok', className: 'text-center'},
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 25,
                    language: {
                        "decimal": "",
                        "emptyTable": "Tidak ada data obat",
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

            $('#kategori_obat').change(() => {
                let kategori = $('#kategori_obat').val()
                $('.dataServer').DataTable().clear().destroy();
                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': false,
                    'responsive': true,
                    'ajax': "{{ route('admin.data-obat.index') }}" + '/' + kategori,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'obat.id', className:'text-center'},
                        {data: 'kategori_obat_id', name: 'kategori_obat_id', className: 'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'satuan_id', name: 'satuan_id', className: 'text-center'},
                        {data: 'stok', name: 'stok', className: 'text-center'},
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 25,
                    language: {
                        "decimal": "",
                        "emptyTable": "Tidak ada data obat",
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
            })
        </script>
    @endpush
</x-layouts>
