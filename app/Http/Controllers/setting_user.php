<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use Illuminate\Support\Facades\Auth;
use App\Model\list_item as list_item;
use Illuminate\Support\Facades\Hash;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class setting_user extends Controller
{
    
    public function setting_user_page(Request $request)
    {
        $place = type::where('type_class', 'place')->get();
        if (Auth::check()) {
            return view('setting_user',[
                        'place' => $place]);
        }else {
            return view('auth/login');
        }
    }

    public function get_user_all(Request $request)
    {
        $user = user::get();
        return Datatables::of($user)
            ->addColumn('action', function ($user) {
                $button = '<button type="button" class="btn btn-sm btn-warning" type_id="'.$user->user_id.'" onclick="Open_edit_modal(this);"><i class="fas fa-edit"></i> แก้ไข</button> ';
                $button .= '<button type="button" class="btn btn-sm btn-info" type_id="'.$user->user_id.'" onclick="Open_resetpw_modal(this);"><i class="fas fa-key"></i> ตั้งรหัสผ่านใหม่</button> ';
                $button .= '<button type="button" class="btn btn-sm btn-danger" type_id="'.$user->user_id.'" onclick="Open_delete_modal(this);"><i class="fas fa-trash"></i> ลบ</button> ';
                return $button;
            })
            ->addColumn('name', function ($user) {
                return $user->fname.' '.$user->lname;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_resetpw(Request $request)
    {
        user::where('user_id', $request->post('user_id'))->update(['password' => Hash::make($request->post('new_password'))]);
        return response()->json(['status' => 'success', 'error_text' => 'อัพเดต รหัสผ่าน เสร็จสิ้น'],200);
    }

    public function delete_user(Request $request)
    {
        user::where('user_id', $request->post('user_id'))->delete();
        return response()->json(['status' => 'success', 'error_text' => 'ลบข้อมูลเสร็จสิ้น'],200);
    }

    public function get_edit_user_id(Request $request)
    {
        $user = user::where('user_id', $request->post('type_id'))->get();
        return response()->json(['status' => 'success', 'error_text' => 'อัพเดตเสร็จสิ้น', 'data' => $user],200);
    }

    public function save_edit_user(Request $request)
    {
        $user = user::find($request->post('user_id'));
        $user->fname = $request->post('fname_edit');
        $user->lname = $request->post('lname_edit');
        $user->phone = $request->post('phone_edit');
        $user->email = $request->post('email_edit');
        $user->place = $request->post('place_edit');
        $user->status = $request->post('status_edit');
        $user->place_view = $request->post('place_view');
        $user->save();
        return response()->json(['status' => 'success', 'error_text' => 'อัพเดตเสร็จสิ้น'],200);
    }

}
