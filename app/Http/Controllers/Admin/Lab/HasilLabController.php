<?php

namespace App\Http\Controllers\Admin\Lab;

use App\Http\Controllers\Controller;
use App\Models\HasilLab;
use App\Models\Kunjungan;
use App\Models\Produk;
use Illuminate\Http\Request;

class HasilLabController extends Controller
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
        $data = HasilLab::findOrFail($id);
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
        // dd($request->all());
        $hasil = HasilLab::where('kd_lab', $request->kd_lab)->get();
        foreach ($hasil as $item){
            $lab = 'lab'.$item->lab_id;
            if ($request->has($lab)){
                $cek = HasilLab::where('lab_id', $item->lab_id)->where('kd_lab', $request->kd_lab)->first();
                $cek->hasil = $request->input($lab);
                $cek->jam_hasil = date('Y-m-d H:i:s');
                $cek->nama_produk = $cek->lab->produk->nama;
                $cek->produk_lab_id = $cek->lab->produk->id;
                $cek->nilai_rujukan = $cek->lab->produk->nilai_rujukan;
                $cek->save();
                if ($cek->nomor_surat == ''){
                    $cekProduk = HasilLab::where('kunjungan_id', $item->kunjungan_id)->where('produk_lab_id', $item->produk_lab_id)->where('nama_produk', 'LIKE', '%SWAB%')->first();
                    $lastID = HasilLab::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                    if ($cekProduk){
                        if (!$lastID){
                            $newID = "01/LAB/".$this->bulan_romawi(date("m"))."/".date("Y");
                            $cek->nomor_surat = $newID;
                            $cek->save();
                        }
                        else {
                            $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                            $newID = sprintf("%02s", $no_surat)."/LAB/".$this->bulan_romawi(date("m"))."/".date("Y");
                            $cek->nomor_surat = $newID;
                            $cek->save();
                        }
                    } else {
                        if (!$lastID){
                            $newID = "01/LAB/".$this->bulan_romawi(date("m"))."/".date("Y");
                            $cek->nomor_surat = $newID;
                            $cek->save();
                        }
                        else {
                            $nomor = HasilLab::where('kd_lab', $request->kd_lab)->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                            if (!$nomor){
                                $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                                $newID = sprintf("%02s", $no_surat)."/LAB/".$this->bulan_romawi(date("m"))."/".date("Y");
                                $cek->nomor_surat = $newID;
                                $cek->save();
                            } else {
                                $cek->nomor_surat = $nomor->nomor_surat;
                                $cek->save();
                            }
                        }
                    }
                    echo $newID;
                    echo "<br>";
                }
            }
        }

        $data = Kunjungan::where('register', $hasil[0]->register)->first();
        return view('admin.lab.table', compact('data'));
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
