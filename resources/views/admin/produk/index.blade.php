@section('title', 'Produk')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Produk"
                title2="Master"
                title3="Produk"
                >
            </x-breadcrumb>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-solid bg-primary bb-3 border-solid">
                            <div class="box-header with-border bg-primary">
                                <h3 class="box-title">Data Produk <i class="fad fa-tags"></i></h3>
                                <button class="waves-effect waves-light btn btn-primary3 btn-rounded btn-social1 btn-bitbucket1 mb-5 float-end text-dark" id="add">
                                    <i class="fal fa-plus-circle"></i> Tambah
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped table-hover dataServer" width="100%">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" width="1%">No</th>
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Klinik</th>
                                            <th>Harga Dokter</th>
                                            <th>Harga Perawat</th>
                                            <th>Harga Tindakan</th>
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
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Kategori Produk</label><br>
                    <select class="form-control" id="kategori" name="kategori">
                        <option value="" selected>--Pilih Kategori--</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row d-none" id="poliklinik">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Unit</label><br>
                    <select class="form-select" id="unit" name="unit">
                        <option value="" selected>--Pilih Unit--</option>
                        @foreach ($poliklinik as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Nama Produk</label><br>
                    <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Jasa Klinik</label><br>
                    <input type="text" class="form-control" id="harga_klinik" name="harga_klinik" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Jasa Dokter</label><br>
                    <input type="text" class="form-control" id="harga_dokter" name="harga_dokter" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Jasa Perawat</label><br>
                    <input type="text" class="form-control" id="harga_perawat" name="harga_perawat" autocomplete="off" required>
                </div>
            </div>
        </div>

        <div class="row d-none" id="rujukan">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Satuan Prouk Lab</label><br>
                    <select class="form-select" id="satuan" name="satuan" style="width:100%">
                        <option value="" selected>--Pilih Satuan--</option>
                        @foreach ($satuan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                    <label class="form-label">Nilai Rujukan</label><br>
                    <textarea class="form-control" id="nilai_rujukan" name="nilai_rujukan"></textarea>
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
            $('#satuan').select2()
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
                    'ajax': "{{ route('admin.produk.index') }}",
                    'columns': [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
                        {data: 'kategori', name: 'kategori', className: 'text-uppercase'},
                        {data: 'nama', name: 'nama', className: 'text-capitalize'},
                        {data: 'harga_klinik', name: 'harga_klinik', className: 'text-center'},
                        {data: 'harga_dokter', name: 'harga_dokter', className: 'text-center'},
                        {data: 'harga_perawat', name: 'harga_perawat', className: 'text-center'},
                        {data: 'harga', name: 'harga', className: 'text-center'},
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
                        "emptyTable": "Tidak ada data produk",
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
                $('#headerModal').html("Tambah Produk");
                $('#modalForm').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $('#headerModal').html("Edit Produk");
                $('#saveBtn').val("edit-jenis");
                $('#modalForm').modal('show');
                $.ajax({
                    url: "{{ route('admin.produk.index') }}" + '/' + product_id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').val(data.id);
                        $('#kategori').val(data.kategori_produk_id);
                        $('#nama').val(data.nama);
                        // $('#harga').val(data.harga);
                        $('#harga_klinik').val(data.harga_klinik);
                        $('#harga_dokter').val(data.harga_dokter);
                        $('#harga_perawat').val(data.harga_perawat);
                        if (data.kategori_produk_id == 1){
                            $('#poliklinik').removeClass('d-none');
                            $('#unit').val(data.poliklinik_id);
                        } else {
                            $('#poliklinik').addClass('d-none');
                            $('#unit').val('');
                        }
                        if (data.kategori_produk_id == 2){
                            $('#rujukan').removeClass('d-none');
                            $('#nilai_rujukan').val(data.nilai_rujukan);
                            $('#satuan').val(data.satuan_id).trigger('change');
                        } else {
                            $('#rujukan').addClass('d-none');
                            $('#nilai_rujukan').val('');
                            $('#satuan').val('').trigger('change');
                        }
                        // if (data.poliklinik_id == ''){
                        //     $('#poliklinik').addClass('d-none');
                        // } else {
                        //     $('#poliklinik').removeClass('d-none');
                        //     $('#unit').val(data.poliklinik_id);
                        // }
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
                    url: "{{ route('admin.produk.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alertSucces()
                        $('#formInput').trigger("reset");
                        $('#modalForm').modal('hide');
                        $('.dataServer').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        alertDanger()
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
                        url: "{{ route('admin.produk.store') }}" + '/' + id,
                        success: function (data) {
                            if (data.status == 200){
                                $('.dataServer').DataTable().ajax.reload();
                                swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                            } else {
                                swal("Gagal !!", "Data gagal dihapus dikarenakan sudah digunakan", "error");
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            $('body').on('change', '#kategori', function () {
                var kategori = $(this).val();
                if (kategori == 1){
                    $('#poliklinik').removeClass('d-none');
                    $('#rujukan').addClass('d-none');
                    $('#nilai_rujukan').val('');
                } else if (kategori == 2){
                    $('#rujukan').removeClass('d-none');
                    $('#poliklinik').addClass('d-none');
                    $('#unit').val('');
                } else {
                    $('#poliklinik').addClass('d-none');
                    $('#unit').val('');
                    $('#rujukan').addClass('d-none');
                    $('#nilai_rujukan').val('');
                }
            });

            $('#harga_klinik').on('keyup', function (e) {
                let harga = $('#harga_klinik').val()
                if (harga == ''){
                    $('#harga_klinik').val('')
                } else {
                    $('#harga_klinik').val(formatRupiah(harga, "Rp. "))
                }
            })
            $('#harga_dokter').on('keyup', function (e) {
                let harga = $('#harga_dokter').val()
                if (harga == ''){
                    $('#harga_dokter').val('')
                } else {
                    $('#harga_dokter').val(formatRupiah(harga, "Rp. "))
                }
            })
            $('#harga_perawat').on('keyup', function (e) {
                let harga = $('#harga_perawat').val()
                if (harga == ''){
                    $('#harga_perawat').val('')
                } else {
                    $('#harga_perawat').val(formatRupiah(harga, "Rp. "))
                }
            })

        </script>
        <script>
            // var rupiah = document.getElementById("hargaBeli");
            // rupiah.addEventListener("keyup", function (e) {
            //     // tambahkan 'Rp.' pada saat form di ketik gunakan fungsi formatRupiah() untuk
            //     // mengubah angka yang di ketik menjadi format angka
            //     rupiah.value = formatRupiah(this.value, "");
            // });
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
