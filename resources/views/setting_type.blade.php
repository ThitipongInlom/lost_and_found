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
            #table_type tbody {
                background-color: #ffffff !important;
            }
        </style>
    </head>
    <body class="bodybackground">
        @include('layout/Head')
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="card card-success" style="margin-right: 20px;margin-left: 20px;">
                    <div class="card-body" style="background-color: #b6bcc14d !important;">
                        <div class="clearfix">
                            <div class="float-left mb-2">
                                <h3>จัดการประเภท</h3>
                            </div>
                            <div class="float-right text-right mb-2">
                                <button class="btn btn-sm btn-success" onclick="Open_add_modal();"><i class="fas fa-plus"></i> เพิ่มประเภท</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-sm dt-responsive nowrap row-border table-bordered table-hover" cellspacing="0" cellpadding="0" id="table_type" width="100%">
                            <thead>
                                <tr align="center" class="bg-primary">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Show</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add_type_modal" tabindex="-1" role="dialog" aria-labelledby="add_type_modal_Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="add_type_modal_Label"><i class="fas fa-plus"></i> เพิ่มประเภท</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <b>ชื่อประเภท :</b>
                            <input class="form-control form-control-sm mb-2" type="text" id="add_type_name" placeholder="ชื่อประเภท">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-success" onclick="Save_add_modal();"><i class="fas fa-save"></i> ยืนยัน</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit_type_modal" tabindex="-1" role="dialog" aria-labelledby="edit_type_modal_Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="edit_type_modal_Label"><i class="fas fa-edit"></i> แก้ไขประเภท</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <b>ชื่อประเภท :</b>
                            <input class="form-control form-control-sm mb-2" type="text" id="edit_type_name" placeholder="ชื่อประเภท">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-success" id="save_edit_mdoal" onclick="Save_edit_modal(this);"><i class="fas fa-save"></i> ยืนยัน</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="eye_show_modal" tabindex="-1" role="dialog" aria-labelledby="eye_show_modal_Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="eye_show_modal_Label"><span id="icon_eye_modal_head"></span> <span id="name_eye_modal_head"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center"><b>ยืนยันการเปลี่ยน สถานะการแสดงของประเภท</b></h5>
                            <b>ID :</b> <span id="eye_show_type_id"></span><br>
                            <b>Name :</b> <span id="eye_show_type_name"></span><br>
                            <b>เปลี่ยนสถานะเป็น :</b> <span id="name_eye_modal_body"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-success" id="save_eye_show_mdoal" onclick="Save_eye_show_modal(this);"><i class="fas fa-save"></i> ยืนยัน</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete_type_modal" tabindex="-1" role="dialog" aria-labelledby="delete_type_modal_Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="delete_type_modal_Label"><i class="fas fa-trash"></i> ยืนยันการลบข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <b>ยันยืนการลบข้อมูล เนื่องจากลบข้อมูลแล้วจะไม่สามารถกู้ข้อมูลได้</b>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-success" id="save_delete_type_modal" onclick="Save_delete_type_modal(this);"><i class="fas fa-save"></i> ยืนยัน</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </body>
        <!-- All Js -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/setting_type.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/lang.js') }}"></script>
</html>