<div class="">
    <form class="form" id="formCatatan">
        <input type="hidden" id="kunjunganID" name="kunjungan" value="{{ $data->id }}">
        <input type="hidden" id="catatanID" name="catatan" value="{{ $catatan->id ?? '' }}">
        <div class="box-body">
            <div class="row pb-15">
                <div class="col-lg-12">
                    <button type="button" id="syncAlergi" class="btn btn-sm btn-success"><i class="fad fa-file-medical"></i>  Ambil Data</button>
                </div>
            </div>
            <div class="row">
                <div class="{{ Auth::user()->role_id != 5 ? '' : 'd-none' }}">
                    <h4 class="box-title text-info mb-0"><i class="fad fa-user-md-chat me-15"></i> Anamnesis</h4>
                    <hr class="my-15">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label fw-bold">Keluhan Utama</label>
                            @php
                                if ($status == 'tidak'){
                                    $keluhan = $data->keluhan_awal;
                                } else {
                                    $keluhan = $catatan->keluhan_utama;
                                }
                            @endphp
                            <textarea rows="3" class="form-control" id="Ckeluhan_utama" name="keluhan_utama" placeholder="Keluhan Utama">{{ $keluhan }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label fw-bold">Anamnesa</label>
                            <textarea rows="3" class="form-control" id="Csubyektif" name="subyektif" placeholder="Anamnesa"></textarea>
                        </div>
                    </div>
                    {{-- RIWAYAT ALERGI --}}
                    <div class="col-md-12">
                        <div class="row">
                            <label class="form-label fw-bold">
                                Riwayat Alergi
                            </label>

                            <div class="col-md-3 col-12">
                                <label class="form-label">Makanan</label>
                                <select class="form-control" id="makanan" name="makanan" style="width: 100%;" required>
                                    <option disabled value="0">--Pilih--</option>
                                    <option value="tidak_ada" selected>Tidak Ada</option>
                                    <option value="seafood">Seafood</option>
                                    <option value="gandum">Gandum</option>
                                    <option value="susu_sapi">Susu Sapi</option>
                                    <option value="kacang_kacangan">Kacang-Kacangan</option>
                                    <option value="makanan_lain">Makanan Lain</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="form-label">Udara</label>
                                <select class="form-control" id="udara" name="udara" style="width: 100%;" required>
                                    <option disabled value="">--Pilih--</option>
                                    <option value="tidak_ada" selected>Tidak Ada</option>
                                    <option value="udara_panas">Udara Panas</option>
                                    <option value="udara_dingin">Udara Dingin</option>
                                    <option value="udara_kotor">Udara Kotor</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="form-label">Obat-Obatan</label>
                                <select class="form-control" id="obat_obatan" name="obat_obatan" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    <option value="antinflamasi">Antinflamasi</option>
                                    <option value="non_steroid">Non Steroid</option>
                                    <option value="aspirin">Aspirin</option>
                                    <option value="kortikosteroid">Kortikosteroid</option>
                                    <option value="insulin">Insulin</option>
                                    <option value="obat_obatan_lain">Obat-Obatan Lain</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- KECELAKAAN LALU LINTAS --}}
                    <div class="row pt-50">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label fw-bold">Kecelakaan Lalu Lintas</label>
                                <select class="form-control" id="kll" name="kll" style="width: 100%;" required>
                                    <option value="tidak" selected>Bukan</option>
                                    <option value="ya">Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-none" id="divProvinsi">
                            <div class="form-group">
                                <label class="form-label fw-bold">Tempat Kejadian</label>
                                <select class="form-control" id="provinsi" name="provinsi" style="width: 100%;" required>
                                    <option value="" selected>--Pilih--</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-none" id="divKota">
                            <div class="form-group">
                                <label class="form-label fw-bold">Kabupaten/Kota</label>
                                <select class="form-control" id="kota" name="kota" style="width: 100%;" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-none" id="divKecamatan">
                            <div class="form-group">
                                <label class="form-label fw-bold">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" style="width: 100%;" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h4 class="box-title text-info mb-0 mt-20 pt-50"><i class="fad fa-user-md-chat me-15"></i>Pemeriksaan Fisik</h4>
                </div>
                @can('perawat')
                <h4 class="box-title text-info mb-0 mt-20"><i class="fad fa-user-md-chat me-15"></i>Pemeriksaan Fisik</h4>
                @endcan
                <hr class="my-15">
                {{-- FISIK --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Tinggi Badan</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Ctinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Berat Badan</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Cberat_badan" name="berat_badan" placeholder="Berat Badan" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Lingkar Perut</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Clingkar_perut" name="lingkar_perut" placeholder="Lingkar Perut" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Status IMT : <span id="hasilNamaIMT"></span></label>
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" id="Cimt" name="imt" placeholder="IMT" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                {{-- <span class="input-group-text" id="Cimt2">cm</span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" id="hasilIMT">
                    </div>
                </div>
                {{-- TEKANAN DARAH --}}
                <div class="row">
                    <label class="form-label fw-bold">Tekanan Darah</label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Sistole <span id="Csistole2"></span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Csistole" name="sistole" placeholder="Sistole" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Diastole <span id="Cdiastole2"></span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Cdiastole" name="diastole" placeholder="Diastole" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Respiratory Rate <span id="Crespiratory2"></span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Crespiratory" name="respiratory" placeholder="Respiratory Rate" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">/minute</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Heart Rate <span id="Cheart2"></span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Cheart" name="heart" placeholder="Heart Rate" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">bpm</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SUHU --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Suhu <span id="Csuhu2"></span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Csuhu" name="suhu" placeholder="Suhu" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="input-group-text">°C</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Kesadaran</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="Ckesadaran" name="kesadaran">
                                    <option value="compos_mentis">Compos Mentis</option>
                                    <option value="somnolence">Somnolence</option>
                                    <option value="sopor">Sopor</option>
                                    <option value="coma">Coma</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="{{ Auth::user()->role_id != 5 ? '' : 'd-none' }}">
                    <div class="row">
                        <div class="form-group">
                            <label class="form-label">Status Lokalis</label>
                            <textarea rows="3" class="form-control" id="Cstatus_lokalis" name="status_lokalis" placeholder="Status Lokalis"></textarea>
                        </div>
                    </div>
                </div>

                <div class="{{ Auth::user()->role_id != 5 ? '' : 'd-none' }}">
                    <h4 class="box-title text-info mb-0 mt-20 pt-50"><i class="fad fa-user-md-chat me-15"></i>Pemeriksaan Penunjang</h4>
                    <hr class="my-15">
                    {{-- ORDER LABORATORIUM --}}
                    <div class="row">
                        <h3 style="border-bottom:1px solid red">Order Laboratorium</h3>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Produk Lab</label>
                                <select {{ $data->status_pasien != 'diproses' ? 'disabled' : '' }} onchange="saveLab()" class="form-control" id="produk_lab" name="produk_lab" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    @foreach ($produkLab as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-hover tblLab">
                                    <thead>
                                        <tr>
                                            <th width="1%">No</th>
                                            <th>Kode Order</th>
                                            <th>Nama Produk</th>
                                            <th>Status</th>
                                            <th class="text-center" width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ORDER RADIOLOGI --}}
                    <div class="row pt-50">
                        <h3 style="border-bottom:1px solid red">Order Radiologi</h3>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Produk Radiologi</label>
                                <select {{ $data->status_pasien != 'diproses' ? 'disabled' : '' }} onchange="saveRad()" class="form-control" id="produk_rad" name="produk_rad" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    @foreach ($produkRad as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-hover tblRad">
                                    <thead>
                                        <tr>
                                            <th width="1%">No</th>
                                            <th>Kode Order</th>
                                            <th>Nama Produk</th>
                                            <th>Status</th>
                                            <th class="text-center" width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h4 class="box-title text-info mb-0 mt-20 pt-90"><i class="fad fa-user-md-chat me-15"></i>Assesment</h4>
                    <hr class="my-15">

                    {{-- Diagnosa --}}
                    <div class="row">
                        <h3 style="border-bottom:1px solid red">Diagnosa</h3>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">ICD-10</label>
                                <select {{ $data->status_pasien != 'diproses' ? 'disabled' : '' }} onchange="saveIcd()" class="form-control" id="penyakit_icd" name="penyakit_icd" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-hover tblIcd">
                                    <thead>
                                        <tr>
                                            <th width="1%">No</th>
                                            <th>Kode ICD</th>
                                            <th>Nama Diagnosa</th>
                                            <th class="text-center" width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-10">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-bold">Prognosa</label>
                                <select class="form-control" id="prognosa" name="prognosa" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    <option value="sanam_sembuh">Sanam (Sembuh)</option>
                                    <option value="bonam_baik">Bonam (Baik)</option>
                                    <option value="malam_buruk">Malam (Buruk/Jelek)</option>
                                    <option value="dubia_sanam">Dubia Ad Sanam/Bonam (Tidak tentu/Ragu-ragu,Cenderung Sembuh/Baik)</option>
                                    <option value="dubia_malam">Dubia Ad Malam (Tidak tentu/Ragu-ragu, Cenderung Buruk/Jelek)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="box-title text-info mb-0 mt-20 pt-50"><i class="fad fa-user-md-chat me-15"></i>Planning</h4>
                <hr class="my-15">
                {{-- INPUT TINDAKAN --}}
                <div class="row">
                    <h3 style="border-bottom:1px solid red">Input Tindakan</h3>
                    <div class="col-md-4 mb-20">
                        <div class="form-group">
                            <label class="form-label">Produk Tindakan</label>
                            <select class="form-control" id="produk_tindakan" name="produk_tindakan" style="width: 100%;" required>
                                <option selected disabled value="">--Pilih--</option>
                                @foreach ($produkTindakan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Tindakan</label>
                            <input type="text" class="form-control" id="jumlah_tindakan" name="jumlah_tindakan" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <button class="btn btn-sm btn-success" id="btnSimpanTindakan">Simpan</button>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-hover tblTindakan">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Nama Tindakan</th>
                                        <th>Jumlah</th>
                                        <th>Harga/Tindakan</th>
                                        <th>Total</th>
                                        <th class="text-center" width="1px">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="{{ Auth::user()->role_id != 5 ? '' : 'd-none' }}">
                    {{-- ORDER FARMASI --}}
                    <div class="row pt-50">
                        <h3 style="border-bottom:1px solid red">Order Farmasi</h3>
                        <div class="col-md-4 mb-20">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#nonracikan" role="tab"><span><i class="fas fa-tablets me-15"></i>Non Racikan</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#racikan" role="tab"><span><i class="fas fa-pills me-15"></i>Racikan</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border1">
                                <div class="tab-pane active" id="nonracikan" role="tabpanel">
                                    <div class="form-group pt-10">
                                        <label class="form-label">Obat</label>
                                        <select class="form-control" id="obat_farmasi" name="obat_farmasi" style="width: 100%;" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach ($obat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->satuan->alias }}) (Stok : {{ $item->stok }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jumlah Obat</label>
                                        <input type="input" class="form-control" id="jumlah_farmasi" name="jumlah_farmasi" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Cara Pakai</label>
                                        <textarea class="form-control fst-italic" id="keterangan_farmasi" name="keterangan_farmasi" placeholder="cth: 3 dd 1 atau 2 dd C 1"></textarea>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="form-label">Cara Penggunaan</label>
                                        <select class="form-control" id="cara_penggunaan_obat" name="cara_penggunaan_obat" style="width: 100%;" required>
                                            <option value="sebelum_makan">Sebelum Makan</option>
                                            <option value="sesudah_makan">Sesudah Makan</option>
                                        </select>
                                        <div class="form-group pt-10">
                                            <input type="checkbox" id="pagiTemp" class="filled-in chk-col-primary" />
                                            <label for="pagiTemp" class="pe-50">Pagi</label>
                                            <input type="checkbox" id="siangTemp" class="filled-in chk-col-warning" />
                                            <label for="siangTemp" class="pe-50">Siang</label>
                                            <input type="checkbox" id="malamTemp" class="filled-in chk-col-success" />
                                            <label for="malamTemp">Malam</label>
                                        </div>
                                        <input type="hidden" id="pagi" name="pagi" value="0">
                                        <input type="hidden" id="siang" name="siang" value="0">
                                        <input type="hidden" id="malam" name="malam" value="0">
                                    </div> --}}
                                    <div class="form-group pt-10">
                                        <button type="button" id="btnSaveFarmasi" class="btn btn-sm btn-success">Order</button>

                                    </div>
                                </div>
                                <div class="tab-pane" id="racikan" role="tabpanel">
                                    <div class="pt-10"></div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Racikan</label>
                                        <input type="input" class="form-control" id="nama_farmasi_racikan" name="nama_farmasi_racikan">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jumlah Racikan</label>
                                        <input type="input" class="form-control" id="jumlah_farmasi_racikan" name="jumlah_farmasi_racikan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Cara Pakai Racikan</label>
                                        <textarea class="form-control fst-italic" id="keterangan_farmasi_racikan" name="keterangan_farmasi_racikan" placeholder="cth: m.f. pulv dtd"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Obat</label>
                                        <select class="form-control" id="obat_farmasi_racikan" name="obat_farmasi_racikan" style="width: 100%;" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach ($obat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->satuan->alias }}) (Stok : {{ $item->stok }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jumlah</label>
                                        <input type="input" class="form-control" id="jumlah_obat_racikan" name="jumlah_obat_racikan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="form-group pt-5">
                                        <button type="button" id="btnSimpanRacikan" class="btn btn-sm btn-success">Simpan</button>
                                        <button type="button" id="btnSaveFarmasiRacikan" class="btn btn-sm btn-success">Order Racikan</button>
                                    </div>

                                    <div class="row mx-5">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Nama Obat</th>
                                                    <th>Jumlah</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblFarmasiRacikan">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-hover tblFarmasi">
                                    <thead>
                                        <tr>
                                            <th width="1%">No</th>
                                            <th width="20%">No. Order</th>
                                            <th width="50%">Keterangan</th>
                                            <th width="1%">Jumlah</th>
                                            <th width="1%">Status</th>
                                            <th class="text-center" width="1%">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                                {{-- <button type="button" id="btn-selesai-order" class="btn btn-sm btn-success">Selesai Order</button> --}}
                            </div>
                        </div>
                    </div>
                    {{-- BMHP --}}

                    {{-- PELAYANAN NON KAPITASI --}}
                    <div class="row pt-50">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold">Pelayanan Non Kapitasi</label>
                                <select class="form-control" id="non_kapitasi" name="non_kapitasi" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    <option value="kb">Pelayanan KB</option>
                                    <option value="pnc">Pelayanan PNC</option>
                                    <option value="ambulance">Pelayanan Ambulance</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- STATUS PULANG --}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold">Status Pulang <span class="text-danger">**</span></label>
                                <select class="form-control" id="tindak_lanjut" name="tindak_lanjut" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    <option value="sembuh">Sembuh</option>
                                    <option value="kontrol_ulang">Kontrol Ulang</option>
                                    <option value="rujuk">Rujuk</option>
                                    <option value="rawat_inap">Rawat Inap</option>
                                    <option value="meninggal">Meninggal</option>
                                    {{-- <option value="dalam_penyembuhan">Dalam Penyembuhan</option> --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan_tindak_lanjut" name="keterangan_tindak_lanjut"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group d-none" id="tku">
                                <label class="form-label">Tgl. Kontrol Ulang</label>
                                <input type="date" class="form-control" id="tgl_kontrol_ulang" name="tgl_kontrol_ulang">
                            </div>
                            <div class="form-group d-none" id="sp">
                                <label class="form-label">Spesialis</label>
                                <select class="form-control" id="spesialis_rujuk" name="spesialis_rujuk" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    <option value="umum">UMUM</option>
                                    <option value="tht">THT</option>
                                    <option value="gigi">GIGI</option>
                                    <option value="jantung">JANTUNG</option>
                                </select>
                            </div>
                            <div class="form-group d-none" id="krs">
                                <label class="form-label">Klinik / Rumah Sakit</label>
                                <select class="form-control" id="rs_rujuk" name="rs_rujuk" style="width: 100%;" required>
                                    <option selected disabled value="">--Pilih--</option>
                                    <option class="rsud_langsa">RSUD Langsa</option>
                                    <option class="rsud_tamiang">RSUD Aceh Tamiang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- SURAT KETERANGAN --}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold">Surat Keterangan</label>
                                <select class="form-control" id="surat_keterangan" name="surat_keterangan" style="width: 100%;" required>
                                    {{-- <option selected disabled value="null">--Pilih--</option> --}}
                                    <option value="tidak_ada" selected>Tidak Ada</option>
                                    <option value="surat_sakit">Surat Keterangan Sakit</option>
                                    <option value="surat_sehat">Surat Keterangan Sehat</option>
                                    <option value="surat_berobat">Surat Keterangan Berobat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group d-none" id="jumlahHari">
                                <label class="form-label">Jumlah Hari</label>
                                <input type="input" class="form-control" id="jumlah_hari" name="jumlah_hari" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="form-group d-none" id="tanggalSurat">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat">
                            </div>
                            <div class="form-group d-none" id="tanggalSuratEnd">
                                <label class="form-label">Tanggal Selesai</label>
                                <input disabled type="date" class="form-control" id="tanggal_surat_end" name="tanggal_surat_end">
                            </div>
                            <div class="form-group d-none" id="keperluanSurat">
                                <label class="form-label">Keperluan Surat</label>
                                <input type="input" class="form-control" id="keperluan_surat" name="keperluan_surat" autocomplete="off">
                            </div>
                            <div class="form-group d-none" id="keteranganSuratSehat">
                                <label class="form-label">Keterangan Surat</label>
                                <select class="form-control" id="keterangan_surat_sehat" name="keterangan_surat_sehat" style="width: 100%;" required>
                                    <option value="sehat">Sehat</option>
                                    <option value="tidak_sehat">Tidak Sehat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-20">
                    <h6 class="text-danger"> Tanda ** Harus Di Isi</h6>
                </div>
            </div>
        </div>
        <div class="box-footer">
            @if ($data->status_pasien == 'belum_selesai' || $data->status_pasien == 'diproses')
                <a href="{{ route('admin.layanan-rwj.index') }}" class="btn btn-sm btn-danger me-1 waves-effect waves-light">
                    <i class="fas fa-circle-arrow-left"></i> Batal
                </a>
                <button type="button" id="catatanSave" class="btn btn-sm btn-primary waves-effect waves-light" data-mode="create">
                    <i class="fas fa-floppy-disk-circle-arrow-right"></i> Simpan
                </button>
                @can('SAD')
                    <button type="button" id="btn-selesai" class="btn btn-sm btn-success waves-effect waves-light" data-mode="finish">
                        <i class="ti-check"></i> Selesai
                    </button>
                @endcan
            @else
                <a href="{{ route('admin.layanan-rwj.index') }}" class="btn btn-sm btn-dark me-1 waves-effect waves-light">
                    <i class="fas fa-circle-arrow-left"></i> Kembali
                </a>
                <button type="button" id="btn-belum" class="btn btn-sm btn-success waves-effect waves-light" data-mode="edit">
                    <i class="ti-marker-alt"></i> Edit Data
                </button>
            @endif
        </div>
    </form>
</div>
