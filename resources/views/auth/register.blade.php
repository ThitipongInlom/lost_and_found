@php
    use App\Http\Controllers\web_setting AS web_setting;
    $ver = web_setting::system_ver();
@endphp
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- Title here -->
        <title>Lost_And_Found V {{ $ver }}</title>
        <meta name="description" content="Lost_And_Found - ระบบแจ้งของหายของโรงแรม">
        <meta name="author" content="Thitipong Inlom">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- All Css -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
        <!-- Style -->
        <style>
            .bodybackground {
                background-image: url('{{ url('img/web_setting/background.jpg') }}');
                background-repeat: round;
            }
        </style>
    </head>
    <body class="bodybackground">
        <div class="container">
            <div class="login-box">
                <div class="card">
                    <div class="card-body login-card-body">
                        <h2 class="text-center text-dark">สมัครสมาชิก</h2>
                        <hr calss="mb-3">
                        <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" id="username_register" placeholder="ชื่อผุ้ใช้งาน" autofocus>
                        <div class="input-group-append input-group-text span_input_form">
                            <span class="fas fa-user"></span>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password_register" placeholder="รหัสผ่าน">
                        <div class="input-group-append input-group-text span_input_form">
                            <span class="fas fa-lock"></span>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="fname" placeholder="ชื่อ">
                        <div class="input-group-append input-group-text span_input_form">
                            <i class="fas fa-id-card"></i>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="lname" placeholder="นามสกุล">
                            <div class="input-group-append input-group-text span_input_form">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="phone" placeholder="เบอร์โทร">
                            <div class="input-group-append input-group-text span_input_form">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" id="email" placeholder="อีเมล์">
                            <div class="input-group-append input-group-text span_input_form">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col-12 text-center">
                            <button type="button" id="submit_register" class="btn btn-primary btn-block btn-flat btn-loading">ยืนยัน สมัครสมาชิก</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
        <!-- All Js -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/systemlogin.js') }}"></script>
</html>