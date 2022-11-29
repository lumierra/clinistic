<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class AlergiController extends Controller
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
        $kunjungan = Kunjungan::findOrFail($id);
        $pasien = Kunjungan::where('no_rm', $kunjungan->no_rm)->orderBy('tgl_masuk', 'desc')->get();
        foreach ($pasien as $item){
            $catatan = Catatan::where('register', $item->register)->first();
            if ($catatan){
                if ($catatan->tinggi_badan != null){
                    break;
                    // return response()->json($catatan);
                }
            }
        }
        if ($catatan){
            return response()->json([
                'status' => 200,
                'data' => $catatan,
            ]);
        } else {
            return response()->json([
                'status' => 201
            ]);
        }

        // return response()->json($catatan);
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
