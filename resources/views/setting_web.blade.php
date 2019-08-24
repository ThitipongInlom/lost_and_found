@php
    use App\Http\Controllers\dashboard AS dashboard;
    use App\Http\Controllers\web_setting AS web_setting;
    $DateTimeShow = dashboard::DateThai();
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
            .bg-navbarcolor {
                background-color: #3490dc66 !important;
            }
            #table_user tbody {
                background-color: #ffffff !important;
            }
        </style>
    </head>
    <body class="bodybackground">
        @include('layout/Head')
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-success" style="margin-right: 20px;margin-left: 20px;">
                    <div class="card-body" style="background-color: #b6bcc14d !important;">
                        <div class="row">
                            <!-- Background -->
                            <div class="col-md-4">
                                <div class="card shadow-lg" style="width: 18rem;">
                                <img src="{{ url('img/web_setting/background.jpg') }}" height="180" class="card-img-top">
                                    <div class="card-body">
                                        <div class="clearfix">
                                            <b class="float-left">รูปภาพพื้นหลัง</b>
                                            <button type="button" class="btn btn-sm float-right btn-secondary" data-toggle="tooltip" data-placement="right" title="อนุญาติ ให้เลือกรูปภาพที่เป็นไฟล์ .JPG"><i class="far fa-file-alt"></i></button>
                                        </div>
                                        <div class="custom-file mt-2">
                                            <input type="file" class="custom-file-input" id="background_web" accept="image/jpeg" onchange="Upload_background_web();">
                                            <label class="custom-file-label" for="background_web">เลือก ภาพพื้นหลังใหม่</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Icon -->
                            <div class="col-md-4">
                                <div class="card shadow-lg" style="width: 18rem;">
                                <img src="{{ url('img/web_setting/icon.gif') }}" height="180" class="card-img-top">
                                    <div class="card-body">
                                        <div class="clearfix">
                                            <b class="float-left">รูปภาพโลโก้</b>
                                            <button type="button" class="btn btn-sm float-right btn-secondary" data-toggle="tooltip" data-placement="right" title="อนุญาติ ให้เลือกรูปภาพที่เป็นไฟล์ .GIF"><i class="far fa-file-alt"></i></button>
                                        </div>
                                        <div class="custom-file mt-2">
                                            <input type="file" class="custom-file-input" id="icon_web" accept="image/gif" onchange="Upload_icon_web();">
                                            <label class="custom-file-label" for="icon_web">เลือก รูปภาพโลโก้</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
        <!-- All Js -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/setting_web.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/lang.js') }}"></script>
</html>