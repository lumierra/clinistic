<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CariPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Pasien::orderBy('id', 'asc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function($row){
                    $nama = '<span class="fw-bolder">Nama : </span>' . ucfirst($row->nama);
                    $nik = '<span class="fw-bolder">NIK : </span>' . $row->nik ?? '-';
                    // $bpjs = '<span class="fw-bolder">BPJS : </span>' . $row->no_bpjs ?? '-';
                    $result = $nama . '<br>' . $nik . '<br>';
                    return $result;
                })
                ->editColumn('no_rm', function($row){
                    return '<span class="btn btn-sm btn-success" id="pilihPasien" data-id="'.$row->no_rm.'">'.$row->no_rm.'</span>';
                })
                ->editColumn('no_rm_old', function($row){
                    if ($row->no_rm_old == ''){
                        return '';
                    } else {
                        return '<span class="btn btn-sm btn-warning detailPasien" data-id="'.$row->no_rm.'">'.$row->no_rm_old.'</span>';
                    }
                })
                ->editColumn('gender_id', function($row){
                    if ($row->gender->jenis_kelamin == 'Pria'){
                        return '<span class="badge badge-info">'.$row->gender->jenis_kelamin.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->gender->jenis_kelamin.'</span>';
                    }
                })
                ->editColumn('tgl_lahir', function($row){
                    return Carbon::parse($row->tgl_lahir)->age . ' Thn';
                })
                ->editColumn('alamat', function($row){
                    $alamat = '<span class="fw-bolder">Alamat : </span>' . ucfirst($row->alamat);
                    $kel = '<span class="fw-bolder">Kelurahan : </span>' . ucfirst($row->kelurahan->nama_kelurahan ?? '-');
                    $kec = '<span class="fw-bolder">Kecamatan : </span>' . ucfirst($row->kecamatan->nama_kecamatan ?? '-');
                    $kota = '<span class="fw-bolder">Kab/Kota : </span>' . ucfirst($row->kota->nama_kota ?? '-');
                    $provinsi = '<span class="fw-bolder">Provinsi : </span>' . ucfirst($row->provinsi->nama_provinsi ?? '-');
                    return $alamat . '<br>' . $kel . '<br>' . $kec . '<br>' . $kota . '<br>' . $provinsi . '<br>';

                    // $alamat = '<span>Alamat : </span>' . $row->alamat;
                    // if ($row->kelurahan){
                    //     $kel = $row->kelurahan->nama_kelurahan . ',';
                    // } else {
                    //     $kel = '-';
                    // }
                    // if ($row->kecamatan){
                    //     $kec = $row->kecamatan->nama_kecamatan . ',';
                    // } else {
                    //     $kec = '-';
                    // }
                    // if ($row->kota){
                    //     $kota = $row->kota->nama_kota . ',';
                    // } else {
                    //     $kota = '-';
                    // }
                    // if ($row->provinsi){
                    //     $prov = $row->provinsi->nama_provinsi;
                    // } else {
                    //     $prov = '-';
                    // }
                    // $result = $alamat . '<br>' . $kel . '<br>' . $kec . '<br>' . $kota . '<br>' . $prov;
                    // return $result;
                })
                ->rawColumns(['action', 'alamat', 'no_rm', 'gender_id', 'nama', 'no_rm_old'])
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
        $pasien = Pasien::where('no_rm', $request->search)
                        ->orWhere('nik', $request->search)
                        ->orWhere('nama', 'like', '%'.$request->search.'%')
                        ->get();
        return view('admin.pendaftaran.rwj.cariPasien', compact('pasien'));

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
    public function show(Request $request, $id)
    {
        // if ($request->kategori == 'rm'){
        //     $pasien = Pasien::where('no_rm', $id)->first();
        // } else if ($request->kategori == 'nik'){
        //     $pasien = Pasien::where('nik', $id)->first();
        // } else if ($request->kategori == 'nama'){
        //     $pasien = Pasien::where('nama', 'like', '%'.$id.'%')->first();
        // }
        $pasien = Pasien::where('no_rm', $id)
                        ->orWhere('nik', $id)
                        ->orWhere('nama', 'like', '%'.$id.'%')
                        ->get();
        if (count($pasien) == 1){
            $pasien = Pasien::where('no_rm', $id)
                        ->orWhere('nik', $id)
                        ->orWhere('nama', 'like', '%'.$id.'%')
                        ->first();
            if ($pasien){
                return response()->json([
                    'total' => 1,
                    'status' => 'ya',
                    'pasien' => $pasien,
                    'ttl' => $pasien->tempat_lahir . ', ' . date('d', strtotime($pasien->tgl_lahir)) . ' ' . $this->getMonth($pasien->tgl_lahir),
                    'usia' => $pasien->gender->jenis_kelamin . ' / ' . Carbon::parse($pasien->tgl_lahir)->age . ' Thn',
                ]);
            } else {
                return response()->json([
                    'total' => 1,
                    'status' => 'tidak',
                ]);
            }
        } else {
            $result = $pasien;
            if (count($result) == 0){
                return response()->json([
                    'total' => 1,
                    'status' => 'tidak',
                ]);
            } else {
                return response()->json([
                    'total' => count($result),
                    'status' => 'ya',
                    'pasien' => $result,
                ]);
            }
        }
    }

    protected function getMonth($date)
    {
        $month = new DateTime($date);
        $month = $month->format('F');
        $result = $this->month($month) . ' ' . date('Y', strtotime($date));
        return $result;
    }

    protected function month($month)
    {
        $data = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];
        return $data[$month];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = Pasien::where('no_rm', $id)->first();
        if ($pasien){
            $status = 'ya';
            return response()->json([
                'status' => $status,
                'pasien' => $pasien,
                'ttl' => $pasien->tempat_lahir . ', ' . date('d', strtotime($pasien->tgl_lahir)) . ' ' . $this->getMonth($pasien->tgl_lahir),
                'usia' => $pasien->gender->jenis_kelamin . ' / ' . Carbon::parse($pasien->tgl_lahir)->age . ' Thn',
            ]);
        } else {
            $status = 'tidak';
            return response()->json([
                'status' => $status,
            ]);
        }
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
