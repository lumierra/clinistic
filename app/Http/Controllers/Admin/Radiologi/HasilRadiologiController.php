<?php

namespace App\Http\Controllers\Admin\Radiologi;

use App\Http\Controllers\Controller;
use App\Models\HasilRadiologi;
use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HasilRadiologiController extends Controller
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
        // dd($request->all());

        $hasil = HasilRadiologi::where('kd_radiologi', $request->kd_rad)->get();
        foreach ($hasil as $item){
            $nama = 'rad'.$item->radiologi_id;
            if ($request->hasFile($nama)){
                $time = Carbon::now()->timestamp;
                $path = $request->file($nama)->storeAs('radiologi',  'radiologi-'.$time.'.png', 'public');
                if ($request->has($nama)){
                    $cek = HasilRadiologi::where('radiologi_id', $item->radiologi_id)
                                ->where('kd_radiologi', $request->kd_rad)
                                ->first();

                    $namaHasil = 'radhasil'.$item->radiologi_id;
                    $cek->hasil = $request->input($namaHasil);
                    $cek->hasil_foto = 'storage/' . $path;
                    $cek->link = asset('storage/' . $path);
                    $cek->save();

                    if ($cek->nomor_surat == ''){
                        $lastID = HasilRadiologi::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                        if (!$lastID){
                            $newID = "01/RAD/".$this->bulan_romawi(date("m"))."/".date("Y");
                        }
                        else{
                            $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                            $newID = sprintf("%02s", $no_surat)."/RAD/".$this->bulan_romawi(date("m"))."/".date("Y");
                        }
                        $cek->nomor_surat = $newID;
                        $cek->save();
                    }
                }
            } else {
                $namaHasil = 'radhasil'.$item->radiologi_id;
                if ($request->has($namaHasil)){
                    $cek = HasilRadiologi::where('radiologi_id', $item->radiologi_id)
                                    ->where('kd_radiologi', $request->kd_rad)
                                    ->first();
                    $cek->hasil = $request->input($namaHasil);
                    $cek->save();
                    if ($cek->nomor_surat == ''){
                        $lastID = HasilRadiologi::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
                        if (!$lastID){
                            $newID = "01/RAD/".$this->bulan_romawi(date("m"))."/".date("Y");
                        }
                        else{
                            $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                            $newID = sprintf("%02s", $no_surat)."/RAD/".$this->bulan_romawi(date("m"))."/".date("Y");
                        }
                        $cek->nomor_surat = $newID;
                        $cek->save();
                    }
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = HasilRadiologi::findOrFail($id);
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
        dd($request->all());
        $hasil = HasilRadiologi::where('kd_rad', $request->kd_rad)->get();
        foreach ($hasil as $item){
            $rad = 'rad'.$item->id;
            if ($request->input('rad'.$item->id)){
                $cek = HasilRadiologi::where('kd_rad', $request->kd_lab)
                        ->where('radiologi_id', $item->id)
                        ->first();
                $item->hasil = $request->$rad;
                $item->save();
            }
        }

        $data = Kunjungan::where('register', $hasil[0]->register)->first();
        return view('admin.lab.table', compact('data'));
        // $hasil = HasilRadiologi::findOrFail($request->pemeriksaanID);
        // $hasil->update([
        //     $request->pemeriksaanNama => $request->hasil,
        // ]);

        // $data = HasilRadiologi::where('radiologi_id', $request->product_id)->first();
        // return view('admin.radiologi.table', compact('data'));
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
