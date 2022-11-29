<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Resep Farmasi</title>
    <link rel="stylesheet" href="{{ asset('template/css/vendors_css.css') }}">
</head>
<body onload="window.print()">
    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <img class="img-fluid" src="{{ asset('images/logo.png') }}">
                </div>
                <div class="col-5">
                    <h3 class="text-center">
                        <strong>
                            <u>
                                <i>
                                    <span class="text-uppercase">
                                        {{ $dataWebsite->nama_website }}
                                    </span>
                                </i>
                            </u>
                        </strong>
                    </h3>

                </div>
            </div>
            <hr style="height: 5px; background-color:#000; color:#000">
            <div class="row">
                <div class="col-12">
                    <h6 class="text-start">
                        <strong>
                            <u>
                                <i>
                                    <span class="text-uppercase">
                                        No. Resep : {{ $data[0]->kd_farmasi }}
                                    </span>
                                </i>
                            </u>
                        </strong>
                    </h6>
                    <h6 class="text-start">
                        <strong>
                            <u>
                                <i>
                                    <span class="text-uppercase">
                                        Tanggal : {{ date('d-m-Y', strtotime($data[0]->tgl_order)) }}
                                    </span>
                                </i>
                            </u>
                        </strong>
                    </h6>
                </div>
            </div>

            <br><br><br><br>
            <div class="row">
                <div class="col-12">
                    @foreach ($data as $item)
                        <h6 class="text-start" style="font-size:20px">
                            {{ $loop->iteration }}.
                            <u>
                                <i>
                                    <span class="">
                                        R/ {{ $item->obat->nama }} {{ $item->obat->satuan->alias }} <br> S. {{ $item->keterangan }}
                                    </span>
                                </i>
                            </u>
                        </h6>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
