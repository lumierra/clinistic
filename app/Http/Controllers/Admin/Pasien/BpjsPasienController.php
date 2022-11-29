<?php

namespace App\Http\Controllers\Admin\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\PasienBpjs;
use Illuminate\Http\Request;

class BpjsPasienController extends Controller
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
        $cek = PasienBpjs::where('asuransi_id', $request->asuransi)->where('pasien_id', $request->pasien)->first();
        if ($request->status == 'create'){
            if (!$cek){
                $bpjs = PasienBpjs::create([
                    'pasien_id' => $request->pasien,
                    'asuransi_id' => $request->asuransi,
                    'nomor' => $request->nomor,
                ]);
            }
        } else {
            $bpjs = PasienBpjs::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'pasien_id' => $request->pasien,
                    'asuransi_id' => $request->asuransi,
                    'nomor' => $request->nomor,
                ]
            );
        }

        $bpjs = PasienBpjs::where('pasien_id', $request->pasien)->get();
        return view('admin.pasien.asuransi', compact('bpjs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bpjs = PasienBpjs::where('pasien_id', $id)->get();
        return view('admin.pasien.asuransi', compact('bpjs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bpjs = PasienBpjs::findOrFail($id);
        return response()->json($bpjs);
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
        $bpjs = PasienBpjs::where('asuransi_id', $request->asuransi)
                        ->where('pasien_id', $request->pasien)
                        ->first();
        return response()->json($bpjs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PasienBpjs::findOrFail($id);
        $data->delete();
        $bpjs = PasienBpjs::where('pasien_id', $data->pasien_id)->get();
        return view('admin.pasien.asuransi', compact('bpjs'));
    }
}
