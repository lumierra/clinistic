@section('title', 'Dashboard')

@push('style')
<style>
    .test {
        /* Color gradient */
        background: -webkit-linear-gradient(315deg,#42d392 25%,#647eff);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endpush

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="row mb-50">
                    <div class="col-xl-12 col-12">
                        <div class="row">
                            {{-- MOBILE --}}
                            <div class="d-inline d-sm-none col-md-6 col-12">
                                <h3 class="text-center test">Selamat Datang, {{ Str::title(Auth::user()->name) }}</h3>
                                <h5 class="text-center test">Di Sistem Informasi Manajemen Klinik</h5>
                                <h5 class="text-center test">{{ $dataWebsite->nama_website ?? '' }}</h5>
                            </div>
                            <div class="col-md-6 col-12">
                                <img src="{{ asset('images/dokter-'.$dataWebsite->template.'.png') }}">
                            </div>
                            {{-- DESKTOP --}}
                            <div class="d-none d-md-inline d-sm-none col-md-6 col-12">
                                <h1 class="text-center test">Selamat Datang, {{ Str::title(Auth::user()->name) }}</h1>
                                <h3 class="text-center test">Di Sistem Informasi Manajemen Klinik</h3>
                                <h3 class="text-center test">{{ $dataWebsite->nama_website ?? '' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @can('admin')
                    @include('admin.dashboard.admin')
                @endcan

                @can('dokter')
                    @include('admin.dashboard.dokter')
                @endcan

            </section>
        </div>
    </div>

    @push('script')
    <script src="{{ asset('template/assets/vendor_components/c3/d3.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/c3/c3.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
    {{-- <script src="{{ asset('template/js/pages/widgets.js') }}"></script> --}}
    <script>
        var n = c3.generate({
            bindto: "#spline-chart",
            size: { height: 350 },
            point: { r: 4 },
            color: { pattern: ['#4974e0', '#3db76b', '#689f38', '#ff8f00'] },
            data: {
                x: "x",
                columns: [
                        ['x',
                        @for ($i = 0; $i < $countDay; $i++)
                            {{ $i+1 }},
                        @endfor
                    ],
                        @foreach ($poli as $item)
                            [
                                '{{ $item->nama }}',
                                @for ($i = 0; $i < $countDay; $i++)
                                    {{ $item->getPasienByDate($i + 1) }},
                                @endfor
                            ],
                        @endforeach
                ],
                type: "spline"
            },
            grid: { y: { show: !0 }, x: { show: !1 } },
        });

        // CHART 2
        @can('dokter')
            var spark2 = {
                chart: {
                    id: 'spark2',
                    group: 'sparks',
                    type: 'line',
                    height: 200,
                    sparkline: {
                    enabled: true
                    },
                    dropShadow: {
                    enabled: true,
                    top: 5,
                    left: 1,
                    blur: 5,
                    opacity: 0.1,
                    }
                },
                series: [{
                    data: [
                        @foreach ($dataKunjungan as $item)
                            {{ $item }},
                        @endforeach
                    ]
                }],
                stroke: {
                    curve: 'smooth'
                },
                markers: {
                    size: 0
                },
                grid: {
                    padding: {
                    top: 50,
                    bottom: 50,
                    right: 6,
                    left: 0
                    }
                },
                colors: ['#3260d6'],
                tooltip: {
                    x: {
                    show: false
                    },
                    y: {
                    title: {
                        formatter: function formatter(val) {
                        return '';
                        }
                    }
                    }
                }
            }
            new ApexCharts(document.querySelector("#spark2"), spark2).render();

            // PENDAPATAN
            var options = {
                series: [{
                // name: 'Net Profit',
                // data: [44, 55, 57, 56, 61, 58, 63, 56, 61, 58, 63]
                // },
                // {
                    name: 'Total',
                    data: [
                        @foreach ($pendapatanBulan as $item)
                            '{{ $item }}',
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 250,
                        toolbar: {
                            show: false,
                        }
                },
                plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded'
                },
                },
                dataLabels: {
                enabled: false,
                },
                grid: {
                    show: false,
                    padding: {
                    top: 0,
                    bottom: 0,
                    right: 30,
                    left: 20
                    }
                },
                stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
                },
                colors: ['rgba(255, 255, 255, 0.25)', '#f7f7f7'],
                xaxis: {
                categories: [
                    @foreach ($bulan as $item)
                        '{{ $item }}',
                    @endforeach
                ],
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                labels: {
                        show: false,
                    }
                },
                legend: {
                    show: false,
                },
                fill: {
                opacity: 1
                },
                tooltip: {
                y: {
                    formatter: function (val) {
                    return "Rp. " + val
                    }
                },
                    marker: {
                    show: false,
                },
                }
            };

            var chart = new ApexCharts(document.querySelector("#revenue1"), options);
            chart.render();
        @endcan
    </script>
    @endpush

</x-layouts>
