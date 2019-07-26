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
    </head>
    <body onload="window.print()">
        @foreach ($item as $row)
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <img class="mb-3" src="{{ url('img/web_setting/thezign.gif') }}" width="100" height="40">
                    <p class="mt-2"><b>อนุญาติให้</b> ........................................ <b>หมายเลข</b> ............................ <b>ตำแหน่ง</b> ....................................</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered">
                        <tr class="text-center">
                            <td colspan="3"><b>ข้อมูลรายการ</b></td>
                        </tr>
                        <tr class="text-center">
                            <td><b>Item ID : </b> {{ $row->list_id }}</td>
                            <td><b>ประเภทรายการ : </b> {{ $row->item_type }}</td>
                            <td><b>สถานที่พบ : </b> {{ $row->place_found }}</td>
                        </tr>
                        <tr class="text-left">
                            <td colspan="3"><b style="margin-left:5px;">รายละเอียดของรายการ : </b> {{ $row->item_detail }}</td>
                        </tr>
                        <tr id="print_tr_guest" class="text-center">
                            @if ($row->guest_name != '-')
                                <td><b>ชื่อลูกค้า : </b> {{ $row->guest_name }}</td>
                                <td><b>วันที่เช็คอิน : </b> {{ date('d/m/Y', strtotime($row->check_in_date)) }}</td>
                                <td><b>วันที่เช็คเอ้าท์ : </b> {{ date('d/m/Y', strtotime($row->check_out_date)) }}</td>                               
                            @endif
                        </tr>
                        <tr class="text-center">
                            <td><b>วันที่พบ : </b> {{ date('d/m/Y', strtotime($row->date_found)) }}</td>
                            <td><b>ผู้พบ : </b> {{ $row->found_by }}</td>
                            <td><b>แผนก : </b> {{ $row->locate_track }}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="3"><b>รูปภาพรายการ</b></td>
                        </tr>
                        <tr>
                            <td align="center" id="print_td_img_1">
                                @if ($row->img_1 != null)
                                    <img src="../img/main/{{ $row->img_1 }}" id="print_img_1" class="d-block rounded" width="200" height="150">
                                @endif  
                            </td>
                            <td align="center" id="print_td_img_2">
                                @if ($row->img_2 != null)
                                    <img src="../img/main/{{ $row->img_2 }}" id="print_img_2" class="d-block rounded" width="200" height="150">
                                @endif                              
                            </td>
                            <td align="center" id="print_td_img_3">
                                @if ($row->img_3 != null)
                                    <img src="../img/main/{{ $row->img_3 }}" id="print_img_3" class="d-block rounded" width="200" height="150">
                                @endif                               
                            </td>
                        </tr>
                    </table>
                    <table class="table table-sm table-bordered">
                        <tr class="text-center">
                            <td colspan="4"><b>ลงชื่อลายเซ็น</b></td>
                        </tr>
                        <tr class="text-center">
                            <td>พนักงาน ....................</td>
                            <td>หัวหน้าแผนก .....................</td>
                            <td>ฝ่ายบุคคล ....................</td>
                            <td>รปภ ....................</td>
                        </tr>
                    </table>
                </div>
            </div>           
        @endforeach
    </body>
        <!-- All Js -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
</html>