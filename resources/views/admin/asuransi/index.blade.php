@section('title', 'Asuransi')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Asuransi"
                title2="Master"
                title3="Asuransi"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Asuransi <i class="fad fa-address-card fs-30"></i></h3>
                                <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Nama Asuransi</th>
                                            <th>Keterangan</th>
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

    <x-modal>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Nama Asuransi</label><br>
                    <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Keterangan</label><br>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off" required>
                </div>
            </div>
        </div>
    </x-modal>

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

                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.asuransi.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-uppercase'},
                        {data: 'keterangan', name: 'keterangan', className: 'text-capitalize'},
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
                        "emptyTable": "Tidak ada data asuransi",
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

            $('#add').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Asuransi");
                $('#modalForm').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Kategori");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.asuransi.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#nama').val(data.nama);
                        $('#keterangan').val(data.keterangan);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $('#saveBtn').prop('disabled', true)
                $(this).html('Simpan');

                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route('admin.asuransi.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertSucces()
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertDanger()
                        $('#saveBtn').html('Simpan');
                    }
                });
                $('#saveBtn').prop('disabled', false)
            });

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
                        url: "{{ route('admin.asuransi.store') }}" + '/' + id,
                        success: function (data) {
                            if (data.status == 200){
                                swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                                $('.dataServer').DataTable().ajax.reload();
                            } else {
                                swal("Gagal !!", data.error, "error");
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

        </script>
    @endpush
</x-layouts>
