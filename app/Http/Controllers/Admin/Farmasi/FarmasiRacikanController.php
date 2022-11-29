<?php

namespace App\Http\Controllers\Admin\Farmasi;

use App\Http\Controllers\Controller;
use App\Models\DetailFarmasiRacik;
use App\Models\Farmasi;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\TempFarmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmasiRacikanController extends Controller
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
        $obat = Obat::findOrFail($request->obat);
        if ($obat->stok < $request->jumlah){
            return response()->json('Stok obat tidak mencukupi', 500);
        } else {
            $cek = TempFarmasi::where('kunjungan_id', $kunjungan->id)->where('obat_id', $obat->id)->first();
            if ($cek){
                $cek->jumlah = $cek->jumlah + $request->jumlah;
                $cek->save();
            } else {
                $cekTemp = TempFarmasi::where('kunjungan_id', $kunjungan->id)->first();
                if ($cekTemp){
                    $tempFarmasi = TempFarmasi::create([
                        'register' => $kunjungan->register,
                        'kunjungan_id' => $kunjungan->id,
                        'pasien_id' => $kunjungan->pasien_id,
                        'dokter_id' => $kunjungan->dokter_id,
                        'poliklinik_id' => $kunjungan->poliklinik_id,
                        'user_id' => Auth::user()->id,
                        'tgl_masuk' => $kunjungan->tgl_masuk,
                        'nama_racikan' => $cekTemp->nama_racikan,
                        'jumlah_racikan' => $cekTemp->jumlah_racikan,
                        'cara_penggunaan' => $cekTemp->cara_penggunaan,
                        'obat_id' => $request->obat,
                        'jumlah' => $request->jumlah,
                    ]);
                } else {
                    $tempFarmasi = TempFarmasi::create([
                        'register' => $kunjungan->register,
                        'kunjungan_id' => $kunjungan->id,
                        'pasien_id' => $kunjungan->pasien_id,
                        'dokter_id' => $kunjungan->dokter_id,
                        'poliklinik_id' => $kunjungan->poliklinik_id,
                        'user_id' => Auth::user()->id,
                        'tgl_masuk' => $kunjungan->tgl_masuk,
                        'nama_racikan' => $request->nama_racikan,
                        'jumlah_racikan' => $request->jumlah_racikan,
                        'cara_penggunaan' => $request->cara,
                        'obat_id' => $request->obat,
                        'jumlah' => $request->jumlah,
                    ]);
                }

            }
            return response()->json('Success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TempFarmasi::where('kunjungan_id', $id)->with('obat')->get();
        return response()->json($data);
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
        $temp = TempFarmasi::where('kunjungan_id', $id)->get();
        $kunjungan = Kunjungan::findOrFail($request->kunjungan);
        $cekFarmasi = Farmasi::where('kunjungan_id', $request->kunjungan)->first();
        if ($cekFarmasi){
            $newID = $cekFarmasi->kd_farmasi;
        } else {
            $lastID = Farmasi::select('kd_farmasi')->where('tgl_order', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'FAR-'.date('ymd').'-0001';
            }
            else{
                $lastIncrement = substr($lastID->kd_farmasi, -4, 4);
                $newID = 'FAR-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
            }
        }

        // $obat = Obat::findOrFail($temp[0]->obat_id);
        if ($kunjungan->status_farmasi == null){
            $kunjungan->update([
                'status_farmasi' => 'resep',
                'tgl_order_farmasi' => date('Y-m-d'),
            ]);
        }
        $status_farmasi = 'belum';

        $insert = Farmasi::create([
            'register' => $kunjungan->register,
            'kunjungan_id' => $kunjungan->id,
            'pasien_id' => $kunjungan->pasien_id,
            'dokter_id' => $kunjungan->dokter_id,
            'poliklinik_id' => $kunjungan->poliklinik_id,
            'user_id' => Auth::user()->id,
            'tgl_masuk' => $kunjungan->tgl_masuk,
            'obat_id' => $temp[0]->obat_id,
            'kd_farmasi' => $newID,
            'tgl_order' => date('Y-m-d'),
            'status' => $status_farmasi,
            'jumlah' => $temp[0]->jumlah_racikan,
            'keterangan' => $temp[0]->cara_penggunaan,
            'status_racik' => 'ya'
        ]);

        foreach ($temp as $item){
            $obat = Obat::findOrFail($item->obat_id);
            $obat->stok = $obat->stok - $request->jumlah;
            $obat->save();
            $detail = DetailFarmasiRacik::create([
                'kd_farmasi' => $insert->kd_farmasi,
                'register' => $insert->register,
                'farmasi_id' => $insert->id,
                'kunjungan_id' => $insert->kunjungan_id,
                'pasien_id' => $insert->pasien_id,
                'dokter_id' => $insert->dokter_id,
                'poliklinik_id' => $insert->poliklinik_id,
                'user_id' => Auth::user()->id,
                'tgl_masuk' => $insert->tgl_masuk,
                'obat_id' => $item->obat_id,
                'tgl_order' => date('Y-m-d'),
                'status' => $status_farmasi,
                'jumlah' => $item->jumlah,
                'keterangan' => $item->cara_penggunaan,
            ]);
            $item->delete();
        }

        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TempFarmasi::findOrFail($id)->delete();
        return response()->json('Success');
    }
}
