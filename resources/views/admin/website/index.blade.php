@section('title', 'Profil Website')

<x-layouts>
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="row align-items-center1">
                    <div class="col-md-7 col-12">
                        @include('admin.website.create')
                    </div>
                    @if ($count == 0)
                        <div class="col-md-5 col-12 mt-30 mt-md-0">
                            <div class="box box-body p-40 bg-dark mb-0">
                                <h2 class="box-title text-white">Dat</h2>
                                <p>Silahkan Update Informasi Website Anda</p>
                                <div class="widget fs-18 my-20 py-20 by-1 border-light">
                                    <ul class="list list-unstyled text-white-80">
                                    </ul>
                                </div>
                                <h4 class="mb-20"></h4>
                                <ul class="list-unstyled d-flex gap-items-1">
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="col-md-5 col-12 mt-30 mt-md-0" id="right-data">
                            @include('admin.website.right')
                        </div>
                    @endif
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

            function refreshData(id){
                $.ajax({
                    url: "{{ route('admin.website.index') }}" + "/" + id + '/edit',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $('#nama_website').val(data.website.nama_website)
                        $('#email').val(data.website.email)
                        $('#phone').val(data.website.phone)
                        $('#footer').val(data.website.footer)
                        $('#alamat').val(data.website.alamat)
                        $('#facebook').val(data.website.facebook)
                        $('#instagram').val(data.website.instagram)
                        $('#youtube').val(data.website.youtube)
                        $('#nama_singkat').val(data.website.nama_singkat)

                        var gambar = `<img src="${data.link}" style="width: 25%" alt="1" class="round">`;
                        $('#logoWebsite').html(gambar)

                    },
                    error: function (data) {
                        console.log('error refresh');
                    }
                });
                $.ajax({
                    url: "{{ route('admin.website.index') }}" + "/" + id,
                    type: "GET",
                    dataType: 'html',
                    success: function (data) {
                        console.log(data);
                        $('#right-data').html(data)
                    },
                    error: function (data) {
                        console.log('error refresh');
                    }
                });
            }

            $('#btnSave').click(function (e) {
                e.preventDefault();

                var formData = new FormData($('#formInput')[0]);

                $.ajax({
                    data: formData,
                    url: "{{ route('admin.website.store') }}",
                    type: "POST",
                    // dataType: 'json',
                    enctype: 'multipart/form-data',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        alertSucces()
                        refreshData(data)
                    },
                    error: function (data) {
                        alertDanger()
                    }
                });
            });
        </script>
    @endpush
</x-layouts>
