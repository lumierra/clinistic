<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class HalamanAntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poli = Poliklinik::whereNotIn('nama',['UMUM', 'LABORATORIUM'])->where('status', 'aktif')->get();
        $antrianUmum = $this->getNomorAntrian(1)['antrian'];
        $statusUmum = $this->getNomorAntrian(1)['status'];
        return view('antrian.halaman_antrian', compact('poli', 'antrianUmum', 'statusUmum'));
    }

    public function getNomorAntrian($id)
    {
        $antrian = Antrian::select('nomor_antrian', 'status')->where('poliklinik_id', $id)
                            ->where('panggil', 0)
                            ->where('tanggal', date('Y-m-d'))
                            ->orderBy('id', 'asc')
                            ->first();
        if ($antrian){
            $result = [
                'antrian' => $antrian->nomor_antrian,
                'status' => $antrian->status,
            ];
            return $result;
        }
        else{
            $result = [
                'antrian' => '-',
                'status' => '',
            ];
            return $result;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $antrianUmum = $this->getNomorAntrian(1)[['antrian']];
        $statusUmum = $this->getNomorAntrian(1)['status'];
        return view('antrian.umum', compact('antrianUmum', 'statusUmum'));
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
        $poli = Poliklinik::whereNotIn('nama',['UMUM', 'LABORATORIUM'])->where('status', 'aktif')->get();
        return view('antrian.semua_poli', compact('poli'));
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
