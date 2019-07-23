@php
    use App\Http\Controllers\dashboard AS dashboard;
    use App\Http\Controllers\web_setting AS web_setting;
    $DateTimeShow = dashboard::DateThai();
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
            .bg-navbarcolor {
                background-color: #3490dc66 !important;
            }
            #table_all tbody {
                background-color: #ffffff !important;
            }
        </style>
    </head>
    <body class="bodybackground">
        @include('layout/Head')
        <!-- Body -->
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-success" style="margin-right: 20px;margin-left: 20px;">
                    <div class="card-body" style="background-color: #b6bcc14d !important;">
                        <div class="text-right mb-2">
                            <button class="btn btn-sm btn-success" onclick="Open_model_add();"><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-sm dt-responsive nowrap row-border table-bordered table-hover" cellspacing="0" cellpadding="0" id="table_all" width="100%">
                            <thead>
                                <tr align="center" class="bg-primary">
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Detail</th>
                                    <th>Locate</th>
                                    <th>Date</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #b6bcc14d !important;">
                        <div class="row">
                            <div class="col-md-12">
                                <marquee><h5><b>{{ $DateTimeShow }}</b></h5></marquee>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div>
        </div>
        <!-- Model -->
        <div class="modal fade" id="model_crate_add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 600px;" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title"><i class="fas fa-plus"></i> เพิ่มข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="model_crate_add_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-sm mb-2">
                                    <div class="input-group-sm">
                                    <label for="locate_found"><span style="color:red;">*</span> สถานที่พบ : </label>
                                        <input type="text" class="form-control form-control-sm" id="place_found" placeholder="สถานที่พบ">
                                    </div>  
                                </div>
                                <div class="input-group-sm mb-2">
                                <b><span style="color:red;">*</span> ประเภทรายการ :</b>
                                <select class="custom-select custom-select-sm" id="item_type">
                                    <option value="off">เลือก ประเภทรายการ</option>
                                @foreach ($type as $type_row)
                                    <option value="{{ $type_row->type_name }}">{{ $type_row->type_name }}</option>    
                                @endforeach
                                </select>
                                </div>
                                <div class="input-group-sm mb-2">
                                <label for="item_detail"><span style="color:red;">*</span> รายละเอียดของรายการ : </label>
                                    <input type="text" class="form-control form-control-sm" id="item_detail" placeholder="รายละเอียดของรายการ">
                                </div>
                            </div>        
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="input-group-sm">
                                <label for="guest_name">ชื่อลูกค้า : </label>
                                    <input type="text" class="form-control form-control-sm" id="guest_name" placeholder="ชื่อลูกค้า" onkeyup="date_guest_select_check(this)">
                                </div>                             
                            </div>
                            <div class="col-md-6">
                                <label for="date_found"><span style="color:red;">*</span> วันที่พบ : </label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm daterange_single" id="date_found" placeholder="วันที่พบ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>                                
                                </div>                               
                            </div>
                        </div>
                        <div class="row mb-2" id="date_guest_select">
                            <div class="col-md-6">
                                <label for="check_in_date">วันที่เช็คอิน : </label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm daterange_single" id="check_in_date" placeholder="วันที่เช็คอิน">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>                               
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <label for="check_out_date">วันที่เช็คเอ้าท์ : </label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm daterange_single" id="check_out_date" placeholder="วันที่เช็คเอ้าท์">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="check_in_date"><span style="color:red;">*</span> ผู้พบ : </label>
                                <div class="input-group-sm">
                                    <input type="text" class="form-control" id="found_by" placeholder="ผุ้พบ">
                                </div>                               
                            </div>
                            <div class="col-md-4">
                                <label for="check_in_date"><span style="color:red;">*</span> แผนก : </label>
                                <div class="input-group-sm">
                                    <input type="text" class="form-control" id="locate_track" placeholder="แผนก">
                                </div>                             
                            </div>
                            <div class="col-md-4">
                                <label for="check_in_date"><span style="color:red;">*</span> บันทึกโดย : </label>
                                <div class="input-group-sm">
                                    <input type="text" class="form-control" id="record_by" placeholder="บันทึกโดย" value="{{ Auth::User()->username }}" disabled>
                                </div>                             
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" id="card_img">
                                    <div class="card-body">
                                        <b><span style="color:red;">*</span> รูปภาพรายการ :</b>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="images">
                                                    <div class="pic" onclick="Gen_upload_file();">
                                                        อัพโหลดรูป
                                                    </div>
                                                </div>
                                                <div class="file_hide">
                                                    <input type="file" id="file_1" accept="image/*" onchange="GenImg_preview();">
                                                    <input type="file" id="file_2" accept="image/*" onchange="GenImg_preview();">
                                                    <input type="file" id="file_3" accept="image/*" onchange="GenImg_preview();">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-sm btn-block btn-primary btn-loading" onclick="Save_model_add();"><i class="fas fa-save"></i> บันทึก</button>                           
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="model_crate_info" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title"><i class="fas fa-info"></i> ดูข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <b>รูปภาพรายการ :</b>
                                        <div class="bd-example mb-3" style="border: 2px solid #c2c7d0;">
                                            <div id="info_model_view" class="carousel slide carousel-fade" data-ride="carousel">
                                                <ol class="carousel-indicators"></ol>
                                                <div class="carousel-inner"></div>
                                                <div class="carousel-control-prev-view"></div>
                                                <div class="carousel-control-next-view"></div>
                                            </div>
                                        </div> 
                                        <hr>
                                        <b>Item ID :</b>  
                                        <input class="form-control form-control-sm mb-3" type="text" id="view_item_id" placeholder="Item ID" disabled>    
                                        <b>Item Type :</b>    
                                        <select class="custom-select custom-select-sm" id="view_item_type" disabled>
                                            <option value="off">เลือก ประเภทรายการ</option>
                                        @foreach ($type as $type_row)
                                            <option value="{{ $type_row->type_name }}">{{ $type_row->type_name }}</option>    
                                        @endforeach
                                        </select>  
                                    </div>
                                </div>              
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>Locate Found :</b>  
                                        <input class="form-control form-control-sm" type="text" id="view_locate_found" placeholder="Locate Found" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>Item Detail :</b>  
                                        <input class="form-control form-control-sm" type="text" id="view_item_detail" placeholder="Item Detail" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <b>Guest Name</b>
                                        <input class="form-control form-control-sm" type="text" id="view_guest_name" placeholder="Guest Name" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Date Found</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="view_date_found" placeholder="Date Found" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 model_view_chk_date">
                                    <div class="col-md-6">
                                        <b>Chk In Date</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="view_chk_in_date" placeholder="Chk In Date" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Chk Out Date</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="view_chk_out_date" placeholder="Chk Out Date" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <b>Found By</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="Found By" id="view_found_by" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Locate Track</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="Locate Track" id="view_locate_track" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Record By</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="Record By" id="view_record_by" disabled>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="model_crate_edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-edit"></i> แก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <b>รูปภาพรายการ :</b>
                                        <div class="edit_img_div"></div>
                                        <div class="file_hide_edit">
                                            <input type="file" id="file_edit_1" accept="image/*" onchange="file_edit_select(1,100)">
                                            <input type="file" id="file_edit_2" accept="image/*" onchange="file_edit_select(2,100)">
                                            <input type="file" id="file_edit_3" accept="image/*" onchange="file_edit_select(3,100)">
                                        </div>
                                        <hr>
                                        <b>Item ID :</b>  
                                        <input class="form-control form-control-sm mb-3" type="text" id="edit_item_id" placeholder="Item ID" disabled>    
                                        <b>Item Type :</b>    
                                        <select class="custom-select custom-select-sm" id="edit_item_type">
                                            <option value="off">เลือก ประเภทรายการ</option>
                                        @foreach ($type as $type_row)
                                            <option value="{{ $type_row->type_name }}">{{ $type_row->type_name }}</option>    
                                        @endforeach
                                        </select>  
                                    </div>
                                </div>              
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>Locate Found :</b>  
                                        <input class="form-control form-control-sm" type="text" id="edit_locate_found" placeholder="Locate Found">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>Item Detail :</b>  
                                        <input class="form-control form-control-sm" type="text" id="edit_item_detail" placeholder="Item Detail">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <b>Guest Name</b>
                                        <input class="form-control form-control-sm" type="text" id="edit_guest_name" placeholder="Guest Name" onkeyup="date_guest_select_edit_check(this)">
                                    </div>
                                    <div class="col-md-6">
                                        <b>Date Found</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="edit_date_found" placeholder="Date Found">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3" id="date_guest_select_edit">
                                    <div class="col-md-6">
                                        <b>Chk In Date</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="edit_chk_in_date" placeholder="Chk In Date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Chk Out Date</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="edit_chk_out_date" placeholder="Chk Out Date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <b>Found By</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="Found By" id="edit_found_by">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Locate Track</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="Locate Track" id="edit_locate_track">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Record By</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="Record By" id="edit_record_by" disabled>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-block btn-primary" onclick="Save_model_edit(this);"><i class="fas fa-save"></i> บันทึก แก้ไขข้อมูล</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="model_crate_delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title"><i class="fas fa-trash"></i> ยืนยันการลบข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>ยืนยันการลบข้อมูล ถ้าตกลงในการลง ข้อมูล จะไม่สามารถ กู้ข้อมูลที่ลบไปได้แล้ว !</b></p>
                                <p><b>ID ข้อมูล : <span id="model_delete_id_view"><span></b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-sm btn-block btn-primary" id="model_submit_delete"><i class="fas fa-save"></i> ยืนยันการลบข้อมูล</button>  
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
        <!-- All Js -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/dashboard.js') }}"></script>
</html>