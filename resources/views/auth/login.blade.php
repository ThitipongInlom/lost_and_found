@php
    use App\Http\Controllers\web_setting AS web_setting;
    $ver = web_setting::system_ver();
@endphp
<html lang="{{ app()->getLocale() }}">
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
        <div class="clearfix">
            <div class="float-right">
                <select class="form-control" id="lang_select" url_base="{{ url('/') }}">
                    <option value="th" data-image="{{ url('img/web_setting/th.png') }}" @if (app()->getLocale() == 'th') {{ 'selected' }} @endif>@lang('login.lang_thai')</option>
                    <option value="en" data-image="{{ url('img/web_setting/en.png') }}" @if (app()->getLocale() == 'en') {{ 'selected' }} @endif>@lang('login.lang_english')</option>
                </select>           
            </div>
        </div>
        <div class="container">
            <div class="login-box">
                <div class="card">
                    <div class="card-body login-card-body">
                        <div class="text-center">
                            <h2 class="text-dark">Lost And Found</h2>
                            <small>@lang('login.sub_box_login')</small>
                        </div>
                    <hr calss="mb-3">
                        <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" id="username_login" placeholder="@lang('login.username')" autofocus>
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password_login" placeholder="@lang('login.password')">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary btn-block btn-flat btn-loading" id="submit_login">@lang('login.login')</button>
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
        <script type="text/javascript" src="{{ url('js/lang.js') }}"></script>
</html>