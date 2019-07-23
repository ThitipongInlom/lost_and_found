<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use App\Model\list_item as list_item;
use Illuminate\Support\Facades\DB as DB;

class dashboard extends Controller
{
    public function dashboard(Request $request)
    {
        $type = type::get();
        return view('dashboard',[
                    'type' => $type]);
    }

	public static function DateThai()
	{
        $strDate = now();
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "วันที่ "."$strDay "."เดือน $strMonthThai "."ปี $strYear ";
	}

    public function save_add(Request $request)
    {   
        $IMG_1 = $request->file('img_1');
        $IMG_2 = $request->file('img_2');
        $IMG_3 = $request->file('img_3');
        $list_item = new list_item;
        $list_item->place_found = $request->post('place_found');
        $list_item->item_type = $request->post('item_type');
        $list_item->item_detail = $request->post('item_detail');
        $list_item->date_found = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('date_found'))));
        if(strlen($request->post('guest_name')) >= 2) {
            $list_item->guest_name = $request->post('guest_name');
            $list_item->check_in_date = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('check_in_date'))));
            $list_item->check_out_date = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('check_out_date'))));
        }else{
            $list_item->guest_name = '-';
            $list_item->check_in_date = '-';
            $list_item->check_out_date = '-';
        }
        $list_item->found_by = $request->post('found_by');
        $list_item->locate_track = $request->post('locate_track');
        $list_item->record_by = $request->post('record_by');
        if(isset($IMG_1)) {
            // Name In Sha
            $IMG_1_sha = sha1(now().$request->file('img_1')->getClientOriginalName());
            // Re Name Success
            $IMG_1_name = $IMG_1_sha.'.'.$request->file('img_1')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_1_path = public_path('/img/main');
            $IMG_1->move($IMG_1_path, $IMG_1_name);
            $list_item->img_1 = $IMG_1_name;
        }
        if(isset($IMG_2)) {
            // Name In Sha
            $IMG_2_sha = sha1(now().$request->file('img_2')->getClientOriginalName());
            // Re Name Success
            $IMG_2_name = $IMG_2_sha.'.'.$request->file('img_2')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_2_path = public_path('/img/main');
            $IMG_2->move($IMG_2_path, $IMG_2_name);
            $list_item->img_2 = $IMG_2_name;
        }
        if(isset($IMG_3)) {
            // Name In Sha
            $IMG_3_sha = sha1(now().$request->file('img_3')->getClientOriginalName());
            // Re Name Success
            $IMG_3_name = $IMG_3_sha.'.'.$request->file('img_3')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_3_path = public_path('/img/main');
            $IMG_3->move($IMG_3_path, $IMG_3_name);
            $list_item->img_3 = $IMG_3_name;
        }
        if ($request->post('item_type') == '' AND $request->post('place_found') == ''){
            return response()->json(['status' => 'error','error_text' => 'การส่งข้อมูลไม่ถูกต้อง'],200);
        }else{
            $list_item->save();
            return response()->json(['status' => 'success','error_text' => 'เพิ่มข้อมูล เสร็จสิ้น'],200);
        }
    }

    public function view_item(Request $request)
    {
        $query = list_item::where('list_id', $request->post('list_item_id'))->get();
        foreach ($query as $key => $result) {
            return response()->json(['status' => 'success','data' => $result],200);
        }
    }

    public function edit_item(Request $request)
    {
        $query = list_item::where('list_id', $request->post('list_item_id'))->get();
        foreach ($query as $key => $result) {
            return response()->json(['status' => 'success','data' => $result],200);
        }
    }

    public function delete_img(Request $request)
    {
        $img_name = $request->post('img_name');
        $img_number =  $request->post('img_number');
        unlink(public_path("img/main/$img_name"));
        $list_item = list_item::find($request->post('list_id'));
        if ($img_number == '1') {
            $list_item->img_1 = null;
        }elseif ($img_number == '2') {
            $list_item->img_2 = null;
        }elseif ($img_number == '3') {
            $list_item->img_3 = null;
        }
        $list_item->save();
        return response()->json(['status' => 'success','error_text' => 'ลบรูปภาพ เสร็จสิ้น'],200);
    }

    public function save_edit(Request $request)
    {
        $IMG_1 = $request->file('img_1');
        $IMG_2 = $request->file('img_2');
        $IMG_3 = $request->file('img_3');
        $list_item = list_item::find($request->post('list_id'));
        $list_item->place_found = $request->post('place_found');
        $list_item->item_type = $request->post('item_type');
        $list_item->item_detail = $request->post('item_detail');
        $list_item->date_found = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('date_found'))));
        if(strlen($request->post('guest_name')) >= 2) {
            $list_item->guest_name = $request->post('guest_name');
            $list_item->check_in_date = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('check_in_date'))));
            $list_item->check_out_date = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('check_out_date'))));
        }else{
            $list_item->guest_name = '-';
            $list_item->check_in_date = '-';
            $list_item->check_out_date = '-';
        }
        $list_item->found_by = $request->post('found_by');
        $list_item->locate_track = $request->post('locate_track');
        $list_item->record_by = $request->post('record_by');
        if(isset($IMG_1)) {
            // Name In Sha
            $IMG_1_sha = sha1(now().$request->file('img_1')->getClientOriginalName());
            // Re Name Success
            $IMG_1_name = $IMG_1_sha.'.'.$request->file('img_1')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_1_path = public_path('/img/main');
            $IMG_1->move($IMG_1_path, $IMG_1_name);
            $list_item->img_1 = $IMG_1_name;
        }
        if(isset($IMG_2)) {
            // Name In Sha
            $IMG_2_sha = sha1(now().$request->file('img_2')->getClientOriginalName());
            // Re Name Success
            $IMG_2_name = $IMG_2_sha.'.'.$request->file('img_2')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_2_path = public_path('/img/main');
            $IMG_2->move($IMG_2_path, $IMG_2_name);
            $list_item->img_2 = $IMG_2_name;
        }
        if(isset($IMG_3)) {
            // Name In Sha
            $IMG_3_sha = sha1(now().$request->file('img_3')->getClientOriginalName());
            // Re Name Success
            $IMG_3_name = $IMG_3_sha.'.'.$request->file('img_3')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_3_path = public_path('/img/main');
            $IMG_3->move($IMG_3_path, $IMG_3_name);
            $list_item->img_3 = $IMG_3_name;
        }
        if ($request->post('item_type') == '' AND $request->post('place_found') == ''){
            return response()->json(['status' => 'error','error_text' => 'การส่งข้อมูลไม่ถูกต้อง'],200);
        }else{
            $list_item->save();
            return response()->json(['status' => 'success','error_text' => 'แก้ไขข้อมูล เสร็จสิ้น'],200);
        }
    }

    public function delete_item(Request $request)
    {
        $query = list_item::where('list_id', $request->post('list_item_id'))->get();
        // Delete IMG
        foreach ($query as $key => $row) {
            if ($row->img_1 != '') {
                unlink(public_path("img/main/$row->img_1"));
            }
            if ($row->img_2 != '') {
                unlink(public_path("img/main/$row->img_2"));
            }
            if ($row->img_3 != '') {
                unlink(public_path("img/main/$row->img_3"));
            }
        }
        list_item::where('list_id' , $request->post('list_item_id'))->delete();
        return response()->json(['status' => 'success', 'error_text' => 'ลบข้อมูล เสร็จสิ้น'],200);
    }

    public function get_type(Request $request)
    {
        if ($request->get('type_select_table') == 'return_all'){
            $list_item = list_item::get();
        }elseif ($request->get('type_select_table') == 'return_yes') {
            $list_item = list_item::where('return_item', 'turn')->get();
        }elseif ($request->get('type_select_table') == 'return_no') {
            $list_item = list_item::whereNull('return_item')->get();
        }
        return Datatables::of($list_item)
            ->addColumn('action', function ($list_item) {
                $button = '';
                if ($list_item->return_item == '') {
                    $button .= '<button type="button" class="btn btn-sm btn-info" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" onclick="Open_model_info(this);"><i class="fas fa-info"></i> Info</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-warning" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล" onclick="Open_model_edit(this);"><i class="fas fa-edit"></i> Edit</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-danger" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล" onclick="Open_model_delete(this);"><i class="fas fa-trash"></i> Del</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-dark" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="ปริ้นข้อมูล"><i class="fas fa-print"></i> Print</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-success" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="คืนของให้ลูกค้า"><i class="fas fa-undo-alt"></i> Turn</button> ';
                }else{
                    $button .= '<button type="button" class="btn btn-sm btn-info" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" onclick="Open_model_info(this);"><i class="fas fa-info"></i> Info</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-dark" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="ปริ้นข้อมูล"><i class="fas fa-print"></i> Print</button> ';
                }
                return $button;
            })
            ->editColumn('place_found', '{!! str_limit($place_found, 20) !!}')
            ->editColumn('item_detail', '{!! str_limit($item_detail, 20) !!}')
            ->editColumn('date_found', function($list_item) {
                return date('d/m/Y', strtotime($list_item->date_found));
            })
            ->editColumn('return_item', function($list_item) {
                if($list_item->return_item == '') {
                    $new_return_item = '<h5><span class="badge badge-secondary">N</span></h5>';
                }else{
                    $new_return_item = '<h5><span class="badge badge-success">Y</span></h5>';
                }
                return $new_return_item;
            })
            ->rawColumns(['return_item','action'])
            ->make(true);
    }
}
