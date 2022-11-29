<?php

use App\Http\Controllers\Admin\Captcha\CaptchaController;
use App\Http\Controllers\CetakAntrianController;
use App\Http\Controllers\HalamanAntrianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect('/', 'login');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::resource('halaman-antrian', HalamanAntrianController::class);
Route::resource('cetak-antrian', CetakAntrianController::class);
Route::resource('captcha', CaptchaController::class);

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resources([
        'profil' => ProfilController::class,
        'satuan' => SatuanController::class,
        'website' => WebsiteController::class,
        'menu' => MenuController::class,
        'submenu' => SubMenuController::class,
        'submenu-detail' => SubmenuDetailController::class,
        'menu-user' => MenuUserController::class,
        'pengguna' => PenggunController::class,
        'roles' => RoleController::class,
        'poliklinik' => PoliklinikController::class,
        'dokter' => DokterController::class,
        'pasien' => PasienController::class,
        'kategori-obat' => KategoriObatController::class,
        'jenis-waste' => JenisWasteController::class,
        'asuransi' => AsuransiController::class,
        'pekerjaan' => PekerjaanController::class,
        'kategori-rujukan' => KategoriRujukanController::class,
        'asal-rujukan' => RujukanController::class,
        'obat' => ObatController::class,

        'daftar-rwj' => DaftarRWJController::class,
        'layanan-rwj' => RawatJalanController::class,
        'bpjs-pasien' => BpjsPasienController::class,
        'produk' => ProdukController::class,

        // PENDAFTARAN RWJ
        'rawat-jalan' => RwjController::class,
        'ubah-rwj' => UbahPendaftaranController::class,

        'riwayat-kunjungan' => RiwayatKunjungan::class,
        'data-obat' => DataObatController::class,
        'data-icd' => MasterICDController::class,

        // POLI ESTETIKA
        'estetika' => EstetikaController::class,

        // FARMASI
        'farmasi' => FarmasiController::class,
        'ubah-farmasi' => UbahFarmasiController::class,
        'farmasi-racikan' => FarmasiRacikanController::class,

        // LAB
        'lab' => LabController::class,
        'ubah-lab' => UbahLabController::class,
        'hasil-lab' => HasilLabController::class,
        'pendaftaran-lab' => PendaftaranLabController::class,

        // RADIOLOGI
        'radiologi' => RadiologiController::class,
        'ubah-radiologi' => UbahRadiologiController::class,
        'hasil-radiologi' => HasilRadiologiController::class,

        'kota' => KotaController::class,
        'kecamatan' => KecamatanController::class,
        'kelurahan' => KelurahanController::class,

        'rujukan-rwj' => CariRujukanController::class,
        'dokter-rwj' => CariDokterController::class,
        'cari-pasien' => CariPasienController::class,
        'icd' => IcdController::class,
        'catatan' => CatatanController::class,
        'sync-riwayat-alergi' => AlergiController::class,
        'tindakan-layanan' => TindakanLayananController::class,
        'riwayat-pasien' => RiwayatPasienController::class,

        // KASIR
        'kasir' => KasirController::class,
        'cari-kunjungan' => CariKunjunganController::class,
        'cari-kunjungan-tanggal' => CariKunjunganTanggalController::class,

        // BUKAN
    ]);

    Route::post('upload-estetika', [EstetikaController::class, 'upload'])->name('upload-estetika');
    Route::get('upload-estetika/{id}', [EstetikaController::class, 'hasil'])->name('upload-estetika.show');

    Route::get('kecamatan/{kota}/{kecamatan}/kec', [KecamatanController::class, 'kec']);
    Route::get('tampung/insert/{toko}/{barang}', [TampungController::class, 'insert']);

    Route::get('cetak-farmasi/{id}', [FarmasiController::class, 'cetak'])->name('cetak-farmasi');
});


