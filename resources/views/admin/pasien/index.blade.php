@section('title', 'Pasien')

<x-layouts>
    @push('style')
        <style>
            /* .select2-container{
                z-index:1061 !important;
            } */
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
            {{-- <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Data Pasien <i class="fas fa-users-medical"></i></h3>
                    </div>
                </div>
            </div> --}}

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Pasien <i class="fal fa-users-medical fa-flip fs-30" style="--fa-animation-duration: 3s;" ></i></h3>
                                <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social btn-bitbucket mb-5 float-end" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" width="100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>No. RM</th>
                                            <th>No. RM Lama</th>
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

    <x-modal_size size="modal-lg">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">No. RM</label><br>
                        <input readonly type="text" class="form-control" id="rm" name="rm" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">NIK <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="nik" name="nik" autocomplete="off" placeholder="16 Digit NIK" maxlength="16" minlength="16" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">**</span></label><br>
                        <select class="form-control" id="gender" name="gender">
                            @foreach ($gender as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis_kelamin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">**</span></label><br>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kontak Lain Yang Bisa Dihubungi</label><br>
                        <input type="text" class="form-control" id="kontak_lain" name="kontak_lain" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label><br>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Golongan Darah <span class="text-danger">**</span></label><br>
                        <select class="form-control" id="golongan_darah" name="golongan_darah">
                            <option value="" selected>--Pilih--</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Nama Ibu Kandung <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pendidikan</label><br>
                        <select class="form-control" id="pendidikan" name="pendidikan">
                            <option value="" selected>--Pilih--</option>
                            <option value="sd">SD</option>
                            <option value="smp">SMP</option>
                            <option value="sma">SMA</option>
                            <option value="d3">D3</option>
                            <option value="s1">D4/S1</option>
                            <option value="s2">S2</option>
                            <option value="s3">S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Kawin</label><br>
                        <select class="form-control" id="kawin" name="kawin" style="width: 100%">
                            <option value="" selected>--Pilih--</option>
                            <option value="belum">Belum</option>
                            <option value="kawin">Kawin</option>
                            <option value="duda">Duda</option>
                            <option value="janda">Janda</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pekerjaan <span class="text-danger">**</span></label><br>
                        <select class="form-control" id="pekerjaan" name="pekerjaan" style="width: 100%">
                            <option value="" selected>--Pilih Pekerjaan--</option>
                            @foreach ($pekerjaan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_pekerjaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat <span class="text-danger">**</span></label><br>
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
                        <label class="form-label">Kelurahan</label><br>
                        <select class="form-control" id="kelurahan" name="kelurahan" style="width: 100%;">
                            <option value="" selected>--Pilih Kelurahan--</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h6 class="text-danger">Tanda ** Harus Di Isi</h6>
        </div>
        <input type="hidden" id="buat" name="buat" value="create">
    </x-modal_size>

    <x-barang.modal modal="modalAsuransi" size="modal-lg">
        <div class="row" id="detailBarang"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Asuransi</label><br>
                    <select class="form-control" id="asuransi" name="asuransi" style="width: 100%;">
                        <option value="" selected>--Pilih--</option>
                        @foreach ($asuransi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Nomor Asuransi</label><br>
                    <input type="text" id="nomor" class="form-control" name="nomor" placeholder="Maksimal 13 Digit" maxlength="13" minlength="13" autocomplete="off"/>
                </div>
            </div>
        </div>

        <input type="hidden" id="status" name="status" value="create">
        <input type="hidden" id="pasien3" name="pasien" value="">
    </x-barang.modal>

    <div class="modal fade" id="modalRiwayatPasien" aria-labelledby="modalForm" aria-hidden="true">
        <div class="modal-dialog modal-lg2">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Riwayat Kunjungan Pasien</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyRiwayatPasien">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
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
    {{-- <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script> --}}

        <script>
            $('#provinsi').select2({
                // dropdownParent: $("#modalForm")
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dataServer').DataTable({
                'processing': true,
                'serverSide': true,
                'responsive': true,
                'ajax': "{{ route('admin.pasien.index') }}",
                'columns': [
                    {data: 'DT_RowIndex', name: 'pasien.id', className:'text-center'},
                    {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                    {data: 'no_rm_old', name: 'no_rm_old', className: 'text-center'},
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
                language: {
                    "decimal": "",
                    "emptyTable": "Tidak ada data order radiologi",
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

            document.addEventListener("keydown", e => {
                if (e.key.toLowerCase() === 'f2'){
                    add()
                } else if (e.key.toLowerCase() === 'f4'){
                    simpan()
                } else if (e.key.toLowerCase() === 'escape'){
                    $('#modalForm').modal('hide');
                }
            })

            function add(){
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Pasien");
                $('#modalForm').modal('show');
                $('#provinsi').val(null).trigger("change");
                $('#kota').empty();
                $('#kota').val(null).trigger("change");
                $('#kelurahan').empty();
                $('#kelurahan').val(null).trigger("change");
                $('#buat').val('create');
                $('#nik').focus();
            }

            $('#add').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#formInput').trigger("reset");
                $('#headerModal').html("Tambah Pasien");
                $('#modalForm').modal('show');
                $('#provinsi').val(null).trigger("change");
                $('#kota').empty();
                $('#kota').val(null).trigger("change");
                $('#kelurahan').empty();
                $('#kelurahan').val(null).trigger("change");
                $('#buat').val('create');
                $('#nik').focus();
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Pasien");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.pasien.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#rm').val(data.no_rm);
                        $('#nik').val(data.nik);
                        $('#nama').val(data.nama);
                        $('#tempat_lahir').val(data.tempat_lahir);
                        $('#tgl_lahir').val(data.tgl_lahir);
                        $('#gender').val(data.gender_id);
                        $('#phone').val(data.phone);
                        $('#keterangan').val(data.keterangan);
                        $('#email').val(data.email);
                        $('#kontak_lain').val(data.kontak_lain);
                        $('#nama_ibu').val(data.nama_ibu);
                        $('#pekerjaan').val(data.pekerjaan_id);
                        $('#alamat').val(data.alamat);
                        $('#provinsi').val(data.provinsi_id).trigger('change');
                        $('#buat').val('update');
                        $('#status').val(data.status);
                        $('#kawin').val(data.status_kawin);
                        $('#golongan_darah').val(data.golongan_darah);
                        $('#pendidikan').val(data.pendidikan);
                        provinsi(data.kota_id);
                        window.setTimeout( function() {
                            kota(data.kota_id, data.kecamatan_id);
                        }, 500);
                        window.setTimeout( function() {
                            kec(data.kecamatan_id, data.kelurahan_id);
                        }, 900);
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            });

            function checking(){
                let nik = $('#nik').val()
                let nama = $('#nama').val()
                let tempat_lahir = $('#tempat_lahir').val()
                let tanggal = $('#tgl_lahir').val()
                let hp = $('#phone').val()
                let darah = $('#golongan_darah').val()
                let alamat = $('#alamat').val()
                let pekerjaan = $('#pekerjaan').val()
                let ibu = $('#nama_ibu').val()

                if (nik == '' || nik.length < 16){
                    $('#nik').focus();
                    swal({
                        title: "NIK tidak boleh kosong atau kurang dari 16 digit",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (nama == ''){
                    $('#nama').focus();
                    swal({
                        title: "Nama tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (tempat_lahir == ''){
                    $('#tempat_lahir').focus();
                    swal({
                        title: "Tempat lahir tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (tanggal == ''){
                    $('#tgl_lahir').focus();
                    swal({
                        title: "Tanggal lahir tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (hp == ''){
                    $('#phone').focus();
                    swal({
                        title: "No HP tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (ibu == ''){
                    $('#nama_ibu').focus();
                    swal({
                        title: "Nama Ibu kandung tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (darah == ''){
                    $('#golongan_darah').focus();
                    swal({
                        title: "Golongan darah tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (alamat == ''){
                    $('#alamat').focus();
                    swal({
                        title: "Alamat tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (pekerjaan == ''){
                    $('#pekerjaan').focus();
                    swal({
                        title: "Pekerjaan tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else {
                    return true;
                }

            }

            function simpan(){
                $('#saveBtn').prop('disabled', true)
                $(this).html('Simpan');
                // checking()
                if (checking()){
                    $.ajax({
                        data: $('#formInput').serialize(),
                        url: "{{ route('admin.pasien.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            alertBerhasil('Data pasien berhasil disimpan');
                            $('#formInput').trigger("reset");
                            $('#modalForm').modal('hide');
                            $('.dataServer').DataTable().ajax.reload();
                            $('#saveBtn').prop('disabled', false)
                        },
                        error: function (data) {
                            alertGagal('Data pasien gagal disimpan');
                            $('#saveBtn').html('Simpan');
                            $('#saveBtn').prop('disabled', false)
                        }
                    });
                } else {
                    $('#saveBtn').prop('disabled', false)
                }


            }
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $('#saveBtn').prop('disabled', true)
                $(this).html('Simpan');
                if (checking()){
                    $.ajax({
                        data: $('#formInput').serialize(),
                        url: "{{ route('admin.pasien.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            alertBerhasil('Data pasien berhasil disimpan');
                            $('#formInput').trigger("reset");
                            $('#modalForm').modal('hide');
                            $('.dataServer').DataTable().ajax.reload();
                            $('#saveBtn').prop('disabled', false)
                        },
                        error: function (data) {
                            alertGagal('Data pasien gagal disimpan');
                            $('#saveBtn').html('Simpan');
                            $('#saveBtn').prop('disabled', false)
                        }
                    });
                } else {
                    $('#saveBtn').prop('disabled', false)
                }
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
                        url: "{{ route('admin.pasien.store') }}" + '/' + id,
                        success: function (data) {
                            if (data == 'Success'){
                                swal("Berhasil !!", "Data Pasien Berhasil Dihapus", "success");
                                $('.dataServer').DataTable().ajax.reload();
                            } else {
                                swal("Gagal !!", "Data Pasien Gagal Dihapus", "error");
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            $('body').on('change', '#provinsi', function () {
                // e.preventDefault();
                var provinsi = $('#provinsi').val()
                var param;
                if (provinsi == ''){
                    $('#kota').empty();
                    $('#kota').select2()
                } else {
                    param = provinsi;
                    $.ajax({
                        type: "GET",
                        dataType: 'json',
                        url: "{{ route('admin.kota.index') }}" + '/' + param,
                        success: function (data) {
                            $('#kota').empty();
                            // $('#kota').select2();
                            $('#kota').select2({
                                // dropdownParent: $("#modalForm")
                            })
                            data.map(function (item) {
                                $('#kota').append(new Option(item.nama_kota, item.id))
                            })
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
            function provinsi(kota){
                let provinsi = $('#provinsi').val()

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kota.index') }}" + '/' + provinsi,
                    success: function (data) {
                        $('#kota').empty();
                        $('#kota').select2({
                            // dropdownParent: $("#modalForm")
                        })
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

            $('#kota').change(function (e) {
                e.preventDefault();
                let kota = $('#kota').val()
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kecamatan.index') }}" + '/' + kota,
                    success: function (data) {
                        $('#kecamatan').empty();
                        $('#kecamatan').select2({
                            // dropdownParent: $("#modalForm")
                        })
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
                        $('#kecamatan').select2({
                            // dropdownParent: $("#modalForm")
                        });
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

            $('#kecamatan').change(function (e) {
                e.preventDefault();
                let kec = $('#kecamatan').val()

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kelurahan.index') }}" + '/' + kec,
                    success: function (data) {
                        $('#kelurahan').empty();
                        $('#kelurahan').select2()
                        data.map(function (item) {
                            $('#kelurahan').append(new Option(item.nama_kelurahan, item.id))
                        })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            function kec(kecamatan, kelurahan){
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kelurahan.index') }}" + '/' + kecamatan,
                    success: function (data) {
                        $('#kelurahan').empty();
                        $('#kelurahan').select2({
                            // dropdownParent: $("#modalForm")
                        });
                        data.map(function (item) {
                            $('#kelurahan').append(new Option(item.nama_kelurahan, item.id))
                        })
                        $('#kelurahan').val(kelurahan).trigger('change');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

            $('#kelurahan').empty();
            $('#kelurahan').select2();

            $('body').on('click', '.asuransiProduct', function () {
                let id = $(this).data("id");
                $('#pasien3').val(id);
                $('#saveBtn1').val("create-product");
                $('#product_id1').val('');
                $('#formInput1').trigger("reset");
                $('#headerModal1').html("Tambah Asuransi Pasien");
                $('#modalAsuransi').modal('show');
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "{{ route('admin.bpjs-pasien.index') }}" + '/' + id,
                    success: function (data) {
                        $('#detailBarang').html(data)
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
            $('#saveBtn1').click(function (e) {
                e.preventDefault();
                $('#saveBtn1').prop('disabled', true)
                let asuransi = $('#asuransi').val()
                let nomor = $('#nomor').val();
                if (asuransi == ''){
                    swal({
                        title: "Asuransi Tidak Boleh Kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    $('#asuransi').focus()
                } else {
                    if (asuransi = '1'){
                        if (nomor == '' || nomor.length < 13){
                            swal({
                                title: "Nomor Asuransi tidak boleh kosong atau kurang dari 13 digit",
                                type: "warning",
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            });
                        } else {
                            $.ajax({
                                data: $('#formInput1').serialize(),
                                url: "{{ route('admin.bpjs-pasien.store') }}",
                                type: "POST",
                                dataType: 'html',
                                success: function (data) {
                                    alertBerhasil('Data berhasil disimpan')
                                    $('#saveBtn1').val("create-product");
                                    $('#product_id1').val('');
                                    $('#formInput1').trigger("reset");
                                    $('#status').val('create')
                                    $('#detailBarang').html(data)
                                },
                                error: function (data) {
                                    alertGagal('Data gagal disimpan')
                                    $('#saveBtn1').html('Simpan');
                                }
                            });
                        }
                    }
                }

                $('#saveBtn1').prop('disabled', false)
            });
            $('body').on('click', '.btnUbah', function () {
                let id = $(this).data("id");
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.bpjs-pasien.index') }}" + '/' + id + '/edit',
                    success: function (data) {
                        $('#asuransi').val(data.asuransi_id)
                        $('#nomor').val(data.nomor)
                        $('#product_id1').val(data.id)
                        $('#status').val('update');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
            $('body').on('click', '.btnHapus', function () {
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
                        dataType: 'html',
                        url: "{{ route('admin.bpjs-pasien.store') }}" + '/' + id,
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                            $('#detailBarang').html(data)
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            // DETAIL RIWAYAT PASIEN
            $('body').on('click', '.detailPasien', function () {
                let id = $(this).data("id");
                $('#modalRiwayatPasien').modal('show');
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "{{ route('admin.riwayat-pasien.index') }}" + '/' + id,
                    success: function (data) {
                        $('#bodyRiwayatPasien').html(data)
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
        </script>
    @endpush
</x-layouts>
