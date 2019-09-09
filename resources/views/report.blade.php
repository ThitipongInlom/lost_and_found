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
            .loading_action{
                display: none;
            }
            @media screen {
                #printSection {
                display: none;
                }
            }
            @media print {
                body * {
                visibility:hidden;
                }
                #printSection, #printSection * {
                visibility:visible;
                }
                #printSection {
                position:absolute;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                }
            }
        </style>
    </head>
    <body class="bodybackground">
        @include('layout/Head')
        <div class="container-fluid">
            <div class="row mt-3">
              <div class="col-5 col-sm-2">
                <div class="card">
                    <div class="card-body p-0 m-0">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">ฝากของลืม</a>
                            <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">ของลืมที่ยังไม่ได้รับคืน</a>
                            <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">ของลืมที่ลูกด้ามารับแล้ว</a>
                            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">รวม</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-7 col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                <div class="text-left">
                                    <h4>ฝากของลืม</h4>
                                    <hr>
                                </div>
                                <div class="form-row align-items-center ml-1">
                                    เลือกวันที่ : 
                                    <div class="col-sm-2 my-1">
                                        <input type="text" class="form-control form-control-sm daterange" id="Tab_1_date">
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="show_tab_1();" data-toggle='tooltip' data-placement='bottom' title='ค้นหาข้อมูล'><i class="fas fa-search"></i> ค้นหา</button>
                                        <button type="button" class="btn btn-sm btn-success" onclick="print_page(document.getElementById('Print_Report1'));" data-toggle='tooltip' data-placement='bottom' title='ปริ้นข้อมูล'><i class="fas fa-print"></i> ปริ้น</button>
                                    </div>
                                </div>
                                <hr>
                                <div id="Print_Report1" style="background-color: #ffffff;">
                                    <div id="Tab1_Display"></div>
                                    <div class="loading_action">
                                        <div class="sk-folding-cube">
                                            <div class="sk-cube1 sk-cube"></div>
                                            <div class="sk-cube2 sk-cube"></div>
                                            <div class="sk-cube4 sk-cube"></div>
                                            <div class="sk-cube3 sk-cube"></div>
                                        </div>
                                        <h5 class="text-center">กำลังโหลดข้อมูล.....</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                <div class="text-left">
                                    <h4>ของลืมที่ยังไม่ได้รับคืน</h4>
                                    <hr>
                                </div>
                                <div class="form-row align-items-center ml-1">
                                    เลือกวันที่ : 
                                    <div class="col-sm-2 my-1">
                                        <input type="text" class="form-control form-control-sm daterange" id="Tab_2_date">
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="show_tab_2();" data-toggle='tooltip' data-placement='bottom' title='ค้นหาข้อมูล'><i class="fas fa-search"></i> ค้นหา</button>
                                        <button type="button" class="btn btn-sm btn-success" onclick="print_page(document.getElementById('Print_Report2'));" data-toggle='tooltip' data-placement='bottom' title='ปริ้นข้อมูล'><i class="fas fa-print"></i> ปริ้น</button>
                                    </div>
                                </div>
                                <hr>
                                <div id="Print_Report2" style="background-color: #ffffff;">
                                    <div id="Tab2_Display"></div>
                                    <div class="loading_action">
                                        <div class="sk-folding-cube">
                                            <div class="sk-cube1 sk-cube"></div>
                                            <div class="sk-cube2 sk-cube"></div>
                                            <div class="sk-cube4 sk-cube"></div>
                                            <div class="sk-cube3 sk-cube"></div>
                                        </div>
                                        <h5 class="text-center">กำลังโหลดข้อมูล.....</h5>
                                    </div>
                                </div>                  
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                <div class="text-left">
                                    <h4>ของลืมที่ลูกด้ามารับแล้ว</h4>
                                    <hr>
                                </div>
                                <div class="form-row align-items-center ml-1">
                                    เลือกวันที่ : 
                                    <div class="col-sm-2 my-1">
                                        <input type="text" class="form-control form-control-sm daterange" id="Tab_3_date">
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="show_tab_3();" data-toggle='tooltip' data-placement='bottom' title='ค้นหาข้อมูล'><i class="fas fa-search"></i> ค้นหา</button>
                                        <button type="button" class="btn btn-sm btn-success" onclick="print_page(document.getElementById('Print_Report3'));" data-toggle='tooltip' data-placement='bottom' title='ปริ้นข้อมูล'><i class="fas fa-print"></i> ปริ้น</button>
                                    </div>
                                </div>
                                <hr>
                                <div id="Print_Report3" style="background-color: #ffffff;">
                                    <div id="Tab3_Display"></div>
                                    <div class="loading_action">
                                        <div class="sk-folding-cube">
                                            <div class="sk-cube1 sk-cube"></div>
                                            <div class="sk-cube2 sk-cube"></div>
                                            <div class="sk-cube4 sk-cube"></div>
                                            <div class="sk-cube3 sk-cube"></div>
                                        </div>
                                        <h5 class="text-center">กำลังโหลดข้อมูล.....</h5>
                                    </div>
                                </div>                            
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                <div class="text-left">
                                    <h4>ของลืมที่ลูกด้ามารับแล้ว</h4>
                                    <hr>
                                </div>
                                <div class="form-row align-items-center ml-1">
                                    เลือกวันที่ : 
                                    <div class="col-sm-2 my-1">
                                        <input type="text" class="form-control form-control-sm daterange" id="Tab_4_date">
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="show_tab_4();" data-toggle='tooltip' data-placement='bottom' title='ค้นหาข้อมูล'><i class="fas fa-search"></i> ค้นหา</button>
                                        <button type="button" class="btn btn-sm btn-success" onclick="print_page(document.getElementById('Print_Report4'));" data-toggle='tooltip' data-placement='bottom' title='ปริ้นข้อมูล'><i class="fas fa-print"></i> ปริ้น</button>
                                    </div>
                                </div>
                                <hr>
                                <div id="Print_Report4" style="background-color: #ffffff;">
                                    <div id="Tab4_Display"></div>
                                    <div class="loading_action">
                                        <div class="sk-folding-cube">
                                            <div class="sk-cube1 sk-cube"></div>
                                            <div class="sk-cube2 sk-cube"></div>
                                            <div class="sk-cube4 sk-cube"></div>
                                            <div class="sk-cube3 sk-cube"></div>
                                        </div>
                                        <h5 class="text-center">กำลังโหลดข้อมูล.....</h5>
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
        <script type="text/javascript" src="{{ url('js/report.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/lang.js') }}"></script>
</html>