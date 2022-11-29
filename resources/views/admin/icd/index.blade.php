@section('title', 'Data ICD 10')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Data ICD 10"
                title2="Klinik"
                title3="Data ICD 10"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data ICD 10 <i class="fad fa-diagnoses"></i></h4>
                                <button class="box-title d-inline d-sm-none btn-sm waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data ICD 10 <i class="fad fa-diagnoses fs-20"></i></h3>
                                <button class="d-none d-md-inline d-sm-none waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addDekstop">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
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
                    <label class="form-label">Kode ICD</label><br>
                    <input type="text" class="form-control" id="kode" name="kode" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Nama ICD</label><br>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Deskripsi</label><br>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" autocomplete="off" required>
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
        // $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dataServer').DataTable({
                'processing': true,
                'serverSide': true,
                'responsive': true,
                'ajax': "{{ route('admin.data-icd.index') }}",
                'columns': [
                    {data: 'DT_RowIndex', name: 'icd.id', className:'text-center'},
                    {data: 'kode', name: 'kode', className: 'text-center'},
                    {data: 'nama', name: 'nama', className: 'text-capitalize'},
                    {data: 'deskripsi', name: 'deskripsi', className: 'text-center'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                        className: 'text-center',
                    },
                ],
                pageLength: 25,
                language: {
                    "decimal": "",
                    "emptyTable": "Tidak ada data icd 10",
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
                // window.location.reload();
            });
            // $.fn.dataTable.ext.errMode = 'none';
        // });

        $('#add').click(function () {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#formInput').trigger("reset");
            $('#headerModal').html("Tambah ICD 10");
            $('#modalForm').modal('show');
        });
        $('#addDekstop').click(function () {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#formInput').trigger("reset");
            $('#headerModal').html("Tambah ICD 10");
            $('#modalForm').modal('show');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $('#headerModal').html("Edit ICD 10");
            $('#saveBtn').val("edit-jenis");
            $('#modalForm').modal('show');
            $.ajax({
                url: "{{ route('admin.data-icd.index') }}" + '/' + product_id + '/edit',
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#product_id').val(data.id);
                    $('#kode').val(data.kode);
                    $('#nama').val(data.nama);
                    $('#deskripsi').val(data.deskripsi);
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
                url: "{{ route('admin.data-icd.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    alertBerhasil('Data icd berhasil disimpan')
                    $('#formInput').trigger("reset");
                    $('#modalForm').modal('hide');
                    $('.dataServer').DataTable().ajax.reload();
                },
                error: function (data) {
                    alertGagal('Data icd gagal disimpan')
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
                swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.data-icd.store') }}" + '/' + id,
                    success: function (data) {
                        $('.dataServer').DataTable().ajax.reload();
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
