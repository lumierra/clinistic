<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kunjungan;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;
use Illuminate\Support\Str;

class CetakAntrianController extends Controller
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
        $data = Antrian::where('kunjungan_id', $id)->first();

        try {
            // CONFIG
            // $printer = 'EPSON TM-U220 Receipt';
            // $connector = new WindowsPrintConnector("EPSON TM-U220 Receipt");
            $connector = new WindowsPrintConnector("EPSON TM-T81 Receipt");
            // $connector = new NetworkPrintConnector("192.168.13.21", 9100);
            $printer = new Printer($connector);

            // HEADER
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer -> setTextSize(2, 2);
            $printer -> text('KLINIK ABAH');
            $printer -> selectPrintMode();
            // $printer -> text('NOMOR IZIN : 441/DPMTSP-KL/129/2017');
            // $printer -> feed();
            // $printer -> text('Jl. Medan – Banda Aceh, Bukit Rata');
            // $printer -> feed();
            // $printer -> text('Kejuruan Muda, Aceh Tamiang');
            // $printer -> feed();
            // $printer -> text('Kode Pos 24477, HP 082124057535');
            // $printer -> feed();
            // $printer -> text('Email : klinikabah@gmail.com');
            $printer -> feed();
            $printer -> text('---------------------------------');
            $printer -> feed(2);

            $printer -> text('NOMOR ANTRIAN ANDA');
            $printer -> feed(2);

            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer -> setFont(Printer::FONT_C);
            $printer -> setTextSize(5,5);
            $printer -> text($data->nomor_antrian);
            $printer -> feed(2);

            $printer -> selectPrintMode();
            $printer -> feed();
            $printer -> text('Diambil pada  : '.date('d-m-Y H:i:s'));
            $printer -> feed();
            $printer -> text('Berlaku sampai : '.date('d-m-Y H:i:s', strtotime('+60 minutes')));
            $printer -> feed();
            $printer -> text('---------------------------------');
            $printer -> feed(2);

            $printer -> selectPrintMode();
            $printer -> text('Terima kasih atas kunjungan Anda');
            $printer -> feed();
            $printer -> text('Silahkan menunggu panggilan');
            $printer -> feed();


            /* Close printer */
            $printer -> cut();
            $printer -> close();
            return response()->json('Success');
            // return redirect()->back();
        } catch (Exception $e) {
            // echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
            // return redirect()->back();
            return response()->json($e);
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
