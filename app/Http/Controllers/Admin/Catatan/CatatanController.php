<?php

namespace App\Http\Controllers\Admin\Catatan;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use App\Models\DetailTransaksi;
use App\Models\Kunjungan;
use App\Models\Produk;
use App\Models\SuratKeterangan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kunjungan = Kunjungan::findOrFail($request->kunjungan);
        if ($request->tindak_lanjut == 'kontrol_ulang'){
            $tindak_lanjut = $request->tindak_lanjut;
            $keterangan = $request->keterangan_tindak_lanjut;
            $tgl_kontrol_ulang = $request->tgl_kontrol_ulang;
            $spesialis_rujuk = null;
            $rs_rujuk = null;
        } else if ($request->tindak_lanjut == 'rujuk'){
            $tindak_lanjut = $request->tindak_lanjut;
            $keterangan = $request->keterangan_tindak_lanjut;
            $tgl_kontrol_ulang = null;
            $spesialis_rujuk = $request->spesialis_rujuk;
            $rs_rujuk = $request->rs_rujuk;
        } else if ($request->tindak_lanjut == 'sembuh'){
            $tindak_lanjut = $request->tindak_lanjut;
            $keterangan = $request->keterangan_tindak_lanjut;
            $tgl_kontrol_ulang = null;
            $spesialis_rujuk = null;
            $rs_rujuk = null;
        } else if ($request->tindak_lanjut == 'rawat_inap'){
            $tindak_lanjut = $request->tindak_lanjut;
            $keterangan = $request->keterangan_tindak_lanjut;
            $tgl_kontrol_ulang = null;
            $spesialis_rujuk = null;
            $rs_rujuk = null;
        } else if ($request->tindak_lanjut == 'meninggal'){
            $tindak_lanjut = $request->tindak_lanjut;
            $keterangan = $request->keterangan_tindak_lanjut;
            $tgl_kontrol_ulang = null;
            $spesialis_rujuk = null;
            $rs_rujuk = null;
        } else {
            $tindak_lanjut = null;
            $keterangan = null;
            $tgl_kontrol_ulang = null;
            $spesialis_rujuk = null;
            $rs_rujuk = null;
        }
        if ($request->kll == 'tidak'){
            $provinsi = '0';
            $kota = '0';
            $kecamatan = '0';
        } else {
            $provinsi = $request->provinsi;
            $kota = $request->kota;
            $kecamatan = $request->kecamatan;
            // $provinsi = $request->has('provinsi') ?? $request->provinsi;
            // $kota = $request->has('kota') ?? $request->kota;
            // $kecamatan = $request->has('kecamatan') ?? $request->kecamatan;
        }

        $catatan = Catatan::updateOrCreate(
            ['id' => $request->catatan]
            ,[
            'register' => $kunjungan->register,
            'kunjungan_id' => $kunjungan->id,
            'pasien_id' => $kunjungan->pasien_id,
            'dokter_id' => $kunjungan->dokter_id,
            'user_id' => Auth::user()->id,
            'tgl_masuk' => $kunjungan->tgl_masuk,
            'alergi_makanan' => $request->makanan,
            'alergi_udara' => $request->udara,
            'alergi_obat' => $request->obat_obatan,
            'prognosa' => $request->prognosa,
            'subyektif' => $request->subyektif,
            'kesadaran' => $request->kesadaran,
            'suhu' => $request->suhu,
            'tekanan_darah' => $request->tekanan_darah,
            'sistole' => $request->sistole,
            'diastole' => $request->diastole,
            'respiratory_rate' => $request->respiratory,
            'heart_rate' => $request->heart,
            'nadi' => $request->nadi,
            'nafas' => $request->nafas,
            'spo2' => $request->spo2,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_perut' => $request->lingkar_perut,
            'imt' => $request->imt,
            'assesment' => $request->assesment,
            'planning' => $request->planning,
            'status_lokalis' => $request->status_lokalis,
            'tindak_lanjut' => $tindak_lanjut,
            'keterangan' => $keterangan,
            'tgl_kontrol_ulang' => $tgl_kontrol_ulang,
            'spesialis_rujuk' => $spesialis_rujuk,
            'rs_rujuk' => $rs_rujuk,
            'keluhan_utama' => $request->keluhan_utama,
            'non_kapitasi' => $request->non_kapitasi,
            'kll' => $request->kll,
            'provinsi_id' => $provinsi,
            'kota_id' => $kota,
            'kecamatan_id' => $kecamatan,
            'surat_keterangan' => $request->surat_keterangan,
            'surat_jumlah_hari' => $request->jumlah_hari,
            'surat_tanggal_mulai' => $request->tanggal_surat,
            'keperluan_surat' => $request->keperluan_surat,
            'keterangan_surat' => $request->keterangan_surat_sehat,
            'surat_tanggal_selesai' => date('Y-m-d', strtotime($request->tanggal_surat. ' + '.($request->jumlah_hari-1).' days')),
        ]);

        $this->sk($catatan);

        return response()->json('Success');
    }

    protected function sk($catatan)
    {
        if($catatan->surat_keterangan == 'tidak_ada'){
            $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)
                    ->where('jenis_surat', 'surat_sakit')
                    ->orWhere('jenis_surat', 'surat_sehat')
                    ->orWhere('jenis_surat', 'surat_berobat')
                    ->first();
            if($surat){
                $surat->delete();
                $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)
                                                    ->where('produk_id', 14)
                                                    ->orWhere('produk_id', 15)
                                                    ->orWhere('produk_id', 16)
                                                    ->first();
                if($detail_transaksi){
                    $detail_transaksi->delete();
                }
            }
            // if($surat){
            //     $surat->delete();
            //     $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)->where('produk_id', 14)->first();
            //     if($detail_transaksi){
            //         $detail_transaksi->delete();
            //     }
            // }
            // $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', 'surat_sehat')->first();
            // if($surat){
            //     $surat->delete();
            //     $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)->where('produk_id', 15)->first();
            //     if($detail_transaksi){
            //         $detail_transaksi->delete();
            //     }
            // }
            // $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', 'surat_berobat')->first();
            // if($surat){
            //     $surat->delete();
            //     $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)->where('produk_id', 16)->first();
            //     if($detail_transaksi){
            //         $detail_transaksi->delete();
            //     }
            // }
        } else if ($catatan->surat_keterangan == 'surat_sakit'){
            $cek = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', $catatan->surat_keterangan)->first();
            if (!$cek){
                $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)
                                        ->where('jenis_surat', 'surat_sehat')
                                        ->orWhere('jenis_surat', 'surat_berobat')
                                        ->first();
                if($surat){
                    $surat->delete();
                    $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)
                                                        ->where('produk_id', 15)
                                                        ->orWhere('produk_id', 16)
                                                        ->first();
                    if($detail_transaksi){
                        $detail_transaksi->delete();
                    }
                }
                // $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', 'surat_sehat')->first();
                // if($surat){
                //     $surat->delete();
                // }
                // $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', 'surat_berobat')->first();
                // if($surat){
                //     $surat->delete();
                // }
                $lastID = SuratKeterangan::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                if (!$lastID){
                    $newID = "01/SK/".$this->bulan_romawi(date("m"))."/".date("Y");
                }
                else{
                    $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                    $newID = sprintf("%02s", $no_surat)."/SK/".$this->bulan_romawi(date("m"))."/".date("Y");
                }
                $surat = SuratKeterangan::create([
                    'nomor_surat' => $newID,
                    'jenis_surat' => $catatan->surat_keterangan,
                    'register' => $catatan->register,
                    'kunjungan_id' => $catatan->kunjungan_id,
                    'pasien_id' => $catatan->pasien_id,
                    'dokter_id' => $catatan->dokter_id,
                    'user_id' => Auth::user()->id,
                    'tanggal_surat' => date('Y-m-d'),
                    'tanggal_pemeriksaan' => $catatan->tgl_masuk,
                    'tanggal_mulai' => $catatan->surat_tanggal_mulai,
                    'tanggal_berakhir' => $catatan->surat_tanggal_selesai,
                    'surat_jumlah_hari' => $catatan->surat_jumlah_hari,
                    'nama_dokter' => $catatan->dokter->nama,
                    'diagnosa' => $catatan->getDiagnosa($catatan->kunjungan_id),
                    'nik' => $catatan->pasien->nik,
                    'nama' => $catatan->pasien->nama,
                    'jenis_kelamin' => $catatan->pasien->gender->jenis_kelamin,
                    'nama_pekerjaan' => $catatan->pasien->pekerjaan->nama_pekerjaan,
                    'tanggal_lahir' => $catatan->pasien->tgl_lahir,
                    'alamat' => $catatan->pasien->alamat,
                    'nama_kelurahan' => $catatan->pasien->kelurahan->nama_kelurahan,
                    'nama_kecamatan' => $catatan->pasien->kecamatan->nama_kecamatan,
                    'nama_kota' => $catatan->pasien->kota->nama_kota,
                    'nama_provinsi' => $catatan->pasien->provinsi->nama_provinsi,
                ]);
                $produk = Produk::where('id', 14)->first();
                $cekTransaksi = Transaksi::where('kunjungan_id', $catatan->kunjungan_id)->first();
                $cekDT = DetailTransaksi::where('no_transaksi', $cekTransaksi->no_transaksi)->orderBy('urut', 'asc')->first();
                $detailTransaksi = DetailTransaksi::create([
                    'no_transaksi' => $cekTransaksi->no_transaksi,
                    'no_rm' => $cekTransaksi->no_rm,
                    'register' => $cekTransaksi->register,
                    'tgl_masuk' => $cekTransaksi->tgl_masuk,
                    'transaksi_id' => $cekTransaksi->id,
                    'kunjungan_id' => $cekTransaksi->kunjungan_id,
                    'dokter_id' => $cekTransaksi->dokter_id,
                    'pasien_id' => $cekTransaksi->pasien_id,
                    'poliklinik_id' => $cekTransaksi->poliklinik_id,
                    'user_id' => Auth::user()->id,
                    'produk_id' => $produk->id,
                    'jumlah' => 1,
                    'harga' => $produk->harga,
                    'urut' => $cekDT->urut+1,
                    'tgl_detail' => date('Y-m-d'),
                    'keterangan' => 'SK'
                ]);
            }
        } else if ($catatan->surat_keterangan == 'surat_sehat'){
            $cek = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', $catatan->surat_keterangan)->first();
            if (!$cek){
                // $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', 'surat_sakit')->first();
                // if($surat){
                //     $surat->delete();
                // }
                // $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', 'surat_berobat')->first();
                // if($surat){
                //     $surat->delete();
                // }
                $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)
                                        ->where('jenis_surat', 'surat_sakit')
                                        ->orWhere('jenis_surat', 'surat_berobat')
                                        ->first();
                if($surat){
                    $surat->delete();
                    $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)
                                                        ->where('produk_id', 14)
                                                        ->orWhere('produk_id', 16)
                                                        ->first();
                    if($detail_transaksi){
                        $detail_transaksi->delete();
                    }
                }
                $lastID = SuratKeterangan::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                if (!$lastID){
                    $newID = "01/SK/".$this->bulan_romawi(date("m"))."/".date("Y");
                }
                else{
                    $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                    $newID = sprintf("%02s", $no_surat)."/SK/".$this->bulan_romawi(date("m"))."/".date("Y");
                }
                $surat = SuratKeterangan::create([
                    'nomor_surat' => $newID,
                    'jenis_surat' => $catatan->surat_keterangan,
                    'register' => $catatan->register,
                    'kunjungan_id' => $catatan->kunjungan_id,
                    'pasien_id' => $catatan->pasien_id,
                    'dokter_id' => $catatan->dokter_id,
                    'user_id' => Auth::user()->id,
                    'tanggal_surat' => date('Y-m-d'),
                    'tanggal_pemeriksaan' => $catatan->tgl_masuk,
                    'nama_dokter' => $catatan->dokter->nama,
                    'diagnosa' => $catatan->getDiagnosa($catatan->kunjungan_id),
                    'nik' => $catatan->pasien->nik,
                    'nama' => $catatan->pasien->nama,
                    'jenis_kelamin' => $catatan->pasien->gender->jenis_kelamin,
                    'nama_pekerjaan' => $catatan->pasien->pekerjaan->nama_pekerjaan,
                    'tanggal_lahir' => $catatan->pasien->tgl_lahir,
                    'alamat' => $catatan->pasien->alamat,
                    'nama_kelurahan' => $catatan->pasien->kelurahan->nama_kelurahan,
                    'nama_kecamatan' => $catatan->pasien->kecamatan->nama_kecamatan,
                    'nama_kota' => $catatan->pasien->kota->nama_kota,
                    'nama_provinsi' => $catatan->pasien->provinsi->nama_provinsi,
                    'keterangan_surat_sehat' => $catatan->keterangan_surat,
                    'keperluan_surat' => $catatan->keperluan_surat,
                    'tinggi_badan' => $catatan->tinggi_badan,
                    'berat_badan' => $catatan->berat_badan,
                    'sistole' => $catatan->sistole,
                    'diastole' => $catatan->diastole,
                    'golongan_darah' => $catatan->pasien->golongan_darah,
                    'buta_warna' => 'Tidak'
                ]);
                $produk = Produk::where('id', 15)->first();
                $cekTransaksi = Transaksi::where('kunjungan_id', $catatan->kunjungan_id)->first();
                $cekDT = DetailTransaksi::where('no_transaksi', $cekTransaksi->no_transaksi)->orderBy('urut', 'asc')->first();
                $detailTransaksi = DetailTransaksi::create([
                    'no_transaksi' => $cekTransaksi->no_transaksi,
                    'no_rm' => $cekTransaksi->no_rm,
                    'register' => $cekTransaksi->register,
                    'tgl_masuk' => $cekTransaksi->tgl_masuk,
                    'transaksi_id' => $cekTransaksi->id,
                    'kunjungan_id' => $cekTransaksi->kunjungan_id,
                    'dokter_id' => $cekTransaksi->dokter_id,
                    'pasien_id' => $cekTransaksi->pasien_id,
                    'poliklinik_id' => $cekTransaksi->poliklinik_id,
                    'user_id' => Auth::user()->id,
                    'produk_id' => $produk->id,
                    'jumlah' => 1,
                    'harga' => $produk->harga,
                    'urut' => $cekDT->urut+1,
                    'tgl_detail' => date('Y-m-d'),
                    'keterangan' => 'SK'
                ]);
            }
        } else if ($catatan->surat_keterangan == 'surat_berobat') {

            $cek = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)->where('jenis_surat', $catatan->surat_keterangan)->first();
            if (!$cek){
                $surat = SuratKeterangan::where('kunjungan_id', $catatan->kunjungan_id)
                                        ->where('jenis_surat', 'surat_sakit')
                                        ->orWhere('jenis_surat', 'surat_sehat')
                                        ->first();
                if($surat){
                    $surat->delete();
                    $detail_transaksi = DetailTransaksi::where('kunjungan_id', $catatan->kunjungan_id)
                                                        ->where('produk_id', 14)
                                                        ->orWhere('produk_id', 15)
                                                        ->first();
                    if($detail_transaksi){
                        $detail_transaksi->delete();
                    }
                }
                $lastID = SuratKeterangan::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                if (!$lastID){
                    $newID = "01/SK/".$this->bulan_romawi(date("m"))."/".date("Y");
                }
                else{
                    $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                    $newID = sprintf("%02s", $no_surat)."/SK/".$this->bulan_romawi(date("m"))."/".date("Y");
                }
                $surat = SuratKeterangan::create([
                    'nomor_surat' => $newID,
                    'jenis_surat' => $catatan->surat_keterangan,
                    'register' => $catatan->register,
                    'kunjungan_id' => $catatan->kunjungan_id,
                    'pasien_id' => $catatan->pasien_id,
                    'dokter_id' => $catatan->dokter_id,
                    'user_id' => Auth::user()->id,
                    'tanggal_surat' => date('Y-m-d'),
                    'tanggal_pemeriksaan' => $catatan->tgl_masuk,
                    'nama_dokter' => $catatan->dokter->nama,
                    'diagnosa' => $catatan->getDiagnosa($catatan->kunjungan_id),
                    'nik' => $catatan->pasien->nik,
                    'nama' => $catatan->pasien->nama,
                    'jenis_kelamin' => $catatan->pasien->gender->jenis_kelamin,
                    'nama_pekerjaan' => $catatan->pasien->pekerjaan->nama_pekerjaan,
                    'tanggal_lahir' => $catatan->pasien->tgl_lahir,
                    'alamat' => $catatan->pasien->alamat,
                    'nama_kelurahan' => $catatan->pasien->kelurahan->nama_kelurahan,
                    'nama_kecamatan' => $catatan->pasien->kecamatan->nama_kecamatan,
                    'nama_kota' => $catatan->pasien->kota->nama_kota,
                    'nama_provinsi' => $catatan->pasien->provinsi->nama_provinsi,
                ]);
                $produk = Produk::where('id', 16)->first();
                $cekTransaksi = Transaksi::where('kunjungan_id', $catatan->kunjungan_id)->first();
                $cekDT = DetailTransaksi::where('no_transaksi', $cekTransaksi->no_transaksi)->orderBy('urut', 'asc')->first();
                $detailTransaksi = DetailTransaksi::create([
                    'no_transaksi' => $cekTransaksi->no_transaksi,
                    'no_rm' => $cekTransaksi->no_rm,
                    'register' => $cekTransaksi->register,
                    'tgl_masuk' => $cekTransaksi->tgl_masuk,
                    'transaksi_id' => $cekTransaksi->id,
                    'kunjungan_id' => $cekTransaksi->kunjungan_id,
                    'dokter_id' => $cekTransaksi->dokter_id,
                    'pasien_id' => $cekTransaksi->pasien_id,
                    'poliklinik_id' => $cekTransaksi->poliklinik_id,
                    'user_id' => Auth::user()->id,
                    'produk_id' => $produk->id,
                    'jumlah' => 1,
                    'harga' => $produk->harga,
                    'urut' => $cekDT->urut+1,
                    'tgl_detail' => date('Y-m-d'),
                    'keterangan' => 'SK'
                ]);
            }
        }
    }

    protected function bulan_romawi($bln)
    {
        $bulan_romawi = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];
        return $bulan_romawi[$bln];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catatan = Catatan::where('kunjungan_id', $id)->first();
        if ($catatan){
            return response()->json($catatan);
        } else {
            return response()->json('kosong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
