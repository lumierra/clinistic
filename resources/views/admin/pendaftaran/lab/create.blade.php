@section('title', 'Pasien')

<x-layouts>
    @push('style')
        <style>
            /* .select2-container{
                z-index:1060 !important;
            } */
            .modal-lg2 {
                max-width: 80% !important;
            }
            .modal-dialog{
                overflow-y: initial !important
            }
            .modal-body{
                height: 450px;
                overflow-y: auto;
            }
        </style>
    @endpush
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Pendaftaran Laboratorim</h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <h4 class="box-title">Form Pendaftaran <i class="fad fa-files-medical fs-20"></i></h4>
                                <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social mb-5 float-end" id="btnCariPasien">
                                    <i class="fal fa-search-plus"></i> Cari Pasien
                                </button>
                                <button class="me-1 waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social mb-5 float-end" id="btnTambahPasien">
                                    <i class="fal fa-user-plus"></i> Tambah Pasien
                                </button>
                            </div>
                            <form class="form" id="formCari">
                                <div class="box-body">
                                    <div class="row pb-30">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    {{-- <i class="fad fa-flask fs-100 text-primary fa-beat-fade"></i> --}}
                                                    <img src="{{ asset('images/lab.gif') }}" alt="Pendaftaran Lab" width="150">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label"></label>
                                                        <input type="text" id="search" name="search" class="form-control" placeholder="Cari Data Pasien (No. RM/NIK/NAMA)" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group mt-15 pt-1 float-center">
                                                        <label class="form-label"></label>
                                                        <button type="button" id="btnSearch" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-primary"><i class="fal fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="box-title text-primary mb-0"><i class="fal fa-user-injured me-15"></i> Info Pasien</h4>
                                                    <hr class="my-15">
                                                    <div class="row">
                                                        <input type="hidden" id="kdpasien" name="pasien" value="">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">No. RM</label>
                                                                <input readonly type="text" id="rm" name="rm" class="form-control" placeholder="No. RM">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">NIK</label>
                                                                <input readonly type="text" id="nik" name="nik" class="form-control" placeholder="NIK">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nama Lengkap</label>
                                                                    <input readonly type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Tempat, Tgl. Lahir</label>
                                                                <input readonly type="text" id="ttl" name="ttl" class="form-control" placeholder="Tempat, Tgl. Lahir">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="form-label">Jenis Kelamin / Umur</label>
                                                                    <input readonly type="text" id="gender" name="gender" class="form-control" placeholder="Jenis Kelamin / Umur">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea class="form-control" id="alamat" name="alamat" readonly></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h4 class="box-title text-primary mb-0"><i class="fal fa-file-medical-alt me-15"></i> Form</h4>
                                                    <hr class="my-15">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Produk Lab</label>
                                                                <select class="form-select" id="produk_lab" name="produk_lab" placeholder="Pilih Produk Lab">
                                                                    <option value="" selected>--Pilih--</option>
                                                                    @foreach ($produkLab as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Hasil Lab</label>
                                                                <select class="form-select" id="hasil_lab" name="hasil_lab" placeholder="Pilih Hasil Lab">
                                                                    <option value="1">Positif</option>
                                                                    <option value="2" selected>Negatif</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Dokter</label>
                                                                <select class="form-select" id="dokter" name="dokter" placeholder="Pilih Dokter">
                                                                    <option value="" selected>--Pilih--</option>
                                                                    @foreach ($dokter as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Jaminan</label>
                                                                <div class="radio">
                                                                    <input name="jaminan" type="radio" id="umum" value="umum" checked>
                                                                    <label for="umum">Umum</label>
                                                                </div>
                                                                <div class="radio">
                                                                    <input name="jaminan" type="radio" id="asuransi" value="asuransi" >
                                                                    <label for="asuransi">Asuransi</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row d-none" id="jaminan2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Asuransi</label>
                                                                <select class="form-select" id="asuransi2" name="asuransi2">
                                                                    @foreach ($asuransi as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">No. Kartu</label>
                                                                <input type="text" class="form-control" id="no_kartu" name="no_kartu" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer float-end">
                                    <a href="{{ route('admin.pendaftaran-lab.index') }}" id="btn-batal" class="btn btn-danger me-1">
                                        <i class="fal fa-times"></i> Batal
                                    </a>
                                    <button type="button" id="btn-simpan" class="btn btn-primary">
                                        <i class="fal fa-save"></i> Daftar
                                    </button>
                                </div>
                            </form>
                        </div>
                  </div>
                </div>
            </section>
        </div>
    </div>

    <x-modal_size size="modal-lg2">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width: 100%;">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center" width="1%">No</th>
                            <th>No. RM</th>
                            <th>Data Diri</th>
                            <th>Sex</th>
                            <th>Usia</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-modal_size>
    <x-pasien.modal size="modal-lg">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">No. RM</label><br>
                        <input readonly type="text" class="form-control" id="rm_baru" name="rm" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">NIK <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="nik_baru" name="nik" autocomplete="off" placeholder="16 Digit NIK" maxlength="16" minlength="16" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="nama_baru" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">**</span></label><br>
                        <select class="form-control" id="gender_baru" name="gender">
                            @foreach ($gender as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis_kelamin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="tempat_lahir_baru" name="tempat_lahir" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">**</span></label><br>
                        <input type="date" class="form-control" id="tgl_lahir_baru" name="tgl_lahir" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="phone_baru" name="phone" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kontak Lain Yang Bisa Dihubungi</label><br>
                        <input type="text" class="form-control" id="kontak_lain_baru" name="kontak_lain" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label><br>
                        <input type="email" class="form-control" id="email_baru" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Golongan Darah <span class="text-danger">**</span></label><br>
                        <select class="form-control" id="golongan_darah_baru" name="golongan_darah">
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
                        <label class="form-label">Pendidikan</label><br>
                        <select class="form-control" id="pendidikan_baru" name="pendidikan">
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
                        <select class="form-control" id="kawin_baru" name="kawin" style="width: 100%">
                            <option value="" selected>--Pilih--</option>
                            <option value="belum">Belum</option>
                            <option value="kawin">Kawin</option>
                            <option value="duda">Duda</option>
                            <option value="janda">Janda</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pekerjaan <span class="text-danger">**</span></label><br>
                        <select class="form-control" id="pekerjaan_baru" name="pekerjaan" style="width: 100%">
                            <option value="" selected>--Pilih Pekerjaan--</option>
                            @foreach ($pekerjaan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_pekerjaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat <span class="text-danger">**</span></label><br>
                        <input type="text" class="form-control" id="alamat_baru" name="alamat" autocomplete="off" required>
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
    </x-pasien.modal>
    <div id="modalFormCari" class="modal fade" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg2">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="headerModalCari">Data Pasien</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="formValidate0" id="formInputCari">
                    <div class="modal-body" id="bodyCariPasien">
                        <input type="hidden" name="product_id" id="product_id">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="saveBtn" class="btn btn-primary btn-sm" data-dismiss="modal">Simpan</button>
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
            $('#produk_lab').select2();
            $("#search").focus()
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'ajax': "{{ route('admin.cari-pasien.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'pasien.id', className:'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                        {data: 'nama', name: 'nama'},
                        {data: 'gender_id', name: 'gender_id', className: 'text-center'},
                        {data: 'tgl_lahir', name: 'tgl_lahir', className: 'text-center'},
                        {data: 'phone', name: 'phone', className: 'text-center'},
                        {data: 'alamat', name: 'alamat', className: 'text-capitalize'},
                    ],
                    "pageLength": 5,
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
                        $('#modalPasien').modal('hide');
                    }
                })
            });


            // Cari Pasien
            $('#search').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    cariPasien()
                }
            });

            function cariPasien(){
                let search = $('#search').val()
                // let kategori = $('#kategori').val()
                let kategori = 'rm';
                if (search == ''){
                    searchKosong();
                } else {
                    $.ajax({
                        data: {
                            search: search,
                            kategori: kategori
                        },
                        url: "{{ route('admin.cari-pasien.index') }}" + '/' + search,
                        type: "GET",
                        dataType: "JSON",
                        success: function(result){
                            if (result.status == 'tidak') {
                                $.toast({
                                    heading: 'GAGAL',
                                    text: 'Data Pasien Tidak Ditemukan  !!!',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 3500
                                });
                            } else {
                                if (result.total == 1){
                                    $.toast({
                                        heading: 'SUKSES',
                                        text: 'Data Pasien Ditemukan  !!!',
                                        position: 'top-right',
                                        loaderBg: '#ff6849',
                                        icon: 'success',
                                        hideAfter: 3500
                                    });
                                    $('#rm').val(result.pasien.no_rm)
                                    $('#nik').val(result.pasien.nik)
                                    $('#nama').val(result.pasien.nama)
                                    $('#ttl').val(result.ttl)
                                    $('#gender').val(result.usia)
                                    $('#alamat').val(result.pasien.alamat)
                                } else {
                                    pasienLebih()
                                }

                            }
                        }
                    })
                }
            }
            $('#btnSearch').click(function (e) {
                e.preventDefault()
                cariPasien()
            })
            function searchKosong(){
                $.toast({
                    heading: 'GAGAL',
                    text: 'Masukkan No.RM/NIK/Nama Pasien',
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500
                });
            }
            function pasienLebih(){
                $('#modalFormCari').modal('show');
                let search = $('#search').val()
                $.ajax({
                    data: {
                        search: search,
                    },
                    url: "{{ route('admin.cari-pasien.create') }}",
                    type: "GET",
                    dataType: "html",
                    success: function(result){
                        $('#bodyCariPasien').html(result);
                    }
                })
            }

            $('#btn-simpan').click(function (e) {
                e.preventDefault();
                $('#btn-simpan').prop('disabled', true)
                let rm = $('#rm').val()
                if (rm == '') {
                    $.toast({
                        heading: 'GAGAL',
                        text: 'Data Pasien Belum Di Input !!!',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                } else {
                    $.ajax({
                        data: $('#formCari').serialize(),
                        url: "{{ route('admin.pendaftaran-lab.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $.toast({
                                heading: 'SUKSES',
                                text: 'Pendaftaran Pasien Berhasil !!!',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500
                            });
                            window.setTimeout( function() {
                                window.location.href = "{{ route('admin.pendaftaran-lab.index') }}";
                            }, 3500);
                        },
                        error: function (data) {
                            alertDanger()
                        }
                    });
                }
                $('#btn-simpan').prop('disabled', false)
            });

            $('body').on('click', '#btnCariPasien', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Data Pasien");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
            });
            $('body').on('click', '#pilihPasien', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.cari-pasien.index') }}" + '/' + id + '/edit',
                    type: "GET",
                    dataType: "JSON",
                    success: function(result){
                        $('#rm').val(result.pasien.no_rm)
                        $('#nik').val(result.pasien.nik)
                        $('#nama').val(result.pasien.nama)
                        $('#ttl').val(result.ttl)
                        $('#gender').val(result.usia)
                        $('#alamat').val(result.pasien.alamat)
                        $('#kdpasien').val(result.pasien.id)
                    }
                })
                $('#modalForm').modal('hide');
                $('#modalFormCari').modal('hide');
            });


            $('#jenis_rujukan').change(function (e) {
                e.preventDefault();
                let jenis = $('#jenis_rujukan').val()
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.rujukan-rwj.index') }}" + '/' + jenis,
                    success: function (data) {
                        $('#asal_rujukan').empty();
                        data.map(function (item) {
                            $('#asal_rujukan').append(new Option(item.nama, item.id))
                        })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('#poliklinik').change(function (e) {
                e.preventDefault();
                let poli = $('#poliklinik').val()
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.dokter-rwj.index') }}" + '/' + poli,
                    success: function (data) {
                        $('#dokter').empty();
                        for (let i = 0; i < data.length; i++) {
                            $('#dokter').append(new Option(data[i].dokter.nama, data[i].dokter.id))
                        }

                        // data.map(function (item) {
                        //     $('#dokter').append(new Option(item.nama, item.id))
                        // })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('#umum').change(function (e) {
                e.preventDefault();
                let jaminan = $('input[name=jaminan]:checked').val();
                if (jaminan == 'umum') {
                    $('#jaminan2').addClass('d-none');
                } else {
                    $('#jaminan2').removeClass('d-none');
                }
                let asuransi = $('#asuransi2').val()
                let pasien = $('#kdpasien').val()
                $.ajax({
                    url: "{{ route('admin.bpjs-pasien.index') }}" + '/1',
                    type: "PUT",
                    dataType: "JSON",
                    data: {
                        asuransi: asuransi,
                        pasien: pasien
                    },
                    success: function(result){
                        $('#no_kartu').val(result.nomor);
                    }
                })
            });

            $('#asuransi').change(function (e) {
                e.preventDefault();
                let jaminan = $('input[name=jaminan]:checked').val();
                if (jaminan == 'umum') {
                    $('#jaminan2').addClass('d-none');
                } else {
                    $('#jaminan2').removeClass('d-none');
                }
                let asuransi = $('#asuransi2').val()
                let pasien = $('#kdpasien').val()
                $.ajax({
                    url: "{{ route('admin.bpjs-pasien.index') }}" + '/1',
                    type: "PUT",
                    dataType: "JSON",
                    data: {
                        asuransi: asuransi,
                        pasien: pasien
                    },
                    success: function(result){
                        $('#no_kartu').val(result.nomor);
                    }
                })
            });



            $('body').on('change', '#asuransi2', function () {
                let asuransi = $('#asuransi2').val()
                let pasien = $('#kdpasien').val()
                $.ajax({
                    url: "{{ route('admin.bpjs-pasien.index') }}" + '/1',
                    type: "PUT",
                    dataType: "JSON",
                    data: {
                        asuransi: asuransi,
                        pasien: pasien
                    },
                    success: function(result){
                        $('#no_kartu').val(result.nomor);
                    }
                })
            });

            // Tambah Pasien
            $('#provinsi').select2()
            function add(){
                $('#saveBtnPasien').val("create-product");
                $('#product_idPasien').val('');
                $('#formInputPasien').trigger("reset");
                $('#headerModalPasien').html("Tambah Pasien");
                $('#modalPasien').modal('show');
                $('#provinsi').val(null).trigger("change");
                $('#kota').empty();
                $('#kota').val(null).trigger("change");
                $('#kelurahan').empty();
                $('#kelurahan').val(null).trigger("change");
                $('#buat').val('create');
            }
            $('body').on('click', '#btnTambahPasien', function () {
                add();
            });
            $('#saveBtnPasien').click(function (e) {
                e.preventDefault();
                $('#saveBtnPasien').prop('disabled', true)
                $(this).html('Simpan');
                if (checking()){
                    $.ajax({
                        data: $('#formInputPasien').serialize(),
                        url: "{{ route('admin.pasien.store') }}" + '/1',
                        type: "PUT",
                        dataType: 'json',
                        success: function (data) {
                            alertSucces()
                            $('#formInputPasien').trigger("reset");
                            $('#modalPasien').modal('hide');
                            pilihPasien(data)
                            $('#saveBtnPasien').prop('disabled', false)
                        },
                        error: function (data) {
                            alertDanger()
                            $('#saveBtnPasien').html('Simpan');
                            $('#saveBtnPasien').prop('disabled', false)
                        }
                    });
                } else {
                    $('#saveBtnPasien').prop('disabled', false)
                }
            });
            function pilihPasien(id){
                $.ajax({
                    url: "{{ route('admin.cari-pasien.index') }}" + '/' + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(result){
                        $('#rm').val(result.pasien.no_rm)
                        $('#nik').val(result.pasien.nik)
                        $('#nama').val(result.pasien.nama)
                        $('#ttl').val(result.ttl)
                        $('#gender').val(result.usia)
                        $('#alamat').val(result.pasien.alamat)
                        $('#kdpasien').val(result.pasien.id)
                    }
                })
            }
            $('#provinsi').change(function (e) {
                e.preventDefault();
                let provinsi = $('#provinsi').val()

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kota.index') }}" + '/' + provinsi,
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
            });
            $('#kota').empty();
            $('#kota').select2();
            $('#kelurahan').empty();
            $('#kelurahan').select2();
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
            $('#kecamatan').change(function (e) {
                e.preventDefault();
                let kec = $('#kecamatan').val()
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kelurahan.index') }}" + '/' + kec,
                    success: function (data) {
                        $('#kelurahan').empty();
                        $('#kelurahan').select2({
                        })
                        data.map(function (item) {
                            $('#kelurahan').append(new Option(item.nama_kelurahan, item.id))
                        })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            function checking(){
                let nik = $('#nik_baru').val()
                let nama = $('#nama_baru').val()
                let tempat_lahir = $('#tempat_lahir_baru').val()
                let tanggal = $('#tgl_lahir_baru').val()
                let hp = $('#phone_baru').val()
                let darah = $('#golongan_darah_baru').val()
                let alamat = $('#alamat_baru').val()
                let pekerjaan = $('#pekerjaan_baru').val()


                if (nik == '' || nik.length < 16){
                    $('#nik_baru').focus();
                    swal({
                        title: "NIK tidak boleh kosong atau kurang dari 16 digit",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (nama == ''){
                    $('#nama_baru').focus();
                    swal({
                        title: "Nama tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (tempat_lahir == ''){
                    $('#tempat_lahir_baru').focus();
                    swal({
                        title: "Tempat lahir tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (tanggal == ''){
                    $('#tgl_lahir_baru').focus();
                    swal({
                        title: "Tanggal lahir tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (hp == ''){
                    $('#phone_baru').focus();
                    swal({
                        title: "No HP tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (darah == ''){
                    $('#golongan_darah_baru').focus();
                    swal({
                        title: "Golongan darah tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (alamat == ''){
                    $('#alamat_baru').focus();
                    swal({
                        title: "Alamat tidak boleh kosong",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    return false;
                } else if (pekerjaan == ''){
                    $('#pekerjaan_baru').focus();
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
                if (checking()){
                    $.ajax({
                        data: $('#formInputPasien').serialize(),
                        url: "{{ route('admin.pasien.store') }}" + '/1',
                        type: "PUT",
                        dataType: 'json',
                        success: function (data) {
                            alertSucces()
                            $('#formInputPasien').trigger("reset");
                            $('#modalPasien').modal('hide');
                            pilihPasien(data)
                            $('#saveBtnPasien').prop('disabled', false)
                        },
                        error: function (data) {
                            alertDanger()
                            $('#saveBtnPasien').html('Simpan');
                            $('#saveBtnPasien').prop('disabled', false)
                        }
                    });
                } else {
                    $('#saveBtnPasien').prop('disabled', false)
                }
            }
        </script>
    @endpush
</x-layouts>
