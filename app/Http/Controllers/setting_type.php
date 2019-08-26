<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use Illuminate\Support\Facades\Auth;
use App\Model\list_item as list_item;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class setting_type extends Controller
{
    public function setting_type_page(Request $request)
    {
        if (Auth::check()) {
            return view('setting_type');
        }else {
            return view('auth/login');
        }
    }

    public function get_type_all(Request $request)
    {
        $type = type::where('type_class', 'item')->get();
        return Datatables::of($type)
            ->addColumn('Show', function ($type) {
                $Show = '';
                if ($type->type_show == 'show') {
                    $Show .= '<span class="badge badge-success">แสดง</span> ';
                }else {
                    $Show .= '<span class="badge badge-danger">ไม่แสดง</span> ';
                }
                return $Show;
            })
            ->addColumn('action', function ($type) {
                $item_count = list_item::where('item_type', $type->type_name)->count();
                $button = '';
                if ($type->type_show == 'show') {
                    $button .= '<button type="button" class="btn btn-sm btn-warning" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" onclick="Open_edit_modal(this);"><i class="fas fa-edit"></i> แก้ไข</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-primary" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" type_class="item" name="ปิดการแสดง" onclick="Open_eye_show_modal(this);"><i class="fas fa-eye-slash"></i> ปิดการแสดง</button> ';
                    if ($item_count == '0'){
                        $button .= '<button type="button" class="btn btn-sm btn-danger" type_id="'.$type->type_id.'" onclick="Open_delete_modal(this);"><i class="fas fa-trash"></i> ลบ</button> ';
                    }
                }else {
                    $button .= '<button type="button" class="btn btn-sm btn-warning" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" onclick="Open_edit_modal(this);"><i class="fas fa-edit"></i> แก้ไข</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-primary" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" type_class="item" name="เปิดการแสดง" onclick="Open_eye_show_modal(this);"><i class="fas fa-eye"></i> เปิดการแสดง</button> ';
                    if ($item_count == '0'){
                        $button .= '<button type="button" class="btn btn-sm btn-danger" type_id="'.$type->type_id.'" onclick="Open_delete_modal(this);"><i class="fas fa-trash"></i> ลบ</button> ';
                    }
                }
                return $button;
            })
            ->rawColumns(['Show', 'action'])
            ->make(true);
    }

    public function get_place_all(Request $request)
    {
        $type = type::where('type_class', 'place')->get();
        return Datatables::of($type)
            ->addColumn('Show', function ($type) {
                $Show = '';
                if ($type->type_show == 'show') {
                    $Show .= '<span class="badge badge-success">แสดง</span> ';
                }else {
                    $Show .= '<span class="badge badge-danger">ไม่แสดง</span> ';
                }
                return $Show;
            })
            ->addColumn('action', function ($type) {
                $item_count = list_item::where('item_type', $type->type_name)->count();
                $button = '';
                if ($type->type_show == 'show') {
                    $button .= '<button type="button" class="btn btn-sm btn-warning" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" onclick="Open_edit_modal(this);"><i class="fas fa-edit"></i> แก้ไข</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-primary" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" type_class="place" name="ปิดการแสดง" onclick="Open_eye_show_modal(this);"><i class="fas fa-eye-slash"></i> ปิดการแสดง</button> ';
                    if ($item_count == '0'){
                        $button .= '<button type="button" class="btn btn-sm btn-danger" type_id="'.$type->type_id.'" onclick="Open_delete_modal(this);"><i class="fas fa-trash"></i> ลบ</button> ';
                    }
                }else {
                    $button .= '<button type="button" class="btn btn-sm btn-warning" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" onclick="Open_edit_modal(this);"><i class="fas fa-edit"></i> แก้ไข</button> ';
                    $button .= '<button type="button" class="btn btn-sm btn-primary" type_id="'.$type->type_id.'" type_name="'.$type->type_name.'" type_class="place" name="เปิดการแสดง" onclick="Open_eye_show_modal(this);"><i class="fas fa-eye"></i> เปิดการแสดง</button> ';
                    if ($item_count == '0'){
                        $button .= '<button type="button" class="btn btn-sm btn-danger" type_id="'.$type->type_id.'" onclick="Open_delete_modal(this);"><i class="fas fa-trash"></i> ลบ</button> ';
                    }
                }
                return $button;
            })
            ->rawColumns(['Show', 'action'])
            ->make(true);
    }

    public function save_type(Request $request)
    {
        $type = new type;
        $type->type_class = $request->post('type_class');
        $type->type_name = $request->post('add_type_name');
        $type->type_show = 'show';
        $type->save();
        return response()->json(['status' => 'success', 'error_text' => 'อัพเดตเสร็จสิ้น'],200);
    }

    public function edit_type(Request $request)
    {
        $type = type::find($request->post('type_id'));
        $type->type_name = $request->post('type_name');
        $type->save();
        return response()->json(['status' => 'success', 'error_text' => 'อัพเดตเสร็จสิ้น'],200);
    }

    public function save_show_type(Request $request)
    {
        $type = type::find($request->post('type_id'));
        if ($request->post('change_name') == 'เปิดการแสดง') {
            $type->type_show = 'show';
        }else {
            $type->type_show = 'hide';
        }
        $type->save();
        return response()->json(['status' => 'success', 'type' => $request->post('type_class'),'error_text' => 'อัพเดตเสร็จสิ้น'],200);
    }

    public function delete_type(Request $request)
    {
        $type = type::find($request->post('type_id'));
        $type->delete();
        return response()->json(['status' => 'success', 'error_text' => 'ลบเสร็จสิ้น'],200);
    }

}
