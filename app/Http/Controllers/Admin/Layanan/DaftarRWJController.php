<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\PasienBpjs;
use Illuminate\Http\Request;

class DaftarRWJController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kunjungan::findOrFail($id);
        $kunjungan = Kunjungan::where('pasien_id', $data->pasien_id)->where('status_kunjungan', 'rwj')->orderBy('id', 'desc')->get();
        return view('admin.layanan.rwj.refreshRiwayat', compact('data', 'kunjungan'));
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
        // dd($request->all());
        $pasien = Pasien::where('no_rm', $request->rm)->first();
        if ($request->jaminan == 'umum'){
            $status = 'umum';
            $asuransi = 0;
        } else {
            $status = 'asuransi';
            $asuransi = $request->asuransi2;
        }

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'dokter_id' => $request->dokter,
            'kategori_rujukan_id' => $request->jenis_rujukan,
            'asal_rujukan_id' => $request->asal_rujukan,
            'poliklinik_id' => $request->poliklinik,
            'status_jaminan' => $status,
            'asuransi_id' => $asuransi,
            'keluhan_awal' => $request->keluhan,
        ]);

        if ($status == 'asuransi'){
            $cariBpjs = PasienBpjs::where('asuransi_id', $asuransi)->where('pasien_id', $pasien->id)->first();
            if (!$cariBpjs){
                $bpjs = PasienBpjs::create([
                    'asuransi_id' => $asuransi,
                    'pasien_id' => $pasien->id,
                    'nomor' => $request->no_kartu,
                ]);
            }
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
        //
    }
}
