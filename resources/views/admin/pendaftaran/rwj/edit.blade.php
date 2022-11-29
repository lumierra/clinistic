@section('title', 'Pasien')

<x-layouts>
    @push('style')
        <style>
            /* .select2-container{
                z-index:1061 !important;
            } */
            .modal-lg2 {
                max-width: 80% !important;
            }
        </style>
    @endpush
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Pendafataran Rawat Jalan</h3>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header with-border bg-primary">
                                <h4 class="box-title">Form Pendaftaran</h4>
                                <button class="waves-effect waves-light btn btn-primary-light btn-rounded btn-social mb-5 float-end" id="btnCariPasien">
                                    <i class="fal fa-search-plus"></i> Cari Pasien
                                </button>
                            </div>
                            <form class="form" id="formCari">
                                <div class="box-body">
                                    <div class="row pb-30">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <i class="fad fa-stretcher fs-100 text-primary fa-beat-fade"></i>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label"></label>
                                                        <input type="text" id="search" name="search" class="form-control" placeholder="Cari Data Pasien" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label"></label>
                                                        <select class="form-select" id="kategori" name="kategori">
                                                            <option value="rm">No. RM</option>
                                                            <option value="nik">NIK</option>
                                                        </select>
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
                                                        <input type="hidden" id="kdpasien" name="pasien" value="{{ $kunjungan->no_rm }}">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">No. RM</label>
                                                                <input value="{{ $kunjungan->no_rm }}" readonly type="text" id="rm" name="rm" class="form-control" placeholder="No. RM">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">NIK</label>
                                                                <input value="{{ $kunjungan->pasien->nik }}" readonly type="text" id="nik" name="nik" class="form-control" placeholder="NIK">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nama Lengkap</label>
                                                                    <input value="{{ $kunjungan->pasien->nama }}" readonly type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Tempat, Tgl. Lahir</label>
                                                                <input value="{{ $kunjungan->pasien->getTTL() }}" readonly type="text" id="ttl" name="ttl" class="form-control" placeholder="Tempat, Tgl. Lahir">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="form-label">Jenis Kelamin / Umur</label>
                                                                    <input value="{{ $kunjungan->pasien->getGender() }}" readonly type="text" id="gender" name="gender" class="form-control" placeholder="Jenis Kelamin / Umur">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea class="form-control" id="alamat" name="alamat" readonly>{{ $kunjungan->pasien->alamat }}</textarea>
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
                                                                <label class="form-label">Jenis Rujukan</label>
                                                                <select class="form-select" id="jenis_rujukan" name="jenis_rujukan">
                                                                    <option value="" selected>--Pilih--</option>
                                                                    @foreach ($rujukan as $item)
                                                                        <option value="{{ $item->id }}" {{ $kunjungan->kategori_rujukan_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">&nbsp;</label>
                                                                <select class="form-control" id="asal_rujukan" name="asal_rujukan">
                                                                    <option value="" selected>--Pilih--</option>
                                                                    @foreach ($asalRujukan as $item)
                                                                        <option value="{{ $item->id }}" {{ $item->id == $kunjungan->asal_rujukan_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Kelurahan</label>
                                                                <input value="{{ $kunjungan->keluhan_awal }}" type="text" id="keluhan" name="keluhan" class="form-control" placeholder="Keluhan" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Poliklinik</label>
                                                                <select class="form-select" id="poliklinik" name="poliklinik">
                                                                    <option value="" selected>--Pilih--</option>
                                                                    @foreach ($poli as $item)
                                                                        <option value="{{ $item->id }}" {{ $item->id == $kunjungan->poliklinik_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">DPJP</label>
                                                                <select class="form-select" id="dokter" name="dokter">
                                                                    <option value="" selected>--Pilih--</option>
                                                                    @foreach ($dokter as $item)
                                                                        <option value="{{ $item->id }}" {{ $item->id == $kunjungan->dokter_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Jaminan</label>
                                                                <div class="radio">
                                                                    <input name="jaminan" type="radio" id="umum" value="umum" {{ $kunjungan->status_jaminan == 'umum' ? 'checked' : '' }}>
                                                                    <label for="umum">Umum</label>
                                                                </div>
                                                                <div class="radio">
                                                                    <input name="jaminan" type="radio" id="asuransi" value="asuransi" {{ $kunjungan->status_jaminan == 'asuransi' ? 'checked' : '' }}>
                                                                    <label for="asuransi">Asuransi</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row {{ $kunjungan->status_jaminan == 'asuransi' ? '' : 'd-none' }}" id="jaminan2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Asuransi</label>
                                                                <select class="form-select" id="asuransi2" name="asuransi2">
                                                                    @foreach ($asuransi as $item)
                                                                        <option {{ $kunjungan->asuransi_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
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
                                    <a href="{{ route('admin.rawat-jalan.index') }}" id="btn-batal" class="btn btn-danger me-1">
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

    @push('script')
    <script src="{{ asset('template/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/toastr.js') }}"></script>
    <script src="{{ asset('template/js/pages/notification.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    {{-- <script src="{{ asset('template/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script> --}}

        <script>
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
            });



            // $(function () {
            // });

            // $('#kategori').val("{{ $kunjungan->kategori_rujukan_id }}").trigger('change');

            // Cari Pasien
            $('#search').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    cariPasien()
                }
            });

            function cariPasien(){
                let search = $('#search').val()
                let kategori = $('#kategori').val()
                if (search == ''){
                    searchKosong();
                } else {
                    $.ajax({
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
                            }
                        }
                    })
                }

            }
            $('#btnSearch').click(function (e) {
                e.preventDefault()
                cariPasien()
            })

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
                        url: "{{ route('admin.daftar-rwj.store') }}" + '/' + "{{ $kunjungan->id }}",
                        type: "PUT",
                        dataType: 'json',
                        success: function (data) {
                            $.toast({
                                heading: 'SUKSES',
                                text: 'Pendaftaran RWJ Berhasil !!!',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 2000
                            });
                            window.setTimeout( function() {
                                window.location.href = "{{ route('admin.rawat-jalan.index') }}";
                            }, 2000);
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
                    }
                })
                $('#modalForm').modal('hide');
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
                        data.map(function (item) {
                            $('#dokter').append(new Option(item.nama, item.id))
                        })
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
            function asuransi2(){
                let asuransi = $('#asuransi2').val()
                let pasien = $('#kdpasien').val()
                console.log(asuransi, pasien);
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
            }
            asuransi2();

            function searchKosong(){
                $.toast({
                    heading: 'GAGAL',
                    text: 'Masukkan No.RM atau NIK Pasien',
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500
                });
            }

        </script>
    @endpush
</x-layouts>
