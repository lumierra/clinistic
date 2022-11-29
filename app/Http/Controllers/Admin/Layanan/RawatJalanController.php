<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use App\Models\DetailTransaksi;
use App\Models\KategoriProduk;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Poliklinik;
use App\Models\Produk;
use App\Models\ProdukLab;
use App\Models\Provinsi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3) {
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', date('Y-m-d'))->where('poliklinik_id', '!=', 4)->orderBy('status_pasien', 'asc')->orderBy('register', 'asc')->get();
        } else if (Auth::user()->role_id == 4) {
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', date('Y-m-d'))->where('poliklinik_id', '!=', 4)->where('dokter_id', Auth::user()->dokter_id)->orderBy('status_pasien', 'asc')->orderBy('register', 'asc')->get();
        } else {
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', date('Y-m-d'))->where('poliklinik_id', '!=', 4)->orderBy('status_pasien', 'asc')->orderBy('register', 'asc')->get();
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('register', function($row){
                    $poli = Poliklinik::where('nama', 'ESTETIKA')->first();
                    if ($row->poliklinik_id == $poli->id){
                        $url = route('admin.estetika.show', $row->id);
                    } else {
                        $url = route('admin.layanan-rwj.show', $row->id);
                    }
                    return '<a href="'.$url.'" class="btn btn-sm btn-success" >'.$row->register.'</a>';
                })
                ->editColumn('no_rm', function($row){
                    $gender = $row->pasien->gender->alias;
                    $tgl = $row->pasien->tgl_lahir;
                    $rm = '<span class="fw-bold">No. RM : </span>' .$row->no_rm;
                    $nama = '<span class="fw-bold">Nama : </span>'.$row->pasien->nama;
                    $ttl = '<span class="fw-bold">TTL : </span>'.$row->pasien->tempat_lahir.', '.Carbon::parse($row->pasien->tgl_lahir)->format('d/m/Y');
                    $jk = '<span class="fw-bold">JK/Umur : </span>' . $gender . ' / ' .Carbon::parse($tgl)->age .' Thn';
                    $result = $rm . '<br>' . $nama . '<br>' . $ttl .'<br>' . $jk;
                    return $result;
                })
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->jam_masuk)->format('d/m/Y H:i') . ' WIB';
                })
                ->addColumn('nama', function($row){
                    return $row->pasien->nama ?? '';
                })
                ->addColumn('tgl_lahir', function($row){
                    return Carbon::parse($row->pasien->tgl_lahir)->format('d/m/Y');
                })
                ->editColumn('poliklinik_id', function($row){
                    return $row->poliklinik->nama ?? '';
                })
                ->addColumn('dokter_id', function($row){
                    return $row->dokter->nama ?? '';
                })
                ->editColumn('status_jaminan', function($row){
                    if ($row->status_jaminan == 'umum'){
                        return '<span class="badge badge-info text-uppercase">'.$row->status_jaminan.'</span>';
                    } else {
                        return '<span class="badge badge-danger text-uppercase">'.$row->asuransi->nama.'</span>';
                    }
                })
                ->editColumn('status_pasien', function($row){
                    if ($row->status_pasien == 'belum_selesai'){
                        $pelayanan = '<tr> <td>Pelayanan</td> <td>:</td> <td><span class="badge badge-danger">Belum Dilayani</span></td> </tr>';
                    } else if ($row->status_pasien == 'diproses') {
                        $pelayanan = '<tr> <td>Pelayanan</td> <td>:</td> <td><span class="badge badge-warning">Sedang Dilayani</span></td> </tr>';
                    } else {
                        $pelayanan = '<tr> <td>Pelayanan</td> <td>:</td> <td><span class="badge badge-success">Sudah Dilayani</span></td> </tr>';
                    }
                    if ($row->status_farmasi == ''){
                        $farmasi = '';
                    } else if ($row->status_farmasi == 'belum'){
                        $farmasi = '<tr> <td>Farmasi</td> <td>:</td> <td><span class="badge badge-danger">Belum Diproses</span></td> </tr>';
                    } else if ($row->status_farmasi == 'diproses'){
                        $farmasi = '<tr> <td>Farmasi</td> <td>:</td> <td><span class="badge badge-warning">Sedang Diproses</span></td> </tr>';
                    } else {
                        $farmasi = '<tr> <td>Farmasi</td> <td>:</td> <td><span class="badge badge-success">Sudah Diproses</span></td> </tr>';
                    }
                    if ($row->status_lab == ''){
                        $lab = '';
                    } else if ($row->status_lab == 'belum'){
                        $lab = '<tr> <td>Lab</td> <td>:</td> <td><span class="badge badge-danger">Belum Diproses</span></td> </tr>';
                    } else if ($row->status_lab == 'diproses'){
                        $lab = '<tr> <td>Lab</td> <td>:</td> <td><span class="badge badge-warning">Sedang Diproses</span></td> </tr>';
                    } else {
                        $lab = '<tr> <td>Lab</td> <td>:</td> <td><span class="badge badge-success">Sudah Diproses</span></td> </tr>';
                    }
                    if ($row->status_radiologi == ''){
                        $radiologi = '';
                    } else if ($row->status_radiologi == 'belum'){
                        $radiologi = '<tr> <td>Radiologi</td> <td>:</td> <td><span class="badge badge-danger">Belum Diproses</span></td> </tr>';
                    } else if ($row->status_radiologi == 'diproses'){
                        $radiologi = '<tr> <td>Radiologi</td> <td>:</td> <td><span class="badge badge-warning">Sedang Diproses</span></td> </tr>';
                    } else {
                        $radiologi = '<tr> <td>Radiologi</td> <td>:</td> <td><span class="badge badge-success">Sudah Diproses</span></td> </tr>';
                    }
                    if ($row->catatan){
                        if ($row->catatan->surat_keterangan == '' || $row->catatan->surat_keterangan == 'tidak_ada'){
                            $surat = '';
                        } else if ($row->catatan->surat_keterangan == 'surat_sakit'){
                            $url = env('APP_URL').'/layanan/surat_sakit/'.$row->id;
                            $surat = '<tr> <td>Surat</td> <td>:</td> <td> <a href="'.$url.'" target="_blank" class="badge badge-info">Surat Sakit <i class="fa-regular fa-arrow-up-right-from-square"></i></a> </td> </tr>';
                        } else if ($row->catatan->surat_keterangan == 'surat_sehat'){
                            $url = env('APP_URL').'/layanan/surat_sehat/'.$row->id;
                            $surat = '<tr> <td>Surat</td> <td>:</td> <td> <a href="'.$url.'" target="_blank" class="badge badge-info">Surat Sehat</a></td> </tr>';
                        } else if ($row->catatan->surat_keterangan == 'surat_berobat') {
                            $url = env('APP_URL').'/layanan/surat_berobat/'.$row->id;
                            $surat = '<tr> <td>Surat</td> <td>:</td> <td> <a href="'.$url.'" target="_blank" class="badge badge-info">Surat Berobat</a></td> </tr>';
                        }
                    } else {
                        $surat = '';
                    }

                    $table = '<table class="">
                                <tbody>
                                    '.$pelayanan. $farmasi . $lab . $radiologi . $surat .'
                                </tbody>
                            </table>';
                    return $table;

                    // return $pelayanan . '<br>' . $farmasi . '<br>' . $lab . '<br>' . $radiologi . '<br>' . $surat;
                })
                ->addColumn('action', function($row){
                    $poli = Poliklinik::where('nama', 'ESTETIKA')->first();
                    if ($row->poliklinik_id == $poli->id){
                        $url = route('admin.estetika.show', $row->id);
                    } else {
                        $url = route('admin.layanan-rwj.show', $row->id);
                    }
                    if ($row->antrian->panggil == 0){
                        $btn = '<div class="list-icons d-inline-flex">
                                <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item me-10 text-dark editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Panggil Pasien">
                                    <i class="fad fa-circle-play fs-20"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item me-10 text-warning deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Lewatkan Pasien">
                                    <i class="fad fa-circle-pause fs-20"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item me-10 text-danger deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Tidak Hadir">
                                    <i class="fad fa-circle-stop fs-20"></i>
                                </a>
                            </div>';
                        $btn .= '<a href="'.$url.'" class="mt-5 btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Pelayanan">
                                    <span class="fas fa-arrow-from-left fs-20 fa-fade"></span>
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </a>';
                    } else {
                        $btn = '<a href="'.$url.'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Pelayanan">
                                <span class="fas fa-arrow-from-left fs-20 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'register', 'status_jaminan', 'no_rm', 'status_pasien'])
                ->make(true);
        }

        $belum = $this->getStatusRwj('belum_selesai');
        $diproses = $this->getStatusRwj('diproses');
        $dilayani = $this->getStatusRwj('selesai');

        return view('admin.layanan.rwj.index', compact('dilayani', 'belum', 'diproses'));
    }

    protected function getStatusRwj($status)
    {
        // $result = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', date('Y-m-d'))->where('status_pasien', $status)->where('poliklinik_id', '!=', 4)->get()->count();
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3) {
            $result = Kunjungan::where('status_kunjungan', 'rwj')
                ->where('tgl_masuk', date('Y-m-d'))
                ->where('poliklinik_id', '!=', 4)
                ->where('status_pasien', $status)
                ->get()
                ->count();
        } else if (Auth::user()->role_id == 4) {
            $dokter = Auth::user()->dokter->dokterpoli->pluck('poliklinik_id')->toArray();
            $result = Kunjungan::where('tgl_masuk', date('Y-m-d'))
                ->where('status_kunjungan', 'rwj')
                ->where('dokter_id', Auth::user()->dokter_id)
                ->whereIn('poliklinik_id', $dokter)
                ->where('status_pasien', $status)
                ->get()
                ->count();
        } else {
            $result = Kunjungan::where('status_kunjungan', 'rwj')
                ->where('tgl_masuk', date('Y-m-d'))
                ->where('poliklinik_id', '!=', 4)
                ->where('status_pasien', $status)
                ->get()
                ->count();
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // how to get this tuesday this week
        $tuesday = date('Y-m-d', strtotime('next tuesday'));
        // get monday last week
        $monday = date('Y-m-d', strtotime('next monday'));
        dd($tuesday, $monday);
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
        // $produkLab = ProdukLab::all();
        $kategorilab = KategoriProduk::where('kode', 'lab')->first();
        $kategorirad = KategoriProduk::where('kode', 'radiologi')->first();
        $kategoriTindakan = KategoriProduk::where('kode', 'tindakan')->first();
        $produkLab = Produk::where('kategori_produk_id', $kategorilab->id)->get();
        $produkRad = Produk::where('kategori_produk_id', $kategorirad->id)->get();
        $produkTindakan = Produk::where('kategori_produk_id', $kategoriTindakan->id)->get();
        $obat = Obat::all();
        $provinsi = Provinsi::all();
        return view('admin.layanan.rwj.show', compact('data', 'catatan', 'status',
                    'produkLab', 'obat', 'kunjungan', 'provinsi', 'produkRad', 'produkTindakan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', $id)->orderBy('status_pasien', 'asc')->orderBy('register', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('register', function($row){
                    $poli = Poliklinik::where('nama', 'ESTETIKA')->first();
                    if ($row->poliklinik_id == $poli->id){
                        $url = route('admin.estetika.show', $row->id);
                    } else {
                        $url = route('admin.layanan-rwj.show', $row->id);
                    }
                    return '<a href="'.$url.'" class="btn btn-sm btn-success" >'.$row->register.'</a>';
                })
                ->editColumn('no_rm', function($row){
                    $gender = $row->pasien->gender->alias;
                    $tgl = $row->pasien->tgl_lahir;
                    $rm = '<span class="fw-bold">No. RM : </span>' .$row->no_rm;
                    $nama = '<span class="fw-bold">Nama : </span>'.$row->pasien->nama;
                    $ttl = '<span class="fw-bold">TTL : </span>'.$row->pasien->tempat_lahir.', '.Carbon::parse($row->pasien->tgl_lahir)->format('d/m/Y');
                    $jk = '<span class="fw-bold">JK/Umur : </span>' . $gender . ' / ' .Carbon::parse($tgl)->age .' Thn';
                    $result = $rm . '<br>' . $nama . '<br>' . $ttl .'<br>' . $jk;
                    return $result;
                })
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->jam_masuk)->format('d/m/Y H:i') . ' WIB';
                })
                ->addColumn('nama', function($row){
                    return $row->pasien->nama ?? '';
                })
                ->addColumn('tgl_lahir', function($row){
                    return Carbon::parse($row->pasien->tgl_lahir)->format('d/m/Y');
                })
                ->editColumn('poliklinik_id', function($row){
                    return $row->poliklinik->nama ?? '';
                })
                ->addColumn('dokter_id', function($row){
                    return $row->dokter->nama ?? '';
                })
                ->editColumn('status_jaminan', function($row){
                    if ($row->status_jaminan == 'umum'){
                        return '<span class="badge badge-info text-uppercase">'.$row->status_jaminan.'</span>';
                    } else {
                        return '<span class="badge badge-danger text-uppercase">'.$row->asuransi->nama.'</span>';
                    }
                })
                ->editColumn('status_pasien', function($row){
                    if ($row->status_pasien == 'belum_selesai'){
                        $pelayanan = '<tr> <td>Pelayanan</td> <td>:</td> <td><span class="badge badge-danger">Belum Dilayani</span></td> </tr>';
                    } else if ($row->status_pasien == 'diproses') {
                        $pelayanan = '<tr> <td>Pelayanan</td> <td>:</td> <td><span class="badge badge-warning">Sedang Dilayani</span></td> </tr>';
                    } else {
                        $pelayanan = '<tr> <td>Pelayanan</td> <td>:</td> <td><span class="badge badge-success">Sudah Dilayani</span></td> </tr>';
                    }
                    if ($row->status_farmasi == ''){
                        $farmasi = '';
                    } else if ($row->status_farmasi == 'belum'){
                        $farmasi = '<tr> <td>Farmasi</td> <td>:</td> <td><span class="badge badge-danger">Belum Diproses</span></td> </tr>';
                    } else if ($row->status_farmasi == 'diproses'){
                        $farmasi = '<tr> <td>Farmasi</td> <td>:</td> <td><span class="badge badge-warning">Sedang Diproses</span></td> </tr>';
                    } else {
                        $farmasi = '<tr> <td>Farmasi</td> <td>:</td> <td><span class="badge badge-success">Sudah Diproses</span></td> </tr>';
                    }
                    if ($row->status_lab == ''){
                        $lab = '';
                    } else if ($row->status_lab == 'belum'){
                        $lab = '<tr> <td>Lab</td> <td>:</td> <td><span class="badge badge-danger">Belum Diproses</span></td> </tr>';
                    } else if ($row->status_lab == 'diproses'){
                        $lab = '<tr> <td>Lab</td> <td>:</td> <td><span class="badge badge-warning">Sedang Diproses</span></td> </tr>';
                    } else {
                        $lab = '<tr> <td>Lab</td> <td>:</td> <td><span class="badge badge-success">Sudah Diproses</span></td> </tr>';
                    }
                    if ($row->status_radiologi == ''){
                        $radiologi = '';
                    } else if ($row->status_radiologi == 'belum'){
                        $radiologi = '<tr> <td>Radiologi</td> <td>:</td> <td><span class="badge badge-danger">Belum Diproses</span></td> </tr>';
                    } else if ($row->status_radiologi == 'diproses'){
                        $radiologi = '<tr> <td>Radiologi</td> <td>:</td> <td><span class="badge badge-warning">Sedang Diproses</span></td> </tr>';
                    } else {
                        $radiologi = '<tr> <td>Radiologi</td> <td>:</td> <td><span class="badge badge-success">Sudah Diproses</span></td> </tr>';
                    }
                    if ($row->catatan){
                        if ($row->catatan->surat_keterangan == '' || $row->catatan->surat_keterangan == 'tidak_ada'){
                            $surat = '';
                        } else if ($row->catatan->surat_keterangan == 'surat_sakit'){
                            $url = env('APP_URL').'/layanan/surat_sakit/'.$row->id;
                            $surat = '<tr> <td>Surat</td> <td>:</td> <td> <a href="'.$url.'" target="_blank" class="badge badge-info">Surat Sakit <i class="fa-regular fa-arrow-up-right-from-square"></i></a> </td> </tr>';
                        } else if ($row->catatan->surat_keterangan == 'surat_sehat'){
                            $url = env('APP_URL').'/layanan/surat_sehat/'.$row->id;
                            $surat = '<tr> <td>Surat</td> <td>:</td> <td> <a href="'.$url.'" target="_blank" class="badge badge-info">Surat Sehat</a></td> </tr>';
                        } else if ($row->catatan->surat_keterangan == 'surat_berobat') {
                            $url = env('APP_URL').'/layanan/surat_berobat/'.$row->id;
                            $surat = '<tr> <td>Surat</td> <td>:</td> <td> <a href="'.$url.'" target="_blank" class="badge badge-info">Surat Berobat</a></td> </tr>';
                        }
                    } else {
                        $surat = '';
                    }

                    $table = '<table class="">
                                <tbody>
                                    '.$pelayanan. $farmasi . $lab . $radiologi . $surat .'
                                </tbody>
                            </table>';
                    return $table;
                })
                ->addColumn('action', function($row){
                    $poli = Poliklinik::where('nama', 'ESTETIKA')->first();
                    if ($row->poliklinik_id == $poli->id){
                        $url = route('admin.estetika.show', $row->id);
                    } else {
                        $url = route('admin.layanan-rwj.show', $row->id);
                    }
                    $btn = '<a href="'.$url.'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Pelayanan">
                                <span class="fad fa-arrow-from-left fs-20"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'register', 'status_jaminan', 'no_rm', 'tanggal', 'status_pasien'])
                ->make(true);
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
        $kunjungan = Kunjungan::findOrFail($id);

        $kunjungan->update([
            'status_pasien' => $request->status,
        ]);
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
        //
    }
}
