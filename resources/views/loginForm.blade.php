<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($dataWebsite->logo ?? '') }}">
    <link rel="icon" type="image/png" href="{{ asset($dataWebsite->logo ?? '') }}">
    <meta property="og:title" content="{{ $dataWebsite->nama_website }}" />
    <meta property="og:description" content="{{ $dataWebsite->nama_website ?? '' }}" />
    <meta property="og:url" content="{{ route('login') }}" />
    <meta property="og:image" content="{{ asset($dataWebsite->logo ?? '') }}" />
    <title>
        Login - {{ $dataWebsite->nama_singkat ?? '' }}
    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> --}}
    {{-- <link rel="stylesheet" href="	https://use.fontawesome.com/releases/v5.7.2/css/all.css"> --}}
    <link rel="stylesheet" href="{{ asset('fapro/css/all.min.css') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif
            }

            body {
                background: #ecf0f3
            }

            .wrapper {
                max-width: 350px;
                min-height: 500px;
                margin: 80px auto;
                padding: 40px 30px 30px 30px;
                background-color: #ecf0f3;
                border-radius: 15px;
                box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff
            }

            .logo {
                width: 80px;
                margin: auto
            }

            .logo img {
                width: 100%;
                height: 80px;
                object-fit: cover;
                border-radius: 50%;
                box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff
            }

            .wrapper .name {
                font-weight: 600;
                font-size: 1.4rem;
                letter-spacing: 1.3px;
                padding-left: 10px;
                color: #555
            }

            .wrapper .form-field input {
                width: 100%;
                display: block;
                border: none;
                outline: none;
                background: none;
                font-size: 1.2rem;
                color: #666;
                padding: 10px 15px 10px 10px
            }

            .wrapper .form-field {
                padding-left: 10px;
                margin-bottom: 20px;
                border-radius: 20px;
                box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
            }

            .wrapper .form-field .fas {
                color: #555
            }

            .wrapper .btn {
                box-shadow: none;
                width: 100%;
                height: 40px;
                background-color: #03A9F4;
                color: #fff;
                border-radius: 25px;
                box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
                letter-spacing: 1.3px
            }

            .wrapper .btn:hover {
                background-color: #039BE5
            }

            .wrapper a {
                text-decoration: none;
                font-size: 0.8rem;
                color: #03A9F4
            }

            .wrapper a:hover {
                color: #039BE5
            }

            @media(max-width: 380px) {
                .wrapper {
                    margin: 30px 20px;
                    padding: 40px 15px 15px 15px
                }
            }
    </style>
</head>

<body class="bg-gray-200">
    <div class="wrapper">
        <div class="logo1">
            @if ($data->logo == '')
                {{-- <i class="fad fa-landmark-alt text-primary" style="font-size:90px"></i> --}}
                <img src="https://www.freepnglogos.com/uploads/logo-garuda-png/garuda-desa-pemongkong-visi-misi-dan-program-kerja-kepala-desa-26.png">
            @else
                <img src="{{ asset($data->logo) }}" alt="" style="width:100%" class="ps-3">
            @endif
        </div>
        <div class="text-center mt-2 name"> {{ $data->nama_singkat == '' ? 'POS' : $data->nama_singkat }} </div>
        <form class="p-3" action="{{ route('login') }}" method="POST" id="formInput">
        {{-- <form class="p-3" id="formInput"> --}}
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="fad fa-user-unlock"></span>
                <input class="@error('username') is-invalid @enderror" type="text" name="username" id="username" placeholder="Username" autocomplete="off">
            </div>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>Username & Password Salah {{ $message }}</strong>
                </span>
            @enderror
            <div class="form-field d-flex align-items-center">
                <span class="fad fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
            </div>
            {{-- <div class="form-field1 d-flex align-items-center mb-2">
                <img onclick="myRefresh()" class="img-fluid" src="{{ asset('captcha/' . $captcha->gambar) }}" alt="captcha" style="width: 100%">
                <input type="hidden" id="gc" name="gc" value="{{ $captcha->nama }}" class="d-none">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fad fa-barcode-read"></span>
                <input onkeyup="this.value=this.value.toUpperCase()" style="text-transform: uppercase" type="text" name="captcha" id="captcha" placeholder="Captcha" autocomplete="off">
            </div> --}}
            <button class="btn" type="submit" id="btnSubmit">Login</button>
        </form>
        {{-- <div class="text-center fs-6"> <a href="#">Forget password?</a> or <a href="#">Sign up</a> </div> --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

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
            let password = $('#password').val()
            // let captcha = $('#captcha').val()

            if(username == ''){
                $('#username').focus()
                alert('Username tidak boleh kosong')
                return false
            } else if(password == ''){
                $('#password').focus()
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

        $('form#formInput').submit(function (e) {
            e.preventDefault();
            $('#btnSubmit').prop('disabled', true)

            // let captcha = $('#captcha').val()
            let input = $('#gc').val()

            if (cekForm() == true){
                // if (captcha == input){
                    $.ajax({
                        data: $('#formInput').serialize(),
                        url: "{{ route('login') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            window.location.href = "{{ route('admin.dashboard.index') }}";
                        },
                        error: function (data) {
                            alert('Gagal Login')
                            location.reload();
                        }
                    });
                    $('#btnSubmit').prop('disabled', false)
                // }
                // else {
                //     alert('Captcha Salah')
                //     $('#btnSubmit').prop('disabled', false)
                // }
            } else {
                // cekForm()
                $('#btnSubmit').prop('disabled', false)
            }
        });
    </script>
</body>

</html>
