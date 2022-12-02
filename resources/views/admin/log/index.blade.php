@section('title', 'Pasien')

<x-layouts>
    @push('style')
        <style>
            .modal-dialog{
                overflow-y: initial !important
            }
            .modal-body{
                height: 450px;
                overflow-y: auto;
            }
            .modal-lg2 {
                max-width: 90% !important;
            }
            .mfp-bg {
                z-index: 10005 !important;
            }
            .mfp-wrap {
                z-index: 10006 !important;
            }
        </style>
    @endpush
    <div class="content-wrapper">
        <div class="container-full">

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data Log Aktifitas <i class="fal fa-user-secret fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h4>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data Log Aktifitas <i class="fal fa-user-secret fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" width="100%">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-center" width="1%">No</th>
                                                <th width="20%">Tanggal & Jam</th>
                                                <th width="70%">Keterangan</th>
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

        <script>
            $('.dataServer').DataTable({
                'processing': true,
                'serverSide': true,
                'responsive': true,
                'ajax': "{{ route('admin.log.index') }}",
                'columns': [
                    {data: 'DT_RowIndex', name: 'log_aktifitas.id', className:'text-center'},
                    {data: 'tanggal', name: 'tanggal', className: 'text-center'},
                    {data: 'keterangan', name: 'keterangan', className: 'text-start'},
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
                    "emptyTable": "Tidak ada data log aktifitas",
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

            $('body').on('click', '.deleteProduct', function () {
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
                        url: "{{ route('admin.log.store') }}" + '/' + id,
                        success: function (data) {
                            swal("Berhasil !!", "Log Berhasil Dihapus", "success");
                            $('.dataServer').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            swal("Gagal !!", "Log Gagal Dihapus", "error");
                            console.log('Error:', data);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts>
