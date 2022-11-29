<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use App\Models\FotoEstetika;
use App\Models\KategoriProduk;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Produk;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstetikaController extends Controller
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
        $catatan = Catatan::where('kunjungan_id', $id)->first();
        if ($catatan){
            $catatan = $catatan;
            $status = 'ada';
        } else {
            $catatan = array();
            $status = 'tidak';
        }

        $kategorilab = KategoriProduk::where('kode', 'lab')->first();
        $kategorirad = KategoriProduk::where('kode', 'radiologi')->first();
        $kategoriTindakan = KategoriProduk::where('kode', 'tindakan')->first();
        $produkLab = Produk::where('kategori_produk_id', $kategorilab->id)->get();
        $produkRad = Produk::where('kategori_produk_id', $kategorirad->id)->get();
        $produkTindakan = Produk::where('kategori_produk_id', $kategoriTindakan->id)->get();
        $obat = Obat::all();
        $provinsi = Provinsi::all();
        return view('admin.layanan.estetika.show', compact('data', 'catatan', 'status',
                    'produkLab', 'obat', 'kunjungan', 'provinsi', 'produkRad', 'produkTindakan'));
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
        $data = FotoEstetika::findOrFail($id);

        $image_path = public_path().'/'.$data->photo;
        unlink($image_path);
        $data->delete();
        // if(Storage::exists($data->nama)){
        //     Storage::delete($data->nama);
        //     $data->delete();
        // }
        return response()->json('Success');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('photo')){

            if ($request->file('photo')->isValid()){

                $time = Carbon::now()->timestamp;

                $path = $request->file('photo')->storeAs('estetika',  'estetika-'.$request->kunjungan.'-'.$time.'.png', 'public');

                $estetika = FotoEstetika::create([
                    'kunjungan_id' => $request->kunjungan,
                    'catatan_id' => $request->catatan,
                    'photo' => 'storage/' . $path,
                    'nama' => $path,
                ]);
            }
        }

        return response()->json('Success');
    }

    public function hasil($id)
    {
        $data = FotoEstetika::where('kunjungan_id', $id)->orderBy('id', 'asc')->get();
        return view('admin.layanan.estetika.foto', compact('data'));
    }
}
