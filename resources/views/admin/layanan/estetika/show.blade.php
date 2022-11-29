@section('title', 'Input Tindakan RWJ')

<x-layouts>
    @push('style')
        <style>
            .btn-green {
                background-color: #81c784;
                color: #ffffff;
            }
            .bg-green-light {
                background-color: #e8f5e9;
            }
            .select2-container{
                z-index: 1061 !important;
            }
            .fixed .main-header {
                z-index: 10002 !important;
            }
            .layout-top-nav.fixed .main-nav  {
                z-index: 10002 !important;
            }
            .jq-toast-wrap {
                z-index: 10003 !important;
            }
            .sweet-alert {
                z-index: 10004 !important;
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
            <section class="content">
                <x-rwj.pasien :pasien="$data"></x-rwj.pasien>
                <div class="row pt-5">
                    <div class="col-12 mb-20">
                        <div class="box box-solid bg-primary bb-3 border-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">Input Tindakan <i class="fad fa-files-medical fs-20"></i></h4>
                            </div>
                            <div class="box-body">
                                @if (Auth::user()->role_id == 5)
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#catatanRwj" role="tab"><span><i class="fas fa-notes-medical me-15"></i>Catatan</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#riwayatRwj" role="tab"><span><i class="fas fa-files-medical me-15"></i>Riwayat</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="catatanRwj" role="tabpanel">
                                            @include('admin.layanan.estetika.catatan')
                                        </div>
                                        <div class="tab-pane" id="riwayatRwj" role="tabpanel">
                                            @include('admin.layanan.rwj.riwayat')
                                        </div>
                                    </div>
                                @elseif ($data->status_pasien == 'belum_selesai')
                                    @can('SAD')
                                        <button id="layaninPasien" type="button" class="waves-effect waves-light btn btn-social btn-bitbucket mb-20">
                                            <i class="fad fa-user-injured"></i> Layanin Pasien
                                        </button>
                                    @endcan
                                @elseif ($data->status_pasien == 'diproses' || $data->status_pasien == 'selesai')
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#catatanRwj" role="tab"><span><i class="fas fa-notes-medical me-15"></i>Catatan</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#riwayatRwj" role="tab"><span><i class="fas fa-files-medical me-15"></i>Riwayat</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="catatanRwj" role="tabpanel">
                                            @include('admin.layanan.estetika.catatan')
                                        </div>
                                        <div class="tab-pane" id="riwayatRwj" role="tabpanel">
                                            @include('admin.layanan.rwj.riwayat')
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
        <script src="{{ asset('template/js/pages/notification.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
        {{-- <script src="{{ asset('template/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('template/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script> --}}
        {{-- <script src="{{ asset('template/js/pages/patient-details.js') }}"></script> --}}

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            document.addEventListener("keydown", e => {
                if (e.key.toLowerCase() === 'f2'){
                    e.preventDefault();
                    $('#catatanSave').click();
                } else if (e.key.toLowerCase() === 'f4'){
                    e.preventDefault();
                    $('#btn-selesai').click();
                } else if (e.key.toLowerCase() === 'escape'){
                    $('#modalForm').modal('hide');
                }
            })

            // BUTTON LAYANIN PASIEN
            $('#layaninPasien').on('click', function() {
                swal({
                    title: "Layanin Pasien ?",
                    type: "warning",
                    text: "Pasien akan dilayani oleh dokter",
                    showCancelButton: true,
                    cancelButtonColor: '#DD6B55',
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Layanin!",
                    closeOnConfirm: false,
                    cancelButtonText: 'Batal',
                }, function() {
                    $.ajax({
                        url: "{{ route('admin.tindakan-layanan.update', $data->id) }}",
                        type: "PUT",
                        dataType: "JSON",
                        success: function(data) {
                            swal("Berhasil", "Pasien Akan Dilayanin", "success");
                            window.location.reload();
                        },
                        error: function(data) {
                            swal("Gagal !!", "Pasien Gagal Dilayani", "error");
                        }
                    });
                });
            });

            // ICD 10
            $('#penyakit_icd').select2({
                placeholder: 'Pilih Diagnosa',
                ajax: {
                    url: "{{ route('admin.icd.create') }}",
                    dataType: 'json',
                    delay: 200,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.kode + ' - ' + item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            function tblIcd(){
                let id = "{{ $data->id }}";
                $('.tblIcd').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.icd.index') }}" + '/' + id,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'icd_id', name: 'icd_id', className: 'text-center'},
                        {data: 'diagnosa', name: 'diagnosa', className: 'text-capitalize'},
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
                        "emptyTable": "Tidak ada data diagnosa",
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
                    // if(alert('Sesi anda telah berakhir, Silahkan login ulang.')){
                    // } else {
                    //     window.location.reload();
                    // }
                    // alert( 'Sesi anda telah berakhir, harap lakukan login ulang dengan cara melakukan reload halaman ini.' ); // for test purpose
                    // return true;
                    // // reload page
                    // window.location.reload();
                    tblIcd()
                });
                $.fn.dataTable.ext.errMode = 'none';
            }
            tblIcd()
            // $('body').on('click', '#icdSave', function(e){
            //     e.preventDefault();

            //     $.ajax({
            //         data: $('#formIcd').serialize(),
            //         url: "{{ route('admin.icd.store') }}",
            //         type: "POST",
            //         dataType: 'json',
            //         success: function (data) {
            //             $('#formIcd').trigger("reset");
            //             alertBerhasil('Icd Berhasil Ditambahkan')
            //             $('.tblIcd').DataTable().ajax.reload();
            //         },
            //         error: function (data) {
            //             alertGagal('Icd Gagal Ditambahkan')
            //             console.log('Error:', data);
            //         }
            //     });
            // })
            $('body').on('click', '.deleteIcd', function () {
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
                        type: "DELETE",
                        url: "{{ route('admin.icd.store') }}" + '/' + id,
                        success: function (data) {
                            $('.tblIcd').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });
            function saveIcd(){
                let icd = $('#penyakit_icd').val()
                let kunjungan = $('#kunjunganID').val()
                if (icd == null){
                    console.log('icd kosong');
                } else {
                    $.ajax({
                        data: {
                            penyakit_icd: icd,
                            kunjungan: kunjungan,
                        },
                        url: "{{ route('admin.icd.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if (data == 'Success'){
                                alertBerhasil('Diagnosa Berhasil Ditambahkan')
                                $('.tblIcd').DataTable().ajax.reload();
                                $('#penyakit_icd').val(null).trigger('change');
                            } else {
                                alertGagal('Diagnosa maksimal 3')
                                $('.tblIcd').DataTable().ajax.reload();
                                $('#penyakit_icd').val(null).trigger('change');
                            }
                        },
                        error: function (data) {
                            alertGagal('Diagnosa Gagal Ditambahkan')
                        }
                    });
                }
            }

            // TINDAKAN PELAYANAN
            $('#produk_tindakan').select2();
            function tblTindakan(){
                let id = "{{ $data->id }}";
                $('.tblTindakan').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.tindakan-layanan.index') }}" + '/' + id,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'produk_id', name: 'produk_id', className: 'text-center'},
                        {data: 'jumlah', name: 'jumlah', className: 'text-center'},
                        {data: 'harga', name: 'harga', className: 'text-center'},
                        {data: 'total', name: 'total', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data tindakan",
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
                    // tblTindakan()
                });
                $.fn.dataTable.ext.errMode = 'none';
            }
            tblTindakan()
            function saveTindakan(){
                $('#btnSimpanTindakan').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#btnSimpanTindakan').attr('disabled', true);
                let produk = $('#produk_tindakan').val()
                let kunjungan = $('#kunjunganID').val()
                let jumlah = $('#jumlah_tindakan').val()
                if (produk == null){
                    alertGagal('Produk tindakan tidak boleh kosong');
                } else if (jumlah == ''){
                    alertGagal('Jumlah tindakan tidak boleh kosong');
                }
                else {
                    $.ajax({
                        data: {
                            produk_tindakan: produk,
                            kunjungan: kunjungan,
                            jumlah: jumlah,
                        },
                        url: "{{ route('admin.tindakan-layanan.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#formIcd').trigger("reset");
                            $('#produk_tindakan').val(null).trigger('change');
                            $('#jumlah_tindakan').val('');
                            alertBerhasil('Tindakan Berhasil Ditambahkan')
                            $('.tblTindakan').DataTable().ajax.reload();
                            $('#btnSimpanTindakan').attr('disabled', false);
                            $('#btnSimpanTindakan').html('Simpan');
                        },
                        error: function (data) {
                            alertGagal('Tindakan Gagal Ditambahkan')
                            $('#btnSimpanTindakan').attr('disabled', false);
                            $('#btnSimpanTindakan').html('Simpan');
                        }
                    });
                }
            }
            $('body').on('click', '#btnSimpanTindakan', function(e){
                e.preventDefault();
                saveTindakan()
            })
            $('body').on('click', '.deleteTindakan', function () {
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
                        url: "{{ route('admin.tindakan-layanan.store') }}" + '/' + id,
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                            $('.tblTindakan').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            // LABORATORIUM
            $('#produk_lab').select2()
            function tblLab(){
                let id = "{{ $data->id }}";
                $('.tblLab').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.lab.index') }}" + '/' + id,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kd_lab', name: 'kd_lab', className: 'text-center'},
                        {data: 'produk_lab_id', name: 'produk_lab_id', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data laboratorium",
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
                    // tblLab()
                });
                $.fn.dataTable.ext.errMode = 'none';
            }
            tblLab()
            function saveLab(){
                let lab = $('#produk_lab').val()
                let kunjungan = $('#kunjunganID').val()
                if (lab != null){
                    $.ajax({
                        data: {
                            produk_lab: lab,
                            kunjungan: kunjungan,
                        },
                        url: "{{ route('admin.lab.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#produk_lab').val(null).trigger('change');
                            alertBerhasil('Laboratorium Berhasil Ditambahkan')
                            $('.tblLab').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            alertGagal('Laboratorium Gagal Ditambahkan')
                        }
                    });
                }
            }
            $('body').on('click', '.deleteLab', function () {
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
                        url: "{{ route('admin.lab.store') }}" + '/' + id,
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                            $('.tblLab').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            // RADIOLOGI
            $('#produk_rad').select2()
            function tblRad(){
                let id = "{{ $data->id }}";
                $('.tblRad').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.radiologi.index') }}" + '/' + id,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kd_rad', name: 'kd_rad', className: 'text-center'},
                        {data: 'produk_rad_id', name: 'produk_rad_id', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data radiologi",
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
                    tblRad()
                });
                $.fn.dataTable.ext.errMode = 'none';
            }
            tblRad()
            function saveRad(){
                let rad = $('#produk_rad').val()
                let kunjungan = $('#kunjunganID').val()

                if (rad != null) {
                    $.ajax({
                        data: {
                            produk_rad: rad,
                            kunjungan: kunjungan,
                        },
                        url: "{{ route('admin.radiologi.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            alertBerhasil('Radiologi Berhasil Ditambahkan')
                            $('.tblRad').DataTable().ajax.reload();
                            $('#produk_rad').val(null).trigger('change');
                        },
                        error: function (data) {
                            alertGagal('Radiologi Gagal Ditambahkan')
                        }
                    });
                }
            }
            $('body').on('click', '.deleteRad', function () {
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
                        url: "{{ route('admin.radiologi.store') }}" + '/' + id,
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                            $('.tblRad').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            // FARMASI
            $('#obat_farmasi').select2()
            $('#keterangan_farmasi').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    saveFarmasi()
                }
            });
            function tblFarmasi(){
                let id = "{{ $data->id }}";
                $('.tblFarmasi').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'responsive': true,
                    'ajax': "{{ route('admin.farmasi.index') }}" + '/' + id,
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kd_farmasi', name: 'kd_farmasi', className: 'text-center'},
                        {data: 'obat_id', name: 'obat_id', className: 'text-left fst-italic'},
                        {data: 'jumlah', name: 'jumlah', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data order farmasi",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
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
                    tblFarmasi()
                });
                $.fn.dataTable.ext.errMode = 'none';
            }
            tblFarmasi()
            $('body').on('click', '#btnSaveFarmasi', function (e){
                e.preventDefault();
                $('#btnSaveFarmasi').prop('disabled', true);

                let obat = $('#obat_farmasi').val()
                let keterangan = $('#keterangan_farmasi').val()
                let kunjungan = $('#kunjunganID').val()
                let jumlah = $('#jumlah_farmasi').val()
                let cara = $('#cara_penggunaan_obat').val()
                if (obat == null){
                    // swal("Gagal !!", "Pilih Obat Terlebih Dahulu", "error");
                    alertGagal('Pilih Obat Terlebih Dahulu')
                } else if (jumlah == ''){
                    // swal("Gagal !!", "Jumlah Obat Tidak Boleh Kosong", "error");
                    alertGagal('Jumlah Obat Tidak Boleh Kosong')
                } else if (keterangan == ''){
                    // swal("Gagal !!", "Cara Penggunaan Tidak Boleh Kosong", "error");
                    alertGagal('Cara Penggunaan Tidak Boleh Kosong')
                } else {
                    $.ajax({
                        data: {
                            obat_farmasi: obat,
                            keterangan: keterangan,
                            kunjungan: kunjungan,
                            jumlah: jumlah,
                            cara: cara,
                            pagi: $('#pagi').val(),
                            siang: $('#siang').val(),
                            malam: $('#malam').val(),
                        },
                        url: "{{ route('admin.farmasi.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            alertBerhasil('Farmasi Berhasil Ditambahkan')
                            $('.tblFarmasi').DataTable().ajax.reload();
                            $('#obat_farmasi').val('').trigger('change')
                            $('#keterangan_farmasi').val('')
                            $('#jumlah_farmasi').val('')
                            $('#btnSaveFarmasi').prop('disabled', false);
                            $('#obat_farmasi').val('sebelum_makan')
                            $('#pagi').val('0')
                            $('#siang').val('0')
                            $('#malam').val('0')
                            $('#pagiTemp').prop('checked', false);
                            $('#siangTemp').prop('checked', false);
                            $('#malamTemp').prop('checked', false);
                            refreshObat()
                        },
                        error: function (data) {
                            alertGagal('Farmasi Gagal Ditambahkan')
                        }
                    });
                }
                $('#btnSaveFarmasi').prop('disabled', false);
            })
            $('body').on('change', '#jumlah_farmasi', function(){
                let jumlah = $(this).val()
                let obat = $('#obat_farmasi').val()
                if (obat == null){
                    // swal("Gagal !!", "Pilih Obat Terlebih Dahulu", "error");
                    alertGagal('Pilih Obat Terlebih Dahulu')
                } else {
                    if (jumlah == ''){
                        // swal("Gagal !!", "Jumlah Obat Tidak Boleh Kosong", "error");
                        alertGagal('Jumlah Obat Tidak Boleh Kosong')
                    } else {
                        $.ajax({
                            data: {
                                obat: obat,
                                jumlah: jumlah,
                            },
                            url: "{{ route('admin.obat.index') }}" + '/1',
                            type: "GET",
                            dataType: 'json',
                            success: function (data) {
                                if (data == 0){
                                    swal("Gagal !!", "Stok Obat Tidak Mencukupi", "error");
                                    $('#jumlah_farmasi').val('')
                                    $('#jumlah_farmasi').focus('')
                                }
                            },
                            error: function (data) {
                                console.log('Error cek obat');
                            }
                        });
                    }
                }
            })

            $('body').on('click', '.deleteFarmasi', function () {
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
                        url: "{{ route('admin.farmasi.store') }}" + '/' + id,
                        success: function (data) {
                            swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                            $('.tblFarmasi').DataTable().ajax.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });
            function cekFarmasi(){
                let jumlah = $(this).val()
                let obat = $('#obat_farmasi').val()
                if (obat == null){
                    swal("Gagal !!", "Pilih Obat Terlebih Dahulu", "error");
                } else {
                    $.ajax({
                        data: {
                            obat: obat,
                            jumlah: jumlah,
                        },
                        url: "{{ route('admin.obat.index') }}" + '/1',
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            if (data == 0){
                                swal("Gagal !!", "Stok Obat Tidak Mencukupi", "error");
                                $('#jumlah_farmasi').val('')
                                $('#jumlah_farmasi').focus('')
                            }
                        },
                        error: function (data) {
                            console.log('Error cek obat');
                        }
                    });
                }
            }
            function refreshObat(){
                $.ajax({
                    url: "{{ route('admin.obat.create') }}",
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#obat_farmasi').empty();
                        $('#obat_farmasi').append('<option value="">Pilih Obat</option>');

                        $.each(data, function(key, value) {
                            $('#obat_farmasi').append('<option value="'+ value.id +'">'+ value.nama + ' (Stok : ' + value.stok + ')' + '</option>');
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
            $('#pagiTemp').on('change', function(){
                if ($(this).is(':checked')) {
                    $('#pagi').val(1)
                } else {
                    $('#pagi').val(0)
                }
            });
            $('#siangTemp').on('change', function(){
                if ($(this).is(':checked')) {
                    $('#siang').val(1)
                } else {
                    $('#siang').val(0)
                }
            });
            $('#malamTemp').on('change', function(){
                if ($(this).is(':checked')) {
                    $('#malam').val(1)
                } else {
                    $('#malam').val(0)
                }
            });

            // FARMASI RACIKAN
            $('#obat_farmasi_racikan').select2()
            $('#btnSimpanRacikan').click(() => {
                let kunjungan = $('#kunjunganID').val()
                let nama_racikan = $('#nama_farmasi_racikan').val()
                let jumlah_racikan = $('#jumlah_farmasi_racikan').val()
                let cara = $('#keterangan_farmasi_racikan').val()
                let obat = $('#obat_farmasi_racikan').val()
                let jumlah = $('#jumlah_obat_racikan').val()
                if (nama_racikan == ''){
                    alertGagal('Nama Racikan Tidak Boleh Kosong')
                } else if (jumlah_racikan == ''){
                    alertGagal('Jumlah Racikan Tidak Boleh Kosong')
                } else if (cara == ''){
                    alertGagal('Cara Pakai Racikan Tidak Boleh Kosong')
                } else if (obat == null){
                    alertGagal('Pilih Obat Terlebih Dahulu')
                } else if (jumlah == ''){
                    alertGagal('Jumlah Obat Tidak Boleh Kosong')
                } else {
                    $.ajax({
                        data: {
                            nama_racikan: nama_racikan,
                            jumlah_racikan: jumlah_racikan,
                            cara: cara,
                            obat: obat,
                            jumlah: jumlah,
                            kunjungan: kunjungan,
                        },
                        url: "{{ route('admin.farmasi-racikan.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            alertBerhasil('Data Berhasil Ditambahkan')
                            tableRacikan()
                            $('#obat_farmasi_racikan').val('').trigger('change')
                            $('#jumlah_obat_racikan').val('')
                        },
                        error: function (data) {
                            alertGagal('Data Gagal Ditambahkan')
                        }
                    });
                }
            })

            tableRacikan = () => {
                $.ajax({
                    url: "{{ route('admin.farmasi-racikan.index') }}" + '/' + $('#kunjunganID').val(),
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#tblFarmasiRacikan').empty()
                        if (data.length == 0){
                            $('#tblFarmasiRacikan').append(`
                                <tr>
                                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                                </tr>
                            `)
                        } else {
                            $('#nama_farmasi_racikan').val(data[0].nama_racikan)
                            $('#jumlah_farmasi_racikan').val(data[0].jumlah_racikan)
                            $('#keterangan_farmasi_racikan').val(data[0].cara_penggunaan)
                            $.each(data, function(key, value) {
                                $('#tblFarmasiRacikan').append(`
                                    <tr>
                                        <td>`+ value.obat.nama +`</td>
                                        <td class="text-center">`+ value.jumlah +`</td>
                                        <td class="text-center">
                                            <div class="list-icons d-inline-flex">
                                                <a href="javascript:void(0)" data-id="`+ value.id +`" data-kunjungan="`+ value.kunjungan_id +`" class="list-icons-item text-danger me-10 hapusFarmasiRacikan" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                    <i class="fad fa-trash-alt"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                `)
                            });
                        }

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
            tableRacikan()

            $('body').on('click', '.hapusFarmasiRacikan', function(e){
                let id = $(this).data('id')
                $.ajax({
                    url: "{{ route('admin.farmasi-racikan.index') }}" + '/' + id,
                    type: "DELETE",
                    dataType: 'json',
                    success: function (data) {
                        tableRacikan()
                    },
                    error: function (data) {
                        alertGagal('Gagal Dihapus')
                    }
                });
            })

            $('#jumlah_obat_racikan').change((e) => {
                // console.log(e.target.value);
                let jumlah = $('#jumlah_obat_racikan').val()
                let obat = $('#obat_farmasi_racikan').val()
                if (obat == null){
                    alertGagal('Pilih Obat Terlebih Dahulu')
                } else {
                    if (jumlah == ''){
                        alertGagal('Jumlah Obat Tidak Boleh Kosong')
                    } else {
                        $.ajax({
                            data: {
                                obat: obat,
                                jumlah: jumlah,
                            },
                            url: "{{ route('admin.obat.index') }}" + '/1',
                            type: "GET",
                            dataType: 'json',
                            success: function (data) {
                                if (data == 0){
                                    swal("Gagal !!", "Stok Obat Tidak Mencukupi", "error");
                                    $('#jumlah_obat_racikan').val('')
                                    $('#jumlah_obat_racikan').focus('')
                                }
                            },
                            error: function (data) {
                                console.log('Error cek obat');
                            }
                        });
                    }
                }
            })

            $('#btnSaveFarmasiRacikan').click(() => {
                let kunjungan = $('#kunjunganID').val()
                $.ajax({
                    data: {
                        kunjungan: kunjungan,
                    },
                    url: "{{ route('admin.farmasi-racikan.store') }}" + '/' + kunjungan,
                    type: "PUT",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Order Racikan Berhasil Ditambahkan')
                        $('.tblFarmasi').DataTable().ajax.reload();
                        refreshObat()
                        tableRacikan()
                        $('#nama_farmasi_racikan').val('')
                        $('#jumlah_farmasi_racikan').val('')
                        $('#keterangan_farmasi_racikan').val('')
                        $('#obat_farmasi_racikan').val('').trigger('change')
                        $('#jumlah_obat_racikan').val('')
                    },
                    error: function (data) {
                        alertGagal('Order Racikan Gagal Ditambahkan')
                    }
                });
            })


            // Catatan
            $('#provinsi').select2()
            function catatan(){
                let id = "{{ $data->id }}";
                $.ajax({
                    url: "{{ route('admin.catatan.index') }}" + '/' + id,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        if (data != 'kosong'){
                            $('#catatanID').val(data.id)
                            $('#makanan').val(data.alergi_makanan);
                            $('#udara').val(data.alergi_udara);
                            $('#obat_obatan').val(data.alergi_obat);
                            $('#prognosa').val(data.prognosa);
                            $('#Csubyektif').val(data.subyektif);
                            $('#Ckeluhan_utama').val(data.keluhan_utama);
                            $('#Ckesadaran').val(data.kesadaran);
                            $('#Csuhu').val(data.suhu);
                            $('#Ctekanan_darah').val(data.tekanan_darah);
                            $('#Csistole').val(data.sistole);
                            $('#Cdiastole').val(data.diastole);
                            $('#Crespiratory').val(data.respiratory_rate);
                            $('#Cheart').val(data.heart_rate);
                            // $('#Cnadi').val(data.nadi);
                            // $('#Cnafas').val(data.nafas);
                            // $('#Cspo2').val(data.spo2);
                            $('#Ctinggi_badan').val(data.tinggi_badan);
                            $('#Cberat_badan').val(data.berat_badan);
                            $('#Clingkar_perut').val(data.lingkar_perut);
                            $('#Cassesment').val(data.assesment);
                            $('#Cplanning').val(data.planning);
                            $('#Cstatus_lokalis').val(data.status_lokalis);
                            $('#tindak_lanjut').val(data.tindak_lanjut);
                            $('#keterangan_tindak_lanjut').val(data.keterangan);
                            $('#tgl_kontrol_ulang').val(data.tgl_kontrol_ulang);
                            $('#spesialis_rujuk').val(data.spesialis_rujuk);
                            $('#rs_rujuk').val(data.rs_rujuk);
                            $('#non_kapitasi').val(data.non_kapitasi);
                            $('#kll').val(data.kll);
                            if (data.surat_keterangan == ''){
                                $('#surat_keterangan').val('tidak_ada')
                            } else {
                                $('#surat_keterangan').val(data.surat_keterangan);
                            }
                            $('#jumlah_hari').val(data.surat_jumlah_hari);
                            $('#tanggal_surat').val(data.surat_tanggal_mulai);
                            $('#tanggal_surat_end').val(data.surat_tanggal_selesai);
                            $('#keperluan_surat').val(data.keperluan_surat);
                            $('#keterangan_surat_sehat').val(data.keterangan_surat);
                            if (data.kll == null){
                                $('#kll').val('tidak');
                            }
                            cariIMT();
                            pemeriksaanFisik();
                            tindakLanjut();
                            suratKeterangan();
                        }

                    },
                    error: function (data) {
                        console.log('Data Tidak Tersedia');
                        window.reload();
                    }
                });
            }
            catatan()
            $('body').on('click', '#catatanSave', function(e){
                e.preventDefault();
                $('#catatanSave').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#catatanSave').attr('disabled', true)
                // if (cekCatatan()){
                    $.ajax({
                        data: $('#formCatatan').serialize(),
                        url: "{{ route('admin.catatan.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#formCatatan').trigger("reset");
                            alertBerhasil('Data berhasil disimpan');
                            catatan()
                            $('#catatanSave').attr('disabled', false)
                            $('#catatanSave').html('<i class="ti-save-alt"></i> Simpan')
                        },
                        error: function (data) {
                            alertGagal('Data gagal disimpan');
                            $('#catatanSave').attr('disabled', false)
                            $('#catatanSave').html('<i class="ti-save-alt"></i> Simpan')
                        }
                    });
                // }

            })
            $('body').on('change', '#provinsi', function () {
                // e.preventDefault();
                var provinsi = $('#provinsi').val()
                var param;
                if (provinsi == ''){
                    param = 1;
                } else {
                    param = provinsi;
                }

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.kota.index') }}" + '/' + param,
                    success: function (data) {
                        $('#kota').empty();
                        $('#kota').select2({
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
            $('body').on('change', '#kll', function(e){
                let kll = $('#kll').val()
                if (kll == 'ya'){
                    $('#divProvinsi').removeClass('d-none')
                    $('#divKota').removeClass('d-none')
                    $('#divKecamatan').removeClass('d-none')
                } else {
                    $('#divProvinsi').addClass('d-none')
                    $('#divKota').addClass('d-none')
                    $('#divKecamatan').addClass('d-none')
                }
            })
            function cekCatatan(){
                let anamnesa = $('#Csubyektif').val()
                let tinggi_badan = $('#Ctinggi_badan').val()
                let berat_badan = $('#Cberat_badan').val()
                let lingkar_perut = $('#Clingkar_perut').val()
                let sistole = $('#Csistole').val()
                let diastole = $('#Cdiastole').val()
                let respiratory = $('#Crespiratory').val()
                let heart_rate = $('#Cheart').val()
                let suhu  = $('#Csuhu').val()
                let lokalis = $('#Cstatus_lokalis').val()
                let prognosa = $('#prognosa').val()
                let tindak_lanjut = $('#tindak_lanjut').val()
                let icd = 'true';
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    async: false,
                    global: false,
                    url: "{{ route('admin.icd.index') }}" + '/' + "{{ $data->id }}" + '/edit',
                    success: function (data) {
                        icd = data;
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

                if (anamnesa == ''){
                    alertGagal('Anamnesa tidak boleh kosong')
                    $('#Csubyektif').focus()
                    return false;
                } else if (tinggi_badan == ''){
                    alertGagal('Tinggi badan tidak boleh kosong')
                    $('#Ctinggi_badan').focus();
                    return false;
                } else if (berat_badan == ''){
                    alertGagal('Berat badan tidak boleh kosong')
                    $('#Cberat_badan').focus();
                    return false;
                } else if (lingkar_perut == ''){
                    alertGagal('Lingkar perut tidak boleh kosong')
                    $('#Clingkar_perut').focus();
                    return false;
                } else if (sistole == ''){
                    alertGagal('Sistole tidak boleh kosong')
                    $('#Csistole').focus();
                    return false;
                } else if (diastole == ''){
                    alertGagal('Diastole tidak boleh kosong')
                    $('#Cdiastole').focus();
                    return false;
                } else if (respiratory == ''){
                    alertGagal('Respiratory rate tidak boleh kosong')
                    $('#Crespiratory').focus();
                    return false;
                } else if (heart_rate == ''){
                    alertGagal('Heart rate tidak boleh kosong')
                    $('#Cheart').focus();
                    return false;
                } else if (suhu == ''){
                    alertGagal('Suhu tidak boleh kosong')
                    $('#Csuhu').focus();
                    return false;
                } else if (lokalis == ''){
                    alertGagal('Status lokalis tidak boleh kosong')
                    $('#Cstatus_lokalis').focus();
                    return false;
                } else if (prognosa == ''){
                    alertGagal('Prognosa tidak boleh kosong')
                    $('#prognosa').focus();
                    return false;
                } else if (tindak_lanjut == null){
                    alertGagal('Status pulang tidak boleh kosong')
                    $('#tindak_lanjut').focus();
                    return false;
                } else if (icd == false){
                    alertGagal('ICD tidak boleh kosong')
                    $('#icd').focus();
                    return false;
                } else {
                    return true;
                }
            }

            // TEKANAN DARAH SISTOLE
            $('body').on('change', '#Csistole', function(e){
                let sistole = $('#Csistole').val()
                if (sistole >= 140){
                    $('#Csistole2').text(': Hipertensi')
                    $('#Csistole').addClass('bg-danger')
                    $('#Csistole').removeClass('bg-warning')
                    $('#Csistole').removeClass('bg-success')
                } else if (sistole >= 121 && sistole <= 139){
                    $('#Csistole2').text(': Prehipertensi')
                    $('#Csistole').addClass('bg-warning')
                    $('#Csistole').removeClass('bg-danger')
                    $('#Csistole').removeClass('bg-success')
                } else if (sistole >= 90 && sistole <= 120){
                    $('#Csistole2').text(': Normal')
                    $('#Csistole').addClass('bg-success')
                    $('#Csistole').removeClass('bg-warning')
                    $('#Csistole').removeClass('bg-danger')
                } else if (sistole < 90){
                    $('#Csistole2').text(': Hipotensi')
                    $('#Csistole').addClass('bg-danger')
                    $('#Csistole').removeClass('bg-warning')
                    $('#Csistole').removeClass('bg-success')
                }
            })
            // TEKANAN DARAH DIASTOLE
            $('body').on('change', '#Cdiastole', function(e){
                let diastole = $('#Cdiastole').val()
                if (diastole > 90){
                    $('#Cdiastole2').text(': Hipertensi')
                    $('#Cdiastole').addClass('bg-danger')
                    $('#Cdiastole').removeClass('bg-warning')
                    $('#Cdiastole').removeClass('bg-success')
                } else if (diastole >= 80 && diastole <= 90){
                    $('#Cdiastole2').text(': Prehipertensi')
                    $('#Cdiastole').addClass('bg-warning')
                    $('#Cdiastole').removeClass('bg-danger')
                    $('#Cdiastole').removeClass('bg-success')
                } else if (diastole >= 60 && diastole <= 79){
                    $('#Cdiastole2').text(': Normal')
                    $('#Cdiastole').addClass('bg-success')
                    $('#Cdiastole').removeClass('bg-warning')
                    $('#Cdiastole').removeClass('bg-danger')
                } else if (diastole < 60){
                    $('#Cdiastole2').text(': Hipotensi')
                    $('#Cdiastole').addClass('bg-danger')
                    $('#Cdiastole').removeClass('bg-warning')
                    $('#Cdiastole').removeClass('bg-success')
                }
            })
            // Respiratory Rate
            $('body').on('change', '#Crespiratory', function(e){
                let respiratory = $('#Crespiratory').val()
                if (respiratory >= 21){
                    $('#Crespiratory2').text(': Hiperventilasi')
                    $('#Crespiratory').addClass('bg-danger')
                    $('#Crespiratory').removeClass('bg-warning')
                    $('#Crespiratory').removeClass('bg-success')
                } else if (respiratory >= 16 && respiratory <= 20){
                    $('#Crespiratory2').text(': Normal')
                    $('#Crespiratory').addClass('bg-success')
                    $('#Crespiratory').removeClass('bg-warning')
                    $('#Crespiratory').removeClass('bg-danger')
                }
                // else if (respiratory >= 12 && respiratory <= 20){
                //     $('#Crespiratory2').text(': Hipoksi')
                //     $('#Crespiratory').addClass('bg-warning')
                //     $('#Crespiratory').removeClass('bg-danger')
                //     $('#Crespiratory').removeClass('bg-success')
                // }
                else if (respiratory < 16){
                    $('#Crespiratory2').text(': Hipoventilasi')
                    $('#Crespiratory').addClass('bg-warning')
                    $('#Crespiratory').removeClass('bg-danger')
                    $('#Crespiratory').removeClass('bg-success')
                }
            })
            // Heart Rate
            $('body').on('change', '#Cheart', function(e){
                let heart = $('#Cheart').val()
                if (heart >= 101){
                    $('#Cheart2').text(': Takikardia')
                    $('#Cheart').addClass('bg-danger')
                    $('#Cheart').removeClass('bg-warning')
                    $('#Cheart').removeClass('bg-success')
                } else if (heart >= 60 && heart <= 100){
                    $('#Cheart2').text(': Normal')
                    $('#Cheart').addClass('bg-success')
                    $('#Cheart').removeClass('bg-warning')
                    $('#Cheart').removeClass('bg-danger')
                } else if (heart >= 41 && heart <= 59){
                    $('#Cheart2').text(': Bradikardia')
                    $('#Cheart').addClass('bg-warning')
                    $('#Cheart').removeClass('bg-danger')
                    $('#Cheart').removeClass('bg-success')
                } else if (heart < 41){
                    $('#Cheart2').text(': Bradikardia')
                    $('#Cheart').addClass('bg-warning')
                    $('#Cheart').removeClass('bg-danger')
                    $('#Cheart').removeClass('bg-success')
                }
            })
            // Suhu Badan
            $('body').on('change', '#Csuhu', function(e){
                let temperature = $('#Csuhu').val()
                if (temperature >= 38){
                    $('#Csuhu2').text(': Demam')
                    $('#Csuhu').addClass('bg-danger')
                    $('#Csuhu').removeClass('bg-warning')
                    $('#Csuhu').removeClass('bg-success')
                } else if (temperature >= 36.5 && temperature <= 37.9){
                    $('#Csuhu2').text(': Normal')
                    $('#Csuhu').addClass('bg-success')
                    $('#Csuhu').removeClass('bg-warning')
                    $('#Csuhu').removeClass('bg-danger')
                } else if (temperature >= 35 && temperature <= 36.4){
                    $('#Csuhu2').text(': Hipotermia')
                    $('#Csuhu').addClass('bg-warning')
                    $('#Csuhu').removeClass('bg-danger')
                    $('#Csuhu').removeClass('bg-success')
                } else if (temperature < 35){
                    $('#Csuhu2').text(': Hipotermia')
                    $('#Csuhu').addClass('bg-warning')
                    $('#Csuhu').removeClass('bg-danger')
                    $('#Csuhu').removeClass('bg-success')
                }
            })
            function pemeriksaanFisik(){
                let sistole = $('#Csistole').val()
                if (sistole != ''){
                    if (sistole >= 140){
                        $('#Csistole2').text(': Hipertensi')
                        $('#Csistole').addClass('bg-danger')
                        $('#Csistole').removeClass('bg-warning')
                        $('#Csistole').removeClass('bg-success')
                    } else if (sistole >= 121 && sistole <= 139){
                        $('#Csistole2').text(': Prehipertensi')
                        $('#Csistole').addClass('bg-warning')
                        $('#Csistole').removeClass('bg-danger')
                        $('#Csistole').removeClass('bg-success')
                    } else if (sistole >= 90 && sistole <= 120){
                        $('#Csistole2').text(': Normal')
                        $('#Csistole').addClass('bg-success')
                        $('#Csistole').removeClass('bg-warning')
                        $('#Csistole').removeClass('bg-danger')
                    } else if (sistole < 90){
                        $('#Csistole2').text(': Hipotensi')
                        $('#Csistole').addClass('bg-danger')
                        $('#Csistole').removeClass('bg-warning')
                        $('#Csistole').removeClass('bg-success')
                    }
                }

                let diastole = $('#Cdiastole').val()
                if (diastole != ''){
                    if (diastole >= 90){
                        $('#Cdiastole2').text(': Hipertensi')
                        $('#Cdiastole').addClass('bg-danger')
                        $('#Cdiastole').removeClass('bg-warning')
                        $('#Cdiastole').removeClass('bg-success')
                    } else if (diastole >= 80 && diastole <= 89){
                        $('#Cdiastole2').text(': Prehipertensi')
                        $('#Cdiastole').addClass('bg-warning')
                        $('#Cdiastole').removeClass('bg-danger')
                        $('#Cdiastole').removeClass('bg-success')
                    } else if (diastole >= 60 && diastole <= 79){
                        $('#Cdiastole2').text(': Normal')
                        $('#Cdiastole').addClass('bg-success')
                        $('#Cdiastole').removeClass('bg-warning')
                        $('#Cdiastole').removeClass('bg-danger')
                    } else if (diastole < 60){
                        $('#Cdiastole2').text(': Hipotensi')
                        $('#Cdiastole').addClass('bg-danger')
                        $('#Cdiastole').removeClass('bg-warning')
                        $('#Cdiastole').removeClass('bg-success')
                    }
                }

                let respiratory = $('#Crespiratory').val()
                if (respiratory != ''){
                    if (respiratory >= 21){
                        $('#Crespiratory2').text(': Hiperventilasi')
                        $('#Crespiratory').addClass('bg-danger')
                        $('#Crespiratory').removeClass('bg-warning')
                        $('#Crespiratory').removeClass('bg-success')
                    } else if (respiratory >= 16 && respiratory <= 20){
                        $('#Crespiratory2').text(': Normal')
                        $('#Crespiratory').addClass('bg-success')
                        $('#Crespiratory').removeClass('bg-warning')
                        $('#Crespiratory').removeClass('bg-danger')
                    }
                    else if (respiratory < 16){
                        $('#Crespiratory2').text(': Hipoventilasi')
                        $('#Crespiratory').addClass('bg-warning')
                        $('#Crespiratory').removeClass('bg-danger')
                        $('#Crespiratory').removeClass('bg-success')
                    }
                }

                let heart = $('#Cheart').val()
                if (heart != ''){
                    if (heart >= 101){
                        $('#Cheart2').text(': Takikardia')
                        $('#Cheart').addClass('bg-danger')
                        $('#Cheart').removeClass('bg-warning')
                        $('#Cheart').removeClass('bg-success')
                    } else if (heart >= 60 && heart <= 100){
                        $('#Cheart2').text(': Normal')
                        $('#Cheart').addClass('bg-success')
                        $('#Cheart').removeClass('bg-warning')
                        $('#Cheart').removeClass('bg-danger')
                    } else if (heart >= 41 && heart <= 59){
                        $('#Cheart2').text(': Bradikardia')
                        $('#Cheart').addClass('bg-warning')
                        $('#Cheart').removeClass('bg-danger')
                        $('#Cheart').removeClass('bg-success')
                    } else if (heart < 41){
                        $('#Cheart2').text(': Bradikardia')
                        $('#Cheart').addClass('bg-warning')
                        $('#Cheart').removeClass('bg-danger')
                        $('#Cheart').removeClass('bg-success')
                    }
                }

                let temperature = $('#Csuhu').val()
                if (temperature != ''){
                    if (temperature >= 38){
                        $('#Csuhu2').text(': Demam')
                        $('#Csuhu').addClass('bg-danger')
                        $('#Csuhu').removeClass('bg-warning')
                        $('#Csuhu').removeClass('bg-success')
                    } else if (temperature >= 36.5 && temperature <= 37.9){
                        $('#Csuhu2').text(': Normal')
                        $('#Csuhu').addClass('bg-success')
                        $('#Csuhu').removeClass('bg-warning')
                        $('#Csuhu').removeClass('bg-danger')
                    } else if (temperature >= 35 && temperature <= 36.4){
                        $('#Csuhu2').text(': Hipotermia')
                        $('#Csuhu').addClass('bg-warning')
                        $('#Csuhu').removeClass('bg-danger')
                        $('#Csuhu').removeClass('bg-success')
                    } else if (temperature < 35){
                        $('#Csuhu2').text(': Hipotermia')
                        $('#Csuhu').addClass('bg-warning')
                        $('#Csuhu').removeClass('bg-danger')
                        $('#Csuhu').removeClass('bg-success')
                    }
                }

            }

            // TINDAK LANJUT
            $('body').on('change', '#tindak_lanjut', function (e) {
                let tindak = $('#tindak_lanjut').val()
                if (tindak == 'kontrol_ulang'){
                    $('#tku').removeClass('d-none')
                    $('#sp').addClass('d-none')
                    $('#krs').addClass('d-none')
                } else if (tindak == 'rujuk'){
                    $('#tku').addClass('d-none')
                    $('#sp').removeClass('d-none')
                    $('#krs').removeClass('d-none')
                } else {
                    $('#tku').addClass('d-none')
                    $('#sp').addClass('d-none')
                    $('#krs').addClass('d-none')
                }
            })
            function tindakLanjut(){
                let tindak = $('#tindak_lanjut').val()
                if (tindak == 'kontrol_ulang'){
                    $('#tku').removeClass('d-none')
                    $('#sp').addClass('d-none')
                    $('#krs').addClass('d-none')
                } else if (tindak == 'rujuk'){
                    $('#tku').addClass('d-none')
                    $('#sp').removeClass('d-none')
                    $('#krs').removeClass('d-none')
                } else {
                    $('#tku').addClass('d-none')
                    $('#sp').addClass('d-none')
                    $('#krs').addClass('d-none')
                }
            }
            // SURAT KETERANGAN
            $('body').on('change', '#surat_keterangan', function (e){
                let surat = $('#surat_keterangan').val()
                if (surat == '' || surat == 'tidak_ada'){
                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                } else if (surat == 'surat_sakit') {
                    $('#jumlahHari').removeClass('d-none')
                    $('#tanggalSurat').removeClass('d-none')
                    $('#tanggalSuratEnd').removeClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                } else if (surat == 'surat_sehat'){
                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').removeClass('d-none')
                    $('#keteranganSuratSehat').removeClass('d-none')
                } else if (surat == 'surat_berobat'){
                    // $('#jumlahHari').removeClass('d-none')
                    // $('#tanggalSurat').removeClass('d-none')
                    // $('#tanggalSuratEnd').removeClass('d-none')
                    // $('#keperluanSurat').addClass('d-none')
                    // $('#keteranganSuratSehat').addClass('d-none')

                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                } else {
                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                }
            })
            function suratKeterangan(){
                let surat = $('#surat_keterangan').val()
                if (surat == '' || surat == 'tidak_ada' || surat == null){
                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                } else if (surat == 'surat_sakit') {
                    $('#jumlahHari').removeClass('d-none')
                    $('#tanggalSurat').removeClass('d-none')
                    $('#tanggalSuratEnd').removeClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                } else if (surat == 'surat_sehat'){
                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').removeClass('d-none')
                    $('#keteranganSuratSehat').removeClass('d-none')
                } else {
                    $('#jumlahHari').addClass('d-none')
                    $('#tanggalSurat').addClass('d-none')
                    $('#tanggalSuratEnd').addClass('d-none')
                    $('#keperluanSurat').addClass('d-none')
                    $('#keteranganSuratSehat').addClass('d-none')
                }
            }
            $('body').on('change', '#jumlah_hari', function (e){
                let tanggal = $('#tanggal_surat').val()
                let hari = $('#jumlah_hari').val()
                hari = parseInt(hari)-1;
                let date = new Date(tanggal);
                date.setDate(date.getDate() + parseInt(hari));
                let newDate = date.toISOString().slice(0,10);
                $('#tanggal_surat_end').val(newDate)
            })
            $('body').on('change', '#tanggal_surat', function (e){
                let tanggal = $('#tanggal_surat').val()
                let hari = $('#jumlah_hari').val()
                hari = parseInt(hari)-1;
                let date = new Date(tanggal);
                date.setDate(date.getDate() + parseInt(hari));
                let newDate = date.toISOString().slice(0,10);
                $('#tanggal_surat_end').val(newDate)
            })

            // BUTTON REFRESH RIWAYAT PASIEN
            $('.btnRefreshRiwayat').on('click', function(){
                let id = "{{ $data->id }}";
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "{{ route('admin.daftar-rwj.index') }}" + '/' + id,
                    beforeSend: function (data){
                        $('#tableBody').html('')
                        $('#tableBody').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>')
                    },
                    success: function (data) {
                        $('#divRiwayatPasien').html(data)
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
            function btnRefreshRiwayat(){
                let id = "{{ $data->id }}";
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "{{ route('admin.daftar-rwj.index') }}" + '/' + id,
                    success: function (data) {
                        $('#divRiwayatPasien').html(data)
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

            // BUTTON FINISH (SELESAI)
            $('#btn-selesai').on('click', function(){
                let id = "{{ $data->id }}";
                // $('#btn-selesai').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                if (cekCatatan()){
                    $.ajax({
                        data: $('#formCatatan').serialize(),
                        url: "{{ route('admin.catatan.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#formCatatan').trigger("reset");
                            catatan()
                        }
                    });
                    swal({
                        title: "Yakin Ingin Selesai Pelayanan ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, Selesai!",
                        closeOnConfirm: false,
                        cancelButtonText: 'Batal',
                    }, function() {
                        $.ajax({
                            data: {
                                'status': 'selesai',
                            },
                            type: "PUT",
                            dataType: 'json',
                            url: "{{ route('admin.layanan-rwj.index') }}" + '/' + id,
                            success: function (data) {
                                swal("Berhasil !!", "Data Berhasil Diselesaikan", "success");
                                window.location.href = "{{ route('admin.layanan-rwj.index') }}";
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    });
                }

            })
            $('#btn-belum').on('click', function(){
                let id = "{{ $data->id }}";
                swal({
                    title: "Yakin Ingin Edit Data ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya",
                    closeOnConfirm: false,
                    cancelButtonText: 'Batal',
                }, function() {
                    swal("Berhasil !!", "Data Berhasil Di Buka", "success");
                    $.ajax({
                        data: {
                            'status': 'diproses',
                        },
                        type: "PUT",
                        dataType: 'json',
                        url: "{{ route('admin.layanan-rwj.index') }}" + '/' + id,
                        success: function (data) {
                            window.location.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            })

            // BUTTON SYNC RIWAYAT ALERGI
            $('#syncAlergi').on('click', function(){
                $('#syncAlergi').html('<i class="fa fa-spinner fa-spin"></i> Loading')
                $('#syncAlergi').attr('disabled', true);
                let id = "{{ $data->id }}";
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('admin.sync-riwayat-alergi.index') }}" + '/' + id,
                    success: function (data) {
                        if (data.status == 200){
                            $('#makanan').val(data.data.alergi_makanan)
                            $('#udara').val(data.data.alergi_udara)
                            $('#obat_obatan').val(data.data.alergi_obat)
                            $('#Ctinggi_badan').val(data.data.tinggi_badan)
                            $('#Cberat_badan').val(data.data.berat_badan)
                            $('#Clingkar_perut').val(data.data.lingkar_perut)
                            $('#Cimt').val(data.data.imt)
                            IMT();
                            $('#syncAlergi').html('<i class="fad fa-file-medical"></i>  Ambil Data')
                            $('#syncAlergi').attr('disabled', false);
                            alertBerhasil('Data berhasil di ambil')
                        } else {
                            $('#syncAlergi').html('<i class="fad fa-file-medical"></i>  Ambil Data')
                            $('#syncAlergi').attr('disabled', false);
                            alertGagal('Data sebelumnya tidak ada');
                        }
                    },
                    error: function (data) {
                        // swal("Gagal !!", "Maaf Ini Pasien Baru, Silahkan Isi Data", "error");
                        $('#syncAlergi').html('<i class="fad fa-file-medical"></i>  Ambil Data')
                        $('#syncAlergi').attr('disabled', false);
                        alertGagal('Maaf Ini Pasien Baru, Silahkan Isi Data')
                    }
                });
            })

            // MENCARI IMT
            $('#Ctinggi_badan').on('change', function(){
                let tinggi = $('#Ctinggi_badan').val()
                let berat = $('#Cberat_badan').val()
                if (tinggi == '' || tinggi == '0'){
                    $('#Cimt').val('')
                } else if (berat == '' || berat == '0'){
                    $('#Cimt').val()
                } else {
                    let imt = berat / ((tinggi/100) * (tinggi/100))
                    $('#Cimt').val(imt.toFixed(2))
                    IMT()
                }

            })
            $('#Cberat_badan').on('change', function(){
                let tinggi = $('#Ctinggi_badan').val()
                let berat = $('#Cberat_badan').val()
                if (tinggi == '' || tinggi == '0'){
                    $('#Cimt').val('')
                } else if (berat == '' || berat == '0'){
                    $('#Cimt').val()
                } else {
                    let imt = berat / ((tinggi/100) * (tinggi/100))
                    $('#Cimt').val(imt.toFixed(2))
                    IMT()
                }
            })
            function cariIMT(){
                let tinggi = $('#Ctinggi_badan').val()
                let berat = $('#Cberat_badan').val()
                if (tinggi == '' || tinggi == '0'){
                    $('#Cimt').val('')
                } else if (berat == '' || berat == '0'){
                    $('#Cimt').val()
                } else {
                    let imt = berat / ((tinggi/100) * (tinggi/100))
                    $('#Cimt').val(imt.toFixed(2))
                    IMT()
                }
            }
            // HASIL IMT
            function IMT(){
                let imt = $('#Cimt').val()
                if (imt < 18.5) {
                    // $('#Cimt_hasil').val('Kurus')
                    $('#hasilNamaIMT').text('KURANG GIZI')
                    $('#Cimt').removeClass('bg-success');
                    $('#Cimt2').removeClass('bg-success');
                    $('#Cimt').removeClass('bg-warning');
                    $('#Cimt2').removeClass('bg-warning');
                    $('#Cimt').addClass('bg-danger');
                    $('#Cimt2').addClass('bg-danger');
                    // $('#hasilIMT').html(`<div class="alert alert-danger alert-dismissible">
					// 			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> STATUS IMT : KURANG GIZI </div>`)
                } else if (imt >= 18.5 && imt <= 24.9) {
                    // $('#Cimt_hasil').val('Normal')
                    $('#hasilNamaIMT').text('NORMAL')
                    $('#Cimt').removeClass('bg-danger');
                    $('#Cimt2').removeClass('bg-danger');
                    $('#Cimt').removeClass('bg-warning');
                    $('#Cimt2').removeClass('bg-warning');
                    $('#Cimt').addClass('bg-success');
                    $('#Cimt2').addClass('bg-success');
                    // $('#hasilIMT').html(`<div class="alert alert-success alert-dismissible">
					// 			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> STATUS IMT : NORMAL </div>`)
                } else if (imt >= 25 && imt <= 29.9) {
                    // $('#Cimt_hasil').val('Gemuk')
                    $('#hasilNamaIMT').text('GEMUK')
                    $('#Cimt').removeClass('bg-success');
                    $('#Cimt2').removeClass('bg-success');
                    $('#Cimt').removeClass('bg-danger');
                    $('#Cimt2').removeClass('bg-danger');
                    $('#Cimt').addClass('bg-warning');
                    $('#Cimt2').addClass('bg-warning');
                    // $('#hasilIMT').html(`<div class="alert alert-warning alert-dismissible">
					// 			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> STATUS IMT : GEMUK </div>`)
                } else if (imt >= 30) {
                    // $('#Cimt_hasil').val('Obesitas')
                    $('#hasilNamaIMT').text('OBESITAS')
                    $('#Cimt').removeClass('bg-success');
                    $('#Cimt2').removeClass('bg-success');
                    $('#Cimt').removeClass('bg-warning');
                    $('#Cimt2').removeClass('bg-warning');
                    $('#Cimt').addClass('bg-danger');
                    $('#Cimt2').addClass('bg-danger');
                    // $('#hasilIMT').html(`<div class="alert alert-danger alert-dismissible">
					// 			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> STATUS IMT : OBESITAS </div>`)
                } else {
                    $('#hasilNamaIMT').text('')
                    $('#Cimt').removeClass('bg-success');
                    $('#Cimt2').removeClass('bg-success');
                    $('#Cimt').removeClass('bg-warning');
                    $('#Cimt2').removeClass('bg-warning');
                    $('#Cimt').removeClass('bg-danger');
                    $('#Cimt2').removeClass('bg-danger');
                }
            }

            // UPLOAD FOTO ESTETIKA
            $('#photo').change(() => {
                // let file = $('#file').prop('files')[0]
                // let reader = new FileReader()
                // reader.onload = (e) => {
                //     $('#foto').attr('src', e.target.result)
                // }
                // reader.readAsDataURL(file)
                var formData = new FormData($('#formCatatan')[0]);

                $.ajax({
                    data: formData,
                    url: "{{ route('admin.upload-estetika') }}",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        alertBerhasil('Foto berhasil di upload')
                        hasilUpload()
                        $('#photo').val(null);
                        // alertSucces()
                        // $('#formInput').trigger("reset");
                        // $('#modalForm').modal('hide');
                        // $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertGagal('Foto gagal di upload')
                    }
                });
            })

            // HASIL UPLOAD FOTO_ESTETIKA
            hasilUpload = () => {
                let kunjungan = $('#kunjunganID').val()
                $.ajax({
                    url: "{{ route('admin.upload-estetika') }}" + '/' + kunjungan,
                    type: "GET",
                    dataType: 'html',
                    success: function (data) {
                        $('#hasil_foto').html(data)
                    },
                    error: function (data) {
                    }
                });
            }
            hasilUpload();

            // HAPUS FOTO ESTETIKA
            $('body').on('click', '#deleteEstetika', function (e){
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.estetika.index') }}" + '/' + id,
                    type: "DELETE",
                    dataType: 'json',
                    success: function (data) {
                        alertBerhasil('Foto berhasil di hapus');
                        hasilUpload()
                    },
                    error: function (data) {
                        alertGagal('Foto gagal di hapus');
                    }
                });
            })
        </script>
    @endpush
</x-layouts>
