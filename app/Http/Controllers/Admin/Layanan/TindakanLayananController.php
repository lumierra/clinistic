<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Admin\Log\LogController;
use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\DetailBarang;
use App\Models\DetailTindakan;
use App\Models\DetailTransaksi;
use App\Models\Kunjungan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TindakanLayananController extends Controller
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
        $tindakan = DetailTindakan::where('register', $kunjungan->register)->where('produk_id', $request->produk_tindakan)->first();
        $produk = Produk::findOrFail($request->produk_tindakan);
        if ($tindakan){
            $tindakan->update([
                'jumlah' => $tindakan->jumlah + $request->jumlah,
                'harga' => $produk->harga,
            ]);
            $detailTransaksi = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->where('produk_id', $produk->id)->orderBy('urut', 'desc')->first();
            $detailTransaksi->update([
                'jumlah' => $detailTransaksi->jumlah + $request->jumlah,
                'harga' => $produk->harga,
            ]);
        } else {
            $insert = DetailTindakan::updateOrCreate(
                ['id' => $request->catatan]
                ,[
                'register' => $kunjungan->register,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'user_id' => Auth::user()->id,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'produk_id' => $request->produk_tindakan,
                'tgl_order' => date('Y-m-d'),
                'status' => 'belum',
                'jumlah' => $request->jumlah,
                'harga' => $produk->harga,
            ]);
            $detailTransaksi = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->orderBy('urut', 'desc')->first();
            $insertDetail = DetailTransaksi::create([
                'no_transaksi' => $detailTransaksi->no_transaksi,
                'no_rm' => $kunjungan->no_rm,
                'register' => $kunjungan->register,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'transaksi_id' => $detailTransaksi->transaksi_id,
                'kunjungan_id' => $kunjungan->id,
                'dokter_id' => $kunjungan->dokter_id,
                'pasien_id' => $kunjungan->pasien_id,
                'poliklinik_id' => $kunjungan->poliklinik_id,
                'user_id' => Auth::user()->id,
                'produk_id' => $produk->id,
                'jumlah' => $request->jumlah,
                'harga' => $produk->harga,
                'urut' => $detailTransaksi->urut + 1,
                'tgl_detail' => date('Y-m-d'),
                'keterangan' => 'tindakan',
            ]);
        }

        return response()->json('Success');

        // $tindakan = DetailTindakan::where('kunjungan_id', $request->kunjungan)->first();
        // if ($tindakan){
        //     $newID = $tindakan->kd_tindakan;
        // } else {
        //     $lastID = DetailTindakan::select('kd_tindakan')->where('tgl_order', date('Y-m-d'))->orderBy('id', 'desc')->first();
        //     if (!$lastID){
        //         $newID = 'TIN-'.date('ymd').'-0001';
        //     }
        //     else{
        //         $lastIncrement = substr($lastID->kd_lab, -4, 4);
        //         $newID = 'LAB-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
        //     }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DetailTindakan::where('kunjungan_id', $id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('kd_tindakan', function($row){
                //     return '<a href="'.route('admin.lab.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->kd_tindakan.'</a>';
                // })
                ->editColumn('produk_id', function($row){
                    return $row->produk->nama;
                })
                ->editColumn('status', function($row){
                    if ($row->status == 'belum'){
                        return '<span class="badge badge-sm badge-danger">BELUM DIPROSES</span>';
                    } else if ($row->status == 'diproses') {
                        return '<span class="badge badge-warning btn-sm">DALAM PROSES</span>';
                    } else if ($row->status == 'selesai') {
                        return '<span class="badge badge-success btn-sm">SELESAI</span>';
                    } else if ($row->status == 'batal') {
                        return '<span class="badge badge-danger btn-sm">BATAL</span>';
                    }
                })
                ->editColumn('harga', function($row){
                    return 'Rp. '.number_format($row->harga, 0, ',', '.');
                })
                ->addColumn('total', function($row){
                    return 'Rp. '.number_format($row->harga*$row->jumlah, 0, ',', '.');
                })
                ->addColumn('action', function($row){
                    if ($row->status == 'belum'){
                        $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteTindakan" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_tindakan', 'status', 'harga', 'total'])
                ->make(true);
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
        $kunjungan = Kunjungan::findOrFail($id);
        $pertama = $kunjungan->created_at;
        $kedua = date('Y-m-d H:i:s');
        $diff = strtotime($kedua) - strtotime($pertama);
        // mencari jumlah detik menit jam dari pertama dan kedua
        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        $detik = $menit - floor($menit / 60) * 60;
        $menit = floor($menit / 60);
        // menampilkan hasil
        // ketika jam lebih dari 0
        if ($jam > 0) {
            $lama = $jam . " jam " . $menit . " menit " . $detik . " detik";
        } else if ($menit > 0) {
            $lama = $menit . " menit " . $detik . " detik";
        } else {
            $lama = $detik . " detik";
        }
        // $lama = $jam . " Jam " . $menit . " Menit " . $detik . " Detik";
        // dd($lama);
        $kunjungan->update([
            'status_pasien' => 'diproses',
            'respon_waktu_dokter' => $lama,
        ]);
        $antrian = Antrian::where('kunjungan_id', $id)->first();
        $antrian->update([
            'panggil' => 1,
            'waktu_panggil' => date('Y-m-d H:i:s'),
            'status' => 'dipanggil'
        ]);
        $data = [
            'user' => auth()->user()->id,
            'nama' => auth()->user()->name,
            'tanggal' => date('Y-m-d H:i:s'),
            'keterangan' => 'Pelayanan pada pasien ' . $kunjungan->no_rm . ' ' . $kunjungan->pasien->nama,
            'warna' => 'info',
            'aktifitas' => 'READ',
        ];
        $log = new LogController();
        $log->simpan($data);
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
        $tindakan = DetailTindakan::findOrFail($id);
        $detailTransaksi = DetailTransaksi::where('kunjungan_id', $tindakan->kunjungan_id)->where('produk_id', $tindakan->produk_id)->where('keterangan', 'tindakan')->first();
        $detailTransaksi->delete();
        $tindakan->delete();
        return response()->json('Success');
    }
}
