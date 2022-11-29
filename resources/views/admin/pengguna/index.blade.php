@section('title', 'Pengguna')

<x-layouts>

    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Pengguna"
                title2="Master"
                title3="Pengguna"
                >
            </x-breadcrumb>
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data Pengguna <i class="fad fa-users"></i></h4>
                                <button class="box-title d-inline d-sm-none btn-sm waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data Pengguna <i class="fad fa-users fs-20"></i></h3>
                                <button class="d-none d-md-inline d-sm-none waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addDekstop">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-custom table-sm table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th class="text-center">Hak Akses</th>
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
                    <label class="form-label">Username</label><br>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label><br>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Hak Akses</label><br>
                    <select class="form-control" id="role" name="role">
                        <option value="" selected>--Pilih--</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ Str::title($item->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">No. HP</label><br>
                    <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Email</label><br>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="c-inputs-stacked">
                        <input type="checkbox" id="cekadmin" name="cekadmin">
                        <label for="cekadmin" class="me-30">Admin</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Modul Menu</label><br>
                    <select class="form-control" id="submenu" name="submenu[]" multiple="multiple" style="width:100%">
                        {{-- <option value="" selected>--Pilih--</option> --}}
                        @foreach ($submenu as $item)
                            <option value="{{ $item->id }}">{{ Str::title($item->nama) }} - ({{ Str::title($item->menu->nama) }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" id="status" name="status" value="create">
    </x-modal>


    @push('script')
    <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('template/js/pages/data-table.js') }}"></script> --}}
    <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
    <script src="{{ asset('template/js/pages/notification.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
        <script>
            // $('#unit').select2({})
            $('#submenu').select2()

            $('body').on('change', '#cekadmin', function () {
                if ($(this).is(':checked')) {
                    $('#cekadmin').val('1');
                    $('#submenu').prop('disabled', true);
                } else {
                    $('#cekadmin').val('0');
                    $('#submenu').prop('disabled', false);
                }
            });
            function cekAdmin() {
                if ($('#cekadmin').is(':checked')) {
                    $('#cekadmin').val('1');
                    $('#submenu').prop('disabled', true);
                } else {
                    $('#cekadmin').val('0');
                    $('#submenu').prop('disabled', false);
                }
            }

            $(function () {

                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.pengguna.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'username', name: 'username'},
                        {data: 'name', name: 'name', className: 'text-uppercase'},
                        {data: 'role', name: 'role', className:'text-center'},
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
                        "emptyTable": "Tidak ada data pengguna",
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
            });

            $('#add').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Pengguna");
                $('#modalForm').modal('show');
                kosong()
            });
            $('#addDekstop').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Pengguna");
                $('#modalForm').modal('show');
                kosong()
            });
            function kosong(){
                $('#username').val('');
                $('#name').val('');
                $('#role').val('');
                $('#phone').val('');
                $('#email').val('');
                $('#cekadmin').prop('checked', false);
                $('#submenu').val('').trigger('change');
            }

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Pengguna");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.pengguna.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id)
                        $('#username').val(data.username)
                        $('#name').val(data.name)
                        $('#email').val(data.email)
                        $('#role').val(data.role_id)
                        $('#phone').val(data.phone)
                        $('#cekadmin').prop('checked', data.cekadmin == '1' ? true : false);
                        $('#status').val('update');
                        if (data.cekadmin == '1') {
                            $('#submenu').prop('disabled', true);
                            $('#submenu').val(null).trigger('change');
                        } else {
                            $('#submenu').prop('disabled', false);
                            var menuuser = data.menuuser;
                            var menu = [];
                            for (let i = 0; i < menuuser.length; i++) {
                                menu.push(menuuser[i].submenu_id);
                            }
                            $('#submenu').val(menu).trigger('change');
                        }
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
                    url: "{{ route('admin.pengguna.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Pengguna berhasil disimpan')
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertGagal('Pengguna gagal disimpan')
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
                        url: "{{ route('admin.pengguna.store') }}" + '/' + id,
                        success: function (data) {
                            if (data.status == 200) {
                                swal("Berhasil !!", "Data Pengguna Berhasil Dihapus", "success");
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
