@section('title', 'Pekerjaan')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Pekerjaan"
                title2="Master"
                title3="Pekerjaan"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Data Pekerjaan <i class="fad fa-briefcase"></i></h3>
                                <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Nama Hak Akses</th>
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

    <x-modal>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Nama Pekerjaan</label><br>
                    <input type="text" class="form-control" id="nama" name="nama">
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
                    'ajax': "{{ route('admin.pekerjaan.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'nama_pekerjaan', name: 'nama_pekerjaan', className: 'text-uppercase'},
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

            $('#add').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Pekerjaan");
                $('#modalForm').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Pekerjaan");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.pekerjaan.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#nama').val(data.nama_pekerjaan);
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
                    url: "{{ route('admin.pekerjaan.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Pekerjaan berhasil ditambah')
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertGagal('Pekerjaan gagal ditambah')
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
                        url: "{{ route('admin.pekerjaan.store') }}" + '/' + id,
                        success: function (data) {
                            if (data.status == 200){
                                swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                                $('.dataServer').DataTable().ajax.reload();
                            } else {
                                swal("Gagal !!", data.message, "error");
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
