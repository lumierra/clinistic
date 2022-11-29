<?php

namespace App\Http\Controllers\Admin\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CariKunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('tgl_masuk', date('Y-m-d'))->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('pasien_id', function($row){
                    $nama = '<span class="fw-bolder">Nama : </span>' . ucfirst($row->pasien->nama);
                    $gender = '<span class="fw-bolder">JK : </span>' . ucfirst($row->pasien->gender->jenis_kelamin);
                    $umur = '<span class="fw-bolder">Umur : </span>' . Carbon::parse($row->pasien->tgl_lahir)->age . ' Thn';
                    $result = $nama . '<br>' . $gender . '<br>' . $umur . '<br>';
                    return $result;
                })
                ->editColumn('no_rm', function($row){
                    return '<span class="btn btn-sm btn-primary">'.$row->no_rm.'</span>';
                })
                ->editColumn('register', function($row){
                    return '<span class="btn btn-sm btn-success" id="pilihPasien" data-id="'.$row->register.'">'.$row->register.'</span>';
                })
                ->editColumn('poliklinik_id', function($row){
                    return $row->poliklinik->nama;
                })
                ->editColumn('dokter_id', function($row){
                    return $row->dokter->nama;
                })
                ->editColumn('status_jaminan', function($row){
                    if ($row->status_jaminan == 'umum'){
                        return '<span class="badge badge-info">'.$row->status_jaminan.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->asuransi->nama.'</span>';
                    }
                })
                ->addColumn('status_transaksi', function($row){
                    if ($row->transaksi == null){
                        return '<span class="badge badge-danger">Tidak ada transaksi</span>';
                    } else {
                        if ($row->transaksi->status_transaksi == 'belum_selesai'){
                            return '<span class="badge badge-danger"><i class="fal fa-times"></i> BELUM BAYAR</span>';
                        } else {
                            return '<span class="badge badge-success"><i class="fal fa-check"></i> SUDAH DIBAYAR</span>';
                        }
                    }

                })
                ->rawColumns(['register','no_rm', 'pasien_id', 'poliklinik_id', 'status_jaminan', 'status_transaksi'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
        $data = Kunjungan::where('register', $id)->with('pasien')->first();
        $transaksi = Transaksi::where('kunjungan_id', $data->id)->first();
        if ($data->status_jaminan == 'umum'){
            $status_jaminan = 'UMUM';
        } else {
            $status_jaminan = $data->asuransi->nama;
        }
        return response()->json([
            'data' => $data,
            'ttl' => $data->pasien->tempat_lahir . ', ' . date('d-m-Y', strtotime($data->pasien->tgl_lahir)),
            'usia' => $data->pasien->gender->jenis_kelamin . ' / ' . Carbon::parse($data->pasien->tgl_lahir)->age . ' Thn',
            'unit' => $data->poliklinik->nama,
            'dokter' => $data->dokter->nama,
            'status_jaminan' => $status_jaminan,
            'status_transaksi' => $transaksi->status_transaksi,
            'kunjungan' => $data->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::where('kunjungan_id', $id)->first();
        return view('admin.kasir.detailTransaksi', compact('transaksi'));
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
        $data = Kunjungan::where('tgl_masuk', date('Y-m-d'))
                        ->where('no_rm', $request->search)
                        ->orWhere('register', $request->search)
                        ->first();
        $transaksi = Transaksi::where('kunjungan_id', $data->id)->first();
        if ($data){
            if ($data->status_jaminan == 'umum'){
                $status_jaminan = 'UMUM';
            } else {
                $status_jaminan = $data->asuransi->nama;
            }
            return response()->json([
                'data' => $data,
                'ttl' => $data->pasien->tempat_lahir . ', ' . date('d-m-Y', strtotime($data->pasien->tgl_lahir)),
                'usia' => $data->pasien->gender->jenis_kelamin . ' / ' . Carbon::parse($data->pasien->tgl_lahir)->age . ' Thn',
                'unit' => $data->poliklinik->nama,
                'dokter' => $data->dokter->nama,
                'status_jaminan' => $status_jaminan,
                'status' => 'ya',
                'total' => 1,
                'status_transaksi' => $transaksi->status_transaksi,
                'kunjungan' => $data->id,
            ]);
        } else {
            return response()->json([
                'status' => 'tidak',
                'total' => 1,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
