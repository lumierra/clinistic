@section('title', 'Setting Menu')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Setting Menu"
                title2="Master"
                title3="Menu"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data Menu <i class="fad fa-bars"></i></h4>
                                <button class="box-title d-inline d-sm-none btn-sm waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data Menu <i class="fad fa-bars fs-20"></i></h3>
                                <button class="d-none d-md-inline d-sm-none waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addDekstop">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Nama Menu</th>
                                            <th class="text-center">Url</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Urutan</th>
                                            <th class="text-center">Action</th>
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

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data Sub Menu <i class="fad fa-bars"></i></h4>
                                <button class="box-title d-inline d-sm-none btn-sm waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addSubmenu">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data Sub Menu <i class="fad fa-bars fs-20"></i></h3>
                                <button class="d-none d-md-inline d-sm-none waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addSubmenuDekstop">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataSubmenu" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Nama Menu</th>
                                            <th>Nama Sub Menu</th>
                                            <th class="text-center">Url</th>
                                            {{-- <th class="text-center">Icon</th> --}}
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Urutan</th>
                                            <th class="text-center">Action</th>
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

            {{-- SUB MENU DETAIL --}}
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data Sub Menu Detail <i class="fad fa-bars"></i></h4>
                                <button class="box-title d-inline d-sm-none btn-sm waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addSubmenuDetail">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data Sub Menu Detail <i class="fad fa-bars fs-20"></i></h3>
                                <button class="d-none d-md-inline d-sm-none waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addSubmenuDetailDekstop">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataSubmenuDetail" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Nama Menu</th>
                                            <th>Nama Sub Menu</th>
                                            <th>Nama Sub Level 2</th>
                                            <th class="text-center">Url</th>
                                            {{-- <th class="text-center">Icon</th> --}}
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Urutan</th>
                                            <th class="text-center">Action</th>
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
                    <label class="form-label">Nama Menu</label><br>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Icon</label><br>
                    <input type="text" class="form-control" id="icon" name="icon" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Url</label><br>
                    <input type="text" class="form-control" id="url" name="url" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="my-select" class="form-label">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="aktif">Aktif</option>
                        <option value="tidak-aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Urutan</label><br>
                    <input type="text" class="form-control" id="urut" name="urut" autocomplete="off">
                </div>
            </div>
        </div>
    </x-modal>

    <div id="modalFormSubmenu" class="modal fade" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="headerModalSubmenu">Medium model</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="formValidate0" id="formInputSubmenu">
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_idSubmenu">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Menu</label><br>
                                    <select class="form-select" id="menuSubmenu" name="menu" placeholder="Pilih Menu"></select>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nama Menu</label><br>
                                    <input type="text" class="form-control" id="namaSubmenu" name="nama" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Icon</label><br>
                                    <input type="text" class="form-control" id="iconSubmenu" name="icon" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Url</label><br>
                                    <input type="text" class="form-control" id="urlSubmenu" name="url" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="my-select" class="form-label">Status</label>
                                    <select id="statusSubmenu" class="form-control" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak-aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Urutan</label><br>
                                    <input type="text" class="form-control" id="urutSubmenu" name="urut" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="saveBtnSubmenu" class="btn btn-primary btn-sm" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalFormSubmenuDetail" class="modal fade" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="headerModalSubmenuDetail">Medium model</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="formValidate0" id="formInputSubmenuDetail">
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_idSubmenuDetail">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Submenu</label><br>
                                    <select class="form-select" id="menuSubmenuDetail" name="submenu" placeholder="Pilih Submenu"></select>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nama Menu</label><br>
                                    <input type="text" class="form-control" id="namaSubmenuDetail" name="nama" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Icon</label><br>
                                    <input type="text" class="form-control" id="iconSubmenuDetail" name="icon" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Url</label><br>
                                    <input type="text" class="form-control" id="urlSubmenuDetail" name="url" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="my-select" class="form-label">Status</label>
                                    <select id="statusSubmenuDetail" class="form-control" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak-aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Urutan</label><br>
                                    <input type="text" class="form-control" id="urutSubmenuDetail" name="urut" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="saveBtnSubmenuDetail" class="btn btn-primary btn-sm" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>


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
                    'responsive':true,
                    'ajax': "{{ route('admin.menu.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'url', name: 'url', className:'text-center'},
                        {data: 'icon', name: 'icon', className:'text-center'},
                        {data: 'status', name: 'status', className:'text-center'},
                        {data: 'urut', name: 'urut', className:'text-center'},
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
                        "emptyTable": "Tidak ada data menu",
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

                $('.dataSubmenu').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive':true,
                    'ajax': "{{ route('admin.submenu.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'menu_id', name: 'menu_id', className: 'text-capitalize'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'url', name: 'url', className:'text-center'},
                        // {data: 'icon', name: 'icon', className:'text-center'},
                        {data: 'status', name: 'status', className:'text-center'},
                        {data: 'urut', name: 'urut', className:'text-center'},
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
                        "emptyTable": "Tidak ada data submenu",
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
                    // $('.dataSubmenu').DataTable().clear().destroy();
                    // dataSubmenu()
                });
                // $.fn.dataTable.ext.errMode = 'none';

                $('.dataSubmenuDetail').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive':true,
                    'ajax': "{{ route('admin.submenu-detail.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'menu_id', name: 'menu_id', className: 'text-capitalize'},
                        {data: 'submenu_id', name: 'submenu_id', className: 'text-capitalize'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'url', name: 'url', className:'text-center'},
                        // {data: 'icon', name: 'icon', className:'text-center'},
                        {data: 'status', name: 'status', className:'text-center'},
                        {data: 'urut', name: 'urut', className:'text-center'},
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
                        "emptyTable": "Tidak ada data submenu level 2",
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
                    // $('.dataSubmenuDetail').DataTable().clear().destroy();
                    // $('.dataSubmenuDetail').DataTable().ajax.reload();
                });
                // $.fn.dataTable.ext.errMode = 'none';
            // });

            // Menu
            $('#add').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Menu");
                $('#modalForm').modal('show');
            });
            $('#addDekstop').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Menu");
                $('#modalForm').modal('show');
            });

            // Submenu
            $('#addSubmenu').click(function () {
                $('#saveBtnSubmenu').val("create-product");
                $('#product_idSubmenu').val('');
                $('#formInputSubmenu').trigger("reset");
                $('#headerModalSubmenu').html("Tambah Submenu");
                $('#modalFormSubmenu').modal('show');
                getMenu();
            });
            $('#addSubmenuDekstop').click(function () {
                $('#saveBtnSubmenu').val("create-product");
                $('#product_idSubmenu').val('');
                $('#formInputSubmenu').trigger("reset");
                $('#headerModalSubmenu').html("Tambah Submenu");
                $('#modalFormSubmenu').modal('show');
                getMenu();
            });

            // Submenu Detail
            $('#addSubmenuDetail').click(function () {
                $('#saveBtnSubmenuDetail').val("create-product");
                $('#product_idSubmenuDetail').val('');
                $('#formInputSubmenuDetail').trigger("reset");
                $('#headerModalSubmenuDetail').html("Tambah Submenu Level 2");
                $('#modalFormSubmenuDetail').modal('show');
                getSubmenu();
            });
            $('#addSubmenuDetailDekstop').click(function () {
                $('#saveBtnSubmenuDetail').val("create-product");
                $('#product_idSubmenuDetail').val('');
                $('#formInputSubmenuDetail').trigger("reset");
                $('#headerModalSubmenuDetail').html("Tambah Submenu Level 2");
                $('#modalFormSubmenuDetail').modal('show');
                getSubmenu();
            });

            function getMenu(){
                $.ajax({
                    url: "{{ route('admin.submenu.create') }}",
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#menuSubmenu').empty();
                        $.each(data, function (key, value) {
                            $('#menuSubmenu').append(new Option(value.nama, value.id))
                        });
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            }

            function getSubmenu(){
                $.ajax({
                    url: "{{ route('admin.submenu-detail.create') }}",
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#menuSubmenuDetail').empty();
                        $.each(data, function (key, value) {
                            $('#menuSubmenuDetail').append(new Option(value.nama + ' (' + value.menu.nama + ')', value.id))
                        });
                        $('#menuSubmenuDetail').select2();
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            }

            // Edit Menu
            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Menu");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.menu.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#nama').val(data.nama);
                        $('#icon').val(data.icon);
                        $('#url').val(data.url);
                        $('#status').val(data.status);
                        $('#urut').val(data.urut);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });

            // Edit Submenu
            $('body').on('click', '.editProductSubmenu', function () {
                var product_id = $(this).data('id');
                $('#headerModalSubmenu').html("Edit Submenu");
                $('#saveBtnSubmenu').val("edit-jenis");
                $('#modalFormSubmenu').modal('show');
                getMenu()
                $.ajax({
                    url: "{{ route('admin.submenu.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_idSubmenu').val(data.id);
                        $('#menuSubmenu').val(data.menu_id);
                        $('#namaSubmenu').val(data.nama);
                        $('#iconSubmenu').val(data.icon);
                        $('#urlSubmenu').val(data.url);
                        $('#statusSubmenu').val(data.status);
                        $('#urutSubmenu').val(data.urut);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });

            // Edit Submenu Detail
            $('body').on('click', '.editProductSubmenuDetail', function () {
                var product_id = $(this).data('id');
                $('#headerModalSubmenuDetail').html("Edit Submenu Level 2");
                $('#saveBtnSubmenuDetail').val("edit-jenis");
                $('#modalFormSubmenuDetail').modal('show');
                getSubmenu()
                $.ajax({
                    url: "{{ route('admin.submenu-detail.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_idSubmenuDetail').val(data.id);
                        $('#menuSubmenuDetail').val(data.submenu_id).trigger('change');
                        $('#namaSubmenuDetail').val(data.nama);
                        $('#iconSubmenuDetail').val(data.icon);
                        $('#urlSubmenuDetail').val(data.url);
                        $('#statusSubmenuDetail').val(data.status);
                        $('#urutSubmenuDetail').val(data.urut);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });

            // Simpan Menu
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $('#saveBtn').prop('disabled', true)
                $(this).html('Simpan');

                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route('admin.menu.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Menu berhasil disimpan')
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                        $('#saveBtn').prop('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Menu gagal disimpan')
                        $('#saveBtn').html('Simpan');
                        $('#saveBtn').prop('disabled', false)
                    }
                });
            });

            // Simpan Submenu
            $('#saveBtnSubmenu').click(function (e) {
                e.preventDefault();
                $('#saveBtnSubmenu').prop('disabled', true)
                $(this).html('Simpan');

                $.ajax({
                    data: $('#formInputSubmenu').serialize(),
                    url: "{{ route('admin.submenu.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Submenu berhasil disimpan')
                        $('#formInputSubmenu').trigger("reset");
                        $('#modalFormSubmenu').modal('hide');
                        $('.dataSubmenu').DataTable().ajax.reload();
                        $('#saveBtnSubmenu').prop('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Submenu gagal disimpan')
                        $('#saveBtnSubmenu').html('Simpan');
                        $('#saveBtnSubmenu').prop('disabled', false)
                    }
                });
            });

            // Simpan Submenu Detail
            $('#saveBtnSubmenuDetail').click(function (e) {
                e.preventDefault();
                $('#saveBtnSubmenuDetail').prop('disabled', true)
                $(this).html('Simpan');

                $.ajax({
                    data: $('#formInputSubmenuDetail').serialize(),
                    url: "{{ route('admin.submenu-detail.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Submenu Level 2 berhasil disimpan')
                        $('#formInputSubmenuDetail').trigger("reset");
                        $('#modalFormSubmenuDetail').modal('hide');
                        $('.dataSubmenuDetail').DataTable().ajax.reload();
                        $('#saveBtnSubmenuDetail').prop('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Submenu Level 2 gagal disimpan')
                        $('#saveBtnSubmenuDetail').html('Simpan');
                        $('#saveBtnSubmenuDetail').prop('disabled', false)
                    }
                });
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
                        url: "{{ route('admin.menu.store') }}" + '/' + id,
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

            $('body').on('click', '.deleteProductSubmenu', function () {
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
                        url: "{{ route('admin.submenu.store') }}" + '/' + id,
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
