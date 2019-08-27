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
                        <div class="clearfix">
                            <div class="float-left mb-2">
                                <h3>จัดการผู้ใช้งาน</h3>
                            </div>
                            <div class="float-right text-right mb-2">
                                <button class="btn btn-sm btn-success" onclick="Open_add_modal();"><i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-sm dt-responsive nowrap row-border table-bordered table-hover" cellspacing="0" cellpadding="0" id="table_user" width="100%">
                            <thead>
                                <tr align="center" class="bg-primary">
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Place</th>
                                    <th>Status</th>
                                    <th>IP Login</th>
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
                    <h5 class="modal-title" id="add_type_modal_Label"><i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2 mt-2">
                                <label for="username_register">ชื่อผุ้ใช้งาน : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="username_register" placeholder="ชื่อผุ้ใช้งาน" autofocus>
                                <div class="input-group-append input-group-text span_input_form">
                                    <span class="fas fa-user"></span>
                                </div>
                                </div>
                            </div>
                            <div class="mb-2 mt-2">
                                <label for="fname">ชื่อ : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="fname" placeholder="ชื่อ">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                </div>
                            </div>
                            <div class="mb-2 mt-2">
                                <label for="phone">เบอร์โทร : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="phone" placeholder="เบอร์โทร">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-phone"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2 mt-2">
                                <label for="password_register">รหัสผ่าน : </label>
                                <div class="input-group">
                                <input type="password" class="form-control form-control-sm" id="password_register" placeholder="รหัสผ่าน">
                                <div class="input-group-append input-group-text span_input_form">
                                    <span class="fas fa-lock"></span>
                                </div>
                                </div>
                            </div>   
                            <div class="mb-2 mt-2">
                                <label for="password_register">นามสกุล : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="lname" placeholder="นามสกุล">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                </div>
                            </div>    
                            <div class="mb-2 mt-2">
                                <label for="password_register">อีเมล์ : </label>
                                <div class="input-group">
                                <input type="email" class="form-control form-control-sm" id="email" placeholder="อีเมล์">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-success btn-loading" id="submit_register"><i class="fas fa-save"></i> ยืนยัน</button>
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
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="edit_type_modal_Label"><i class="fas fa-edit"></i> แก้ไขผู้ใช้งาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-1 mt-2">
                                <label for="fname_edit">ชื่อผุ้ใช้งาน : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="username_edit" placeholder="ชื่อผุ้ใช้งาน" disabled>
                                <div class="input-group-append input-group-text span_input_form">
                                    <span class="fas fa-user"></span>
                                </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2 mt-2">
                                <label for="fname_edit">ชื่อ : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="fname_edit" placeholder="ชื่อ">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                </div>
                            </div>  
                            <div class="mb-2 mt-2">
                                <label for="fname_edit">เบอร์โทร : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="phone_edit" placeholder="เบอร์โทร">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-phone"></i>
                                </div>
                                </div>
                            </div>  
                            <div class="mb-2 mt-2">
                                <label for="fname_edit">สถานที่เก็บ : </label>
                                <div class="input-group">
                                <select class="form-control form-control-sm" id="place_edit">
                                    <option value="">ไม่มีสถานที่เก็บ</option>
                                    @foreach ($place as $row)
                                        <option value="{{ $row->type_name }}" >{{ $row->type_name }}</option>  
                                    @endforeach
                                </select>
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-box"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2 mt-2">
                                <label for="fname_edit">นามสกุล : </label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="lname_edit" placeholder="นามสกุล">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                </div>
                            </div>     
                            <div class="mb-2 mt-2">
                                <label for="fname_edit">อีเมล์ : </label>
                                <div class="input-group">
                                <input type="email" class="form-control form-control-sm" id="email_edit" placeholder="อีเมล์">
                                <div class="input-group-append input-group-text span_input_form">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                </div>
                            </div>                 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <label for="fname_edit">สถานที่จะดู : </label>
                            <select class="form-control TEST" multiple="multiple" id="place_view_edit" placeholder="เลือก สถานที่จะดู">
                                @foreach ($place as $row)
                                    <option value="{{ $row->type_name }}" >{{ $row->type_name }}</option>  
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-sm btn-success" id="save_edit_modal" onclick="Save_edit_modal(this);"><i class="fas fa-save"></i> ยืนยัน</button>
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
        <script type="text/javascript" src="{{ url('js/setting_user.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/lang.js') }}"></script>
</html>