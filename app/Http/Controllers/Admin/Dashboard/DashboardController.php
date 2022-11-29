<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangToko;
use App\Models\Data;
use App\Models\DetailBarang;
use App\Models\DetailTransaksi;
use App\Models\Diagnosa;
use App\Models\Dokter;
use App\Models\DokterPoliklinik;
use App\Models\Kategori;
use App\Models\Kunjungan;
use App\Models\Lab;
use App\Models\Poliklinik;
use App\Models\Produk;
use App\Models\Radiologi;
use App\Models\Toko;
use App\Models\TransaksiOut;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kunjungan = Kunjungan::where('tgl_masuk', date('Y-m-d'))->get()->count();
        $poli = Poliklinik::where('id', '!=', 4)->get();
        $dokter = Dokter::all()->count();
        $lab = $this->getLab();
        $radiologi = $this->getRadiologi();


        $firstDay = Carbon::now()->startOfMonth()->format('Y-m-d');
        $lastDay = Carbon::now()->endOfMonth()->format('Y-m-d');
        $countDay = Carbon::now()->daysInMonth;
        $month = Carbon::now()->locale('id')->monthName;

        $role = Auth::user()->role->name;
        if ($role == 'spesial' || $role == 'admin'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'dokter'){
            $dokter = Auth::user()->dokter_id;
            $kunjungan = Kunjungan::where('tgl_masuk', date('Y-m-d'))->where('dokter_id', $dokter)->get()->count();
            $getPoli = DokterPoliklinik::select('poliklinik_id')->where('dokter_id', $dokter)->get();
            $poli = Poliklinik::whereIn('id',$getPoli)->get();
            $diagnosa = Diagnosa::select('icd_id')->where('dokter_id', $dokter)->groupBy('icd_id')->orderByRaw('COUNT(*) DESC')->limit(10)->get();
            $kasus = Diagnosa::select('icd_id')->where('dokter_id', $dokter)->where('tgl_masuk', date('Y-m-d'))->get()->count();
            $day = Carbon::now()->locale('id')->dayName . ', ' . Carbon::now()->locale('id')->format('d M Y');
            $umum = Kunjungan::where('tgl_masuk', date('Y-m-d'))->where('dokter_id', $dokter)->where('asuransi_id', 0)->get()->count();
            $bpjs = Kunjungan::where('tgl_masuk', date('Y-m-d'))->where('dokter_id', $dokter)->where('asuransi_id', 1)->get()->count();
            $dataKunjungan = $this->getKunjunganByDokter($dokter);

            $pendapatanPendaftaran = $this->getPendapatanBy($dokter, 'pendaftaran', $firstDay, $lastDay);
            $pendapatanTindakan = $this->getPendapatanBy($dokter, 'tindakan', $firstDay, $lastDay);

            $bulan = $this->getMonths($dokter)['bulan'];
            $pendapatanBulan = $this->getMonths($dokter)['pendapatan'];

            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'countDay', 'month',
                    'dokter', 'diagnosa', 'day', 'umum', 'bpjs', 'kasus', 'dataKunjungan', 'pendapatanPendaftaran', 'pendapatanTindakan',
                    'bulan', 'pendapatanBulan'));
        } else if ($role == 'perawat'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'apoteker'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'operator lab'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'operator rad'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'operator'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'kasir'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else if ($role == 'beautician'){
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        } else {
            // return redirect()->route('admin.dashboard.index');
            return view('admin.dashboard.index', compact('kunjungan', 'poli', 'dokter', 'lab', 'radiologi', 'countDay', 'month'));
        }
    }

    protected function getMonths($dokter)
    {
        $data = array();
        $pendapatan = array();
        $now = Carbon::now()->locale('id')->format('M');
        for ($i=0; $i < 12; $i++){
            $tanggal = date('Y').'-'.$i+1;
            $tanggal = date('Y-m-d', strtotime($tanggal));
            $bulan = Carbon::parse($tanggal)->locale('id')->format('M');
            $firstDay = Carbon::parse($tanggal)->startOfMonth()->format('Y-m-d');
            $lastDay = Carbon::parse($tanggal)->endOfMonth()->format('Y-m-d');
            array_push($data, $bulan);

            $detailTransaksi = DetailTransaksi::whereBetween('tgl_detail', [$firstDay, $lastDay])->where('dokter_id', $dokter)->whereIn('keterangan', ['pendaftaran', 'tindakan'])->get();
            $total = 0;
            foreach ($detailTransaksi as $item){
                $total = $total + $item->produk->harga_dokter;
            }
            array_push($pendapatan, $total);
            if ($now == $bulan){
                break;
            }
        }

        $result = [
            'bulan' => $data,
            'pendapatan' => $pendapatan
        ];

        return $result;
    }

    protected function getPendapatanBy($dokter, $keterangan, $firstDay, $lastDay)
    {
        // $data = DetailTransaksi::whereBetween('tgl_detail', [$firstDay, $lastDay])->where('dokter_id', $dokter)->where('keterangan', $keterangan)
        //         ->selectRaw('sum(harga) as total, tgl_detail')
        //         ->groupBy('tgl_detail')
        //         ->get();
        $data = DetailTransaksi::whereBetween('tgl_detail', [$firstDay, $lastDay])->where('dokter_id', $dokter)->where('keterangan', $keterangan)->get();
        $total = 0;
        foreach ($data as $item){
            $total = $total + $item->produk->harga_dokter;
        }
        return $total;

    }

    protected function getKunjunganByDokter($dokter)
    {
        $firstDay = Carbon::now()->startOfMonth()->format('Y-m-d');
        $diff = Carbon::now()->diffInDays($firstDay);
        $batasHari = $diff + 1;

        $result = array();
        for ($i=0; $i < $batasHari; $i++){
            $kunjungan = Kunjungan::where('tgl_masuk', date('Y-m-'.$i+1))->where('dokter_id', $dokter)->get()->count();
            array_push($result, $kunjungan);
        }
        return $result;
    }

    protected function getDay()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $days = (int)date('d', strtotime($end));

        $temp = array();
        for ($i = 0; $i < $days; $i++) {
            $temp[] = $i+1;
        }

        return $temp;
    }


    protected function getLab()
    {
        $lab = Lab::where('tgl_order', date('Y-m-d'))->distinct()->get('kd_lab')->count();
        return $lab;
    }
    protected function getRadiologi()
    {
        $radiologi = Radiologi::where('tgl_order', date('Y-m-d'))->distinct()->get('kd_rad')->count();
        return $radiologi;
    }
}
