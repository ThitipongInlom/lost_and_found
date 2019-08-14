<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use App\Model\list_item as list_item;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class setting_user extends Controller
{
    public function setting_user_page(Request $request)
    {
        return view('setting_user');
    }

    public function get_user_all(Request $request)
    {
        $user = user::get();
        return Datatables::of($user)
            ->addColumn('action', function ($user) {
                return '<button type="button" class="btn btn-sm btn-primary">แก้ไข</button>';
            })
            ->addColumn('name', function ($user) {
                return $user->fname.' '.$user->lname;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
