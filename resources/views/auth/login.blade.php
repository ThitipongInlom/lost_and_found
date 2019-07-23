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
                        <div class="text-center">
                            <h2 class="text-dark">Lost And Found</h2>
                            <small>ลงชื่อเข้าใช้งาน เพื่อได้รับสิทธิ์ต่างๆ</small>
                        </div>
                    <hr calss="mb-3">
                        <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" id="username_login" placeholder="ชื่อผุ้ใช้งาน" autofocus>
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password_login" placeholder="รหัสผ่าน">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary btn-block btn-flat btn-loading" id="submit_login">เข้าสู่ระบบ</button>
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