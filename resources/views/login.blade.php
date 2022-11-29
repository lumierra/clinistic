<!doctype html>
<html lang="en">
<head>
  	<title>Login {{ $dataWebsite->nama_website ?? '' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $dataWebsite->nama_website }}">
    <meta name="author" content="{{ $dataWebsite->nama_singkat }}">
    <meta property="og:title" content="{{ $dataWebsite->nama_website }}" />
    <meta property="og:description" content="{{ $dataWebsite->nama_website ?? '' }}" />
    <meta property="og:url" content="{{ route('login') }}" />
    <meta property="og:image" content="{{ asset($dataWebsite->logo ?? '') }}" />
    <link rel="icon" href="{{ asset($dataWebsite->logo ?? '') }}">

	<link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('fapro6/css/all.css') }}">

</head>
<body class="img js-fullheight" style="background-image: url({{ asset('login/images/bg.jpg') }}); min-height:749px;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <img class="img-fluid text-center px-5" style="height1: 195px;" src="{{ asset('images/logo.png') }}">
                        <form action="{{ route('login') }}" method="POST" id="formLogin" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btnSubmit" class="form-control btn btn-primary submit px-3">Sign In <i class="fa-solid fa-fingerprint"></i></button>
                            </div>
                            {{-- <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Forgot Password</a>
                                </div>
                            </div> --}}
                        </form>
                        {{-- <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p> --}}
                        {{-- <div class="social d-flex text-center">
                            <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
                            <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login/js/popper.js') }}"></script>
    <script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>
    <script>
        $('#username').focus();
        $('#username').val('');
        $('input:text').focus(
            function(){
                $(this).val('');
        });
        function myRefresh(){
            $.ajax({
                url: "{{ route('captcha.create') }}",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#gc').val(data.nama);
                    $('#captcha').val('');
                    $('.img-fluid').attr('src', "{{ asset('captcha/') }}/" + data.gambar);
                }
            });
        }

        function cekForm(){
            let username = $('#username').val()
            let password = $('#password-field').val()
            // let captcha = $('#captcha').val()

            if(username == ''){
                $('#username').focus()
                alert('Username tidak boleh kosong')
                return false
            } else if(password == ''){
                $('#password-field').focus()
                alert('Password tidak boleh kosong')
                return false
            }
            // else if(captcha == ''){
            //     $('#captcha').focus()
            //     alert('Captcha tidak boleh kosong')
            //     return false
            // }
            else {
                return true
            }
        }

        $('form#formLogin').submit(function (e) {
            e.preventDefault();
            $('#btnSubmit').prop('disabled', true)
            $('#btnSubmit').html('<i class="fa-solid fa-spinner fa-spin"></i> Loading...')

            // let captcha = $('#captcha').val()
            let input = $('#gc').val()

            if (cekForm() == true){
                // if (captcha == input){
                    $.ajax({
                        data: $('#formLogin').serialize(),
                        url: "{{ route('login') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#btnSubmit').prop('disabled', false)
                            $('#btnSubmit').html('<i class="fa-solid fa-shield-check fa-beat"></i>')
                            window.location.href = "{{ route('admin.dashboard.index') }}";
                        },
                        error: function (data) {
                            $('#btnSubmit').html('SIGN IN <i class="fa-solid fa-fingerprint"></i>')
                            alert('Gagal Login')
                            location.reload();
                            $('#btnSubmit').prop('disabled', false)
                        }
                    });

                // }
                // else {
                //     alert('Captcha Salah')
                //     $('#btnSubmit').prop('disabled', false)
                // }
            } else {
                // cekForm()
                $('#btnSubmit').prop('disabled', false)
                $('#btnSubmit').html('SIGN IN <i class="fa-solid fa-fingerprint"></i>')
            }
        });
    </script>
</body>
</html>

