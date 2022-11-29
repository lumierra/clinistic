<?php

namespace App\Http\Controllers\Admin\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Kunjungan;
use App\Models\Satuan;
use App\Models\Tampung;
use App\Models\Toko;
use App\Models\Transaksi;
use App\Models\TransaksiOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barang = Barang::orderBy('nama_barang', 'asc')->get();
        // $tampung = Tampung::where('user_id', Auth::user()->id)->get();
        // $totalHarga = $this->getTotal();
        // $toko = Toko::all();
        // return view('admin.kasir.index', compact('barang', 'tampung', 'totalHarga', 'toko'));

        return view('admin.kasir.index');
    }

    protected function getTotal()
    {
        $tampung = Tampung::where('user_id', Auth::user()->id)->get();
        $total = 0;
        foreach ($tampung as $item){
            $total = $total+$item->harga;
        }
        return $total;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tampung = Tampung::where('user_id', Auth::user()->id)->get();
        $totalHarga = $this->getTotal();
        return view('admin.kasir.totalHarga', compact('totalHarga', 'tampung'));

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

        $transaksi = Transaksi::findOrFail($request->nomor_transaksi);
        $kunjungan = Kunjungan::findOrFail($transaksi->kunjungan_id);
        if ($kunjungan->status_farmasi != null && $kunjungan->status_farmasi != 'selesai'){
            return response()->json([
                'status' => 201,
                'message' => 'Status Farmasi Belum Diselesaikan'
            ]);
        }
        if ($kunjungan->status_lab != null && $kunjungan->status_lab != 'selesai'){
            return response()->json([
                'status' => 201,
                'message' => 'Status Lab Belum Diselesaikan'
            ]);
        }
        if ($kunjungan->status_radiologi != null && $kunjungan->status_radiologi != 'selesai'){
            return response()->json([
                'status' => 201,
                'message' => 'Status Radiologi Belum Diselesaikan'
            ]);
        }
        if ($kunjungan->status_pasien != 'selesai'){
            return response()->json([
                'status' => 201,
                'message' => 'Pelayanan Pasien Belum Diselesaikan'
            ]);
        }

        if ($transaksi->status_transaksi == 'selesai'){
            return response()->json([
                'status' => 201,
                'message' => 'Transaksi Sudah Selesai'
            ]);
        }

        $total = 0;
        foreach ($transaksi->detailTransaksi as $item){
            $total = $total + ($item->harga*$item->jumlah);
        }
        if (substr($total,-3) < 499){
            $result = substr($total,-3);
            ($result == 000 ? $total=round($total,-3) : $total=str_replace($result,500,$total));
        } else if (substr($total,-3 > 501 && substr($total,-3) < 999)){
            $total=round($total,-3);
        } else {
            $total=round($total,-3)+1000;
        }

        $transaksi->update([
            'status_transaksi' => 'selesai',
            'total' => $total,
            'bayar' => (int)$request->bayar,
            'kembalian' => (int)$request->bayar - $total,
            'user_id' => Auth::user()->id,
            'tgl_transaksi' => date('Y-m-d'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi Berhasil',
            'kunjungan' => $kunjungan->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
