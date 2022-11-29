@section('title', 'Template Warna')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <x-breadcrumb
                title="Template Warna"
                title2="Menu Utama"
                title3="Template Warna"
                >

            </x-breadcrumb>

            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Template</strong> warna</h4>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-2 col-4">
                                        <a href="javascript:void(0)" onclick="myColor('primary')">
                                            <div class="bg-primary rounded p-20 mb-30 text-center fw-bold text-white"></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-4">
                                        <a href="javascript:void(0)" onclick="myColor('success')">
                                            <div class="bg-success rounded p-20 mb-30 text-center fw-bold text-white"></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-4">
                                        <a href="javascript:void(0)" onclick="myColor('info')">
                                            <div class="bg-info rounded p-20 mb-30 text-center fw-bold"></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-4">
                                        <a href="javascript:void(0)" onclick="myColor('warning')">
                                            <div class="bg-warning rounded p-20 mb-30 text-center fw-bold"></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-4">
                                        <a href="javascript:void(0)" onclick="myColor('danger')">
                                            <div class="bg-danger rounded p-20 mb-30 text-center fw-bold"></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-4">
                                        <a href="javascript:void(0)" onclick="myColor('dark')">
                                            <div class="bg-dark rounded p-20 mb-30 text-center fw-bold"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @push('script')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function myColor(color){
                $.ajax({
                    url: "{{ route('admin.template.index') }}" + '/' + color + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        alertSucces()
                        window.location.reload()
                    },
                    error: function (data) {
                        alertDanger()
                    }
                });
            }
        </script>
    @endpush
</x-layouts>
