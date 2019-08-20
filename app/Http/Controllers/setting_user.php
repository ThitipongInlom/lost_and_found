<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use Illuminate\Support\Facades\Auth;
use App\Model\list_item as list_item;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class setting_user extends Controller
{
    public function setting_user_page(Request $request)
    {
        if (Auth::check()) {
            return view('setting_user');
        }else {
            return view('auth/login');
        }
    }

    public function get_user_all(Request $request)
    {
        $user = user::get();
        return Datatables::of($user)
            ->addColumn('action', function ($user) {
                return '<button type="button" class="btn btn-sm btn-warning" type_id="'.$user->user_id.'" onclick="Open_edit_modal(this);"><i class="fas fa-edit"></i> แก้ไข</button>';
            })
            ->addColumn('name', function ($user) {
                return $user->fname.' '.$user->lname;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $user->save();
        return response()->json(['status' => 'success', 'error_text' => 'อัพเดตเสร็จสิ้น'],200);
    }

}
