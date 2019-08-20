<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\type as type;
use Illuminate\Support\Facades\Auth;
use App\Model\list_item as list_item;
use App\Model\User as user;
use Illuminate\Support\Facades\DB as DB;

class setting_web extends Controller
{
    public function setting_web_page(Request $request)
    {
        if (Auth::check()) {
            return view('setting_web');
        }else {
            return view('auth/login');
        }
    }

    public function background_web(Request $request)
    {
        $old_file = file_exists(public_path("img/web_setting/background.jpg")); 
        if ($old_file == '1') {
            unlink(public_path("img/web_setting/background.jpg"));
        }
        $IMG = $request->file('img');
        if(isset($IMG)) {
            // Name In Sha
            $IMG_1_sha = 'background';
            // Re Name Success
            $IMG_1_name = $IMG_1_sha.'.'.$request->file('img')->getClientOriginalExtension();
            // Path To Save Img
            $IMG_1_path = public_path('/img/web_setting');
            $IMG->move($IMG_1_path, $IMG_1_name);
        }
        return response()->json(['status' => 'success', 'error_text' => 'เปลี่ยนรูปภาพพื้นหลังเรียบร้อยแล้ว'],200);
    }
}
