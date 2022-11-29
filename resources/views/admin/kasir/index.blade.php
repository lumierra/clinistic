@section('title', 'Kasir')

<x-layouts>
    @push('style')
        <style>
            /* .select2-container{
                z-index:1061 !important;
            } */
            .modal-lg2 {
                max-width: 90% !important;
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
                        <h3 class="page-title">KASIR {{ $dataWebsite->nama_website }}</h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <button class="waves-effect waves-light btn btn-primary3 text-dark btn-rounded btn-social mb-5 float-end" id="btnCariPasien">
                                    <i class="fas fa-search-plus"></i> Cari Kunjungan Pasien
                                </button>
                            </div>
                            <form class="form" id="formCari">
                                <div class="box-body">
                                    <div class="row pb-30">
                                        <div class="col-md-8 col-12">
                                            {{-- <i class="fad fa-cash-register fs-100 text-primary fa-beat-fade"></i> --}}
                                            <img src="{{ asset('images/kasir.gif') }}" alt="Kasir" width="150">
                                        </div>
                                        <div class="col-md-3 col-9">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                                <input type="text" id="search" name="search" class="form-control" placeholder="Cari Data Pasien (No.RM/Register)" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-3">
                                            <div class="form-group mt-15 pt-1 float-center">
                                                <label class="form-label"></label>
                                                <button type="button" id="btnSearch" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <h4 class="box-title text-primary mb-0"><i class="fal fa-user-injured me-15"></i> Info Kunjungan Pasien</h4>
                                                    <hr class="my-15">
                                                    <div class="row">
                                                        <input type="hidden" id="kdpasien" name="pasien" value="">
                                                        <input type="hidden" id="kode_register" name="kode_register" value="">
                                                        <input type="hidden" id="kode_kunjungan" name="kode_kunjungan" value="">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">No. Register</label>
                                                                <input readonly type="text" id="no_register" name="no_register" class="form-control" placeholder="No. Register">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Unit</label>
                                                                <input readonly type="text" id="unit" name="unit" class="form-control" placeholder="Unit">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Dokter</label>
                                                                <input readonly type="text" id="dokter" name="dokter" class="form-control" placeholder="Dokter">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Jaminan</label>
                                                                <input readonly type="text" id="jaminan" name="jaminan" class="form-control" placeholder="Jaminan">
                                                            </div>
                                                        </div>
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
                                                                <div class="form-group">
                                                                    <label class="form-label">Jenis Kelamin / Umur</label>
                                                                    <input readonly type="text" id="gender" name="gender" class="form-control" placeholder="Jenis Kelamin / Umur">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Tempat, Tgl. Lahir</label>
                                                                <input readonly type="text" id="ttl" name="ttl" class="form-control" placeholder="Tempat, Tgl. Lahir">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea class="form-control" id="alamat" name="alamat" readonly></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <h4 class="box-title text-primary mb-0"><i class="fal fa-file-medical-alt me-15"></i> Detail Transaksi</h4>
                                                    <hr class="my-15">
                                                    <div class="row" id="tableDetailTransaksi"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer float-end">
                                    {{-- <button disabled type="button" id="btn-bayar-cetak" class="btn btn-success float-end">
                                        <i class="fas fa-floppy-disk-circle-arrow-right"></i> Bayar & Cetak
                                    </button> --}}
                                    <a href="" target="_blank" id="btn-cetak" class="btn btn-dark me-1 float-end d-none">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                    <button disabled type="button" id="btn-bayar" class="btn btn-success me-1 float-end">
                                        <i class="fas fa-floppy-disk-circle-arrow-right"></i> Bayar
                                    </button>
                                    <a href="{{ route('admin.kasir.index') }}" id="btn-batal" class="btn btn-danger me-1 float-end">
                                        <i class="fas fa-circle-arrow-left"></i> Batal
                                    </a>
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
            <div class="col-lg-6 col-12">
                <div class="box box-solid box-primary bb-3 border-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">Cari Kunjungan</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="tanggal" name="tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" onClick="btnCari('find')" id="btnFind" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-search"></i> Cari</button>
                                <button type="button" onClick="btnCari('today')" id="btnToday" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-calendar-day"></i> Hari ini</button>
                                <button type="button" onClick="btnCari('before')" id="btnSebelumnya" class="btn btn-info btn-sm btn-rounded float-end mx-1 text-dark"><i class="fas fa-circle-arrow-left"></i> Kemarin</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover dataServer" style="width: 100%;">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center" width="1%">No</th>
                            <th width="10%">No. Register</th>
                            <th width="1%">No. RM</th>
                            <th width="20%">Data Diri</th>
                            <th width="1%">Unit</th>
                            <th width="10%">Dokter</th>
                            <th width="1%">Jaminan</th>
                            <th width="1%">Status Transaksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-modal_size>
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
            $('#search').focus();
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
                    'ajax': "{{ route('admin.cari-kunjungan.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'pasien.id', className:'text-center'},
                        {data: 'register', name: 'register', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                        {data: 'pasien_id', name: 'pasien_id'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id'},
                        {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center text-uppercase'},
                        {data: 'status_transaksi', name: 'status_transaksi', className: 'text-center text-uppercase'},
                    ],
                    "pageLength": 10,
                    language: {
                        "decimal": "",
                        "emptyTable": "Tidak ada data pasien kunjungan",
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
                        $('#btnCariPasien').click()
                    } else if (e.key.toLowerCase() === 'f4'){
                        $('#btn-bayar').click()
                        // $('#btn-bayar').html('<i class="fa fa-spinner fa-spin"></i> Loading').attr('disabled', true)
                        // $('#btn-bayar').html('<i class="fal fa-save"></i> Bayar').attr('disabled', false)
                    }
                })
            // });

            // CARI KUNJUNGAN BERDASARKAN TANGGAL
            btnCari = status => {
                let tanggal = '';
                if (status == 'find'){
                    tanggal = $('#tanggal').val();
                } else if (status == 'today'){
                    let today = new Date();
                    let dd = String(today.getDate()).padStart(2, '0');
                    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    let yyyy = today.getFullYear();
                    today = yyyy + '-' + mm + '-' + dd;
                    tanggal = today;
                } else if (status == 'before'){
                    let today = new Date();
                    let dd = String(today.getDate() - 1).padStart(2, '0');
                    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    let yyyy = today.getFullYear();
                    today = yyyy + '-' + mm + '-' + dd;
                    tanggal = today;
                }
                $('.dataServer').DataTable().clear().destroy();
                $('.dataServer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.cari-kunjungan-tanggal.index') }}" + '/' + tanggal,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'pasien.id', className:'text-center'},
                        {data: 'register', name: 'register', className: 'text-center'},
                        {data: 'no_rm', name: 'no_rm', className: 'text-center'},
                        {data: 'pasien_id', name: 'pasien_id'},
                        {data: 'poliklinik_id', name: 'poliklinik_id', className: 'text-center'},
                        {data: 'dokter_id', name: 'dokter_id'},
                        {data: 'status_jaminan', name: 'status_jaminan', className: 'text-center text-uppercase'},
                        {data: 'status_transaksi', name: 'status_transaksi', className: 'text-center text-uppercase'},
                    ],
                    "pageLength": 10,
                    language: {
                        "decimal": "",
                        "emptyTable": "Tidak ada data pasien kunjungan",
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
            }


            // Cari Pasien
            $('#search').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13'){
                        cariPasien()
                    }
            });

            function cariPasien(){
                let search = $('#search').val()
                if (search == ''){
                    alertGagal('Silahkan isi No. RM atau No. Register')
                } else {
                    $.ajax({
                        data: {
                            search: search,
                        },
                        url: "{{ route('admin.cari-kunjungan.index') }}" + '/1',
                        type: "PUT",
                        dataType: "JSON",
                        success: function(result){
                            if (result.status == 'tidak') {
                                alertGagal('Data pasien tidak ditemukan')
                            } else {
                                if (result.total == 1){
                                    alertBerhasil('Data pasien ditemukan')
                                    $('#no_register').val(result.data.register)
                                    $('#unit').val(result.unit)
                                    $('#dokter').val(result.dokter)
                                    $('#jaminan').val(result.status_jaminan)
                                    $('#rm').val(result.data.pasien.no_rm)
                                    $('#nik').val(result.data.pasien.nik)
                                    $('#nama').val(result.data.pasien.nama)
                                    $('#ttl').val(result.ttl)
                                    $('#gender').val(result.usia)
                                    $('#alamat').val(result.data.pasien.alamat)
                                    $('#kdpasien').val(result.data.no_rm)
                                    $('#kode_register').val(result.data.register)
                                    $('#kode_kunjungan').val(result.kunjungan)
                                    detailTransaksi()
                                    $('#btn-bayar').prop('disabled', false)
                                    if (result.status_transaksi == 'selesai'){
                                        $('#btn-cetak').removeClass('d-none');
                                        $('#btn-bayar').addClass('d-none');
                                        $('#btn-cetak').attr('href', `{{ env('APP_URL').'/layanan/cetak_billing/${result.kunjungan}' }}`)
                                    }
                                    // cekLabel()
                                    // resetFormKanan()

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

            $('body').on('click', '#btnCariPasien', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Data Pasien");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $('.dataServer').DataTable().ajax.reload();
                $('.modal-footer').addClass('d-none')
            });
            $('body').on('click', '#pilihPasien', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.cari-kunjungan.index') }}" + '/' + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(result){
                        $('#no_register').val(result.data.register)
                        $('#unit').val(result.unit)
                        $('#dokter').val(result.dokter)
                        $('#jaminan').val(result.status_jaminan)
                        $('#rm').val(result.data.pasien.no_rm)
                        $('#nik').val(result.data.pasien.nik)
                        $('#nama').val(result.data.pasien.nama)
                        $('#ttl').val(result.ttl)
                        $('#gender').val(result.usia)
                        $('#alamat').val(result.data.pasien.alamat)
                        $('#kdpasien').val(result.data.no_rm)
                        $('#kode_register').val(result.data.register)
                        $('#kode_kunjungan').val(result.kunjungan)
                        detailTransaksi()
                        $('#btn-bayar').prop('disabled', false)
                        if (result.status_transaksi == 'selesai'){
                            $('#btn-cetak').removeClass('d-none');
                            $('#btn-bayar').addClass('d-none');
                            $('#btn-cetak').attr('href', `{{ env('APP_URL').'/layanan/cetak_billing/${result.kunjungan}' }}`)
                        }
                        $('#search').val(result.data.register);
                    }
                })
                $('#modalForm').modal('hide');
            });

            function detailTransaksi(){
                let kunjungan = $('#kode_kunjungan').val()
                $.ajax({
                    url: "{{ route('admin.cari-kunjungan.index') }}" + '/' + kunjungan + '/edit',
                    type: "GET",
                    dataType: "html",
                    success: function(data){
                        $('#tableDetailTransaksi').html(data)
                        $('#bayar').focus();
                    }
                })
            }

            // Tambah Pasien
            function pilihPasien(id){
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.cari-kunjungan.index') }}" + '/' + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(result){
                        $('#no_register').val(result.data.register)
                        $('#unit').val(result.unit)
                        $('#dokter').val(result.dokter)
                        $('#jaminan').val(result.status_jaminan)
                        $('#rm').val(result.data.pasien.no_rm)
                        $('#nik').val(result.data.pasien.nik)
                        $('#nama').val(result.data.pasien.nama)
                        let tempat = result.data.pasien.tempat_lahir
                        let tanggal = result.ttl
                        let ttl = tempat + ', ' + tanggal
                        $('#ttl').val(ttl)
                        $('#gender').val(result.usia)
                        $('#alamat').val(result.data.pasien.alamat)
                        $('#kdpasien').val(result.data.no_rm)
                        $('#kode_register').val(result.data.register)
                        $('#kode_kunjungan').val(result.kunjungan)
                        detailTransaksi()
                        $('#btn-bayar').prop('disabled', false)
                        $('#btn-bayar-cetak').prop('disabled', false)
                    }
                })
            }
            function pasienLebih(){
                $('#modalFormCari').modal('show');
                let search = $('#search').val()
                $.ajax({
                    data: {
                        search: search,
                    },
                    url: "{{ route('admin.cari-kunjungan.create') }}",
                    type: "GET",
                    dataType: "html",
                    success: function(result){
                        $('#bodyCariPasien').html(result);
                    }
                })
            }

            // TOMBOL BAYAR
            $('body').on('click', '#btn-bayar', function(e){
                e.preventDefault();
                $('#btn-bayar').attr('disabled', true)
                $('#btn-bayar').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                let rm = $('#rm').val()
                let bayar = $('#bayar').val()
                let total = $('#total_transaksi').val()
                bayar = bayar.replace(/\./g, '')
                total = total.replace(/\./g, '')
                if (rm == ''){
                    alertGagal('Data Kunjungan Pasien belum di pilih !!!')
                    $('#btn-bayar').attr('disabled', false)
                    $('#btn-bayar').html('<i class="fal fa-save"></i> Bayar')
                    audioGagal()
                    $('#search').focus();
                }
                else if (bayar == ''){
                    alertGagal('Masukkan Jumlah Pembayaran !!!')
                    $('#btn-bayar').attr('disabled', false)
                    $('#btn-bayar').html('<i class="fal fa-save"></i> Bayar')
                    audioGagal()
                    $('#bayar').focus();
                }
                else if (parseInt(bayar) < parseInt(total)){
                    alertGagal('Jumlah Pembayaran Kurang !!!')
                    $('#btn-bayar').prop('disabled', false)
                    $('#btn-bayar').html('<i class="fal fa-save"></i> Bayar')
                    audioGagal()
                } else {
                    let nomor_transaksi = $('#nomor_transaksi').val()
                    $.ajax({
                        data: {
                            nomor_transaksi: nomor_transaksi,
                            bayar: parseInt(bayar),
                        },
                        url: "{{ route('admin.kasir.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if (data.status == 200){
                                var obj = document.createElement("audio");
                                obj.src = "{{ asset('audio/success.mp3') }}";
                                obj.volume = 1;
                                obj.autoPlay = false;
                                obj.preLoad = true;
                                obj.controls = true;
                                obj.play();
                                alertBerhasil('Pembayaran berhasil !!!')
                                $('#tableDetailTransaksi').html('')
                                $('.dataServer').DataTable().ajax.reload();
                                $('#formCari').trigger('reset');
                                $('#search').val('')
                                $('#search').focus()
                                $('#btn-cetak').addClass('d-none');
                                $('#btn-bayar').removeClass('d-none');
                                window.open(`{{ env('APP_URL').'/layanan/cetak_billing/${data.kunjungan}' }}`)
                            } else {
                                alertGagal(data.message)
                                audioGagal()
                            }
                        },
                        error: function (data) {
                            alertGagal('Pembayaran gagal !!!')
                            audioGagal()
                        }
                    });
                }

                $('#btn-bayar').prop('disabled', false)
                $('#btn-bayar').html('<i class="fal fa-save"></i> Bayar')
            })

            function audioGagal(){
                var obj = document.createElement("audio");
                obj.src = "{{ asset('audio/error.mp3') }}";
                obj.volume = 1;
                obj.autoPlay = false;
                obj.preLoad = true;
                obj.controls = true;
                obj.play();
            }
        </script>
        <script>
            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka
                    .replace(/[^,\d]/g, "")
                    .toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0]
                    .substr(sisa)
                    .match(/\d{3}/gi);
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ?
                        "." :
                        "";
                    rupiah += separator + ribuan.join(".");
                }
                rupiah = split[1] != undefined ?
                    rupiah + "," + split[1] :
                    rupiah;
                return prefix == undefined ?
                    rupiah :
                    rupiah ?
                    "" + rupiah :
                    "";
            }
        </script>
    @endpush
</x-layouts>
