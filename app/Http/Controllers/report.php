<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use Illuminate\Support\Facades\Auth;
use App\Model\list_item as list_item;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class report extends Controller
{
    public function report(Request $request)
    {
        return view('report');
    }

    public function get_tab_1(Request $request)
    {
        $range_date = explode(" - ", $request->post('range_date'));
        $reformat_start = date('Y-m-d', strtotime(str_replace('/', '-', $range_date[0])));
        $reformat_end   = date('Y-m-d', strtotime(str_replace('/', '-', $range_date[1])));
        $place_view = explode(',', Auth::User()->place_view);
        if (Auth::User()->status == 'admin') {
            $list_item = list_item::whereBetween('date_found', [$reformat_start, $reformat_end])->get();
        }else{
            $place_view = explode(',', Auth::User()->place_view);
            $list_item = list_item::whereIn('place', $place_view)->whereBetween('date_found', [$reformat_start, $reformat_end])->get();
        }

        $Table  = "<div align='center'><h4><b>รายงานการ ฝากของลืม</b></h4></div>";
        $Table .= "<div align='center'><b>ระหว่างวันที่ ".$range_date[0]." ถึงวันที่ ".$range_date[1]."</b></div>";
        $Table .= "<table class='table table-sm mt-2'>";
        $Table .= "<thead align='center'><tr><th>Ref</th><th>ประเภท</th><th>รายละเอียด</th><th>สถานที่เก็บ</th></thead>";
        $Table .= "<tbody>";
        foreach ($list_item as $key => $row) {
            $Table .= "<tr align='center'><td>$row->list_id</td><td>$row->item_type</td><td>$row->item_detail</td><td>$row->place</td></tr>";
        }
        $Table .= "</tbody>";
        $Table .= "</table>";

        return response()->json(['status' => 'success', 'error_text' => 'อัพเดต รหัสผ่าน เสร็จสิ้น','Table' => $Table],200);
    }
}
