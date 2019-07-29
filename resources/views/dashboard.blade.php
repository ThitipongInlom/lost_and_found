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
                            <select class="custom-select custom-select-sm col-2" id="type_select_table" onchange="load_table_on_select();">
                                <option value="return_all" selected>@lang('dashboard.list_all_data')</option>
                                <option value="return_yes">@lang('dashboard.list_received')</option>
                                <option value="return_no">@lang('dashboard.list_not_received')</option>
                            </select>
                            <button class="btn btn-sm btn-success" onclick="Open_model_add();"><i class="fas fa-plus"></i> @lang('dashboard.add_data')</button>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-sm dt-responsive nowrap row-border table-bordered table-hover" cellspacing="0" cellpadding="0" id="table_all" width="100%">
                            <thead>
                                <tr align="center" class="bg-primary">
                                    <th>#</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th>@lang('dashboard.detail')</th>
                                    <th>@lang('dashboard.location')</th>
                                    <th>@lang('dashboard.date')</th>
                                    <th>@lang('dashboard.return')</th>
                                    <th>@lang('dashboard.menu')</th>
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
                        <h5 class="modal-title"><i class="fas fa-plus"></i> @lang('dashboard.add_data')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="model_crate_add_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-sm mb-2">
                                    <div class="input-group-sm">
                                    <label for="locate_found"><span style="color:red;">*</span> @lang('dashboard.locate_found') : </label>
                                        <input type="text" class="form-control form-control-sm" id="place_found" placeholder="@lang('dashboard.locate_found')">
                                    </div>  
                                </div>
                                <div class="input-group-sm mb-2">
                                <b><span style="color:red;">*</span> @lang('dashboard.item_type') :</b>
                                <select class="custom-select custom-select-sm" id="item_type">
                                    <option value="off">@lang('dashboard.select_item_type')</option>
                                @foreach ($type as $type_row)
                                    <option value="{{ $type_row->type_name }}">{{ $type_row->type_name }}</option>    
                                @endforeach
                                </select>
                                </div>
                                <div class="input-group-sm mb-2">
                                <label for="item_detail"><span style="color:red;">*</span> @lang('dashboard.item_detail') : </label>
                                    <input type="text" class="form-control form-control-sm" id="item_detail" placeholder="@lang('dashboard.item_detail')">
                                </div>
                            </div>        
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="input-group-sm">
                                <label for="guest_name">@lang('dashboard.guest_name') : </label>
                                    <input type="text" class="form-control form-control-sm" id="guest_name" placeholder="@lang('dashboard.guest_name')" onkeyup="date_guest_select_check(this)">
                                </div>                             
                            </div>
                            <div class="col-md-6">
                                <label for="date_found"><span style="color:red;">*</span> @lang('dashboard.date_found') : </label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm daterange_single" id="date_found" placeholder="@lang('dashboard.date_found')">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>                                
                                </div>                               
                            </div>
                        </div>
                        <div class="row mb-2" id="date_guest_select">
                            <div class="col-md-6">
                                <label for="check_in_date">@lang('dashboard.check_in_date') : </label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm daterange_single" id="check_in_date" placeholder="@lang('dashboard.check_in_date')">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>                               
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <label for="check_out_date">@lang('dashboard.check_out_date') : </label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm daterange_single" id="check_out_date" placeholder="@lang('dashboard.check_out_date')">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="check_in_date"><span style="color:red;">*</span> @lang('dashboard.found_by') : </label>
                                <div class="input-group-sm">
                                    <input type="text" class="form-control" id="found_by" placeholder="@lang('dashboard.found_by')">
                                </div>                               
                            </div>
                            <div class="col-md-4">
                                <label for="check_in_date"><span style="color:red;">*</span> @lang('dashboard.locate_track') : </label>
                                <div class="input-group-sm">
                                    <input type="text" class="form-control" id="locate_track" placeholder="@lang('dashboard.locate_track')">
                                </div>                             
                            </div>
                            <div class="col-md-4">
                                <label for="check_in_date"><span style="color:red;">*</span> @lang('dashboard.record_by') : </label>
                                <div class="input-group-sm">
                                    <input type="text" class="form-control" id="record_by" placeholder="@lang('dashboard.record_by')" value="{{ Auth::User()->username }}" disabled>
                                </div>                             
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" id="card_img">
                                    <div class="card-body">
                                        <b><span style="color:red;">*</span> @lang('dashboard.picture_list') :</b>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="images">
                                                    <div class="pic" onclick="Gen_upload_file();">
                                                        @lang('dashboard.upload_photo')
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
                    <div class="modal-header" id="head_model_info">
                        <h5 class="modal-title" id="head_model_tital"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <b>@lang('dashboard.picture_list') :</b>
                                        <div class="bd-example mb-3" style="border: 2px solid #c2c7d0;border-radius: 5px;">
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
                                        <b>@lang('dashboard.item_type') :</b>    
                                        <select class="custom-select custom-select-sm" id="view_item_type" disabled>
                                            <option value="off">@lang('dashboard.select_item_type')</option>
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
                                        <b>@lang('dashboard.locate_found') :</b>  
                                        <input class="form-control form-control-sm" type="text" id="view_locate_found" placeholder="@lang('dashboard.locate_found')" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>@lang('dashboard.item_detail') :</b>  
                                        <input class="form-control form-control-sm" type="text" id="view_item_detail" placeholder="@lang('dashboard.item_detail')" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.guest_name') :</b>
                                        <input class="form-control form-control-sm" type="text" id="view_guest_name" placeholder="@lang('dashboard.guest_name')" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.date_found') :</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="view_date_found" placeholder="@lang('dashboard.date_found')" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 model_view_chk_date">
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.check_in_date') :</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="view_chk_in_date" placeholder="@lang('dashboard.check_in_date')" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.check_out_date') :</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="view_chk_out_date" placeholder="@lang('dashboard.check_out_date')" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <b>@lang('dashboard.found_by') :</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="@lang('dashboard.found_by')" id="view_found_by" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <b>@lang('dashboard.locate_track') :</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="@lang('dashboard.locate_track')" id="view_locate_track" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <b>@lang('dashboard.record_by') :</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="@lang('dashboard.record_by')" id="view_record_by" disabled>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="footer_button_info"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="model_crate_edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-edit"></i> @lang('dashboard.edit_data')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <b>@lang('dashboard.picture_list') :</b>
                                        <div class="edit_img_div"></div>
                                        <div class="file_hide_edit">
                                            <input type="file" id="file_edit_1" accept="image/*" onchange="file_edit_select(1,100)">
                                            <input type="file" id="file_edit_2" accept="image/*" onchange="file_edit_select(2,100)">
                                            <input type="file" id="file_edit_3" accept="image/*" onchange="file_edit_select(3,100)">
                                        </div>
                                        <hr>
                                        <b>Item ID :</b>  
                                        <input class="form-control form-control-sm mb-3" type="text" id="edit_item_id" placeholder="Item ID" disabled>    
                                        <b>@lang('dashboard.item_type') :</b>    
                                        <select class="custom-select custom-select-sm" id="edit_item_type">
                                            <option value="off">@lang('dashboard.select_item_type')</option>
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
                                        <b>@lang('dashboard.locate_found') :</b>  
                                        <input class="form-control form-control-sm" type="text" id="edit_locate_found" placeholder="@lang('dashboard.locate_found')">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>@lang('dashboard.item_detail') :</b>  
                                        <input class="form-control form-control-sm" type="text" id="edit_item_detail" placeholder="@lang('dashboard.item_detail')">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.guest_name')</b>
                                        <input class="form-control form-control-sm" type="text" id="edit_guest_name" placeholder="@lang('dashboard.guest_name')" onkeyup="date_guest_select_edit_check(this)">
                                    </div>
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.date_found')</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="edit_date_found" placeholder="@lang('dashboard.date_found')">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3" id="date_guest_select_edit">
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.check_in_date')</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="edit_chk_in_date" placeholder="@lang('dashboard.check_in_date')">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>@lang('dashboard.check_out_date')</b>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm daterange_single" id="edit_chk_out_date" placeholder="@lang('dashboard.check_out_date')">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <b>@lang('dashboard.found_by')</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="@lang('dashboard.found_by')" id="edit_found_by">
                                    </div>
                                    <div class="col-md-4">
                                        <b>@lang('dashboard.locate_track')</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="@lang('dashboard.locate_track')" id="edit_locate_track">
                                    </div>
                                    <div class="col-md-4">
                                        <b>@lang('dashboard.record_by')</b>
                                        <input class="form-control form-control-sm" type="text" placeholder="@lang('dashboard.record_by')" id="edit_record_by" disabled>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-block btn-primary" onclick="Save_model_edit(this);"><i class="fas fa-save"></i> @lang('dashboard.save_edit_data')</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> @lang('dashboard.close')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="model_crate_print" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title"><i class="fas fa-print"></i> @lang('dashboard.print_data')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img class="mb-3" src="{{ url('img/web_setting/thezign.gif') }}" width="100" height="40">
                                <p class="mt-2"><b>@lang('dashboard.allow_to')</b> ......................................................... <b>@lang('dashboard.number')</b> ............................ <b>@lang('dashboard.position')</b> ...............................................</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tr class="text-center">
                                        <td colspan="3" class="bg-dark">@lang('dashboard.item_data')</td>
                                    </tr>
                                    <tr class="text-left">
                                        <td><b>Item ID : </b> <sapn id="print_itemid"></sapn></td>
                                        <td><b>@lang('dashboard.item_type') : </b> <span id="print_item_type"></span></td>
                                        <td><b>@lang('dashboard.locate_found') : </b> <span id="print_place_found"></span></td>
                                    </tr>
                                    <tr class="text-left">
                                        <td colspan="3"><b>@lang('dashboard.item_detail') : </b> <span id="print_item_detail"></span></td>
                                    </tr>
                                    <tr id="print_tr_guest" class="text-left">
                                        <td><b>@lang('dashboard.guest_name') : </b> <sapn id="print_guest_name"></sapn></td>
                                        <td><b>@lang('dashboard.check_in_date') : </b> <sapn id="print_check_in_date"></sapn></td>
                                        <td><b>@lang('dashboard.check_out_date') : </b> <sapn id="print_check_out_date"></sapn></td>
                                    </tr>
                                    <tr class="text-left">
                                        <td><b>@lang('dashboard.date_found') : </b> <sapn id="print_date_found"></sapn></td>
                                        <td><b>@lang('dashboard.found_by') : </b> <sapn id="print_found_by"></sapn></td>
                                        <td><b>@lang('dashboard.locate_track') : </b> <sapn id="print_locate_track"></sapn></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="3" class="bg-dark">@lang('dashboard.picture_list')</td>
                                    </tr>
                                    <tr>
                                        <td align="center" id="print_td_img_1"></td>
                                        <td align="center" id="print_td_img_2"></td>
                                        <td align="center" id="print_td_img_3"></td>
                                    </tr>
                                </table>
                                <table class="table table-sm table-bordered">
                                    <tr class="text-center">
                                        <td colspan="4" class="bg-dark">@lang('dashboard.sign_the_signature')</td>
                                    </tr>
                                    <tr class="text-left">
                                        <td>@lang('dashboard.staff') ..........................</td>
                                        <td>@lang('dashboard.head_of_department') ..........................</td>
                                        <td>@lang('dashboard.personnel') .........................</td>
                                        <td>@lang('dashboard.security') ........................</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-sm btn-primary" onclick="Open_print(this);" id="submit_print"><i class="fas fa-print"></i> @lang('dashboard.print_data')</button>
                                <button class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> @lang('dashboard.canceled')</button>
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
        <script type="text/javascript" src="{{ url('js/lang.js') }}"></script>
</html>