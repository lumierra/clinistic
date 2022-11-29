@section('title', 'Obat')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Obat"
                title2="Farmasi"
                title3="Obat"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Obat <i class="fad fa-pills fs-30"></i></h3>
                                <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width:100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1px">No</th>
                                            {{-- <th>Kode Item</th> --}}
                                            <th>Kategori</th>
                                            <th>Nama</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Harga Modal</th>
                                            <th>Harga Jual</th>
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
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Kode Obat</label><br>
                    <input type="text" class="form-control" id="kode" name="kode" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Nama Obat</label><br>
                    <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Kategori Obat</label><br>
                    <select class="form-control" id="kategori" name="kategori">
                        <option value="" selected>--Pilih Kategori--</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Satuan</label><br>
                    <select class="form-control" id="satuan" name="satuan">
                        <option value="" selected>--Pilih Satuan--</option>
                        @foreach ($satuan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_satuan }} ({{ $item->alias }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Stok</label><br>
                    <input type="text" class="form-control" id="stok" name="stok" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Harga Modal</label><br>
                    <input type="text" class="form-control" id="harga_modal" name="harga_modal" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Persen (%)</label><br>
                    <input type="text" class="form-control" id="persen" name="persen" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Harga Jual</label><br>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
        </div>
    </x-modal_size>

    <x-modal2>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Stok Sekarang</label><br>
                    <input readonly type="text" class="form-control" id="stok_sekarang" name="stok_sekarang" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Tambah Stok</label><br>
                    <input type="text" class="form-control" id="tambah_stok" name="tambah_stok" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
        </div>
    </x-modal2>

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
                    'ajax': "{{ route('admin.obat.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'obat.id', className:'text-center'},
                        // {data: 'kode', name: 'kode', className: 'text-center'},
                        {data: 'kategori_obat_id', name: 'kategori_obat_id', className: 'text-center'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'satuan_id', name: 'satuan_id', className: 'text-center'},
                        {data: 'stok', name: 'stok', className: 'text-center'},
                        {data: 'harga_modal', name: 'harga_modal', className: 'text-center'},
                        {data: 'harga_jual', name: 'harga_jual', className: 'text-center'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                        },
                    ],
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
                $('#headerModal').html("Tambah Obat");
                $('#modalForm').modal('show');
                $('#persen').val(50);
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Obat");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.obat.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#kode').val(data.kode);
                        $('#nama').val(data.nama);
                        $('#kategori').val(data.kategori_obat_id);
                        $('#satuan').val(data.satuan_id);
                        $('#stok').val(data.stok);
                        $('#harga_modal').val(data.harga_modal);
                        $('#harga_jual').val(data.harga_jual);
                        $('#persen').val(data.persen);
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
                    url: "{{ route('admin.obat.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Data obat berhasil disimpan')
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                        $('#saveBtn').prop('disabled', false)
                    },
                    error: function (data) {
                        alertGagal('Data obat gagal disimpan')
                        $('#saveBtn').html('Simpan');
                        $('#saveBtn').prop('disabled', false)
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
                        url: "{{ route('admin.obat.store') }}" + '/' + id,
                        success: function (data) {
                            if (data.status == 200){
                                swal("Berhasil", "Data obat berhasil dihapus", "success");
                                $('.dataServer').DataTable().ajax.reload();
                            } else {
                                swal("Gagal", data.message, "error");
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            $('body').on('change', '#harga_modal', function (e) {
                var modal = $(this).val();
                if (modal == '' || modal == 0){
                    $('#harga_modal').val(0);
                } else {
                    let persen = $('#persen').val();
                    var harga_jual = modal * persen / 100;
                    let result = parseInt(modal) + parseInt(harga_jual);
                    $('#harga_jual').val(result);
                }
            });

            $('body').on('change', '#persen', function (e) {
                var persen = $(this).val();
                if (persen == '' || persen == 0){
                    $('#harga_jual').val(0);
                } else {
                    var harga_modal = $('#harga_modal').val();
                    var harga_jual = harga_modal * persen / 100;
                    let result = parseInt(harga_modal) + parseInt(harga_jual);
                    $('#harga_jual').val(result);
                }
            });

            $('body').on('change', '#harga_jual', function (e) {
                var harga_jual = $(this).val();
                if (harga_jual == '' || harga_jual == 0){
                    $('#persen').val('');
                } else {
                    var harga_modal = $('#harga_modal').val();
                    var persen = harga_jual * 100 / harga_modal;
                    persen = persen - 100;
                    $('#persen').val(persen);
                }
            });

            $('body').on('click', '.stokProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal2').html("Tambah Stok Obat");
                $('#saveBtn2').val("edit-jenis");
                $('#modalForm2').modal('show');
                $.ajax({
                    url: "{{ route('admin.obat.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id2').val(data.id);
                        $('#stok_sekarang').val(data.stok);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });
            $('#saveBtn2').click(function (e) {
                e.preventDefault();
                $('#saveBtn2').prop('disabled', true)
                $(this).html('Simpan');
                let id = $('#product_id2').val();
                $.ajax({
                    data: $('#formInput2').serialize(),
                    url: "{{ route('admin.obat.store') }}" + '/' + id,
                    type: "PUT",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Data stok obat berhasil disimpan')
                        $('#formInput2').trigger("reset");
                        $('#modalForm2').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertGagal('Data stok obat gagal disimpan')
                        $('#saveBtn2').html('Simpan');
                    }
                });
                $('#saveBtn2').prop('disabled', false)
            });
        </script>
    @endpush
</x-layouts>
