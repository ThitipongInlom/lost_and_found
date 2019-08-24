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
        <style>
            @media print {
                body {
                    margin: 0;
                    color: #000;
                    background-color: #fff;
                }
                .print_a4 {
                    border: 0;
                    border-bottom: 1px dashed black;
                    outline: 0;
                    width:100%;
                    background-color: #f8fafc;
                }
            }
                .print_a4 {
                    border: 0;
                    border-bottom: 1px dashed black;
                    outline: 0;
                    width:100%;
                    background-color: #f8fafc;
                }
        </style>
    </head>
    <!-- onload="window.print()" -->
    <body onload="window.print()">
        @foreach ($item as $row)
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <img class="mb-3" src="{{ url('img/web_setting/icon.gif') }}" width="100" height="40">
                    <p class="mt-3"><b>@lang('dashboard.allow_to')</b> ....................................................................................................... <b>@lang('dashboard.number')</b> ............................ <b>@lang('dashboard.position')</b> ..............................................................</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered">
                        <tr class="text-center">
                            <td colspan="3"><b>@lang('dashboard.item_data')</b></td>
                        </tr>
                        <tr class="text-left">
                            <td><b>Item ID : </b> {{ $row->list_id }}</td>
                            <td><b>@lang('dashboard.item_type') : </b> {{ $row->item_type }}</td>
                            <td><b>@lang('dashboard.locate_found') : </b> {{ $row->place_found }}</td>
                        </tr>
                        <tr class="text-left">
                            <td colspan="3"><b>@lang('dashboard.item_detail') : </b> {{ $row->item_detail }}</td>
                        </tr>
                        <tr id="print_tr_guest" class="text-left">
                            @if ($row->guest_name != '-')
                                <td><b>@lang('dashboard.guest_name') : </b> {{ $row->guest_name }}</td>
                                <td><b>@lang('dashboard.check_in_date') : </b> {{ date('d/m/Y', strtotime($row->check_in_date)) }}</td>
                                <td><b>@lang('dashboard.check_out_date') : </b> {{ date('d/m/Y', strtotime($row->check_out_date)) }}</td>                               
                            @endif
                        </tr>
                        <tr class="text-left">
                            <td><b>@lang('dashboard.date_found') : </b> {{ date('d/m/Y', strtotime($row->date_found)) }}</td>
                            <td><b>@lang('dashboard.found_by') : </b> {{ $row->found_by }}</td>
                            <td><b>@lang('dashboard.locate_track') : </b> {{ $row->locate_track }}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="3"><b>@lang('dashboard.picture_list')</b></td>
                        </tr>
                        <tr>
                            <td align="center" id="print_td_img_1">
                                @if ($row->img_1 != null)
                                    <img src="../img/main/{{ $row->img_1 }}" id="print_img_1" class="d-block rounded" width="250" height="300">
                                @endif  
                            </td>
                            <td align="center" id="print_td_img_2">
                                @if ($row->img_2 != null)
                                    <img src="../img/main/{{ $row->img_2 }}" id="print_img_2" class="d-block rounded" width="250" height="300">
                                @endif                              
                            </td>
                            <td align="center" id="print_td_img_3">
                                @if ($row->img_3 != null)
                                    <img src="../img/main/{{ $row->img_3 }}" id="print_img_3" class="d-block rounded" width="250" height="300">
                                @endif                               
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>ชื่อผู้นำสินค้าออก :</b> {{ $row->name_item_out }}
                            </td>
                            <td>
                                <b>แผนก :</b> {{ $row->dep_item_out }}
                            </td>
                            <td>
                                <b>วันที่นำสินค้าออก :</b> {{ date('d/m/Y', strtotime($row->date_item_out))  }}
                            </td>
                        </tr>
                    </table>
                    <!-- มารับเอง -->
                    @if ($type_sned == '1')
                        <p class="mt-2"><b>ชื่อผู้ที่มารับของที่ลืม :</b> <input type="text" class="print_a4"></p>
                        <p class="mt-2"><b>ที่อยู่ :</b> <input type="text" class="print_a4"><input type="text" class="print_a4"></p>
                        <p class="mt-2"><b>วันที่มารับ :</b> <input type="text" class="print_a4"></p>
                        <p class="mt-2"><b>เบอร์โทรติดต่อกลับ :</b> <input type="text" class="print_a4"></p>
                    @endif
                    <!-- ส่งไปรษณีย์ -->
                    @if ($type_sned == '2')
                        <p class="mt-2"><b>ผู้นำส่งไปรษณีย์ :</b><input type="text" class="print_a4"><input type="text" class="print_a4"></p>
                        <p class="mt-2"><b>แผนก :</b> <input type="text" class="print_a4"></p>
                        <p class="mt-2"><b>ชื่อและที่อยู่ :</b> <input type="text" class="print_a4"><input type="text" class="print_a4"><input type="text" class="print_a4"></p>
                        <p class="mt-2"><b>หมายเลขพัสดุที่ส่ง :</b> <input type="text" class="print_a4"></p>
                    @endif
                    <!-- อื่นๆ -->
                    @if ($type_sned == '3')
                        <p class="mt-2"><b>อื่นๆ :</b> <input type="text" class="print_a4">
                                                     <input type="text" class="print_a4">
                                                     <input type="text" class="print_a4">
                                                     <input type="text" class="print_a4">
                                                     <input type="text" class="print_a4"></p>
                    @endif
                </div>
            </div>           
        @endforeach
    </body>
        <!-- All Js -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
</html>