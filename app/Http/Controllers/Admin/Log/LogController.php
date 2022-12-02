<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LogController extends Controller
{

    public function simpan($data)
    {
        $data = (object)$data;
        LogAktifitas::create([
            'user_id' => $data->user,
            'nama' => $data->nama,
            'tanggal' => $data->tanggal,
            'keterangan' => $data->keterangan,
            'warna' => $data->warna,
            'aktifitas' => $data->aktifitas,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LogAktifitas::orderBy('tanggal', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal', function($row){
                    $date = Carbon::parse(date('Y-m-d', strtotime($row->tanggal)))->locale('id')->isoFormat('dddd');
                    return $date . ', '. date('d/m/Y H:i:s', strtotime($row->tanggal));
                })
                ->editColumn('keterangan', function($row){
                    return $row->nama . ' ' . 'melakukan ' . '<span class="text-'.$row->warna.'">'.$row->aktifitas.'</span>' . ' ' . $row->keterangan;
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'keterangan', 'tanggal'])
                ->make(true);
        }
        $log = LogAktifitas::orderBy('tanggal', 'desc')->get();
        return view('admin.log.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
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
        LogAktifitas::findOrFail($id)->delete();
        return response()->json('Success');
    }
}
