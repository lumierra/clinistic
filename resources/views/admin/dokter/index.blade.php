@section('title', 'Dokter')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Dokter"
                title2="Master"
                title3="Dokter"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border bg-primary">
                                {{-- MOBILE --}}
                                <h4 class="box-title d-inline d-sm-none">Data Dokter <i class="fad fa-user-md"></i></h4>
                                <button class="box-title d-inline d-sm-none btn-sm waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                                {{-- DEKSTOP --}}
                                <h3 class="box-title d-none d-none d-md-inline d-sm-none">Data Dokter <i class="fad fa-user-md fs-20"></i></h3>
                                <button class="d-none d-md-inline d-sm-none waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="addDekstop">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width: 100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Nama Dokter</th>
                                            <th>No. HP</th>
                                            <th>Sex</th>
                                            <th>No. Izin</th>
                                            <th>Alamat</th>
                                            <th>Poliklinik</th>
                                            <th>Status</th>
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
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label><br>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <select class="form-control" id="gender" name="gender">
                            @foreach ($gender as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis_kelamin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP</label><br>
                        <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. Izin Praktek</label><br>
                        <input type="text" class="form-control" id="izin" name="izin" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Poliklinik</label><br>
                        <select class="form-control" multiple="multiple" id="poliklinik" name="poliklinik[]" placeholder="Pilih Poliklinik" style="width: 100%">
                            {{-- <option value="" selected>--Pilih Poliklinik--</option> --}}
                            @foreach ($poli as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Alamat</label><br>
                        <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Provinsi</label><br>
                        <select class="form-control" id="provinsi" name="provinsi" style="width: 100%;">
                            <option value="" selected>--Pilih Provinsi--</option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kabupaten/Kota</label><br>
                        <select class="form-control" id="kota" name="kota" style="width: 100%;">
                            <option value="" selected>--Pilih Kabupaten/Kota--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kecamatan</label><br>
                        <select class="form-control" id="kecamatan" name="kecamatan" style="width: 100%;">
                            <option value="" selected>--Pilih Kecamatan--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label><br>
                        <select class="form-control" id="status" name="status" style="width: 100%">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="buat" name="buat" value="create">
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
            $('#provinsi').select2();
            $('#poliklinik').select2();
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
                    'ajax': "{{ route('admin.dokter.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'nama', name: 'nama'},
                        {data: 'phone', name: 'phone', className: 'text-center'},
                        {data: 'gender_id', name: 'gender_id', className: 'text-center'},
                        {data: 'no_izin', name: 'phone', className: 'text-center'},
                        {data: 'alamat', name: 'alamat', className: 'text-capitalize'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data dokter",
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
                $('#headerModal').html("Tambah Dokter");
                $('#modalForm').modal('show');
                $('#provinsi').val(null).trigger("change");
                $('#kota').empty();
                $('#kota').val(null).trigger("change");
                $('#buat').val('create');
                $('#poliklinik').val(null).trigger("change");
            });
            $('#addDekstop').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Dokter");
                $('#modalForm').modal('show');
                $('#provinsi').val(null).trigger("change");
                $('#kota').empty();
                $('#kota').val(null).trigger("change");
                $('#buat').val('create');
                $('#poliklinik').val(null).trigger("change");
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Dokter");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.dokter.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#nama').val(data.nama);
                        $('#keterangan').val(data.keterangan);
                        $('#gender').val(data.gender_id);
                        $('#phone').val(data.phone);
                        $('#izin').val(data.no_izin);
                        $('#alamat').val(data.alamat);
                        // $('#poliklinik').val(data.poliklinik_id);
                        $('#provinsi').val(data.provinsi_id).trigger('change');
                        $('#buat').val('update');
                        $('#status').val(data.status);
                        provinsi(data.kota_id);
                        var dokterpoli = data.dokterpoli;
                        var poli = [];
                        for (let i = 0; i < dokterpoli.length; i++) {
                            poli.push(dokterpoli[i].poliklinik_id);
                        }
                        $('#poliklinik').val(poli).trigger('change');
                        window.setTimeout( function() {
                            kota(data.kota_id, data.kecamatan_id);
                        }, 500);

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
                    url: "{{ route('admin.dokter.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Data dokter berhasil disimpan')
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertGagal('Data dokter gagal disimpan')
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
                        url: "{{ route('admin.dokter.store') }}" + '/' + id,
                        success: function (data) {
                            if (data.status == 200){
                                swal("Berhasil !!", "Data Dokter Berhasil Dihapus", "success");
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

            $('#provinsi').change(function (e) {
                e.preventDefault();
                let provinsi = $('#provinsi').val()

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kota.index') }}" + '/' + provinsi,
                    success: function (data) {
                        $('#kota').empty();
                        $('#kota').select2()
                        data.map(function (item) {
                            $('#kota').append(new Option(item.nama_kota, item.id))
                        })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
            function provinsi(kota){
                let provinsi = $('#provinsi').val()

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kota.index') }}" + '/' + provinsi,
                    success: function (data) {
                        $('#kota').empty();
                        $('#kota').select2()
                        data.map(function (item) {
                            $('#kota').append(new Option(item.nama_kota, item.id))
                        })
                        $('#kota').val(kota).trigger('change');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
            $('#kota').select2()
            $('#kota').change(function (e) {
                e.preventDefault();
                let kota = $('#kota').val()
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kecamatan.index') }}" + '/' + kota,
                    success: function (data) {
                        $('#kecamatan').empty();
                        $('#kecamatan').select2()
                        data.map(function (item) {
                            $('#kecamatan').append(new Option(item.nama_kecamatan, item.id))
                        })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            function kota(kota, kecamatan){
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kecamatan.index') }}" + '/' + kota,
                    success: function (data) {
                        $('#kecamatan').empty();
                        $('#kecamatan').select2();
                        data.map(function (item) {
                            $('#kecamatan').append(new Option(item.nama_kecamatan, item.id))
                        })
                        $('#kecamatan').val(kecamatan).trigger('change');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        </script>
    @endpush
</x-layouts>
