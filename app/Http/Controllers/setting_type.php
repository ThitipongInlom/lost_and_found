<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use App\Model\list_item as list_item;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class setting_type extends Controller
{
    public function setting_type_page(Request $request)
    {
        return view('setting_type');
    }

    public function get_type_all(Request $request)
    {
        $type = type::get();
        return Datatables::of($type)
            ->addColumn('action', function ($type) {
                return '<button type="button" class="btn btn-sm btn-primary">แก้ไข</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
