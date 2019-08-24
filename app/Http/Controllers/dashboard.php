<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use Illuminate\Support\Facades\Auth;
use App\Model\list_item as list_item;
use Illuminate\Support\Facades\DB as DB;

class dashboard extends Controller
{
    public function dashboard(Request $request)
    {
        $type = type::where('type_show', 'show')->get();
        $instockmonth = list_item::whereMonth('date_found', date('m'))->whereNull('return_item')->count();
        $instockall = list_item::whereNull('return_item')->count();
        $waitmonth = list_item::whereMonth('date_found', date('m'))->where('return_item', 'wait')->count();
        $waitall = list_item::where('return_item', 'wait')->count();
        $turnmonth = list_item::whereMonth('date_found', date('m'))->where('return_item', 'turn')->count();
        $turnall = list_item::where('return_item', 'turn')->count();
        if (Auth::check()) {
            return view('dashboard',[
                        'instockmonth' => $instockmonth,
                        'instockall' => $instockall,
                        'waitmonth' => $waitmonth,
                        'waitall' => $waitall,
                        'turnmonth' => $turnmonth,
                        'turnall' => $turnall,
                        'type' => $type]);
        }else{
            return view('login');
        }
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
        }elseif ($request->get('type_select_table') == 'return_wait') {
            $list_item = list_item::where('return_item', 'wait')->get();
        }elseif ($request->get('type_select_table') == 'return_no') {
            $list_item = list_item::whereNull('return_item')->get();
        }
        return Datatables::of($list_item)
            ->addColumn('action', function ($list_item) {
                $button = '';
                if ($list_item->return_item == '') {
                    $button .= '<button type="button" class="btn btn-sm btn-info" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.view').'" onclick="Open_model_info(this);"><i class="fas fa-info"></i> '.trans('dashboard.view').'</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-warning" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.edit').'" onclick="Open_model_edit(this);"><i class="fas fa-edit"></i> '.trans('dashboard.edit').'</button> ';
                    if (Auth::User()->status == 'admin') {
                        $button .= '<button type="button" class="btn btn-sm btn-danger" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.del').'" onclick="Open_model_delete(this);"><i class="fas fa-trash"></i> '.trans('dashboard.del').'</button> ';
                    }
                    $button .= '<button type="button" class="btn btn-sm btn-dark" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.print').'" onclick="Open_model_print(this);"><i class="fas fa-print"></i> '.trans('dashboard.print').'</button> ';
                }elseif($list_item->return_item == 'wait') {
                    $button .= '<button type="button" class="btn btn-sm btn-info" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.view').'" onclick="Open_model_info(this);"><i class="fas fa-info"></i> '.trans('dashboard.view').'</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-dark" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.print').'" onclick="Open_model_print(this);"><i class="fas fa-print"></i> '.trans('dashboard.print').'</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-success" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.turn').'" onclick="Open_model_return(this);"><i class="fas fa-undo-alt"></i> '.trans('dashboard.turn').'</button> ';
                }else{
                    $button .= '<button type="button" class="btn btn-sm btn-info" style="font-family: cursive;font-weight: 500;" list_item_id="'.$list_item->list_id.'" data-toggle="tooltip" data-placement="top" title="'.trans('dashboard.view').'" onclick="Open_model_info(this);"><i class="fas fa-info"></i> '.trans('dashboard.view').'</button> ';
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
                }elseif($list_item->return_item == 'wait') {
                    $new_return_item = '<h5><span class="badge badge-warning">W</span></h5>';
                }else{
                    $new_return_item = '<h5><span class="badge badge-success">Y</span></h5>';
                }
                return $new_return_item;
            })
            ->rawColumns(['return_item','action'])
            ->make(true);
    }

    public function print_item(Request $request,$item_id)
    {
        $query = list_item::where('list_id', $item_id)->get();
        $type_sned = $request->get('type_send');
        $name_item_out = $request->get('name_item_out');
        $dep_item_out = $request->get('dep_item_out');

        $list_item = list_item::find($item_id);
        $list_item->return_item = 'wait';
        $list_item->name_item_out = $name_item_out;
        $list_item->dep_item_out = $dep_item_out;
        $list_item->type_item_out = $type_sned;
        $list_item->date_item_out = now();
        $list_item->save();

        return view('print',[
                    'item' => $query,
                    'type_sned' => $type_sned]);
    }

    public function return_item(Request $request)
    {
        $query = list_item::where('list_id', $request->post('list_item_id'))->get();
        foreach ($query as $key => $row) {
            $data_return = "";
            $button_save= "";
            // มารับเอง
            if($row->type_item_out == '1') {
                $data_return .= '<div class="row>';
                $data_return .= '<div class="col-md-12>';
                $data_return .= '<b>ชื่อผู้ที่มารับของที่ลืม :</b><input class="form-control form-control-sm mb-2" type="text" id="return_type_1_name" placeholder="ชื่อผู้ที่มารับของที่ลืม">';
                $data_return .= '<b>ที่อยู่ :</b><textarea class="form-control mb-2" id="return_type_1_address" rows="2" placeholder="ที่อยู่"></textarea>';
                $data_return .= '</div></div>';
                $data_return .= '<div class="row"><div class="col-md-4">';
                $data_return .= '<b>วันที่มารับ :</b><input class="form-control form-control-sm mb-2 daterange_single" type="text" id="return_type_1_date" placeholder="วันที่มารับ">';
                $data_return .= '</div><div class="col-md-4">';
                $data_return .= '<b>เบอร์โทรติดต่อกลับ :</b><input class="form-control form-control-sm mb-2" type="text" id="return_type_1_phone" placeholder="เบอร์โทรติดต่อกลับ">';
                $data_return .= '</div></div>';
                $button_save .= '<button class="btn btn-sm btn-block btn-primary" type_item_out="1" list_id="'.$row->list_id.'" onclick="Save_model_return(this);"><i class="fas fa-save"></i> ยืนยัน</button>';
            }elseif ($row->type_item_out == '2') {
                $data_return .= '<b>ผู้นำส่งไปรษณีย์ :</b><input class="form-control form-control-sm mb-2" type="text" id="return_type_2_name" placeholder="ผู้นำส่งไปรษณีย์">';
                $data_return .= '<b>แผนก :</b><input class="form-control form-control-sm mb-2" type="text" id="return_type_2_dep" placeholder="แผนก">';
                $data_return .= '<b>ชื่อและที่อยู่ :</b><textarea class="form-control mb-2" id="return_type_2_address" rows="2" placeholder="ชื่อและที่อยู่"></textarea>';
                $data_return .= '<b>หมายเลขพัสดุที่ส่ง :</b><input class="form-control form-control-sm mb-2" type="text" id="return_type_2_ems" placeholder="หมายเลขพัสดุที่ส่ง">';
                $button_save .= '<button class="btn btn-sm btn-block btn-primary" type_item_out="2" list_id="'.$row->list_id.'" onclick="Save_model_return(this);"><i class="fas fa-save"></i> ยืนยัน</button>';
            }elseif ($row->type_item_out == '3') {
                $data_return .= '<b>อื่นๆ :</b><textarea class="form-control mb-2" id="return_type_3_other" rows="3" placeholder="อื่นๆ"></textarea>';
                $button_save .= '<button class="btn btn-sm btn-block btn-primary" type_item_out="3" list_id="'.$row->list_id.'" onclick="Save_model_return(this);"><i class="fas fa-save"></i> ยืนยัน</button>';
            }
        }
        return response()->json(['status' => 'success', 'button' => $button_save, 'data' => $data_return],200);
    }

    public function Save_return_item(Request $request)
    {
        if($request->post('type_item_out') == '1') {
            $list_item = list_item::find($request->post('list_id'));
            $list_item->return_item = 'turn';
            $list_item->name_return_guest = $request->post('return_type_1_name');
            $list_item->address_return_guest = $request->post('return_type_1_address');
            $list_item->date_return_guest = date('Y-m-d',strtotime(str_replace('/', '-', $request->post('return_type_1_date'))));
            $list_item->phone_return_guest = $request->post('return_type_1_phone');
            $list_item->save();
        }elseif ($request->post('type_item_out') == '2') {
            $list_item = list_item::find($request->post('list_id'));
            $list_item->return_item = 'turn';
            $list_item->name_return_guest = $request->post('return_type_2_name');
            $list_item->dep_return_guest = $request->post('return_type_2_dep');
            $list_item->address_return_guest = $request->post('return_type_2_dep');
            $list_item->ems_return_guest = $request->post('return_type_2_ems');
            $list_item->save();
        }elseif ($request->post('type_item_out') == '3') {
            $list_item = list_item::find($request->post('list_id'));
            $list_item->return_item = 'turn';
            $list_item->other_return_guest = $request->post('return_type_3_other');
            $list_item->save();
        }

    }
}
